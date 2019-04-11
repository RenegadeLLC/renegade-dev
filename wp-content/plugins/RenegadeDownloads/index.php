<?php

/*
 Plugin Name: Renegade Downloads
Plugin URI:
Description: Custom Post Type for Renegade Downloads
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


add_action( 'init', 'create_Download_post_type' );

function create_Download_post_type() {
	
	$labels = array(
			'name'               => _x( 'Downloads', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Download', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Renegade Downloads', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Download', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'Download', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Download', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Download', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Download', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Download', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Downloads', 'your-plugin-textdomain' ),
			//'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
			//'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No Downloads found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No Downloads found in Trash.', 'your-plugin-textdomain' )
	);
	
	$args = array(
			'labels' => $labels,
			'singular_label' => __('Download'),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'add_new_item' => __( 'Add New Download' ),
			'add_new' => __( 'Add New' ),
			'show_in_menu' => true,
			'menu_position' => 24,
			//'taxonomies' => array('category', 'post_tag'),
			'show_in_admin_bar' => true,
			'capability_type' => 'post',
			//'register_meta_box_cb' => 'add_custom_meta_box',
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'resources-story-hub/Downloads/Download', 'with_front'=> false ),
			'supports' => array('thumbnail', 'excerpt', 'title', 'revisions', 'editor', 'tags', 'categories', 'comments', 'archives'),
			'has_archive' => true,
	       'publicly_queryable'  => true
			
				
	);

	register_post_type( 'Downloads' , $args );
}

/****************************************************************************************************************/
/*                              CREATE THE CUSTOM COLUMNS FOR THE POST TYPE                                      */
/****************************************************************************************************************/



//add_filter( 'manage_Download_columns', 'set_custom_Download_columns' );
/*
function add_new_Download_columns( $columns ) {
	unset(  $columns['author']  );
	unset(  $columns['date']  );
	
	return array_merge ( $columns, array (
			$columns['rdn_guest'] = 				__( 'Download Author', 'your_text_domain' ),
			$columns['rdn_publication'] = 		__( 'Publication', 'your_text_domain' ),
			$columns['rdn_date'] = 				__( 'Date Published', 'your_text_domain' ),
			$columns['rdn_url'] = 				__( 'Download URL', 'your_text_domain' ),
	) );
	

}
*/


function add_new_Download_columns($columns) {
	unset(  $columns['author']  );
//	unset(  $columns['date']  );
	$columns['rdn_guest'] = 				__( 'Author', 'your_text_domain' );
//	$columns['rdn_publication'] = 		__( 'Publication', 'your_text_domain' );
	$columns['rdn_date'] = 				__( 'Date Published', 'your_text_domain' );
	$columns['rdn_url'] = 				__( 'Download URL', 'your_text_domain' );
	
	return $columns;
}
add_filter("manage_Downloads_posts_columns", "add_new_Download_columns");

/****************************************************************************************************************/
/*                              MAKE COLUMNs SORTABLE BY CUSTOM META DATA                                     */
/****************************************************************************************************************/
add_action( 'pre_get_posts', 'custom_rdn_orderby' );
function custom_rdn_orderby( $query ) {
	if( ! is_admin() )
		return;
		
		$orderby = $query->get( 'orderby');
		
	if ( 'rdn_date' == $orderby ) {
			$query->set('meta_key','rdn_date');
			$query->set('orderby','meta_value_num');
		}
		elseif ( 'rdn_guest' == $orderby ) {
			$query->set('meta_key','rdn_guest');
			$query->set('orderby','meta_value');
		}
}


/****************************************************************************************************************/
/*                              MAKE COLUMN SORTABLE BY CLIENT NAME                                      */
/****************************************************************************************************************/
add_filter( 'manage_edit-Downloads_sortable_columns', 'sortable_rdn_column' );

function sortable_rdn_column( $rdn_columns ) {
	$rdn_columns['title'] = 'title';
	//$rdn_columns['rdn_publication'] = 'rdn_publication';
	$rdn_columns['rdn_date'] = 'rdn_date';
//	$rdn_columns['rdn_guest'] = 'rdn_guest';
	//To make a column 'un-sortable' remove it from the array
	unset($rdn_columns['date']);

	return $rdn_columns;
}


/****************************************************************************************************************/
/*                              LOAD CLIENT DATA PREVIOUSLY ENTERED                                      */
/****************************************************************************************************************/

//add_action("manage_posts_custom_column",  "Download_custom_columns");


function Download_custom_columns($column){

	global $post;
	switch ($column)
	{
				
		case 'rdn_guest':
			//$custom = get_post_custom();
			
			$RAauthor = get_field('rdn_guest');
			
			if( $RAauthor ) {
				echo($RAauthor);
				//echo get_post_meta ( $post_id, 'rdn_guest', true );
				//echo('wtf');
			}
			break;
				
		
				
			case "rdn_date":
				$RAdate = get_field('rdn_date');
				echo($RAdate);
			break;
			
			case "rdn_url":
				$RAurl = get_field('rdn_url');
				if(  $RAurl ) {
					echo('<a href="' . $RAurl . '" target="_blank">' . $RAurl . '</a>');
				}
				break;


	}

}

add_action("manage_Downloads_posts_custom_column", "Download_custom_columns");
/****************************************************************************************************************/
/*                              ADD EDIT LINKS TO CLIENT NAME COLUMN                                      */
/****************************************************************************************************************/




function rdn_title_text_input ( $title ) {
	if ( get_post_type() == 'Downloads' ) {
		$title = __( 'Enter the Download title here' );
	}
	return $title;
} // End title_text_input()
add_filter( 'enter_title_here', 'rdn_title_text_input' );

/****************************************************************************************************************/
/*                              ADD TAXONOMY TO POST TYPE                                     */
/****************************************************************************************************************/


function rdn_taxonomies() {

	$taxonomies = array(
		array(
	 		'slug'         => 'Download_categories',
			'single_name'  => 'Download Category',
			'plural_name'  => 'Download Categories',
			'post_type'    => 'Downloads',
			//	'rewrite'      => array( 'slug' => 'Download_category' ),
	),
		
	array(
			'slug'         => 'Download_tags',
			'single_name'  => 'Download Tags',
			'plural_name'  => 'Download Tags',
			'post_type'    => 'Downloads',
			//	'rewrite'      => array( 'slug' => 'department' ),
	),

	);

	foreach( $taxonomies as $taxonomy ) {
		$labels = array(
				'name' => $taxonomy['plural_name'],
				'singular_name' => $taxonomy['single_name'],
				'search_items' =>  'Search ' . $taxonomy['plural_name'],
				'all_items' => 'All ' . $taxonomy['plural_name'],
				'parent_item' => 'Parent ' . $taxonomy['single_name'],
				'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
				'edit_item' => 'Edit ' . $taxonomy['single_name'],
				'update_item' => 'Update ' . $taxonomy['single_name'],
				'add_new_item' => 'Add New ' . $taxonomy['single_name'],
				'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
				'menu_name' => $taxonomy['plural_name']
		);

		$rewrite = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
		$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;

		register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], array(
		'hierarchical' => $hierarchical,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => $rewrite,
		//'public' => false
		));
	}

	//ADD ABILITIY TO ASSIGN A CATEGORY TO AN IMAGE ATTACHMENT

	register_taxonomy_for_object_type( 'category', 'attachments' );
}
add_action( 'init', 'rdn_taxonomies' );

