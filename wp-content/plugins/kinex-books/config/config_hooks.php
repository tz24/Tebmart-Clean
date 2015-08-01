<?php 

add_action('admin_head', 'add_admin_head_files'); //hook for the stylesheet & javascript include in the admin header files

add_action('admin_init', 'my_admin_datepicker'); //datepicker

add_action('admin_footer', 'my_admin_datepicker_footer'); //date picker



?>