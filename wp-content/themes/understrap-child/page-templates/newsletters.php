<?php
/**
 * Template Name: Newsletters
 *
 * Based on understrap full width  /understrap/page-templates/fullwidthpage.php
 * Displays a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$paged = get_query_var('paged');
$rn_args = array( 'post_type' => 'newsletters', 'posts_per_page' => 4, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged  );
$wp_query = new WP_Query( $rn_args );

?>

<div class="wrapper main-content" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="newsletter-posts">

		<main class="site-main" id="main" role="main">
				<!-- <div class="card-columns"> -->
				<div class="row hero">
					<div class="col">
						<!-- Placehoder for hero area -->
						<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
					</div>
				</div>
				<div class="grid row">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="col-md-6 .grid__item">
							<!-- <div class="card-body"> -->
								<?php get_template_part( 'loop-templates/content', 'newsletter' ); ?>
							<!-- </div> -->
						</div>
					<?php endwhile; // end of the loop. ?>
				</div>
				<div class="row">
					<div class="col-md-12" style="text-align:center; color:red">
						<!-- TODO: insert loading status here -->
						<h1 class="infinite-scroll-request">Loading more...</h1>
					</div>
				</div>
				<!-- The pagination component -->
				<div class="row" style="visibility: hidden">
					<div class="col-md-12">
						<?php understrap_pagination(); ?>
					</div>
				</div>
		</main><!-- #main -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->


<?php get_footer(); ?>
