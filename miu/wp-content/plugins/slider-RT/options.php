<?php
$location = $options_page; // Form Action URI
?>

<div class="wrap">
  <h2>Skill RT</h2>
  <p>Chọn chức năng + xem hướng dẫn </p>
  
    <div style="margin-left:0px;">
    <form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>
    <fieldset name="general_options" class="options">
        
      <div class="skill-rt">
      <input type="checkbox" name="giatri1" value="1" <?php echo get_option('giatri1')=="1"?"checked":'' ?>> 
      Hover zoom image + 
      <input type="checkbox" name="giatri3" value="2" <?php echo get_option('giatri3')=="2"?"checked":'' ?>> 
      hovet zoom content
      <p> 
      Hướng dẫn : ( thêm vào thẻ a chứa img ) <br/>
        - Thêm class "hover-zoom"  <br/>
        - Thêm data-tooltip="123456789" <br/>
        - thêm data-img-full=" Link ảnh gôc " <br/>
        Link ảnh mặc định wordpress :    echo wp_get_attachment_url(get_post_thumbnail_id($post->ID,'full'));  <br/>

        -------------------------------------------------------------------- <br/>
        - thêm thẻ có class = "description-zoom" + nội dung bên trong thẻ

      </p>
      </div>

      <div class="skill-rt">
      <input type="checkbox" name="giatri2" value="1" <?php echo get_option('giatri2')=="1"?"checked":'' ?>> 
      Click zoom image <br>
       <p> 
      Hướng dẫn : ( thêm vào thẻ a chứa img ) <br/>
        - Thêm class "click-zoom"  <br/>
        - Thêm href = "Link ảnh gốc"<br/>
        Link ảnh mặc định wordpress :    echo wp_get_attachment_url(get_post_thumbnail_id($post->ID,'full'));  
      </p>
      </div>
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="giatri1, giatri2, giatri3 " />

    </fieldset>
    <p class="submit"><input type="submit"
         name="Submit" value="<?php _e('Update Options') ?>" /></p>
  </form> 


</div>
