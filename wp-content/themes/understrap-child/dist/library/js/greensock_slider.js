

//SLIDER SCRIPT

jQuery(document).ready(function ($) {

  //References to DOM elements
  var $window = $(window);
  var $document = $(document);

  var slide = $('.slide-ct');
	var nav_arrows = $('.arrows-ct');
  var frame = $('.slideshow-ct');
  var current_slide = $('.slide-ct:first').attr('id');
  current_slide	= '#' + current_slide;
  var current_text = $(current_slide).children('.text-ct');
  $(current_text).css('border' , '1px solid red');
  var last_slide = $('.slide:last');
  var numSlides;
  var n = 1;
  
  



  

  function slider_init(){

   var nav_arrows = $('.arrows-ct');
			$(frame).on('mouseover', function(){
				
				TweenLite.to(nav_arrows, .5, {alpha:1, ease: Power1.easeInOut})
				
		})
			
		$(frame).on('mouseout', function(){
				
				TweenLite.to(nav_arrows, .5, {alpha:0, ease: Power1.easeInOut})
			})
				 
		$( current_slide).toggleClass('slide-off');
		numSlides = $('.slide-ct').length;
    
		//adjust_slider_height();
		slideshow_start();
  }

  function slideshow_start() {
		 
  //	autoplay_timer = setInterval(function(){ goNext(current_slide); }, 5000);
  var text=$('.text-ct');
  
    //TweenLite.to(text, 2.5, {css:{alpha:0}}, {css:{alpha:1}, ease: Power1.easeInOut,});
    //TweenLite.to(text, .5, {alpha:0, ease: Power1.easeInOut})
		}
	 
	 function slideshow_stop() {
		    //clearInterval(autoplay_timer);
    }
    
    function goNext(current_slide){
		  
      slideshow_stop();
      
      if(n < numSlides){
      
        next_slide = $(current_slide).next(slide).attr('id');
        next_slide = '#' + next_slide;
        $(next_slide).removeClass('slide-off');
        n++
       // alert(next_slide);
      } else {
       
        next_slide = $('.slide-ct:first').attr('id');
        next_slide = '#' + next_slide;	
        //alert(next_slide);
        n = 1;		
      }

     TweenLite.fromTo(current_slide, 1.25, {css:{alpha:1, left:'0%'}}, {css:{alpha:0, left:'-100%'}, ease: Power1.easeInOut,});
     TweenLite.fromTo(next_slide, 1.25, {css:{alpha:0, left:'100%'}}, {css:{alpha:1, left:'0%'}, ease: Power1.easeInOut,});
     var text=$('.text-ct');
     TweenLite.fromTo(text, 2, {css:{alpha:0}}, {css:{alpha:1}, ease: Power1.easeInOut, delay: 1});
      update_next(current_slide);
    }

    function goPrevious(current_slide){
		
      slideshow_stop();
      
       if(n == 1){
        
         previous_slide = $('.slide-ct:last').attr('id');
         previous_slide = '#' + previous_slide;
         
         n = numSlides;
         
      } else {
         
         previous_slide = $(current_slide).prev(slide).attr('id');
         previous_slide = '#' + previous_slide; 	

         n--;
       }
        $(previous_slide).removeClass('slide-off');
        TweenLite.fromTo(current_slide, 1, {css:{alpha:1, left:'0%'}}, {css:{alpha:0, left:'100%'}, ease:Power3.easeOut});
        TweenLite.fromTo(previous_slide, 1, {css:{alpha:0, left:'-100%'}}, {css:{alpha:1, left:'0%'}, ease:Power3.easeOut});
       
        update_previous(current_slide);
       }

       function update_next(){
        current_slide = next_slide;
        slideshow_start();
        
      }
      
      function update_previous(){
        current_slide = previous_slide;
        slideshow_start();
      }
      
      $( '.arrows-next' ).on('click', function(){
       
         goNext(current_slide);
     });	
      
      $( '.arrows-prev' ).on('click', function(){
        
         goPrevious(current_slide);
         
     });	
      
      $('.slider-ct').imagesLoaded( function() {	
      
        slider_init();
       
      })
    
});