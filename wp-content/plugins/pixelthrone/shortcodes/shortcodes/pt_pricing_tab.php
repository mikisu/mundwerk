<?php

class WPBakeryShortCode_pt_pricing_tab extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $icon_color = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'featured'			=> '',
			'featured_color'	=> '',
			'featuredtext_color'=> '',

			'title'				=> '',
			'price'				=> '',
			'currency'			=> '',
			'sub_title'			=> '',
			'description'		=> '',
			'border_line_color'	=> '',
			'text_color'		=> '',

			'add_button'		=> '',
			'button_title'		=> '',
			'button_action'		=> '',
			'button_color'		=> '',
			'button_text_color'	=> '',

			'el_class'			=> '',
			'css_animation'		=> '',
			'css_delay'			=> '',
			'pt_hidden_viewport'=> ''
		), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$uniq_id = "pt-PricingTab-".uniqid();

		// VARS
		$featured 		= ($featured == 1) 	? ' featuredTab' : '';

		// OUTPUT
		$output = ' <div id="'.$uniq_id.'" class="pt-pricing_tab '.$el_class.$featured.' " ' . $animation_attr . '>';
			
				$output .= ' <span class="title">'.$title.'</span>';
				$output .= ' <div class="price">
								
								<div><span>'.$currency.'</span>'.$price.'</div>
							</div>';
				$output .= ' <span class="sub_title">'.$sub_title.'</span>';

			$output .= '<hr>';

			$output .= '<div class="description">'.$description.'</div>';

			if ($add_button == 1) {
				$output .= '<a href="'.$button_action.'" class="button">'.$button_title.'</a>';

			}

		$output .= '</div>';

		// CSS
		$text_color 		= ($text_color == "") 				? '#3b3b3b'	: $text_color;
		$border_line_color 	= ($border_line_color == "") 		? '#87929c'	: $border_line_color;
		$button_color 		= ($button_color == "") 			? '#323a45'	: $button_color;
		$button_text_color 	= ($button_text_color == "") 		? '#ffffff'	: $button_text_color;
		$featured_color 	= ($featured_color == "") 			? '#323a45'	: $featured_color;
		$featuredtext_color = ($featuredtext_color == "") 		? '#ffffff'	: $featuredtext_color;

		$output .= '<style>
						#'.$uniq_id.'.pt-pricing_tab { color:'.$text_color.'; }

						#'.$uniq_id.'.pt-pricing_tab { border-color:' .$border_line_color. '; }
						#'.$uniq_id.'.pt-pricing_tab hr { border-color: ' . $border_line_color . '; }
						#'.$uniq_id.'.pt-pricing_tab a.button { background-color: '. $button_color.'; color: '.$button_text_color.'; }
						
						#'.$uniq_id.'.pt-pricing_tab.featuredTab .title { background-color: '.$featured_color. '; color: '.$featuredtext_color. '; }
						#'.$uniq_id.'.pt-pricing_tab.featuredTab .price { background-color: '.$featured_color.'; color: '.$featuredtext_color. '; }
						#'.$uniq_id.'.pt-pricing_tab.featuredTab .sub_title { background-color: '.$featured_color . '; color: '.$featuredtext_color.'; }
					</style>';


		return $output;
	}
}


wpb_map( array(
	"base"      => "pt_pricing_tab",
	"name"      => __("Pricing Tab", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-dashboard",
	"category"  => __('Misc', "js_composer"),
	"params"    => array(
		array(
			"type" => "dropdown", 
			"heading" => __("Featured", "js_composer"),
			"param_name" => "featured", 
        	"value" => array(__("No", "js_composer") => "0", __("Yes", "js_composer") => "1"),

			),
		array(
			"type" => "colorpicker",
			"heading" => __("Featured — Background Color", "js_composer"),
			"param_name" => "featured_color",
			"value" => '', 
			"dependency" => Array('element' => "featured", 'value' => array('1'))
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Featured — Text Color", "js_composer"),
			"param_name" => "featuredtext_color",
			"value" => '', 
			"dependency" => Array('element' => "featured", 'value' => array('1'))
			),
		array(
			"type" => "textfield",
			"heading" => __("Title", "js_composer"),
			"param_name" => "title",
			"value" => "",
			"admin_label" => true,
			),
		array(
			"type" => "textfield",
			"heading" => __("Price", "js_composer"),
			"param_name" => "price",
			"value" => "",
			),
		array(
			"type" => "textfield",
			"heading" => __("Currency", "js_composer"),
			"param_name" => "currency",
			"value" => "$",
			"description" => __("eg: $, €", "js_composer")
			),
		array(
			"type" => "textfield",
			"heading" => __("SubTitle", "js_composer"),
			"param_name" => "sub_title",
			"value" => "",
			),
		array(
			"type" => "textarea_html",
			"heading" => __("Description", "js_composer"),
			"param_name" => "description",
			"value" => __("<p>Bla, bla, bla <br>Bla, bla, bla <br>Bla, bla, bla <br></p>", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Text Color", "js_composer"),
			"param_name" => "text_color",
			"value" => '', 
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Border Line Color", "js_composer"),
			"param_name" => "border_line_color",
			"value" => '', 
			),
		array(
			"type" => "dropdown", 
			"param_name" => "add_button", 
			"heading" => __("Add Button", "js_composer"),
			"value" => array(__("No", "js_composer") => "0", __("Yes", "js_composer") => "1"),
			),
		array(
			"type" => "textfield",
			"heading" => __("Button Title", "js_composer"),
			"param_name" => "button_title",
			"value" => "",
			"dependency" => Array('element' => "add_button", 'value' => array('1'))
			),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "pt_pricing_tab-button_action",
			"heading" => __("Button Action", "js_composer"),
			"param_name" => "button_action",
			"value" => "",
			"description" => __("The link to go after clicking the button.", "js_composer"),
			"dependency" => Array('element' => "add_button", 'value' => array('1'))
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Button Color", "js_composer"),
			"param_name" => "button_color",
			"value" => '', 
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Button Text Color", "js_composer"),
			"param_name" => "button_text_color",
			"value" => '', 
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