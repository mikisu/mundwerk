<?php

class WPBakeryShortCode_pt_team extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$output = '';
		$css_animation = $animation_attr = '';

		extract(shortcode_atts(array(
			'network_1' => '', 'url_1' => '',
			'network_2' => '', 'url_2' => '',
			'network_3' => '', 'url_3' => '',
			'network_4' => '', 'url_4' => '',
			'network_5' => '', 'url_5' => '',

			'name' 				=> '',
			'role' 				=> '',
			'text_color' 		=> '',
			'image' 			=> '',


			'content_type' 		=> '',
			'content_text' 		=> '',


			'hover_color' 		=> '',
			'hover_text_color' 	=> '',
			'skills_bar_color' 	=> '',
			'skills_title' 		=> '',
			'skills' 			=> '',

			'el_class'   		=> '',
			'css_animation' 	=> '',
			'css_delay' 		=> '',
			'pt_hidden_viewport'=> ''
		), $atts));

		// CARREGA STILO PARA SOCIAL ICONS
		wp_enqueue_style('monosocialiconsfont');


		$pt_hidden_viewport = str_replace(',', ' ', $pt_hidden_viewport);

		$el_class = $this->getExtraClass($el_class);
		$el_class .= $this->getExtraClass($pt_hidden_viewport);

		if ($css_animation)
		{
			$animation_attr = ' data-animation="' . $css_animation . '" data-delay="' . ($css_delay ? $css_delay : '0') . '"';
		}

		$image_src = wp_get_attachment_image_src( $image, 'post-thumb-1-full' );

		// ID
		$uniq_id = "pt_team-".uniqid();


		// OUTPUT
		$output = ' <div id="'.$uniq_id.'" class="pt_team '. $el_class .'" '. $animation_attr .'>';

		if ($content_type != "") {


			$output .= '<div class="skills">';
				$output .= '<div class="mySkills">';
					$output .= '<h1>'.$skills_title.'</h1>';


				if ($content_type == "skills_bars") {
					$graph_lines = explode(",", $skills);
					$bar_css = 'style="background-color: '. $skills_bar_color .';"';
						
					foreach ($graph_lines as $line) {
						$single_val = explode("|", $line);
						
						$output .= '<p>'. $single_val[1] .'</p>';
						$output .= '<div class="pt-progress-bar progress template3">';
						$output .= '<div class="progress-bar" '. $bar_css .' data-value="'. (int)$single_val[0] .'"></div>';
						$output .= '</div>';
					}
				} else {
						$output .= '<span>'. $content_text .'</span>';
				}


				$output .= '</div>';
				$output .= '<img alt="'.$name.'" src="' . $image_src[0] . '">';

			$output .= '</div>';

		} else {
			$output .= '<img alt="' . $name . '" src="' . $image_src[0] . '">';
		}


			$output .= '<p class="name">' . $name . '</p>';
			$output .= '<em class="role">' . $role . '</em>';

			$output .= '<div class="team_social_icons">';
				for ($i=1; $i < 6; $i++)
				{ 
					if ( ${"network_$i"} && ${"url_$i"} )
					{
						$output .='
						<a class="" href="'. esc_url(${"url_$i"}) .'">
							<i class="monosocial-circle'. ${"network_$i"} .'"></i>
							<span class="monosocial-circle'. ${"network_$i"} .' on"></span>
						</a>';
					}
				}
			$output .= '</div>';


		$output .= '</div>';

		// CSS
		$text_color = ($text_color == "") 		? '#4a5157'	: $text_color;

		$output .= '<style>';
			$output .= '#'.$uniq_id.'.pt_team  { color:'.$text_color.';  }';
			$output .= '#'.$uniq_id.'.pt_team .skills  { color:'.$hover_text_color.';  }';
			$output .= '#'.$uniq_id.'.pt_team .skills .mySkills  { color:'.$hover_text_color.'; background-color: rgba('.pt_hex2rgb($hover_color).', 0.8);  }';
			$output .= '#'.$uniq_id.'.pt_team .skills .mySkills h1  { color:'.$hover_text_color.';  }';

			$output .= '#'.$uniq_id.'.pt_team .skills .mySkills .progress   { background: rgba('.pt_hex2rgb($hover_text_color).', 0.20);  }';
			$output .= '#'.$uniq_id.'.pt_team .skills .mySkills .progress-bar   { background-image: none; background-color: rgba('.pt_hex2rgb($hover_text_color).', 0.20);  }';
		$output .= '</style>';


		return $output;
	}
}


$fields = array();

$fields[] = array(
	"type" => "textfield",
	"heading" => __("Name", "js_composer"),
	"param_name" => "name",
	"value" => __("Member Name", "js_composer"),
	"description" => ""
	);
	
$fields[] = array(
		"type" => "textfield",
		"heading" => __("Role", "js_composer"),
		"param_name" => "role",
		"value" => __("Member Role", "js_composer"),
		"description" => ""
	);
	
$fields[] = array(
		"type" => "colorpicker",
		"heading" => __("Text Color", "js_composer"),
		"param_name" => "text_color",
		"value" => '#4a5157', 
	);
	
$fields[] = array(
		"type" => "attach_image",
		"heading" => __("Image", "js_composer"),
		"param_name" => "image",
		"value" => "",
		"description" => __("Select image from media library.", "js_composer")
	);
	

$fields[] = array(
		"type" => "textfield",
		"heading" => __("Hover Title", "js_composer"),
		"param_name" => "skills_title",
		"value" => __("My Skills", "js_composer"),
		"dependency" => array('element' => "add_skills", 'value' => "1")
	);

		$fields[] = array(
			"type" => "dropdown",
			"heading" => __("Content Type", "js_composer"),
			"param_name" => "content_type",
			"value" => "",
			"value" => array(__("None", "js_composer") => "", __("Text", "js_composer") => "content_text", __("Skills Bars", "js_composer") => "skills_bars"),
			);
	
					$fields[] = array(
							"type" => "exploded_textarea",
							"heading" => __("Skills List", "js_composer"),
							"param_name" => "skills",
							"value" => "90|Development,80|Design,70|Marketing",
							"description" => __('Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', 'js_composer'),
							"dependency" => array('element' => "content_type", 'value' => "skills_bars")
						);

					$fields[] = array(
							"type" => "textarea",
							"holder" => "div",
							"class" => "",
							"heading" => __("Text", "js_composer"),
							"param_name" => "content_text",
							"value" => __("Your Text here", "js_composer"),
							"dependency" => array('element' => "content_type", 'value' => "content_text")

						);


$fields[] = array(
		"type" => "colorpicker",
		"heading" => __("Image Hover Color", "js_composer"),
		"param_name" => "hover_color",
		"value" => '#4a5157', 
		"dependency" => Array('element' => "content_type", 'not_empty' => true)
	);
	
$fields[] = array(
		"type" => "colorpicker",
		"heading" => __("Hover Text Color", "js_composer"),
		"param_name" => "hover_text_color",
		"value" => '#ffffff', 
		"dependency" => Array('element' => "content_type", 'not_empty' => true)
	);
	
$fields[] = array(
		"type" => "colorpicker",
		"heading" => __("Skills Bar Color", "js_composer"),
		"param_name" => "skills_bar_color",
		"value" => '#f7901e', 
		"dependency" => array('element' => "content_type", 'value' => "skills_bars")
	);
	

	



for ($i=1; $i < 6; $i++) { 
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
	"base"      => "pt_team",
	"name"      => __("Team", "js_composer"),
	"class"     => "",
	"icon"      => __("fa fa-users", "js_composer"),
	"category"  => __('Misc', "js_composer"),
	"params"    => $fields
	) );