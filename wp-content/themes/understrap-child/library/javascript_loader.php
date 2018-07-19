<?php

global $ajax_vars;
global $ra_loop;

add_action('wp_enqueue_scripts', 'renegade_scripts');
//Making jQuery Google API

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
	
	wp_register_script('infinitescroll', 'https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js' );
	wp_enqueue_script( 'infinitescroll');	

	//EASING EQUATIONS FOR GREENSOCK PLUGIN	
	wp_register_script('easing', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/easing/EasePack.min.js');
	//wp_register_script('easing', $scriptdir . 'EasePack.min.js');
	wp_enqueue_script('easing');
	
	//CSS FOR GREENSOCK PLUGIN	
	wp_register_script('css', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js');
	//wp_register_script('css',$scriptdir .  'CSSPlugin.min.js');
	wp_enqueue_script('css');

	//GREENSOCK TWEENLITE PLUGIN
	wp_register_script('tweenLite', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js');
	//wp_register_script('tweenLite', $scriptdir . 'TweenLite.min.js');
	wp_enqueue_script('tweenLite');
	
	//SCROLLTO FOR GREENSOCK PLUGIN
	wp_register_script('scrollTo', $scriptdir . 'ScrollToPlugin.min.js');
	wp_enqueue_script('scrollTo');
	
	wp_register_script('lazyLoad', $scriptdir . 'jquery.bttrlazyloading.js');
	wp_enqueue_script('lazyLoad');
	

	//ISOTOPE PLUGIN (FOR LAYOUTS)
	wp_register_script('isotope', $scriptdir . 'isotope.pkgd.min.js');
	wp_enqueue_script('isotope');
	
	//PACKERY
	wp_register_script('packery', $scriptdir . 'packery-mode.pkgd.min.js');
	wp_enqueue_script('packery');
	
	//LAYOUT EXTENSION TO ISOTOPE
	// wp_register_script('layoutModes', $scriptdir . 'layout-mode.js');
	// wp_enqueue_script('layoutModes');
	
	//IMAGES LOADED
	wp_register_script('imagesLoaded', $scriptdir . 'imagesloaded.pkgd.min.js');
	wp_enqueue_script('imagesLoaded');


	//TOUCH EVENTS
	wp_register_script('jquery-touch-events', $scriptdir . 'jquery.mobile-events.min.js');
	wp_enqueue_script('jquery-touch-events');

	//CUSTOM SCRIPTS
	wp_register_script('renegade-custom', $scriptdir . 'renegade-custom.js');
	wp_enqueue_script('renegade-custom');
	
	//LAYOUT EXTENSION TO ISOTOPE
	//wp_register_script('DHF', $scriptdir . 'Draggable.js');
	//wp_enqueue_script('DHF');
}
?>