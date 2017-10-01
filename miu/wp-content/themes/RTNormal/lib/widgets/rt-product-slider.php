<?php
    //Widget contracter
    add_action('widgets_init', 'register_gtid_product_by_cat');

    function register_gtid_product_by_cat() {
        register_widget('Gtid_Products_Widget');
    }


    class Gtid_Products_Widget extends WP_Widget {

        function Gtid_Products_Widget() {
            $widget_ops = array('classname' => 'products_widget', 'description' => __('Hiển thị một slide sản phẩm chạy dọc', 'genesis') );
            $this->WP_Widget('products_widget', __('RT - Products Slider', 'genesis'), $widget_ops);
        }

        function widget($args, $instance) {
            global $post;
            extract($args);
            $instance = wp_parse_args( (array)$instance, array(  'title' => '', 'numpro' => '', 'cat' => '' , 'data_style' => '' ) );
            echo $before_widget;

            if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
            wp_enqueue_style("logo-slide");
	        wp_enqueue_script( "jquery.easing-1.3" );
	        wp_enqueue_script( "jquery.mousewheel" );
	        wp_enqueue_script( "jquery.jcarousellite" );
	        wp_enqueue_script( "slide-js" );
            ?>

                <div class="promoteslider" data-number="<?php echo $instance['numpro']; ?>">
                <div class="preview-slider"> 
	                <a class="prev" href="#"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	                <a class="next" href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
	         	</div>
                    <ul class="product-list <?php echo $instance['data_style']; ?>">
                        <?php
            $hot = new WP_Query(array(
                'post_type' => 'product',
                'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'id',
                                'terms' => $instance['cat']
                            )
                        ),
                'showposts' => 20
                ));
            while($hot->have_posts()):
            $hot->the_post();
            global $product;
            wc_get_template_part( 'content', 'product' );
            endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
     
            <?php
            echo $after_widget;
        }

        function update($new_instance, $old_instance) {
            return $new_instance;
        }

        function form($instance) {
            $instance = wp_parse_args( 
            	(array)$instance, array( 
	            		'title' 			=> '', 
	            		'numpro' 			=> '3',  
	            		'cat' 				=> '', 
	            		'data_style' 		=> ''
            		) 
            	);
            ?>
            <p>
                <label for="<?php  echo $this->get_field_id('title'); ?>">
                <?php  _e('Title', 'genesis'); ?>:
                </label>
                <input type="text" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php  echo $this->get_field_name('title'); ?>" value="<?php  echo esc_attr( $instance['title'] ); ?>" style="width:95%;" />
            </p>

            <p>
                <label for="<?php  echo $this->get_field_id('numpro'); ?>">
                <?php  _e('Số sản phẩm hiển thị', 'genesis'); ?>:
                </label>
                <input type="text" id="<?php  echo $this->get_field_id('numpro'); ?>" name="<?php  echo $this->get_field_name('numpro'); ?>" value="<?php  echo esc_attr( $instance['numpro'] ); ?>" style="width:10%;" />
            </p>
            <!-- end so luong support -->
            <label for="<?php echo $this->get_field_id('giaodien'); ?>"><?php _e('Giao diện', 'genesis'); ?>:</label>
            <select id="<?php echo $this->get_field_id('data_style'); ?>" name="<?php echo $this->get_field_name('data_style'); ?>" style="width: 165px;">
            <?php 
                for ($i=1; $i < 9; $i++) { 
            ?>
                <option value="style-product-<?php echo $i; ?>" <?php selected( 'style-product-'.$i , $instance['data_style']); ?>>Giao diện <?php echo $i; ?></option>
            <?php
                }
            ?>
            </select>
            <p>
                <label for="<?php  echo $this-> get_field_id('cat'); ?>"><?php  _e('Category','genesis'); ?>:</label>
                <?php
                wp_dropdown_categories(array('name'=> $this->get_field_name('cat'),'selected'=>$instance['cat'],'orderby'=>'Name','hierarchical'=>1,'show_option_all'=>__('All Categories','genesis'),'hide_empty'=>'0', 'taxonomy' => 'product_cat')); ?>
            </p>
        <?php
        }

    }
?>
<?php
    //Add needed scripts
    //add_action('wp_enqueue_scripts', 'gtid_script');
    //function gtid_script() {
      	//if ( is_active_widget( false, false, $this->id_base, true ) ) {
	        // wp_enqueue_script('jquery');
	        
        //}
     
    //}
?>