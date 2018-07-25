<?php
/**
 * Single post partial template.
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
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php 
			// the_content(); 
			echo $newsletter_html;
		?>

		<?php understrap_post_nav(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
