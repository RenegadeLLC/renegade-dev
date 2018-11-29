<?php

global $ajax_vars;
global $ra_loop;

add_action('wp_enqueue_scripts', 'renegade_scripts');

function renegade_scripts() {
	
	global $wp_query;
	
	$scriptdir = get_stylesheet_directory_uri() . '/library/js/';
	$functiondir = get_stylesheet_directory_uri() . '/library/functions/';
	
	// Load jQuery
	if ( !is_admin() ) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"), true);
	//wp_register_script('jquery', $scriptdir . 'jquery-1.11.3.min.js');
	wp_enqueue_script('jquery');
	}
		
	wp_localize_script( 'afp_script', 'afp_vars', array(
		'afp_nonce' => wp_create_nonce( 'afp_nonce' ),
		'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
		
		)
	);
	
	//PACKERY PLUGIN (FOR LAYOUTS)
	wp_register_script('infinitescroll', $scriptdir . 'infinite-scroll.pkgd.min.js');
	wp_enqueue_script( 'infinitescroll');	
	
	//ISOTOPE PLUGIN (FOR LAYOUTS)
	wp_register_script('isotope', $scriptdir . 'isotope.pkgd.min.js');
	wp_enqueue_script('isotope');
	
	//PACKERY
	wp_register_script('packery', $scriptdir . 'packery.pkgd.min.js');
	wp_enqueue_script('packery');
	
	//IMAGES LOADED
	wp_register_script('imagesLoaded', $scriptdir . 'imagesloaded.pkgd.min.js');
	wp_enqueue_script('imagesLoaded');

	//TOUCH EVENTS
	wp_register_script('jquery-touch-events', $scriptdir . 'jquery.mobile-events.min.js');
	wp_enqueue_script('jquery-touch-events');

	//UNORPHANIZE TEXT
	wp_register_script('jquery-unorphanize', $scriptdir . 'unorphanize.jquery.min.js');
	wp_enqueue_script('jquery-unorphanize');
	
	//AUTOCOMPLETE
	wp_enqueue_script('autocomplete', $scriptdir . 'jquery.auto-complete.min.js', array('jquery'));
	wp_enqueue_style('autocomplete.css', $scriptdir . 'jquery.auto-complete.css');

	//CUSTOM SCRIPTS
	wp_register_script('renegade-custom', $scriptdir . 'renegade-custom.js');
	wp_enqueue_script('renegade-custom');

	//EASING EQUATIONS FOR GREENSOCK PLUGIN	
	 wp_register_script('easing', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/easing/EasePack.min.js');
	//wp_register_script('easing', $scriptdir . 'greensock/EasePack.min.js');
	 wp_enqueue_script('easing');
	
	//CSS FOR GREENSOCK PLUGIN	
	 wp_register_script('css', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js');
	//wp_register_script('css',$scriptdir .  'greensock/CSSPlugin.min.js');
	wp_enqueue_script('css');

	//GREENSOCK TIMELINEMAX PLUGIN
	wp_register_script('timelineMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TimelineMax.min.js');
	//wp_register_script('tweenLite', $scriptdir . 'greensock/TimelineMax.min.js');
	wp_enqueue_script('timelineMax');

	//GREENSOCK TIMELINELIGHT PLUGIN
	//wp_register_script('timelineLite', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TimelineLite.min.js');
	//wp_register_script('tweenLite', $scriptdir . 'greensock/TimelineLite.min.js');
	//wp_enqueue_script('timelineMax');

	//GREENSOCK TWEENMAX PLUGIN
	wp_register_script('tweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js');
	//wp_register_script('tweenLite', $scriptdir . 'greensock/TweenMax.min.js');
	wp_enqueue_script('tweenMax');
	

	//GREENSOCK TWEENLITE PLUGIN
	wp_register_script('tweenLite', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js');
	//wp_register_script('tweenLite', $scriptdir . 'greensock/TweenLite.min.js');
	wp_enqueue_script('tweenLite');
	
	//SCROLLTO FOR GREENSOCK PLUGIN
	//wp_register_script('scrollTo', $scriptdir . 'greensock/ScrollToPlugin.min.js');
	wp_register_script('scrollTo', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/ScrollToPlugin.min.js');
	wp_enqueue_script('scrollTo');

	
	//SCROLLTO FOR GREENSOCK PLUGIN
	wp_register_script('slider', $scriptdir . 'greensock_slider.js');
	wp_enqueue_script('slider');
}
?>