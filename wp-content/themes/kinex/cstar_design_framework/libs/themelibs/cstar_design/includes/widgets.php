<?php
/* widget Shortcode Inserter */
class Widget_Shortcode_Inserter extends WP_Widget {
	
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_text', 'description' => __('Quick Shortcode Generator'));
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'custom_shortcode_generator' );
		parent::__construct('custom_shortcode_generator', __('- Shortcode Generator'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance){
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		
		/* Before widget */
		echo $before_widget;

		/* Display the widget title */
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

		/* Display name from widget settings if one was input. */
		echo '<div class="textwidget">' . do_shortcode( $text ) . '</div>';
		
		/* After widget */
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance){
		$instance = wp_parse_args($new_instance, $old_instance);
		return $instance;
	}
	
	function form( $instance ) {
	
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title	= strip_tags($instance['title']);
		$text	= esc_textarea($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
      <a href="#" class="codebox" data-target="<?php echo $this->get_field_id('text'); ?>" data-page="widget"><img src="<?php echo T_URI.'/'.F_REQ; ?>/images/shortcode_add.png" alt="" /></a>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
<?php
	}
}