<?php
/*
Template Name: Portfolio
*/

if ( isset($is_include) ) {
	$portfolio_page = pt_get_page_by_template('template-portfolio.php');

	if (isset($portfolio_page_id))
		$page_id = $portfolio_page_id;
	else {
		$page_id = $portfolio_page[0]->ID;
	}
} else {
	get_header();
	$page_id = get_the_id();

	echo '<div class="pages-holder">';
}


$page_options = pt_get_page_options($page_id);

$portfolio_categories = '';
if ( isset($page_options['raw']['portfolio_categories']) && $page_options['raw']['portfolio_categories'] )
{
	$portfolio_categories = implode(",", $page_options['raw']['portfolio_categories']);
}

$tax_query = '';
if ( $portfolio_categories ) {
	$tax_query = array(
		'taxonomy' => 'portfolio_category',
		'terms' => $page_options['raw']['portfolio_categories']
	);
}

$args = array(
	'post_type' => 'portfolio',
	'posts_per_page' => -1,
	'tax_query' => array( $tax_query)
	//'orderby' => 'date',
	//'order' => 'desc',
	//'paged' => (get_query_var('paged') ? get_query_var('paged') : 1),
);

$query = new WP_Query( $args );


if ( $query->have_posts() ) {

	$portfolio_total = $query->found_posts;

	/* Columns */
	$portfolio_columns = (int) (get_field('portfolio_columns', $page_id) ? get_field('portfolio_columns', $page_id) : 4);

	if ( $portfolio_columns < 1 ) {
		$portfolio_columns = 1;
	}

	if ( $portfolio_columns > 6 ) {
		$portfolio_columns = 6;
	}

	/* Rows */
	$portfolio_total_show = (int) (get_field('portfolio_rows', $page_id) ? get_field('portfolio_rows', $page_id) : 9999);
	$portfolio_total_show *= $portfolio_columns;


	if ( $portfolio_total > $portfolio_total_show ) {
		$pt_portfolio_js_settings['portfolio_total_show'] = (int)$portfolio_total_show;
		$pt_portfolio_js_settings['portfolio_total'] = (int)$portfolio_total;

		wp_localize_script( 'main', 'pt_portfolio', $pt_portfolio_js_settings );
	}


	$folio_rows = "col-" . $portfolio_columns;

	$title_type	= "style_1";
	$class_info = '';

	if ( isset($page_options['raw']['page_title']) ) {
		$title_type = $page_options['raw']['page_title'];
	}

	if ( isset($page_options['raw']['info_style']) ) {
		$info_style = $page_options['raw']['info_style'];

		$class_info = $info_style;
	}

	if ( isset($page_options['raw']['show_type']) ) {
		$show_type = $page_options['raw']['show_type'];

		if ( $info_style == 'style_2' ) {
			$class_info .= ' '. $show_type;
		}
	}
	
	if ( get_field('portfolio_bg_color', $page_id) ) {

		$bg_rgba = 'rgba('. pt_hex2rgb(get_field('portfolio_bg_color', $page_id)) .', 0.8)';

		echo '<style>';

		echo "section.portfolio-page ul.portfolio-items li .info h3, section.portfolio-page ul.portfolio-items li .info p { color: ". get_field('portfolio_text_color', $page_id) ."; }\n";

		if ( $info_style == 'style_2' ) {
			echo 'section.portfolio-page ul.portfolio-items li .info { 
				background: '. $bg_rgba .';
				background: -webkit-gradient(linear, left bottom, left top, color-stop(0, '. $bg_rgba .'), color-stop(1, transparent));
				background: -ms-linear-gradient(bottom, '. $bg_rgba .', transparent);
				background: -moz-linear-gradient(center bottom, '. $bg_rgba .' 0%, transparent 100%);
				background: -o-linear-gradient(transparent, '. $bg_rgba .');
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="transparent", endColorstr="'. $bg_rgba .'", GradientType=0);}';
		}
		else {
			echo 'section.portfolio-page ul.portfolio-items li .info { background: '. $bg_rgba .'; }';
		}

		echo '</style>';
	}
	

	echo '<section id="' . $page_options['post_name'] . '" class="portfolio-page ' . $page_options['class'] . '" style="' . $page_options['style'] . '" data-title="' . get_the_title() . '">';

		if (get_edit_post_link($page_id))
		{
			echo '<a href="' . get_edit_post_link( $page_id ) . '" class="QuickEdit" target="_blank"><i class="ion-edit"></i></a>';
		}

		echo '<div class="'. $page_options['pattern_class'] .'" style="' . $page_options['pattern_style'] . '"></div>';

		if ( isset($page_options['raw']['has_shadow']) && $page_options['raw']['has_shadow'] ) {
			echo '<div class="section-shadow"></div>';
		}

		echo '<div class="portfolio-content" style="' . $page_options['content_style'] . '">';

			echo '<div class="content">';

				echo '<div class="container master-container" role="main">';

					if ( $page_options['page_title'] )
					{
						if ( $title_type == "style_1" ) {
							echo '<h1 class="page-title '. $title_type .'"><span>'. $page_options['page_title'] .'</span></h1>';	
						}
					}

					echo $page_options['page_content'];

				echo '</div>'; 

				/* Categories filter */
				if ( isset($page_options['raw']['show_folio_categories']) && $page_options['raw']['show_folio_categories'] )
				{
					echo '<div class="wrapper-portfolio-categories">';

					echo '<a href="#" data-filter="*" class="portfolio-active-category"><i class="ion-social-buffer"></i><span>'. __('All Categories', 'pt_framework') .'</span></a>';

					echo '<ul class="portfolio-categories list-unstyled animated fast pt_CatAnimeOut">';
					echo '<li><a href="#" data-filter="*"><span>'. __('All Categories', 'pt_framework') .'</span></a></li>';

					$categories = get_categories('taxonomy=portfolio_category&type=portfolio&hide_empty=1&include='.$portfolio_categories);

					if ( !isset($categories['errors']) ) :
						foreach ($categories as $categorie)
						{
							echo '<li><a href="#" data-filter=".'. $categorie->slug .'"><span>'. $categorie->name .'</span></a></li>';
						}
					endif;

					echo '</ul>';

					echo '</div>';
				}


				echo '<ul class="list-unstyled portfolio-items" data-total-show="'. $portfolio_total_show .'">';

				$current_item = 0;

				while ( $query->have_posts() ) {

					$query->the_post();

					$post_id = get_the_ID();

					if ( has_post_thumbnail() ) :

						$categories = $categories_slug = '';

						$portfolio_category = get_the_terms( get_the_ID(), 'portfolio_category' );

						if ( $portfolio_category && !is_wp_error( $portfolio_category ) ) :
							foreach ($portfolio_category as $row) {
								$categories .= $row->name.', ';
								$categories_slug .= $row->slug.' ';
							}
						endif;

						$current_item++;

						$li_class = $class_info;
						if ( $current_item > $portfolio_total_show) {
							$li_class .= ' to-show hidden';
						}


						echo '<li class=" '. $folio_rows .' '. $categories_slug . ( (get_field('folio_portfolio_type', get_the_id())) ? get_field('folio_portfolio_type', get_the_id()) : 'pt_portfolio_1' ).' '. $li_class .'">';

								echo '<a href="'. get_permalink() .'" title="' . esc_html( get_the_title() ) . '" data-id="'. get_the_id() .'" class="figure">';

								if ( $portfolio_columns == 1 ) {
									the_post_thumbnail('full');
								}
								else{

									if ( get_field('fit_rows', $page_id) ) { 
										if ( $portfolio_columns < 3 ) {
											the_post_thumbnail('portfolio-thumb-large-fit');
										} else {
											the_post_thumbnail('portfolio-thumb-fit');
										}
									}
									else {
										if ( $portfolio_columns < 3 ) {
											the_post_thumbnail('portfolio-thumb-large');
										}
										else {
											the_post_thumbnail('portfolio-thumb');
										}
									}
								}

								echo '</a>';

								echo '<a href="'. get_permalink() .'" class="info '. $class_info .'">';
									echo '<h3>'. get_the_title( ) .'</h3>';
									echo '<p>'. rtrim( $categories, ', ' ) .'</p>';
								echo '</a>';

						echo '</li>';

					endif;
				} //endwhile

				echo '</ul>';

				//Load more
				if ( $portfolio_total > $portfolio_total_show ) {
					echo '<div class="load-portfolio">
						<a href="#">'. __('Load more', 'pt_framework') .'</a>
					</div>';
				}

			echo '</div>';

		echo '</div>';

	echo '</section>';

} else {

	echo '<h2 class="text-center">'. __('Not Found', 'pt_framework') .'</h2>';
	echo '<p class="text-center">'. __("It seems we can't find what you're looking for...", 'pt_framework') .'</p>';
}

if ( !isset($is_include) ) {
	echo '</div>';

	get_footer();
}