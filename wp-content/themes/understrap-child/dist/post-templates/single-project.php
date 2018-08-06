<?php
/**
 * Single project (case study) post partial template for download.
 *
 * @package understrap
 */


$project_title = get_field('project_title', $post -> ID);
$client_name = get_field('client_name', $post -> ID);


$case_url = get_permalink();

$service_type = get_field('service_type', $post -> ID);
$industry_vertical = get_field('industry_vertical', $post -> ID);
$project_thumbnail_image = get_field('project_thumbnail_image', $post -> ID);
$project_banner_image = get_field('project_banner_image', $post -> ID);
$project_intro = get_field('project_intro', $post -> ID);

$post = $client_name;
setup_postdata( $post ); 
$client_testimonial = get_field('client_testimonial', $post -> ID);
$client = get_the_title($post -> ID);

if(have_rows('client_testimonial')):
	while(have_rows('client_testimonial')): the_row();
		$testimonial_first_name = get_sub_field('first_name');
		$testimonial_last_name = get_sub_field('last_name');
		$job_title = get_sub_field('job_title');
		$quote_text = get_sub_field('quote_text');
	endwhile;
endif;
wp_reset_postdata();
$caseHTML = '';

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<div class="project-wrapper">
	
<?php


	$caseHTML .= '<header class="entry-header"><h1>' . $client . '<br><span class="light-grey">' . $project_title . '</span></h1>';


	$caseHTML .= '</header><!-- .entry-header --><div class="entry-content">';

	if ($project_banner_image):
		$caseHTML .=	'<div class="row project-banner"><img src="' . $project_banner_image . '" alt="' . $client . ' ' .$project_name . '"></div>';
	endif;
	
	$caseHTML .=  '<div class="single-column-content">';

	$caseHTML .= '<div class="project-intro">' . $project_intro . '</div>';

	if( have_rows('project_section') ):

		while ( have_rows('project_section') ) : the_row();
			$section_top_image = get_sub_field('section_top_image');
			$section_headline = get_sub_field('section_headline');
			$section_content = get_sub_field('section_content');

			if($section_top_image):
				$caseHTML .= '<div class="project-section"><img src="' . $section_top_image . '" alt="' . $section_headline . '" class="header-image">';
			endif;
			
			$caseHTML .= '<h2>' . $section_headline . '</h2>' . $section_content . '</div>';
		endwhile;
	endif;
			// the_content(); 

			if($quote_text):
				$caseHTML .= '<img src="http://renegadellc.staging.wpengine.com/wp-content/uploads/cs_testimonial_image.png" class="header-image">';
				$caseHTML .= '<div class="testimonial-ct"><div class="open-quote"></div>';
				$caseHTML .= '<div class="quote-text">'. $quote_text . '</div><!-- .quote-text -->';
				$caseHTML .= '<div class="quote-attrib">' . $testimonial_first_name . ' ' . $testimonial_last_name . ',<br>';
				$caseHTML .= $client . '</div><!-- .quote-attrib -->';
				$caseHTML .= '<div class="close-quote"></div></div><!-- .testimonial-ct -->';
			endif;
			
			$caseHTML .= '</div><!-- .single-column-content -->';

			$caseHTML .= '	</div><!-- .entry-content --></div><!-- .project-wrapper -->';
			echo $caseHTML;
		
			understrap_post_nav(); 

	
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>


	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
