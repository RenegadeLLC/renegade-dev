<?php
/**
 * Template Name: About Page
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row jumbotron jumbotron-fluid">
			<!-- Placehoder -->
			<div class="col-md-12 hero">
				<h2>At Renegade we help courageous marketers cut through their content nightmares.</h2>
			</div>
		</div>

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

				<div class="row">
					<div class="col-md-12">
						<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?> <!-- Page Content -->
						<?php endwhile; // end of the loop. ?>
					</div>
				</div>

				<!-- secondary content grids -->
				<!-- CASE STUDIES -->
				<?php
					$ra_args = array('post_type' => 'projects', 'posts_per_page' => 3,  'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date');
					$wp_query = new WP_Query($ra_args); 
				?>
				<div class="row">
					<div class="col-md-12"><h2>Case Studies</h2></div>
					<?php while (have_posts()): the_post();?>
					<div class="col-lg-4 col-md-6">
						<?php $post_type = get_post_type();
							if ($post_type == 'projects'):
								get_template_part('loop-templates/content', 'project');
							endif;
						?>
					</div>
					<?php endwhile; // end of the loop. ?>
				</div>

				<!-- CLIENTS -->
				<?php
					// make sure to exclude renegade client post by ID number: 6274
					$ra_args = array('post_type' => 'clients', 'posts_per_page' => 16, 'post__not_in' => array(6274),  'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date');
					$wp_query = new WP_Query($ra_args); 
				?>
				<div class="row">
					<div class="col-md-12"><h2>Clients</h2></div>
					<?php while (have_posts()): the_post(); ?>
						<div class="col-lg-3 col-md-4">
						<?php $post_type = get_post_type();
							if ($post_type == 'clients'):
								get_template_part('loop-templates/content', 'client');
							endif;
						?>
						</div>
					<?php endwhile; // end of the loop. ?>
				</div>

				<!-- LEADERSHIP -->
				<?php
					$ra_args = array('post_type' => 'people', 'posts_per_page' => 6,  'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'date');
					$wp_query = new WP_Query($ra_args); 
				?>
				<div class="row">
					<div class="col-md-12"><h2>Leadership Team</h2></div>
					<?php while (have_posts()): the_post();?>
					<div class="col-lg-4 col-md-6">
						<?php $post_type = get_post_type();
							if ($post_type == 'people'):
								get_template_part('loop-templates/content', 'people');
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