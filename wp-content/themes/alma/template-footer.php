<?php 
/*
Template Name: Footer
*/

$footer_page = pt_get_page_by_template('template-footer.php');

if ($footer_page)
{
	$footer = $footer_page[0];
	$page = pt_get_page_options($footer_page[0]->ID);
	$footer_fixed = FALSE;

	if (isset($page['raw']['footer_fixed']) && $page['raw']['footer_fixed'] === TRUE)
	{
		$footer_fixed = TRUE;
		echo '<div class="footer-push"></div>';

	}
?>

	<footer class="<?php echo ($footer_fixed === TRUE ? 'fixed' : '');?>">
		
		<?php 

		echo '<section id="' . $page['post_name'] . '" class="' . $page['class'] . '" style="' . $page['style'] . '">';

			if (get_edit_post_link($footer_page[0]->ID))
			{
				echo '<a href="' . get_edit_post_link( $footer_page[0]->ID ) . '" class="QuickEdit" target="_blank"><i class="ion-edit"></i></a>';
			}

			echo '<div class="'. $page['pattern_class'] .'" style="' . $page['pattern_style'] . '"></div>';

			if ( isset($page['raw']['has_shadow']) && $page['raw']['has_shadow'] ) {
				echo '<div class="section-shadow"></div>';
			}

			echo '<div class="content" style="' . $page['content_style'] . '">';
				echo '<div class="container master-container" role="main">';

					echo $page['page_content'];
				
				echo '</div>'; 
			echo '</div>';
		echo '</section>';
		?>
		
	</footer>

<?php } ?>