<?php



function all_bios(){  
    $feedHTML = '';
    $rn_args = array( 'post_type' => 'people', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'date', 'paged' => $paged  );
    $wp_query = new WP_Query( $rn_args );
    
    return $feedHTML;
}

