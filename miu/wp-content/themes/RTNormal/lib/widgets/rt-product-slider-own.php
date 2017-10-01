<?php 
/**
 * Tạo class Thachpham_Widget
 */
function get_layout_product() {
	//wc_get_template_part( 'content', 'product' );
	?>
<div class="item">
	<div class="product-inner">
		<?php
			do_action( 'woocommerce_before_shop_loop_item' );
			echo "<a class='img hover-zoom' href='" . get_permalink( ) . "' title='" . get_the_title() . "' >";
				echo woocommerce_get_product_thumbnail();
			echo "</a>";
			do_action( 'woocommerce_shop_loop_item_title' );
			do_action( 'woocommerce_after_shop_loop_item_title' );
			do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div>
</div>

	<?php
}

function get_layout_post() {
?>

<?php
}

add_action( 'widgets_init', 'create_slider_widget' );
	function create_slider_widget() {
        register_widget('RT_Widget_Slider_Product_Own');
}
class RT_Widget_Slider_Product_Own extends WP_Widget {
 
        /**
         * Thiết lập widget: đặt tên, base ID
         */
        function __construct() {
 			$widget_ops = array( 'classname' => 'slider-product-own', 'description' => __('Slider product', 'genesis') );
		    $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'slider-own' );
		    $this->WP_Widget( 'slider-own', __('RT-Slider Product own', 'genesis'), $widget_ops, $control_ops );
        }
 
        /**
         * Tạo form option cho widget
         */
        function form( $instance ) {
 			// defaults
		    $instance = wp_parse_args( (array)$instance, array(
		      'title'       			=> '',
		      'style_slider'  			=> '',
		      'cat' 					=> '',
		      'taxonomy'				=> '',
		      'data_style'				=> '',
		      'autoplay'				=> 'false',
		      'autoplayTimeout'			=> '5000',
		      'margin'					=> '',
		      'autoplaySpeed'			=> '3000',
		      'items'					=> 3
		    ) );
		    wp_enqueue_style("widget-css");
		?>
	  	<div class="form-widget">
		  	<label for="<?php echo $this->get_field_id('title'); ?>">
		  		<?php _e('Tiêu đề', 'genesis'); ?>:
		  	</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
    	</div>
	    <!-- ------------------------------------- -->
	    <div class="form-widget">
		    <label for="<?php echo $this->get_field_id('taxonomy'); ?>">
		      <?php _e('Post type', 'genesis'); ?>:
		    </label>
		    <select id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
		        <option value=""  <?php if ( $instance['taxonomy']  == '' ) {echo "selected"; } ?> >Tùy chọn</option>
		        <option value="product_cat"  <?php if ( $instance['taxonomy'] == 'product_cat' ) {echo "selected"; } ?> >Product</option>
		        <option value="category" <?php if ( $instance['taxonomy'] == 'category' ) {echo "selected"; } ?> >Post</option>
		    </select>
	    </div>
	    <!-- --------------------------------------------- -->
	    <?php  
	    	$posttype =  substr($instance['taxonomy'], -1);
	    	if ( !empty( $posttype ) ) :
	    ?>
            <div class="form-widget">
                <label for="<?php  echo $this-> get_field_id('cat'); ?>" style="display: block;float: left;line-height: 32px;width: 120px;">
                  <?php  _e('Chuyên mục','genesis'); ?>:
                </label>
                <?php
                    wp_dropdown_categories(array('name'=> $this->get_field_name('cat'),'selected'=>$instance['cat'],'orderby'=>'Name','hierarchical'=>1,'show_option_all'=>__('Tất cả','genesis'),'hide_empty'=>'0','taxonomy' => $instance['taxonomy'] )); ?>
            </div>
            <!-- ------------------------------------------------------ -->
            <div class="form-widget">
	             <label for="<?php echo $this->get_field_id('giaodien'); ?>"><?php _e('Giao diện', 'genesis'); ?>:</label>
	            <select id="<?php echo $this->get_field_id('style_slider'); ?>" name="<?php echo $this->get_field_name('style_slider'); ?>">
	            <?php 
	                for ($i=1; $i < 9; $i++) { 
	            ?>
	                <option value="style-<?php echo $i; ?>" <?php selected( 'style-'.$i , $instance['data_style']); ?>>Giao diện <?php echo $i; ?></option>
	            <?php
	                }
	            ?>
	            </select>
            </div>
            <!-- ------------------------------------------------------------------- -->
            <div class="form-widget">
            	<div class="table">
					<p>
					 	<label for="<?php  echo $this->get_field_id('items'); ?>">
		                	<?php  _e('items', 'genesis'); ?>:
		                </label>
	                	<input type="text" id="<?php  echo $this->get_field_id('items'); ?>" name="<?php  echo $this->get_field_name('items'); ?>" value="<?php  echo esc_attr( $instance['items'] ); ?>" />
				    	<label for="<?php echo $this->get_field_id('width'); ?>">
				    		<?php _e('autoplay', 'genesis'); ?>:
				    	</label>
						<select id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>">
					        <option value="true"  <?php if ( $instance['autoplay'] == 'true' ) {echo "selected"; } ?> >True</option>
					        <option value="false" <?php if ( $instance['autoplay'] == 'false' ) {echo "selected"; } ?> >False</option>
					    </select>
					</p>
					<p>
				    	<label for="<?php echo $this->get_field_id('margin'); ?>">
				    		<?php _e('margin', 'genesis'); ?>:
				    	</label>
						<input type="text" id="<?php echo $this->get_field_id('margin'); ?>" name="<?php echo $this->get_field_name('margin'); ?>" value="<?php echo esc_attr( $instance['margin'] ); ?>" size="2" />
						<label for="<?php echo $this->get_field_id('width'); ?>">
							<?php _e('Time', 'genesis'); ?>:
						</label>
						<input type="text" id="<?php echo $this->get_field_id('autoplayTimeout'); ?>" name="<?php echo $this->get_field_name('autoplayTimeout'); ?>" value="<?php echo esc_attr( $instance['autoplayTimeout'] ); ?>" size="2" />
					
					</p>
				</div>
	        </div>

		<?php
	    	endif; // $posttype != 0
	    ?>
		<?php
        }
 
        /**
         * save widget form
         */
 
        function update( $new_instance, $old_instance ) {
 			return $new_instance;
        }
 
        /**
         * Show widget
         */
 
        function widget( $args, $instance ) {
		 	$instance = wp_parse_args( (array)$instance, array(
				'title'       			=> '',
				'style_slider'  		=> '',
				'cat' 					=> '',
				'posttype'				=> '',
				'taxonomy'				=> '',
				'data_style'			=> '',
				'autoplay'				=> 'false',
				'autoplayTimeout'		=> '5000',
				'margin'				=> '10',
				'items'					=> 3
		    ) );
			$items 					= $instance['items'] ;
			$autoplay 				= $instance['autoplay'] ;
			$autoplayTimeout 		= $instance['autoplayTimeout'] ;
			$margin 				= $instance['margin'] ;
			$cat 					= $instance['cat'] ;
			$style_slider 			= $instance['style_slider'] ;
			$taxonomy 				= $instance['taxonomy'] ;
			$posttype 				= '';
			if ( $taxonomy == 'product_cat' ) {
				$posttype = 'product';
			}else{
				$posttype = 'post';
			}
			extract($args);
			echo $before_widget;
		    if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;

        ?>
		<div id="owl-demo" class="owl-carousel <?php echo $instance['style_slider']; ?>" data-item="<?php echo $items; ?>" data-autoplay="<?php echo $autoplay; ?>" data-autoplayTimeout="<?php echo $autoplayTimeout; ?>" data-margin="<?php echo $margin; ?>">

		<?php 
			$hot = new WP_Query(array(
				'post_type' => $posttype,
				'tax_query' => array(
					array(
						'taxonomy'  => $taxonomy,
						'field' 	=> 'id',
						'terms' 	=> $cat
					)
				),
				'showposts' => 40
			));
			while($hot->have_posts()):
			$hot->the_post();
			if ( $taxonomy == 'product_cat' ) {
				get_layout_product();
			}else{
				get_layout_post();
			}

			endwhile; wp_reset_postdata(); 
		?>

		</div>
        <?php
        	wp_enqueue_style("owl-carousel-css");
			wp_enqueue_script( 'own-carousel-js' );
			wp_enqueue_script( 'owl-slider-js' );
			echo $after_widget;
        } // end function widget

} // end class 
?>