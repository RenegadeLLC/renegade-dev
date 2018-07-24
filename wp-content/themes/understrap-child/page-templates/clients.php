<?php
/**
 * Template Name: Clients
 *
 * Based on understrap full width  /understrap/page-templates/fullwidthpage.php
 * Displays a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row jumbotron jumbotron-fluid">
			<!-- Placehoder -->
			<div class="col-md-6">
				<h2>Clients</h2>
				<h4>From strategic roadmaps to story-driven content marketing, it’s all Renegade Thinking to us.</h4>
			</div>
			<div class="col-md-6">
			</div>
		</div>

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?> <!-- Page Content -->
						<?php endwhile; // end of the loop. ?>
					</div>
					<div class="col-md-3"></div>
				</div>

					<?php
						// make sure to exclude renegade client post by ID number: 6274
						$rc_args = array('post_type' => 'clients', 'posts_per_page' => 16, 'post__not_in' => array(6274),  'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date');
						$wp_query = new WP_Query( $rc_args );
					?>
					<div class="row">
						<div class="col-md-12">
							<h2>A Selection of Clients<br>Past &amp; Present</h2>
						</div>

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="col-lg-3 col-md-4 col-sm-6">
						<?php get_template_part( 'loop-templates/content', 'client' ); ?>

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