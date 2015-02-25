<?php
if ( pt_is_ajax_request() ) {
	echo '<div class="portfolio-ajax">';
}
else {
	get_header();

	echo '<div class="pages-holder">';
}

if ( have_posts() ) :
	while ( have_posts() ) : the_post();

		if ( $portfolio_page = pt_get_page_by_template('template-portfolio.php') )
		{
			$portfolio_options = pt_get_page_options($portfolio_page[0]->ID);
		}

		$page = pt_get_page_options( get_the_id() );

		$style = $style_header = '';

		if ( isset($page['raw']) ) {
			$style = 'style="background-color: '. $page['raw']['folio_bg_color'] .'; color: '. $page['raw']['folio_text_color'] .';"';
			$style_header = 'style="background-color: '. $page['raw']['folio_header_bg_color'] .'; color: '. $page['raw']['folio_header_text_color'] .';"';
		}

		echo '<section id="' . $page['post_name'] . '" class="portfolio-detail ' . $page['class'] . '" '. $style . '>';
			echo '<div class="content" >';

				if ( pt_is_ajax_request() ) {				
					echo '<div class="portfolio-header" '. $style_header . '>';
					echo '<h1>'. get_the_title( ) .'</h1>';

					echo '</div>';
				}
				else {
					echo '<div class="container master-container" role="main">';

					if ( $portfolio_options['page_title'] )
					{
						if ( $portfolio_options['raw']['page_title'] == "style_2" )
						{
							echo '<style type="text/css">';
							echo  '#'. $portfolio_options['post_name'] . ' h1.page-title.style_2:after { top: ' . (130 + $portfolio_options['raw']['margin_top']) . 'px; }' ;
							echo '</style>';
						}

						echo '<h1 class="page-title '. $portfolio_options['raw']['page_title'] .'">'. get_the_title( ) .'</h1>'; //$portfolio_options['page_title']
					}

					echo '</div>';
				}

				echo '<div class="container">';
					the_content( );
				echo '</div>';
				
			echo '</div>';

		echo '</section>';

	endwhile;

else: _e( "It seems we can't find what you're looking for...", 'pt_framework' );
endif;

if ( pt_is_ajax_request() ) {
	echo '</div>';
}
else {
	echo '</div>';
	get_footer();
}
