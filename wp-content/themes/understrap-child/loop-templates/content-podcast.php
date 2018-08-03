<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */
	//GET POST TYPE FIELDS
	global $orderby;
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
	$podcast_excerpt = get_the_excerpt();
	$podcast_excerpt = str_replace('Topline Summary ', '', $podcast_excerpt);
    //the_content(); 
	$post_link = get_permalink($post -> ID)
	;
	$post_edit_link = get_edit_post_link();
	$podcast_html = '';
	$podcast_details = '<span class="red semibold">GUEST:</span><br>';
	$podcast_details .= '<span class="semibold">' . $first_name . ' ' . $last_name . ',</span><br>';
	$podcast_details .= $job_title . ', <span class="semibold">' . $company_name . ' </span>';
	// $podcast_html .=  '<div class="feed-item post-item col-lg-4 col-md-6 col-sm-12 podcast-excerpt resource-excerpt">';
//    $podcast_html .= '<a href="' . $podcast_url . '" target="_blank">';
	$podcast_html = '<div class="card">';
	$podcast_html .= '<a href="' . $post_link . '">';
	$podcast_html .= '<div class="card-img-top"><img src="' . $profile_image .'" alt="' . $first_name . ' ' . $last_name . '"></div>';
	$podcast_html .= '<div class="card-body">';
	// $podcast_html .= '<div class="post-label-ct">PODCAST</div>';
	if($podcast_date){
		$podcast_html .=  '<p class="date">' . $podcast_date . '</p>';
		
	}
	$podcast_html .= '<h5 class="card-title">' . $podcast_title  . '</h5>';
	// $podcast_html .= '<div class="podcast-inset">';
	// $podcast_html .= '<div class="podcast-image w-50 fleft"><img src="' . $profile_image .'" alt="' . $first_name . ' ' . $last_name . '"></div><!--.podcast-image -->';
	$podcast_html .= '<p class="card-text"><span class="details">' . $podcast_details . '</span><br>';
	// $podcast_html .= '<span class="details">' . $podcast_details . '</span><br>';
	// $podcast_html .= '</div><!--.podcast-inset-->';
	if($podcast_excerpt){
		$podcast_html .=  '<span class="excerpt">' . $podcast_excerpt . '</span></p>';
	}
	$podcast_html .=  '</a>';
	// $podcast_html .= '<div><a href="' . $post_edit_link  . '">' . 'Edit'  . '</a></div>';
	$podcast_html .= '</div><!-- .card-body -->';
	$podcast_html .= '</div><!-- .card -->';
	echo($podcast_html);
?>

<?php
/*wp_link_pages( array(
	'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
	'after'  => '</div>',
) );*/
?>




