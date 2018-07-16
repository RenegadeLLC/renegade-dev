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
$rp_social_channel = get_field('rp_social_channel');
$rp_social_icon;
$rp_social_channel_url = get_field('rp_social_channel_url');
$rp_bio_intro = get_field('rp_bio_intro');
$rp_biography = get_field('rp_biography');
$rp_fun_fact = get_field('rp_fun_fact');
$rp_fun_fact_image = get_field('rp_fun_fact_image');
$rp_random_image = get_field('rp_random_image');
$rp_email_address = get_field('rp_email_address');
$rp_contact_link = get_field('rp_contact_link');

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<?php 

		$post_edit_link = get_edit_post_link();

		$people_html = '';
		
		
		// $people_html .= '<div class="post-label-ct">PEOPLE</div>';
		$people_html .= '<a href="' . $rp_link . '">';
		$people_html .= '<div class="people-bio-image"><img src="' . $rp_bio_image . '" alt="' .  $rp_first_name . ' ' . $rp_last_name .'"></div>';	
		$people_html .= '<div><h2>' . $rp_first_name . ' ' . $rp_last_name .'</h2>';
		$people_html .= '<h3>' . $rp_job_title . '</h3></div></a>';

		echo $people_html;
		?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>
		
	</div><!-- .entry-content -->


</article><!-- #post-## -->
