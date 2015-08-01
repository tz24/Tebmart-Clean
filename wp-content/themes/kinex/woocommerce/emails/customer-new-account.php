<?php
/**
 * Customer new account email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php _e( "Dear Customer,", 'woocommerce' ); ?></p>

<p><?php printf(__("Thanks for creating an account on %s.", 'woocommerce'), esc_html( $blogname )); ?></p>

<p><?php printf(__("You are registered as: <strong>%s</strong>", 'woocommerce'), esc_html( $user_login ) ); ?></p>

<?php /* ?>
<p><?php printf(__("Program: <strong>%s</strong>", 'woocommerce'), esc_html( $rpr_program ) ); ?></p>

<p><?php printf(__("School: <strong>%s</strong>", 'woocommerce'), esc_html( $rpr_school ) ); ?></p>
<?php */ ?>

<p><?php printf(__( 'You can access your account area here: %s.', 'woocommerce' ), get_permalink(woocommerce_get_page_id('myaccount'))); ?></p>

<?php do_action( 'woocommerce_email_footer' ); ?>