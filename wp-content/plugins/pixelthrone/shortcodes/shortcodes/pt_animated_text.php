<?php


/* Animated Text */
/*
<div class="pt_text_animated">
	<h1>
		I Create
		<span class="tlt">
			<ul class="texts">
				<li>Products</li>
				<li>Websites</li>
				<li>Apps</li>
				<li>Photographs</li>
				<li>Experiences</li>
			</ul>
		</span>
	</h1>
</div>
*/
class WPBakeryShortCode_pt_text_animated extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$output = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'text' => '',
			'text_anime' => '',
			'size_1' => '',
			'size_2' => '',
			'text_align' => '',
			'text_color' => '',
			'opacity_1' => '',
			'opacity_2' => '',
			'text_anime_color' => '',
			'el_class' => '',
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

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,' wpb_content_element'.$el_class.' '.$this->settings['base'] .' '. $text_align);

		$output .= '<div class="'.$css_class.'" '. $animation_attr .'>';
			$output .= '<'.$size_1.' style="color: '. $text_color .'" class="op'.$opacity_1.'">';
				$output .= $text;
			$output .= '</'.$size_1.'>';

			$output .= '<'.$size_2.' class="op'.$opacity_2.'">';
				$output .= '<span class="tlt" style="color: '. $text_anime_color .'">';
					$output .= '<ul class="texts" >';

					$text_anime = explode(",", $text_anime);
					foreach ($text_anime as $line) {
						$output .= '<li>' . $line . '</li>';
					}
					$output .= '</ul>';
				$output .= '</span>';

			$output .= '</'.$size_2.'>';
		$output .= '</div>';

		return $output;
	}
}


wpb_map( array(
	"base"      => "pt_text_animated",
	"name"      => __("Animated Text", "js_composer"),
	"class"     => "wpb_vc_column_text",
	"icon"      => "fa fa-text-width",
	"category"  => __('Typography', 'js_composer'),
	"params"    => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"heading" => __("Static Text", "js_composer"),
			"param_name" => "text",
			"value" => "We Create",
			"description" => __("This text will not animate.", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Select Text Size", "js_composer"),
			"param_name" => "size_1",
			"value" => array("H1", "H2", "H3", "H4", "H5", "H6", "body"=>"div" )
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Static Text color", "js_composer"),
			"param_name" => "text_color",
			"value" => '', //Default color
			),
		array(
			"type" => "dropdown",
			"heading" => __("Select Text opacity", "js_composer"),
			"param_name" => "opacity_1",
			"value" => array("100", "90", "80", "70", "60", "50", "40", "30", "20", "10", "0" )
			),
		array(
			"type" => "exploded_textarea",
			"holder" => "span",
			"heading" => __("Animated Text", "js_composer"),
			"param_name" => "text_anime",
			"value" => "Products,Services,Experiences",
			"description" => __("Each line will animated at one time", "js_composer")
			),
		array(
			"type" => "dropdown",
			"heading" => __("Select Text Size", "js_composer"),
			"param_name" => "size_2",
			"value" => array("H1", "H2", "H3", "H4", "H5", "H6", "body"=>"div" )
			),
		array(
			"type" => "colorpicker",
			"heading" => __("Animated Text color", "js_composer"),
			"param_name" => "text_anime_color",
			"value" => '', //Default color
			),
		array(
			"type" => "dropdown",
			"heading" => __("Select Text opacity", "js_composer"),
			"param_name" => "opacity_2",
			"value" => array("100", "90", "80", "70", "60", "50", "40", "30", "20", "10", "0" )
			),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Select text align", "js_composer"),
			"param_name" => "text_align",
			"value" => $pt_array_text_align,
			"description" => ''
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
