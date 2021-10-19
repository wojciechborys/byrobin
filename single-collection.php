<?php
/**
 * Template Name: Collection Detail Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header(); 
$img = get_the_post_thumbnail_url();
$sub_title = get_field('sub_title');
?>

<!-- collectionDetail content start -->
<div class="collectionDetail-pg">
               
   <!-- comingSoon style start -->
	<section class="banner-box collectionDetail-banner media-box">
		<div class="bannerSlider ">
			<div class="slide-item">
				<div class="bg-box" style="background-image: url(<?php echo $img;?>);"></div>
				<div class="content-box intro-box wrapp align-center">
					<?php if(!empty($sub_title))echo '<div class="subHeading">'.$sub_title.'</div>';?>
					<div class="heading"><?php the_title();?></div>
					<div class="hasScroll">
						<a class="scrollToNext" href="#scrollNext">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/scrollNext.svg" class="svg" alt="">
						</a>
					</div>
				</div>
			</div>         
		</div>
	</section>
   <!-- comingSoon style end -->   
   
<?php
	$j = 0;
	$ii = 1;
	$product_listing = get_field('product_listing');
	if(!empty($product_listing)){
		$products_section = get_field('products_section');
		$args = array('post_type' => 'product', 'post_status' => 'publish', 'post__in' => $product_listing, 'orderby' => 'post__in');
		$query = new WP_Query($args);	
		if ($query->have_posts()):
			echo '<div class="shopProductList-main collectionList-main"  id="scrollNext">
					  <div class="inner wrapp">
						 <ul class="productList-box">';
			while ($query->have_posts()): $query->the_post();
				$j++;
				$img = get_the_post_thumbnail_url();
				
				if($j != 1){
					$ii++;
					wc_get_template_part( 'content', 'product' );
				}
				
				$shop_flag = false;
				if(!empty($products_section))
				{
					foreach($products_section as $ps_key => $ps_value){
						if($ii == $ps_value['product_position']){
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
				if($shop_flag){
					$ii++;
?>
					<li class="product <?php echo $li_cls;?>">
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
						</div>
					</li>
<?php
				}
				if($j == 1){
					$ii++;
					wc_get_template_part( 'content', 'product' );
				}
	
			endwhile;
			echo '</ul>
			  </div>
			</div>';
		endif;
	}
?>

</div>
<!-- collectionDetail content end -->

<?php get_footer(); ?>