<?php 
global $url,$no_thum;
?>
<li class="news-post item">
	<a class="thumb-new" href="<?php the_permalink();?>" title="<?php the_title();?>">
		<?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
		else echo $no_thum; ?>
	</a>
	<h2>
		<a href="<?php the_permalink();?>" title="<?php the_title();?>">
			<?php echo the_title();?>
		</a>
	</h2>
	<?php the_content_limit(300,'Đọc Thêm');?>

</li><!--End .news-post-->