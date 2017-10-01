<?php
/**
 * Plugin Name: Slider product RT
 * Plugin URI: http://thietkewebmienphi.com/
 * Description: Plugin demo
 * Version: 1.0 // Đây là phiên bản đầu tiên của plugin
 * Author: D.A.TU
 * Author http://thietkewebmienphi.com/
 * License: GPLv2 
 */
/* code option */
$options_page = get_option('siteurl') . '/wp-admin/admin.php?page=slider-RT/options.php';
function logoslider_options_page() {
    add_options_page('RT-Skill', 'RT-Skill', 10, 'slider-RT/options.php');

}
add_action('admin_menu', 'logoslider_options_page');

/* add js + css */
function hover_zoom_js_css() {
  if ( !is_single() ) {
    wp_enqueue_style( "hover-zoom-css", get_bloginfo('wpurl').'/wp-content/plugins/slider-RT/css/stickytooltip.css' );
    wp_enqueue_script('hover-zoom-js',get_bloginfo('wpurl').'/wp-content/plugins/slider-RT/js/stickytooltip.js');
    wp_enqueue_script('hover-zoom-relace',get_bloginfo('wpurl').'/wp-content/plugins/slider-RT/js/relace.js');
  }
}

function click_zoom_js_css() {
  $link = get_option('siteurl').'/wp-content/plugins/slider-RT';
?>

<link rel="stylesheet"  href="<?php echo $link; ?>/css/colorbox.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo $link; ?>/js/jquery.colorbox.js"></script>
 <script>
    jQuery(".click-zoom").colorbox({rel: 'click-zoom'});
 </script>

<?php
}

/* ----------------------end add js + css ------------------------------ --*/

/* add code hover zoom img */
function code_hover_zoom_class_img() {
  $hoverzoom_content = get_option('giatri3');
  $hoverzoom = get_option('giatri1');
?>
    <div id="mystickytooltip" class="stickytooltip">
        <div style="padding: 5px;">
            <div id="123456789" class="atip" style="width:auto;min-width: 200px;line-height: 0;">
              <?php if ( !empty($hoverzoom) ) { ?>
                <img class="img-zoom" src=""  alt="" />
              <?php
              } 
              if(!empty($hoverzoom_content)){
                echo "<div id='description' class='description'> </div>";
              }
              ?>
            </div>
        </div>
    </div>
<!-- end code tooltip--> 
<?php

}
/* -------------------end code img ---------------- --*/
/* dk show code hover zoom */
$hoverzoom = get_option('giatri1'); // dk in option
$hoverzoomcontent = get_option('giatri3');
        if(!empty($hoverzoom) || !empty($hoverzoomcontent) ){
          add_action('wp_footer', 'hover_zoom_js_css');
          add_action('genesis_footer','code_hover_zoom_class_img');
        }

$clickzoom = get_option('giatri2'); // dk in option
        if(!empty($clickzoom)) {
           add_action('genesis_after_content_sidebar_wrap', 'click_zoom_js_css');
        }

?>
