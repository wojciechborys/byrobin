<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : 
					if($attribute_name == 'pa_colours'){				
				?>
						<tr>						
							<td class="value">
								<div class="option-item colorOption">
									<?php
										if(!empty($options)){
											echo '<div class="colorList">
													<div class="listRow">';
											foreach($options as $p_key => $p_value){
												$t_term = get_term_by('slug', $p_value, $attribute_name);
												$p_id = $t_term->taxonomy.'_'.$t_term->term_id ;
												$color_code = get_field('color_code', $p_id);
									?>
											<div class="color-item"><a href="javascript:void(0);" class="color-attr" data-slug="<?php echo $p_value;?>"><span class="color" style="background-color: <?php echo $color_code;?>;"></span></a></div>
									<?php
											}
											echo '</div>
											</div>';
										}
									?>		
								</div>
								<div class="color-attribute" style="display:none;">
									<?php
										wc_dropdown_variation_attribute_options(
											array(
												'options'   => $options,
												'attribute' => $attribute_name,
												'product'   => $product,
												'show_option_none' => wc_attribute_label( $attribute_name ),
											)
										);
									?>
								</div>
							</td>
						</tr>
				<?php
					}else{
				?>
					<tr>						
						<td class="value">
							<?php 
								if($attribute_name == 'pa_select-size'){
							?>
								<a href="javascript:void(0);" class="size-guide">Size guide</a>
							<?php
								}
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
										'show_option_none' => 'Select '.strtolower(wc_attribute_label( $attribute_name )),
									)
								);
								echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
							?>
						</td>
					</tr>
				<?php }endforeach; ?>
			</tbody>
		</table>

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
