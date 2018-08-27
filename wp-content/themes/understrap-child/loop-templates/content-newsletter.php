<?php
/**
 * Partial template for newsletter content list item
 *
 * @package understrap
 */

$rn_title = get_the_title( $post->ID );
$rn_date = get_field('rn_date', $post -> ID);
// $rn_thumbnail_image= get_field('rn_banner', $post -> ID);
$rn_link = get_permalink($post -> ID);
$rn_introduction= get_field('rn_introduction' , $post -> ID);
$rn_excerpt = limit_text($rn_introduction, 60);
$rn_banner = get_field('rn_banner', $post -> ID);
$rn_thumbnail_image = get_field('rn_thumbnail_image', $post -> ID);
$rn_size = array('506', '169');

$newsletter_html = '<div class="card">';
$newsletter_html .= '<a href="' . $rn_link . '">';
if($rn_thumbnail_image ):
	$newsletter_html .= '<img src="' . $rn_thumbnail_image . '" alt="' . $rn_title  . '">';	
elseif($rn_banner):
	$newsletter_html .= wp_get_attachment_image($rn_banner, $rn_size );
endif;

$newsletter_html .= '<div class="card-body">';
$newsletter_html .= '<h5 class="card-title">' . $rn_title . '</h5>';
$newsletter_html .= '<p class="card-text">';
$newsletter_html .= '<span class="date">' . $rn_date . '</span><br>';
$newsletter_html .= '<span class="card-excerpt">' . $rn_excerpt . '</span>';
$newsletter_html .= '</p>';
$newsletter_html .= '</div></a><!-- .card-body -->';
$newsletter_html .= '</div><!-- .card -->';

?>

<article <?php post_class();?> id="post-<?php the_ID();?>">


<div class="entry-content">

	<?php echo $newsletter_html ?>

</div><!-- .entry-content -->

</article><!-- #post-## -->
