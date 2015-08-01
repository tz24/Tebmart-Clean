<?php ob_start();


add_action('wp_ajax_payment_status', 'payment_status');



ob_clean(); ?>