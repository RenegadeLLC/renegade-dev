<?php
/**
 * Template Name: Resources
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */
get_header();
$container = get_theme_mod('understrap_container_type');
$paged = get_query_var('paged');
$rpd_args = array('post_type' => array('newsletters', 'downloads', 'video'), 'posts_per_page' => 8, 'post_status' => 'publish', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged);
$wp_query = new WP_Query($rpd_args);
?>

<div class="wrapper main-content" id="full-width-page-wrapper">
	<div class="<?php echo esc_attr($container); ?>" id="newsletter-posts">
		<main class="site-main" id="main" role="main">
			<div class="card-columns">
			
				<?php while ($wp_query->have_posts()): $wp_query->the_post();?>
				<div class="card">
					<div class="card-body">
						<?php $post_type = get_post_type();
							if ($post_type == 'newsletters'):
								get_template_part('loop-templates/content', 'newsletter');
							elseif ($post_type == 'downloads'):
								get_template_part('loop-templates/content', 'download');
							elseif ($post_type == 'videos'):
								get_template_part('loop-templates/content', 'video');
							endif;
						?>
					</div>
				</div>
				<?php endwhile; // end of the loop. ?>
				
			</div>
		</main>

		<!-- The pagination component -->
		<?php understrap_pagination(); ?>
		
	</div>
</div><!-- Wrapper end -->


<?php get_footer();?>