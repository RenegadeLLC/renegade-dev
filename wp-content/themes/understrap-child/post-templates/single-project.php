<?php
/**
 * Single project (case study) post partial template for download.
 *
 * @package understrap
 */


$project_title = get_field('project_title', $post -> ID);
$client_name = get_field('client_name', $post -> ID);
$client = get_the_title($post -> ID);
$case_url = get_permalink();

$service_type = get_field('service_type', $post -> ID);
$industry_vertical = get_field('industry_vertical', $post -> ID);
$project_thumbnail_image = get_field('project_thumbnail_image', $post -> ID);
$summary_headline = get_field('summary_headline', $post -> ID);
$summary_text = get_field('summary_text', $post -> ID);

$caseHTML .= '';
$caseHTML .= '<a href="' . $case_url . '">';
$caseHTML .= '<div><img src="'. $project_thumbnail_image . '" title="' . $client . ': ' . $project_title . '"></div>';
$caseHTML .= '<div>' . $client . '<br>' . $project_title . '</div>';
$caseHTML .= '</a>';

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
			echo $caseHTML;
		?>

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
