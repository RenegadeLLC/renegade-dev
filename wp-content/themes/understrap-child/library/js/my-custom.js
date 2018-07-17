// Custom scripts
jQuery(document).ready(function ($) {
    $(".menu-item-has-children > a").dblclick(function () {
        // alert("click test " + $(this).attr("href"));
        window.location = $(this).attr("href");
    });
    // double-tap handler
    // TODO: write into a plugin
    // var tapped = false;
    // $('.menu-item-has-children > a').on("touchstart", function (e) {
    //     if (!tapped) { //if tap is not set, set up single tap
    //         tapped = setTimeout(function () {
    //             tapped = null;
    //             //insert things you want to do when single tapped
    //         }, 300); //wait 300ms then run single click code
    //     } else { //tapped within 300ms of last tap. double tap
    //         clearTimeout(tapped); //stop single tap callback
    //         tapped = null;
    //         //insert things you want to do when double tapped
    //         window.location = $(this).attr("href");
    //     }
    //     e.preventDefault()
    // });
});