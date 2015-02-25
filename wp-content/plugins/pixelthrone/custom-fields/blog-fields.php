<?php
add_action('admin_init', 'pt_post_settings');
add_action('save_post', 'pt_save_post');

function pt_post_settings()
{
	add_meta_box('pt_post_settings_metabox', 'Featured Video', 'pt_post_settings_metabox', 'post', 'side');
}

function pt_post_settings_metabox( $object, $box )
{

	$html = '
	<div style="margin:10px 0px;" class="form-block clearfix">
		<input type="text" style="width:100%; margin-bottom:5px;" value="' . get_post_meta($object->ID, 'pt_post_video', TRUE) . '" name="pt_post_video" id="pt_post_video" class="" placeholder="Youtube or Vimeo URL">
	</div>
	';
	
	echo $html;

	if ( get_post_meta($object->ID, 'pt_post_video', TRUE) ) {

		$video_url = get_post_meta($object->ID, 'pt_post_video', TRUE);

		if ( $th = pt_video_thumbs( $video_url ) ) {
			echo '<img src="'. $th .'" style="width:100%">';
		}
	}
}

function pt_save_post($post_id) {
	
	//check autosave
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)	
	{
		return $post_id;
	}
	
	//check permissions
	if(isset($_POST['post_type']) && $_POST['post_type'] == 'post')
	{
		if(!current_user_can('edit_post', $post_id))
		{
			return $post_id;
		}
	}
	else
	{
		if (!current_user_can('edit_post', $post_id))
		{
			return $post_id;
		}
	} 
	
	//Process fields
	foreach ($_POST as $key => $value)
	{
		
		if (substr($key,0,3) == 'pt_') 
		{
			update_post_meta( $post_id, $key, $value );
		
		}
	}
}


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_post-options',
		'title' => 'Post Options',
		'fields' => array (
			array (
				'key' => 'field_525826598c344',
				'label' => 'Images',
				'name' => 'images',
				'type' => 'gallery',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
