<?php
/**
 * Template Name: Blog List Page
 *
 * Template for an archive page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
				//loop for paged blog posts
				if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
				elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
				else { $paged = 1; }

// $paged = get_query_var('paged');
$rb_args = array( 'post_type' => 'post', 'posts_per_page' => 6, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged  );
$wp_query = new WP_Query( $rb_args );
?>

<div class="wrapper main-content" id="full-width-page-wrapper">

<div class="<?php echo esc_attr( $container ); ?>" id="blog-posts">

		<main class="site-main" id="main" role="main">


			<div class="row hero">
				<div class="col-md-12">
					<!-- Placehoder for hero area -->
					<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
				</div>
			</div>
			<!-- scroller status -->
			<div class="grid row">
		
				<?php while ( have_posts() ) : the_post(); ?>
				<div class="col-lg-4 col-md-6 .grid__item">
					<?php 
						// $postnum++;
						// echo "<h2>" . $postnum . "</h2>";
						get_template_part( 'loop-templates/content', 'blog' ); 
					?>
				</div>
				
				<?php endwhile; // end of the loop. ?>
			</div>

			<div class="row">
				<div class="col-md-12" style="text-align:center; color:red">
					<!-- TODO: insert loading status here -->
					<div class="loader-wheel">
						<i><i><i><i><i><i><i><i><i><i><i><i>
						</i></i></i></i></i></i></i></i></i></i></i></i>
					</div>
					<!-- <p><button class="view-more-button">View some more</button></p> -->
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
