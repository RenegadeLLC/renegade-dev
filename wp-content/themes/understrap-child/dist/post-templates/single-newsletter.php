<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

$rn_title = get_the_title( $post->ID );
$rn_date = get_field('rn_date');
$rn_introduction= get_field('rn_introduction');
$rn_list_type = get_field('rn_list_type');
$rn_banner = get_field('rn_banner');
$rn_size = "full";
$accent_color = get_field('accent_color');
$rn_final_note = get_field('rn_final_note');

$newsletter_html = '';

// ACF content html
$newsletter_html .= '<div class="newsletter-intro">' . $rn_introduction . '</div><!-- .newsletter-intro -->';
if( have_rows('rn_section') ):
	while ( have_rows('rn_section') ) : the_row();
		$newsletter_content_html = '';
		$rn_section_header = get_sub_field('rn_section_header');
		$rn_section_layout = get_sub_field('rn_section_layout');
		$rn_one_column_content = get_sub_field('rn_one_column_content');
		$rn_left_column_content = get_sub_field('rn_left_column_content');
		$rn_right_column_content = get_sub_field('rn_right_column_content');
		$newsletter_content_html .= '<div class="newsletter-section">';
		$newsletter_content_html .= '<h3>' . $rn_section_header . '</h3>' ;
		if($rn_section_layout == 'One Column'){
			$newsletter_content_html .= '<div class="newsletter-text">' . $rn_one_column_content . '</div>';
		} else if($rn_section_layout == 'Two Columns'){		
			$newsletter_content_html .= '<div class="left-col">' . $rn_left_column_content . '</div>';
			$newsletter_content_html .= '<div class="right-col">' . $rn_right_column_content . '</div></dt>';
		}
		$newsletter_content_html .= '</div>';
		$newsletter_html .= $newsletter_content_html;
	endwhile;
else :
endif;

if($rn_final_note):
	$newsletter_html .= '<div class="final-note">' . $rn_final_note . '</div><!-- .final-note -->';
else:
$newsletter_html .= '<div class="section-sep" style="margin-bottom:40px;"></div>';
endif;
?>

<!-- Article -->
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="row newsletter-banner">
		<?php echo wp_get_attachment_image($rn_banner, $rn_size ) ?>
	</div><!-- .newsletter-banner -->
	<div class="single-column-content">
		<div class="newsletter-content">
			<header class="entry-header">
				<div class="newsletter-title">
					<h1><?php echo $rn_title ?></h1>
				</div><!-- .newsletter-title -->
				<div class="newsletter-date">
					<?php echo $rn_date ?>
				</div><!-- .newsletter-date -->
				<?php echo do_shortcode("[TheChamp-Sharing]"); ?>
			</header>

			<?php echo $newsletter_html ?>
		</div><!-- .newsletter-content -->
	</div><!-- .single-column-content -->
	
	<footer class="entry-footer">
			<?php understrap_post_nav();?>

			<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
				'after' => '</div>',
			));
			?>	
	</footer><!-- footer .row pagination-->
</article><!-- article -->
