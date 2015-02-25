<?php

get_header();

//$blog_page_id = get_option('page_for_posts');

$page_options = pt_get_page_options(-1);


echo '<div class="pages-holder">';
echo '<section id="' . $page_options['post_name'] . '" class="blog ' . $page_options['class'] . '" style="' . $page_options['style'] . '">';

echo '<div class="'. $page_options['pattern_class'] .'" style="' . $page_options['pattern_style'] . '"></div>';

if ( isset($page_options['raw']['has_shadow']) && $page_options['raw']['has_shadow'] ) {
	echo '<div class="section-shadow"></div>';
}
	
echo '<div class="content" style="' . $page_options['content_style'] . '">';
echo '<div class="container">';

if (have_posts()) :

	echo '<aside class="col-md-12 posts">';

		echo '<h1 class="pagetitle">'. __("Search Results for", "pt_framework") .' "'. $s .'"</h1>';

		while (have_posts()) : the_post();
	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="position: relative">

				<p class="large nomargin"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></p>
					<?php
					if ( function_exists('the_excerpt') && is_search() ) {
						the_excerpt();
					} 
					?>
				<hr>

			</article>
	
		<?php endwhile; ?>

		<?php
		/* Pagination */
		global $wp_query;
		$big = 999999999; // need an unlikely integer

		$paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_text' => '<i class="fa fa-long-arrow-left"></i>',
			'next_text' => '<i class="fa fa-long-arrow-right"></i>'
		) );

		?>

		<?php if ($paginate_links) { ?>
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="pagination">
					<?php echo $paginate_links;	?>
				</div>
			</div>
		</div>
		<?php } ?>

	</aside>

 	<?php else : ?>

	<h2 class="text-center" style="margin-top:100px;"><?php _e('Not Found', 'pt_framework');?></h2>
	<p class="text-center"><?php _e("It seems we can't find what you're looking for...", 'pt_framework'); ?></p>

<?php  endif;

		echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</section>';


get_footer();