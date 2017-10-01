jQuery(document).ready(function(){

	jQuery( '.slide-ads' ).each( function() {
		var number_slider = jQuery(this).attr('data-number');
		jQuery(this).jCarouselLite({
			easing: "jswing",
			visible: parseInt(number_slider),
			start:0,
			auto: 4000,
			speed:2000,
			btnPrev: jQuery( this ).parents('.block_ads').find('a.prev'), 
			btnNext:jQuery( this ).parents('.block_ads').find('a.next')
		});
	});

	jQuery( '.promoteslider' ).each( function() {
		var value2 = jQuery(this).attr('data-number');
		jQuery( this ).jCarouselLite({
			easing: "jswing",
			visible: parseInt(value2),
			start:0,
			vertical: true,
			auto: 4000,
			speed:2000,                                
			btnPrev: jQuery('.preview-slider a.prev', jQuery( this )), 
			btnNext: jQuery('.preview-slider a.next', jQuery( this ))
		});
	});
});