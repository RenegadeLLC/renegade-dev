<?php
/**
 * Partial template for blog content list item
 *
 * @package understrap
 */

?>

<article <?php post_class();?> id="post-<?php the_ID();?>">

<header class="entry-header">

	<?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
'</a></h3>');?>

	<?php if ('post' == get_post_type()): ?>

		<div class="entry-meta">
			<?php understrap_posted_on();?>
		</div><!-- .entry-meta -->

	<?php endif;?>

</header><!-- .entry-header -->

<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>

<div class="entry-content">

	<?php
the_excerpt();
?>

	<?php
wp_link_pages(array(
'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
'after' => '</div>',
));
?>

</div><!-- .entry-content -->

<footer class="entry-footer">

	<?php understrap_entry_footer();?>

</footer><!-- .entry-footer -->

</article><!-- #post-## -->