<?php

class WPBakeryShortCode_pt_counter extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $icon_color = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'value'				=> '',
			'legend'			=> '',
			'symbol'			=> '',
			'border_color'		=> '',
			'text_color'		=> '',
			'icon_color'		=> '',
			'bg_color'			=> '',
			'text_align'		=> '',
			'font_icons'		=> '',
			'el_class'			=> '',
			'css_animation'		=> '',
			'css_delay'			=> '',
			'pt_hidden_viewport'=> ''
		), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);
		$el_class .= $this->getExtraClass($text_align);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$icon_color 	= ($icon_color != "") 	? 'style="color: '. $icon_color .';"': '';
		$text_color 	= ($text_color != "") 	? 'color: '. $text_color .';': '';
		$border_color 	= ($border_color != "") ? 'border: 5px solid '. $border_color .';': '';
		$bg_color 		= ($bg_color != "") 	? 'background-color: rgb('. pt_hex2rgb($bg_color) .'); background-color: rgba('. pt_hex2rgb($bg_color) .', 0.5);': '';

		$output = '<div class="pt-counter'. $el_class .'" style="'. $text_color. $bg_color . $border_color .'" ' . $animation_attr . '>';
			$output .= '<i class="'. $font_icons .'" '. $icon_color .'></i>';
			$output .= '<div class="pt-counter-text">';
				$output .= '<span data-from="0" data-to="'. $value .'" data-speed="2500" data-refresh-interval="50" ></span>';
				$output .= '<div class="symbol">'.$symbol.'</div>';
				$output .= '<p class="light">'. $legend .'</p>';
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_counter",
	"name"      => __("Counter", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-dashboard",
	"category"  => __('Misc', "js_composer"),
	"params"    => array(
		array(
			"type" => "textfield", //Dummy textfield Pixelthrone. Just change the value to the desired class
			"param_name" => "pt_vc_dummy_textfield", // don't touch
			"value"=> "pt_counter_dummy" // class name
			),
		array(
			"type" => "textfield",
			"holder" => "span",
			"class" => "",
			"heading" => __("value", "js_composer"),
			"param_name" => "value",
			"value" => "",
			"description" => __("Only numbers", "js_composer")
			),
		array(
			"type" => "textfield",
			"holder" => "span",
			"heading" => __("Symbol after value", "js_composer"),
			"param_name" => "symbol",
			"value" => "",
			"description" => __("Symbol to append after value, Eg: +, %, etc", "js_composer")
			),
		array(
			"type" => "textfield",
			"holder" => "span",
			"heading" => __("Legend", "js_composer"),
			"param_name" => "legend",
			"value" => ""
			),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select text align", "js_composer"),
			"param_name" => "text_align",
			"value" => $pt_array_text_align,
			"description" => ''
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
			"heading" => __("Icon Color", "js_composer"),
			"param_name" => "icon_color",
			"value" => '', //Default color
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text Color", "js_composer"),
			"param_name" => "text_color",
			"value" => '', //Default color
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Border Color", "js_composer"),
			"param_name" => "border_color",
			"value" => '', //Default color
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Background Color", "js_composer"),
			"param_name" => "bg_color",
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
			)
		)
) );