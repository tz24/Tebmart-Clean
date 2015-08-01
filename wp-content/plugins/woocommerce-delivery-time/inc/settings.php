<?php
if ( !class_exists( 'RW_Woocommerce_Delivery_Time_Settings' ) )
{
	/**
	 * This class adds time picker for delivery when shipping
	 * Delivery time will be save as a part of order and will be included in emails
	 */
	class RW_Woocommerce_Delivery_Time_Settings
	{
		/**
		 * Class constructor
		 * Add hooks to Woocommerce
		 */
		function __construct()
		{
			// Enqueue scripts and styles for admin
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			// Add setting fields to "Shipping" tab of woocommerce settings page
			add_filter( 'woocommerce_shipping_settings', array( $this, 'settings' ) );

			// Callback function to show checkbox list field in settings page
			add_action( 'woocommerce_admin_field_checkbox_list', array( $this, 'admin_field_checkbox_list' ) );

			// Callback function to show themes in settings page
			add_action( 'woocommerce_admin_field_images_select', array( $this, 'admin_field_images_select' ) );

			// Callback function to show themes in settings page
			add_action( 'woocommerce_admin_field_custom_checkbox', array( $this, 'admin_field_custom_checkbox' ) );

			// Update plugin option
			add_action( 'woocommerce_update_options', array( $this, 'update_options' ) );
		}

		/**
		 * Enqueue scripts and styles on admin pages
		 *
		 * @return void
		 */
		function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'admin-style', WDT_URL . 'css/admin-style.css' );
		}

		/**
		 * Add setting fields to "Shipping" tab of woocommerce settings page
		 *
		 * @return void
		 */
		function settings( $settings )
		{
			$docs = sprintf( __( '<a href="%s" target="_blank">See documentation</a>.', 'woocommerce' ), plugins_url( 'docs.html', dirname( __FILE__ ) ) );

			// Title
			$settings[] = array(
				'title' => __( 'Delivery Time Options', 'woocommerce' ),
				'desc'  => sprintf( __( 'Options for Woocommerce Delivery Time for Shipping addon. %s', 'woocommerce' ), $docs ),
				'type'  => 'title',
			);

			// Required?
			$settings[] = array(
				'name' => __( 'Required?', 'woocommerce' ),
				'id'   => WDT_OPTION . '[required]',
				'type' => 'custom_checkbox',
			);

			// Field label
			$settings[] = array(
				'title'   => __( 'Field Label', 'woocommerce' ),
				'id'      => WDT_OPTION . '[label]',
				'type'    => 'text',
				'default' => __( 'Delivery Time', 'woocommerce' ),
			);

			// Date format
			$desc = array();
			$desc[] = __( '<code>d</code>: Day of month (no leading zero)', 'woocommerce' );
			$desc[] = __( '<code>dd</code>: Day of month (two digit)', 'woocommerce' );
			$desc[] = __( '<code>m</code>: Month of year (no leading zero)', 'woocommerce' );
			$desc[] = __( '<code>mm</code>: Month of year (two digit)', 'woocommerce' );
			$desc[] = __( '<code>y</code>: Year (two digit)', 'woocommerce' );
			$desc[] = __( '<code>yy</code>: Year (four digit)', 'woocommerce' );
			$desc[] = $docs;
			$settings[] = array(
				'title'   => __( 'Date Format', 'woocommerce' ),
				'id'      => WDT_OPTION . '[date_format]',
				'type'    => 'text',
				'default' => 'mm/dd/yy',
				'desc'    => '<br>' . implode( '<br>', $desc ),
			);

			// Time format
			$desc = array();
			$desc[] = __( '<code>H</code>: Hour with no leading 0 (24 hour)', 'woocommerce' );
			$desc[] = __( '<code>HH</code>: Hour with leading 0 (24 hour)', 'woocommerce' );
			$desc[] = __( '<code>h</code>: Hour with no leading 0 (12 hour)', 'woocommerce' );
			$desc[] = __( '<code>hh</code>: Hour with leading 0 (12 hour)', 'woocommerce' );
			$desc[] = __( '<code>m</code>: Minute with no leading 0', 'woocommerce' );
			$desc[] = __( '<code>mm</code>: Minute with leading 0', 'woocommerce' );
			$desc[] = __( '<code>TT</code>: AM or PM for AM/PM', 'woocommerce' );
			$desc[] = $docs;
			$settings[] = array(
				'title'   => __( 'Time Format', 'woocommerce' ),
				'id'      => WDT_OPTION . '[time_format]',
				'type'    => 'text',
				'default' => 'hh:mm TT',
				'desc'    => '<br>' . implode( '<br>', $desc ),
			);

			// Language
			$settings[] = array(
				'title'   => __( 'Language', 'woocommerce' ),
				'id'      => WDT_OPTION . '[language]',
				'type'    => 'select',
				'options' => array(
					''      => __( 'English', 'woocommerce' ),

					'af'    => __( 'Afrikaans', 'woocommerce' ),
					'ar-DZ' => __( 'Algerian Arabic', 'woocommerce' ),
					'ar'    => __( 'Arabic', 'woocommerce' ),
					'az'    => __( 'Azerbaijani', 'woocommerce' ),

					'be'    => __( 'Belarusian', 'woocommerce' ),
					'bg'    => __( 'Bulgarian', 'woocommerce' ),
					'bs'    => __( 'Bosnian', 'woocommerce' ),

					'ca'    => __( 'Inicialització', 'woocommerce' ),
					'cs'    => __( 'Czech', 'woocommerce' ),
					'cy-GB' => __( 'Welsh/UK', 'woocommerce' ),

					'da'    => __( 'Danish', 'woocommerce' ),
					'de'    => __( 'German', 'woocommerce' ),

					'el'    => __( 'Greek', 'woocommerce' ),
					'en-AU' => __( 'English/Australia', 'woocommerce' ),
					'en-GB' => __( 'English/UK', 'woocommerce' ),
					'en-NZ' => __( 'English/New Zealand', 'woocommerce' ),
					'eo'    => __( 'Esperanto', 'woocommerce' ),
					'es'    => __( 'Spanish', 'woocommerce' ),
					'et'    => __( 'Estonian', 'woocommerce' ),
					'eu'    => __( 'Euskarako', 'woocommerce' ),

					'fa'    => __( 'Persian (Farsi)', 'woocommerce' ),
					'fi'    => __( 'Finnish', 'woocommerce' ),
					'fo'    => __( 'Faroese', 'woocommerce' ),
					'fr-CA' => __( 'Canadian-French', 'woocommerce' ),
					'fr-CH' => __( 'Swiss-French', 'woocommerce' ),
					'fr'    => __( 'French', 'woocommerce' ),

					'gl'    => __( 'Galician', 'woocommerce' ),

					'he'    => __( 'Hebrew', 'woocommerce' ),
					'hi'    => __( 'Hindi', 'woocommerce' ),
					'hr'    => __( 'Croatian', 'woocommerce' ),
					'hu'    => __( 'Hungarian', 'woocommerce' ),
					'hy'    => __( 'Armenian', 'woocommerce' ),

					'id'    => __( 'Indonesian', 'woocommerce' ),
					'is'    => __( 'Icelandic', 'woocommerce' ),
					'it-CH' => __( 'Italian/Switzerland', 'woocommerce' ),
					'it'    => __( 'Italian', 'woocommerce' ),

					'ja'    => __( 'Japanese', 'woocommerce' ),

					'ka'    => __( 'Georgian', 'woocommerce' ),
					'kk'    => __( 'Kazakh', 'woocommerce' ),
					'km'    => __( 'Khmer', 'woocommerce' ),
					'ko'    => __( 'Korean', 'woocommerce' ),
					'ky'    => __( 'Kyrgyz', 'woocommerce' ),

					'lb'    => __( 'Luxembourgish', 'woocommerce' ),
					'lt'    => __( 'Lithuanian', 'woocommerce' ),
					'lv'    => __( 'Latvian', 'woocommerce' ),

					'mk'    => __( 'Macedonian', 'woocommerce' ),
					'ml'    => __( 'Malayalam', 'woocommerce' ),
					'ms'    => __( 'Malaysian', 'woocommerce' ),

					'nb'    => __( 'Norwegian', 'woocommerce' ),
					'nl-BE' => __( 'Dutch/Belgium', 'woocommerce' ),
					'nl'    => __( 'Dutch', 'woocommerce' ),
					'nn'    => __( 'Norwegian', 'woocommerce' ),
					'no'    => __( 'Norwegian/Nynorsk', 'woocommerce' ),

					'pl'    => __( 'Polish', 'woocommerce' ),
					'pt-BR' => __( 'Brazilian', 'woocommerce' ),
					'pt'    => __( 'Portuguese', 'woocommerce' ),

					'rm'    => __( 'Romansh', 'woocommerce' ),
					'ro'    => __( 'Romanian', 'woocommerce' ),
					'ru'    => __( 'Russian', 'woocommerce' ),

					'sk'    => __( 'Slovak', 'woocommerce' ),
					'sl'    => __( 'Slovenian', 'woocommerce' ),
					'sq'    => __( 'Albanian', 'woocommerce' ),
					'sr-SR' => __( 'Serbian (Latin)', 'woocommerce' ),
					'sr'    => __( 'Serbian (Cyrillic)', 'woocommerce' ),
					'sv'    => __( 'Swedish', 'woocommerce' ),

					'ta'    => __( 'Tamil', 'woocommerce' ),
					'th'    => __( 'Thai', 'woocommerce' ),
					'tj'    => __( 'Tajiki', 'woocommerce' ),
					'tr'    => __( 'Turkish', 'woocommerce' ),

					'uk'    => __( 'Ukrainian', 'woocommerce' ),

					'vi'    => __( 'Vietnamese', 'woocommerce' ),

					'zh-CN' => __( 'Chinese/Mainland', 'woocommerce' ),
					'zh-HK' => __( 'Chinese/Hong Kong', 'woocommerce' ),
					'zh-TW' => __( 'Chinese/Taiwan', 'woocommerce' ),
				),
			);

			// Restricted dates and date ranges
			$desc = array();
			$desc[] = __( 'Enter restricted <b>dates</b> or <b>date ranges</b>, <u>one rule per line</u>.', 'woocommerce' );
			$desc[] = __( 'Date format: <code>mm/dd/yyyy</code>. Date range format: <code>mm/dd/yyyy - mm/dd/yyyy</code>.', 'woocommerce' );
			$desc[] = __( 'Stars (<code>*</code>) can be used for day, month or year.', 'woocommerce' );
			$desc[] = __( 'Sample dates: <code>5/6/2013</code>, <code>*/5/2013</code>, <code>6/*/*</code>, <code>*/8/*</code>.', 'woocommerce' );
			$desc[] = __( 'Sample date ranges: <code>5/6/2013 - 8/*/2013</code>, <code>6/*/* - 8/*/*</code>, <code>*/1/* - */5/*</code>.', 'woocommerce' );
			$desc[] = $docs;
			$settings[] = array(
				'title'             => __( 'Restricted Dates', 'woocommerce' ),
				'desc'              => '<span class="description">' . implode( '<br>', $desc ) . '</span>',
				'id'                => WDT_OPTION . '[restricted_dates]',
				'type'              => 'textarea',
				'class'             => 'widefat',
				'custom_attributes' => array(
					'rows' => 5,
				),
			);

			// Restricted week days
			$week_days = array(
				0 => __( 'Sunday', 'woocommerce' ),
				1 => __( 'Monday', 'woocommerce' ),
				2 => __( 'Tuesday', 'woocommerce' ),
				3 => __( 'Wednesday', 'woocommerce' ),
				4 => __( 'Thursday', 'woocommerce' ),
				5 => __( 'Friday', 'woocommerce' ),
				6 => __( 'Saturday', 'woocommerce' ),
			);
			$settings[] = array(
				'title'   => __( 'Restricted Week Days', 'woocommerce' ),
				'id'      => WDT_OPTION . '[restricted_week_days]',
				'type'    => 'checkbox_list',
				'options' => $week_days,
			);

			// Restricted sequence days
			$settings[] = array(
				'title'   => __( 'Restricted sequence days', 'woocommerce' ),
				'desc'    => __( 'days (0 = disable today, 1 = disable today and tomorrow,...)', 'woocommerce' ),
				'id'      => WDT_OPTION . '[restricted_sequence_days]',
				'default' => 0,
				'type'    => 'text',
			);

			// Show Timepicker
			$settings[] = array(
				'name' => __( 'Show Timepicker', 'woocommerce' ),
				'id'   => WDT_OPTION . '[show_timepicker]',
				'type' => 'custom_checkbox'
			);

			// Restricted time
			$settings[] = array(
				'title'   => __( 'Time Shipping From', 'woocommerce' ),
				'desc'    => __( 'Hour', 'woocommerce' ),
				'id'      => WDT_OPTION . '[restricted_minhour]',
				'type'    => 'text',
				'default' => 0
			);
			$settings[] = array(
				'title'   => __( 'Time Shipping To', 'woocommerce' ),
				'desc'    => __( 'Hour' , 'woocommerce' ),
				'id'      => WDT_OPTION . '[restricted_maxhour]',
				'type'    => 'text',
				'default' => 23
			);

			// Themes
			$settings[] = array(
				'title' => __( 'Themes', 'woocommerce' ),
				'id'    => WDT_OPTION . '[theme]',
				'type'  => 'images_select',
			);

			// Section end
			$settings[] = array(
				'type' => 'sectionend'
			);

			return $settings;
		}

		/**
		 * Callback function to show checkbox list field in settings page
		 *
		 * @param  array $value
		 * @return
		 */
		function admin_field_checkbox_list( $value )
		{
			$option_value = woocommerce_settings_get_option( $value['id'], $value['default'] );
			if ( !is_array( $option_value ) )
				$option_value = array();
			?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label><?php echo esc_html( $value['title'] ); ?></label>
				</th>
				<td class="forminp forminp-<?php echo sanitize_title( $value['type'] ) ?>">
					<?php
					$html = array();
					foreach ( $value['options'] as $k => $v )
					{
						$html[] = sprintf(
							'<label><input type="checkbox" name="%s[]" value="%s"%s> %s</label>',
							esc_attr( $value['id'] ),
							$k,
							checked( in_array( $k, $option_value ), 1, false ),
							$v
						);
					}
					echo implode( '<br>', $html );
					?>
				</td>
			</tr>
			<?php
		}


		/**
		 * Callback function to show checkbox list field in settings page
		 *
		 * @param  array $value
		 * @return
		 */
		function admin_field_images_select( $value )
		{
			$option_value = woocommerce_settings_get_option( $value['id'], $value['default'] );
			?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label><?php echo esc_html( $value['title'] ); ?></label>
				</th>
				<td class="forminp forminp-<?php echo sanitize_title( $value['type'] ) ?>">
					<?php
					$html = array();
					$themes = array(
						'black-tie.png'      => 'Black Tie',
						'blitzer.png'        => 'Blitzer',
						'cupertino.png'      => 'Cupertino',
						'dark-hive.png'      => 'Dark Hive',
						'dot-luv.png'        => 'Dot Luv',
						'eggplant.png'       => 'Eggplant',
						'excite-bike.png'    => 'Excite Bike',
						'flick.png'          => 'Flick',
						'hot-sneaks.png'     => 'Hot Sneaks',
						'humanity.png'       => 'Humanity',
						'le-frog.png'        => 'Le Frog',
						'mint-choc.png'      => 'Mint Choc',
						'overcast.png'       => 'Overcast',
						'pepper-grinder.png' => 'Pepper Grinder',
						'smoothness.png'     => 'Smoothness',
						'south-street.png'   => 'South Street',
						'start.png'          => 'Start',
						'sunny.png'          => 'Sunny',
						'swanky-purse.png'   => 'Swanky Purse',
						'trontastic.png'     => 'Trontastic',
						'ui-darkness.png'    => 'UI darkness',
						'ui-lightness.gif'   => 'UI lightness',
					);
					foreach ( $themes as $k => $v )
					{
						$theme = substr( $k, 0, strpos( $k, '.' ) );
						$html[] = sprintf(
							'<label>
								<img src="%s"><br>
								<input type="radio" name="%s" value="%s" %s> %s
							</label>',
							WDT_URL . 'themes/' . $k,
							esc_attr( $value['id'] ),
							$theme,
							checked( $theme, $option_value, false ),
							$v
						);
					}
					echo implode( '', $html );
					?>
				</td>
			</tr>
			<?php
		}
		/**
		 * Callback function to show checkbox list field in settings page
		 *
		 * @param  array $value
		 * @return
		 */
		function admin_field_custom_checkbox( $value )
		{
			$option_value = woocommerce_settings_get_option( $value['id'], $value['default'] );
			?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
				</th>
				<td class="forminp forminp-<?php echo sanitize_title( $value['type'] ) ?>">
					<?php
					printf(
						'<label><input type="checkbox" name="%s" id="%s" value="1" %s> %s</label>',
						esc_attr( $value['id'] ),
						esc_attr( $value['id'] ),
						checked( $option_value, 1, false ),
						$value['desc']
					);
					?>
				</td>
			</tr>
			<?php
		}
		/**
		 * Update plugin option
		 *
		 * @return void
		 */
		function update_options()
		{
			if ( isset( $_POST[WDT_OPTION] ) )
				update_option( WDT_OPTION, $_POST[WDT_OPTION] );
		}
	}

	new RW_Woocommerce_Delivery_Time_Settings;
}
