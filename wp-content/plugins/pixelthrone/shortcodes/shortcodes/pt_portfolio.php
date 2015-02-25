<?php

class WPBakeryShortCode_pt_portfolio extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$class = $output = '';

		extract(shortcode_atts(array(
			'order'       => '',
			'number_items'=> '',
			'total_items' => '',
			'toggle_next' => '',
			'template'    => '1',
			'el_class' => '',
			'pt_hidden_viewport' => ''
		), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);
		
		if ( !$total_items || !$toggle_next ) {
			$total_items = $number_items;
		}

		/* carousel */
		if ($toggle_next) {
			$bxslider['number_items'] = (int)$number_items;
			$bxslider['total_items'] = (int)$total_items;
			wp_localize_script( 'main', 'bxslider', $bxslider );
		} 

		$args = array( 
			'posts_per_page' => (int)$total_items,
			'orderby' => $order, //rand
			'order' => $order, //desc, asc
			'post_type'=> 'portfolio'
		);

		$the_posts = query_posts($args);

		if ( have_posts() ) :

			if ( (int)$template === 1) :

				$output .= '<div id="'.  uniqid('pt-bx-') .'" class="pt-portfolio row relative '. $el_class .' '. ($toggle_next ? 'pt-bx-slider' : '') .'"  bxitems="'. (int)$number_items .'">';
				$output .= '<ul class="list-unstyled slides">';

				while ( have_posts() ) : the_post();

					$post_id = get_the_ID();

					$output .= '<li class="relative '. ( $number_items == 4 ? 'col-md-3' : 'col-md-4' ) .'">';
					$output .= '<a href="'. get_permalink() .'" class="text-center">';

						$output .= '<figure>';
						if ( has_post_thumbnail() ) :
							$output .= get_the_post_thumbnail($post_id, 'portfolio-template1');
						endif;
						$output .= '</figure>';

						$output .= '<h4>'. get_the_title() .'</h4>';
						$output .= '<p>'. get_the_excerpt() .'</p>';
						$output .= '<i class="fa fa-angle-up"></i><span></span>';

					$output .= '</a>';
					$output .= '</li>';

				endwhile;
				$output .= '</ul>';
				$output .= '</div>';

			endif;

			if ( (int)$template === 2) :

				$post_width = 300;

				$output .= '</div></div></div></div><div class="pt-portfolio-template2'. $el_class .'">';

				$output .= '<ul class="list-unstyled list-inline" style="width: '. count($the_posts) * $post_width .'px;">';

				while ( have_posts() ) : the_post();

					$post_id = get_the_ID();

					$output .= '<li class="relative">';
					$output .= '<a href="'. get_permalink() .'" class="text-center">';

						$output .= '<figure>';
						if ( has_post_thumbnail() ) :
							$output .= get_the_post_thumbnail($post_id, 'portfolio-template2');
						endif;
						$output .= '</figure>';

						$output .= '<div class="pt-portfolio-template2-hover">';
						$output .= '<h1>'. get_the_title( ) .'</h1>';
						$output .= '<p>'. get_the_date( ) .'</p>';
						$output .= '</div>';

					$output .= '</a>';
					$output .= '</li>';

				endwhile;

				$output .= '</ul>';

				$output .= '</div><div class="container"><div><div><div>';

			endif;

		endif;

		wp_reset_query();

		return $output;
	}
}


wpb_map( array(
	"base"      => "pt_portfolio",
	"name"      => __("Portfolio Items", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-picture-o",
	"category"  => __('List', "js_composer"),
	"params"    => array(
		array(
			"type" => "dropdown",
			"heading" => __("Select template", "js_composer"),
			"param_name" => "template",
			"value" => array('Template 1'=>'1', 'Template 2'=>'2'),
			"description" => __("", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Number of items to display", "js_composer"),
			"param_name" => "number_items",
			"value" => array('1', '2', '3', '4', '-1'=>'All'),
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
			"value" => array( "Yes" => "Yes")
			),
		array(
			"type" => "textfield",
			"heading" => __("Total number of items", "js_composer"),
			"param_name" => "total_items",
			"value" => __("12", "js_composer"),
			"description" => __("Total number of items", "js_composer")
			),
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		)
) );