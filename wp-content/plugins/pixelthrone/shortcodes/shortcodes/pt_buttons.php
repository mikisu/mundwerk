<?php

class WPBakeryShortCode_pt_buttons extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $output = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'title'			=> '',
			'href'			=> '',
			'target'		=> '',
			'font_icons'	=> '',
			'color'			=> '',
			'color_border'	=> '',
			'text_color'	=> '',
			'text_align'	=> '',
			'bt_inline'		=> '',
			'size'			=> '',
			'toggle_next'	=> '',
			'el_class'		=> '',
			'css_animation'	=> '',
			'css_delay'		=> '',
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
			$style .= 'background-color: '. $color .'; ';
		}
		if ( trim($text_color) ) {
			$style .= 'color: '. $text_color .'; ';
		}
		if ( trim($color_border) ) {
			$style .= 'border: 1px solid '. $color_border .'; ';
		}

		if ( $target == 'same' || $target == '_self' ) { $target = ''; }
		$target = ( $target != '' ) ? ' target="'.$target.'"' : '';

		
		$output = '<div class=" '. (trim($bt_inline) ? 'inline-block' : '') .' '. $text_align .'"'. $animation_attr . '>';

		if ( trim($toggle_next) ) {
			if ( trim($font_icons) ) {
				if ($size == "btn-large") {
					$output .= '<a href="'. esc_url($href) .'" '.$target.' class="pt_button comIcon '. $size . $el_class .'" style="'. $style .'" >';
				} 
				else {
					$output .= '<a href="'. esc_url($href) .'" '.$target.' class="pt_button '. $size . $el_class .'" style="'. $style .'">';
				}

					$output .= '<div>';
					$output .= '<i class="'. $font_icons .'"></i>';
					$output .= '<span>' .$title .'</span>';
					$output .= '</div>';

					$output .= '<div>';
					$output .= '<i class="'. $font_icons .' iconEscondido"></i>';
					$output .= '<span>' .$title .'</span>';
					$output .= '</div>';
				$output .= '</a>';
			}
		} 
		else {
			$output .= '<a href="'. esc_url($href) .'" '.$target.' class="pt_button '. $size . $el_class .'" style="'. $style .'">';
				$output .= '<div>';
				$output .= '<span>' .$title .'</span>';
				$output .= '</div>';

				$output .= '<div>';
				$output .= '<span>' .$title .'</span>';
				$output .= '</div>';
			$output .= '</a>';
		}

		$output .= '</div>';
		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_buttons",
	"name"      => __("Button", "js_composer"),
	"controls"  => "edit_popup_delete",
	"class"     => "vc_button",
	"icon"      => "fa fa-square-o",
	"category"  => __('Buttons', "js_composer"),
	"params"    => array(

		array(
			"type" => "textfield",
			"heading" => __("Text on the button", "js_composer"),
			"holder" => "button",
			"class" => "wpb_button",
			"param_name" => "title",
			"value" => __("Text on the button", "js_composer"),
			"description" => __("Text on the button.", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("URL (Link)", "js_composer"),
			"param_name" => "href",
			"description" => __("Button link.", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Target", "js_composer"),
			"param_name" => "target",
			"value" => $target_arr,
			"dependency" => Array('element' => "href", 'not_empty' => true)
			),
		array(
			"type" => "checkbox",
			"heading" => __("Use icon on button", "js_composer"),
			"param_name" => "toggle_next",
			"value" => array(__("Yes", "js_composer") => "Yes")
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
			"heading" => __("Button Color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Button Border Color", "js_composer"),
			"param_name" => "color_border",
			"value" => '', //Default color
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text color", "js_composer"),
			"param_name" => "text_color",
			"value" => '', //Default color
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
			"type" => "checkbox",
			"heading" => __("Set this button to be inline", "js_composer"),
			"param_name" => "bt_inline",
			"value" => array(__("Yes", "js_composer") => "Yes")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Size", "js_composer"),
			"param_name" => "size",
			"value" => $size_arr,
			"description" => __("Button size.", "js_composer")
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
		),
"js_view" => 'VcButtonView'
) );