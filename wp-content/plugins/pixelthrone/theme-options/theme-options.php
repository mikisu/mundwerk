<?php

// Reset array
$this->sections = array();

/* Social Networks */
$pt_array_social_networks_label = array('Bitbucket', 'Dribbble', 'Facebook', 'Flickr', 'Foursquare', 'Github', 'Gittip', 'Google Plus', 'Instagram', 'Linkedin', 'Maxcdn', 'Pinterest', 'Renren', 'Skype', 'Stack Exchange', 'Trello', 'Tumblr', 'Twitter', 'VK', 'Weibo', 'Xing', 'YouTube');
$pt_array_social_networks       = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');


/* GENERAL SETTINGS */


$this->sections[] = array(
	'icon' => 'ion-settings',
	'title' => __('General Settings', 'redux-framework'),
	'fields' => array(
		array(
			'id'=>'favicon',
			'type' => 'media', 
			'url'=> false,
			'title' => __('Favicon', 'redux-framework'),
			'subtitle'=> __('A favicon is a file containing one  small icon, most commonly 16x16 pixels.', 'redux-framework'),
			),
		array(
			'id'=>'show_preloader',
			'type' => 'switch', 
			'title' => __('Show Site Preloader', 'redux-framework'),
			'subtitle'=> 'Loads all images before showing the side',
			"default" => 1,
			'on' => 'On',
			'off' => 'off',
			),
		array(
			'id'=>'tracking-code',
			'type' => 'textarea',
			'title' => __('Tracking Code', 'redux-framework'), 
			'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'redux-framework'),
			//'validate' => 'js',
			'desc' => '',
			),
		array(
			'id'=>'custom-css',
			'type' => 'ace_editor',
			'title' => __('Custom CSS', 'redux-framework'), 
			'subtitle' => __('Paste your CSS code here..', 'redux-framework'),
			'mode' => 'css',
			'theme' => 'chrome',
			'desc' => __('Don\'t add <code>&lt;style&gt;</code> tag', 'redux-framework'),
			'default' => ""
			),
		array(
			'id'=>'custom-js',
			'type' => 'ace_editor',
			'title' => __('Custom Javascript', 'redux-framework'), 
			'subtitle' => __('Paste your JS code here.', 'redux-framework'),
			'mode' => 'javascript',
			'theme' => 'chrome',
			'desc' => __('Don\'t add <code>&lt;script&gt;</code> tag', 'redux-framework'),
			'default' => ""
			),
		// array(
		// 	'id'=>'show_menu_docs',
		// 	'type' => 'switch', 
		// 	'title' => __('Show documentation menu', 'redux-framework'),
		// 	'subtitle'=> '',
		// 	"default" => 1,
		// 	'on' => 'On',
		// 	'off' => 'off',
		// 	),
		)
);


/* STYLING OPTIONS */


$this->sections[] = array(
	'icon' => 'el-icon-file-edit',
	'title' => __('Styling Options', 'redux-framework'),
	'fields' => array(

		array(
			'id'=>'primary-color',
			'type' => 'color',
			'title' => __('Primary Color', 'redux-framework'), 
			'compiler'=>'true',
			'subtitle' => __('Pick Theme Primary Color (default: #e30037).', 'redux-framework'),
			'default' => '#f7901e',
			'transparent' => false,
			'validate' => 'color',
			),
		array(
			'id'=>'secondary-color',
			'type' => 'color',
			'title' => __('Loading Color', 'redux-framework'), 
			'compiler'=>'true',
			'subtitle' => __('Pick Theme Loading Color (default: #ffffff).', 'redux-framework'),
			'default' => '#ffffff',
			'transparent' => false,
			'validate' => 'color',
			),
		array(
			'id'=>'body-bg-color',
			'type' => 'color',
			'title' => __('Body Background Color', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Pick a background color(default: #ffffff).', 'redux-framework'),
			'default' => '#ffffff',
			'transparent' => false,
			'validate' => 'color',
			),
		array(
			'id' => 'notice_normal',
			'type' => 'info',
			'class' => 'header',
			'notice' => true,
			'title' => __('Menu Styling', 'redux-framework')
			),
		array(
			'id'=>'show_menu',
			'type' => 'switch', 
			'title' => __('Show Menu', 'redux-framework'),
			'subtitle'=> '',
			"default" => 1,
			'on' => 'Show',
			'off' => 'Hide',
			),
		array(
			'id'=>'show_menu_position',
			'type' => 'button_set', 
			'title' => __('Menu Position', 'redux-framework'),
			'subtitle'=> '',
			"default" => '1',
            'options' => array('1' => 'Top', '2' => 'Bottom'),
			'required' => array('show_menu','equals','1'),
			),
		array(
			'id'=>'show_menu_delayed',
			'type' => 'switch', 
			'title' => __('Show Menu in First Page', 'redux-framework'),
			'subtitle'=> '',
			"default" => 1,
			'on' => 'Show',
			'off' => 'Hide',
			'required' => array('show_menu','equals','1'),
			),
		array(
			'id'=>'header-bg-color',
			'type' => 'color',
			'title' => __('Menu Background Color', 'redux-framework'), 
			'compiler'=>'true',
			'subtitle' => __('Pick a color for the Header (default: #2d3032).', 'redux-framework'),
			'default' => '#2d3032',
			//'transparent' => false,
			'required' => array('show_menu','equals','1'),
			'validate' => 'color',
			),
		array(
			'id'=>'show_menu_bg_first_page',
			'type' => 'switch', 
			'title' => __('Menu Background on First Page', 'redux-framework'),
			'subtitle'=> '',
			'default' => 1,
			'on' => 'Show',
			'off' => 'Hide',
			'required' => array(
				array('show_menu','equals','1'),
				array('show_menu_delayed','equals','1')
				),
			),
		array(
			'id'=>'show_menu_search',
			'type' => 'switch', 
			'title' => __('Show Search on Menu ', 'redux-framework'),
			'subtitle'=> '',
			'default' => '1',
			'on' => 'Show',
			'off' => 'Hide',
			'required' => array('show_menu','equals','1'),
			),

		array(
			'id'=>'header_font',
			'type' => 'typography',
			'title' => __('Menu Font', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the Header font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'required' => array('show_menu','equals','1'),
			'default' => array(
				'color'=>'#ffffff',
				'font-size'=>'13px',
				'line-height'=>'30px',
				'font-family'=>'Open Sans',
				'font-style'=>'600',
				'font-weight'=>'',
				),
			),
		array(
			'id'=>'navMobileBackground',
			'type' => 'color',
			'title' => __('Mobile Menu Background Color', 'redux-framework'), 
			'compiler'=>'true',
			'subtitle' => __('Pick a color for the Mobile Menu Background Color (default: #20282d).', 'redux-framework'),
			'default' => '#20282d',
			'transparent' => false,
			'required' => array('show_menu','equals','1'),
			'validate' => 'color',
			),
		array(
			'id'=>'navMobileText',
			'type' => 'color',
			'title' => __('Mobile Menu Text Color', 'redux-framework'), 
			'compiler'=>'true',
			'subtitle' => __('Pick a color for the Mobile Menu Text Color (default: #ffffff).', 'redux-framework'),
			'default' => '#ffffff',
			'transparent' => false,
			'required' => array('show_menu','equals','1'),
			'validate' => 'color',
			),
		array(
			'id'=>'navMobileHeading',
			'type' => 'color',
			'title' => __('Mobile Menu Heading Color', 'redux-framework'), 
			'compiler'=>'true',
			'subtitle' => __('Pick a color for the Mobile Menu Heading Color (default: #414f56).', 'redux-framework'),
			'default' => '#414f56',
			'transparent' => false,
			'required' => array('show_menu','equals','1'),
			'validate' => 'color',
			),
		array(
			'id' => 'notice_normal',
			'type' => 'info',
			'class' => 'header',
			'notice' => true,
			'title' => __('Theme Logo', 'redux-framework'),
			),
		array(
			'id'=>'logo',
			'type' => 'media', 
			'url'=> false,
			'title' => __('Logo', 'redux-framework'),
			'required' => array('show_menu','equals','1'),
			'subtitle'=> __('Upload a logo for your theme.', 'redux-framework'),
			),
		array(
			'id'=>'logo_retina',
			'type' => 'media', 
			'url'=> false,
			'title' => __('Logo Retina', 'redux-framework'),
			'required' => array('show_menu','equals','1'),
			'subtitle'=> __('Upload the retina logo for your theme, should be 2x the size of your logo.', 'redux-framework'),
			),
		)
);


// Sound Settings


$this->sections[] = array(
	'icon' => 'ion-music-note',
	'title' => __('Sound Settings', 'redux-framework'),
	'fields' => array(
		array(
			'id'=>'show_musicPlayer',
			'type' => 'switch', 
			'title' => __('Show Music Player', 'redux-framework'),
			'subtitle'=> 'Add a song to your site.<br>The player will appear in your home.',
			"default" => 0,
			'1' => 'Yes',
			'0' => 'no',
			),
		array(
			'id'=>'musicPlayer',
			'type' => 'media', 
			'title' => __('Music', 'redux-framework-demo'),
			'url' => true,
			'mode' => false,
			'readonly' => false,
			'preview' => false,
			//'desc'=> __('', 'redux-framework-demo'),
			'subtitle' => __('Load the song that you wish hear in your site.', 'redux-framework-demo'),
			'required' => array('show_musicPlayer','equals','1'),
		),
		array(
			'id'=>'music_bar_color',
			'type' => 'color',
			'title' => __('Bars Color', 'redux-framework'), 
			'compiler'=>'true',
			//'subtitle' => __('Pick music player the Bar Color (default: #e30037).', 'redux-framework'),
			'default' => '#ffffff',
			'transparent' => false,
			'validate' => 'color',
			'required' => array('show_musicPlayer','equals','1'),
			),
		array(
			'id' => 'notice_normal',
			'type' => 'info',
			'class' => 'header',
			'notice' => true,
			'title' => __('Menu Sound Effects', 'redux-framework')
			),
		array(
			'id'=>'playSounds',
			'type' => 'switch', 
			'title' => __('Play Sound Effects', 'redux-framework'),
			'subtitle' => __('Turn Off if you do not wish that exist sound effects on the site (eg: on the menu)', 'redux-framework-demo'),
			"default" => 1,
			'on' => 'On',
			'off' => 'off',
			),
	)
);


/* TYPOGRAPHY */


$this->sections[] = array(
	'icon' => 'fa fa-text-height',
	'title' => __('Typography', 'redux-framework'),
	'desc' => __('<p class="description">Set theme typography</p>', 'redux-framework'),
	'fields' => array(
		array(
			'id'=>'body_font',
			'type' => 'typography',
			'title' => __('Body Font', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the body font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'default' => array(
				'color'=>'#000000',
				'font-family'=>'Open Sans',
				'font-size'=>'16px',
				'line-height'=>'25px',
				'font-style'=>'400',
				'font-weight'=>'',
				),
			),
		array(
			'id'=>'page_title',
			'type' => 'typography',
			'title' => __('Page Title', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the page title font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'default' => array(
				'color'=>'#2d3032',
				'font-size'=>'25px',
				'line-height'=>'40px',
				'font-family'=>'Montserrat',
				'font-style'=>'400',
				'font-weight'=>'',
				),
			),
		array(
			'id'=>'h1_font',
			'type' => 'typography',
			'title' => __('Heading 1', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the heading 1 font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'default' => array(
				'color'=>'#4a5157',
				'font-size'=>'25px',
				'line-height'=>'30px',
				'font-family'=>'Open Sans',
				'font-style'=>'300',
				'font-weight'=>'',
				),
			),
		array(
			'id'=>'h2_font',
			'type' => 'typography',
			'title' => __('Heading 2', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the heading 2 font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'default' => array(
				'color'=>'#4a5157',
				'font-size'=>'25px',
				'line-height'=>'30px',
				'font-family'=>'Open Sans',
				'font-style'=>'400',
				'font-weight'=>'',
				),
			),			
		array(
			'id'=>'h3_font',
			'type' => 'typography',
			'title' => __('Heading 3', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the heading 3 font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'default' => array(
				'color'=>'#4a5157',
				'font-size'=>'25px',
				'line-height'=>'30px',
				'font-family'=>'Open Sans',
				'font-style'=>'600',
				'font-weight'=>'',
				),
			),
		array(
			'id'=>'h4_font',
			'type' => 'typography',
			'title' => __('Heading 4', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the heading 4 font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'default' => array(
				'color'=>'#4a5157',
				'font-size'=>'20px',
				'line-height'=>'30px',
				'font-family'=>'Open Sans',
				'font-style'=>'600',
				'font-weight'=>'',
				),
			),
		array(
			'id'=>'h5_font',
			'type' => 'typography',
			'title' => __('Heading 5', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the heading 5 font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'default' => array(
				'color'=>'#000000',
				'font-size'=>'60px',
				'line-height'=>'60px',
				'font-family'=>'Open Sans',
				'font-style'=>'600',
				'font-weight'=>'',
				),
			),
		array(
			'id'=>'h6_font',
			'type' => 'typography',
			'title' => __('Heading 6', 'redux-framework'),
			'compiler'=>'true',
			'subtitle' => __('Specify the heading 6 font properties.', 'redux-framework'),
			'google'=>true,
			'text-align' => false,
			'default' => array(
				'color'=>'#000000',
				'font-size'=>'70px',
				'line-height'=>'70px',
				'font-family'=>'',
				'font-style'=>'',
				'font-weight'=>'',
				),
			),
		)
);


/* SOCIAL NETWORKS */


$array_social_networks = array();

foreach ($pt_array_social_networks as $key => $value) {
	$array_social_networks[sanitize_title($value)] = $value;
}

$this->sections[] = array(
	'icon' => 'fa fa-thumbs-o-up',
	'title' => __('Social Networks', 'redux-framework'),
	'desc' => __('Set Your social Networks Settings', 'redux-framework'),
	'fields' => array(
		array(
			'id'=>'twitter_info_warning',
			'title' => '',
			'type' => 'info',
			'notice' => true,
			'style' => 'info',
			'desc' => __( '<b>Twitter OAuth settings.</b><br>You need to have a twitter App for your usage in order to obtain OAuth credentials, see <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a> for help.<br>After creating your app, fill this with your OAuth credentials.', 'redux-framework')
			),
		array(
			'id'=>'twitter_username',
			'type' => 'text',
			'title' => __('Twitter Username', 'redux-framework'),
			'subtitle' => __('It will be used to show twitter feeds.', 'redux-framework'),
			'desc' => '',
			'default' => 'Pixelthrone'
			),
		array(
			'id'=>'twitter_consumer_key',
			'type' => 'text',
			'title' => __('Twitter Consumer key', 'redux-framework'),
			'subtitle' => __('Enter your Twitter Consumer key.', 'redux-framework'),
			'desc' => '',
			'default' => '0VSSntqiTUbaY1uxz1g'
			),
		array(
			'id'=>'twitter_consumer_secret',
			'type' => 'text',
			'title' => __('Twitter Consumer Secret', 'redux-framework'),
			'subtitle' => __('Enter your Twitter Consumer secret.', 'redux-framework'),
			'desc' => '',
			'default' => 'h5StyJlu5cEO0w6VsrgbiyYKFk4xyWIO6hgF2kSQ'
			),
		array(
			'id'=>'twitter_user_token',
			'type' => 'text',
			'title' => __('Twitter Access token', 'redux-framework'),
			'subtitle' => __('Enter your Twitter Access token.', 'redux-framework'),
			'desc' => '',
			'default' => '17925886-iR2pgDVCDE4JBDwgIGDIGbh2CdKuMNRoN8WlCM2o0'
			),
		array(
			'id'=>'twitter_user_secret',
			'type' => 'text',
			'title' => __('Twitter Access token secret', 'redux-framework'),
			'subtitle' => __('Enter your Twitter Access token secret.', 'redux-framework'),
			'desc' => '',
			'default' => '6U7uR4Wb3rfoX64WSq7u9Hsug6bpaE33CdZS2LFAbac'
			),
		array(
			'id'=>'twitter_count',
			'type' => 'text',
			'title' => __('Number of tweets', 'redux-framework'),
			'subtitle' => __('Number of tweets to display.', 'redux-framework'),
			'desc' => 'Number of tweets to display',
			'validate' => 'numeric',
			'default' => '3'
			),
		// array(
		// 	'id' => 'social_networks',
		// 	'type' => 'sortable_label',
		// 	'mode' => 'label', 
		// 	'title' => __('Social Networks', 'redux-framework'),
		// 	'sub_desc' => __('Define and reorder these however you want.', 'redux-framework'),
		// 	'desc' => '',
		// 	'options' => $pt_array_social_networks,
		// 	'label' => $pt_array_social_networks_label,
		// 	),
		)
);


/* GOOGLE MAPS */


$this->sections[] = array(
	'icon' => 'fa fa-map-marker',
	'title' => __('Google Maps Settings', 'redux-framework'),
	'desc' => __('<p class="description">Set Google Maps Options</p>', 'redux-framework'),
	'fields' => array(
		array(
			'id'=>'google_maps_landscape_color',
			'type' => 'color',
			'title' => __('Landscape color', 'redux-framework'), 
			'subtitle' => __('Pick a color for the Landscape (default: #ffffff).', 'redux-framework'),
			'default' => '#ffffff',
			'transparent' => false,
			'validate' => 'color',
			),
		array(
			'id'=>'google_maps_water_color',
			'type' => 'color',
			'title' => __('Water color', 'redux-framework'), 
			'subtitle' => __('Pick a color for the water (default: #eefdff).', 'redux-framework'),
			'default' => '#eefdff',
			'transparent' => false,
			'validate' => 'color',
			),
		array(
			'id'=>'google_maps_roads_color',
			'type' => 'color',
			'title' => __('Roads color', 'redux-framework'), 
			'subtitle' => __('Pick a color for the roads (default: #00e5ff).', 'redux-framework'),
			'default' => '#00e5ff',
			'transparent' => false,
			'validate' => 'color',
			),
		array(
			'id'=>'google_maps_zoom',
			'type' => 'spinner', 
			'title' => __('Zoom Level', 'redux-framework'),
			'desc'=> __('Zoom Level 0-20', 'redux-framework'),
			"default" 	=> "12",
			"min" 		=> "0",
			"step"		=> "1",
			"max" 		=> "20",
			),
		array(
			'id'=>'google_maps_marker',
			'type' => 'media', 
			'url'=> false,
			'title' => __('Google Maps Marker', 'redux-framework'),
			'subtitle'=> __('Upload an image to use as marker in google maps.', 'redux-framework'),
			),
		array(
			'id'=>'google_maps_point_1',
			'type' => 'google_maps_point',
			'title' => __('Point 1', 'redux-framework'),
			'subtitle' => __('Enter a valid format. ie. 38.729983 / -9.139652', 'redux-framework'),
			),
		array(
			'id'=>'google_maps_point_2',
			'type' => 'google_maps_point',
			'title' => __('Point 2', 'redux-framework'),
			'subtitle' => __('Enter a valid format. ie. 38.729983 / -9.139652', 'redux-framework'),
			),
		array(
			'id'=>'google_maps_point_3',
			'type' => 'google_maps_point',
			'title' => __('Point 3', 'redux-framework'),
			'subtitle' => __('Enter a valid format. ie. 38.729983 / -9.139652', 'redux-framework'),
			),
		array(
			'id'=>'google_maps_point_4',
			'type' => 'google_maps_point',
			'title' => __('Point 4', 'redux-framework'),
			'subtitle' => __('Enter a valid format. ie. 38.729983 / -9.139652', 'redux-framework'),
			),
		),
);


/* NEWSLETTER */


$emails_newsletter_s = '';

if ( get_option( 'pt_email_newsletter' ) )
{
	$emails_newsletter = get_option( 'pt_email_newsletter' );

	foreach ($emails_newsletter as $row)
	{
		if (is_array($row)) {
			if(filter_var($row['email'], FILTER_VALIDATE_EMAIL)){
				if(!empty($row['name'])) {
					$emails_newsletter_s .= $row['name'] . " | ". $row['email'] ."<br>";
				} else {
					$emails_newsletter_s .= $row['email']."<br>";
				}
			} 
		 } else {
		 		$emails_newsletter_s .= $row ."<br>";
		 } 
	}
}


if ( empty($emails_newsletter_s) ) {
	$emails_newsletter_s = '<i>no newsletter subscribers</i>';
}

$this->sections[] = array(
	'icon' => 'fa fa-envelope',
	'title' => __('Newsletter', 'redux-framework'),
	'desc' => __('<p class="description">These are your newsletter subscribers</p>', 'redux-framework'),
	'fields' => array(
		array(
			'id' => 'pt_email_newsletter',
			'type' => 'info',
			'notice' => true,
			'desc' => $emails_newsletter_s
			),
		array(
			'id'=>'mailchimp_enable',
			'type' => 'switch', 
			'title' => __('Enable MailChimp', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),	
		array(
			'id'=>'mailchimp_api_key',
			'type' => 'text',
			'required' => array('mailchimp_enable','equals','1'),
			'title' => __('API Key', 'redux-framework'), 
			'subtitle' => __('This requires that you have an account with MailChimp.<br><a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key/" target="_blank">Where can I find my api key?</a>.', 'redux-framework'),
			'default' => '',
			),
		array(
			'id'=>'mailchimp_list_id',
			'type' => 'text',
			'required' => array('mailchimp_enable','equals','1'),	
			'title' => __('List ID', 'redux-framework'), 
			'subtitle' => __('<a href="http://kb.mailchimp.com/article/how-can-i-find-my-list-id/" target="_blank">How can I find my List ID?</a>', 'redux-framework'),
			'default' => '',
			),
		),
);



/* VISUAL COMPOSER */


$this->sections[] = array(
	'icon' => 'el-icon-website',
	'title' => __('Visual Composer', 'redux-framework'),
	'desc' => __('<p class="description">This Visual Composer shortcodes are disabled in this theme, for compatibility reasons you can enable them.</p>', 'redux-framework'),
	'fields' => array(
		array(
			'id'=>'vc_gallery',
			'type' => 'switch', 
			'title' => __('Gallery', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),	
		array(
			'id'=>'vc_single_image',
			'type' => 'switch', 
			'title' => __('Single Image', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),	
		array(
			'id'=>'vc_button',
			'type' => 'switch', 
			'title' => __('Button', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_column_text',
			'type' => 'switch', 
			'title' => __('Column Text', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_gmaps',
			'type' => 'switch', 
			'title' => __('Gmaps', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_progress_bar',
			'type' => 'switch', 
			'title' => __('Progress Bar', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_rss',
			'type' => 'switch', 
			'title' => __('Rss', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_archives',
			'type' => 'switch', 
			'title' => __('WP Archives', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_search',
			'type' => 'switch', 
			'title' => __('WP Search', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_meta',
			'type' => 'switch', 
			'title' => __('WP Meta', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_recentcomments',
			'type' => 'switch', 
			'title' => __('WP Recentcomments', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_calendar',
			'type' => 'switch', 
			'title' => __('WP Calendar', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_pages',
			'type' => 'switch', 
			'title' => __('WP Pages', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_tagcloud',
			'type' => 'switch', 
			'title' => __('WP Tagcloud', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_custommenu',
			'type' => 'switch', 
			'title' => __('WP Custommenu', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_text',
			'type' => 'switch', 
			'title' => __('WP Text', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_posts',
			'type' => 'switch', 
			'title' => __('WP Posts', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_links',
			'type' => 'switch', 
			'title' => __('WP Links', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_wp_categories',
			'type' => 'switch', 
			'title' => __('WP Categories', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_pie',
			'type' => 'switch', 
			'title' => __('Pie', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_flickr',
			'type' => 'switch', 
			'title' => __('Flickr', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_widget_sidebar',
			'type' => 'switch', 
			'title' => __('Widget Sidebar', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_posts_slider',
			'type' => 'switch', 
			'title' => __('Posts Slider', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_teaser_grid',
			'type' => 'switch', 
			'title' => __('Teaser Grid', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_text_separator',
			'type' => 'switch', 
			'title' => __('Text Separator', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_separator',
			'type' => 'switch', 
			'title' => __('Separator', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_pinterest',
			'type' => 'switch', 
			'title' => __('Pinterest', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_cta_button',
			'type' => 'switch', 
			'title' => __('Call to action Button', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_images_carousel',
			'type' => 'switch', 
			'title' => __('Images Carousel Gallery', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_carousel',
			'type' => 'switch', 
			'title' => __('Post Carousel ', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_posts_grid',
			'type' => 'switch', 
			'title' => __('Post Carousel ', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		array(
			'id'=>'vc_message',
			'type' => 'switch', 
			'title' => __('Message Box', 'redux-framework'),
			'subtitle'=> '',
			"default" => 0,
			'on' => 'Enabled',
			'off' => 'Disabled',
			),
		),
);



/* TRANSLATION */


$this->sections[] = array(
	'icon' => 'el-icon-flag',
	'title' => __('Translation', 'redux-framework'),
	'desc' => __('<p class="description">Easily get your site translated.</p>', 'redux-framework'),
	'fields' => array(
		array(
			'id'=>'translate_info_1',
			'type' => 'info',
			'notice' => true,
			'style' => 'info',
			'desc' => '<p>This theme makes use of <a target="_blank" href="http://codex.wordpress.org/Translating_WordPress">PO/MO files</a> to manage translations.</p>
						<p>We recomend the plugin <a target="_blank" href="http://wordpress.org/plugins/codestyling-localization/">Codestyling Localization</a> to make the process easy.</p>
						<p>You can manage and edit all gettext translation files (*.po/*.mo) directly out of WordPress Admin Center without any need of an external editor.</p>
						<p>We ship the theme with English and Portuguese files. You may want to add your language. After creating it (refer to the plugin documenttion in order to learn how to create a new language), you need to set the locale in the <code>wp_config.php</code> file.</p>',
			),
		array(
			'id'=>'translate_info_2',
			'type' => 'info',
			'notice' => true,
			'style' => 'info',
			'desc' => '<p>If you want your site with multilingual support, we recommend the <a target="_blank" href="http://wpml.org/?aid=39548&amp;affiliate_key=tQDCtpvozoJ0">WPML plugin</a>.
						<br>Our theme is WPML ready and optimized.</p>',
			),
		),
);



/* IMPORT */


$this->sections[] = array(
	'icon' => 'fa fa-cloud-download',
	'title' => __('Import Demo Content', 'redux-framework'),
	//'desc' => __('<p class="description"></p>', 'redux-framework'),
	'fields' => array(
	
		array(
			'id'=>'import_template_legend',
			'type' => 'info',
			'notice' => true,
			'style' => 'info',
			'desc' => '<h3 style="margin-top: -14px;">Important Notes:</h3>
						— We Recommend to run this importer on a clean WordPress Installation.<br>
						— To reset you installation we can recommend this plugin — <a target="_blank" href="http://wordpress.org/plugins/wordpress-reset/">WordPress Database Reset.</a><br>
						— The Demo importer will import the images pixelated, due to copyright/License reasons.<br>
						— Do not run the importer multiple times one after another, it will result in double content.<br>
						',
			),
		array(
			'id'=>'import_template',
			'type' => 'image_select',
			'title' => __('<h3>Select Template to import</h3>', 'redux-framework'), 
			'subtitle' => 'Click to import',
			'desc' => '',
			'options' => array(
				//Must provide key => value(array:title|img) pairs for radio options
				'alma_v1.xml' => array( 'title' => 'Demo V1', 'img' => PLUGIN_URL . 'assets/img/template_1.png' )
				),
			'default' => '0'
			),
		array(
			'id'=>'import_template_loading',
			'type' => 'info',
			'notice' => true,
			'style' => 'warning',
			'desc' => '<div class="loading_block" style="display: none;"><img src="'.get_site_url().'/wp-admin/images/wpspin_light.gif" /> '. __("Loading, please wait...", "framework_localize") .'</div><div class="container_data"></div>'
			),
		// array(
		// 	'id'=>'import_revslider',
		// 	'type' => 'image_select',
		// 	'title' => __('<h3>Select Slider to Download</h3>', 'redux-framework'), 
		// 	'subtitle' => 'Click to download',
		// 	'desc' => '',
		// 	'options' => array(
		// 		//Must provide key => value(array:title|img) pairs for radio options
		// 		PLUGIN_URL . 'dummy_content/revolution_sliders/V1_Home.zip' => array('title' => 'Demo V1', 'img' => PLUGIN_URL . 'assets/img/revslider.png'),
		// 		),
		// 	'default' => '0'
		// 	),
		// array(
		// 	'id'=>'theme_options_link',
		// 	'title' => __('<h3>Theme Options URL</h3>', 'redux-framework'),
		// 	'type' => 'info',
		// 	'notice' => true,
		// 	'style' => 'success',
		// 	'desc' => '<p><b>Template V1</b><br>http://alma.pixelthrone.it/export/v1.json</p>',
		// 	),
		),
);