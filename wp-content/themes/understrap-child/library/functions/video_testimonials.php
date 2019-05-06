<?php

function build_videotestimonials(){  
    
    $videotestimonialsHTML = '';
    $videotestimonialsHTML .= '<div class="row video-testimonials">';

    // $videotestimonialsHTML .= '<div class="card-columns section-video-testimonials">';
    
    if( have_rows('client_video_testimonial_items') ):  
        while ( have_rows('client_video_testimonial_items') ) : the_row();
        
        $numVideoTestimonials = get_sub_field('number_of_video_testimonials_to_display');
        $number_of_columns = get_sub_field('number_of_columns');

        if($numVideoTestimonials == 'All Video Testimonials'):
        
           $videotestimonial_args = array( 'post_type' => 'clients', 'posts_per_page' => -1 , 'orderby' => 'menu_order', /*'meta_key' => $meta_key,*/ 'order' => 'ASC'); 
           $videotestimonial_loop = new WP_Query( $videotestimonial_args );
           
            if(have_posts($videotestimonial_loop)):
            
             while ( $videotestimonial_loop->have_posts() ) : $videotestimonial_loop->the_post();
            
             
                $client_name = get_the_title();
                $client_id = get_the_ID();
                $client_logo = get_field('clientLogo');
                $industry_vertical = get_field('industry_vertical');
                $case_study = get_field('case_study');
                
               
                   if(have_rows('client_video_testimonial')):
                   while(have_rows('client_video_testimonial')) : the_row();
                        $video_title = get_sub_field('video_title');
                        $video = get_sub_field('video');
                        $video_description = get_sub_field('video_description');
                        $first_name = get_sub_field('first_name');
                        $last_name= get_sub_field('last_name');
                        $job_title= get_sub_field('job_title');
                      

                  
                    endwhile;
                endif;
            endwhile;//end query loop for all testimonials
            wp_reset_postdata();
        endif;
        elseif($numVideoTestimonials  == 'Select Video Testimonials'):
         
    

            //start client testimonials repeater
            if(have_rows('client_video_testimonials')):
                while ( have_rows('client_video_testimonials') ) : the_row();
                    
                    $client = get_sub_field('client');
                    $post = $client;
                    setup_postdata( $post );
                
                    
                    if(have_rows('client_video_testimonial', $post -> ID)):
                        while(have_rows('client_video_testimonial', $post -> ID)): the_row();
                            
                            $client_name = get_the_title($post -> ID);
                            $first_name = get_sub_field('first_name');
                            $last_name = get_sub_field('last_name');
                            $job_title = get_sub_field('job_title');
                            $video_thumbnail = get_sub_field('video_thumbnail');
                            $video = get_sub_field('video');
                            $video_title = get_sub_field('video_title');
                            $videoURL = get_sub_field('video_url');
                            //$video_description = get_sub_field('video_description');


                            $col_grid_container;

                            switch ($number_of_columns) {
                                case '1':
                                    $col_grid_container = '<div class="col-md-12 grid__item client-video-ct"">';
                                    break;
                                case '2':
                                    $col_grid_container = '<div class="col-md-6 grid__item client-video-ct"">';
                                    break;
                                case '3':
                                    $col_grid_container = '<div class="col-lg-4 col-md-6 grid__item client-video-ct"">';
                                    break;
                                case '4':
                                    $col_grid_container = '<div class="col-md-3 col-sm-6 grid__item client-video-ct"">';
                                    break;
                                default:
                                    $col_grid_container = '<div class="col-md-4 col-sm-6 grid__item client-video-ct"">';
                            }

                            //$videotestimonialsHTML .= '<div class="col-lg-4 col-md-4 col-sm-12 client-video-ct">';
                            $videotestimonialsHTML .= $col_grid_container;

                            $videotestimonialsHTML .= '<div class="card video-testimonial">';
                            $videotestimonialsHTML .= '<div class="entry-content">';
                           
                            
                            $videotestimonialsHTML .= '<a data-fancybox href="' . $videoURL . '">';
                            if( $video_thumbnail):
                                $videotestimonialsHTML .=  '<div class="img-ct"><img src=" ' . $video_thumbnail . '" alt="' . $first_name . ' ' . $last_name . ' - ' . $client_name . 'Testimonial Renegade"></div>';
                            endif;
                            
                            $videotestimonialsHTML .= '<div class="card-body">';

                            if($video_title):
                                $videotestimonialsHTML .= '<h5 class="card-title">' . $video_title . '</h5>';
                            endif;

                         
                                $videotestimonialsHTML .= '<div class="card-text">';
                        

                            if($first_name && $last_name):
                                $videotestimonialsHTML .= '<div class="name">' . $first_name . ' ' . $last_name . '</div><!-- .name -->';
                            endif;
                            if($job_title):
                                $videotestimonialsHTML .= '<div class="job-title">' . $job_title . '</div><!-- .job-title -->';
                            endif;

                            if($client_name):
                                $videotestimonialsHTML .= '<div class="company">' . $client_name . '</div><!-- .company -->';
                            endif;

                            if($video_description):
                                //$videotestimonialsHTML .= '<div class="video-description">' . $video_description . '</div>';
                            endif;

                            //PUT VIDEO TESTIMONIAL CONTENT LOOP HERE
                            $videotestimonialsHTML .= '</a></div><!-- .card-text --></div><!-- .card-body --></div><!-- .card --></div><!-- .entry-content --></div><!-- client-video-ct -->';
                        endwhile;
                      
                    endif;
                    wp_reset_postdata();
                endwhile;
            endif;//end client-testimonial repeater
        
        endif;//end if numTestimonials is Select
        
        $videotestimonialsHTML .= '</div><!-- .row-->';//end row
        
    endwhile;
endif;//end client testimonial items group

return $videotestimonialsHTML;
}
?>
