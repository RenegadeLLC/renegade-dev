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
function custom_excerpt_length( $length ) {
	return 40;
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
// add_filter( 'comments_open', 'my_comments_open', 10, 2 ); // example of targeting specific posts
add_filter( 'comments_open', 'my_comments_open' );

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