<?php
/**
Page for one page Layouts
**/

get_header();

$pages = get_pages(array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order'
));


global $post;

if ($pages)
{
	$pages_list = $pages;
	$direct_access = FALSE;
	$page_html = '';

	//$footer_page = pt_get_page_by_template('template-footer.php');
	$portfolio_page = pt_get_page_by_template('template-portfolio.php');

	if (!is_front_page())
	{
		if ( have_posts() ) : 
			$direct_access = TRUE;
			$page_key = pt_get_key_by_value($pages, 'ID', get_the_id());
			if ( $page_key ) :
				$pages_list = array($pages[$page_key]);
			else :
				$pages_list = array();
				$pages_list[] = $post;
			endif;

		else: 
			_e("It seems we can't find what you're looking for...", 'pt_framework');
		endif;
	}



	echo '<div class="pages-holder">';

	foreach ($pages_list as $page_data)
	{

		$page = pt_get_page_options($page_data->ID);

		if ( isset($page['show_page']) ) {
			$show_page = $page['show_page'];
		}
		else {
			$show_page = TRUE;
		}

		if ( ($direct_access === FALSE && $show_page !== FALSE) || $direct_access === TRUE )
		{
		
			$has_bg_slider = (isset($page['raw']['bg_images']) && count($page['raw']['bg_images']) > 1 ? TRUE : FALSE);

			$classes = '';
			
			if ( isset($page['raw']) ) {
				$classes .= (($page['raw']['bg_type'] == 'image' && $has_bg_slider) ? ' has-bg-slider ' : '');
				$classes .= (($page['raw']['bg_type'] == 'video' && $page['raw']['video_file_mp4']) ? ' has-bg-video ' : '');
			}

			if ( $portfolio_page  )
			{
				foreach ($portfolio_page as $key => $value) {

					if ($page_data->ID === $portfolio_page[$key]->ID) {

						$is_include = TRUE;
						$portfolio_page_id = $portfolio_page[$key]->ID;

						include('template-portfolio.php');
					}
				}
			}


			$templates_denied = array('template-blank.php', 'template-footer.php', 'template-blog.php', 'template-portfolio.php');

			if (!in_array($page['template'], $templates_denied))
			{

				// if ( ($direct_access === FALSE && $show_page !== FALSE) || $direct_access === TRUE )
				// {

					echo '<section id="' . $page['post_name'] . '" class="' . $page['class'] . $classes . '" style="' . $page['style'] .'" ' . $page['attr'].'>';

					if (get_edit_post_link( $page_data->ID ))
					{
						echo '<a href="' . get_edit_post_link( $page_data->ID ) . '" class="QuickEdit" target="_blank"><i class="ion-edit"></i></a>';
					}

					echo '<div class="'. $page['pattern_class'] .'" style="' . $page['pattern_style'] . '"></div>';

					if ( isset($page['raw']['has_shadow']) && $page['raw']['has_shadow'] ) {
						echo '<div class="section-shadow"></div>';
					}

					if ( isset($page['raw']) && $page['raw']['bg_type'] == 'image' && $has_bg_slider)
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
						echo '<video id="video_' . $page['raw']['video_file_mp4']['id'] . '" class="video-bg" autoplay="autoplay" preload="auto" loop volume="'. (int)$page['raw']['video_volume'] .'" ' . ($page['raw']['video_img_fallback'] ? 'poster="' . $page['raw']['video_img_fallback']['url'] . '"' : '') . '>
						<source src="' . $page['raw']['video_file_mp4']['url'] . '" type="video/mp4">
						' . ($page['raw']['video_file_webm'] ? '<source src="' . $page['raw']['video_file_webm']['url'] . '" type="video/webm">' : '') . '
						</video>';
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
						}else
						{
							if ( $direct_access === TRUE )
								echo '<div class="direct-access"></div>';
						}

						echo $page['page_content'];

					echo '</div>'; 
					echo '</div>';

					echo '</section>';
				}
			//}

		}
	}

	echo '</div>';
}

get_footer();