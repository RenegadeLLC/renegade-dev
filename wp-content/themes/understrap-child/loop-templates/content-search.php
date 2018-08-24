<?php
/**
 * Search results partial template.
 *
 * @package understrap
 */

$title = get_the_title( $post -> ID);
$date = get_the_date('F j, Y', $post -> ID);
$excerpt= get_the_excerpt();
$link = get_permalink($post -> ID);
$post_edit_link = get_edit_post_link();
// $thumbail = get_the_post_thumbnail($post->ID, 'large', array('class' => 'card-img-top'));
$thumbnail = get_the_post_thumbnail( $post->ID, 'thumbnail' );

$search_html .= '<a href="' . $link . '">';
$search_html .= '<div class="card">';	
// $search_html .= '<div class="post-label-ct">BLOG</div>';
$search_html .= $thumbnail;
$search_html .= '<div class="card-body">';
$search_html .= '<h5 class="card-title">' . $title . '</h5>';
$search_html .= '<p class="card-text">';
$search_html .= '<span class="card-date date">' . $date . '</span><br><br>';
$search_html .= '<span class="card-excerpt">' . $excerpt . '</span>';
$search_html .= '</p>';	
// $search_html .= '<a href="' . $post_edit_link  . '">' . 'Edit'  . '</a>';
$search_html .= '</div><!-- .card-body -->';
$search_html .= '</div></a><!-- .card -->';

?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<div class="entry-content">

<?php
// the_excerpt();
echo $search_html;
?>

</div><!-- .entry-content -->

</article><!-- #post-## -->
