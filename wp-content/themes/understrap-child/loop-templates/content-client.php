<?php
/**
 * Download post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */
$client_name = get_the_title();
$client_id = get_the_ID();
$client_logo = get_field('clientLogo');
$industry_vertical = get_field('industry_vertical');
$case_study = get_field('case_study');
$case_study_url = get_field('case_study_url');
?>

<article <?php post_class();?> id="post-<?php the_ID();?>" style="background-color:white;">

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
