<?php



function all_bios(){
    $the_query = new WP_Query(array(
        'post_type' => 'people', 
        // 'posts_per_page' => 6, 
        'post_status' => 'publish', 
        'order' => 'ASC', 
        'orderby' => 'date',
        // 'paged' => $paged
    ));
    $bioHTML = '';

    if ( $the_query->have_posts() ): 


        $bioHTML .= '<div class="row leadership-team">';
        // $bioHTML .= '<div class="col-md-12 leadership-team-title"><h2>Leadership Team</h2></div>';
        while ( $the_query->have_posts() ) : $the_query->the_post();
        // $post = $the_query->the_post();
        $headline_background_color = get_field('headline_background_color');
        $rp_link = get_permalink($post -> ID);
        $rp_last_name = get_the_title( $post->ID );
        $rp_first_name = get_field('rp_first_name');
        $rp_job_title = get_field('rp_job_title');
        $rp_bio_image = get_field('rp_bio_image');
        $rp_size = "full";
        $rp_social_channel = get_field('rp_social_channel');
        $rp_social_icon;
        $rp_social_channel_url = get_field('rp_social_channel_url');
        $rp_bio_intro = get_field('rp_bio_intro');
        $rp_biography = get_field('rp_biography');
        $rp_fun_fact = get_field('rp_fun_fact');
        $rp_fun_fact_image = get_field('rp_fun_fact_image');
        $rp_random_image = get_field('rp_random_image');
        $rp_email_address = get_field('rp_email_address');
        $rp_contact_link = get_field('rp_contact_link');
                
        $people_html = '';
        $people_html .= '<a href="' . $rp_link . '">';
        $people_html .= '<div class="people-bio-image"><img src="' . $rp_bio_image . '" alt="' .  $rp_first_name . ' ' . $rp_last_name .'"></div>';	
        $people_html .= '<div class="people-bio-info"><h3>' . $rp_first_name . ' ' . $rp_last_name .'</h3>';
        $people_html .= '<h5 class="gray">' . $rp_job_title . '</h5></div></a>';

        // $bioHTML .= '<h2>A post</h2>';
        // $people_html .= '<div class="people-bio-image"><img src="' . $rp_bio_image . '" alt="' .  $rp_first_name . ' ' . $rp_last_name .'"></div>';
        $bioHTML .= '<div class="people-bio col-md-4 col-sm-6">';

        $bioHTML .= $people_html;


        $bioHTML .= '</div>';
        endwhile; // end of the loop.
        wp_reset_postdata();
        // $bioHTML .= '</div>';
        $bioHTML .= '</div>';
    endif;

    return $bioHTML;
}

