<?php
    get_header();
    do_action( 'genesis_before_content_sidebar_wrap' );
    $url = get_stylesheet_directory_uri();
    $linkhome = get_option('siteurl');
    $no_thum = "<img src='".$url."/images/custom/no_thumb.png' alt='no_thumb' />";
?>
	<div class="content-sidebar-wrap">
		<?php do_action( 'genesis_before_content' ); ?>
		<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<?php
				do_action( 'genesis_before_loop' );
				do_action( 'genesis_before_entry' );
			?>
                <div id="product-detail">
                	<?php if(have_posts()) : the_post(); ?>
                    <h1 class="entry-title"><?php the_title();?></h1>
                        <div class="clear"></div>
	                    <div class="entry-content">
							<?php
								the_content();
							?>
	                    </div>
                	<?php endif; ?>
                    </div><!--End. Product-Detail-->

                    <div id="related-post">
                        <h4 class="heading">Bài Viết Liên Quan</h4>
                        <ul class="new-list">
                      <?php
			            $category = wp_get_object_terms( $post->ID, 'category',array('orderby' => 'term_group', 'order' => 'DESC'));
                        global $post;
                        $rel = new WP_Query(array(
                            'cat' => end($category)->term_id,
                            'showposts' => 6,
                            'post__not_in' => array($post->ID)
                        ));
                        if($rel->have_posts()):
                            while($rel->have_posts()):
                            $rel->the_post();
                        ?>
                        <li> 
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" > <?php the_title(); ?> </a>
                        </li>
                        <?php
                            endwhile;
                            endif;
                        ?>
                    </ul>

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