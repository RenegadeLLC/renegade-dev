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
            $feedHTML .= '<div class="row">';
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

            // get the pinned 

            // top posts
            $top_posts = [];

            // pinned posts
            $pinned_posts = [];
            if(have_rows('pinned_posts')):
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<h2>PINNED POSTS</h2>';
                echo '<ul>';
                while ( have_rows('pinned_posts') ) : the_row();
                    $pinned_post = get_sub_field('pinned_post');
                    $pinned_post_ID = $pinned_post -> ID;
                    array_push($top_posts, $pinned_post_ID);
                    // $post = $pinned_post;
                    setup_postdata( $pinned_post ); 
                    echo '<li><a href="' . get_permalink($pinned_post -> ID) . '">' .  get_post_type($pinned_post -> ID) . ' ' . $pinned_post_ID . ': ' . get_the_title( $pinned_post -> ID ) .'</a> </li> ';
                endwhile;
                echo '</ul>';
            endif;
            wp_reset_query();
            print_r($top_posts);
            echo '</div>';
            echo '</div>';
            

            // aggregate most recent stories in feed
            echo '<div class="row">';
            echo '<div class="col-md-12">';
            echo '<h2>RECENT POSTS</h2>';

            $num_show = 4;
            $recent_posts = wp_get_recent_posts(array(
                'posts_per_page'   => $num_show,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_type'        => 'post',
                'post_status'      => 'publish',
            ));
            $recent_news = wp_get_recent_posts(array(
                'posts_per_page'   => $num_show,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'post_type'        => 'newsletters',
                'post_status'      => 'publish',
            ));
            $recent_podcasts = wp_get_recent_posts(array(
                'posts_per_page'   => $num_show,
                'orderby'          => 'date',
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
                // echo "The number is: $x <br>";
                array_push(
                    $recent_all,
                    $recent_posts[$x],
                    $recent_news[$x],
                    $recent_podcasts[$x],
                    $recent_downloads[$x]
                );
            }
            $recent_all = array_filter($recent_all);

            echo '<ul>';
            foreach( $recent_all as $recent ){
                // push id to top_posts
                array_push($top_posts, $recent["ID"]);
                echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .  $recent["post_type"] . ' ' . $recent["ID"] . ': ' . $recent["post_title"].'</a> </li> ';
            }
            echo '</ul>';
            wp_reset_query();
            print_r($top_posts);
            echo '</div>';
            echo '</div>';

            // start html template
            // $feedHTML .= '<div class="grid row">';
            $feedHTML .= '<div class="grid row">';

            // set grid item container

            // grid
            $cols = get_sub_field('number_of_columns');
            $col_grid_container;
            switch ($cols) {
                case
                    $col_grid_container = '<div class="col-md-12 grid__item">';
                    break;
                case '2':
                    $col_grid_container = '<div class="col-md-6 grid__item">';
                    break;
                case '3':
                    $col_grid_container = '<div class="col-md-4 col-sm-6 grid__item">';
                    break;
                case '4':
                    $col_grid_container = '<div class="col-md-3 col-sm-6 grid__item">';
                    break;
                default:
                    $col_grid_container = '<div class="col-md-4 col-sm-6 grid__item">';
            }

            // main query
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $rpd_args = array( 
                'post_type' => $post_type_array, 
                'posts_per_page' => $number_of_posts_to_include,
                'post__not_in' => $top_posts,
                'post_status' => 'publish', 
                'order' => 'DESC', 
                'orderby' => 'date', 
                'paged' => $paged  
            );
            $wp_query = new WP_Query( $rpd_args );

            // loop
            while ($wp_query->have_posts() ) : $wp_query->the_post();

            $post_type = get_post_type();

            echo $col_grid_container ;
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

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
            //comments_template();
            endif;

            endwhile; // end of the loop.
        
            // clean up after the query and pagination
            wp_reset_postdata(); 
            
            echo '</div><!-- .row -->';

            // scroller
            echo '<div class="row">';
            echo '<div class="col-lg-3"></div>';
            echo '<div class="col-lg-6">';
            echo '<div><button type="button" class="btn btn-primary btn-block view-more-button">VIEW MORE</button></div>';
            echo '<div class="loader-wheel .infinite-scroll-request">';
            echo '<i><i><i><i><i><i><i><i><i><i><i><i>';
            echo '</i></i></i></i></i></i></i></i></i></i></i></i>';
            echo '</div>';
            echo '</div>';
            echo '<div class="col-lg-3"></div>';
            echo '</div>';

            // pagination
            echo '<div class="pagination">';
            next_posts_link( 'Older Entries', $wp_query->max_num_pages );
            previous_posts_link( 'Newer Entries' );
            echo '</div>';

        endif;
        
        
        $feed_content = ob_get_contents();
        $feedHTML .= $feed_content;
        //End buffering
        
    endwhile;   
    endif;
    ob_end_clean();
    return $feedHTML;
}

