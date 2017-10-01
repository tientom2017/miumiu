jQuery(document).ready(function(){
 
    // hide #back-top first
    jQuery("#back-top").hide();
 
    // fade in #back-top
    jQuery(function () {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#back-top').fadeIn();
            } else {
                jQuery('#back-top').fadeOut();
            }
        });
 
        // scroll body to 0px on click
        jQuery('#back-top a').click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
    
    /* js qc 2 ben */
    if ( jQuery('.rt-ads-left').length ) {
        var obj = jQuery('.rt-ads-left'),
            csstransition = obj.attr('data-csstransition') == 'true' ? true : false,
            easing = obj.attr('data-easing');

        obj.stickyfloat({ duration: 400, cssTransition: csstransition, easing: easing });
    }
    if ( jQuery('.rt-ads-right').length ) {
        var obj = jQuery('.rt-ads-right'),
            csstransition = obj.attr('data-csstransition') == 'true' ? true : false,
            easing = obj.attr('data-easing');

        obj.stickyfloat({ duration: 400, cssTransition: csstransition, easing: easing });
    }

});