<?php

function build_feed(){  
    $feedHTML = '';
    
    ob_start();
    
    $theme = get_stylesheet_directory();
    $loop_templates = $theme . '/loop-templates/';
   
    $paged = get_query_var('paged');

   // PINNED POSTS
    if(have_rows('post_feed_items')):
    
    while ( have_rows('post_feed_items') ) : the_row();

        $feed_type = get_sub_field('feed_type');
        
        if($feed_type == 'Pinned Posts'):
            $feedHTML .= '<div class="row" id="'. get_sub_field('content_section_name') . '">';
            $feedHTML .= '<div class="card-columns">';
            if(have_rows('pinned_posts')):
                while ( have_rows('pinned_posts') ) : the_row();

                    $pinned_post = get_sub_field('pinned_post');
                    $post = $pinned_post;
                    setup_postdata( $post ); 
                    
                    $post_type = get_post_type($post -> ID);
                    if($post_type == 'podcasts'):
                        include($loop_templates.'content-podcast.php');
                    elseif($post_type == 'newsletters'):
                        include($loop_templates.'content-newsletter.php');
                    elseif($post_type == 'post'):
                        include($loop_templates.'content-post.php');
                    elseif($post_type == 'videos'):
                        include($loop_templates.'content-video.php');
                    endif;
                    wp_reset_postdata();
                endwhile;
                echo '</div>';	
                echo '</div><!-- .row -->';
            endif;
            
            
        endif;
        
        // DYNAMIC POSTS
        if($feed_type == 'Dynamic Post Feed' || $feed_type == 'Pinned Posts and Dynamic Post Feed'):
            // acf data
            $number_of_posts_to_include = get_sub_field('number_of_posts_to_include');
            $included_post_types = get_sub_field('included_post_types');
            $post_type_array = [];
            if(!$number_of_posts_to_include):
                $number_of_posts_to_include = -1;
            endif;
            foreach($included_post_types as $post_type):
                array_push($post_type_array, $post_type);
            endforeach;

            // ids of posts to put on top
            $top_post_ids = [];

            // pinned posts
            $pinned_posts = [];
            if(have_rows('pinned_posts')):
                while ( have_rows('pinned_posts') ) : the_row();
                    $pinned_post = get_sub_field('pinned_post');
                    $pinned_post_ID = $pinned_post -> ID;
                    array_push($top_post_ids, $pinned_post_ID);
                endwhile;
            endif;
            wp_reset_query();

            // TODO: expose this in ACF
            $num_show = 30;

            // TODO: refactor to loop through ACF included_post_types
            $recent_posts = wp_get_recent_posts(array(
                'posts_per_page'   => $num_show,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_type'        => 'post',
                'post_status'      => 'publish',
            ));
            $recent_news = wp_get_recent_posts(array(
                'posts_per_page'   => $num_show,
                'orderby'          => 'meta_value',
                'meta_key'         => 'rn_date',
                'post_type'        => 'newsletters',
                'post_status'      => 'publish',
            ));
            $recent_podcasts = wp_get_recent_posts(array(
                'posts_per_page'   => $num_show,
                'orderby'          => 'meta_value',
                'meta_key'         => 'podcast_date',
                'order'            => 'DESC',
                'post_type'        => 'podcasts',
                'post_status'      => 'publish',
            ));
            $recent_downloads = wp_get_recent_posts(array(
                'posts_per_page'   => $num_show,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_type'        => 'downloads',
                'post_status'      => 'publish',
            ));

            $recent_all = [];
            for ($x = 0; $x <= $num_show; $x++) {
                array_push(
                    $recent_all,
                    $recent_posts[$x],
                    $recent_news[$x],
                    $recent_podcasts[$x],
                    $recent_downloads[$x]
                );
            }
            $recent_all = array_filter($recent_all);

            foreach( $recent_all as $recent ){
                array_push($top_post_ids, $recent["ID"]);
            }
            wp_reset_query();

            // set grid item container
            $cols = get_sub_field('number_of_columns');
            $col_grid_container;
            switch ($cols) {
                case '1':
                    $col_grid_container = '<div class="col-md-12 grid__item">';
                    break;
                case '2':
                    $col_grid_container = '<div class="col-md-6 grid__item">';
                    break;
                case '3':
                    $col_grid_container = '<div class="col-lg-4 col-md-6 grid__item">';
                    break;
                case '4':
                    $col_grid_container = '<div class="col-md-3 col-sm-6 grid__item">';
                    break;
                default:
                    $col_grid_container = '<div class="col-md-4 col-sm-6 grid__item">';
            }

            // get ids of all posts
            $ids_args = [
                'post_type'      => $post_type_array,
                'posts_per_page' => -1,
                'orderby'        => 'date', 
                'order'          => 'DESC',
                'post_status'    => 'publish', 
                'fields'         => 'ids',
            ];
            $all_posts_ids = get_posts( $ids_args );
            
            // Make sure we have posts before continuing
            if ( $all_posts_ids ) {

                // Add the array of top posts to the front of our $all_posts_ids array
                $post_ids_merged = array_merge( $top_post_ids, $all_posts_ids );
                // Make sure that we remove the ID's from their original positions
                $reordered_ids   = array_unique( $post_ids_merged );
            
                // Now we can run our normal query
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = [
                    'post_type'      => $post_type_array,
                    'posts_per_page' => $number_of_posts_to_include,
                    'post__in'       => $reordered_ids,
                    'orderby'        => 'post__in',
                    'order'          => 'ASC',
                    'paged'          => $paged
                ];

                // The loop
                $loop = new WP_Query( $args ); 

                $count = $loop->post_count;

                // set dynamic or non-dynamic classes
                if ($count == $number_of_posts_to_include):
                    echo '<div class="post-feed dynamic grid row';
                else:
                    echo '<div class="post-feed non-dynamic row';
                endif;

                // set single-type class if only single post type
                if (count($post_type_array) > 1):
                    echo '">';
                else:
                    echo ' single-type">';
                endif;

                while( $loop->have_posts() ) {
                    $loop->the_post();
                        $post_type = get_post_type();
                        echo $col_grid_container ;
                        // echo 'post types array: ' . count($post_type_array);
                        if($post_type == 'podcasts'):   
                            get_template_part( '/loop-templates/content', 'podcast' );
                        elseif($post_type == 'newsletters'):
                            get_template_part( '/loop-templates/content', 'newsletter' );
                        elseif($post_type == 'post'):
                            get_template_part( '/loop-templates/content', 'post' );
                        elseif($post_type == 'videos'):
                            get_template_part( '/loop-templates/content', 'video' );
                        endif;
                        echo '</div>';
                }
                wp_reset_postdata();

                echo '</div><!-- .row -->';

                if ($count == $number_of_posts_to_include):
                
                if (!is_front_page() and !is_404()):
                    echo '<div class="row">';
                    echo '<div class="col-md-4"></div>';
                    echo '<div class="col-md-4">';
                    // view more button
                    echo '<div class="view-more-button-container"><button type="button" class="btn btn-dark btn-block view-more-button">View More</button></div>';
                    // loader wheel
                    echo '<div class="loader-wheel">';
                    echo '<div class="infinite-scroll-request">';
                    echo '<i><i><i><i><i><i><i><i><i><i><i><i>';
                    echo '</i></i></i></i></i></i></i></i></i></i></i></i>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="col-md-4"></div>';
                    echo '</div>';
                endif;
    
                // pagination
                if (!is_front_page() and !is_404()):
                    echo '<div class="pagination" style:"visibility: hidden;">';
                else: 
                    echo '<div class="pagination">';
                endif;
                next_posts_link( 'Older Entries', $loop->max_num_pages );
                previous_posts_link( 'Newer Entries' );
                echo '</div>';
                endif;
            }

            // clean up after the query and pagination
            wp_reset_postdata(); 

        endif;
        
        
        $feed_content = ob_get_contents();
        $feedHTML .= $feed_content;
        //End buffering
        
    endwhile;   
    endif;
    ob_end_clean();
    return $feedHTML;
}
