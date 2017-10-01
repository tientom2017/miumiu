jQuery(document).ready(function($){
if ( $().owlCarousel ) {
            var owl = jQuery(".owl-carousel");
            owl.each(function(){
	            var items    				= $(this).data('item'),
					autoplay   				= $(this).data('autoplay'),
					margin    				= $(this).data('margin'),
					//loop    				= $(this).data('loop'),
					center    				= $(this).data('center'),
					nav    					= $(this).data('nav'),
					dots    				= $(this).data('dots'),
					mobile    				= $(this).data('mobile'),
					tablet    				= $(this).data('tablet'),
					desktop   				= $(this).data('desktop'),
					URLhashListener 		= $(this).data('URLhashListener'),
					autoplayTimeout 		= $(this).data('autoplayTimeout'),
					autoheight   			= $(this).data('autoheight');

	            $(this).owlCarousel({
					items: items,
					margin: parseInt( margin ),
					loop: true,
					center: center == "true" ? true : false,
					autoplay: autoplay,
					autoplayTimeout: autoplayTimeout,
					autoplaySpeed: 3000,
					nav: nav == "true" ? true : false,
					autoHeight : autoheight == "true" ? true : false,
					navText: [
					'<i class="fa fa-angle-left"></i>',
					'<i class="fa fa-angle-right"></i>'
					],
					dots: false, //dots == "true" ? true : false,
					lazyLoad: true,
					lazyContent: true,
					responsive: {
						320: {
							items: mobile
						},
						480: {
							items: mobile
						},
						768: {
							items: tablet
						},
						992: {
							items: desktop
						},
						1200: {
							items: items
						}
		             },
	             // URLhashListener: URLhashListener == "true" ? true : false,
	            });
        	});
        }
});