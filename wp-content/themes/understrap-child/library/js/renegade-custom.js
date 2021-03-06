// Custom scripts
jQuery(document).on("scroll", function(){
    // console.log($(document).scrollTop());
    // shrinking sticky navigation
    if ($(document).scrollTop() > 100) {
        $("#wrapper-navbar").addClass("shrink");
    }
    else {
        $("#wrapper-navbar").removeClass("shrink");
    }
});

//SLIDER HEIGHT SCRIPT

jQuery(document).ready(function ($) {
//alert('slider height');

var slider = $('.slideshow-ct');


if(slider){
    
    setSlideshowHeight();
}


$(window).resize(function(){
    setSlideshowHeight();
    
});

});

function setSlideshowHeight(){
    var slideshow_ct = $('.slideshow-ct');

    $(slideshow_ct).each(function(){
        var h_arr = new Array()
        var slideshow = $(this).children('.slideshow');
        var slides = $(slideshow).children('.slide-ct');

        $(slides).each(function(){
            var slide_element = $(this).children('.slide-element');

            $(slide_element).each(function(){
                var eh = $(this).height();
                h_arr.push(eh);
            })
        })

        var slider_height = Math.max.apply(Math,h_arr);

        $(this).height(slider_height);

        var content_section = $(this).parent('.content-section');
        $(content_section).css('padding', '0px');

    })
}
function setSliderHeight(){
    

var h_arr = new Array();
var element = $('.slide-element');

var slide_ct = $(element).parent('.slide-ct');
$(slide_ct).parent('.slideshow-ct');


$(element).each(function(){
    var eh = $(this).height();
    h_arr.push(eh);
})


var slider_height = Math.max.apply(Math,h_arr);

$(slide_ct ).height(slider_height);
}

// Mobile specific scripts
jQuery(document).ready(function ($) {

    // prevent orphans
    $("p").unorphanize();
    $(".sans").unorphanize();
    // check if mobile
    // TODO: consider making this global
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
        isMobile = true;
    }
    // navbar click and touch behaviors
    if (isMobile) {
        // tap events
        $('.menu-item-has-children > a').singletap(function() { 
            $('.menu-item-has-children.show > a').singletap(function() { 
                // console.log('singletap show to '+link);
                window.location = $(this).attr("href");
            });
            return false; 
        }).doubletap(function() { 
            // console.log('doubletap to '+link);
            window.location = $(this).attr("href");
        });
    } else {
        var link = $(this).attr("href");
        $(".menu-item-has-children > a").click(function () {
            // console.log('click to '+link);
            window.location = $(this).attr("href");
        });
    }

    // Inifinite Scroll using Isotope, Packery & jQuery

    // init
    var $grid = $('.grid').isotope({
        // options...
        itemSelector: 'div[class*="grid__item"]',
    });
    
    // get Packery instance
    var iso = $grid.data('isotope');
    
    // init Infinite Scroll
    $grid.infiniteScroll({
        // Infinite Scroll options...
        path: 'a.page-link',
        append: 'div[class*="grid__item"]',
        loadOnScroll: false,
        button: '.view-more-button',
        // load pages on button click
        scrollThreshold: false,
        // disable loading on scroll
        status: '.loader-wheel',
        hideNav: '.pagination',
        outlayer: iso
    });

    // layout Isotope after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.isotope('layout');
    });

    // $grid.on( 'last.infiniteScroll', function( event, response, path ) {
        // console.log( 'Loaded last page: ' + path );
    // });

    // hide view-more button if no more next page link
    var $nextLink = $('a.page-link');
    if ( !$nextLink.length ) {
        $('.view-more-button').hide();
    }

    // jquery autocomplete
    $('input[name="s"]').autoComplete({
		source: function(name, response) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/wp-admin/admin-ajax.php',
				data: 'action=get_listing_names&name='+name,
				success: function(data) {
					response(data);
				}
			});
        },
        minChars: 2,
        delay: 150,
        cache: true,
        onSelect: function(e, term, item){
            window.location.href = "/?s=" + term.split(' ').join('+');
        }
	});
    
});