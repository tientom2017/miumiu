<?php
	get_header();
    do_action( 'genesis_before_content_sidebar_wrap' );
    $url = get_stylesheet_directory_uri();
    $current_cat_id = get_query_var('cat');
?>
	<div class="content-sidebar-wrap">
		<?php do_action( 'genesis_before_content' );
         ?>
		 <main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<?php
				do_action( 'genesis_before_loop' );
			?>
            <div id="home-news">
            <h1 class="heading"><?php echo get_cat_name( $current_cat_id );?></h1>
			<ul class="new-list">
                    <?php
                        $arg = array(
                        'post_type' => 'post',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'id',
                                'terms' => $current_cat_id
                            )
                        ),
                        'paged'=> get_query_var('paged'),
                        //'posts_per_page'        => 6,
                        );
                        $news_post = new WP_Query($arg);
                        while($news_post -> have_posts()) :
                            $news_post -> the_post();
                            get_template_part('inc/loop-new');
                            endwhile; 
							if(function_exists('wp_pagenavi')) {wp_pagenavi( array( 'query' => $news_post ) );}
                            wp_reset_postdata();
    			     	?>
    			    </ul>
                </div><!--End #news-wrap-->
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