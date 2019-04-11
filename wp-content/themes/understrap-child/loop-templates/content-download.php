<?php
/**
 * Partial template for newsletter content list item
 *
 * @package understrap
 */

$dn_title = get_the_title( $post->ID );
/* $dn_date = get_field('rn_date', $post -> ID);
 $dn_thumbnail_image= get_field('rn_banner', $post -> ID);
$dn_link = get_permalink($post -> ID);
$dn_introduction= get_field('rn_introduction' , $post -> ID);
$dn_excerpt = limit_text($dn_introduction, 70);
$dn_banner = get_field('rn_banner', $post -> ID);*/
$dn_thumbnail_image = get_the_post_thumbnail_url();
$dn_description =  get_the_content();
$downoad_url = get_field('download_file', $post -> ID);


$download_html = '<div class="card" style="border:1px solid red;">';

//$download_html .= '<a href="' . $dn_link . '">';
if($dn_thumbnail_image ):
	$download_html .= '<img src="' . $dn_thumbnail_image . '" alt="' . $dn_title  . '">';	
	//$download_html .= $dn_thumbnail_image;	
endif;

$download_html .= '<div class="card-body">';
$download_html .= '<h5 class="card-title">' . $dn_title . '</h5>';
$download_html.= '<div class="card-label">DOWNLOAD</div>';
$download_html .= '<p class="card-text">';
$download_html .= $dn_description;
//$download_html .= '<div class="card-date date">' . $dn_date . '</div>';
//$download_html .= '<div class="card-excerpt">' . $dn_excerpt . '</div>';
$download_html .= '</p>';
$download_html .= '<div class="bt-black"><a href="' . $downoad_url . '" download="' . $downoad_url . '">' . Download . '</a></div>';
//$download_html .= '</div></a><!-- .card-body -->';
$download_html .= '</div><!-- .card-body -->';
$download_html .= '</div><!-- .card -->';

?>

<article <?php post_class();?> id="post-<?php the_ID();?>">


<div class="entry-content">

	<?php echo $download_html ?>

</div><!-- .entry-content -->

</article><!-- #post-## -->
