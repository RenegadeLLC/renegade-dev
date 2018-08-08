<?php


$headlineHTML = '';
$text_align = $subform_headline_items['text_align'];
$headline_background_image = $subform_headline_items['headline_background_image'];
$section_headline_text = $subform_headline_items['subform_headline_text'];

// headline block
$headlineHTML .='<div class="section-headline-ct row" style="text-align:' . $text_align . ';';
if($headline_background_image):
   echo' background-image:url(' . $headline_background_image . ');';
endif;
$headlineHTML .='">';
//add invisible bk image to set div height
$headlineHTML .='<img src="' . $headline_background_image . '" class="heightSet" />';
$headlineHTML .='<div class="section-headline-text">';

// text headlines
foreach($section_headline_text as $text) {
    $text_copy = $text['text'];
    $text_color = $text['text_color'];
    $text_size = $text['text_size'];
    $headlineHTML .='<' . $text_size. ' style="color:' . $text_color . ';">';
    $headlineHTML .= $text_copy;
    $headlineHTML .='</' . $text_size . '>';
}

$headlineHTML .='</div><!--.section-headline-text -->';
$headlineHTML .='</div><!--.section-headline-ct -->';


// old code
if( have_rows('subform_headline_items') ):
    while ( have_rows('subform_headline_items') ) : the_row();
    
    $headline_background_image = get_sub_field('headline_background_image');
    $text_align = get_sub_field('text_align');
    
    $headlineHTML .= '<div class="section-headline-ct row" style="text-align:' . $text_align . ';';
     if($headline_background_image):
        $headlineHTML .= ' background-image:url(' . $headline_background_image . ');';
     endif;
    
    $headlineHTML .= '">';
    //add invisible bk image to set div height
    $headlineHTML .= '<img src="' . $headline_background_image . '" class="heightSet" />';
    $headlineHTML .= '<div class="section-headline-text">';
    if( have_rows('subform_headline_text') ):
    
    while ( have_rows('section_headine_text') ) : the_row();
    $text = get_sub_field('text');
    $text_color = get_sub_field('text_color');
    $text_size = get_sub_field('text_size');
    
    $headlineHTML .= '<' . $text_size. ' style="color:' . $text_color . ';">';
    $headlineHTML .= $text;
    $headlineHTML .= '</' . $text_size . '>';
    endwhile;//END HEADLINE TEXT REPEATER WHILE
    
    endif;//END HEADLINE TEXT REPEATER IF
    $headlineHTML .= '</div><!--.section-headline-text -->';
    $headlineHTML .= '</div><!--.section-headline-ct -->';
    
    endwhile;
endif;

?>
