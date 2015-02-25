<?php

class WPBakeryShortCode_pt_testimonials_balloon extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = $icon_color = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'name'					=> '',
			'image'					=> '',
			'circle'				=> '',

			'quote'					=> '',
			'minheight'				=> '',


			'text_color'			=> '',
			'border_line_color'		=> '',
			'background_color'		=> '',

			'el_class'				=> '',
			'css_animation'			=> '',
			'css_delay'				=> '',
			'pt_hidden_viewport'	=> ''
		), $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		$img_id = preg_replace('/[^\d]/', '', $image);
		$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => "full" ));
		//if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/70/70" />';

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$circle = ($circle != "") 	? 'class="addMask"': '';


		$uniq_id = "pt_TestBalloon-".uniqid();

		// OUTPUT
		$output = ' <div id="'.$uniq_id.'" class="pt_TestBalloon '.$el_class.' " ' . $animation_attr . '>';
			$output .= '<div class="quote">
							<p>'.$quote.'</p>
						</div>';

		if ( $img != NULL ) {
			$output .= '<figure '.$circle.'>'.$img['thumbnail'].'</figure>';
		}

			$output .= '<span class="name">'.$name.'<span>';

		$output .= '</div>';

 
		// CSS
		$text_color 		= ($text_color == "") 			? '#4a5157'	: $text_color;
		$border_line_color 	= ($border_line_color == "") 	? '#e5ecf3'	: $border_line_color;
		$background_color 	= ($background_color == "") 	? '#f7f7f7'	: $background_color;
		
		$minheight 			= ($minheight == "") 			? '170'		: $minheight;
		$minheight 			= preg_replace("/[^0-9]/", "",$minheight);


		$output .= '<style>';
			$output .= '#'.$uniq_id.'.pt_TestBalloon  { color:'.$text_color.';  }';
			$output .= '#'.$uniq_id.'.pt_TestBalloon .quote { color: rgba('. pt_hex2rgb($text_color) .', 0.8);  border: 1px solid '.$border_line_color.'; background-color: '.$background_color.'; min-height: '.$minheight.'px; }';
			$output .= '#'.$uniq_id.'.pt_TestBalloon .quote:after { border-bottom-color:'.$border_line_color.'; border-right-color:'.$border_line_color.'; background-color: '.$background_color.'; }';
		$output .= '</style>';


		return $output;
	}
}

wpb_map( array(
	"base"      => "pt_testimonials_balloon",
	"name"      => __("Testimonials Balloon", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-quote-right",
	"category"  => __('Misc', "js_composer"),
	"params"    => array(



		array(
			"type" => "textfield",
			"heading" => __("Name", "js_composer"),
			"param_name" => "name",
			"value" => "The Name",
			"admin_label" => true,
			),
		array(
			"type" => "attach_image",
			"heading" => __("Image", "js_composer"),
			"param_name" => "image",
			"value" => "",
			"description" => __("Select image from media library.", "js_composer")
			),
		array(
			"type" => "checkbox", 
			"heading" => __("Use circle mask", "js_composer"),
			"param_name" => "circle", 
			"value" => array ("Yes" => "1"),
			"description" => __("Insert image in a mask circle. Ideal for faces.", "js_composer")
			),


		array(
			"type" => "textarea",
			"heading" => __("Quote", "js_composer"),
			"param_name" => "quote", 
			"value" => "You quote text..."
		),
		array(
			"type" => "textfield",
			"heading" => __("Min Height", "js_composer"),
			"param_name" => "minheight",
			"value" => "170",
			"description" => __("If you wish that all the shortcodes stay with the same height use this field.<br><strong>Only numbers.</strong>", "js_composer")
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
			"type" => "colorpicker",
			"heading" => __("Background Color", "js_composer"),
			"param_name" => "background_color",
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