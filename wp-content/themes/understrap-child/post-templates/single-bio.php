<?php
/**
 * Partial template for people content
 *
 * @package understrap
 */
$headline_background_color = get_field('headline_background_color');
$rp_link = get_permalink($post -> ID);
$rp_last_name = get_the_title( $post->ID );
$rp_first_name = get_field('rp_first_name');
$rp_job_title = get_field('rp_job_title');
$rp_bio_image = get_field('rp_bio_image');
$rp_size = "full";
$rp_social_channel = strtolower(get_field('rp_social_channel'));
$rp_social_icon;
$rp_social_channel_url = get_field('rp_social_channel_url');
$rp_bio_intro = get_field('rp_bio_intro');
$rp_biography = get_field('rp_biography');
$rp_banner_image = get_field('rp_banner_image');
$rp_sidebar_image = get_field('rp_sidebar_image');
$rp_email_address = get_field('rp_email_address');
$rp_contact_link = get_field('rp_contact_link');

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<?php 

		$post_edit_link = get_edit_post_link();

		$people_html = '';
		
		$people_html .= '<header class="row people-title"><div class="col"><h1>' . $rp_first_name . ' ' . $rp_last_name .'<br><span class="job-title">' . $rp_job_title . '</span></h1></header>';

		$people_html .= '<section class="row people-intro">';
		$people_html .= '<div class="col-md-6 people-image" style="background-image:url(' . $rp_banner_image . '); background-size:contain; background-repeat:no-repeat; background-position:0%;"><img src="' . $rp_bio_image . '" alt="' .  $rp_first_name . ' ' . $rp_last_name .'"></div>';
		$people_html .= '<div class="col-md-6 people-intro-bio">' . $rp_bio_intro . '</div>';
		$people_html .= '</section>';

		$people_html .= '<section class="row people-content">';
		$people_html .= '<aside class="col-md-4">';
		if($rp_email_address):
			$people_html .= '<div class="email" ><a href="mailto:'. $rp_email_address . '"> Contact ' . $rp_first_name . '</a></div>';
		endif;
		if($rp_social_channel):
			$people_html .= '<div class="social ' . $rp_social_channel . '" ><a href='. $rp_social_channel_url . '> Follow ' . $rp_first_name . '</a></div>';
		endif;
	
		$people_html .= '<div class="sidebar-img"><img src="' . $rp_sidebar_image . '"></div>';
		$people_html .= '</aside>';
		$people_html .= '<article class="col-md-8">';
		$people_html .= '<div>'. $rp_biography . '</div>';
		// $people_html .= '<div>'. $rp_fun_fact . '</div>';
		$people_html .= '</article>';
		$people_html .= '</section>';

		echo $people_html;
		
		?>

	</div><!-- .entry-content -->

	<!-- footer .row pagination -->
	<footer class="entry-footer">
			<?php understrap_post_nav();?>

			<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
				'after' => '</div>',
			));
			?>	
	</footer><!-- footer .row pagination-->

</article><!-- #post-## -->
