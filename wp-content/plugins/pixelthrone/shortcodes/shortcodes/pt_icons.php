<?php

class WPBakeryShortCode_pt_icons extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $class = $style_wrapper = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'font_size' => '',
			'font_icons' => '',
			'text_align' => '',
			'background_color' => '',
			'color' => '',
			'border' => '',
			'bt_inline'		=> '',
			'margin_left'		=> '',
			'margin_right'		=> '',
			'el_class'   => '',
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

		$style .= 'font-size: '. (int)$font_size .'px; ';
		$class .= $text_align;

		if ( trim($background_color) )
		{
			$style .= 'background-color: '. $background_color .'; ';
		}

		if ( trim($border) ) {
			$class .= ' pt-icon-border ';
		}

		if ( trim($background_color)  || trim($border) ) {
			$style .= 'padding: '. ceil($font_size*0.4) .'px '. ceil($font_size*0.52) .'px; ';
			$style .= 'width: '. (int)$font_size .'px; ';
			$style .= 'height: '. (int)$font_size .'px; ';
		}

		if ( trim($color) )
		{
			$style .= 'color: '. $color .'; ';
		}

		$style_wrapper .= (trim($margin_left) ? 'margin-left: ' . trim($margin_left) . 'px;' : '');
		$style_wrapper .= (trim($margin_right) ? 'margin-right: ' . trim($margin_right) . 'px;' : '');

		$output = '
		<div class="pt-icon-wrapper'. $el_class .' '. $text_align .' '. (trim($bt_inline) ? 'pull-left' : '') .'" '. $animation_attr .' style="'. $style_wrapper .'">
		<span class="pt-icon '. $class .'" style="'. $style .'">
			<i class="'. $font_icons .'"></i>
		</span>
		</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_icons",
	"name"      => __("Icon", "js_composer"),
	"class"     => "",
	"icon"      => __("fa fa-certificate", "js_composer"),
	"category"  => __('Misc', "js_composer"),
	"params"    => array(
		array(
			"type" => "textfield",
			"heading" => __("Select an icon", "js_composer"),
			"param_name" => "font_icons",
			"value" => "",
			"description" => __("Select an Icon", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("Size (px)", "js_composer"),
			"param_name" => "font_size",
			"value" => __("24", "js_composer"),
			"description" => __("Only numbers.", "js_composer")
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
			"type" => "colorpicker",
			"heading" => __("Background color", "js_composer"),
			"param_name" => "background_color",
			"value" => '', //Default color
			"description" => ''
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => ''
		),
		array(
			"type" => "checkbox",
			"heading" => __("Show border", "js_composer"),
			"param_name" => "border",
			"value" => array(__("Yes", "js_composer") => "Yes")
		),
		array(
			"type" => "checkbox",
			"heading" => __("Set next icon to be side by side", "js_composer"),
			"param_name" => "bt_inline",
			"value" => array(__("Yes", "js_composer") => "Yes")
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin left (px)", "js_composer"),
			"param_name" => "margin_left",
			"value" => __("0", "js_composer"),
			"description" => __("Only numbers.", "js_composer")
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin right (px)", "js_composer"),
			"param_name" => "margin_right",
			"value" => __("0", "js_composer"),
			"description" => __("Only numbers.", "js_composer")
		),
		array(
			"type" => "textfield",
			"heading" => __("Size (px)", "js_composer"),
			"param_name" => "font_size",
			"value" => __("24", "js_composer"),
			"description" => __("Only numbers.", "js_composer")
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