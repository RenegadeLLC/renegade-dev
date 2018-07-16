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

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$paged = get_query_var('paged');
$rn_args = array( 'post_type' => 'people', 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged  );
$wp_query = new WP_Query( $rn_args );

?>

<div class="wrapper main-content" id="full-width-page-wrapper">

<div class="<?php echo esc_attr( $container ); ?>" id="newsletter-posts">

			<main class="site-main" id="main" role="main">

					<div class="card-columns">
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="card">
								<div class="card-body">
									<?php get_template_part( 'loop-templates/content', 'people' ); ?>
								</div>
							</div>
						<?php endwhile; // end of the loop. ?>
					</div>

			</main>
			
</div>

</div><!-- Wrapper end -->


<?php get_footer(); ?>