<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_stylesheet_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

// RENEGADE FUNCTIONS

// Add page link attributes for posts page
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="page-link"';
}
/**
 * Use 'the_posts' filter to move selected post on beginning of post array 
 * Usage:
 * <a href="<?php esc_url( add_query_arg( array('psel' => get_the_ID() ) ) ) ?>">\
 * <?php the_thumbnail() ?>
 * </a>
*/

// get the index
function get_selected_post_index() {
    $selID = filter_input(INPUT_GET, 'psel', FILTER_SANITIZE_NUMBER_INT);
    if ($selID) {
        global $wp_query;
        return array_search($selID, wp_list_pluck($wp_query->posts, 'ID'), true);
    }
    return false;
}

add_filter('the_posts', function($posts, $wp_query) {

// nothing to do if not main query or there're no posts or no post is selected
if ($wp_query->is_main_query() && ! empty($posts) && ($i = get_selected_post_index())) {
        $sel = $posts[$i]; // get selected post object
        unset($posts[$i]); // remove it from posts array
        array_unshift($posts, $sel); // put selected post to the beginning of the array
    }
    return $posts;
}, 99, 2);


/********  DEFINE FILE PATHS ********/

define('TEMPLATEPATH', get_stylesheet_directory());

define('LIBRARY', TEMPLATEPATH . '/library');
define('IMAGES', TEMPLATEPATH . '/library/images');
define('FUNCTIONS', get_stylesheet_directory() . '/library/functions');

/*****ADD FILES THAT LOAD JAVASCRIPT AND CSS *****/
require_once( get_stylesheet_directory() . '/library/javascript_loader.php' );
// require_once( get_stylesheet_directory() . '/library/css_loader.php' );
require_once( get_stylesheet_directory() . '/library/functions_loader.php' );
// require_once( get_stylesheet_directory() . '/includes/theme-styles.php' );


// Save ACF custom field to date-time post
function change_date( $post_id ) {
    $post_type = get_post_type();
    global $acfDate;
    if($post_type == 'newsletters'):
        $acfDate = get_field('rn_date', $post_id);
    elseif($post_type == 'articles'):
        $acfDate = get_field('ra_date', $post_id);
    elseif($post_type == 'podcasts'):
        $acfDate = get_field('podcast_date', $post_id);
    elseif($post_type == 'posts'):
    $acfDate = get_the_date();
    endif;
    
    //Test if you receive the data field correctly:
    //echo $acfDate;
    //exit (-1);
    $my_post = array();
    $my_post['ID'] = $post_id;
    $my_post['post_date'] = $acfDate;
    wp_update_post( $my_post );
}

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

// enqueue_scripts: make sure to include ajaxurl, so we know where to send the post request
// function dt_add_main_js(){
    
//     wp_register_script( 'main-js', get_stylesheet_directory_uri() . '/library/js/load-more-script.js', array( 'jquery' ), '1.0', false );
//     wp_enqueue_script( 'main-js' );
//     wp_localize_script( 'main-js', 'headJS', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'templateurl' => get_stylesheet_directory(), 'posts_per_page' => get_option('posts_per_page') ) );
    
// }
// add_action( 'wp_enqueue_scripts', 'dt_add_main_js', 90);

/***** ADD NEW MENUS TO THEME ********/

function register_my_menus() {
    register_nav_menus(
        array(
            'footer' => __( 'Footer' ),
            'mobile' => __( 'Mobile' ),
            'utility' => __( 'Utility' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );


/***** ADD ACF STYLING ********/

function load_custom_wp_admin_style() {
    wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri() . '/css/custom-editor-style.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
    
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Header Settings',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Settings',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Social Media Links',
        'menu_title'	=> 'Social Media Links',
        'parent_slug'	=> 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Subscription Form',
        'menu_title'	=> 'Subscription Form',
        'parent_slug'	=> 'theme-general-settings',
    ));
    
}

// limit excerpt length
// for post types that don't use content field for excerpts
// apply "limit_text" function 
function custom_excerpt_length( $length ) {

    global $post;

    if($post->post_type == 'post'):
        return 60;
    elseif($post->post_type == 'podcasts'):   
        return 40;
    elseif($post->post_type == 'downloads'):  
        return 60;
    endif;
    // newsletters use "limit_text' function  in loop-templates/content-newsletter.php
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// overwrite post excerpts more link
if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function understrap_all_excerpts_get_more_link( $post_excerpt ) {
		return $post_excerpt . '...';
	}
}

// override post next/prev nav
function understrap_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    // exception to show first name on leadership pages
    $prev_first_name = get_post_meta( $previous->ID, 'rp_first_name', $single = true);
    $next_first_name = get_post_meta( $next->ID, 'rp_first_name', $single = true);

    if ( ! $next && ! $previous ) {
        return;
    }
    ?>
    <nav class="container navigation post-navigation">
        <h2 class="sr-only"><?php _e( 'Post navigation', 'understrap' ); ?></h2>
        <div class="row nav-links justify-content-between">
            <?php

                if ( get_previous_post_link() ) {
                    previous_post_link( '<div class="nav-previous">%link</div>', _x( '<i class="fa fa-angle-left"></i>&nbsp;<span class="nav-previous-alt">PREV</span><span class="nav-previous-text">' . $prev_first_name . '&nbsp;%title</span>', 'Previous post link', 'understrap' ) );
                }
                if ( get_next_post_link() ) {
                    next_post_link( '<div class="nav-next">%link</div>',     _x( '<span class="nav-next-alt">NEXT</span><span class="nav-next-text">' . $next_first_name . '&nbsp;%title</span>&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'understrap' ) );
                }
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}



// override posted on function
function understrap_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    // if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    //     $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s) </time>';
    // }
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );
    $posted_on = sprintf(
        esc_html_x( '%s', 'post date', 'understrap' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );
    $byline = sprintf(
        esc_html_x( 'By %s', 'post author', 'understrap' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );
    echo '<span class="posted-on">' . $posted_on . '</span><br><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}

// open comments for specific posts and post types
// add_filter( 'comments_open', 'my_comments_open', 10, 2 );

function my_comments_open( $open, $post_id ) {
    $post = get_post( $post_id );
    if ( 
        'podcasts' == $post->post_type || 
        'post' == $post->post_type
    ) {
        $open = true;
    }
    return $open;
}

// add a shortcode to display default search form
add_shortcode('wpbsearch', 'get_search_form');

// find post titles for autocomplete search input field
add_action('wp_ajax_nopriv_get_listing_names', 'ajax_listings');
add_action('wp_ajax_get_listing_names', 'ajax_listings');
 
function ajax_listings() {
	global $wpdb; //get access to the WordPress database object variable
 
	//get names of all posts
	$name = $wpdb->esc_like(stripslashes($_POST['name'])).'%'; //escape for use in LIKE statement
	$sql = "select post_title 
		from $wpdb->posts 
		where post_title like %s 
        and post_type='job_listing' and post_status='publish'";
        
    $sql = "
    SELECT * FROM $wpdb->posts
    WHERE post_title LIKE %s
    AND post_type IN ('post', 'newsletters', 'podcasts', 'downloads')
    AND post_status = 'publish'
    ";
 
	$sql = $wpdb->prepare($sql, $name);
	
	$results = $wpdb->get_results($sql);
 
	//copy the business titles to a simple array
	$titles = array();
	foreach( $results as $r )
		$titles[] = addslashes($r->post_title);
		
	echo json_encode($titles); //encode into JSON format and output
 
	die(); //stop "0" from being output
}

// reformat archive headers
add_filter( 'get_the_archive_title', function ( $title ) {

	if ( is_category() ) {
		/* translators: Category archive title. 1: Category name */
		$title = sprintf( __( 'Category: %s' ), '<span class="archive-name">' . single_cat_title( '', false ) . '</span>' );
	} elseif ( is_tag() ) {
		/* translators: Tag archive title. 1: Tag name */
        $title = sprintf( __( 'Tag: %s' ), '<span class="archive-name">' . single_tag_title( '', false ) . '</span>');
	} elseif ( is_author() ) {
		/* translators: Author archive title. 1: Author name */
		$title = sprintf( __( 'Author: %s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		/* translators: Yearly archive title. 1: Year */
		$title = sprintf( __( 'Year: %s' ), '<span class="archive-name">' .  get_the_date( _x( 'Y', 'yearly archives date format' ) ) . '</span>');
	} elseif ( is_month() ) {
		/* translators: Monthly archive title. 1: Month name and year */
		$title = sprintf( __( 'Month: %s' ), '<span class="archive-name">' .  get_the_date( _x( 'F Y', 'monthly archives date format' ) ) . '</span>');
	} elseif ( is_day() ) {
		/* translators: Daily archive title. 1: Date */
		$title = sprintf( __( 'Day: %s' ), '<span class="archive-name">' .  get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) . '</span>');
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title' );
		}
	} elseif ( is_post_type_archive() ) {
		/* translators: Post type archive title. 1: Post type name */
        $title = sprintf( __( 'Archives: %s' ), '<span class="archive-name">' .  post_type_archive_title( '', false )  . '</span>');
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, '<span class="archive-name">' .  single_term_title( '', false ) .'</span>');
	} else {
		$title = __( 'Archives' );
	}

    return $title;

});

// DISABLE IMAGE ATTACHMENT PAGES

function myprefix_redirect_attachment_page() {
	if ( is_attachment() ) {
		global $post;
		if ( $post && $post->post_parent ) {
			wp_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
			exit;
		} else {
			wp_redirect( esc_url( home_url( '/' ) ), 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'myprefix_redirect_attachment_page' );

//HIDE TAG PAGES

add_filter( 'register_taxonomy_args', 'my_tags_disable', 10, 3 );

function my_tags_disable( $args, $name, $object_type ) {
    // if it's no the "tag" taxonomy, don't make changes
    if ( 'post_tag' !== $name ) {
        return $args;
    }

    // override the specific arguments to remove the archive from the front-end
    $args['public'] = FALSE;
    $args['publicly_queryable'] = FALSE;

    // return the modified arguments
    return $args;
}