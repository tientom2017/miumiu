jQuery(document).ready(function(){
    // Menu Mobile nav
    jQuery("nav[role=navigation]").each(function(){
        jQuery(this).removeClass('nav-primary');
        jQuery(this).addClass('nav-primary-mobile');

        var menu = jQuery( '.nav-primary-mobile' );
        menu.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"></button>' );

        jQuery('.secondary-toggle').click(function(){
            menu.slideToggle('500');
            jQuery( this ).toggleClass( 'toggled-on' );
        });

        jQuery( '.dropdown-toggle', this ).click(function(){
            jQuery( this ).toggleClass( 'toggled-on' );
            //menu.toggleClass( 'toggled-on' );
            jQuery( this ).next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
        });
    }); // end menu top

    // Menu mobile sidebar
    jQuery(".sidebar .widget_nav_menu").each(function(){
        jQuery('ul.menu', jQuery( this ) ).addClass('sidebar-mobile');
        jQuery('ul.sidebar-mobile', jQuery( this ) ).removeClass('menu');

        var menusibar = jQuery( '.sidebar-mobile' );
        menusibar.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false"></button>' );

        jQuery( '.dropdown-toggle' , this ).click(function(){
            jQuery( this ).toggleClass( 'toggled-on' );
            //menusibar.toggleClass( 'toggled-on' );
            jQuery( this ).next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
        });

    }); // end menu mobile sidebar

});