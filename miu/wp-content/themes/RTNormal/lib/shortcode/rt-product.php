<?php
/**
 * Shortcode RT Blog.
 *
 * @since  1.0
 * @author TuanNA
 * @link   http://ceotuanna.com
 */
class rt_rtproduct_shortcode {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode( 'rtproduct', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $atts, $content = '') {
		$html = '';

		extract( shortcode_atts( array(
			'style'   						=> '1',
			'posts_per_page'				=> '6',
			'categories'					=> '',
			'custom_text'					=> 'Xem tất cả',
			'custom_link'					=> '',
			//'hide_category'					=> '1',
			//'hide_viewmore'					=> '1',
		), $atts ) );

		//wp_enqueue_style( 'rt-rtblog' );

        if( is_numeric( $categories ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' 			=> 'product_cat',
                    'field'    			=> 'ID',
                    'terms'    			=> $categories,
                ),
            );
            $args['posts_per_page'] = $posts_per_page;
        }else {
            $args['tax_query'] = array(
                array(
                    'taxonomy' 			=> 'product_cat',
                    'field'    			=> 'slug',
                    'terms'    			=> $categories,
                ),
            );
            $args['posts_per_page'] = $posts_per_page;
        }

		$the_query = new WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) {
			$html .= '<div class="style-product-'. $style .' rt-shortcodes rt-product-shortcode">';
			switch ( $style ) {
				default:
					$html .= $this->rt_product_style_1( $the_query, $atts );
					break;
			}
			if ( ! empty( $custom_link ) ) {
				$html .= '<div class="entry-continue"><a href="'. $custom_link .'">'. $custom_text .'</a></div>';
			}
			$html .= '</div>';
		}

		echo $html;
	}

	/**
	 *
	 * Blog shortcode style 1
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog shortcode style 1
	 *
	 */
	function rt_product_style_1 ( $the_query, $atts ) {
		extract( shortcode_atts( array(
			'style'   						=> '1',
		), $atts ) );

		//$i = 0;
		$html = '';
		//$image_size = 'rt_thumb300x200';

		echo '<ul class="products product-list style-product-' . $style . '">';
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;
			$post_class = array( 'element', 'hentry', 'post-item' );

			echo $this->rt_general_product_html( $post_class, $atts );
		}
		echo '</ul>';
	}

	/**
	 *
	 * General post html
	 *
	 * @param  $post_class: class of post
	 * @return $html: html of post
	 *
	 */
	function rt_general_product_html ( $post_class = array(), array $atts = array() ) {
		extract( shortcode_atts( array(
			'style'				=> '1',
		), $atts ) );
		
		
		$html = '';
		//$html .= '<ul class="products product-list style-product-' . $style . '">';
		$html .= wc_get_template_part( 'content', 'product' );
		//$html .= '</ul>';
		echo $html;
	}

}
new rt_rtproduct_shortcode();

