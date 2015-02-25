<?php

class WPBakeryShortCode_pt_heading extends WPBakeryShortCode {

	protected function content($atts, $headings = null) {

		$style = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'heading' => '',
			'color' => '',
			'text_align' => '',
			'h' => '',
			'el_class'	=> '',
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

		if ( trim($color) ) {
			$style = 'style="color: '. $color .'; border-color: '. $color .';"';
		}

		$output  = '<div class="' . $text_align . '" ' . $animation_attr . '>';
		$output .= '<'. $h .' '. $style .' class="'. $el_class .'">'. wpb_js_remove_wpautop(strip_tags($heading)) .'</'. $h .'>';
		$output .= '</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_heading",
	"name"      => __("Heading", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-text-height",
	"category"  => __('Typography', 'js_composer'),
	"params"    => array(
		array(
			"type" => "dropdown",
			"heading" => __("Select heading", "js_composer"),
			"param_name" => "h",
			"value" => array("Heading 1"=>"h1", "Heading 2"=>"h2", "Heading 3"=>"h3", "Heading 4"=>"h4", "Heading 5"=>"h5", "Heading 6"=>"h6"),
			"description" => __("", "js_composer")
			),
		array(
			"type" => "textarea",
			"holder" => "h1",
			"class" => "",
			"heading" => __("Heading Text", "js_composer"),
			"param_name" => "heading",
			"value" => __("Heading", "js_composer")
			),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select text align", "js_composer"),
			"param_name" => "text_align",
			"value" => $pt_array_text_align,
			"description" => __("", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => __("Pick text color", "js_composer")
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