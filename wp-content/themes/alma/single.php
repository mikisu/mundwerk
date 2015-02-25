<?php
get_header();

$blog_page_id = get_option('page_for_posts');

$page_options = pt_get_page_options($blog_page_id);

echo '<div class="pages-holder">';
	echo '<section id="' . $page_options['post_name'] . '" class="blog single ' . $page_options['class'] . '" style="' . $page_options['style'] . '">';

	echo '<div class="'. $page_options['pattern_class'] .'" style="' . $page_options['pattern_style'] . '"></div>';

	if ( isset($page_options['raw']['has_shadow']) && $page_options['raw']['has_shadow'] ) {
		echo '<div class="section-shadow"></div>';
	}
		
	echo '<div class="content" style="' . $page_options['content_style'] . '">';
	echo '<div class="container">';

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

		//echo $page_options['page_content'];


	if (have_posts()) :

		echo '<div class="row">';

		if ( (isset($page_options['raw']['show_sidebar']) && $page_options['raw']['show_sidebar']) ) {
			echo '<aside class="col-md-8 posts">';
			$image_size = 'post-thumb-2';
		} else {
			echo '<aside class="col-md-12 posts">';
			$image_size = 'post-thumb-1-full';
		}

		while (have_posts()) : the_post();

			$post_id = get_the_ID();
		?>
			<div class="row singleTitle-row">
				<div class="col-md-2 pt_comments">
					<div class="comments_number">
						<?php echo get_comments_number()?>
					</div>
				</div>

				<div class="col-md-10 entry-title">
					<h1 id="post-<?php the_ID(); ?>">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
				</div>
			</div>

			<?php
				$images_slideshow = get_field('images');


				//echo var_dump($images_slideshow);
				//echo var_dump(get_post_meta(get_the_ID(), 'pt_post_video', TRUE));

				if ($images_slideshow != "" or get_post_meta(get_the_ID(), 'pt_post_video', TRUE) != "") {

						echo '<div class="row">';
						echo '<div class="col-md-12">';

						if ($images_slideshow)
						{
							echo '<div class="pt-carousel">';
							foreach ($images_slideshow as $row)
							{
								echo '<img src="' . $row['sizes'][$image_size] . '">';
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
									echo wp_oembed_get($featured_video );
									echo '</figure>';
								}
							}
						}

						echo '</div>';
						echo '</div>';

				}
			?>

			<div class="row post-info">
				<div class="col-md-offset-1 col-md-4">
					<i class="ion-ios7-clock-outline"></i>
					<div class="entry-date"><?php _e('Posted on', 'pt_framework');?> <span class="month"><?php echo get_the_date('F d, Y'). '</span>'; ?> </div>
				</div>
				
				<?php if ( get_the_tags() ) { ?>

				<div class="col-md-7">
					<i class="ion-ios7-pricetag-outline"></i>
					<?php
					the_tags('<ul class="the_tags list-inline list-unstyled"><li>','</li><li>','</li></ul>');
					?>
				</div>

				<?php } ?>

			</div>

			<div class="row">
				<div class="entry col-md-12">
					<?php the_content( ); ?>
					<?php wp_link_pages( ); ?> 
				</div>
			</div>

			<?php if ( get_the_category() ) { ?>

				<div class="row">
					<div class="col-md-12">
						<div class="the_category">
							<small>
								<strong><?php _e('Categories:', 'pt_pixelthrone');?></strong>
								<?php the_category(', '); ?>
							</small>
						</div>
					</div>
				</div>
			<?php } ?>

			<hr>

			<div class="row autor-wrapper">
				<div class="col-md-1">
					<div class="author-posts pt_view_all_bt">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<i class="ion-ios7-copy-outline"></i>
							<p class="semi-bold inline-block italic"><?php printf( __( 'View all<br>%d posts', 'pt_framework' ), get_the_author_posts() ); ?></p>
						</a>
					</div>
				</div>

				<div class="col-md-2 text-right autor-avatar-wrapper">
					<figure class="autor-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?></figure>
				</div>

				<div class="col-md-9 pt_autor_descri">
					<div class="author-meta">
						<h3><?php echo get_the_author_meta( 'display_name' ); ?></h3>
						<p><?php echo get_the_author_meta( 'description' ) ; ?></p>
					</div>
				</div>
			</div>

			<hr class="solid">
		
			<?php if ( isset($page_options['raw']['show_sidebar']) && $page_options['raw']['show_sidebar'] ) {
				echo '<section class="comments sidebar">';
			} else {
				echo '<section class="comments">';
			}
			?>
			<section class="comments">
				<?php 
				if ( isset($page_options['raw']['bg_color']) ) { ?>
					<style>.comment-reply-link{background-color: <?php echo $page_options['raw']['bg_color'];?>;}</style>
				<?php }?>
				<?php
					if ( comments_open() || '0' != get_comments_number() ) {
						$show_sidebar = true;
						comments_template( '', true ); 
					}
				?>	
			</section>

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

	<?php
	/* Sidebar */
		if ( (isset($page_options['raw']['show_sidebar']) && $page_options['raw']['show_sidebar']) ) {
			echo '<aside class="col-md-offset-1 col-md-3 sidebar visible-desktop">';
			if (function_exists('dynamic_sidebar'))
			{
				dynamic_sidebar('Blog Sidebar');
			}
			echo '</aside>';
		}
 	?>

 	<?php else: ?>

		<h2 class="text-center"><?php _e('Not Found', 'pt_framework');?></h2>
		<p class="text-center"><?php _e("It seems we can't find what you're looking for...", 'pt_framework'); ?></p>

	<?php endif;

		echo '</div>'; 
	echo '</div>';
	

	if ( $previous_post = get_previous_post() ) {

		$previous_post_link = '
		<div class="previous_post_link" >
			<div class="container-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<small class="smaller semi-bold op30"><em>'. __( 'read previous', 'pt_framework' ) . '</em></small>
						<h2 class="bold">%link</h2>
						<small class="smaller semi-bold op50 previous_post_date"><em>'. get_the_time( 'M d, Y @ g:i a', $previous_post->id )   .'</em></small>';'
					</div>
					</div>
				</div>
			</div>
		</div>';

		previous_post_link( $previous_post_link );
	}


echo '</div>'; 
echo '</section>';
echo '</div>';

get_footer();