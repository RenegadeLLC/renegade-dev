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
$video_title = get_sub_field('video_title');
$video = get_sub_field('video');
$video_thumbnail = get_sub_field('video_thumbnail');
$video_description = get_sub_field('video_description');
$first_name = get_sub_field('first_name');
$last_name= get_sub_field('last_name');
$job_title= get_sub_field('job_title');

$videotestimonialHTML = '';
$videotestimonialHTML = '<div class="card">';
	
$videotestimonialHTML .= '<a href="' . $video . '">';

$videotestimonialHTML .= '<img class="card-img" width="337" height="337" src="' . $show_image .'" alt="' . $first_name . ' ' . $last_name . '">';
$videotestimonialHTML .= '<div class="card-body">';

if($first_name && $last_name):
    $videotestimonialHTML .=  '<h5 class="card-title">' . $first_name . ' ' . $last_name . ',</span><br>';
endif;

if($job_title):
    $videotestimonialHTML .= $job_title .'<br>';
endif;   

$videotestimonialHTML .= $client_name  . '</div><!-- .quote-attrib -->';
$videotestimonialHTML .= '</a><!-- close video link -->';
?>



	