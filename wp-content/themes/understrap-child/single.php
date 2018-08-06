<?php
/**
 * Single Page main template wrapper
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

	get_header();
// $container = get_theme_mod( 'understrap_container_type' );
$container = get_field('container_width', 'option');

	// echo esc_attr($container);
?>

<div class="wrapper" id="full-width-page-wrapper">

	<?php 
		// echo esc_attr($container);
		if ($container == 'Fixed Width Container'):
			echo'<div class="container" id="content">';
		elseif ($container == 'Full Width Container'):
			echo'<div class="container" id="content">';
		endif; //END CONTAINER WIDTH IF
	?>

		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php $post_type = get_post_type();
				if ($post_type == 'post'):
					get_template_part('post-templates/single', 'post');
				elseif ($post_type == 'projects'):
					get_template_part('post-templates/single', 'project');
				elseif ($post_type == 'people'):
					get_template_part('post-templates/single', 'bio');
				elseif ($post_type == 'newsletters'):
					get_template_part('post-templates/single', 'newsletter');
				elseif ($post_type == 'podcasts'):
					get_template_part('post-templates/single', 'podcast');
				elseif ($post_type == 'downloads'):
					get_template_part('post-templates/single', 'download');
				elseif ($post_type == 'videos'):
					get_template_part('post-templates/single', 'video');
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
