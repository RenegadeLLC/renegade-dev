<?php
/**
 * The template for displaying a single Newsletter
 *
 * @package Renegade
 */

//get_header(); 

wp_head();

$newsletter_html = '';
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		<div class="news-page">
<div class="wrapper">

<div class="newsletter-ct">

<div class="newsletter-content-ct">
<?php 

		//$rn_title = wp_title('', FALSE);
		$rn_title = get_the_title( $post->ID );
		$rn_date = get_field('rn_date');
		$rn_introduction= get_field('rn_introduction');
		$rn_list_type = get_field('rn_list_type');
		$rn_banner = get_field('rn_banner');
		$rn_size = "full";
	
	//echo('<div class="newsletter-header">');
	$newsletter_html .= '<div class="newsletter-header">';
	//echo('<div class="newsletter-title">' . $rn_title . '</div>');
	$newsletter_html .= '<div class="newsletter-title">' . $rn_title . '</div>';
	//echo('<div class="newsletter-date">' . $rn_date . '</div></div>');
	$newsletter_html .= '<div class="newsletter-date">' . $rn_date . '</div></div>';
	//echo('<div class="newsletter-banner">' . wp_get_attachment_image($rn_banner, $rn_size ) . '</div>');
	$newsletter_html .= '<div class="newsletter-banner">' . wp_get_attachment_image($rn_banner, $rn_size ) . '</div>';
	//echo('<div class="newsletter-intro">' . $rn_introduction . '</div>');
	$newsletter_html .= '<div class="newsletter-intro">' . $rn_introduction . '</div>';
	



// check if the repeater field has rows of data
if( have_rows('rn_section') ):

	if($rn_list_type == 'Ordered List'){
		//echo('<dl class="ordered">');
		$newsletter_html .= '<dl class="ordered">';
	}else if($rn_list_type == 'Unordered List'){
	//	echo('<dl class="news-unordered">');
		$newsletter_html .= '<dl class="news-unordered">';
	}
	
	

 	// loop through the rows of data
    while ( have_rows('rn_section') ) : the_row();
    $newsletter_content_html = '';
        // display a sub field value
       // the_sub_field('sub_field_name');
      
		$rn_section_header = get_sub_field('rn_section_header');
		$rn_section_layout = get_sub_field('rn_section_layout');
		$rn_one_column_content = get_sub_field('rn_one_column_content');
		$rn_left_column_content = get_sub_field('rn_left_column_content');
		$rn_right_column_content = get_sub_field('rn_right_column_content');

		$newsletter_content_html .= '<div class="newsletter-section">';
		$newsletter_content_html .= '<dt class="news-unordered"><h3 class="newsletter">' . $rn_section_header . '</h3></dt>' ;
		
		if($rn_section_layout == 'One Column'){
			
			
			$newsletter_content_html .= '<div class="newsletter-text">' . $rn_one_column_content . '</div>';
		
		} else if($rn_section_layout == 'Two Columns'){
			
			$newsletter_content_html .= '<div class="left-col">' . $rn_left_column_content . '</div>';
			$newsletter_content_html .= '<div class="right-col">' . $rn_right_column_content . '</div></dt>';
		}
		//$newsletter_content_html .= '<a href="#submenu"><div class="bt-submenu"></div></a><div class="sub-nav-menu-ct" id="submenu">' . wp_nav_menu( array( 'menu' => 'people','theme_location' => 'people', 'menu_class' => 'sub-nav-menu' ) ) . '</div></a>';
		
		$newsletter_html .= $newsletter_content_html;
		
    endwhile;

   
    echo('</dl>');
   
else :

    // no rows found

endif;
echo $newsletter_html;
echo('</div>');


?><div class="newsletter-footer"></div>
		</div>
		</div><!-- .content-wrapper -->

<!-- .news-page -->
		
</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_footer(); ?>
