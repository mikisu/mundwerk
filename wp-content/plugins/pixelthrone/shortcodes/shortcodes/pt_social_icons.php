<?php

class WPBakeryShortCode_pt_social_icons extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'network_1' => '', 'url_1' => '',
			'network_2' => '', 'url_2' => '',
			'network_3' => '', 'url_3' => '',
			'network_4' => '', 'url_4' => '',
			'network_5' => '', 'url_5' => '',
			'network_6' => '', 'url_6' => '',
			'network_7' => '', 'url_7' => '',
			'network_8' => '', 'url_8' => '',
			'network_9' => '', 'url_9' => '',
			'network_10' => '', 'url_10' => '',
			'font_size' => '',
			'hover_type' => '',
			'color' => '',
			'text_align' => '',
			'el_class'   => '',
			'css_animation' => '',
			'css_delay' => '',
			'pt_hidden_viewport' => ''
		), $atts));

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);

		$el_class = $this->getExtraClass($el_class);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);
		$el_class .= $this->getExtraClass($text_align);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$style .= 'font-size: '. (int)$font_size .'px; ';
		$style .= 'color: '. $color .'; ';
		$style .= 'width: '. $font_size .'px; ';
		$style .= 'height: '. $font_size .'px; ';
		$style .= 'line-height: '. $font_size .'px; ';

		$output  = '<div class="pt_social_icons'. $el_class .'" '. $animation_attr .'>';
		for ($i=1; $i < 11 ; $i++)
		{ 
			if ( ${"network_$i"} && ${"url_$i"} )
			{
				$output .='
				<a class="" href="'. esc_url(${"url_$i"}) .'" style="'. $style .'">
					<i class="monosocial-circle'. ${"network_$i"} .'"></i>
					<span '. (trim($hover_type) ? ' style="background-color: '. $color .';"' : '') .' class="monosocial-'. (trim($hover_type) ? '' : 'circle') . ${"network_$i"} .' on"></span>
				</a>';
			}
		}
		$output .= '</div>';

		wp_enqueue_style('monosocialiconsfont');

		return $output;
	}
}


$fields = array();

for ($i=1; $i < 11; $i++) { 
	$fields[] = array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select a Social Network", "js_composer"),
			"param_name" => "network_" . $i,
			"value" => $pt_social_networks,
			"description" => ''
		);
	$fields[] = array(
			"type" => "textfield",
			"heading" => __("Social network URL", "js_composer"),
			"param_name" => "url_" . $i,
			"value" => "",
			"description" => ""
		);
}

$fields[] = array(
			"type" => "textfield",
			"heading" => __("Size (px)", "js_composer"),
			"param_name" => "font_size",
			"value" => __("30", "js_composer"),
			"description" => __("Only numbers.", "js_composer")
		);
$fields[] = array(
			"type" => "colorpicker",
			"heading" => __("Icon color", "js_composer"),
			"param_name" => "color",
			"value" => '', //Default color
			"description" => ''
		);
$fields[] = array(
			"type" => "checkbox",
			"heading" => __("Special hover ", "js_composer"),
			"param_name" => "hover_type",
			"value" => array(__("Yes", "js_composer") => "Yes"),
			"description" => "Only icon get social network color"
		);
$fields[] = array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select text align", "js_composer"),
			"param_name" => "text_align",
			"value" => $pt_array_text_align,
			"description" => ""
		);
$fields[] = $pt_css_animation;
$fields[] = $pt_css_delay;
$fields[] = $pt_hidden_viewport;
$fields[] =	array(
	"type" => "textfield",
	"heading" => __("Extra class name", "js_composer"),
	"param_name" => "el_class",
	"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
	);


wpb_map( array(
	"base"      => "pt_social_icons",
	"name"      => __("Social Icons", "js_composer"),
	"class"     => "",
	"icon"      => __("fa fa-share-square-o", "js_composer"),
	"category"  => __('Social', "js_composer"),
	"params"    => $fields
) );