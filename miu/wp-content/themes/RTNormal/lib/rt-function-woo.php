<?php 
/* woocommerce setup 
---------------------------------------------------------------------------------------------------------------------------*/
// product woocommerce
function get_productcat_name( $cat_id ) {
  $cat_id = (int) $cat_id;
  $category = get_term( $cat_id, 'product_cat' );
  if ( ! $category || is_wp_error( $category ) )
    return '';
  return $category->name;
}

function get_productcat_link( $category ) {
  if ( ! is_object( $category ) )
    $category = (int) $category;
  $category = get_term_link( $category, 'product_cat' );
  if ( is_wp_error( $category ) )
    return '';
  return $category;
}

// remove field checkout ko can thiet
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
  unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_city']);
  unset($fields['billing']['billing_company']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_address_2']);
  return $fields;
}
// remove widgets ko can thiet
function remove_woo_widgets() {
  unregister_widget( 'WC_Widget_Recent_Products' );
  unregister_widget( 'WC_Widget_Featured_Products' );
  unregister_widget( 'WC_Widget_Product_Categories' );
  unregister_widget( 'WC_Widget_Product_Tag_Cloud' );
  //unregister_widget( 'WC_Widget_Cart' );
  unregister_widget( 'WC_Widget_Layered_Nav' );
  unregister_widget( 'WC_Widget_Layered_Nav_Filters' );
  unregister_widget( 'WC_Widget_Price_Filter' );
  unregister_widget( 'WC_Widget_Top_Rated_Products' );
  unregister_widget( 'WC_Widget_Recent_Reviews' );
  unregister_widget( 'WC_Widget_Recently_Viewed' );
  unregister_widget( 'WC_Widget_Best_Sellers' );
  unregister_widget( 'WC_Widget_Onsale' );
  unregister_widget( 'WC_Widget_Random_Products' );
}
add_action( 'widgets_init', 'remove_woo_widgets' );

add_action('woocommerce_single_product_summary' , 'add_single_product_widget', 50);

// add % sale price
function add_percent_sale(){
  global $product;
  if ($product->is_on_sale()){
    $per = round((( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
    echo "<span class='percent'>-$per%</span>";
  }
}
/* rename tab single pro */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
  $tabs['description']['title'] = __( 'Thông tin sản phẩm' );        // Rename the reviews tab
  //tab moi
  //$tabs['processus']['title'] = __( 'Tab mới 1' );
  //$tabs['thongso']['title'] = __( 'Tab mới 2' );

  //$tabs['processus']['priority']= 50;
  //$tabs['thongso']['priority']= 60;
  //$tabs['processus']['callback']='content_tab_processus';
  return $tabs;
}

// du lieu tab moi
function content_tab_processus() {
  // $thongso = get_field('thongso');
  //if(!empty($thongso)){ echo $thongso;}else { echo "Chưa có thông số kỹ thuật";}
  echo "Nội dung tab mới";
}
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    //unset( $tabs['description'] );        // Remove the description tab
    unset( $tabs['reviews'] );      // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;

}
/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function custom_woocommerce_product_add_to_cart_text() {
  global $product;
  
  $product_type = $product->product_type;
  
  switch ( $product_type ) {
    case 'simple':
      return __( 'Đặt hàng', 'woocommerce' );
    break;

    default:
      return __( 'Read more', 'woocommerce' );
  }
  
}
if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
  /**
   * Show the product title in the product loop. By default this is an H3.
   */
  function woocommerce_template_loop_product_title() {
    echo '<h3><a class="title" href="' . get_permalink() . '"  title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
  }
}
////////////views
if (  ! function_exists( 'woocommerce_template_loop_product_views' ) ) {
  /**
   * Show the product title in the product loop. By default this is an H3.
   */
  function woocommerce_template_loop_product_views() {
    echo '<a class="views-all" href="' . get_permalink() . '"  title="' . get_the_title() . '"> Chi tiết </a>';
  }
}

if (  ! function_exists( 'woocommerce_template_loop_product_price' ) ) {
  /**
   * Show the product price in the product loop. By default this is an H3.
   */
  function woocommerce_template_loop_product_price() {
    global $product;
    $gia  = $product->regular_price;
    $giakm  = $product->sale_price;
    echo '<span class="price">';
    if(!empty($giakm) && !empty($gia) ) {
            echo "<del> <span>" . number_format($gia,0,'','.')." đ </span></del> <ins> <span>" . number_format($giakm,0,'','.') . " đ</span></ins>";
    }else{
        echo "<span>";
        if(!empty($gia)) echo number_format($gia,0,'','.')." đ"; else echo " Liên Hệ";
        echo "</span>"; 
    }
    echo "</span>";
  }
}


if (  ! function_exists( 'woocommerce_template_loop_product_review' ) ) {
    function woocommerce_template_loop_product_review() {
      $review = get_field ('review');
      if ($review) {
        echo"<span class='star'>";
          for ($i=0; $i < 5; $i++):
            if ($i < $review ) {
             echo '<i class="fa fa-star" aria-hidden="true"></i>';
            }else{
              echo'<i class="fa fa-star-half-o" aria-hidden="true"></i>';
            }
          endfor;
        echo "</span>";  
      }
    }
}
/**
 *
 * add data Attribute 
 *
 * @param    
 * @return  
 *
 */
if ( ! function_exists( 'add_attribut_woocommerce' ) ) {
  function add_attribut_woocommerce() {
    global $product;
    $has_row    = false;
    $alt        = 1;
    $attributes = $product->get_attributes();
    $class    = '';
    if ( count( $attributes ) % 2 == 0 && wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {
      $class = 'number-one';
    }elseif( count( $attributes ) % 2 == 0 && ( !wc_product_sku_enabled() || !$product->get_sku() || !$product->is_type( 'variable' ) ) ) {
      $class = 'number-two';
    }elseif ( count( $attributes ) % 2 != 0 && wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {
      $class = 'number-two';
    }elseif ( count( $attributes ) == 0 && ( !wc_product_sku_enabled() || !$product->get_sku() || !$product->is_type( 'variable' ) ) ) {
      $class = 'number-zezo';
    }else {
      $class = 'number-one';
    }
    if ( $class != 'number-zezo' ) {
    echo "<ul class='attribute-single ". $class ."'>";
    if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : 
  ?>  
      <li class="sku_wrapper">
        <span class="left"><?php _e( 'SKU:', 'woocommerce' ); ?></span>
        <span class="right" itemprop="sku">
          <?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?>
        </span>
      </li>

  <?php 
    endif;
    $x =2;
    foreach ( $attributes as $attribute ) :
      if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
        continue;
      } else {
        $has_row = true;
      }
      ?>
      <li>
        <span class="left"><?php echo wc_attribute_label( $attribute['name'] ) . ': '; ?></span>
        <span class="right"><?php
          if ( $attribute['is_taxonomy'] ) {

            $values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
            echo strip_tags( apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ) );

          } else {

            // Convert pipes to commas and display values
            $values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
            echo strip_tags( apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ) );

          }
        ?></span>
      </li>
  <?php 
    $x++;
    endforeach;
    echo "</ul>";
    }
  }
  add_action('woocommerce_single_product_summary','add_attribut_woocommerce',11);
}
//remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
//remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);


/* layout product */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
//remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_title', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_price', 6 );
add_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_views',9);
add_action('woocommerce_after_shop_loop_item','woocommerce_template_single_excerpt',8);
add_action('woocommerce_after_shop_loop_item','add_percent_sale',11);
add_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_review',7);
?>
