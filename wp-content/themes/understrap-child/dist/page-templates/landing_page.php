<?php
/**
 * Template Name: Landing Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

global $columnHTML;
global $headlineHTML;

get_header();
// $container = get_theme_mod('understrap_container_type');

$container = get_field('container_width', 'option');

$pageHTML = '';

?>

<div class="wrapper" id="full-width-page-wrapper">

<?php 
        // echo esc_attr($container);
        if ($container == 'Fixed Width Container'):
            $pageHTML = '<div class="container" id="content">';
        elseif ($container == 'Full Width Container'):
            $pageHTML = '<div class="container" id="content">';
        endif; //END CONTAINER WIDTH IF
        ?>
        
        <div class="row">

			<!-- <div class="content-area" id="primary"> -->
			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

                    <?php

                    //CHECK FOR CONTENT SECTIONS
                    if (have_rows('content_sections')):

                        while (have_rows('content_sections')): the_row();

                            //GET SECTION NAME
                            $content_section_name = get_sub_field('content_section_name');
                            //MAKE SECTION NAME LINK FRIENDLY
                            $content_section_name = clean_link_name($content_section_name);
                            
                            $vertical_alignment = get_sub_field('vertical_alignment');
 
                            $align_items = '';
                            if($vertical_alignment == 'Top'):
                                $align_items = 'flex-start';
                            elseif($vertical_alignment == 'Bottom'):
                                $align_items = 'flex-middle';
                            elseif($vertical_alignment == 'Centered'):
                                $align_items = 'center';
                            elseif($vertical_alignment == 'Stretched'):
                                $align_items = 'stretch';
                            elseif($vertical_alignment == 'Baseline'):
                                $align_items = 'baseline';
                            endif;
                            
                            $add_bottom_border = get_sub_field('add_bottom_border');

                            //GET SECTION TYPE
                            $content_section_type = get_sub_field('content_section_type');

                            //CUSTOMIZE SECTION BACKGROUND
                            $customize_section_background = get_sub_field('customize_section_background');

                            if ($customize_section_background == 'Yes'):
                                $section_background_options = get_sub_field('section_background_options');
                                $background_color = $section_background_options['background_color'];
                                $background_image = $section_background_options['background_image'];
                                $customize_background_image = $section_background_options['customize_background_image'];

                                //CUSTOMIZE BACKGROUND IMAGE
                                if ($customize_background_image == 'Yes'):
                                    $background_image_repeat = $section_background_options['background_image_repeat'];
                                    $background_image_position = $section_background_options['background_image_position'];
                                    $background_image_size = $section_background_options['background_image_size'];

                                else:

                                    $background_image_repeat = 'no-repeat';
                                    $background_image_position = 'center';
                                    $background_image_size = 'cover';

                                endif; //END IF CUSTOMIZE BACKGROUND IMAGE

                            endif; //END IF CUSTOMIZE SECTION BACKGROUND

                            //ADD CONTENT SECTION DIV
                            $pageHTML .= '<div class="content-section"';
                            //ADD A SECTION HEADLINE

                            if ($customize_section_background == 'Yes'):

                                $pageHTML .= ' style="';

                                //CUSTOM SECTION BACKGROUND STYLING

                                if ($background_color):
                                    $pageHTML .= 'background-color:' . $background_color . '; ';
                                endif;

                                if ($background_image):
                                    $pageHTML .= 'background-image:url(' . $background_image . '); ';

                                    if ($background_image_repeat):
                                        $pageHTML .= ' background-repeat:' . $background_image_repeat . ';';
                                    else:
                                        $pageHTML .= ' background-repeat:no-repeat;';
                                    endif;

                                    if ($background_image_position):
                                        $pageHTML .= 'background-position:' . $background_image_position . ';';
                                    endif;

                                    if ($background_image_size):
                                        $pageHTML .= ' background-size:' . $background_image_size . ';';
                                    endif;

                                endif;

                                $pageHTML .= '" id="' . $content_section_name . '"';

                            endif; //end if customize section background

                            $pageHTML .= '>'; //end of div declaration

                            $add_a_section_headline = get_sub_field('add_a_section_headline');

                            if ($add_a_section_headline == 'Yes'):

                                require FUNCTIONS . '/section_headline.php';
                            
                            elseif ($add_a_section_headline == 'No'):
                            $headlineHTML = '';
                            
                            endif; //END IF ADD SECTION HEADLINE

                            if ($content_section_type == 'Custom Section'):

                                $pageHTML .= $headlineHTML;
                                require FUNCTIONS . '/custom_content.php';

                            elseif ($content_section_type == 'Client Logo Grid'):

                                $pageHTML .= $headlineHTML;
                                $clientsHTML = make_logo_grid();
                                $pageHTML .= $clientsHTML;

                            elseif ($content_section_type == 'Team Bio'):
                                $pageHTML .= $headlineHTML;
                                $bioHTML ='';
                                $bioType = get_sub_field('number_of_people_to_display');
                                // $bioHTML ='<h2>' . $bioType . '</h2>';
                                if ($bioType == 'Single Bio'):
                                    $team_member = get_sub_field('single_bio');
                                    $bioHTML .= do_bio($team_member, $headlineHTML);
                                elseif ($bioType == 'All Team Members'):
                                    $bioHTML .= all_bios();
                                endif;
                                $pageHTML .= $bioHTML;
                            elseif ($content_section_type == 'Post Feed'):

                                $pageHTML .= $headlineHTML;
                                $feedHTML = build_feed();
                                $pageHTML .= $feedHTML;

                            elseif ($content_section_type == 'Subscribe Form'):

                                $subscribe_form_shortcode = get_sub_field('subscribe_form_shortcode');
                                $formHTML = build_subscribe_form($subscribe_form_shortcode, $headlineHTML);
                                $pageHTML .= $formHTML;

                            elseif ($content_section_type == 'Testimonials'):

                                $pageHTML .= $headlineHTML;
                                $testimonialsHTML = build_testimonials();
                                $pageHTML .= $testimonialsHTML;

                            elseif ($content_section_type == 'Case Studies'):

                                $pageHTML .= $headlineHTML;
                                $casesHTML = build_case_studies();
                                $pageHTML .= $casesHTML;

                            endif; // END CONTENT SECTION TYPE IF

                            //END CONTENT SECTION DIV
                            $pageHTML .= '</div><!-- .content-section #' . $content_section_name . '-->';
                            
                            $add_section_bottom_border = get_sub_field('add_section_bottom_border');

                            if($add_section_bottom_border == 'Yes'){
                                $pageHTML .= '<div class="container"><div class="section-sep"></div></div>';
                            }
                        endwhile; //END CONTENT SECTIONS WHILE

                    endif; // END CONTENT SECTIONS IF

                    echo $pageHTML;

                    ?>


				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer();?>
