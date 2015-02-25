<?php

add_action( 'widgets_init', 'pt_recent_posts_widget' );

// Register widget
function pt_recent_posts_widget() {
	register_widget( 'pt_recent_posts_Widget' );
}


class pt_recent_posts_Widget extends WP_Widget {

	function pt_recent_posts_Widget() {

		$widget_ops = array(
			'classname' => 'pt_recent_posts_widget',
			'description' => __('Pixelthrone Recent Posts', 'pt_admin_framework')
			);

		$control_ops = array();

		$this->WP_Widget( 'pt_recent_posts_widget', __('Pixelthrone Recent Posts', 'pt_admin_framework'), $widget_ops, $control_ops );

	}


	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/


	function widget($args, $instance) {
		$cache = wp_cache_get('pt_recent_posts_widget', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'pt_admin_framework') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<div class="row">
					<?php echo '<a href="'. get_permalink() .'" title="'. esc_attr( get_the_title() ? get_the_title() : get_the_ID() ) .'" class="image">';
					if(has_post_thumbnail()):
						echo '<div class="col-md-4">';
						the_post_thumbnail('thumbnail'); 
						echo '</div>';
						echo '<div class="col-md-8">';
					else :
						$featured_video = get_post_meta(get_the_ID(), 'pt_post_video', TRUE);
						if ( $featured_video_th = pt_video_thumbs( $featured_video ) ) :
							echo '<div class="col-md-4">';
							echo '<img src="'. $featured_video_th .'">';
							echo '</div>';
							echo '<div class="col-md-8">';
						else :
							echo '<div class="col-md-12">';
						endif;
					endif;
					?>
					
					<p class="post-title">
						<?php if ( get_the_title() ) the_title(); else the_ID(); ?>
					</p>
					</div>
					
					</a>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('pt_recent_posts_widget', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('pt_recent_posts_widget', 'widget');
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'pt_admin_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' , 'pt_admin_framework'); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

<?php
	}
}
?>
