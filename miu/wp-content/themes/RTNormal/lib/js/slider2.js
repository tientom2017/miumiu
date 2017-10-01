jQuery(document).ready(function(){

	jQuery('.promoteslider').each(function(index, element) {
		
	var value = jQuery(this).attr('data-number');
	    jQuery(this).vTicker({
	        showItems: value
	    });
	});

});