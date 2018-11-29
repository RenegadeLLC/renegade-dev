<?php

function build_slideshow($navigation_color){  
  
    $slideshowHTML = '';
    $slideshowHTML .= '<div class="slideshow-ct">';
    $slideshowHTML .= '<div class="slideshow">';
    //$slideshowHTML .= '<div class="slideshow">';
    $slidenum = 0;
    $slide_links = array();
    //array_push($slide_links, 'wtf');
   // var_dump('wtf');
    //print_r('link array is ' . $slide_links);

    
    if(have_rows('slides')):
        while(have_rows('slides')):
            the_row();
           $slidenum ++;
            $slide=get_sub_field('slide');
           if($slide):
            
            $post = $slide;
            setup_postdata($post);

           
            $slideHTML = '';
            $slideHTML .= '<div class="slide-ct slide-off';
            if($slidenum == 1):
           //     $slideHTML .= ' active';
            endif;

            $slideID = 'slide-' . $slidenum;
            array_push($slide_links, $slideID);
            

            $slideHTML .= '" id="' . $slideID . '">';

            if(have_rows('slide_element', $post)):
                while(have_rows('slide_element', $post)):
                    the_row();
        
                    $element_type = get_sub_field('element_type');
                    $x_position = get_sub_field('x_position');
                    $y_position = get_sub_field('y_position');
                    $scale = get_sub_field('scale');
                    $rotation = get_sub_field('rotation');
                    $max_width = get_sub_field('max_width');
                
                    
                    $slideHTML .= '<div class="slide-element" ';
                
                  
        
                        $slideHTML .= ' style="';

                        if($element_type=='Image'):
                            $slide_image = get_sub_field('slide_image');
                            $slideHTML .= 'left: ' . $x_position . '; ';
                            $slideHTML .= 'top: ' . $y_position . '; ';
                            $slideHTML .= 'width: ' . $scale . '; ';
                            //$slideHTML .= '<div class="image-ct"';
                        elseif($element_type=='Text'):
                            $slide_text = get_sub_field('slide_text');
                            $text_block_align = get_sub_field('text_block_alignment');
                            $text_align = get_sub_field('text-align');

                            if($text_align == 'Left'){
                                $slideHTML .= ' text-align: left;';
                            }elseif($text_align == 'Right'){
                                $slideHTML .= ' text-align: right;';
                            }elseif($text_align == 'Center'){
                                $slideHTML .= ' text-align: center;';
                            }elseif($text_align == 'Justify'){
                                $slideHTML .= ' text-align: justify;';
                            }

                            if($text_block_align == 'Top Left'){
                                $slideHTML .= ' top: 24px; left: 24px;';
                            }elseif($text_block_align == 'Top Right'){
                                $slideHTML .= ' top: 24px; right: 24px;';
                            }elseif($text_block_align == 'Bottom Left'){
                                $slideHTML .= ' bottom: 24px; left: 24px;';
                            }elseif($text_block_align == 'Bottom Right'){
                                $slideHTML .= ' bottom: 24px; right: 24px;';
                            }
                            
                        endif;

                        
                        
                       // $slideHTML .= 'max-width:' . $max_width . ';';
                       // $slideHTML .= 'rotation: ' . $rotation . '; ';
                       // $slideHTML .= 'opacity: ' . $opacity . '; ';
                       
                        $slideHTML .= '">';
                            if($element_type=='Image'):
                               
                                $slideHTML .= '<img src="' . $slide_image . '" alt="">';
                               // $slideHTML .= '</div><!-- .image-ct -->';

                            elseif($element_type == 'Text'):
                                
                               
                                $slideHTML .= '<div class="text-ct" style="max-width:' . $max_width . ';'; 

                                if($text_align == 'Left'){
                                    $slideHTML .= ' text-align: left;';
                                }elseif($text_align == 'Right'){
                                    $slideHTML .= ' text-align: right;';
                                }elseif($text_align == 'Center'){
                                    $slideHTML .= ' text-align: center;';
                                }elseif($text_align == 'Justify'){
                                    $slideHTML .= ' text-align: justify;';
                                }

                                $slideHTML .= '">';
                               // $slideHTML .= '<div class="text-ct">'; 
                              
                                $slideHTML .= $slide_text;
                               $slideHTML .= '</div><!-- .text-ct -->';
                            endif;

                        $slideHTML .= '</div><!-- .slide-element -->';
                    
                    
                endwhile;
            endif;
            $slideHTML .= '</div><!-- .slide-ct -->';
            $slideshowHTML .= $slideHTML;

        
            wp_reset_postdata();
           endif;

           
           
        endwhile;
    endif;
    $slideshowHTML .= '</div><!-- .slideshow-->';
  //$slideshowHTML .= '</div><!-- .slideshow -->';
 
  $slideshowHTML .= '<div class="arrows-ct"><div class="arrow arrow-left arrows-prev" style="color:' . $navigation_color . ' !important;"><i class="fas fa-angle-left"></i></div><div class="arrow arrow-right arrows-next" style="color:' . $navigation_color . ' !important;"><i class="fas fa-angle-right"></i></div></div>';
  $slideshowHTML .= '</div><!-- .arrows-ct -->';
  
  /*
  $slideshowHTML .= '<div class="nav-ct"><nav><ul>';


    $length = count($slide_links);

    $linknum = 1;

    foreach($slide_links as $link){ 
        $slideshowHTML .= '<li class="slide-nav" id="slidenav-' . $linknum . '"><a href="#' . $link . '"><span></span></a></li>';
        //$slideshowHTML .= '<li class="slide-nav" id="slidenav-' . $linknum . '"></li>';
        $linknum++;
    }
   
    
    $slideshowHTML .= '</ul></nav></div><!-- .nav-ct -->';
    */
    $slideshowHTML .= '</div><!-- .slideshow-ct -->';

    return $slideshowHTML;
}

