<?php

/*
 Plugin Name: Renegade Slides
Plugin URI:
Description: Custom Post Type for Renegade Slides
Version: 1.0
Author: Anne Rothschild
Author URI:
*/
/********************************************************/
/*                CREATE ADMIN AREA                     */
/********************************************************/
$GLOBALS['RenegadePluginPath'] = plugins_url('/', __FILE__);

/****************************************************************************************************************/
/*                                        CREATE THE CUSTOM POST TYPE                                           */
/****************************************************************************************************************/


add_action( 'init', 'create_slide_post_type' );

function create_slide_post_type() {
	
	//CREATE SLIDE POST TYPE
	
	$labels = array(
			'name'               => _x( 'Slides', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Slide', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Renegade Slides', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Slide', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'slide', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Slide', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Slide', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Slide', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Slide', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Slides', 'your-plugin-textdomain' ),
			//'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
			//'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No slides found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No slides found in Trash.', 'your-plugin-textdomain' )
	);
	
	$args = array(
			'labels' => $labels,
			'singular_label' => __('Slide'),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'add_new_item' => __( 'Add New Slide' ),
			'add_new' => __( 'Add New' ),
			'show_in_menu' => true,
			'menu_position' => 16,
			'taxonomies' => array(),
			'show_in_admin_bar' => true,
			'capability_type' => 'post',
			//'register_meta_box_cb' => 'add_custom_meta_box',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title', 'sl_category')
	);

	register_post_type( 'slides' , $args );
	
	//CREATE SLIDE SHOW POST TYPE

	$labels = array(
			'name'               => _x( 'Slideshows', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Slideshow', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Renegade Slideshows', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Slideshow', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'slideshow', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Slideshow', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Slideshow', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Slideshow', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Slideshow', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Slideshows', 'your-plugin-textdomain' ),
			//'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
			//'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No slideshows found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No slideshows found in Trash.', 'your-plugin-textdomain' )
	);
	
	$args = array(
			'labels' => $labels,
			'singular_label' => __('Slideshow'),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'add_new_item' => __( 'Add New Slideshow' ),
			'add_new' => __( 'Add New' ),
			'show_in_menu' => 'edit.php?post_type=slides',
			'menu_position' => 7,
			'taxonomies' => array(),
			'show_in_admin_bar' => true,
			'capability_type' => 'post',
			//'register_meta_box_cb' => 'add_custom_meta_box',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title', 'sld_category')
	);
	
	register_post_type( 'slideshows' , $args );
}

/****************************************************************************************************************/
/*                              CREATE THE CUSTOM COLUMNS FOR THE POST TYPE                                      */
/****************************************************************************************************************/



//add_filter( 'manage_slide_columns', 'set_custom_slide_columns' );

add_filter("manage_slides_posts_columns", "add_new_slide_columns");

function add_new_slide_columns($columns) {
	unset(  $columns['author'] );
	//$columns['slide_name'] = 				__( 'Slide Name', 'your_text_domain' );
	$columns['sl_slide_category'] = 				__( 'Category', 'your_text_domain' );
	//$columns['sl_publication'] = 		__( 'Publication', 'your_text_domain' );
	//$columns['sl_date'] = 				__( 'Date Published', 'your_text_domain' );
//	$columns['sl_url'] = 				__( 'Slide URL', 'your_text_domain' );
	//$columns['sl_blurb'] = 				__( 'Blurb', 'your_text_domain' );
	
	return $columns;
}

/****************************************************************************************************************/
/*                              MAKE COLUMN SORTABLE BY CLIENT NAME                                      */
/****************************************************************************************************************/
add_filter( 'manage_edit-slides_sortable_columns', 'sortable_sl_column' );

function sortable_sl_column( $sl_columns ) {
	$sl_columns['title'] = 'title';
	$sl_columns['sl_slide_category'] = 'sl_slide_category';
	//$sl_columns['sl_date'] = 'sl_date';
	//$sl_columns['sl_author'] = 'sl_author';
	//To make a column 'un-sortable' remove it from the array
	//unset($bg_columns['date']);

	return $sl_columns;
}


/****************************************************************************************************************/
/*                              LOAD CLIENT DATA PREVIOUSLY ENTERED                                      */
/****************************************************************************************************************/

//add_action("manage_posts_custom_column",  "slide_custom_columns");
add_action("manage_posts_custom_column", "slide_custom_columns");

function slide_custom_columns($sl_column){
	global $post;
	switch ($sl_column)
	{
				
		case "sl_slide_category":
			//$custom = get_post_custom();
			$RHcategory = get_field('sl_slide_category');
			
			if( $RHcategory ) {
				echo($RHcategory);
			}
			break;

	}
}


function sl_title_text_input ( $title ) {
	if ( get_post_type() == 'slides' ) {
		$title = __( 'Enter the slide title here' );
	}
	return $title;
} // End title_text_input()
add_filter( 'enter_title_here', 'sl_title_text_input' );
