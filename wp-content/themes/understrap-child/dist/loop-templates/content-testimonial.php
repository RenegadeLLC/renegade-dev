<?php
/**
 * Download post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */
$client_name = get_the_title();
$client_id = get_the_ID();
$client_logo = get_field('clientLogo', $post -> ID);
$industry_vertical = get_field('industry_vertical', $post -> ID);
$case_study = get_field('case_study', $post -> ID);
$case_study_url = get_field('case_study_url', $post -> ID);

$testimonialHTML = '';

    
$first_name = get_sub_field('first_name');
$last_name = get_sub_field('last_name');
$job_title = get_sub_field('job_title');
$quote_text = get_sub_field('quote_text');

//  $testimonialHTML .= '<div class="col-lg-6 col-md-6 col-sm-12">';

// $testimonialHTML .= '<div class="testimonial-ct">';
$testimonialHTML .=  '<div class="open-quote"></div>';
$testimonialHTML .=  '<div class="quote-text">' . $quote_text . '</div><!-- .quote-text -->';

$testimonialHTML .=  '<div class="quote-attrib"><span class="bold">' . $first_name . ' ' . $last_name . ',</span><br>';
if($job_title):
$testimonialHTML .= $job_title .'<br>';
endif;    
$testimonialHTML .= $client_name  . '</div><!-- .quote-attrib -->';

$testimonialHTML .=  '<div class="close-quote"></div>';
//  $testimonialHTML .= '</div><!-- . testimonial-ct --></div>';
?>

<article <?php post_class();?> id="post-<?php the_ID();?>">

	<header class="entry-header">

	<?php if ('client' == get_post_type()): ?>

		<div class="entry-meta">
			<?php understrap_posted_on();?>
		</div><!-- .entry-meta -->

	<?php endif;?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>

	<div class="entry-content">

		<?php
// the_excerpt();
// if($client_name != 'Renegade'):

	
	// if($case_study == 'Yes'):
	// 	$clientsHTML .= '<a href="' . $case_study_url . '">';
	// endif;
	
	// // $clientsHTML .= '<div>CLIENT ID: ' . $client_id . '</div>';
	// $clientsHTML .= '<div class="client-logo"><img src="' . $client_logo . '" alt=""></div>';
	
	// if($case_study == 'Yes'):
	// 	$clientsHTML .= '</a>';
	// endif;
// endif;
    if ($quote_text):
        echo $testimonialHTML;
    endif;
?>

		<?php
// wp_link_pages(array(
//     'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
//     'after' => '</div>',
// ));
?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php 
			// understrap_entry_footer();
		?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
