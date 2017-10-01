<?php
if (  ! defined( 'FW' ) ) {
	die();
}


// Get all product taxonomy of woocommerece
$product_cats = array();
if ( class_exists( 'WooCommerce' ) ) {
	$cats_query = get_terms( array( 
		'taxonomy' => 'product_cat',
		'hide_empty' => false, ) );
	if ( $cats_query ) {
		foreach ( $cats_query as $key => $cat ) {
			// var_dump( $cat );
			$product_cats[$cat->slug] = $cat->name;
		}
	}
}


// Get all categories
$categories = array('title' => 'Chọn slider');
$cats_query = get_terms( array( 
	'taxonomy' => 'category',
	'hide_empty' => false, ) );
if ( $cats_query ) {
	foreach ( $cats_query as $key => $cat ) {
		// var_dump( $cat );
		$categories[$cat->slug] = $cat->name;
	}
}

$options = array(
	
	'site_settings' => array(
		'type' => 'box',
		'options' => array(
			'site_settings_responsive_enable' => array(
				'type'  => 'switch',
				'value' => 'disable',
				'label' => __('Bật/tắt chức năng responsive', '{domain}'),
				'left-choice' => array(
					'value' => 'disable',
					'label' => __('Tắt', '{domain}'),
				),
				'right-choice' => array(
					'value' => 'enable',
					'label' => __('Bật', '{domain}'),
				),
			),
			'header_settings' => array(
			    'type' => 'tab',
			    'options' => array(
			    	'header_general' => array(
						'type' => 'box',
						'title' => __('Thiết lập chung', '{domain}'),
						'options' => array(
							'header_settings_favicon' => array(
								'type'  => 'upload',
								'label' => __( 'Favicon của website', 'FRFRAME' ),
								'images_only' => true,
								'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
							),
						)
					),
			        'header_top' => array(
						'type' => 'box',
						'title' => __('Thiết lập Top Header', '{domain}'),
						'options' => array(
							'header_settings_logo' => array(
								'type'  => 'upload',
								'label' => __( 'Logo của website', 'FRFRAME' ),
								'images_only' => true,
								'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
							),
							'header_settings_logo_mobile' => array(
								'type'  => 'upload',
								'label' => __( 'Logo mobile của website', 'FRFRAME' ),
								'images_only' => true,
								'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
							),
							'header_settings_banner' => array(
								'type'  => 'upload',
								'label' => __( 'Banner của website', 'FRFRAME' ),
								'images_only' => true,
								'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
							),
						)
					),
			    ),
			    'title' => __('Thiết lập Header', '{domain}'),
			    'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
			),
			'home_settings' => array(
			    'type' => 'tab',
			    'options' => array(
			    	'home_settings_shortcode_slide' => array(
						'type'  => 'text',
						'value' => '',
						'label' => __( 'Điền shortcode metaslide', 'FRFRAME' ),
					),
			        'home_settings_product_categories_slug' => array(
						'type'  => 'multi-select',
						'label' => __('Chọn các danh mục sản phẩm', '{domain}'),
						'choices' => $product_cats,
					),
					'home_settings_number_product' => array(
						'type'  => 'text',
						'value' => '6',
						'label' => __( 'Số lượng sản phẩm hiển thị', 'FRFRAME' ),
					),
					'home_settings_post_categories_slug' => array(
						'type'  => 'multi-select',
						'label' => __('Chọn các danh mục bài viết', '{domain}'),
						'choices' => $categories,
					),
					'home_settings_number_new' => array(
						'type'  => 'text',
						'value' => '6',
						'label' => __( 'Số lượng bài viết hiển thị', 'FRFRAME' ),
					),
			    ),
			    'title' => __('Thiết lập trang chủ', '{domain}'),
			    'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
			),
		),
		'title' => __( 'Thiết lập chung', '{domain}'),
		'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
	),

	// 'home_settings' => array(
	// 	'type' => 'box',
	// 	'options' => array(
	// 		'home_settings_product_categories_slug' => array(
	// 			'type'  => 'multi-select',
	// 			'label' => __('Chọn các danh mục sản phẩm', '{domain}'),
	// 			'choices' => $product_cats,
	// 		),
	// 		'home_settings_number_product' => array(
	// 			'type'  => 'text',
	// 			'value' => '6',
	// 			'label' => __( 'Số lượng sản phẩm hiển thị', 'FRFRAME' ),
	// 		),
	// 		'home_settings_post_categories_slug' => array(
	// 			'type'  => 'multi-select',
	// 			'label' => __('Chọn các danh mục bài viết', '{domain}'),
	// 			'choices' => $categories,
	// 		),
	// 	),
	// 	'title' => __( 'Thiết lập trang chủ', '{domain}'),
	// 	'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
	// ),


	'ads_sideout_settings' => array(
		'type' => 'box',
		'options' => array(
			'ads_sideout_settings_enable' => array(
				'type'  => 'switch',
				'value' => 'disable',
				'label' => __('Bật/tắt chức năng hiển thị quảng cáo 2 bên', '{domain}'),
				'left-choice' => array(
					'value' => 'disable',
					'label' => __('Tắt', '{domain}'),
				),
				'right-choice' => array(
					'value' => 'enable',
					'label' => __('Bật', '{domain}'),
				),
			),
			'ads_sideout_settings_left_right_distance' => array(
				'type'  => 'text',
				'value' => '10px',
				'label' => __( 'Khoảng cách trái - phải ', 'FRFRAME' ),
			),
			'ads_sideout_settings_above_distance' => array(
				'type'  => 'text',
				'value' => '80px',
				'label' => __( 'Khoảng cách trên', 'FRFRAME' ),
			),
			'ads_sideout_settings_left_image' => array(
				'type'  => 'upload',
				'label' => __( 'Ảnh trái', 'FRFRAME' ),
				'images_only' => true,
				'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
			),
    		'ads_sideout_settings_left_image_width' => array(
				'type'  => 'text',
				'value' => '100px',
				'label' => __( 'Độ rộng của ảnh trái', 'FRFRAME' ),
			),
			'ads_sideout_settings_left_image_link' => array(
				'type'  => 'text',
				'value' => '',
				'label' => __( 'Link của ảnh trái', 'FRFRAME' ),
			),
			'ads_sideout_settings_right_image' => array(
				'type'  => 'upload',
				'label' => __( 'Ảnh phải', 'FRFRAME' ),
				'images_only' => true,
				'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
			),
    		'ads_sideout_settings_right_image_width' => array(
				'type'  => 'text',
				'value' => '100px',
				'label' => __( 'Độ rộng của ảnh phải', 'FRFRAME' ),
			),
			'ads_sideout_settings_right_image_link' => array(
				'type'  => 'text',
				'value' => '',
				'label' => __( 'Link của ảnh phải', 'FRFRAME' ),
			),
			// 'ads_sideout_settings_enable' => array(
			// 	'type'  => 'multi-select',
			// 	'label' => __('Chọn các danh mục sản phẩm', '{domain}'),
			// 	'choices' => $product_cats,
			// ),
			// 'home_settings_number_product' => array(
			// 	'type'  => 'text',
			// 	'value' => '6',
			// 	'label' => __( 'Số lượng sản phẩm hiển thị', 'FRFRAME' ),
			// ),

			// 'home_settings_post_categories_slug' => array(
			// 	'type'  => 'multi-select',
			// 	'label' => __('Chọn các danh mục bài viết', '{domain}'),
			// 	'choices' => $categories,
			// ),
		),
		'title' => __( 'Thiết lập quảng cáo 2 bên', '{domain}'),
		'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
	),

	
	
);