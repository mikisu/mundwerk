<?php

class WPBakeryShortCode_pt_gmaps extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$output = $style = $style_icon = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'height'       		 => '',
			'el_class'  		 => '',
			'css_animation' 	 => '',
			'css_delay' 		 => '',
			'pt_hidden_viewport' => ''
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$output = '<div class="google-maps'. $el_class .'" id="contact_map" style="height: '. (int)$height .'px;" ' . $animation_attr . '></div>';

		wp_enqueue_script('gmaps');

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_gmaps",
	"name"      => __("Google Maps", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-map-marker ",
	"category"  => __('Misc', "js_composer"),
	"params"    => array(
		array(
			"type" => "textfield",
			"holder" => "span",
			"heading" => __("Map height", "js_composer"),
			"param_name" => "height",
			"value" => "250",
			"description" => __("Only numbers, value in px. Map points are set in <a href='admin.php?page=theme_options&tab=4' target='_blank'>Theme Options</a>", "js_composer")
			),
		$pt_css_animation,
		$pt_css_delay,
		$pt_hidden_viewport,
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", "js_composer"),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			)
		)
	) );