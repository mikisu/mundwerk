<?php

/* Social Networks */
$pt_array_social_networks_label = array('Bitbucket', 'Dribbble', 'Facebook', 'Flickr', 'Foursquare', 'Github', 'Gittip', 'Google Plus', 'Instagram', 'Linkedin', 'Maxcdn', 'Pinterest', 'Renren', 'Skype', 'Stack Exchange', 'Trello', 'Tumblr', 'Twitter', 'VK', 'Weibo', 'Xing', 'YouTube');
$pt_array_social_networks = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');


/*
Check PixelThrone plugin for updates
*/
function pt_pixelthrone_plugin_check( $pt_plugin_last_version ) {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	$pixelthrone_plugin = 'pixelthrone/index.php';

	if ( is_plugin_active( $pixelthrone_plugin ) ) {
	
	$get_plugins = get_plugins();

	$pt_plugin_current_version = $get_plugins[$pixelthrone_plugin];

		if ( version_compare( $pt_plugin_current_version['Version'], $pt_plugin_last_version, '<') ) {

			function my_admin_notice_pixelthrone_plugin_check() {
				echo '<div class="update-nag custom_error_notice_file_plugin_update">
					<h1>PixelThrone Plugin</h1>

					<span class="block1">
						<p>A new version is available, please update to the latest version to ensure maximum compatibility with this theme.</p>
						<p>To learn how to do it check out this video.</p>
					</span>

					<span class="block2">
						<a href="http://youtu.be/01Zi0kQqqhM" target="_blank"><i class="ion-social-youtube"></i><p>View on <br>YouTube<p></a>
					</span>
				</div>';

				echo '<style>
						.custom_error_notice_file_plugin_update {padding-bottom:10px!important}
						.custom_error_notice_file_plugin_update.update-nag{display:block}
						.custom_error_notice_file_plugin_update .block1{width:80%;max-width:750px;display:inline-block;margin-right:10px;vertical-align:top}
						.custom_error_notice_file_plugin_update .block2{width:20%;display:inline-block;vertical-align:top;border-left:1px solid #ccc;padding-left:30px;height:50px}
						.custom_error_notice_file_plugin_update h1{font-size:1.4em;margin:.67em 0 .17em}
						.custom_error_notice_file_plugin_update p{margin:.4em 0 .5em!important}
						.custom_error_notice_file_plugin_update a i{font-size:50px;display:inline-block;vertical-align:top;margin-right:10px}
						.custom_error_notice_file_plugin_update a p{display:inline-block;vertical-align:top;font-size:16px;font-style:italic;font-weight:900;line-height:16px}
					</style>
				';
			}
			add_action( 'admin_notices', 'my_admin_notice_pixelthrone_plugin_check' );

		}
	} 

}


/*
Estimated reading time
*/
function pt_estimate_reading_time ( $post_id ) {
	$post = get_post( $post_id );
	if ( $post ) {
		$mycontent = $post->post_content; // wordpress users only
		$word = str_word_count(strip_tags($mycontent));
		$m = floor($word / 200);
		$s = floor($word % 200 / (200 / 60));
		$est = __('Around', 'pt_framework') . ' ';
		$est .=  ($m ? $m . ' minute' . ($m == 1 ? '' : 's') . ' and ' : '' ). $s . ' second' . ($s == 1 ? '' : 's');
		$est .= ' '. __('to read', 'pt_framework');
	
		return $est;
	}
}



/*
$time = strtotime('2010-04-28 17:25:43');
echo 'event happened '.humanTiming($time).' ago';
*/
function pt_humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}


/*
Get User Role
*/
function pt_get_user_role($id)
{
    $user = new WP_User($id);
    return array_shift($user->roles);
}


/*
get Theme Options value
*/
function pt_get_theme_option ( $option, $suboption=null )
{
	global $pt_theme_options;

	if ( isset($pt_theme_options[$option]) ) {
		if ( $suboption ) {
			if ( isset($pt_theme_options[$option][$suboption]) ) {
				return $pt_theme_options[$option][$suboption];
			} else {
				return $pt_theme_options[$option];
			}
		} else {
			return $pt_theme_options[$option];
		}
	} else {
		return true;
	}
}


/*
get Theme Options values
*/
function pt_get_theme_options ( )
{
	global $pt_theme_options;

	if ( $pt_theme_options ) {
		return $pt_theme_options;
	} else {
		return false;
	}
}


/*
get Theme Options values
*/
function pt_css_style_option ($propriety='', $value='')
{
	if ($value)
	{
		return $propriety . ': ' . $value . ';';
	}
	else
	{
		return FALSE;
	}
}


/*
Return if current page is a blog page
*/
function is_blog () {
	global $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag()) || (is_search())) && ( $posttype == 'post') ) ? true : false ;
}


/*
Get the logo from Theme Options
*/
function pt_get_logo()
{
	$html = '';

if ( is_string(pt_get_theme_option('logo', 'url')) ) {

	if ( pt_get_theme_option('logo', 'url') ) {
		$html .= '<img class="noretina" src="'. pt_get_theme_option('logo', 'url') .'" alt="'. get_bloginfo('name') .'" title="'. get_bloginfo('name') .'">';
	}
	if ( pt_get_theme_option('logo_retina', 'url') ) {
		$html .= '<img class="retina true" src="'. pt_get_theme_option('logo_retina', 'url') .'" alt="'. get_bloginfo('name') .'" title="'. get_bloginfo('name') .'">';
	}


	if ( pt_get_theme_option('logo', 'url') && !pt_get_theme_option('logo_retina', 'url') ) {
		$html .= '<img class="retina" src="'. pt_get_theme_option('logo', 'url') .'" alt="'. get_bloginfo('name') .'" title="'. get_bloginfo('name') .'">';
	}
	if ( !pt_get_theme_option('logo', 'url') && pt_get_theme_option('logo_retina', 'url') ) {
		$html .= '<img class="noretina" src="'. pt_get_theme_option('logo_retina', 'url') .'" alt="'. get_bloginfo('name') .'" title="'. get_bloginfo('name') .'">';
	}

	if ( !pt_get_theme_option('logo', 'url') && !pt_get_theme_option('logo_retina', 'url') ) {
		$html .= '<span class="h3">' . get_bloginfo('name') . '</span>';
	}
} else {
	$html .= '<span class="h3">' . get_bloginfo('name') . '</span>';
}

	return $html;
}


/*
Get the llanguage flags
*/
function pt_language_flags() {
	if (function_exists('icl_get_languages'))
	{
		$languages = icl_get_languages('skip_missing=0');

		if(!empty($languages))
		{
			echo '<ul class="list-unstyled list-inline">';

			foreach($languages as $l)
			{
				if($l['country_flag_url'])
				{
					if(!$l['active'])
					{
						echo '<li><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
					} 

					else
					{
						echo '<li class="current-language">'.$l['translated_name'].'</li>'."\n";
					}
				}
			}

			echo '</ul>';
		}
	}
}


/*
Get page markup
*/
function pt_get_page_options($id=NULL)
{
	if ( $page_data = get_post($id) ) {
	
		$page_inline_style = '';
		$page_content_inline_style = '';
		$page_pattern_style = '';
		$page_pattern_class = '';
		$page_attr = '';
		$page_options = '';
		$show_page = '';
		$page_raw = '';

		$page_id = $page_data->ID;
		$page_slug = $page_data->post_name;
		$page_content = apply_filters('the_content', $page_data->post_content);
		$page_class = get_post_class('', $page_id);

		if ( function_exists( 'get_fields' ) )
		{
			$page_options = get_fields($page_id);
			unset($page_options['']); //empty field
			
			$page_title = ( isset($page_options['page_title']) && $page_options['page_title'] == 'hide' ? NULL : $page_data->post_title );
			$show_page = ( isset($page_options['show_page'])  ? $page_options['show_page'] : TRUE);
			$page_raw = $page_options;

		} else {
			$page_title = $page_data->post_title;
			$show_page = TRUE;
			$page_raw = false;
		}
		
		$page_content_inline_style .= (isset($page_options['text_color']) && $page_options['text_color'] ? pt_css_style_option('color', $page_options['text_color']) : '');
		$page_content_inline_style .= (isset($page_options['margin_top']) && $page_options['margin_top'] ? 'padding-top: ' . (int)$page_options['margin_top'] . 'px;' : NULL);
		$page_content_inline_style .= (isset($page_options['margin_bottom']) && $page_options['margin_bottom'] ? 'padding-bottom: ' . (int)$page_options['margin_bottom'] . 'px;' : NULL);

		$page_pattern_class .= (isset($page_options['bg_overlay']) && $page_options['bg_overlay'] ? 'section-pattern-overlay' : '');
		$page_pattern_class .= ((isset($page_options['bg_color']) && $page_options['bg_color']) && !(isset($page_options['bg_overlay']) && $page_options['bg_overlay']) ? 'section-bg-color' : '');

		$page_pattern_style .= (isset($page_options['bg_color']) && $page_options['bg_color'] ? pt_css_style_option('background-color', $page_options['bg_color']) : '');
		$page_pattern_style .= (isset($page_options['bg_color']) && $page_options['bg_color'] ? pt_css_style_option('background-color', 'rgba(' . pt_hex2rgb($page_options['bg_color']) . ', ' . ($page_options['bg_opacity']/100) . ')') : '');

		if (isset($page_options['bg_images'][0]) && count($page_options['bg_images']) == 1)
		{
			$page_inline_style .= (($bg_image = $page_options['bg_images'][0]) ? 'background-image: url(' . $bg_image['url'] . ');' : NULL);
			$page_attr .= (isset($page_options['parallax']) && $page_options['parallax'] ? ' data-stellar-background-ratio="0.5" ' : NULL);
			$page_class[] = (isset($page_options['parallax']) && $page_options['parallax'] ? 'parallax' : NULL);
			$page_class[] = (isset($page_options['bg_cover']) && $page_options['bg_cover'] ? NULL : 'bg-cover');
			$page_class[] = (isset($page_options['bg_repeat']) && $page_options['bg_repeat'] ? 'bg-repeat' : NULL);
		}

		$page_class[] = (isset($page_options['full_height']) && $page_options['full_height'] ? 'full-height' : NULL);
		$page_class[] = (isset($page_options['portfolio_layout']) && $page_options['portfolio_layout'] ? $page_options['portfolio_layout'] : NULL);

		if (empty($page_inline_style)) {
			$page_inline_style = 'background-color: '. pt_get_theme_option('body-bg-color') .';';
		}

		if (empty($page_inline_style)) {
			$page_inline_style = "background-color: #fff;";
		}

		$data = array(
			'id' => $page_id,
			'post_name' => $page_slug,
			'class' => implode(' ', $page_class),
			'style' => $page_inline_style,
			'content_style' => $page_content_inline_style,
			'pattern_style' => $page_pattern_style,
			'pattern_class' => $page_pattern_class,
			'page_title' => $page_title,
			'page_content' => $page_content,
			'template' => get_page_template_slug($page_id),
			'attr' => $page_attr,
			'show_page' => $show_page,
			//'raw' => $page_raw
		);

		if ( !empty($page_raw) ) {
			$data['raw'] = $page_raw;
		}

		return $data;
	}
}


/*

*/
function pt_get_key_by_value($array=array(), $field='', $input='')
{
	foreach ($array as $key => $value)
	{
		if ($value->$field == $input)
		{
			return $key;
		}
	}
}


/*
Converts hex to rgb
*/
function pt_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return implode(", ", $rgb); // returns the rgb values separated by commas
	//return $rgb; // returns an array with the rgb values
}


/*
Converts to bool
*/
function pt_bool( $string )
{
	return filter_var($string, FILTER_VALIDATE_BOOLEAN);
}


/* Parse Video Thumbs */
/*
http://stackoverflow.com/questions/2068344/how-to-get-thumbnail-of-youtube-video-link-using-youtube-api
*/
function pt_video_thumbs($url='')
{
	$thumb = '';

	if (strpos($url,'vimeo') !== false)
	{
		$result = preg_match('/(\d+)/', $url, $matches);

		if ($result)
		{
			$id = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/" . $matches[0] . ".php"));
			$thumb = $id[0]['thumbnail_large'];
		}

	}

	if (strpos($url,'youtube') !== false)
	{
		parse_str( parse_url( $url, PHP_URL_QUERY ), $matches );
		$thumb = 'http://img.youtube.com/vi/' . $matches['v'] . '/hqdefault.jpg';
	}

	return $thumb;
}


/* 
Delete in Array
*/
function pt_delete_from_array($key, $value, $array)
{
	if (!is_array($array))
	{
		return FALSE;
	}

	foreach ($array as $k => $v)
	{
		if ($v[$key] == $value)
		{ 
			unset($array[$k]);
		}
	}

	return $array;
}


/*
Find in Array
*/
function pt_aasort (&$array, $key)
{
	$sorter=array();
	$ret=array();

	if (!is_array($array))
	{
		return FALSE;
	}

	reset($array);

	foreach ($array as $ii => $va)
	{
		$sorter[$ii]=$va[$key];
	}

	asort($sorter);

	foreach ($sorter as $ii => $va)
	{
		$ret[$ii]=$array[$ii];
	}

	$array=$ret;
}


/*
Ajax request
*/
function pt_is_ajax_request()
{
	return ( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'XMLHttpRequest') );
}


/*
Get the Widget (wrapper for the_widget). http://codex.wordpress.org/Function_Reference/the_widget
*/
if( !function_exists('get_the_widget') ){
	
	function get_the_widget( $widget, $instance = '', $args = '' ){
		ob_start();
		the_widget($widget, $instance, $args);
		return ob_get_clean();
	}
}


/*
get page by template
*/
function pt_get_page_by_template($template_name='')
{
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => $template_name
	));

	/* removes duplicates due imports */
	if ( is_array($pages) && !empty($pages) ) {
		$unique_pages = array();
		$unique_pages[] = $pages[0];

		foreach ($pages as $key => $value) {

			$is_unique = TRUE;

			foreach ($unique_pages as $k => $v) {

				if ( $value->ID === $v->ID ) {
					$is_unique = FALSE;
				} 
			}
			if ($is_unique) {
				$unique_pages[] = $value;
			}
		}
	} else {
		$unique_pages = $pages;
	}

	return $unique_pages;
	//return $pages;
}


//Count widgets on a given sidebar
function count_sidebar_class( $sidebar_name ) {
	global $sidebars_widgets;
	$count = count ($sidebars_widgets[$sidebar_name]);
	return $count;
}
