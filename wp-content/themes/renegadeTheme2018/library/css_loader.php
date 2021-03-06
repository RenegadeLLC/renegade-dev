<?php


add_action('wp_enqueue_scripts', 'renegade_stylesheets');

function renegade_stylesheets() {
	
	$scriptdirCSS = get_template_directory_uri() . '/library/css/';
	
	wp_register_style('renegade', $scriptdirCSS . 'renegade.css');
	wp_enqueue_style('renegade');
	
	wp_register_style('menu', $scriptdirCSS . 'jquery.mmenu.all.css');
	wp_enqueue_style('menu');

	wp_register_style('responsive', $scriptdirCSS . 'responsive.css');
	wp_enqueue_style('responsive');

	wp_register_style('fonts', $scriptdirCSS . 'fonts.css');
	wp_enqueue_style('fonts');
	
	wp_register_style('fontAwesome', $scriptdirCSS . 'font-awesome.css');
	wp_enqueue_style('fontAwesome');
	
	wp_register_style('colorsCSS', $scriptdirCSS . 'colors.css');
	//wp_enqueue_style('colorsCSS');
	
	wp_register_style('editorStyles', $scriptdirCSS . 'editor_styles.css');
	//wp_enqueue_style('editorStyles');


	
}




?>
