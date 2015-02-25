<?php 
/*
Template Name: Blank Page
*/

define('TEMPLATE_BLANK', TRUE);

get_header();

$page = pt_get_page_options(get_the_id());
$has_bg_slider = (isset($page['raw']['bg_images']) && count($page['raw']['bg_images']) > 1 ? TRUE : FALSE);

$classes = '';
$classes .= (($page['raw']['bg_type'] == 'image' && $has_bg_slider) ? ' has-bg-slider ' : '');
$classes .= (($page['raw']['bg_type'] == 'video' && $page['raw']['video_file_mp4']) ? ' has-bg-video ' : '');


echo '<div class="pages-holder">';
	echo '<section id="' . $page['post_name'] . '" class="' . $page['class'] . $classes . '" style="' . $page['style'] . '">';

		if (get_edit_post_link( get_the_id() ))
		{
			echo '<a href="' . get_edit_post_link( get_the_id() ) . '" class="QuickEdit" target="_blank"><i class="ion-edit"></i></a>';
		}

		echo '<div class="'. $page['pattern_class'] .'" style="' . $page['pattern_style'] . '"></div>';

		if ( isset($page['raw']['has_shadow']) && $page['raw']['has_shadow'] ) {
			echo '<div class="section-shadow"></div>';
		}
	
		if ($page['raw']['bg_type'] == 'image' && $has_bg_slider)
		{
			echo '<div class="slider-pt">';
			foreach ($page['raw']['bg_images'] as $row)
			{
				echo '<div class="pt-slider-cover slide" style="background-image: url(' . $row['url'] . ');"></div>';
			}
			echo '</div>';
		}

		if ( isset($page['raw']) && $page['raw']['bg_type'] == 'video' && $page['raw']['video_file_mp4'])
		{
			echo '<video id="video_' . $page['raw']['video_file_mp4']['id'] . '" class="video-bg" autoplay="autoplay" preload="auto" volume="'. (int)$page['raw']['video_volume'] .'" loop ' . ($page['raw']['video_img_fallback'] ? 'poster="' . $page['raw']['video_img_fallback']['url'] . '"' : '') . '>
				 	<source src="' . $page['raw']['video_file_mp4']['url'] . '" type="video/mp4">
				 	' . ($page['raw']['video_file_webm'] ? '<source src="' . $page['raw']['video_file_webm']['url'] . '" type="video/webm">' : '') . '
				</video>';
		}

		if (isset($page['raw']['revolution_slider']) && $rev_slider = $page['raw']['revolution_slider'])
		{
			echo '<div id="main-slideshow">';
			putRevSlider( $rev_slider );
			echo '</div>';
		}

		echo '<div class="content" style="' . $page['content_style'] . '">';

			echo '<div class="container master-container" role="main">';

				$title_type	= "style_1";
				if ( isset($page['raw']['page_title']) ) {
					$title_type = $page['raw']['page_title'];
				}

				if ( $page['page_title'] )
				{

					if ( $title_type == "style_1" ) {
						echo '<h1 class="page-title '. $title_type .'"><span>'. $page['page_title'] .'</span></h1>';	
					}
				}

				echo $page['page_content'];

			echo '</div>'; 
		echo '</div>';
	echo '</section>';

echo '</div>';

get_footer();
