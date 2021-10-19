<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>

<?php
	foreach ( $customer_orders->orders as $customer_order ) {
		$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$item_count = $order->get_item_count() - $order->get_item_count_refunded();
		$username = $order->get_billing_first_name(). ' '. $order->get_billing_last_name();
		
		$address = '';
		$company = $order->get_billing_company();
		if(!empty($company))
			$address .= $company;
		
		$billing_address_1 = $order->get_billing_address_1();
		if(!empty($billing_address_1))
			$address .= " / ".$billing_address_1;
		
		$billing_address_2 = $order->get_billing_address_2();
		if(!empty($billing_address_2))
			$address .= " / ". $billing_address_2;
		
		$city = $order->get_billing_city();
		if(!empty($city))
			$address .= " / ".$city;
		
		$state = $order->get_billing_state();
		if(!empty($state))
			$address .= " / ".$state;
		
		$postcode = $order->get_billing_postcode();
		if(!empty($postcode))
			$address .= " / ".$postcode;
		
		$country = $order->get_billing_country();
		if(!empty($country))
			$address .= " / ".$country;
		
?>
		<div class="order-detail-wrap">
			<div class="order-detail-first">
				<div class="row">
					<div class="col-4">
						<div class="order-id">
							<p>Order <?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?> - <?php echo $order->get_date_created()->format( 'd/m/y H:i' );?></p>
						</div>
					</div>
					<div class="col-8">
						<div class="order-person-detail">
							<?php if(!empty($username))echo '<p>'.$username.'</p>';?>
							<?php if(!empty($address))echo '<p>'.$address.'</p>'; ?>
						</div>
					</div>
				</div>
			</div>
			<?php 
				$order_items = $order->get_items();
				$it_count = count($order_items);
				$ij = 0;
				foreach ( $order_items as $item_id => $item ) {
					$ij++;
					$qty          = $item->get_quantity();
					$refunded_qty = $order->get_qty_refunded_for_item( $item_id );
					if ( $refunded_qty ) {
						$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
					} else {
						$qty_display = esc_html( $qty );
					}		
					$product = $item->get_product();
					$is_visible        = $product && $product->is_visible();
					$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
					$image = wp_get_attachment_image_src( $product->get_image_id(), 'thumbnail' );
					
			?>
				<div class="order-detail-second">
					<div class="row">
						<div class="col-4">
							<div class="order-img-specification">
								<?php if(!empty($image)){?>
								<img src="<?php echo $image[0];?>" alt="">
								<?php }?>
								<div class="order-specification">
									<?php echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ) );?>										
									<?php 
										echo '<p>';
										$j = 0;
										foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) { 
											$j++;
											if($j != 1)
												echo '</p><p>';
											$value = $args['autop'] ? wp_kses_post( $meta->display_value ) : wp_kses_post( make_clickable( trim( strip_tags( $meta->display_value ) ) ) ); 
											echo $value;
										} 
										if($j != 0)
											echo ' | x'.$qty_display. '</p>';
										else
											echo 'x'.$qty_display. '</p>';											
									?>
								</div>
							</div>
						</div>
						<?php if($it_count == $ij){?>
						<div class="col-8">
							<div class="oreder-extra-detail">
								<p><?php echo $order->get_formatted_order_total();?></p>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="download-invoice">Download invoice</a>
							</div>
						</div>
						<?php }?>
					</div>
				</div>
			<?php }?>
		</div>
<?php }?>

	

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>

