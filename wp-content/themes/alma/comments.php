<?php
/*
Comments Form
*/

if( !function_exists('pt_framework_comments')) {

	function pt_framework_comments($comment, $args, $depth) {

		global $show_sidebar;

		$blog_page = (int) get_option('page_for_posts');
		$page_options = pt_get_page_options($blog_page);

		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'pt_framework' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'pt_framework' ), ' ' ); ?></p>
			<?php
			break;
			default :
			?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

				<div class="row">

					<?php if ( (isset($page_options['raw']['show_sidebar']) && $page_options['raw']['show_sidebar']) || $show_sidebar == true) { ?>
						<div class="col-md-2">
					<?php } else { ?>
						<div class="col-md-1">
					<?php } ?>

						<?php echo '<figure class="avatar">'. get_avatar( $comment, 50 ) .'</figure>'; ?>
						<?php comment_reply_link( array_merge( array('before' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text'=> '<i class="ion-chatbubble-working"></i>', 'login_text' => __('Log in to leave a comment','pt_framework')) ) ); ?>
					</div>

					<?php if ( (isset($page_options['raw']['show_sidebar']) && $page_options['raw']['show_sidebar']) || $show_sidebar == true) { ?>
						<div class="col-md-10">
					<?php } else { ?>
						<div class="col-md-11">
					<?php } ?>

						<h4 class="author"><?php printf( '%s', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>	</h4>
					</div>
				</div>

				<div class="row">

					<?php if ( (isset($page_options['raw']['show_sidebar']) && $page_options['raw']['show_sidebar']) || $show_sidebar == true) { ?>
						<div class="col-md-10 col-md-offset-2">
					<?php } else { ?>
						<div class="col-md-11 col-md-offset-1">
					<?php } ?>

						<?php if ( $comment->comment_approved == '0' ) : ?>
							<p><em><?php _e('Your comment is awaiting moderation.', 'pt_framework'); ?></em></p>
						<?php endif; ?>

						<?php comment_text(); ?>

						<a class="date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<em>
								<time pubdate datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( '%1$s', get_comment_date('M j, Y @ h:m a') ); ?>
								</time>
							</em>
						</a>
						
						<small class="comment_edit"><em>
							<?php edit_comment_link( __( '(Edit)', 'pt_framework' ), ' ' ); ?>
						</em></small>

						

					</div><!-- end .comment-body -->
					
				</div>
<hr>
			</li>

		<?php
		break;
		endswitch;
	}
}


/*
Comments Form Texts
*/

add_filter('comment_form_defaults', 'pt_framework_comments_form_defaults');
function pt_framework_comments_form_defaults( $defaults ) {

	$user = wp_get_current_user();
	$commenter = wp_get_current_commenter();
	//$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
	//$aria_req = ( $req ? " aria-required='true'" : '' );
	$aria_req = " aria-required='true' required" ;


	$args['id_form'] = 'commentform';

	$args['id_submit'] = 'submit';

	$args['title_reply'] = __( 'Leave a Reply', 'pt_framework' );

	$args['title_reply_to'] = __( 'Leave a Reply to %s', 'pt_framework' );

	$args['cancel_reply_link'] = __( 'Cancel Reply', 'pt_framework' );

	$args['label_submit'] = __( 'Post Comment', 'pt_framework' );

	$args['comment_field'] =  '<div class="row"><div class="col-md-10"><label for="comment" class="sr-only">' . __( 'Comment', 'pt_framework' ) . '</label><textarea id="comment" class="form-control" name="comment" rows="3"' . $aria_req . ' placeholder="'. __( 'Comment', 'pt_framework' ) .' '. __('(required)', 'pt_framework' ) .'" >' . '</textarea></div></div>';

	$args['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'pt_framework' ),  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>';
	
	$args['logged_in_as'] = '<p class="logged-in-as">' .  sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user->display_name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>';
	
	$args['comment_notes_before'] = '<p class="comment-notes">' . __( 'Your email address will not be published. Required fields are marked', 'pt_framework' ) .'</p>';
	
	$args['comment_notes_after'] = '<div class="row htmlTags-row">
		<div class="col-md-10">
				<p class="form-allowed-tags-hover">
					<i class="ion-code-working"></i>
					<span>' .  __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> <br>tags and attributes:' ) . '</span>
				
					<p class="form-allowed-tags">
						' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s<br>' ), ' <code>' . allowed_tags() . '</code>' ) . '
					</p>

				</p>
			</div>
		</div>';
	
	$args['fields']['author'] = '<div class="row"><div class="col-md-10"><div class="form-group"><label for="author" class="sr-only">'. __( 'Name', 'pt_framework' ) .'</label>
	<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . __( 'Name', 'pt_framework' ) .' '. __('(required)', 'pt_framework' ) . '"></div>';
	
	$args['fields']['email'] = '<div class="form-group"><label for="email" class="sr-only">' . __( 'Email', 'pt_framework' ) . '</label>
	<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . __( 'Email', 'pt_framework' ) .' '. __('(required)', 'pt_framework' ) .'"></div>';
	$args['fields']['url'] = '<div class="form-group"><label for="url" class="sr-only">' . __( 'Website', 'pt_framework' ) . '</label>
	<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'Website', 'pt_framework' ) . '"></div></div></div>';
	return $args;
}
?>

<?php if ( post_password_required() ): ?>

	<p class="nopassword"><?php _e( get_option( 'pt_blog_password_protected' ), 'pt_framework' ); ?></p>

<?php return; endif; ?>

<?php if ( have_comments() ): ?>

		<div class="comments-well"><?php comments_number( __('Comments (0)', 'pt_framework' ), __('Comment (1)', 'pt_framework' ), __('Comments (%)', 'pt_framework') );?></div>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback'=>'pt_framework_comments', 'reply_text'=>__('Reply', 'pt_framework' ), 'login_text'=>__('Log in to Reply', 'pt_framework' ) ) ); ?>
		</ol>
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
		<nav class="page">
			<?php paginate_comments_links(); ?>
		</nav>

	<?php endif; ?>

<?php endif; ?>

<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ): ?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'pt_framework' ); ?></p>
<?php endif; ?>


<div class="comment-form-header ">
	<?php comment_form(); ?>
</div>
