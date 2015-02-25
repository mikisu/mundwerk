<?php

class WPBakeryShortCode_pt_social_icons_row extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$style = '';
		$css_animation = $animation_attr = '';
		$total_network = 0;

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
			'el_class'   => '',
			'css_animation' => '',
			'css_delay' => '',
			'pt_hidden_viewport' => ''
		), $atts));

		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);

		$el_class = $this->getExtraClass($el_class);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$output  = '<div class="pt_social_icons pt_social_icons_row'. $el_class .'" '. $animation_attr .'>';

		for ($i=1; $i < 11 ; $i++)
		{ 
			if ( ${"network_$i"} && ${"url_$i"} )
			{
				$total_network +=1;
			}
		}

		if ( $total_network ) {
			$total_network = 100 / $total_network;
		}

		for ($i=1; $i < 11 ; $i++)
		{ 
			if ( ${"network_$i"} && ${"url_$i"} )
			{
				$output .='
					<div class="wrapper row-'. ${"network_$i"} .'" style="width: '. $total_network .'%;">
						<a href="'. esc_url(${"url_$i"}) .'" target="_blank">
							<div class="text-center">
								<i class="monosocial-'. ${"network_$i"} .' on"></i>
							</div>
						</a>
					</div>';
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
	"base"      => "pt_social_icons_row",
	"name"      => __("Social Icons Row", "js_composer"),
	"class"     => "",
	"icon"      => __("fa fa-share-square", "js_composer"),
	"category"  => __('Social', "js_composer"),
	"params"    => $fields
	) );