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
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php


$newsletter_html .= '<div class="newsletter-banner">' . wp_get_attachment_image($rn_banner, $rn_size ) . '</div><!-- .newsletter-banner -->';
$newsletter_html .= '<div class="single-column-content"><div class="newsletter-content">';
$newsletter_html .= '<header class="entry-header">';
$newsletter_html .= '<div class="newsletter-title"><h1>' . $rn_title . '</h1></div><!-- .newsletter-title -->';
$newsletter_html .= '<div class="newsletter-date">' . $rn_date . '</div><!-- .newsletter-date -->';
$newsletter_html .= '</header><!-- .entry-header -->';
//$newsletter_html .= '<div class="entry-content">';

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

	// no rows found

	endif;

	//$newsletter_content_html .= '</div>';

if($rn_final_note):
	$newsletter_html .= '<div class="final-note">' . $rn_final_note . '</div><!-- .final-note -->';
endif;


$newsletter_html .= '</div><!--.newsletter-content --></div><!-- .single-column-content -->';
//$newsletter_html .= '</div><!-- .entry-content -->';

		echo $newsletter_html;
	
		understrap_post_nav();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div><!-- .nav -->',
		) );
		
		?>
</article><!-- #post-## -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->


