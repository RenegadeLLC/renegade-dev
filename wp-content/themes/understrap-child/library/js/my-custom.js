// Custom scripts
jQuery(document).ready(function ($) {
    var link = $(this).attr("href");
    $(".menu-item-has-children > a").dblclick(function () {
        console.log('doubleclick to '+link);
        window.location = $(this).attr("href");
    });
    // tap events
    $('.menu-item-has-children > a').singletap(function() { 
        console.log('singletap to '+link);
    }).doubletap(function() { 
        console.log('doubletap to '+link);
        window.location = $(this).attr("href");
    });
});