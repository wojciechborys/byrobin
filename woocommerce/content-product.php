<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $device_type;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$page_id = woocommerce_get_page_id('shop');
if($device_type == 'mobile')
	$products_section = get_field('mobile_products_section', $page_id);
else
	$products_section = get_field('products_section', $page_id);

if($device_type == 'mobile' && empty($products_section))
	$products_section = get_field('products_section', $page_id);

global $pl_i;
$shop_flag = false;
$position_percentage = '';
$li_cls = '';
if(!empty($products_section))
{
	foreach($products_section as $ps_key => $ps_value){
		if($pl_i == $ps_value['product_position'] && is_shop()){
			$shop_flag = true;
			$position_percentage = $ps_value['position_percentage'];
			$placeholder_image = $ps_value['placeholder_image'];
			$place_point_section = $ps_value['place_point_section'];
			$li_cls = 'column-full has-maping';
			if($position_percentage == 'two_third')
				$li_cls = 'column-span-2 has-maping';
		}
			
	}
}
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if($shop_flag && $paged == 1){
?>
<li <?php wc_product_class( $li_cls, $product ); ?>>

	<div class="productList-card <?php echo $position_percentage;?>">
        <div class="img-box">
			<?php if(!empty($placeholder_image)){?>
				<img src="<?php echo $placeholder_image['url'];?>" alt="<?php echo $placeholder_image['alt'];?>">
			<?php }?>

			<!-- mapPoint start -->
			<?php 
				if(!empty($place_point_section)){
					foreach($place_point_section as $pl_key => $pl_value){
						$pinpoint_coordinate = explode(',', $pl_value['pinpoint_coordinate']);
						$product = $pl_value['product'];
						$product = new WC_product($product);
						$image = wp_get_attachment_image_src( $product->get_image_id(), 'thumbnail' )[0];						
			?>
						<div class="mapPoint" style="top: <?php echo $pinpoint_coordinate[1];?>; left: <?php echo $pinpoint_coordinate[0];?>;">
							<div class="point-trigger">
								<svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
									<g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
										<path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"></path>
										<path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"></path>
									</g>
								</svg>
							</div>

							<div class="mapPointerDetail">
								<?php if(!empty($image)){?>
									<div class="mapPointerImg">
										<img src="<?php echo $image;?>" alt="">
									</div>
								<?php }?>
								<div class="mapPointerInfo">
									<div class="pointerTitle"><?php echo $product->name;?></div>
									<div class="pointerPrice"><?php echo $product->get_price_html();?></div>
									<a href="<?php echo get_the_permalink($product->id);?>" class="link">Shop</a>
								</div>
							</div>
						</div>
			<?php
					}
				}
			?>
            <!-- mapPoint end -->

        </div>

        <?php /*?><div class="info-box">
            <div class="title">Minimalist Van Bommel Bag</div>
            <div class="price">
                <span class="woocommerce-Price-amount amount">
                    <bdi><span class="woocommerce-Price-currencySymbol">€</span>80.00</bdi>
                </span>
            </div>
        </div><?php */?>
    </div>

</li>
<?php
}//else{
?>
	<li <?php wc_product_class( '', $product ); ?>>		
		<?php 
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		 do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */

		 do_action( 'woocommerce_before_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		 do_action( 'woocommerce_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		 do_action( 'woocommerce_after_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		 do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</li>
<?php 
//}
?>