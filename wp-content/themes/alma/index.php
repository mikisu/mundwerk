<?php

get_header();

$blog_page_id = get_option('page_for_posts');


if ( !$blog_page_id ) {

	$blog_page = pt_get_page_by_template('template-blog.php');
	if ($blog_page) {
		$blog_page_id = $blog_page[0]->ID;
	}

}

$page_options = pt_get_page_options($blog_page_id);


$blog_categories = '';
if ( isset($page_options['raw']['blog_categories']) && $page_options['raw']['blog_categories'] )
{
	$blog_categories = implode(",", $page_options['raw']['blog_categories']);
}


if ( is_home() ) {
	query_posts($query_string . '&orderby=date&order=desc&cat='.$blog_categories);
}
else {
	query_posts($query_string . '&orderby=date&order=desc');
}


echo '<div class="pages-holder">';
	echo '<section id="' . $page_options['post_name'] . '" class="blog ' . $page_options['class'] . '" style="' . $page_options['style'] . '">';

		if ( $page_options['pattern_class'] && $page_options['pattern_style'] ) {
			echo '<div class="fsd '. $page_options['pattern_class'] .'" style="' . $page_options['pattern_style'] . '"></div>';
		}

		if ( isset($page_options['raw']['has_shadow']) && $page_options['raw']['has_shadow'] ) {
			echo '<div class="section-shadow"></div>';
		}
			
		echo '<div class="content" style="' . $page_options['content_style'] . '">';
		echo '<div class="container">';


		if ( $blog_page_id )
		{
			$title_type	= "style_1";
			if ( isset($page_options['raw']['page_title']) ) {
				$title_type = $page_options['raw']['page_title'];
			}

			if ( $page_options['page_title'] )
			{
				if ( $title_type == "style_1" ) {
					echo '<h1 class="page-title '. $title_type .'"><span>'. $page_options['page_title'] .'</span></h1>';	
				}
			}else{
				echo '<div class="page-content"></div>';
			}

			echo $page_options['page_content'];
		}


if ( have_posts() ) :

	echo '<div class="row blog_1_row">';

	if ( isset($page_options['raw']['show_sidebar']) && $page_options['raw']['show_sidebar'] ) {
		echo '<aside class="col-md-8 posts">';
		$image_size = 'post-thumb-2';
	} else {
		echo '<aside class="col-md-12 posts">';
		$image_size = 'post-thumb-1-full';
	}

	while ( have_posts() ) :

		the_post();

		$post_id = get_the_ID();
	?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="position: relative">

			<div class="row row-title">
				<div class="col-md-offset-1 col-md-11">
					<div class="entry-date text-right"><span class="month"><?php echo get_the_date('M d,'). '</span><span class="year">'. get_the_date('Y') .'</span>'; ?> </div>

					<div class="entry-title">
						<h1 id="post-<?php the_ID(); ?>" class="entry-title onList">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
						</h1>
					</div>
				</div>
			</div>


			<?php
			echo '<div class="row">';
			echo '<div class="col-md-12">';

			$images_slideshow = get_field('images');

			if ($images_slideshow)
			{
				echo '<div class="pt-carousel">';
				foreach ($images_slideshow as $row)
				{
					echo '<img src="'. $row['sizes'][$image_size] .'">';
				}
				echo '</div>';
			}
			else {

				if ( has_post_thumbnail()) {
					echo '<figure class="post-thumbnail">';
					the_post_thumbnail( $image_size );
					echo '</figure>';
				} else {
					if ( $featured_video = get_post_meta(get_the_ID(), 'pt_post_video', TRUE) ) {
						echo '<figure class="post-thumbnail videoWrapper">';
						echo wp_oembed_get($featured_video, array('width'=>'')); 
						echo '</figure>';
					}
				}
			}
			echo '</div>';
			echo '</div>';
			?>

			<div class="row">
				<div class="entry col-md-offset-1 col-md-11">
					<?php the_excerpt(); ?>
				</div>
			</div>


			<div class="row post-info">

				<?php if (get_comments_number() != 0) { ?>
				<div class="col-md-1">
					<div class="comments_number">
						<?php echo get_comments_number()?>
					</div>
				</div>

				<div class="col-md-5">
					<?php
						if ( $post_comments = get_comments( array('post_id' => $post_id) ) ) {
							for ($i=0; $i < 3 ; $i++) { 
								if ( isset($post_comments[$i]) ) {
									echo '<a href="'.get_permalink().'#comment-'.$post_comments[$i]->comment_ID.'">';
									echo get_avatar( $post_comments[$i]->comment_author_email, 32 );
									echo '</a>';
								}
							}

							echo '<p class="text-join">'. __('Join the<br>discussion', 'pt_framework') .'</p>';
						}
					?>
				</div>
				<?php } ?>

				<div class="col-md-4 time-to-read <?php if (get_comments_number() == 0) { echo 'semComments'; } ?>">
					<i class="ion-ios7-information-outline"></i>
					<p class="timetoread inline-block bold italic"><?php echo pt_estimate_reading_time($post_id); ?></p>
				</div>

			</div>

			<hr>

		</article>
	
		<?php endwhile; ?>


		<?php
		/* Pagination */
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

		<?php if ($paginate_links) : ?>

			<div class="row">
				<div class="col-md-12 text-center">
					<div class="pagination">
					<?php echo $paginate_links;	?>
					</div>
				</div>
			</div>

		<?php endif; ?>

	</aside>

	<?php

		/* Sidebar */
		if ( isset($page_options['raw']['show_sidebar']) && $page_options['raw']['show_sidebar'] ) :
			echo '<aside class="col-md-offset-1 col-md-3 sidebar visible-desktop">';
			if (function_exists('dynamic_sidebar'))
			{
				dynamic_sidebar('Blog Sidebar');
			}
			echo '</aside>';
		endif;
 	?>

<?php else : ?>

	<h2 class="text-center"><?php _e('Not Found', 'pt_framework');?></h2>
	<p class="text-center"><?php _e("It seems we can't find what you're looking for...", 'pt_framework'); ?></p>

<?php  endif;

		echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</section>';
echo '</div>';

get_footer();