<?php

function make_logo_grid(){  
    $clientsHTML = '';

    $clientsHTML .= '<div class="client-logo-grid row">';
    
    if( have_rows('client_logo_grid') ):
    $i=1;
    
    while ( have_rows('client_logo_grid') ) : the_row();

    $numLogos = get_sub_field('number_of_logos_to_display');
    
    if($numLogos == 'All Logos'):

        $rc_args = array( 'post_type' => 'clients', 'posts_per_page' => -1 , 'orderby' => 'menu_order', /*'meta_key' => $meta_key,*/ 'order' => 'ASC');
        $rc_loop = new WP_Query( $rc_args );
        
        if(have_posts($rc_loop)):
        while ( $rc_loop->have_posts() ) : $rc_loop->the_post();
            $client_name = get_the_title();
            $client_id = get_the_ID();
            $client_logo = get_field('clientLogo');
            $client_logo_color = get_field('client_logo_color');
            $industry_vertical = get_field('industry_vertical');
            $case_study = get_field('case_study');
            $case_study_url = get_field('case_study_url');
            //$industry_vertical_name = $industry_vertical -> name;
            if($client_name != 'Renegade' && $client_logo):
                  $clientsHTML .= '<div class="client-grid-item col-lg-15 col-md-4 col-sm-6 col-xs-6';
              
                $clientsHTML .= '">';
                
                if($case_study == 'Yes'):
                    $clientsHTML .= '<a href="' . $case_study_url . '"><div class="client-logo has-case">';

                else:
                    $clientsHTML .= '<div class="client-logo">';
                endif;
                
                if($case_study == 'Yes'):
                   // $clientsHTML .= '<img src="' . $client_logo_color. '" alt="' . $client_name . '"></div></div>';
                    $clientsHTML .= '<img src="' . $client_logo . '" alt="' . $client_name . '"></div></div>';
           
                else:
                    $clientsHTML .= '<img src="' . $client_logo . '" alt="' . $client_name . '"></div></div>';
                endif;

                if($case_study == 'Yes'):
                    $clientsHTML .= '</a>';
                endif;
            endif;
            $i++;
            wp_reset_postdata();
        endwhile;
    endif;//end main query for all
    elseif($numLogos == 'Select Logos'):
  $i = 1;
        if(have_rows('client_logo')):
            while ( have_rows('client_logo') ) : the_row();   
                $client = get_sub_field('client');
                $post = $client;
                setup_postdata( $post );
                $client_logo = get_field('clientLogo', $post);
                $case_study = get_field('case_study', $post);
                
                if($client_name != 'Renegade' && $client_logo):
                    $clientsHTML .= '<div class="client-grid-item col-lg-15 col-md-4 col-sm-6 col-xs-6';
                
                  $clientsHTML .= '">';
                  
                  if($case_study == 'Yes'):
                      $clientsHTML .= '<a href="' . $case_study_url . '"><div class="client-logo has-case">';
  
                  else:
                      $clientsHTML .= '<div class="client-logo">';
                  endif;
                  
                  if($case_study == 'Yes'):
                    //$clientsHTML .= '<img src="' . $client_logo_color. '" alt="' . $client_name . '"></div></div>';
                    $clientsHTML .= '<img src="' . $client_logo . '" alt="' . $client_name . '"></div></div>';
             
                else:
                    $clientsHTML .= '<img src="' . $client_logo . '" alt="' . $client_name . '"></div></div>';
                endif;
  
                  if($case_study == 'Yes'):
                      $clientsHTML .= '</a>';
                  endif;
              endif;
               $i++;
                wp_reset_postdata();
            endwhile;
        endif;
    
    endif;
    
    
    $clientsHTML .= '</div>';//end grid
  
    endwhile;
    endif;
    return $clientsHTML;
}

