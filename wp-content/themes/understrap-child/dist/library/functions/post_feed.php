<?php



function build_feed(){  
    $feedHTML = '';
    
    ob_start();
    
    $theme = get_stylesheet_directory();
    $loop_templates = $theme . '/loop-templates/';
    
   
    $paged = get_query_var('paged');

   
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
                    // echo '<div class="col-md-4 col-sm-6 card">';	
                    if($post_type == 'podcasts'):
                        //get_template_part( '/loop-templates/content', 'podcast' );
                        include($loop_templates.'content-podcast.php');
                    elseif($post_type == 'newsletters'):
                        //get_template_part( '/loop-templates/content', 'newsletter' );
                        include($loop_templates.'content-newsletter.php');
                    elseif($post_type == 'post'):
                        //get_template_part( '/loop-templates/content', 'post' );
                        include($loop_templates.'content-post.php');
                    elseif($post_type == 'videos'):
                        //get_template_part( '/loop-templates/content', 'video' );
                        include($loop_templates.'content-video.php');
                    endif;
                    // echo '</div>';	
                    wp_reset_postdata();
                endwhile;
                echo '</div>';	
                echo '</div><!-- .row -->';
            endif;
            
            
        endif;
        
        if($feed_type == 'Dynamic Post Feed' || $feed_type == 'Pinned Posts and Dynamic Post Feed'):
        
            $number_of_posts_to_include = get_sub_field('number_of_posts_to_include');
            $included_post_types = get_sub_field('included_post_types');
            $post_type_array = [];
            $feedHTML .= '<div class="grid row">';
            
            if(!$number_of_posts_to_include):
            $number_of_posts_to_include = -1;
            endif;
            
            foreach($included_post_types as $post_type):
            array_push($post_type_array, $post_type);
            endforeach;

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

            // GRID
            $cols = get_sub_field('number_of_columns');
            // echo 'number of columns: ' . $cols;
            $rpd_args = array( 
                'post_type' => $post_type_array, 
                'posts_per_page' => $number_of_posts_to_include, 
                'post_status' => 'publish', 
                'order' => 'DESC', 
                'orderby' => 'date', 
                'paged' => $paged  
            );
            
            $wp_query = new WP_Query( $rpd_args );
            while ($wp_query->have_posts() ) : $wp_query->the_post();

            $post_type = get_post_type();
            switch ($cols) {
                case '1':
                    echo '<div class="col-md-12 grid__item">';
                    break;
                case '2':
                    echo '<div class="col-md-6 grid__item">';
                    break;
                case '3':
                    echo '<div class="col-md-4 col-sm-6 grid__item">';
                    break;
                case '4':
                    echo '<div class="col-md-3 col-sm-6 grid__item">';
                    break;
                default:
                    echo '<div class="col-md-4 col-sm-6 grid__item">';
            }

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

            // SCROLLER
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

            // PAGINATION
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

