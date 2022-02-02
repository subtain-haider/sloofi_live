(function($) { 

	"use strict";

	$('[data-toggle="offcanvas"]').on('click', function () {
    $('.navbar-collapse').toggleClass('show');
    });



$(".globel_products").owlCarousel({
	loop:true,
	margin:2,
	nav:false,
	responsiveClass:true,
	responsive:{
		0:{
			items:1,
			nav:true
		},
		700:{
			items:2,
			nav:true
		},
		1170:{
			items:2,
			nav:true
		}
	}
  });

    $(".selling_category").owlCarousel({
	loop:true,
	margin:10,
	nav:false,
	responsiveClass:true,
	responsive:{
		0:{
			items:1,
			nav:true
		},
		700:{
			items:2,
			nav:true
		},
		1170:{
			items:4,
			nav:true
		}
	}
  });



 $(".owl-carousel").owlCarousel({
	loop:true,
	margin:0,
	nav:false,
	responsiveClass:true,
	responsive:{
		0:{
			items:1,
			nav:true
		},
		700:{
			items:2,
			nav:true
		},
		1170:{
			items:5,
			nav:true
		}
	}
  });




	})(jQuery);