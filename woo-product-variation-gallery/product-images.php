<?php
/**
 * Single Product Images
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    3.6.5
 *
 * @var $product WC_Product
 */


use Rtwpvg\Helpers\Functions;

global $img_gallery, $product;


defined('ABSPATH') || exit;
if($img_gallery)exit;
	
	$img_gallery = true;
	
$img = get_the_post_thumbnail_url();
?>
<div class="galleryList swiper-container swiper-images" id="gallery-img">
	<div class="swiper-wrapper">
		<?php if(!empty($img)){ ?>
		<div class="list-item swiper-slide">
			<div class="media-box has-image">
				<div class="img-box"><img src="<?php echo $img;?>"></div>
			</div>
			<div class="swiper-pagination"></div>
		</div>

	<?php }
		get_product_gallery_images();
	?> 

</div>

</div>