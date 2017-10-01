<?php
define( 'CHILD_THEME_NAME', 'RT Normal' );
define( 'CHILD_THEME_URL', 'http://thietkewebmienphi.com' );
define( 'CHILD_THEME_VERSION', '1.0' );


//* Start the engine
require_once( get_template_directory() . '/lib/init.php' );
require_once( STYLESHEETPATH . '/lib/rt-init.php' );
require_once( STYLESHEETPATH . '/lib/rt-mobile/Mobile_Detect.php' );

$detect = new Mobile_Detect;

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );
//* Add support for custom background
add_theme_support( 'custom-background' );
// remove meta version wp
remove_action('wp_head', 'wp_generator');
// Add image header
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );


if ( !function_exists( 'rt_add_meta_genesis' ) ) {
	add_action('genesis_meta','rt_add_meta_genesis');
	function rt_add_meta_genesis() {
		$responsive_enable = gtid_get_option( 'site_settings_responsive_enable' );
		if ( $responsive_enable == 'disable' ) {
			echo '<meta name="viewport" content="width=1200">';
		}
	}	
}
/**
 * Add theme support for WooCommerce.
 *
 * @author  NamNCN
 */
function rt_after_setup() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'rt_after_setup' );


if ( !function_exists( 'rt_add_meta_genesis' ) ) {
	add_action('genesis_meta','rt_add_meta_genesis');
	function rt_add_meta_genesis() {
		$responsive_enable = gtid_get_option( 'site_settings_responsive_enable' );
		if ( $responsive_enable == 'disable' ) {
			echo '<meta name="viewport" content="width=1200">';
		}
	}	
}

// remove menu if is not admin
if ( ! function_exists( 'rt_remove_menu_user' ) ) {
	//add_action( 'admin_menu', 'rt_remove_menu_user', 999);
	function rt_remove_menu_user(){
		remove_submenu_page( 'index.php', 'update-core.php' ); // Update
		remove_submenu_page( 'themes.php', 'theme-editor.php' ); // Theme editor
		remove_submenu_page( 'themes.php', 'customize.php' ); // Customize
		remove_submenu_page( 'themes.php', 'themes.php' ); // Customize
		//remove_submenu_page( 'users.php', 'users-user-role-editor.php' );
		remove_submenu_page( 'options-general.php', 'settings-user-role-editor.php' );

		if(!current_user_can('administrator')){
			remove_menu_page('wpcf7');
			remove_menu_page('genesis');
			remove_menu_page('dd_button_setup');
			remove_menu_page('wpseo_dashboard');
			remove_menu_page('edit.php?post_type=acf');
			remove_menu_page( 'options-general.php' );
		}
	}
}

// add favicon 
if ( ! function_exists( 'rt_add_favicon' ) ) {
	function rt_add_favicon(){
		$favicon = gtid_get_option('header_settings_favicon');
		if( count( $favicon ) > 0 && ! empty( $favicon ) ){
			echo  "<link rel='shortcut icon' type='image/png' href='" . $favicon['url'] . "' />";
		}else{
			echo "<link rel='shortcut icon' href='". get_stylesheet_directory_uri() ."/images/favicon.ico' />";
		}
	}
	add_filter( 'genesis_pre_load_favicon', 'rt_add_favicon' );
}

// Hook header in genesis
if ( !function_exists( 'rt_hook_header_genesis' ) ) {
	remove_action( 'genesis_header', 'genesis_do_header' );
	add_action('genesis_header','rt_hook_header_genesis');
	function rt_hook_header_genesis() {
		$linkhome   		= get_option('siteurl');
		$banner        		= gtid_get_option('header_settings_banner');
		$logo        		= gtid_get_option('header_settings_logo');
		$logo_mobile        = gtid_get_option('header_settings_logo_mobile');

		if( count( $banner ) > 0 && ! empty( $banner ) ) {
			$banner_css = "background-image:url(". $banner['url'] .")";
		}
		echo "<div class='header-banner' style='{$banner_css}'>";
			echo '<div class="wrap">';
				if ( count( $logo ) > 0 && ! empty( $logo ) ) {
					echo '<div class="header-logo">';
						echo "<a class='banner-mobile' href='{$linkhome}' title='".get_bloginfo('name')."'><img src='". $logo['url'] ."' alt='".get_bloginfo('name')."' /></a>";
					echo '</div>';	
				}
				if ( is_dynamic_sidebar( 'header-right' ) ) {
					echo '<div class="header-content">';
						dynamic_sidebar( 'header-right' );
					echo '</div>';	
				}
				if ( count( $logo_mobile ) > 0 && ! empty( $logo_mobile ) ) {
					echo '<div class="header-logo-mobile">';
						echo "<a class='banner-mobile' href='{$linkhome}' title='".get_bloginfo('name')."'><img src='". $logo_mobile['url'] ."' alt='".get_bloginfo('name')."' /></a>";
					echo '</div>';	
				}
			echo '</div>';
		echo "</div>";
	}
}

// Add slide
function add_slide() {
	$shortcode = gtid_get_option('home_settings_shortcode_slide');
	if ( !empty( $shortcode )) :
		if(is_home()) :
			echo do_shortcode( "{$shortcode}" );
		endif;
	endif;
}
add_action ('genesis_before_content_sidebar_wrap','add_slide');

// Remove logo admin
function remove_wp_admin_bar_logo() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'remove_wp_admin_bar_logo', 0);


//add link raothue
add_action('genesis_footer','add_raothue_link');
function add_raothue_link(){
	echo "<p id='credit-link'>
			<a rel='nofollow' target='_blank' href='http://thietkewebmienphi.com/' title='thiet ke website' >
			<strong>Design by RT Group </strong>
			</a>
		</p>";
	echo "<p id='back-top'> <a href='#top'><span></span></a> </p>";
}

/* an bang dieu khien thua` */
function remove_dashboard_widgets(){
	global$wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['social4i_admin_widget']);
}
//add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// remove widget mac dinh
add_action( 'widgets_init', 'my_unregister_widgets' );
function my_unregister_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('Genesis_Featured_Page');
	unregister_widget('Genesis_Featured_Post');
	unregister_widget('Genesis_User_Profile_Widget');
}

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets',1,2);
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Thông tin Hệ Thống Admin', 'custom_dashboard_help');
}

function custom_dashboard_help() {
	echo '<p style="font-size:15px;line-height:1.5">Chào mừng Quý khách đến với hệ thống Quản Trị Website.<br/>
	Hệ thống được phát triển bởi <strong>RaoThue</strong> trên nền tảng <strong>Wordpress</strong>.<br />
	Để xem hướng dẫn quản trị website, vui lòng xem tại link sau : <a target="_blank" href="http://www.hocquantri.net/quantriweb/">Hướng dẫn quản trị Website</a> <br />
	Mọi thắc mắc, lỗi trong quá trình sử dụng Quý khách hàng có thể liên hệ bộ phận Kỹ Thuật :<br/>
	<strong>Điện thoại </strong>: 04. 66 800 900 ( giờ hành chính )<br/>
	<strong>Email</strong>: web@raothue.com <br/>
	<strong>Web</strong>: <a href="http://webrt.vn/">Webrt.vn - raothue.com</a><br/>
	Cảm ơn quý khách đã tin tưởng và sử dụng sản phẩm của chúng tôi.
	</p>';
}

// Fix Seo by yoast
add_filter( 'wpseo_canonical', '__return_false' );

//* Remove comment form allowed tags

remove_action( 'genesis_after_post', 'genesis_get_comments_template' );

// Remove Widget

function remove_widgets() {
	if(current_user_can('activate_plugins')) {
		unregister_widget('WP_Widget_Meta' );
	}
}

//Add Footer widget
add_theme_support('genesis-footer-widgets',1); // add number widget in footer
remove_action('genesis_after_header','genesis_do_subnav');
remove_action('genesis_footer','genesis_do_footer');

	/* add css */
function add_slider_css() {
	wp_enqueue_style( "support-css", CHILD_URL."/lib/css/support.css" );
	wp_register_style( "logo-slide", CHILD_URL."/lib/css/logo-slide.css" );
	wp_enqueue_style( "woocomm-css", CHILD_URL."/lib/css/woocomm.css" );

	/* own css */
	wp_register_style( "owl-carousel-css", CHILD_URL."/lib/css/owl.carousel.css" );
	wp_register_style( "owl-theme-css", CHILD_URL."/lib/css/owl.theme.css" );

	/* short code css */
	wp_enqueue_style( "blog-shortcode-css", CHILD_URL."/lib/css/rt-blog-shortcode.css" );
	wp_enqueue_style( "product-style-css", CHILD_URL."/lib/css/rt-product-style.css" );
}

if( !is_admin() ) {
	add_action( "wp_enqueue_scripts", "add_slider_css" );
}

function add_style_css_admin() {
	wp_register_style( "widget-css", CHILD_URL."/lib/css/widget.css" );
}
if( is_admin() ) {
	add_action( "admin_head", "add_style_css_admin" );
}
	/* add js */
function add_slider_js() {
	wp_enqueue_script( "backtop", CHILD_URL."/lib/js/backtop.js", array( "jquery" ) );
	// slider logo + product
	wp_register_script('jquery.easing-1.3', CHILD_URL.'//lib/js2/jquery.easing-1.3.js', array('jquery'), '1.0.1');
	wp_register_script('jquery.mousewheel', CHILD_URL.'//lib/js2/jquery.mousewheel-3.1.12.js', array('jquery'), '1.0.1');
	wp_register_script('jquery.jcarousellite', CHILD_URL.'//lib/js2/jquery.jcarousellite.js', array('jquery'), '1.0.1');
	wp_register_script('slide-js', CHILD_URL.'//lib/js2/slide.js', array('jquery'), '1.0.1');

	// own carousel
	wp_register_script('own-carousel-js', CHILD_URL.'//lib/js/owl.carousel.js', array('jquery'), '1.0.1');
	wp_register_script('owl-carousel-min-js', CHILD_URL.'//lib/js/owl.carousel.min.js', array('jquery'), '1.0.1');
	wp_register_script('owl-slider-js', CHILD_URL.'//lib/js/own-slider.js', array('jquery'), '1.0.1');

	// upload js
	wp_register_script('my-admin-js2', CHILD_URL.'//lib/js/upload.js', array('jquery'));

    wp_register_script( "rt-adv-float", CHILD_URL."/lib/js/stickyfloat.js", array(), "1.0", false );
    if ( gtid_get_option('ads_sideout_settings_enable') == 'enable' ) wp_enqueue_script( "rt-adv-float" );

}
if( !is_admin() ) {
	add_action( "wp_enqueue_scripts", "add_slider_js" );
}

/**
 *
 * Child Theme hook body class
 *
 * @param    
 * @return $classes
 *
 */
if ( ! function_exists( 'rt_render_banner_side_out' ) ) {
    function rt_render_banner_side_out( ) {
        $html = '';
        // Banner Left and Right config
        //var_dump(gtid_get_option('ads_sideout_settings_enable'));
         if ( gtid_get_option('ads_sideout_settings_enable') == 'enable' ) {
         	$banner_site_out_width                     	= gtid_get_option('ads_sideout_settings_left_image_width');

            $theme_setup_banner_site_out_left         	= gtid_get_option('ads_sideout_settings_left_image');
            $theme_setup_banner_site_out_right         	= gtid_get_option('ads_sideout_settings_right_image');
            $ads_sideout_settings_left_image_link       = gtid_get_option('ads_sideout_settings_left_image_link');
            $ads_sideout_settings_right_image_link 		= gtid_get_option('ads_sideout_settings_right_image_link');
            

			$banner_site_out_width_position         	= 0;
			$banner_site_out_width_number_px         	= str_replace( 'px', '', $banner_site_out_width );
			$banner_site_out_width_number_percent     	= str_replace( '%', '', $banner_site_out_width );

			// kc 2 ben
			$theme_setup_banner_left_right_distance    	= gtid_get_option('ads_sideout_settings_left_right_distance');
        	// kc tren duoi
        	$theme_setup_banner_above_distance   		= gtid_get_option('ads_sideout_settings_above_distance');

            $theme_setup_banner_left_right_number       = str_replace( 'px', '', $theme_setup_banner_left_right_distance );
            

            if ( $banner_site_out_width_number_px  	   != $banner_site_out_width ) {
                $banner_site_out_width_position 		= intval ( $banner_site_out_width_number_px ) + intval( $theme_setup_banner_left_right_number );
                $banner_site_out_width_position        .= 'px';
            }
            if ( $banner_site_out_width_number_percent != $banner_site_out_width ) {
                $banner_site_out_width_position 		= intval ( $banner_site_out_width_number_percent ) + intval( $theme_setup_banner_left_right_number );
                $banner_site_out_width_position 	   .= '%';
            }

            $before_link_left = $after_link_left = '';
            if ( ! empty( $ads_sideout_settings_left_image_link ) ) {
            	$before_link_left = '<a href="'. $ads_sideout_settings_left_image_link .'">';
            	$after_link_left = '</a>';
            }
            $before_link_right = $after_link_right = '';
            if ( ! empty( $ads_sideout_settings_right_image_link ) ) {
            	$before_link_right = '<a href="'. $ads_sideout_settings_right_image_link .'">';
            	$after_link_right = '</a>';
            }
            
            // Render html banner side out
            if ( ! empty( $theme_setup_banner_site_out_left['url'] ) ) {
                $html .= '<div class="rt-ads-left" data-csstransition="'. ( ( $banner_site_out_csstransition ) ? 'true' : 'false' ) .'" data-easing="'. $banner_site_out_easing .'" style="width: '. $banner_site_out_width .'; left: -'. $banner_site_out_width_position .';margin-top: ' . $theme_setup_banner_above_distance . ' ">'. $before_link_left .'<img src="'. $theme_setup_banner_site_out_left['url'] .'" width="100%" alt="Rao Thue Banner Left">'. $after_link_left .'</div>';
            }
            if ( ! empty( $theme_setup_banner_site_out_right['url'] ) ) {
                $html .= '<div class="rt-ads-right" data-csstransition="'. ( ( $banner_site_out_csstransition ) ? 'true' : 'false' ) .'" data-easing="'. $banner_site_out_easing .'" style="width: '. $banner_site_out_width .'; right: -'. $banner_site_out_width_position .';margin-top: ' . $theme_setup_banner_above_distance . ' ">'. $before_link_right .'<img src="'. $theme_setup_banner_site_out_right['url'] .'" width="100%" alt="Rao Thue Banner Right">'. $after_link_right .'</div>';
            }
         }
        return $html;
    }
}

if ( ! function_exists( 'add_banner_side_out_footer' ) ) {
     function add_banner_side_out_footer() {
        echo rt_render_banner_side_out();
     }
     add_action('genesis_after_header','add_banner_side_out_footer');
}

// hide admin
if ( ! function_exists( 'yoursite_pre_user_query' ) ) {
	// add_action('pre_user_query','yoursite_pre_user_query');
	  function yoursite_pre_user_query($user_search) {
		global $current_user;
		$username = $current_user->user_login;
		if ($username != 'adminraothue') {
		  global $wpdb;
		  $user_search->query_where = str_replace('WHERE 1=1',
			"WHERE 1=1 AND {$wpdb->users}.user_login != 'adminraothue'",$user_search->query_where);
		}
	}
}
  // hide admin css
if ( ! function_exists( 'yoursite_pre_user_css' ) ) {
	// add_action('admin_head','yoursite_pre_user_css');
	function yoursite_pre_user_css($user_search) {
		global $current_user;
		$username = $current_user->user_login;
		if ($username != 'adminraothue') {
		  wp_enqueue_style( "admin-css", CHILD_URL."/lib/css/adminuser.css" );
		}
	}
}
/**
 * Add Thumb Size
**/
//add_image_size( 'rt_thumb600x300', 600, 300, array( 'center', 'center' ) );


if( $detect->isMobile() && !$detect->isTablet() ){
	function insert_menumobile() {
		echo '<div class="menu-repons"><button class="secondary-toggle">MENU</button></div>';
	}
	add_action( 'genesis_header','insert_menumobile' );
	function add_slider_script() {
		wp_enqueue_style( "responsive-css", CHILD_URL."/res2.css" );
		wp_enqueue_script( "menumobile", CHILD_URL."/lib/js/mobile.js", array( "jquery" ) );
	}
	if( !is_admin() ) {
		add_action( "wp_enqueue_scripts", "add_slider_script" );
	}
}