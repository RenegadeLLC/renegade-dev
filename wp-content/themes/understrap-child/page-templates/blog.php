<?php
/**
 * Template Name: Blog List Page
 *
 * Template for an archive page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod('understrap_container_type');
//loop for paged blog posts
if (get_query_var('paged')) {$paged = get_query_var('paged');} elseif (get_query_var('page')) {$paged = get_query_var('page');} else { $paged = 1;}

// $paged = get_query_var('paged');
$rb_args = array('post_type' => 'post', 'posts_per_page' => 6, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged);
$wp_query = new WP_Query($rb_args);
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row jumbotron jumbotron-fluid">
			<!-- Placehoder -->
			<div class="col-md-6">
				<h2>Lorem Ipsum Blog</h2>
				<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
			</div>
			<div class="col-md-6"></div>
		</div>

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php if(have_posts($wp_query)): ?>
					<!-- infinite scroll grid -->
					<div class="grid row">
						<?php while (have_posts()): the_post();?>
						<div class="col-lg-4 col-md-6 .grid__item">
							<?php
								// $postnum++;
								// echo "<h2>" . $postnum . "</h2>";
								get_template_part('loop-templates/content', 'blog');
								?>
						</div>
						<?php endwhile; // end of the loop. ?>
					</div>

					<!-- scroller status -->
					<div class="row">
						<div class="col">
							<div class="loader-wheel .infinite-scroll-request">
								<i><i><i><i><i><i><i><i><i><i><i><i>
								</i></i></i></i></i></i></i></i></i></i></i></i>
							</div>
							<!-- <p><button class="view-more-button">View some more</button></p> -->
						</div>
					</div>
					
					<!-- The pagination component -->
					<div class="row" style="visibility: hidden">
						<div class="col">
							<?php understrap_pagination();?>
						</div>
					</div>
					<?php endif; ?>

					<!-- SUBSCRIBE FORM -->
					<div class="row form-subscribe">
						<div class="col-lg-6 col-sm-12">
							<h2>Subscribe</h2>
							<h4>to the Latest in</h4>
							<h4> Renegade Thinking</h4>
						</div>
						<div class="col-lg-6 col-sm-12">
							<?php echo do_shortcode('[mc4wp_form id="5405"]') ?>
						</div>';
					</div>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
