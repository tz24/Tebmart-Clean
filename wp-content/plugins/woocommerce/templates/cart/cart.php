<?php /* ?>
<script type="text/javascript">
function pickuplocation()
{
alert("location");
var location = document.getElementsByName('location')[0].value;
//var location=document.getElementById('location').value;
//var location=document.getElementById('location1').value;
//var location=document.getElementById('location2').value;
alert(location);
if(location!="" || location!=null)
{
alert("if");
return true;
}
else{
alert("Pick a location");
return false;
}
}
</script>
<?php */ ?>
<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();
?>

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			
			<th class="product-thumbnail">Item</th>
			<th class="product-name"><?//php _e( 'Product', 'woocommerce' ); ?></th> 
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Item Price', 'woocommerce' ); ?></th>
			
			<th class="product-subtotal"><?php _e( 'Total Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<tr class = "<?php //echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">
						<!-- Remove from cart link  .This has been move to below the quantity of item
						<td class="product-remove">
							<?php
							
							//	echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
							?>
						</td>
-->
						<!-- The thumbnail -->
						<td class="product-thumbnail">
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
						</td>

						<!-- Product Name -->
						<td class="product-name">
							<?php
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

								// Meta data
								echo $woocommerce->cart->get_item_data( $values );

                   				// Backorder notification
                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
                   					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
							?>
						
						</td>

												<!-- Quantity inputs -->
						<td class="product-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {

									$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
									$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
									$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );

									$product_quantity = sprintf( '<div class="quantity"><input type="number" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $step, $min, $max, esc_attr( $values['quantity'] ) );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
							<span class="item_remove">
						<?php	 echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s"  title="%s">remove</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );?>
							<span>
						</td>
						
						<!-- Product price -->
						<td class="product-price">
							<?php
								$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?>
						</td>



						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		
		
		<tr>
			<td colspan="6" class="actions">

				<?php if ( $woocommerce->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input name="coupon_code" class="input-text" id="coupon_code" value="" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>
<?php /*
			<input type="submit" class="button" name="update_cart" value="<?php  _e( 'Update Cart', 'woocommerce' ); ?>" />
			
 */?>			
				<input type="submit" class="checkout-button button alt" name="proceed" value="<?php _e( 'Submit', 'woocommerce' ); ?>" onclick="return pickuplocation();">

				<?php do_action('woocommerce_proceed_to_checkout'); ?>

				<?php $woocommerce->nonce_field('cart') ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>


</form>
<div class="cart-collaterals">



	<?php do_action('woocommerce_cart_collaterals'); ?>

	<?php woocommerce_cart_totals(); ?>

	<?php woocommerce_shipping_calculator(); ?>

	
</div>

<?php /* ?>
<div class="pickup_location">
	<div class="title"> Choose a Pickup Location</div>
	<div class="content">	
<label>Campus</label><input type="radio" name="location"  value="Campus" id="location" class="pick_location"/><label>Library</label><input type="radio" id="location" name="location" value="library" class="pick_location"/> <label>Food Court</label><input type="radio" id="location" name="location" value="foodcourt" class="pick_location"/>
</div>
</div>
<?php */ ?>

<?php do_action( 'woocommerce_after_cart' ); ?>