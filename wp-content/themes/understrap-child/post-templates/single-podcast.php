<?php
/**
 * Single post partial template for podcast.
 *
 * @package understrap
 */
$podcast_title = get_the_title($post -> ID);
$profile_image = get_field('profile_image', $post -> ID);
$promo_video = get_field('promo_video', $post -> ID);
$first_name = get_field('first_name', $post -> ID);
$last_name = get_field('last_name', $post -> ID);
$job_title = get_field('job_title', $post -> ID);
$company_name = get_field('company_name', $post -> ID);
$podcast_date = get_field('podcast_date', $post -> ID);
$podcast_url = get_field('podcast_url', $post -> ID);
$podcast_description = get_the_content();
$podcast_embed_code=get_field('podcast_embed_code');
$meet_the_guest = get_field('meet_the_guest');
//the_content(); 
$post_link = get_permalink($post -> ID)
;
$post_edit_link = get_edit_post_link();
$podcast_html = '';

$podcast_html .= '<div class="row podcast-detail-hero">';
$podcast_html .= '<div class="column col-md-3 podcast-profile-image-ct">';
$podcast_html .= '<div class="podcast-profile-image"><img src="' . $profile_image . '" alt="' . $first_name . ' ' . $last_name . '"></div>';
$podcast_html .= '</div><!-- .col-md-3-->';
$podcast_html .= '<div class="column col-md-9 podcast-detail-info">';
$podcast_html .= '<img src="http://renegadellc.staging.wpengine.com/wp-content/uploads/RTU_title_detailPage.png">';
	
	if($podcast_date){
		$podcast_html .=  '<div class="date">' . $podcast_date . '</div>';
	}
$podcast_html .= '<h1>' . $podcast_title  . '</h1>';
$podcast_html .= '<div class="podcast-guest-details"><span class="black">Guest: </span>' . $first_name . ' ' . $last_name . ' - ' . $job_title . ', <span class="semibold">' . $company_name . ' </span></div>';

$podcast_html .= '</div><!-- .col-md-9-->';
	if($podcast_embed_code):
		$podcast_html .= '<div class="podcast-player-ct">' . $podcast_embed_code . '</div>';
	endif;
$podcast_html .= '</div><!-- .row -->';




?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">


	<div class="entry-content">

		<?php 

			$podcast_html .= '<div class="single-column-content"><div class="podcast-content">';
			$content = get_the_content(); 
			$podcast_html .= $content;
				if($meet_the_guest):
					$podcast_html .= '<h2>Meet the Guest</h2>' . $meet_the_guest;
				endif;
			if( have_rows('quotes') ):
				$podcast_html .= '<h2>Quotes from ' . $first_name . ' ' . $last_name . '</h2>';
				while ( have_rows('quotes') ) : the_row();
					$quote= get_sub_field('quote_thing');
					$attribution = get_sub_field('attribution');
					$podcast_html .= '<div class="quote-ct"><div class="quote">' . $quote . '</div>';

					if($attribution){
						$podcast_html .= '<div class="attribution">' . $attribution . '</div>';
					}
					$podcast_html .= '</div><!-- .quote-ct -->';
				endwhile;
			endif;
			
			$podcast_html .= '</div><!-- .podcast-content --></div><!--  .entry-content -->';
			echo $podcast_html;
		?>


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
