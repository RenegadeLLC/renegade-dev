<?php
/**
 * Partial template for content 
 *
 * @package understrap
 */


	$title = get_the_title( $post -> ID);
	$date = get_the_date('F j, Y', $post -> ID);
	$excerpt= get_the_excerpt();
	$link = get_permalink($post -> ID);
	$post_edit_link = get_edit_post_link();
	$thumbail = get_the_post_thumbnail($post->ID, 'large', array('class' => 'card-img-top'));

	    
	$post_html = '';
	

	//$post_html .= '<div class="feed-item post-item col-lg-4 col-md-6 col-sm-12 newsletter-excerpt resource-excerpt">';	
	
	$post_html .= '<a href="' . $link . '">';
	// $post_html .= '<div class="post-label-ct">BLOG</div>';
	$post_html .= $thumbail;
	$post_html .= '<div class="card-body">';
	$post_html .= '<h3 class="card-title">' . $title . '</h3>';
	$post_html .= '<p class="card-text">';
	$post_html .= '<span class="date">' . $date . '</span><br>';
	$post_html .= '<span class="excerpt">' . $excerpt . '</span>';
	$post_html .= '</p></a>';	
	$post_html .= '<a href="' . $post_edit_link  . '">' . 'Edit'  . '</a>';
	$post_html .= '</div>';
	//$post_html .= '</div><!-- .post-item -->';
		
    echo($post_html);
		
		/*wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );*/
		?>




