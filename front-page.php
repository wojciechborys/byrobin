<?php
/**
 * The template for displaying Home page
 *
 * This is the template default template for home page.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package WPthemes
 */
get_header();

$banner_section = get_field('banner_section');
$product_listing_flexible = get_field('product_listing_flexible');
$circular_text_m = get_field('circular_text');
?>


			<!-- home-banner start -->
			<?php 
				global $device_type;
				if(!empty($banner_section)){
					echo '<section class="banner-box home-banner media-box">
							<div class="bannerSlider is-slider">
								';
					foreach($banner_section as $bs_key => $bs_value){
						$image = $bs_value['image'];
						$mobile_image = $bs_value['mobile_image'];
						if(($device_type == 'mobile' || $device_type == 'tablet') && !empty($mobile_image))
							$image = $mobile_image;
						$title = $bs_value['title'];
						$sub_title = $bs_value['sub_title'];
						$cta_button = $bs_value['cta_button'];
						$content_position = $bs_value['content_position'];
						$cls_nm = '';
						if($content_position == 'left_side')
							$cls_nm = 'left-content';
						else if($content_position == 'right_side')
							$cls_nm = 'right-content';
			?>
						 <div class="slide-item">
                            <div class="bg-box" style="background-image: url(<?php echo $image['url'];?>);"></div>
                            <div class="content-box <?php echo $cls_nm;?> intro-box wrapp align-center">
								<div class="inner-wrap">
									<div class="slide-count"></div>
									<?php
										if(!empty($title))echo '<div class="heading">'.$title.'</div>';
										if(!empty($sub_title))echo '<p>'.$sub_title.'</p>';
										if(!empty($cta_button)){
											$target = $cta_button['target'];
											if(empty($target))
												$target = '_self';
									?>
											<a href="<?php echo $cta_button['url'];?>" target="<?php echo $target;?>" class="button"><?php echo $cta_button['title'];?></a>
									<?php
										}
									?>
								</div>
                            </div>
                        </div>
			<?php
					}
					echo '
												
						</div>
						<div class="slider-controls">
		                    <div class="dots-wrap"></div>
		                </div>
					</section>';
				}
			?>                    
            <!-- home-banner end -->
			
			<?php
				if ( have_rows( 'product_listing_flexible' ) ) : 
					while ( have_rows('product_listing_flexible' ) ) : the_row();
					
						if(get_row_layout() == 'single_product'):
							$block_position = get_sub_field('block_position');
							$circular_text = get_sub_field('circular_text');
							$image_label = get_sub_field('image_label');
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$info = get_sub_field('info');
							$cta_button = get_sub_field('cta_button');
							$cls_nm = 'section-product-left';
							if($block_position == 'right_side')
								$cls_nm = 'section-product-right';
			?>
							 <!-- section-product start -->
								<section class="section-product section-detail has-circle-text <?php echo $cls_nm;?> spacer-y-1x">
									<?php if(!empty($image_label)){?>
									<div class="introText">
										<div class="inner wrapp">
											<div class="heading"><?php echo $image_label;?></div>
										</div>
									</div>
								<?php }
										if(!empty($image) && !empty($circular_text)){
								?>
											<div class="imageCircle-text">
												<?php
													if(!empty($circular_text))echo '<div class="circle-text">'.$circular_text.'</div>';
													if(!empty($image)){
												?>
														<div class="section-img to-scale">
															<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
														</div>
												<?php
													}
												?>
											</div>
								<?php
										}
										elseif(!empty($image) && empty($circular_text)){
								?>
											<div class="section-img to-scale">
												<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
											</div>
								<?php
										}
								?>
									
									<div class="section-content to-stagger-set">
										<div class="inner wrapp">
											<?php 
												if(!empty($title))echo '<h2 class="title to-stagger-first">'.$title.'</h2>';
												if(!empty($info))echo '<p class="description to-stagger">'.$info.'</p>';
												if(!empty($cta_button)){
													$target = $cta_button['target'];
													if(empty($target))
														$target = '_self';
											?>
													<a href="<?php echo $cta_button['url'];?>" target="<?php echo $target;?>" class="button to-stagger"><?php echo $cta_button['title'];?></a>
											<?php
												}
											?>
										</div>
									</div>
								</section>
								<!-- section-product end -->
			<?php
						endif;
						
						if(get_row_layout() == 'multi_product_in_row'):
							$block_position = get_sub_field('block_position');
							$cls_nm = 'align-left';
							if($block_position == 'right_side')
								$cls_nm = 'align-right';
							$product_selection = get_sub_field('product_selection');
							
							if(!empty($product_selection)){
								
								$args = array('post_type' => 'product', 'posts_per_page' => -1, 'post__in' => $product_selection, 'post_status' => 'publish','orderby' => 'post__in');
								
								$query = new WP_Query($args);

								if ($query->have_posts()):
							?>
									<section class="productList-main <?php echo $cls_nm;?> spacer-y-2x">
										<div class="inner">
											<div class="productList-slider to-stagger-set-2">
							<?php 
									while ($query->have_posts()): $query->the_post();	
										$product = wc_get_product( get_the_ID() );
							?> 
										<div class="slide-item">
											<div class="productList-card to-stagger-first">
												<div class="img-box">
													<a href="<?php the_permalink();?>" title="<?php the_title();?>">
														<img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>">
													</a>
												</div>
												<div class="info-box">
													<a href="<?php the_permalink();?>" title="<?php the_title();?>">
														<div class="title"><?php the_title();?></div>
														<div class="price"><?php echo $product->get_price_html();?></div>
													</a>
												</div>
											</div>
										</div>
							<?php
									endwhile;
							?>
												
											</div>
										</div>
									</section>
							<?php
								endif;
								wp_reset_query();
							}
						endif;
						
					endwhile;
				endif;
			?>
            <!-- section-product end -->

		<!-- newsText start -->
		<?php 
			if(!empty($circular_text_m)){
				echo '<section class="newsText-main">
						<div id="newsText">
							<ul class="newsTopics">';
				foreach($circular_text_m as $ct_key => $ct_value){
		?>
					<li><?php echo $ct_value['text'];?></li>
		<?php
				}
				echo '</ul>
					</div>
				</section>';
			}
		?>
		<!-- newsText start -->

<?php 
get_footer(); ?>