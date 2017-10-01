<?php
add_action('widgets_init', create_function('', "register_widget('GTID_Image_Slider');"));
class GTID_Image_Slider extends WP_Widget {

  function GTID_Image_Slider() {
    $widget_ops = array( 'classname' => 'img-slider', 'description' => __('Image slider', 'genesis') );
    $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'imgslide' );
    $this->WP_Widget( 'imgslide', __('RT-logo slider', 'genesis'), $widget_ops, $control_ops );
        add_action('wp_enqueue_scripts', array(&$this, 'gtid_scripts'));
  }

  function widget($args, $instance) {
    extract($args);

        
    echo $before_widget;            
            $instance = wp_parse_args( (array)$instance, array(
              'title'       => '',
              'link'        => '',
              'numpro'      => 0,
              'items'		=> 3,
              'cat' => '',
            ) );
            echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
            ?>
                <div class="block_ads">
                   
          	<div class="preview-slider"> 
                <a class="prev" href="#">
                	<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                </a> 
         		<a class="next" href="#">
         			<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
         		</a>
         	</div>
              <div class="slide-ads" data-number="<?php echo $instance['items']; ?>">
                            
                    <ul>
                   
                     <?php for($i = 0; $i < $instance['numpro']; $i++) : ?>
                             <li><a href="<?php echo $instance['img_link_'.$i]; ?>" rel="nofollow" target="_blank">
                                 <img src="<?php echo $instance['img_src_'.$i]; ?>" alt="Logo" />
                             </a></li>
                      <?php endfor; ?> 

                    </ul>
                </div>
                </div> <!-- ----- -->
            <?php

    echo $after_widget;
  } //

  function update($new_instance, $old_instance) {
    return $new_instance;
  } //
  function form($instance) {

    // ensure value exists
    $instance = wp_parse_args( (array)$instance, array(
      'title'       => '',
      'link'        => '',
      'numpro'      => 0,
      'items'		=> 3,
      'cat' 		=> '',
    ) );

?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'genesis'); ?>:</label>
    <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:99%;" /></p>

        <div style="margin: 10px 0 0;overflow: hidden;">
        	<div style="float: left;width: 43%;">
          <label for="<?php echo $this->get_field_id('numpro'); ?>" style="display: block;float: left;line-height: 32px;width: 63px;">
            <?php _e('Số lượng', 'genesis'); ?>:
          </label>
            <input type="text" id="<?php echo $this->get_field_id('numpro'); ?>" name="<?php echo $this->get_field_name('numpro'); ?>" value="<?php echo esc_attr( $instance['numpro'] ); ?>" size="2" />
            </div>
            <div style="float: left; width: 38%;">
				<label for="<?php echo $this->get_field_id('items'); ?>" style="display: block;float: left;line-height: 32px;width: 44px;">
				<?php _e('items', 'genesis'); ?>:
				</label>
				<input type="text" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" value="<?php echo esc_attr( $instance['items'] ); ?>" size="2" />
            </div>
              <input type="submit" value="Save" class="button-primary widget-control-save" id="savewidget" name="savewidget" style="float: right;"/>   
        </div>      
        <br/>
            

        <?php for($i = 0; $i < $instance['numpro']; $i++) : ?>
            <div style="background: #F5F5F5; margin-bottom: 10px; padding: 10px;">
                <p><label for="<?php echo $this->get_field_id('img_src_'.$i); ?>"><?php _e('Link ảnh ', 'genesis');  echo $i+1;?>:</label>
                <input type="text" id="<?php echo $this->get_field_id('img_src_'.$i); ?>" name="<?php echo $this->get_field_name('img_src_'.$i); ?>" value="<?php echo esc_attr( $instance['img_src_'.$i] ); ?>" style="width:90%;" /></p>
                <p><label for="<?php echo $this->get_field_id('img_link_'.$i); ?>"><?php _e('Link khi click vào ảnh ', 'genesis'); echo $i+1; ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('img_link_'.$i); ?>" name="<?php echo $this->get_field_name('img_link_'.$i); ?>" value="<?php echo esc_attr( $instance['img_link_'.$i] ); ?>" style="width:90%;" /></p>
            </div>
        <?php 
          endfor; 
        ?>
  <?php
  }  //


// end logo slider --------------------------------------------------------------------------------
    function gtid_scripts() {
        if ( is_active_widget( false, false, $this->id_base, true ) ) {
        // wp_enqueue_script('jquery');
        wp_enqueue_style("logo-slide");
        wp_enqueue_script( "jquery.easing-1.3" );
        wp_enqueue_script( "jquery.mousewheel" );
        wp_enqueue_script( "jquery.jcarousellite" );
        wp_enqueue_script( "slide-js" );
        }
    }
}