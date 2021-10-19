<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package robin
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php 
	$is_black_menu = get_field('is_black_menu');
	$cls_m = 'white-menu';
	if($is_black_menu)
		$cls_m = 'black-menu';
?>

<body <?php body_class($cls_m); ?>>
<?php wp_body_open(); ?>
<div id="page" class="siteWrapper">

	<?php if(get_the_ID() != 264){?>
    <!-- header top start -->
    <header class="header-top" id="navbar">
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'menu-1',
          'menu_id'        => 'primary-menu',
        )
      );
      ?>
      
    </header>
    <!-- header top end -->
	<?php }?>

     <!-- site loader start -->
    <div class="site-loader">
        <div class="clock">
            <div class="minutes"></div>
            <div class="hours"></div>
        </div>
        <div class="labelText">LOADING...</div>
    </div>
    <!-- site loader end -->

     <!-- popupDark-overlay start -->
    <div class="popupDark-overlay"></div>
    <!-- popupDark-overlay end -->

    <?php
		echo do_shortcode('[wc_login_form][/wc_login_form]');    
		echo do_shortcode('[Register_form][/Register_form]');	
	?>
    
    
    <!-- search popup start -->
    <div class="formPopup searchPopup">
        <div class="inner-wrap">
            <div class="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
                    <g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
                        <path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                        <path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                    </g>
                </svg>
            </div>
            <div class="formBox">
                <form id="se_frm">
                    <input type="text" id="search-input" class="search-input" placeholder="Find what you’re looking for" value="" style="width: 100%;" autofocus>
                </form>
            </div>
            <div class="result-box search-box-results" style="display:none">
            </div>
        </div>
    </div>
    <!-- search popup end -->



	<?php if(is_post_type_archive('product') || is_product_category()){?>
    <!-- shoFilterPopup  start -->
    <div class="formPopup shoFilterPopup">
		<div class="inner-wrap">
			<div class="close-btn">
				<svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
					<g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
						<path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
						<path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
					</g>
				</svg>
			</div>
			<?php dynamic_sidebar( 'sidebar-shop-filter' ); ?>
		</div>		
    </div>
    <!-- shoFilterPopup  end -->
	<?php }?>

	<?php if(!(is_cart() || is_checkout())){?>
    <!-- cart popup start -->
    <div class="formPopup cartPopup">
        
		
		<div class="inner-wrap">
            <div class="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
                    <g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
                        <path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                        <path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                    </g>
                </svg>
            </div>
      
			
			<?php if (!is_page(array('cart'))) { ?>
			<div class="mini-header-cart1 entry-content" style="display:block;">                        
				<div class="woocommerce">
					
						<?php if (WC()->cart->get_cart_contents_count() == 0) {
								$cart_empty_text = get_field('cart_empty_text', 'option');
								if(!empty($cart_empty_text))echo '<div class="cartEmpty"><p class="return-to-shop">'.$cart_empty_text.'</p>';
													
								$continue_shopping_cta_button = get_field('continue_shopping_cta_button', 'option');
								if(!empty($continue_shopping_cta_button)){
									$target = $continue_shopping_cta_button['target'];
									if(empty($target))
										$target = '_self';
						?>
								<a class="button wc-backward" target="<?php echo $target;?>" href="<?php echo $continue_shopping_cta_button['url'];?>" title="<?php echo $continue_shopping_cta_button['title'];?>"><?php echo $continue_shopping_cta_button['title'];?></a>

						<?php								
								}
								if(!empty($cart_empty_text))echo '</div>';
								
							} else {
					
						do_action('woocommerce_before_cart');
											                      
						?>
						<div class="heading-top">
							<h4>Shopping Bag</h4>
							<a href="javascript:void(0);" id="clear_cart">Empty cart</a>
						</div>
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
											$swatches_var = get_field('is_sample_swatches_product', $product_id);
											if($swatches_var)
												$product_permalink = '';
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
						
					<?php } ?>
				</div>
				<?php } ?>
			
			</div>		
		</div>
	</div>
    <!-- cart popup end -->
	<?php }?>


    <!-- AccountPopup start -->
    <div class="formPopup accountPopup">
        <div class="inner-wrap">

            <div class="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
                    <g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
                        <path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                        <path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                    </g>
                </svg>
            </div>

            <div class="form-box">
                <?php
					wp_nav_menu(
						array(
							'menu' => 'Account Menu',
							'menu_id' => 'account-menu',
						)
					);
					
					$my_account_cta_button = get_field('my_account_cta_button', 'option');
					if(!empty($my_account_cta_button)){
						$target = $my_account_cta_button['target'];
						if(empty($target))
							$target = '_self';
				?>
						<div class="button-box">
							<a href="<?php echo $my_account_cta_button['url'];?>" target="<?php echo $target;?>"  class="button"><?php echo $my_account_cta_button['title'];?></a>
						</div>						
				<?php
					}
				?>
            </div>

        </div>
    </div>
    <!-- AccountPopup end -->


    <!-- forgotPassPopup start -->
    <div class="formPopup forgotPassPopup">
        <div class="inner-wrap">

            <div class="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
                    <g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
                        <path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                        <path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                    </g>
                </svg>
            </div>

            <div class="form-box">
                <form id="forgotPass" action="forgot-pwd" method="post" class="form">
					<?php wp_nonce_field( 'ajax-forgot-pwd-nonce', 'security_forgot' ); ?>
					<div class="form-group input-group">
					   <div class="input-wrap">
	                       <input id="username_login" class="form-input" name="username" type="text" required="">
	                       <label class="form-label" for="username-login">Email address</label>
	                       <span class="resetTrigger"></span>                  
	                   </div>
					   <p class="field-error error-msg"></p>
					</div>
					
					<div class="form-group submit-box">
						<button class="button submit-button">Submit</button>
					</div>
					<div class="form-group notification-box">
						<p class="status mt-3 mb-0 text-center"></p>
					</div>
				 </form>
            </div>

        </div>
    </div>
    <!-- forgotPassPopup end -->
	

	<?php if(is_product()){
		$popup_content_type = get_field('popup_content_type', 'option');
		$popup_image = get_field('popup_image', 'option');
		$popup_title = get_field('popup_title', 'option');
		$popup_content = get_field('popup_content', 'option');
	?>
    <!-- sizeguidPopup start -->
    <div class="formPopup sizeguidPopup">
        <div class="inner-wrap">

            <div class="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
                    <g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
                        <path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                        <path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                    </g>
                </svg>
            </div>

            <div class="form-box">
				<?php if($popup_content_type == 'image' && !empty($popup_image)){?>
					<div class="image-box">
						<img src="<?php echo $popup_image['url'];?>" alt="<?php echo $popup_image['alt'];?>">
					</div>
				<?php }else{?>
					<div class="content-box">
						<?php 
							if(!empty($popup_title))echo '<h5>'.$popup_title.'</h5>';
							echo $popup_content;
						?>
					</div>
				<?php }?>
            </div>

        </div>
    </div>
    <!-- sizeguidPopup end -->
	<?php }?>



    <!-- scroll main container start -->
    <main id="scrollbar-wrap" class="scrollbar-wrap">
        <div class="main-inner wrap-product">