<?php
class AP_Search_Widget extends WP_Widget {

	function AP_Search_Widget() {
		// Instantiate the parent object
		parent::__construct( false, 'AnsPress Search' );
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// echo $args['before_widget'];
		// if ( ! empty( $title ) ) {
			// echo $args['before_title'] . $title . $args['after_title'];
		// }
		
		
		?>
			<?php 			
				$uriString =explode('/', $_SERVER["REQUEST_URI"]) ;
				switch($uriString[count($uriString)-2]){
					case 'informational':
						$buttonStr = 'Post Information';
						break;
					case 'concepts':
						$buttonStr = 'Post Concept';
						break;					
					default:
						$buttonStr = 'Ask Question';
						break;
				}
			?>
			<form class="ap-quick-ask" action="<?php echo ap_get_link_to('search'); ?>" method="GET">
				<div class=ask_question><a class="ap-btn ap-success" href="<?php echo site_url('/');?>forum-2/ask"><?php echo $buttonStr;?></a></div>
				<div class="ap-qaf-inner">
					<input class="form-control" type="text" name="ap_s" id="ap-quick-ask-input" placeholder="<?php _e('Search questions', 'ap'); ?>" value="<?php echo get_query_var('ap_s'); ?>" autocomplete="off" />
					<button type="submit ap-btn" ><?php _e('Search', 'ap'); ?></button>
				</div>
			</form>
		<?php
		// echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Search questions', 'ap' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}

function ap_search_register_widgets() {
	register_widget( 'AP_Search_Widget' );
}

add_action( 'widgets_init', 'ap_search_register_widgets' );