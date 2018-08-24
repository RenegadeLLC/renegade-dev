<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

?>

<div class="wrapper" id="error-404-wrapper">



<?php 
$the_page    = null;
$errorpageid = get_option( '404pageid', 0 ); 
if ($errorpageid !== 0) {
    // Typecast to an integer
    $errorpageid = (int) $errorpageid;
    // Get our page
    $the_page = get_page($errorpageid);
}
?>

<div id="four-oh-four">
    <?php if ($the_page == NULL || isset($the_page->post_content) && trim($the_page->post_content == '')): ?>
        <h1>There was an error and nobody defined a custom 404 page message, so you're seeing this instead.</h1>
    <?php else: ?>
	<?php echo apply_filters( 'the_content', $the_page->post_content ); ?>
    <?php endif; ?>
</div>



<?php get_footer(); ?>
