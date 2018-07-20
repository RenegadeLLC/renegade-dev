<?php
/**
 * Partial template for newsletter content list item
 *
 * @package understrap
 */

$rn_title = get_the_title( $post->ID );
$rn_date = get_field('rn_date', $post -> ID);
$rn_thumbnail_image= get_field('rn_banner', $post -> ID);
$rn_link = get_permalink($post -> ID);
$rn_introduction= get_field('rn_introduction' , $post -> ID);
$rn_banner = get_field('rn_banner', $post -> ID);
$rn_size = "half";

$newsletter_html = '';
$newsletter_html .= '';
$newsletter_html .= '<a href="' . $rn_link . '">';
$newsletter_html .= '<div class="date">' . $rn_date . '</div>';
$newsletter_html .= '<div>' . wp_get_attachment_image($rn_banner, $rn_size ) . '</div>';
$newsletter_html .= '<div class="card-excerpt">' . $rn_introduction . '</div>';

?>

<article <?php post_class();?> id="post-<?php the_ID();?>">

<header class="entry-header">
	<div class="post-label-ct">NEWSLETTER</div>
	<?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
'</a></h3>');?>

	<?php if ('post' == get_post_type()): ?>

		<div class="entry-meta">
			<?php understrap_posted_on();?>
		</div><!-- .entry-meta -->

	<?php endif;?>

</header><!-- .entry-header -->


<div class="entry-content">

	<?php echo $newsletter_html ?>

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
