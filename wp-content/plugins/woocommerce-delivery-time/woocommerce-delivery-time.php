<?php
/*
Plugin Name: Woocommerce Delivery Time Picker for Shipping
Plugin URI: http://www.deluxeblogtips.com
Description: Allow customers pick time for delivery when shipping
Version: 2.1.3
Author: Rilwis
Author URI: http://www.deluxeblogtips.com
License: GPL2+
*/

define( 'WDT_DIR', plugin_dir_path( __FILE__ ) );
define( 'WDT_URL', plugin_dir_url( __FILE__ ) );
define( 'WDT_OPTION', 'wdt' );

if ( !class_exists( 'RW_Woocommerce_Delivery_Time' ) )
{
	/**
	 * This class adds date time picker for delivery when shipping
	 * Delivery time will be save as a part of order and will be included in emails
	 */
	class RW_Woocommerce_Delivery_Time
	{
		/**
		 * Class constructor
		 * Add hooks to Woocommerce
		 */
		function __construct()
		{
			// Enqueue scripts and styles
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			// Show delivery time field before order notes, e.g. after shipping address
			add_action( 'woocommerce_before_order_notes', array( $this, 'show_field' ), 20 );

			// Check if delivery time field is required
			add_filter( 'woocommerce_checkout_fields', array( $this, 'checkout_fields' ), 20, 1 );

			// Save delivery time into order (post) meta
			add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'save_field' ) );

			// Show time delivery on order detail page in admin area
			add_action( 'woocommerce_admin_order_data_after_shipping_address', array( $this, 'admin_show_field' ) );

			// Change email template to include Delivery Time
			add_filter( 'woocommerce_locate_template', array( $this, 'email_template' ), 10, 3 );

			if ( is_admin() )
			{
				require_once WDT_DIR . 'inc/settings.php';
				require_once WDT_DIR . 'inc/update.php';
			}
		}

		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		function enqueue_scripts()
		{
			// Enqueue scripts & styles for checkout page only
			//if ( !is_checkout() )
			//	return;

			$option = get_option( WDT_OPTION );
			$option = wp_parse_args( $option, array(
				'date_format'          => 'mm/dd/yy',
				'time_format'          => 'hh:mm TT',
				'language'             => '',
				'restricted_dates'     => '',
				'restricted_week_days' => array(),
				'theme'                => 'smoothness',
			) );

			wp_enqueue_style( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/' . $option['theme'] . '/jquery-ui.min.css' );
			wp_enqueue_style( 'jquery-ui-timepicker', WDT_URL . 'css/jquery-ui-timepicker-addon.css' );

			// Timepicker script
			wp_register_script( 'jquery-ui-timepicker', WDT_URL . 'js/jquery-ui-timepicker-addon.js', array( 'jquery-ui-datepicker', 'jquery-ui-slider' ), '1.3', true );

			$deps = array( 'jquery-ui-timepicker' );

			// Load localized scripts
			// If language is set, use it. Otherwise use WordPress language
			$language = $option['language'];
			if ( !$language )
				$language = str_replace( '_', '-', get_locale() );
			$date_i18n = 'js/datepicker-i18n/jquery.ui.datepicker-' . $language . '.js';
			$time_i18n = 'js/timepicker-i18n/jquery-ui-timepicker-' . $language . '.js';

			if ( file_exists( WDT_DIR . $date_i18n ) )
			{
				wp_register_script( 'jquery-ui-datepicker-i18n', WDT_URL . $date_i18n, $deps, '', true );
				$deps[] = 'jquery-ui-datepicker-i18n';
			}
			if ( file_exists( WDT_DIR . $time_i18n ) )
			{
				wp_register_script( 'jquery-ui-timepicker-i18n', WDT_URL . $time_i18n, $deps, '', true );
				$deps[] = 'jquery-ui-timepicker-i18n';
			}

			wp_enqueue_script( 'wdt', WDT_URL . 'js/script.js', $deps, '', true );

			// Get restricted dates
			$restricted_dates = array_filter( array_map( 'trim', explode( "\n", $option['restricted_dates'] . "\n" ) ) );

			// Convert week days from string to int
			$days_week_block = array();
			foreach ( $option['restricted_week_days'] as $day )
			{
				$days_week_block[] = intval( $day );
			}

			// Get object last date what cannot access and min time available
			$format_date = sprintf( 'F j, Y %s:00:00', $option['restricted_minhour'] );
			$min_datetime = date( $format_date );

			// Get restricted sequence days, value is empty enable current day, 0 = disable today, 1 = disable today and tomorrow ...
			$restricted_sequence_days = $option['restricted_sequence_days'] == '' ? 0 :  intval( $option['restricted_sequence_days'] ) + 1;

			// Add time restricted sequence days
			$min_datetime = date( $format_date, strtotime( $min_datetime . ' + ' . $restricted_sequence_days . ' days' ) );
			$params = apply_filters( 'wdt_js_options', array(
				'dateFormat'         => $option['date_format'],
				'timeFormat'         => $option['time_format'],
				'restrictedWeekDays' => $days_week_block,
				'restrictedDates'    => $restricted_dates,
				'language'           => $language,
				'minDateTime'        => $min_datetime,
				'showTimepicker'     => empty( $option['show_timepicker'] ) ? 0 : 1,
				'maxHour'            =>	$option['restricted_maxhour'] > $option['restricted_minhour'] ? $option['restricted_maxhour'] : 23,
			) );
			wp_localize_script( 'wdt', 'WDT', $params );
		}

		/**
		 * Show delivery time field before order notes, e.g. after shipping address
		 *
		 * @param $fields
		 *
		 * @return mixed
		 */
		function show_field()
		{
			global $woocommerce;

			// Don't show delivery time field when shipping is disabled
			if ( !$woocommerce->cart->needs_shipping() )
				return;

			$option = get_option( WDT_OPTION );
			$label = isset( $option['label'] ) ? $option['label'] : __( 'Delivery Time', 'woocommerce' );
			woocommerce_form_field(
				'delivery_time',
				array(
					'label'       => $label,
					'placeholder' => $label,
					'clear'       => true,
					'required'	  => !empty( $option['required'] ),
				),
				''
			);
			
			echo do_shortcode('[widgets_on_pages id="Working Hours"]'); /*Custom widget show on checkout page*/
		}

		/**
		 * Add fields to registered checkout fields to easily check if it's required
		 *
		 * @param  array $checkout_fields
		 *
		 * @return array
		 */
		function checkout_fields( $checkout_fields )
		{
			global $woocommerce;

			// Don't show delivery time field when shipping is disabled
			if ( !$woocommerce->cart->needs_shipping() )
				return $checkout_fields;

			$option = get_option( WDT_OPTION );
			if ( empty( $option['required'] ) )
				return $checkout_fields;

			$label = isset( $option['label'] ) ? $option['label'] : __( 'Delivery Time', 'woocommerce' );

			// Custom field
			$checkout_fields['wdt'] = array(
				'delivery_time'=> array(
					'label'       => $label,
					'placeholder' => $label,
					'required'	  => !empty( $option['required'] ),
				)
			);

			return $checkout_fields;
		}

		/**
		 * Save delivery time into order (post) meta
		 *
		 * @return void
		 */
		function save_field( $order_id )
		{
			if ( !empty( $_POST['delivery_time'] ) )
				update_post_meta( $order_id, '_delivery_time', $_POST['delivery_time'] );
		}

		/**
		 * Show time delivery on order detail page in admin area
		 *
		 * @param object $order
		 *
		 * @return void
		 */
		function admin_show_field( $order )
		{
			if ( $delivery_time = get_post_meta( $order->id, '_delivery_time', true ) )
			{
				$option = get_option( WDT_OPTION );
				$label = isset( $option['label'] ) ? $option['label'] : __( 'Delivery Time', 'woocommerce' );

				echo "<p><strong>{$label}:</strong> {$delivery_time}</p>";
			}
		}

		/**
		 * Change email template to include Delivery Time
		 *
		 * @param string $template Template path
		 * @param string $template_name Template name
		 * @param string $template_path Path to parent theme
		 *
		 * @return string
		 */
		function email_template( $template, $template_name, $template_path )
		{
			// We change only email-addresses.php template
			if ( 'emails/email-addresses.php' !== $template_name )
				return $template;

			global $woocommerce;

			if ( !$template_path )
				$template_path = $woocommerce->template_url;

			// Look within passed path within the theme - this is priority
			$theme_template = locate_template( array(
				$template_path . $template_name,
				$template_name
			) );
			if ( $theme_template )
				return $theme_template;

			// Get plugin template
			return WDT_DIR . 'tpl/' . $template_name;
		}
	}

	new RW_Woocommerce_Delivery_Time;
}
