<?php 
global $url,$no_thum,$product,$loop;
$gia = $product->regular_price;
$giakm = $product->sale_price;
?>
  <li class="product-item">
    <div class="product-img">
        <a class="img hover-zoom" data-tooltip="123456789" data-img-full="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID,'full')); ?>"  href="<?php the_permalink();?>" title="<?php the_title();?>">
            <?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
                else echo $no_thum; ?>
        </a> 
    </div>
    <a class="product-title" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
    <p class="price">
    <?php
        if(!empty($giakm) && !empty($gia) ) {
            echo number_format($giakm,0,'','.')." VNĐ <del>" . number_format($gia,0,'','.') . " VNĐ</del>";
        }else{
            if(!empty($gia)) echo number_format($gia,0,'','.')." VNĐ"; else echo " Liên Hệ"; 
        }
    ?>
    </p>
    <p class="add_to_cart"> 
        <?php 
            echo apply_filters( 'woocommerce_loop_add_to_cart_link',
            sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $class ) ? $class : 'button' ),
            esc_html( $product->add_to_cart_text() )
        ),
            $product );
        ?>
    </p>
</li>