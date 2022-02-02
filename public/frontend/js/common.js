(function($) {

"use strict";
 


/*Quantity*/
    $(document).on('click', '.quantity .plus', function() {
        var $qty = $(this).parents('.quantity').find('.qty');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });

    $(document).on('click', '.quantity .minus', function() {
        var $qty = $(this).parents('.quantity').find('.qty');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal) && currentVal > 1) {
            $qty.val(currentVal - 1);
        }
    });
   


/*flexslider*/
    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 135,
        itemMargin: 6,
        asNavFor: '#slider'
    });

    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        start: function(slider) {
            $('body').removeClass('loading');
        }
    });






})(jQuery);