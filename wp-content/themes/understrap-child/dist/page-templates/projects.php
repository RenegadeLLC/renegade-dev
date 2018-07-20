<?php
/**
 * Template Name: Projects (Case Studies)
 * 
 *
 * Based on understrap full width  /understrap/page-templates/fullwidthpage.php
 * Displays a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$paged = get_query_var('paged');
$rn_args = array( 'post_type' => 'projects', 'posts_per_page' => 8, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged  );
$wp_query = new WP_Query( $rn_args );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="content-section row hero">
				<!-- Placehoder for hero area -->
				<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
		</div>

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<div class="row">
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="col-lg-4 col-md-6">
						<?php get_template_part( 'loop-templates/content', 'project' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :

							comments_template();

						endif;
						?>
						</div>

					<?php endwhile; // end of the loop. ?>
					</div>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>