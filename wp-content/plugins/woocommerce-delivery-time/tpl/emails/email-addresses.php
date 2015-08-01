<?php
/**
 * Email Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

?><table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">

	<tr>

		<td valign="top" width="50%">

			<h3><?php _e('Billing address', 'woocommerce'); ?></h3>

			<p><?php echo $order->get_formatted_billing_address(); ?></p>

		</td>

		<?php //if ( get_option( 'woocommerce_ship_to_billing_address_only' ) == 'no' ) : ?>

		<td valign="top" width="50%">

			<h3><?php _e('Shipping address', 'woocommerce'); ?></h3>

			<p><?php echo $order->get_formatted_shipping_address(); ?></p>

			<?php if ( $delivery_time = get_post_meta( $order->id, '_delivery_time', true ) ) : ?>
				<?php
				$option = get_option( 'wdt' );
				$label = isset( $option['label'] ) ? $option['label'] : __( 'Delivery Time', 'woocommerce' );
				?>
				<p><strong><?php echo $label; ?></strong> <?php echo $delivery_time; ?></p>
			<?php endif; ?>
		</td>

		<?php //endif; ?>

	</tr>

</table>
