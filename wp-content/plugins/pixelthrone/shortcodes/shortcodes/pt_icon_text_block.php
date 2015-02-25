<?php

class WPBakeryShortCode_pt_icon_text_block extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $class = $output = $font_size = $text_align  = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			//'title' => '',
			'font_size' => '',
			'icon_position' => 'left',
			'font_icons' => '',
			'text_align' => '',
			'background_color' => '',
			'color' => '',
			'border' => '',
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

		if ( trim($background_color) && !trim($border) )
		{
			$style .= 'background-color: '. $background_color .'; ';
		}

		if ( trim($background_color)  || trim($border) ) {
			$style .= ' border-color: '. $background_color .'; ';
			$style .= 'padding: '. ceil($font_size*0.4) .'px '. ceil($font_size*0.52) .'px; ';
			$style .= 'width: '. (int)$font_size .'px; ';
			$style .= 'height: '. (int)$font_size .'px; ';
			$class .= ' pt-icon-border ';
		}

		if ( trim($color) )
		{
			$style .= 'color: '. $color .'; ';
		}

		$class .= ($icon_position == 'left') 		? 	' pull-left' 	: '';
		$class .= ($icon_position == 'right') 		? 	' pull-right' 	: '';
		$class .= ($icon_position == 'top') 		? 	' pull-top' 	: '';
		$class .= ($icon_position == 'bottom') 		? 	' pull-bottom' 	: '';

		$output .= '<div class="pt_icon_text_block clearfix '. $icon_position .' '. $text_align . $el_class .'" ' . $animation_attr . '>';

		if ( $icon_position!='bottom' ) {
			$output .= '<span class=" pt-icon '. $class. '" style="'. $style .'">
						<i class="'. $font_icons .'"></i>
					</span>';
		}

		$output .= '<div class="pt_icon_text_block_wrapper clearfix '.$text_align.'">';
			$output .= '<div class="pt_icon_text_block_content">'. $content .'</div>';
		$output .= '</div>';

		if ( $icon_position=='bottom' ) {
			$output .= '<span class="pt_icon pt-icon '. $class. '" style="'. $style .'">
						<i class="'. $font_icons .'"></i>
					</span>';
		}

		$output .= '</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_icon_text_block",
	"name"      => __("Icon + Text", "js_composer"),
	"class"     => "",
	"icon"      => __("fa fa-list-ul", "js_composer"),
	"category"  => __('List', "js_composer"),
	"params"    => array(
		// array(
		// 	"type" => "textfield",
		// 	"holder" => "span",
		// 	"class" => "",
		// 	"heading" => __("Write some text", "js_composer"),
		// 	"param_name" => "title",
		// 	"value" => "Title",
		// 	"description" => ""
		// 	),
		array(
			"type" => "textarea_html",
			"holder" => "span",
			"class" => "",
			"heading" => __("Text", "js_composer"),
			"param_name" => "content",
			"value" => __("<p>Your Text here</p>", "js_composer")
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
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select icon position", "js_composer"),
			"param_name" => "icon_position",
			"value" => array("left"=>"left", "right"=>"right", "top"=>"top", "bottom"=>"bottom"),
			"description" => ''
			),
		array(
			"type" => "textfield",
			"heading" => __("Select an icon", "js_composer"),
			"param_name" => "font_icons",
			"holder" => "i",
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
			"type" => "colorpicker",
			"heading" => __("Icon Background color", "js_composer"),
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