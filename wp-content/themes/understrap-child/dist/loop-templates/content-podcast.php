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
	$show_image = get_field('show_image', $post -> ID);
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

	//global $num_types;
	//var_dump($num_types);
    //the_content(); 
	$post_link = get_permalink($post -> ID);
	$post_edit_link = get_edit_post_link();
	$podcast_html = '';
	$podcast_details = '<span class="red semibold">GUEST:</span><br>';
	$podcast_details .= '<span class="semibold">' . $first_name . ' ' . $last_name . ',</span><br>';
	$podcast_details .= $job_title . ', <span class="semibold">' . $company_name . ' </span>';
	
	$podcast_html = '<div class="card">';
	
	$podcast_html .= '<a href="' . $post_link . '">';
	
	$podcast_html .= '<img class="card-img" width="337" height="337" src="' . $show_image .'" alt="' . $first_name . ' ' . $last_name . '">';
	$podcast_html .= '<div class="card-body">';


	$podcast_html .= '<h5 class="card-title">' . $podcast_title  . '</h5>';
	$podcast_html .= '<div class="card-label">PODCAST</div>';
	$podcast_html .= '<p class="card-text">';
	if($podcast_date){
		$podcast_html .=  '<div class="card-date date">' . $podcast_date . '</div>';
		
	}
	$podcast_html .= '<span class="details">' . $podcast_details . '</span><br>';
		if($podcast_excerpt){
		$podcast_html .=  '<div class="card-excerpt">' . $podcast_excerpt . '</div>';
	}
	$podcast_html .= '</p></div><!-- .card-body -->';
	$podcast_html .=  '</a>';

	$podcast_html .= '</div><!-- .card -->';
	echo($podcast_html);
?>

<?php
/*wp_link_pages( array(
	'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
	'after'  => '</div>',
) );*/
?>




