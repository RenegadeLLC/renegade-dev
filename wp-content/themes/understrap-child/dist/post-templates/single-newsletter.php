<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

$rn_title = get_the_title( $post->ID );
$rn_date = get_field('rn_date');
$rn_introduction= get_field('rn_introduction');
$rn_list_type = get_field('rn_list_type');
$rn_banner = get_field('rn_banner');
$rn_size = "full";
$accent_color = get_field('accent_color');
$rn_final_note = get_field('rn_final_note');

$newsletter_html = '';

$newsletter_html.= '<style>li:before{background-color:' . $accent_color . ';}</style>';

$newsletter_html .= '<div class="newsletter-header">';
$newsletter_html .= '<div class="newsletter-title">' . $rn_title . '</div>';
$newsletter_html .= '<div class="newsletter-date">' . $rn_date . '</div></div>';
$newsletter_html .= '<div class="newsletter-banner">' . wp_get_attachment_image($rn_banner, $rn_size ) . '</div>';
$newsletter_html .= '<div class="newsletter-intro">' . $rn_introduction . '</div>';

if( have_rows('rn_section') ):

	if($rn_list_type == 'Ordered List'){
		$newsletter_html .= '<ol class="section-list">';
	}else if($rn_list_type == 'Unordered List'){
		$newsletter_html .= '<ul class="section-list">';
	}

while ( have_rows('rn_section') ) : the_row();
$newsletter_content_html = '';

$rn_section_header = get_sub_field('rn_section_header');
$rn_section_layout = get_sub_field('rn_section_layout');
$rn_one_column_content = get_sub_field('rn_one_column_content');
$rn_left_column_content = get_sub_field('rn_left_column_content');
$rn_right_column_content = get_sub_field('rn_right_column_content');

$newsletter_content_html .= '<li class="newsletter-section">';
$newsletter_content_html .= '<h3 class="black text-left">' . $rn_section_header . '</h3>' ;

if($rn_section_layout == 'One Column'){
		
	$newsletter_content_html .= '<div class="newsletter-text">' . $rn_one_column_content . '</div>';

} else if($rn_section_layout == 'Two Columns'){
		
	$newsletter_content_html .= '<div class="left-col">' . $rn_left_column_content . '</div>';
	$newsletter_content_html .= '<div class="right-col">' . $rn_right_column_content . '</div></dt>';
}
//$newsletter_content_html .= '<a href="#submenu"><div class="bt-submenu"></div></a><div class="sub-nav-menu-ct" id="submenu">' . wp_nav_menu( array( 'menu' => 'people','theme_location' => 'people', 'menu_class' => 'sub-nav-menu' ) ) . '</div></a>';

$newsletter_content_html .= '</li>';



$newsletter_html .= $newsletter_content_html;

endwhile;

	if($rn_list_type == 'Ordered List'):
	$newsletter_html .= '</ol>';
	elseif($rn_list_type == 'Unordered List'):
	$newsletter_html .= '</ul>';
	endif;

 
else :

// no rows found

endif;


$newsletter_content_html .= '</div>';

if($rn_final_note):
	$newsletter_html  .= '<div style="background-color:#333; color:#fff; padding:16px;">' . $rn_final_note . '</div>';
endif;

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php 
			// the_content(); 
			echo $newsletter_html;
		?>

		<?php understrap_post_nav(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
