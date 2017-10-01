<?php
	get_header();
	do_action( 'genesis_before_content_sidebar_wrap' );
	?>
	<div class="content-sidebar-wrap">
		<?php do_action( 'genesis_before_content' ); ?>
		<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<?php
				do_action( 'genesis_before_loop' );
			?>
            <div id="search-result">
   			<h2 class="heading">Kết quả tìm kiếm : <?php echo $_GET['s']; ?></h2>
         	<ul class="product-list">
                <?php
                    if(have_posts()) {
                        while(have_posts()){
                            the_post();
                          get_template_part('inc/loop-new' );  
                        }//End while
                    }//Endif
                ?>
            </ul><!--End .product-list-->
            </div>
            <?php
				do_action( 'genesis_after_loop' );
			?>
		</main><!-- end #content -->
		<?php do_action( 'genesis_after_content' ); ?>
	</div><!-- end #content-sidebar-wrap -->
	<?php
	do_action( 'genesis_after_content_sidebar_wrap' );
	get_footer();
?>