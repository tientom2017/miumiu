<?php
    get_header();
    do_action( 'genesis_before_content_sidebar_wrap' );
    $url = get_stylesheet_directory_uri();
    $no_thum = "<img src='".$url."/images/custom/no_thumb.png' alt='no_thumb' />";
    /* product */
    $slugproduct = gtid_get_option('home_settings_product_categories_slug');
    $numproduct = gtid_get_option('home_settings_number_product');
    /* new */
    $slugpost = gtid_get_option('home_settings_post_categories_slug');
    $numpost = gtid_get_option('home_settings_number_new');
?>
    <div class="content-sidebar-wrap">
        <?php do_action( 'genesis_before_content' ); ?>
        <main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
            <?php
                do_action( 'genesis_before_loop' );
            ?>
        <div id="home-news">
        <?php if ( !empty ( $slugproduct ) ) : ?>
            <div class="product-news-wrap">
                <?php 
                    foreach ($slugproduct as $key => $slug) :
                    $idObj = get_term_by('slug', $slug , 'product_cat');
                    $idpro = $idObj->term_id;
                ?>
                <h2 class="heading">
                    <a href="<?php echo get_productcat_link($idpro); ?>" title="<?php echo get_productcat_name($idpro);?>">
                        <?php echo get_productcat_name($idpro); ?>
                    </a>
                </h2>
                <div class="clear"></div>
                <?php echo do_shortcode('[rtproduct style="1" posts_per_page="'. $numproduct .'" categories="'. $idpro .'"]'); ?>

                <?php endforeach;// Kết thúc vòng lặp For số box sản phẩm ?>
            </div><!-- Product Wrap -->
        <?php endif; ?> <!-- end if slug product -->
        <!-- ----------------------------------------------------------------- -->
            <div class="clear"></div>
            
        <?php if ( !empty ( $slugpost ) ) : ?>
            <div class="news-wrap">
                <?php 
                    foreach ($slugpost as $key => $slug) :
                    $idObj  = get_term_by('slug', $slug , 'category');
                    $idpost = $idObj->term_id;
                ?>
                    <h2 class="heading">
                        <a href="<?php echo get_category_link($idpost); ?>" title="<?php echo get_cat_name($idpost);?>">
                            <?php echo get_cat_name($idpost); ?>
                        </a>
                    </h2>
                    <div class="clear"></div>
                    <div class="news-list">
                    <?php echo do_shortcode('[rtblog style="1" posts_per_page="' . $numpost . '" categories="' . $idpost . '" custom_text="Xem Thêm"]'); ?>
                    </div><!--News-List-->

                <?php endforeach;// Kết thúc vòng lặp For số box sản phẩm ?>        
            </div><!--End #news-wrap-->
        <?php endif; ?> <!-- end if new box -->
        </div> <!-- end home news -->
            
        </main><!-- end #content -->
                  <!--#End #home-news-->
        <?php do_action( 'genesis_after_content' ); ?>
   </div> <!-- end #content-sidebar-wrap -->
     
<?php
	dynamic_sidebar( 'demo' );
    do_action( 'genesis_after_content_sidebar_wrap' );
    get_footer();
?>