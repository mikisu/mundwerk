<?php

/* Simple Icon Hover Effects */
/*
<div class="hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1a">
	<a href="#" class="hi-icon hi-icon-mobile">Mobile</a>
</div>
*/

class WPBakeryShortCode_pt_icon_effects extends WPBakeryShortCode {

	protected function content($atts, $content = null) {
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'btn_type' => '',
			'font_icons' => '',
			'icon_color' => '',
			'hover_circle_color' => '',
			'btn_href' => '',
			'hover_icon_color' => '',
			'target' => '',

			'el_class'			=> '',
			'css_animation'		=> '',
			'css_delay'			=> '',
			'pt_hidden_viewport' => ''

		), $atts));


		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation){
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$id = "icon".uniqid();
		$style = $style_after = $style_hover = $style_hover_after = $key_frames = '';

		if ( $target == 'same' || $target == '_self' ) { $target = ''; }

		$target = ( $target != '' ) ? ' target="'.$target.'"' : '';

		switch ( $btn_type ) {
			case "hi-icon-effect-1 hi-icon-effect-1a" : 
			case "hi-icon-effect-1 hi-icon-effect-1b" :
				$style = 'background: rgba('. pt_hex2rgb($icon_color) .', 0.1);'; 
				$style_after = 'box-shadow: 0 0 0 4px '. $icon_color .';'; 
				$style_hover = 'color: '. $hover_icon_color .'; background: '. $hover_circle_color .';';
				break;
			case "hi-icon-effect-2 hi-icon-effect-2a" :
				$style = 'color: '. $hover_icon_color .'; box-shadow: 0 0 0 3px '. $icon_color .';'; 
				$style_after = 'background: '. $icon_color .';'; 
				$style_hover = 'color: '. $hover_icon_color .';'; 
				break;
			case "hi-icon-effect-2 hi-icon-effect-2b" :
				$style = 'color: '. $hover_icon_color .'; box-shadow: 0 0 0 3px '. $icon_color .';'; 
				$style_after = 'background: '. $icon_color .';'; 
				$style_hover = 'color: '. $icon_color .';'; 
				break;
			case "hi-icon-effect-3 hi-icon-effect-3a" : 
				$style = 'color: '. $hover_icon_color .'; box-shadow: 0 0 0 4px '. $icon_color .';'; 
				$style_after = 'background: '. $icon_color .';'; 
				$style_hover = 'color: '. $icon_color .';'; 
				break;
			case "hi-icon-effect-3 hi-icon-effect-3b" : 
				$style = 'color: '. $icon_color .'; box-shadow: 0 0 0 4px '. $icon_color .';'; 
				$style_after = 'background: '. $icon_color .';'; 
				$style_hover = 'color: '. $hover_icon_color .';'; 
				break;			
			case "hi-icon-effect-4 hi-icon-effect-4a" :
			case "hi-icon-effect-4 hi-icon-effect-4b" : 
				$style = 'box-shadow: 0 0 0 4px rgba('. pt_hex2rgb($icon_color) .', 1);'; 
				$style_after = 'border: 4px dashed '. $icon_color .';'; 
				$style_hover = 'box-shadow: 0 0 0 0 rgba('. pt_hex2rgb($icon_color) .', 0); color: '. $icon_color .';'; 
				break;
			case "hi-icon-effect-5 hi-icon-effect-5a" : 
			case "hi-icon-effect-5 hi-icon-effect-5b" :
			case "hi-icon-effect-5 hi-icon-effect-5c" :
			case "hi-icon-effect-5 hi-icon-effect-5d" :
				$style = 'box-shadow: 0 0 0 4px rgba('. pt_hex2rgb($icon_color) .', 1);'; 
				$style_hover = 'background: rgba('. pt_hex2rgb($icon_color) .', 1); color: '. $hover_icon_color .'; box-shadow: 0 0 0 8px rgba('. pt_hex2rgb($hover_icon_color) .', 0.3);'; 
				break;
			case "hi-icon-effect-6" :
				$style = 'box-shadow: 0 0 0 4px rgba('. pt_hex2rgb($icon_color) .', 1);'; 
				$style_hover = 'background: rgba('. pt_hex2rgb($icon_color) .', 1); color: '. $hover_icon_color .'; '; 
				break;
			case "hi-icon-effect-7 hi-icon-effect-7a" :
				$style = 'box-shadow: 0 0 0 4px rgba('. pt_hex2rgb($icon_color) .', 1);'; 
				$style_after = 'box-shadow: 0 0 0 0 rgba('. pt_hex2rgb($icon_color) .', 1);';
				$style_hover = 'color: '. $icon_color .'; '; 
				$style_hover_after = 'box-shadow: 3px 3px 0 rgba('. pt_hex2rgb($icon_color) .', 1);';
				break;
			case "hi-icon-effect-7 hi-icon-effect-7b" :
				$style = 'box-shadow: 0 0 0 4px rgba('. pt_hex2rgb($icon_color) .', 1);'; 
				$style_after = 'box-shadow: 3px 3px rgba('. pt_hex2rgb($icon_color) .', 1);';
				$style_hover = 'color: '. $icon_color .'; '; 
				break;
			case "hi-icon-effect-8" : 
				$style = 'background: rgba('. pt_hex2rgb($icon_color) .', 0.1);'; 
				$style_after = 'box-shadow: 0 0 0 2px rgba('. pt_hex2rgb($icon_color) .', 0.1);';
				$style_hover = 'background: rgba('. pt_hex2rgb($icon_color) .', 1); color: '. $hover_icon_color .'; ';
				$key_frames = '@-webkit-keyframes sonarEffect { 0% { opacity: 0.3; } 40% { opacity: 0.5; box-shadow: 0 0 0 2px rgba('. pt_hex2rgb($icon_color) .',0.1), 0 0 10px 10px '. $hover_circle_color .', 0 0 0 10px rgba('. pt_hex2rgb($icon_color) .',0.5); } 100% { box-shadow: 0 0 0 2px rgba('. pt_hex2rgb($icon_color) .',0.1), 0 0 10px 10px '. $hover_circle_color .', 0 0 0 10px rgba('. pt_hex2rgb($icon_color) .',0.5); -webkit-transform: scale(1.5); opacity: 0; } } @-moz-keyframes sonarEffect { 0% { opacity: 0.3; } 40% { opacity: 0.5; box-shadow: 0 0 0 2px rgba('. pt_hex2rgb($icon_color) .',0.1), 0 0 10px 10px '. $hover_circle_color .', 0 0 0 10px rgba('. pt_hex2rgb($icon_color) .',0.5); } 100% { box-shadow: 0 0 0 2px rgba('. pt_hex2rgb($icon_color) .',0.1), 0 0 10px 10px '. $hover_circle_color .', 0 0 0 10px rgba('. pt_hex2rgb($icon_color) .',0.5); -moz-transform: scale(1.5); opacity: 0; } } @keyframes sonarEffect { 0% { opacity: 0.3; } 40% { opacity: 0.5; box-shadow: 0 0 0 2px rgba('. pt_hex2rgb($icon_color) .',0.1), 0 0 10px 10px '. $hover_circle_color .', 0 0 0 10px rgba('. pt_hex2rgb($icon_color) .',0.5); } 100% { box-shadow: 0 0 0 2px rgba('. pt_hex2rgb($icon_color) .',0.1), 0 0 10px 10px '. $hover_circle_color .', 0 0 0 10px rgba('. pt_hex2rgb($icon_color) .',0.5); transform: scale(1.5); opacity: 0; } }';
				break;
			case "hi-icon-effect-9 hi-icon-effect-9a" :
				$style_after = 'box-shadow: 0 0 0 3px '. $icon_color .';'; 
				$style_hover = 'box-shadow: 0 0 0 10px rgba('. pt_hex2rgb($icon_color) .', 1); color: '. $icon_color .';';
				break;
			case "hi-icon-effect-9 hi-icon-effect-9b" :
				$style_after = 'box-shadow: 0 0 0 3px '. $icon_color .';'; 
				$style_hover = 'box-shadow: 0 0 0 10px rgba('. pt_hex2rgb($icon_color) .', 0.4); color: '. $icon_color .';';
				break;
		}

		$output = '
		<style type="text/css">
			#'.$id.' { color: '. $icon_color .'; }
			#'.$id.'.hi-icon { '. $style .' }
			#'.$id.':hover { '. $style_hover .' }
			#'.$id.':after { '. $style_after .' }
			#'.$id.':hover:after { '. $style_hover_after .' }
			'. $key_frames .'
		</style>';

		$output  .= '<div class="hi-icon-wrap '. $btn_type .' '. $el_class .'" ' . $animation_attr . '>
		<a href="'. esc_url( $btn_href ) .'" '.$target.' class="hi-icon '. $font_icons .'" id="'. $id .'">'. $font_icons .'</a>
		</div>';

		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_icon_effects",
	"name"      => __("Button Icon Effect", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-dot-circle-o",
	"category"  => __('Buttons', "js_composer"),
	"params"    => array(
		array(
			"type" => "dropdown",
			"heading" => __("Select Effect Type", "js_composer"),
			"param_name" => "btn_type",
			"value" => array(
				"Effect 1a"	=>"hi-icon-effect-1 hi-icon-effect-1a",
				"Effect 1b"	=>"hi-icon-effect-1 hi-icon-effect-1b",
				"Effect 2a"	=>"hi-icon-effect-2 hi-icon-effect-2a",
				"Effect 2b"	=>"hi-icon-effect-2 hi-icon-effect-2b",
				"Effect 3a"	=>"hi-icon-effect-3 hi-icon-effect-3a",
				"Effect 3b"	=>"hi-icon-effect-3 hi-icon-effect-3b",
				"Effect 4a"	=>"hi-icon-effect-4 hi-icon-effect-4a",
				"Effect 4b"	=>"hi-icon-effect-4 hi-icon-effect-4b",
				"Effect 5a"	=>"hi-icon-effect-5 hi-icon-effect-5a",
				"Effect 5b"	=>"hi-icon-effect-5 hi-icon-effect-5b",
				"Effect 5c"	=>"hi-icon-effect-5 hi-icon-effect-5c",
				"Effect 5d"	=>"hi-icon-effect-5 hi-icon-effect-5d",
				"Effect 6"	=>"hi-icon-effect-6",
				"Effect 7a"	=>"hi-icon-effect-7 hi-icon-effect-7a",
				"Effect 7b"	=>"hi-icon-effect-7 hi-icon-effect-7b",
				"Effect 8"	=>"hi-icon-effect-8",
				"Effect 9a"	=>"hi-icon-effect-9 hi-icon-effect-9a",
				"Effect 9b"	=>"hi-icon-effect-9 hi-icon-effect-9b"
			),
			"description" => __("Select effect", "js_composer")
		),
		array(
			"type" => "textfield",
			"heading" => __("Select an Icon", "js_composer"),
			"param_name" => "font_icons",
			"value" => "",
			"description" => __("Select an Icon", "js_composer")
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon Color", "js_composer"),
			"param_name" => "icon_color",
				"value" => '#ff6e00', //Default color
				//"description" => __("Choose Icon color", "js_composer")
				),
		array(
			"type" => "colorpicker",
			"heading" => __("Hover Circle Color", "js_composer"),
			"param_name" => "hover_circle_color",
				"value" => '#ff6e00', //Default color
				//"description" => __("Choose hover color", "js_composer")
				),
		array(
			"type" => "colorpicker",
			"heading" => __("Hover Icon Color", "js_composer"),
			"param_name" => "hover_icon_color",
				"value" => '#ffffff', //Default color
				//"description" => __("Choose hover color", "js_composer")
				),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("URL (Link)", "js_composer"),
			"param_name" => "btn_href",
			"value" => '',
			"description" => __("Button link", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Target", "js_composer"),
			"param_name" => "target",
			"value" => $target_arr,
			"dependency" => array('element' => "btn_href", 'not_empty' => true)
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

