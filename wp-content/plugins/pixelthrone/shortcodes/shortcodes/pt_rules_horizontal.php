<?php

class WPBakeryShortCode_pt_rules_horizontal extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $styleDiv = $class = $style_hr = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'pt_separator' 	=> 'separator1',
			'color' 		=> '',
			'margin_top' 	=> '',
			'margin_bottom' => '',
			'align'  		=> '',
			'width'   		=> '',
			'el_class'   	=> '',
			'css_animation' => '',
			'css_delay' 	=> '',
			'pt_hidden_viewport' => ''
			), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$style_hr .= (trim($margin_top)) ? 'margin-top: '. (int)$margin_top .'px; ' 			: '';
		$style_hr .= (trim($margin_bottom)) ? 'margin-bottom: '. (int)$margin_bottom .'px; ' 	: '';
		$style_hr .= (trim($color)) ? 'border-color: '. $color .'; color: '. $color .'; ' 	: '';
		$style_hr .= (trim($width)) ? 'width: '. $width.'%;' 									: '';

		if ($pt_separator == "separator9") {
			$style_hr .= ' background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0), rgba('.pt_hex2rgb($color).',.75), rgba(0, 0, 0, 0));';
			$style_hr .= ' background-image:    -moz-linear-gradient(left, rgba(0, 0, 0, 0), rgba('.pt_hex2rgb($color).',.75), rgba(0, 0, 0, 0));';
			$style_hr .= ' background-image:     -ms-linear-gradient(left, rgba(0, 0, 0, 0), rgba('.pt_hex2rgb($color).',.75), rgba(0, 0, 0, 0));';
			$style_hr .= ' background-image:      -o-linear-gradient(left, rgba(0, 0, 0, 0), rgba('.pt_hex2rgb($color).',.75), rgba(0, 0, 0, 0));';
		}	

		$output = '<div class="pt_rules_horizontal'. $el_class .' '. $align .'" style="'.$styleDiv.'" ' . $animation_attr . '>';
			$output .= '<hr class="'. $pt_separator .'" style="'.$style_hr.'" >';
		$output .= '</div>';

		return $output;
	}
}


wpb_map( array(
	"base"      => "pt_rules_horizontal",
	"name"      => __("Horizontal Separator", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-arrows-h",
	"category"  => __('Misc', "js_composer"),
	"params"    => array(
		array(
			"type" => "dropdown",
			"heading" => __("Select Separator type", "js_composer"),
			"param_name" => "pt_separator",
			"value" => array(
				"dotted (image)" => "separator1",
				"foward slash (image)" => "separator2",
				"Double dashed" => "separator3",
				"Double dotted" => "separator4",
				"Thick solid" => "separator5",
				"Thin solid" => "separator6",
				"Single dashed" => "separator7",
				"Single dotted" => "separator8",
				"Gradient" => "separator9",
				),
			"description" => __("Color will not apply in image separator", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Width(%)", "js_composer"),
			"param_name" => "width",
			"value" => "",
			"description" => __("Only numbers. Value in %", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Margin Top (px)", "js_composer"),
			"param_name" => "margin_top",
			"value" => "",
			"description" => __("Only numbers. Value in pixels", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Margin Bottom (px)", "js_composer"),
			"param_name" => "margin_bottom",
			"value" => "",
			"description" => __("Only numbers. Value in pixels", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Line color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => __("Choose color", "js_composer")
			),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Align", "js_composer"),
			"param_name" => "align",
			"value" => $pt_array_text_align,
			"description" => __("", "js_composer")
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