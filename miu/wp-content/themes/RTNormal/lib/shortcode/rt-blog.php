<?php
/**
 * Shortcode RT Blog.
 *
 * @since  1.0
 * @author TuanNA
 * @link   http://ceotuanna.com
 */
class rt_rtblog_shortcode {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode( 'rtblog', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $atts, $content = '') {
		$html = '';

		//$atts['style'] = Avada()->settings->get( 'blog_archive_layout' );

		extract( shortcode_atts( array(
			'style'   						=> '1',
			'posts_per_page'				=> '5',
			'categories'					=> '',
			'custom_text'					=> 'Xem Thêm',
			'custom_link'					=> '',
			'hide_category'					=> '1',
			'hide_viewmore'					=> '1',
			'hide_meta'						=> '1'
		), $atts ) );

		//wp_enqueue_style( 'rt-rtblog' );
		// $html = '<h4 class="widget-title widgettitle"><a href="'.get_category_link( $categories ).'">'.get_cat_name( $categories ).'</a></h4>';
		$args = array(
			'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'     => 'id',
                            'terms' => $categories
                        )
                    ),
                 	'posts_per_page'		=> $posts_per_page,
		);

		$the_query = new WP_Query( $args );

		// The Loop

		if ( $the_query->have_posts() ) {

			$html .= '<div class="style-blog-'. $style .' rt-shortcodes rt-blog-shortcode">';
			switch ( $style ) {
				default:
					$html .= $this->rt_blog_style_1( $the_query, $atts );
					break;
			}
			if ( ! empty( $custom_link ) ) {
				$html .= '<div class="entry-continue"><a href="'. $custom_link .'">'. $custom_text .'</a></div>';
			}
			$html .= '</div>';
		}
		//$html .= paginate_links(); 
		return $html;
		
	}

	/**
	 *
	 * Blog shortcode style 1
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog shortcode style 1
	 *
	 */
	function rt_blog_style_1 ( $the_query, $atts ) {
		extract( shortcode_atts( array(
			'style'   						=> '1',
			'posts_per_page'				=> '5',
		), $atts ) );

		$i = 0;
		$html = '';
		$image_size = 'rt_thumb300x200';

		$html .= '<div class="fusion-row">';
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;
			$post_class = array( 'element', 'hentry', 'post-item' );

			switch ( $style ) {
				case '1':
					// $image_size 					= 'rt_thumb370x250';
					$atts['hide_category'] 			= '0';
					$post_class[] 					= 'fusion-one-half fusion-spacing-yes fusion-layout-column';
					$post_class[] 					= ( $i % 2 == 0 ) ? 'fusion-column-last' : '';

					$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					if ( ( $posts_per_page > 2 ) && ( $i % 2 == 0 ) ) {
						$html .= '</div><div class="fusion-row">';
					}
					break;
				case '2':
					// $image_size 					= 'rt_thumb370x250';
					$atts['hide_category'] 			= '0';
					$post_class[] 					= 'fusion-one-third fusion-spacing-yes fusion-layout-column';
					$post_class[] 					= ( $i % 3 == 0 ) ? 'fusion-column-last' : '';

					$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					if ( ( $posts_per_page > 3 ) && ( $i % 3 == 0 ) ) {
						$html .= '</div><div class="fusion-row">';
					}
					break;
				case '3':
					// $image_size 					= 'rt_thumb300x200';
					$atts['hide_category'] 			= '0';
					$post_class[] 					= 'fusion-one-fourth fusion-spacing-yes fusion-layout-column';
					$post_class[] 					= ( $i % 4 == 0 ) ? 'fusion-column-last' : '';

					$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					if ( ( $posts_per_page > 4 ) && ( $i % 4 == 0 ) ) {
						$html .= '</div><div class="fusion-row">';
					}
					break;
				case '4':
					if ( $i == 1 ) {

						$post_class[] 					= 'first-element';
						$atts['hide_category'] 			= '0';
						// $image_size 					= 'rt_thumb370x250';

						$html .= '<div class="first-element-layout">';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
						$html .= '</div>';
						if( $posts_per_page > 1 ) {
							$html .= '<div class="second-element-layout">';
						}
					} else {
						$post_class[] 					= 'not-first-element';
						// $image_size 					= 'rt_thumb300x200';
						$atts['hide_category'] 			= '0';
						$atts['hide_meta'] 				= '0';
						$atts['hide_viewmore'] 			= '0';
						
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					}
					if ( $i == count( $the_query->posts ) ) {
						$html .= '</div>';
					}
					break;
				case '5':
					if ( $i == 1 ) {
						// $image_size 					= 'rt_thumb370x250';
						$post_class[] 					= 'first-element';
						$atts['hide_category'] 			= '0';
						$atts['hide_meta'] 				= '0';
						
						$html .= '<div class="first-element-layout">';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
						$html .= '</div>';
						if( $posts_per_page > 1 ) {
							$html .= '<div class="second-element-layout">';
						}
					} else {
						$post_class[] 					= 'not-first-element';
						// $image_size 					= 'rt_thumb300x200';
						$atts['hide_thumb'] 			= '0';
						$atts['hide_meta'] 				= '0';
						$atts['hide_category'] 			= '0';
						$atts['hide_meta'] 				= '1';
						$atts['hide_viewmore'] 			= '0';
						$atts['hide_desc'] 				= '0';
						
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					}
					if ( $i == count( $the_query->posts ) ) {
						$html .= '</div>';
					}
					break;
				case '6' :
					if ( $i == 1 ) {

						$post_class[] 					= 'first-element';
						$atts['hide_category'] 			= '0';
						// $image_size 					= 'rt_thumb370x250';

						$html .= '<div class="first-element-layout">';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
						$html .= '</div>';
						if( $posts_per_page > 1 ) {
							$html .= '<div class="second-element-layout">';
						}
					} else {
						$post_class[] 					= 'not-first-element';
						// $image_size 					= 'rt_thumb300x200';
						$atts['hide_category'] 			= '0';
						$atts['hide_meta'] 				= '0';
						$atts['hide_viewmore'] 			= '0';
						
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					}
					if ( $i == count( $the_query->posts ) ) {
						$html .= '</div>';
					}
					break;
				case '7' :
					$atts['hide_category'] 				= '0';
					$atts['hide_meta'] 					= '1';
					$atts['hide_desc'] 					= '0';
					$atts['hide_viewmore'] 				= '0';
					if ( $i == 1 ) {
						$html .= '<div class="first">';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					} elseif ( $i == 2 ) {
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
						$html .= '</div><div class="not-first">';
					} else {
						// $image_size 					= 'rt_thumb85x50'
						$atts['hide_meta'] 				= '0';;
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					}
					if ( $i == count( $the_query->posts ) ) {
						$html .= '</div>';
					}
					break;
				case '8' :
					$atts['hide_category'] 				= '0';
					$atts['hide_meta'] 					= '0';
					$atts['hide_desc'] 					= '0';
					$atts['hide_thumb'] 				= '1';
					if ( $i == 1 ) {
						$atts['hide_desc'] 				= '1';
						$html .= '<div class="first-element-layout">';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					} elseif ( $i == 2 ) {
						$atts['hide_thumb'] 			= '0';
						$atts['hide_viewmore'] 			= '0';
						$html .= '</div><div class="second-element-layout">';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					} elseif ( $i > 2 && $i < 8 ) {
						$atts['hide_thumb'] 			= '0';
						$atts['hide_viewmore'] 			= '0';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					} elseif ( $i == 8 ) {
						$atts['hide_viewmore'] 			= '1';
						$html .= '</div><div class="third-element-layout">';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					} else {
						// $image_size 					= 'rt_thumb85x50';
						$atts['hide_viewmore'] 			= '1';
						$atts['hide_meta'] 				= '1';
						$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					}
					if ( $i == count( $the_query->posts ) ) {
						$html .= '</div>';
					}
					break;
				case '9' :
					// $image_size 					= 'rt_thumb370x250';
					$atts['hide_category'] 			= '0';
					$post_class[] 					= 'fusion-one-half fusion-spacing-yes fusion-layout-column';
					$post_class[] 					= ( $i % 2 == 0 ) ? 'fusion-column-last' : '';

					$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
					if ( ( $posts_per_page > 2 ) && ( $i % 2 == 0 ) ) {
						$html .= '</div><div class="fusion-row">';
					}
					break;
				default:
					$html .= $this->rt_general_post_html( $post_class, $atts );
					break;
			}
		}
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * General post html
	 *
	 * @param  $post_class: class of post
	 * @return $html: html of post
	 *
	 */
	function rt_general_post_html ( $post_class = array(), $atts = array(), $image_size = 'rt_thumb300x200' ) {
		extract( shortcode_atts( array(
			'posts_per_page'				=> '5',
			'categories'					=> '',
			'custom_text'					=> 'Xem Thêm',
			'custom_link'					=> '',
			'hide_thumb'					=> '1',
			'hide_category'					=> '1',
			'hide_desc'						=> '1',
			'hide_viewmore'					=> '1',
			'show_custorm_field'			=> '0',
			'hide_meta'						=> '0'
		), $atts ) );
		
		
		$html = '';
		$html .= '<article id="post-'. get_the_ID() .'" class="'. implode( ' ', get_post_class( $post_class ) ) .'"><div class="post-inner">';
		// Check display thumb of post
		if ( $hide_thumb == '1' && has_post_thumbnail() ) :
			$html .= '<div class="entry-thumb">';
				$html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">' . get_the_post_thumbnail( get_the_ID(), $image_size ) . '</a>';
				$html .= '<p class="timestyle5" style="display:none;">'. get_the_time('d/m/Y') .'</p>';
			$html .= '</div>';
		endif;
		$html .= '<div class="entry-content">';
			// Check display category
			if ( $hide_category == '1' ) {
				$categories = wp_get_post_categories( get_the_ID() );
				if ( count( $categories ) > 0 ) {
					$html .= '<div class="entry-cat">';
					foreach ( $categories as $key => $cat_id ) {
						$category = get_category( $cat_id );
						if ( $key == ( count( $categories ) - 1 ) ) {
							$html .= '<a href="'. get_term_link( $category ) .'" title="'. $category->name .'">'. $category->name .'</a>';	
						} else {
							$html .= '<a href="'. get_term_link( $category ) .'" title="'. $category->name .'">'. $category->name .'</a>, ';
						}
					}
					$html .= '</div>';
				}
			}
			$html .= '<h3 class="entry-title"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>';
			// Metadata
			if ( $hide_meta == '1' ) {
				$html .= '<div class="meta">';
					$html .= '<span class="date-time"><i class="fa fa-clock-o" aria-hidden="true"></i>'. get_the_time('d/m/Y') .'</span>';
					$comments_count = wp_count_comments( get_the_ID() );
					$html .= '<span class="number-comment"><i class="fa fa-commenting-o" aria-hidden="true"></i>'. $comments_count->approved . ' ' . __( 'Comments', RT_LANGUAGE ) . '</span>';
				$html .= '</div>';
			}
			// Check display description
			if ( $hide_desc == '1' ) {
				$html .= '<div class="entry-description">'. substr(get_the_excerpt(), 0,1500) .'</div>';
			}
			// Check display view more button
			if ( $hide_viewmore == '1' ) {
				$html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'" class="view-more">'. __( 'Xem thêm', RT_LANGUAGE ) .' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>';
			}
		$html .= '</div>';
		$html .= '</div></article>';
		return $html;
	}

}
new rt_rtblog_shortcode();

