<?php

class WPBakeryShortCode_pt_testimonials_image extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$fields = array();
		$css_animation = $animation_attr = $output = '';

		for ($i=1; $i < 11 ; $i++)
		{
			$fields["image_" . $i] = '';
			$fields["author_" . $i] = '';
			$fields["quote_" . $i] = '';
			$fields["position_" . $i] = '';
		}

		$fields['arrows_color'] = '#72767a';
		$fields['css_animation'] = '';
		$fields['css_delay'] = '';
		$fields['el_class'] = '';
		$fields['pt_hidden_viewport'] = '';
		$fields['show_arrows'] = 'false';
		$fields['autoplay'] = 'false';

		extract(shortcode_atts($fields, $atts));

		$el_class = $this->getExtraClass($el_class);

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);


		$uniq_id = uniqid('pt_testimonials-');

		$output .= '<style>';

			$output .= 
			'#'.$uniq_id.' .owl-controls .owl-buttons div.owl-prev:after, 
			#'.$uniq_id.'  .owl-controls .owl-buttons div.owl-prev:before { background-color: '.$arrows_color.'; }'."\n";
			
			$output .= 
			'#'.$uniq_id.' .owl-controls .owl-buttons div.owl-next:after, 
			#'.$uniq_id.'  .owl-controls .owl-buttons div.owl-next:before { background-color: '.$arrows_color.'; }'."\n";

		$output .= '</style>';


		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		//js vars
		$caroucel_attr = ' data-navigation="' . $show_arrows . '" data-autoplay="' . $autoplay . '"';


		$output .= '<ul id="'. $uniq_id .'" class="pt-testimonials-image list-unstyled'. $el_class .'" ' . $animation_attr . $caroucel_attr .'>';

		for ($i=1; $i < 11 ; $i++)
		{
			$image_src = wp_get_attachment_image_src( ${"image_$i"}, 'thumbnail' );

			if (${"quote_$i"})
			{
				$output .= '<li>';
					$output .= '<blockquote >';
						$output .= '<p>' . ${"quote_$i"} . '</p>';
					
						$output .= '<div class="info">';

							if ( $image_src ) {
								$output .= '<figure class="pull-left"><img class="img-circle" alt="'. ${"author_$i"} .'" src="'. $image_src[0] .'" width="'. $image_src[1] .'" height="'. $image_src[2] .'"></figure>';
							} 

							if ( ${"author_$i"} || ${"position_$i"} ) {
								$extraClass = "";
								if ( !${"position_$i"} ) { $extraClass = "centraAutor"; }

								$output .= '<div class="pull-left '.$extraClass.'">';

									$output .= '<cite class="author">' . ${"author_$i"} . '</cite>';
									if ( ${"position_$i"} ) { $output .= '<cite class="position">' . ${"position_$i"} . '</cite>';  } 

								$output .= '</div>';
							}

						$output .= '</div>';

					$output .= '</blockquote>';

				$output .= '</li>';
			}
		}

		$output .= '</ul>';

		return $output;
	}
}



$fields = array();

for ($i=1; $i < 11 ; $i++)
{
	$fields[] = array(
		"type" => "attach_image",
		"heading" => __("Image", "js_composer"),
		"param_name" => "image_" . $i,
		"description" => __("Select image from media library", "js_composer"),
		"group" => __('T' . $i, 'js_composer')
	);

	$fields[] = array(
		"type" => "textarea",
		"heading" => __("Quote", "js_composer"),
		"param_name" => "quote_" . $i,
		"value" => "",
		"description" => __('Do not use the characters " (double quote)', "js_composer"),
		"group" => __('T' . $i, 'js_composer')
	);

	$fields[] = array(
		"type" => "textfield",
		"heading" => __("Author", "js_composer"),
		"param_name" => "author_" . $i,
		"value" => "",
		"group" => __('T' . $i, 'js_composer')
	);

	$fields[] = array(
		"type" => "textfield",
		"heading" => __("Position", "js_composer"),
		"param_name" => "position_" . $i,
		"value" => "",
		"description" => "",
		"group" => __('T' . $i, 'js_composer')
	);

}


$fields[] =	array(
	"type" => "checkbox",
	"heading" => __("Show navigation arrows", "js_composer"),
	"param_name" => "show_arrows",
	"value" => array ("Show" => "true"),
	"description" => "",
	"group" => __('Extra Options', 'js_composer')
	);

$fields[] = array(
	"type" => "colorpicker",
	"heading" => __("Arrows Color", "js_composer"),
	"param_name" => "arrows_color",
	"value" => '#72767a', 
	"group" => __('Extra Options', 'js_composer')
	);

$fields[] =	array(
	"type" => "checkbox",
	"heading" => __("Autoplay", "js_composer"),
	"param_name" => "autoplay",
	"value" => array ("True" => "true"),
	"description" => "",
	"group" => __('Extra Options', 'js_composer')
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
	"base"      => "pt_testimonials_image",
	"name"      => __("Testimonials Image", "js_composer"),
	"class"     => "",
	"icon"      => "fa fa-quote-left",
	"category"  => __('Misc', "js_composer"),
	"params"    => $fields
) );
