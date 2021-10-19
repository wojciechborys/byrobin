<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<?php if(is_cart()){?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<div class="cartLeftContent-box">
		<?php checkout_stepbox();?>
	<?php do_action( 'woocommerce_before_cart_table' ); ?>	

	<table class="shop_table woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th colspan="4" class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>				
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>

						<td class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</td>

						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
						</td>

						<td class="product-subtotal-quantity">
							<table>
								<tr>
									<td class="product-subtotal" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
										<?php
										echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
										?>
									</td>
								</tr>
								<tr>
									<td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
										<?php
										if ($_product->is_sold_individually() || $swatches_var) {
											$product_quantity = sprintf('<span class="qty-sw">1</span> <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
										} else {
											$product_id = $cart_item['product_id'];
											$minimum_inventory = get_field('minimum_inventory', $product_id);
											if(empty($minimum_inventory))
												$minimum_inventory = 0;
											$product_quantity = woocommerce_quantity_input(array(
												'input_name' => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'max_value' => $_product->get_max_purchase_quantity(),
												'min_value' => $minimum_inventory,
												'product_name' => $_product->get_name(),
													), $_product, false);
										}

										echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
										?>
									</td>															
								</tr>
							</table>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="4" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>" class="subtotal">					
					
					<button type="submit" style="display:none;" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					
					<div class="subtotal-wrap">
						<span class="heading"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span><?php wc_cart_totals_subtotal_html(); ?>
					</div>
				</td>			
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
	
		<div class="button-box">
			<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) );?>" class="button">Back to shop</a>
		</div>
	</div>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
<div class="cartRightContent-box">
	<div class="cart-collaterals">
		<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
		?>
	</div>


	<?php if ( wc_coupons_enabled() ) { ?>
		<div class="coupon coupon-wrap form-row">
			<label for="coupon_code"><?php esc_html_e( 'Coupon code', 'woocommerce' ); ?></label> 
			<span class="woocommerce-input-wrapper">
				<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Check', 'woocommerce' ); ?>"><?php esc_attr_e( 'Check', 'woocommerce' ); ?></button>
			</span>
			<?php do_action( 'woocommerce_cart_coupon' ); ?>
		</div>
	<?php } ?>

</div>
</form>

<?php }else{
	
?>
<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
	<?php do_action('woocommerce_before_cart_table'); ?>

	<table class="shop_table cart woocommerce-cart-form__contents" cellspacing="0">                                      
		<tbody>
			<?php do_action('woocommerce_before_cart_contents'); ?>

			<?php
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

				if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
					$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);					
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); if($swatches_var){echo ' swatches_item';}?>">												
						<td class="product-thumbnail">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
									echo $thumbnail; // PHPCS: XSS ok.
							} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}
							?>
						</td>

						<td class="cart-product-details">
							<table>
								<tr>
									<td colspan="2" class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
										
										<?php
										if (!$product_permalink) {
											echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '';
										} else {
											echo apply_filters('woocommerce_cart_item_name', sprintf('<h5><a href="%s">%s</a></h5>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key);
										}

										//do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
										// Meta data.
										echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.
										// Backorder notification.
										if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
										}
										?>                                                                      
									</td>
									<td class="product-subtotal-quantity">
										<table>
											<tr>
												<td class="product-subtotal" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
													<?php
													echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
													?>
												</td>
											</tr>
											<tr>
												<td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
													<?php
													if ($_product->is_sold_individually() || $swatches_var) {
														$product_quantity = sprintf('<span class="qty-sw">1</span> <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
													} else {
														$product_id = $cart_item['product_id'];
														$minimum_inventory = get_field('minimum_inventory', $product_id);
														if(empty($minimum_inventory))
															$minimum_inventory = 0;
														$product_quantity = woocommerce_quantity_input(array(
															'input_name' => "cart[{$cart_item_key}][qty]",
															'input_value' => $cart_item['quantity'],
															'max_value' => $_product->get_max_purchase_quantity(),
															'min_value' => $minimum_inventory,
															'product_name' => $_product->get_name(),
																), $_product, false);
													}

													echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
													?>
												</td>															
								</tr>
										</table>
									</td>
								</tr>
								
							</table>
						</td>
					</tr>                                                    
					<?php
				}
			}
			?>

			<?php do_action('woocommerce_cart_contents'); ?>
			
		</tbody>
	</table>

		

		<button style="display:none;" type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button> 

					<?php do_action('woocommerce_cart_actions'); ?>

					<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

					<?php do_action('woocommerce_after_cart_contents'); ?>
		
	<?php do_action('woocommerce_after_cart_table'); ?>
</form>

<div class="cart-collaterals">
	<?php
	/**
	 * Cart collaterals hook.
	 *
	 * @hooked woocommerce_cross_sell_display
	 * @hooked woocommerce_cart_totals - 10
	 */
	do_action('woocommerce_cart_collaterals');
	?>
	<?php do_action('woocommerce_after_cart'); ?>
</div>
<?php
}?>

<?php do_action( 'woocommerce_after_cart' ); ?>
