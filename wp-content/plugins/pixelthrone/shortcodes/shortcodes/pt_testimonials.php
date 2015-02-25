<?php

class WPBakeryShortCode_pt_testimonials extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$fields = array();
		$css_animation = $animation_attr = '';

		for ($i=1; $i < 11 ; $i++)
		{ 
			$fields["author_" . $i] = '';
			$fields["quote_" . $i] = '';
		}

		$fields['autoplay'] = 'false';
		$fields['css_animation'] = '';
		$fields['css_delay'] = '';
		$fields['el_class'] = '';
		$fields['pt_hidden_viewport'] = '';
		$fields['show_icon'] = '';


		extract(shortcode_atts($fields, $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$output = '<div class="pt-testimonialscontainer">';

		if ($show_icon) {
			$output .= '<i class="iconTest ion-android-chat"></i>';
		}

		$output .= '<ul class="pt-testimonials list-unstyled'. $el_class .'" ' . $animation_attr . ' data-autoplay="' . $autoplay . '">';

		for ($i=1; $i < 11 ; $i++)
		{ 
			if (${"quote_$i"})
			{
				$output .= '<li>';
				$output .= '<blockquote>';
				$output .= '<p>' . ${"quote_$i"} . '</p>';

				if (${"author_$i"})
				{
					$output .= '<small><cite title="' . ${"author_$i"} . '">' . ${"author_$i"} . '</cite></small>';
				}

				$output .= '</blockquote>';
				$output .= '</li>';
			}
		}

		$output .= '</ul>';
		$output .= '</div>';

		return $output;
	}
}


$fields = array();

for ($i=1; $i < 11 ; $i++)
{ 
	$fields[] = array(
		"type" => "textarea",
		"holder" => "div",
		"class" => "",
		"heading" => __("Quote " . $i, "js_composer"),
		"param_name" => "quote_" . $i,
		"value" => ""
	);

	$fields[] = array(
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		"heading" => __("Author " . $i, "js_composer"),
		"param_name" => "author_" . $i,
		"value" => ""
	);
}


$fields[] =	array(
	"type" => "checkbox",
	"heading" => __("Icon on Top", "js_composer"),
	"param_name" => "show_icon",
	"value" => array ("Show" => "hidden-phone"),
	"description" => ""
	);

$fields[] =	array(
	"type" => "checkbox",
	"heading" => __("Autoplay", "js_composer"),
	"param_name" => "autoplay",
	"value" => array ("True" => "true"),
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
	"base"      => "pt_testimonials",
	"name"      => __("Testimonials Text", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-quote-left",
	"category"  => __('Misc', "js_composer"),
	"params"    => $fields
) );
