

//SLIDER SCRIPT

jQuery(document).ready(function ($) {

  //References to DOM elements
  var $window = $(window);
  var $document = $(document);

  var slide = $('.slide-ct');
	var nav_arrows = $('.arrows-ct');
  var frame = $('.slideshow-ct');

  //SET CURRENT SLIDE
  var current_slide = $('.slide-ct:first').attr('id');
  current_slide	= '#' + current_slide;
  //SET CURRENT BACKGORUND
  var current_background = $(current_slide).children('.slide-background');
  //SET CURRENT TEXT
  var current_element = $(current_slide).children('.slide-element');
  var current_text = $(current_element).children('.text-ct');


  var last_slide = $('.slide:last');
  var numSlides = $('.slide-ct').length;
  var n = 1;
  
//INITIATE SLIDER
  function slider_init(){

    //ON MOUSEOVER FADE ARROWS IN
    var nav_arrows = $('.arrows-ct');
		$(frame).on('mouseover', function(){
				TweenLite.to(nav_arrows, .5, {alpha:1, ease: Power1.easeInOut})		
		})
		//ON MOUSEOVER FADE ARROWS OUT
		$(frame).on('mouseout', function(){	
				TweenLite.to(nav_arrows, .5, {alpha:0, ease: Power1.easeInOut})
			})
    
    //TURN OFF SLIDE-OFF CLASS ON FIRST SLIDE
    $( current_slide).toggleClass('slide-off');
    
		
    
   
  TweenLite.fromTo(current_background, 1.25, {css:{alpha:0}}, {css:{alpha:1}, ease: Power1.easeInOut, delay: 0});
  TweenLite.fromTo(current_text, 1.5, {css:{left:'100%'}}, {css:{left:'0%;'}, ease: Power1.easeInOut, delay:.25});
  TweenLite.fromTo(current_text, 1, {css:{alpha:.1}}, {css:{alpha:1}, ease: Power1.easeInOut, delay:1});

  
		slideshow_start();
  }

  function slideshow_start() {
		 
  	autoplay_timer = setInterval(function(){ goNext(current_slide); }, 5000);
 
    
    //TweenLite.to(text, 2.5, {css:{alpha:0}}, {css:{alpha:1}, ease: Power1.easeInOut,});
    //TweenLite.to(text, .5, {alpha:0, ease: Power1.easeInOut})
		}
	 
	 function slideshow_stop() {
		   clearInterval(autoplay_timer);
    }
    
    function goNext(current_slide){
		  
      slideshow_stop();
      
      if(n < numSlides){

        //GET NEXT SLIDE
        next_slide = $(current_slide).next(slide).attr('id');
        next_slide = '#' + next_slide;
        $(next_slide).removeClass('slide-off');
        
        n++

      } else {
       
        //SET FIRST SLIDE AS NEXT SLIDE
        next_slide = $('.slide-ct:first').attr('id');
        next_slide = '#' + next_slide;	
       
        //RESET N TO 1
        n = 1;		
      }
      
      //ESTABLISH THE NEXT SLIDE BACKGROUND AND TEXT
      var next_background = $(next_slide).children('.slide-background');
      var next_element = $(next_slide).children('.slide-element');
      var next_text = $(next_element).children('.text-ct');

      //GO TO NEXT SLIDE
      TweenLite.fromTo(current_slide, 1.25, {css:{left:'0%'}}, {css:{left:'-100%'}, ease: Power1.easeInOut,});
      TweenLite.fromTo(next_slide, 1.25, {css:{left:'100%'}}, {css:{left:'0%'}, ease: Power1.easeInOut,});

      //FADE BACKGROUND UP
      TweenLite.fromTo(next_background, 1.5, {css:{alpha:0}}, {css:{alpha:1}, ease: Power1.easeInOut,});
      //SLIDE AND FADE TEXT IN
      TweenLite.fromTo(next_text, 1.5, {css:{left:'100%'}}, {css:{left:'0%;'}, ease: Power1.easeInOut, delay:.25});
      TweenLite.fromTo(next_text, 1, {css:{alpha:.1}}, {css:{alpha:1}, ease: Power1.easeInOut, delay:1});
      update_next();
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

        var previous_background = $(previous_slide).children('.slide-background');
        var previous_element = $(previous_slide).children('.slide-element');
        var previous_text = $(previous_element).children('.text-ct');

      TweenLite.fromTo(current_slide, 1, {css:{left:'0%'}}, {css:{left:'100%'}, ease:Power3.easeOut});
      TweenLite.fromTo(previous_slide, 1, {css:{left:'-100%'}}, {css:{left:'0%'}, ease:Power3.easeOut});

      //FADE BACKGROUND UP
      TweenLite.fromTo(previous_background, 1.5, {css:{alpha:0}}, {css:{alpha:1}, ease: Power1.easeInOut,});
      //SLIDE AND FADE TEXT IN
      TweenLite.fromTo(previous_text, 1.5, {css:{left:'-100%'}}, {css:{left:'0%;'}, ease: Power1.easeInOut, delay:.25});
      TweenLite.fromTo(previous_text, 1, {css:{alpha:.1}}, {css:{alpha:1}, ease: Power1.easeInOut, delay:1});

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