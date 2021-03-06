<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

<div class="col2-set" id="customer_login">

	<div class="col-1">

<?php endif; ?>

		<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>
		<form method="post" class="login">
			<p class="form-row form-row-first">
				<label for="username"><?php _e( 'Email Address', 'woocommerce' ); ?> <span class="required">*</span></label><?php /* ?><label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label><?php */ ?>
				<input type="text" class="input-text" name="username" id="username" />
			</p>
			<p class="form-row form-row-last">
				<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label><input class="input-text" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="rememberme_chk">
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<label for="rememberme" class="inline"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?></label>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>
			
			
			<p class="form-row">
				<?php $woocommerce->nonce_field('login', 'login') ?>
				<input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" /> <a class="lost_password" href="<?php

				$lost_password_page_id = woocommerce_get_page_id( 'lost_password' );

				if ( $lost_password_page_id )
					echo esc_url( get_permalink( $lost_password_page_id ) );
				else
					echo esc_url( wp_lostpassword_url( home_url() ) );

				?>"><?php _e( 'Lost Password?', 'woocommerce' ); ?></a>
			</p>
			
		</form>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="col-2">

		<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
		<form method="post" class="register">

			<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

				<p class="form-row form-row-first">
					<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
				</p>

				<p class="form-row form-row-last">

			<?php else : ?>

				<p class="form-row form-row-wide">
			<?php endif; ?>
				<label for="reg_email"><?php _e( 'Email', 'woocommerce' ); ?> <span class="required">*</span></label><input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
			</p>

			<div class="clear"></div>

			<p class="form-row form-row-first">
				<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label><input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password']) && isset( $_POST['register'] )) echo esc_attr($_POST['password']); ?>" />
			</p>
			<p class="form-row form-row-last">
				<label for="reg_password2"><?php _e( 'Re-enter password', 'woocommerce' ); ?> <span class="required">*</span></label><input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
			</p>
			<div class="clear"></div>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'register_form' ); ?>

			<p class="form-row">
				<?php $woocommerce->nonce_field('register', 'register') ?>
				<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
			</p>

		</form>

	</div>

</div>
<?php endif; ?>
<?php
	if($_POST)
	{
		/*echo $_POST['email'];
		$message = 'Thank you for registering on Tebmart!!';
		$headers = "From: info@tebmart.com" . "\r\n";
		/*mail(to,subject,message,headers,parameters);
		if(mail("rahul@kinexmedia.com","Tebmart Registeration",$message,$headers))
		{
			echo 'mail sent';
		}
		exit;*/
	}
?>
<?php do_action('woocommerce_after_customer_login_form'); ?>