<?php

class WPBakeryShortCode_pt_icon_text_list extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $output = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'font_icons' => '',
			'list' => '',
			'color' => '',
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

		if ( trim($color) ) {
			$style .= 'color: '. $color .';';
		}

		if (trim($list)) {
			$pieces = explode(",", $list);
		}

		$output .= '<ul class="pt_icon_list list-unstyled '. $el_class .'" style="'. $style .'" ' . $animation_attr . '>';
		foreach ($pieces as $key => $value) {
			$output .= '<li><i class="'. $font_icons .'"></i> '. $value .'</li>';
		}
		$output .= '</ul>';

		return $output;
	}
}


wpb_map( array(
	"base"      => "pt_icon_text_list",
	"name"      => __("Text List + Icon", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-th-list",
	"category"  => __('List', "js_composer"),
	"params"    => array(
		array(
			"type" => "exploded_textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __("List Items", "js_composer"),
			"param_name" => "list",
			"value" => "Item 1,Item 2,Item 3",
			"description" => __("Divide values with linebreaks (Enter).", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => __("Choose content color", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Select an icon", "js_composer"),
			"param_name" => "font_icons",
			"value" => "",
			"description" => __("Select an Icon", "js_composer")
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