<?php

class WPBakeryShortCode_pt_icon_text extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$output = $style = $style_icon = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'text'       		=> '',
			'font_icons' 		=> '',
			'color'      		=> '',
			'iconcolor'  		=> '',
			'el_class'  		=> '',
			'css_animation' 	=> '',
			'css_delay' 		=> '',
			'pt_hidden_viewport' => ''
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		if ( $color || $iconcolor ) {

			if ( $color ) {
				$style .= 'style="color: '. $color .';"';
			}
			if ( $iconcolor ) {
				$style_icon .= 'style="color: '. $iconcolor .';"';
			}
		}
		
		$output .= '<div class="pt-icon-text'. $el_class .'" ' . $animation_attr . '>';
		$output .= '<i class="'. $font_icons .'" '. $style .'></i>';
		$output .= '<h4 class="pt-icon-text" '. $style_icon .'>'. $text .'</h4>';
		$output .= '</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_icon_text",
	"name"      => __("Icon Text", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-list ",
	"category"  => __('List', "js_composer"),
	"params"    => array(
		array(
			"type" => "textfield",
			"holder" => "span",
			"class" => "",
			"heading" => __("Write some text", "js_composer"),
			"param_name" => "text",
			"value" => "",
			"description" => __("", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Select an icon", "js_composer"),
			"param_name" => "font_icons",
			"value" => "",
			"description" => __("Select an Icon", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text Color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon Color", "js_composer"),
			"param_name" => "iconcolor",
			"value" => '', //Default color
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