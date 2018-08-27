<?php

function build_subscribe_form($subscribe_form_shortcode, $headlineHTML){  
    $subscription_form_copy = get_field('subscription_form_copy', 'option');
    $subscribeHTML = '';
   
    $subscribeHTML .= '<div class="col-lg-6 col-sm-12 float-left">' . $headlineHTML . '<br>' . $subscription_form_copy . '</div>';
    $subscribeHTML .= '<div class="col-lg-6 col-sm-12 float-left">' . do_shortcode($subscribe_form_shortcode) . '</div>';
    
    return $subscribeHTML;
}

?>