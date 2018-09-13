<?php
/**
 * Single Page main template wrapper
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

	get_header();

	global $headlineHTML;
	// global $post_type;
	
	$container = get_field('container_width', 'option');

?>

<div class="wrapper" id="single-wrapper">

	<?php 
		// echo esc_attr($container);
		if ($container == 'Fixed Width Container'):
			echo'<div class="container" id="content">';
		elseif ($container == 'Full Width Container'):
			echo'<div id="content">';
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

		<!-- START: add optional subscription form -->
		<?php 
		$subform_post_types = get_field('subform_post_types', 'option');
		$subform_add_headline = get_field('subform_add_headline', 'option');
		$subform_headline_items = get_field('subform_headline_items', 'option');
		$subform_customize_background = get_field('subform_customize_background', 'option');
		$subform_background = get_field('subform_background', 'option');
		$subform_shortcode = get_field('subform_shortcode', 'option');

		// custom background vars
		if ($subform_customize_background == 'Yes'):
			// $subform_background = get_sub_field('subform_background');
			$background_color = $subform_background['background_color'];
			$background_image = $subform_background['background_image'];
			$customize_background_image = $subform_background['customize_background_image'];
			if ($customize_background_image == 'Yes'):
				$background_image_repeat = $subform_background['background_image_repeat'];
				$background_image_position = $subform_background['background_image_position'];
				$background_image_size = $subform_background['background_image_size'];
			else:
				$background_image_repeat = 'no-repeat';
				$background_image_position = 'center';
				$background_image_size = 'cover';
			endif;
		endif;
		
		// var for post types to include subcription form
		$include_in_post_type = [];
		foreach ($subform_post_types as $type) {
            switch ($type) {
                case 'Blog':
					array_push($include_in_post_type,'post');
                    break;
				case 'Newsletter':			
					array_push($include_in_post_type,'newsletters');
                    break;
                case 'Podcast':
					array_push($include_in_post_type,'podcasts');
                    break;
                case 'Downloads':
					array_push($include_in_post_type,'downloads');
                    break;
                default:
            }
		}
		
		// check if should include in post
		if (in_array($post_type, $include_in_post_type)):
			$pageHTML .= '<div class="row content-section subform"';
			// customize background
			if ($subform_customize_background == 'Yes'):
				$pageHTML .= ' style="';
				if ($background_color):
					$pageHTML .= 'background-color:' . $background_color . '; ';
				endif;
				if ($background_image):
					$pageHTML .= 'background-image:url(' . $background_image . '); ';
					if ($background_image_repeat):
						$pageHTML .= ' background-repeat:' . $background_image_repeat . ';';
					else:
						$pageHTML .= ' background-repeat:no-repeat;';
					endif;
					if ($background_image_position):
						$pageHTML .= 'background-position:' . $background_image_position . ';';
					endif;
					if ($background_image_size):
						$pageHTML .= ' background-size:' . $background_image_size . ';';
					endif;
				endif;
				$pageHTML .= '" id="' . $content_section_name . '"';
			endif; //end if customize background
			$pageHTML .= '>'; 
			if ($subform_add_headline == 'Yes'):
				require FUNCTIONS . '/post_subform.php';
			endif;
			$formHTML = build_subscribe_form($subform_shortcode, $headlineHTML);
			$pageHTML .= $formHTML;
			$pageHTML .= '</div>';
			echo $pageHTML;
		endif;
		?>    
		<!-- END: add optional subscription form -->  

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>