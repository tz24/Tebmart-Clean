<?php
/*function included for the include of css & javascript files in the admin head*/
function add_admin_head_files()
{
		
	print '<link rel="stylesheet" type="text/css" href="'.plugins_url( 'css/hsb_style.css' , dirname(__FILE__) ).'">';
	
	//print '<link rel="stylesheet" type="text/css" href="'.plugins_url( 'css/jquery-ui-1.8.20.custom.css' , dirname(__FILE__) ).'">';

	//print '<script type="text/javascript" src="'.plugins_url( 'js/jquery-1.9.1.js' , dirname(__FILE__) ).'"></script>';
		
	//print '<script type="text/javascript" src="'.plugins_url('js/ajax_javascript.js' , dirname(__FILE__) ).'"></script>';
	
	//wp_enqueue_script('jquery', get_plugin_dir() . '/admin/js/jquery-1.9.1.js');
	

} /*end of function*/



function HelloWorldShortcode() {
	return '<p>Hello Worldddddddddddddddddddddddddd!</p>';
}

add_shortcode('helloworld', 'HelloWorldShortcode');


add_shortcode('hsbpaymentform', 'online_payment_form');




/*functions for date picker for admin panel*/
function my_admin_datepicker()
{
	//$pluginfolder = get_bloginfo('url') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
	//wp_enqueue_script('jquery');
	//wp_enqueue_script('jquery-ui-core');
	//wp_enqueue_script('jquery-ui-datepicker', get_plugin_dir() . '/config/datepicker/jquery.ui.datepicker.min.js', array('jquery', 'jquery-ui-core') );
	//wp_enqueue_style('jquery.ui.theme', get_plugin_dir().'/config/datepicker/smoothness/jquery-ui-1.8.20.custom.css');
}



function my_admin_datepicker_footer() {
	?>
	<script type="text/javascript">
	/*
	jQuery(document).ready(function(){
		jQuery('.mydatepicker').datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: '1950:2020'
		});
	});
	*/
	</script>
	<?php
}





?>