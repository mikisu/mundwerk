<?php

class WPBakeryShortCode_pt_clients extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$class = $output = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'order'       => 'desc',
			'number_items'=> '',
			'total_items' => '',
			'toggle_next' => '',
			'el_class' => '',
			'css_animation' => '',
			'css_delay' => '',
			'pt_hidden_viewport' => ''
		), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);


		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		if ( !$total_items || !$toggle_next ) {
			$total_items = $number_items;
		}

		/* carousel */
		if ($toggle_next) {
			$bxslider['number_items'] = (int)$number_items;
			$bxslider['total_items'] = (int)$total_items;
		} 

		/* calculate span */
		$span = 'col-md-'. (12 / $number_items);

		$args = array( 
			'posts_per_page' => (int)$total_items,
			'orderby' => $order, //rand
			'order' => $order, //desc, asc
			'post_type'=> 'client'
		);

		query_posts($args);

		if ( have_posts() ) :

			$output .= '<div id="'. uniqid('pt-bx-') .'" class="pt_clients row relative '. ($toggle_next ? 'pt-bx-slider' : '') . $el_class .'"  bxitems="'. (int)$number_items .'" ' . $animation_attr . '>';
			$output .= '<ul class="list-unstyled list-inline slides">';

			while ( have_posts() ) : the_post();

				$post_id = get_the_ID();

				$output .= '<li class="relative text-center '. $span .'">';
				$output .= '<a '. (get_post_meta($post_id, 'client_url') ? ' href="'. esc_url( get_post_meta($post_id, 'client_url', true) ) .'" target="_blank"' : '') .' '. (get_the_content() ? 'title="'. esc_attr(get_the_content()) .'" class="bullet"' : '') .'>';

				if ( has_post_thumbnail() ) {
					$output .= '<figure>';
					$output .= get_the_post_thumbnail($post_id, 'clients-element');
					$output .= '</figure>';
				}

				$output .= '</a>';
				$output .= '</li>';

			endwhile;

			$output .= '</ul>';
			$output .= '</div>';

		endif;

		wp_reset_query();

		return $output;
	}
}


wpb_map( array(
	"base"      => "pt_clients",
	"name"      => __("Clients", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-user",
	"category"  => __('List', "js_composer"),
	"params"    => array(
		array(
			"type" => "dropdown",
			"heading" => __("Number of items to display", "js_composer"),
			"param_name" => "number_items",
			"value" => array('1', '2', '3', '4', '6'),
			"description" => __("Number of visible items", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Order by", "js_composer"),
			"param_name" => "order",
			"value" => array('Descending'=>'desc', 'Ascending'=>'asc', 'Random'=>'rand')
			),
		array(
			"type" => "checkbox",
			"heading" => __("Use Carousel", "js_composer"),
			"param_name" => "toggle_next",
			"value" => array ("Yes" => "Yes")
			),
		array(
			"type" => "textfield",
			"heading" => __("Total number of items", "js_composer"),
			"param_name" => "total_items",
			"value" => "12",
			"description" => __("Total number of items", "js_composer")
			),
		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),
		)
) );