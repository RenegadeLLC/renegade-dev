<?php
/**
 * Partial template for blog content list item
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
	    
	$post_html = '';
	

	
	$post_html .= '<a href="' . $link . '">';
	$post_html .= '<div class="card">';	
	
	// $post_html .= '<div class="post-label-ct">BLOG</div>';
	$post_html .= $thumbnail;
	$post_html .= '<div class="card-body">';
	$post_html .= '<h5 class="card-title">' . $title . '</h5>';
	$post_html.= '<div class="card-label">BLOG</div>';
	$post_html .= '<p class="card-text">';
	$post_html .= '<div class="card-date date">' . $date . '</div>';
	$post_html .= '<div class="card-excerpt">' . $excerpt . '</div>';
	$post_html .= '</p>';	
	// $post_html .= '<a href="' . $post_edit_link  . '">' . 'Edit'  . '</a>';
	$post_html .= '</div><!-- .card-body -->';
	$post_html .= '</div></a><!-- .card -->';
?>

<article <?php post_class();?> id="post-<?php the_ID();?>">

<header class="entry-header">

	<?php 
		// the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
// '</a></h3>');
	?>

	<?php if ('post' == get_post_type()): ?>

		<!-- <div class="entry-meta"> -->
			<?php 
			// understrap_posted_on();
			?>
		<!-- </div> -->
		<!-- .entry-meta -->

	<?php endif;?>

</header><!-- .entry-header -->

<?php 
	// echo get_the_post_thumbnail($post->ID, 'large'); 
?>

<div class="entry-content">

	<?php
// the_excerpt();
	echo $post_html;
?>

	<?php
// wp_link_pages(array(
// 'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
// 'after' => '</div>',
// ));
?>

</div><!-- .entry-content -->

<footer class="entry-footer">

	<?php 
	// understrap_entry_footer();
	?>

</footer><!-- .entry-footer -->

</article><!-- #post-## -->