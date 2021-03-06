"use strict";
jQuery(document).ready(function ($) {

//for Preloader

    $(window).load(function () {
        $("#loading").fadeOut(500);
    });


    /*---------------------------------------------*
     * Mobile menu
     ---------------------------------------------*/
    $('#navbar-menu, .inner-link').find('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: (target.offset().top - 80)
                }, 1000);
                if ($('.navbar-toggle').css('display') != 'none') {
                    $(this).parents('.container').find(".navbar-toggle").trigger("click");
                }
                return false;
            }
        }
    });



    /*---------------------------------------------*
     * WOW
     ---------------------------------------------*/

    var wow = new WOW({
        mobile: false // trigger animations on mobile devices (default is true)
    });
    wow.init();

// magnificPopup

    $('.popup-img').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    $('.video-link').magnificPopup({
        type: 'iframe'
    });



// slick slider active Home Page Tow
    $(".hello_slid").slick({
        dots: true,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<i class='icon icon-chevron-left nextprevleft'></i>",
        nextArrow: "<i class='icon icon-chevron-right nextprevright'></i>",
        autoplay: true,
        autoplaySpeed: 2000
    });
    
    
    
    $(".business_items").slick({
        dots: true,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: "<i class='icon icon-chevron-left nextprevleft'></i>",
        nextArrow: "<i class='icon icon-chevron-right nextprevright'></i>",
        autoplay: true,
        autoplaySpeed: 2000
    });




//---------------------------------------------
// Scroll Up 
//---------------------------------------------

    $('.scrollup').click(function () {
        $("html, body").animate({scrollTop: 0}, 1000);
        return false;
    });


});

function showMessage(title, message, alertType){
    swal({
        title: title,
        text: message,
        confirmButtonText: "Okay",
        customClass: 'facebook',
        html: true,
        type: alertType
    });
}

jQuery(document).ready(function(){
    jQuery(".underProcessing").click(function(e) {
        e.preventDefault();
        showMessage("Under-Processing", "The webpage you requested is underprocessing.<br/> Please check back.", "error");
    });
    
    jQuery(".inactive").bind({
        mouseover: function(e){
            e.preventDefault();
            jQuery(this).css('cursor','not-allowed').addClass('alert-danger');
        },
        click: function(e){
            e.preventDefault();
            jQuery(this).css('cursor','not-allowed').addClass('alert-danger');;
        }
    });
    
    $("button.book-now").simplePopup({ type: "html", htmlSelector: "#paypage" });
    $("button.book-now").hover(function(){
        var thisPage = $('#paypage');
        thisPage.find('h4').text('BOOK TITLE: '+$(this).attr('data-name'));
        $('form#payform input#book').val($(this).attr('data-id'));
        $('form#payform input#amounts').val(parseInt($(this).attr('data-amount')));
        $('form#payform input#amount').val(parseInt($(this).attr('data-amount')));
        $('form#payform input#category').val(parseInt($(this).attr('data-category')));
        
    });
    //read url and navigate to appropriate section
    var section = window.location.href.slice(window.location.href.indexOf('#') + 1);
    
    if (section.length) {
        $('html,body').animate({
            scrollTop: ($('#'+section).offset().top - 100)
        }, 1000);
        
    }

});

