
		<?php
		if ( !defined('TEMPLATE_BLANK') ) {
			include('template-footer.php'); 
		}
		?>

		<?php if ( pt_get_theme_option('tracking-code') ) { ?>
			<?php echo pt_get_theme_option('tracking-code');?>
		<?php } ?>

		<?php
		if ( pt_get_theme_option('custom-js') )
		{
			echo '<script>';
			echo "/* Custom Javascript */\n\n";
			echo stripslashes_deep( pt_get_theme_option('custom-js') );
			echo "\n\n/* Custom Javascript */";
			echo '</script>';
		}
		?>

		<div class="lightwindow">
			<a class="close" href="#" data-return=""><i class="fa fa-times-circle"></i></a>
			<div class="lightwindow-content"></div>
		</div>

		<!-- Begin Share -->
		<div class="lightwindow-share">
			<div class="lightwindow-content">

				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h2 class="text-center">share on</h2>

							<ul class="list-unstyled list-inline text-center share">
								<li class="animated fast delay4 fadeInDown"><a href="https://www.facebook.com/share.php?u=<?php echo home_url('/'); ?>" class="fa fa-facebook" target="_blank"></a></li>
								<li class="animated fast delay6 fadeInDown"><a href="https://twitter.com/share" class="fa fa-twitter" target="_blank"></a></li>
								<li class="animated fast delay8 fadeInDown"><a href="https://plus.google.com/share?url=<?php echo home_url('/'); ?>" class="fa fa-google-plus" target="_blank"></a></li>
								<li class="animated fast delay10 fadeInDown"><a href="#" onclick="pinterest()" class="fa fa-pinterest"></a></li>
								<li class="animated fast delay12 fadeInDown"><a href="http://www.tumblr.com/share" class="fa fa-tumblr" target="_blank"></a></li>
							</ul>

							<div class="text-center"><a class="close" href="#" data-action="close-lightwindow">&times;</a></div>

						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- End Share -->

		<?php 
		if ( !defined('TEMPLATE_BLANK') ) {
			echo '<a href="#" class="scroll-top hidden-phone"><i class="ion-arrow-up-c"></i></a>';
		}
		?>

		<div class="site-nav-overlay"></div>

		<?php wp_footer(); ?>
	</body>
</html>