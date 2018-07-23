<?php
/**
 * Template Name: People Page
 *
 * Template for an archive page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$paged = get_query_var('paged');
$rn_args = array( 'post_type' => 'people', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'date', 'paged' => $paged  );
$wp_query = new WP_Query( $rn_args );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row jumbotron jumbotron-fluid">
			<!-- Placehoder -->
			<div class="col">
				<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
			</div>
		</div>

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php if ( have_posts() ) : ?>

					<div class="row leadership-team">
						<div class="col-md-12 leadership-team-title"><h2>Leadership Team</h2></div>
						<?php while ( have_posts() ) : the_post(); ?>
						<div class="col-md-4 col-sm-6">
								<?php get_template_part( 'loop-templates/content', 'people' ); ?>
						</div>
						<?php endwhile; // end of the loop. ?>
					</div>
						<?php endif; ?>
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>