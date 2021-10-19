<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package robin
 */

$footer_logo = get_field('footer_logo', 'option');
$logo_below_text = get_field('logo_below_text', 'option');
$address_section_label = get_field('address_section_label', 'option');
$address = get_field('address', 'option');
$contact_section_label = get_field('contact_section_label', 'option');
$contact_info = get_field('contact_info', 'option');
$social_section_label = get_field('social_section_label', 'option');
$social_section = get_field('social_section', 'option');
$rightside_logo = get_field('rightside_logo', 'option');
$rightside_logo_link = get_field('rightside_logo_link', 'option');
$mailchimp_form_shortcode = get_field('mailchimp_form_shortcode', 'option');
$footer_links = get_field('footer_links', 'option');
$copyright_text = get_field('copyright_text', 'option');
?>
		
		<!-- socialCart relative start -->
    <div class="socialCart-box">
      <div class="inner">          
			<?php 
				if(!empty($social_section)){
					echo '<div class="social-box"><ul>';
					foreach($social_section as $ss_key => $ss_value){
				?>
						<li><a href="<?php echo $ss_value['link'];?>" target="_blank" class="circle-button" ><img src="<?php echo $ss_value['icon']['url'];?>" alt="<?php echo $ss_value['icon']['alt'];?>"></a></li>
				<?php 
					}
					echo '</ul></div>';
				}
				if(!(is_cart() || is_checkout())){
			?>
			<div class="cart-box">
			  <span class="circle-button medium-size cart-trigger 1">
				<span>
				<?php if(WC()->cart->get_cart_contents_count() == 0){?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/cart-icon.svg" alt="">
				<?php }else{echo WC()->cart->get_cart_contents_count();}?>
				</span>
			</span>
			</div>
			<?php }?>
      </div>
    </div>
    <!-- socialCart relative end -->

    <!-- footer start -->
	  <footer class="footer-bottom">
			<div class="inner wrapp">

				<div class="footer-content-top ">
					<div class="footer-wrap">
						<div class="left-box">
							<?php if(!empty($footer_logo)){?>
								<a href="<?php echo esc_url(home_url('/'));?>" class="footer-logo">
									<img src="<?php echo $footer_logo['url'];?>" alt="<?php echo $footer_logo['alt'];?>">
								</a>
							<?php }
								if(!empty($logo_below_text)){
							?>
									<div class="info-box">
										<p><?php echo $logo_below_text;?></p>
										<span class="line"></span>
									</div>
							<?php }?>
						</div>
						<div class="right-box">
							<div class="footer-contact-details">
								<?php if(!empty($address_section_label) || !empty($address)){?>
										<div class="address-box">
											<?php 
												if(!empty($address_section_label))echo '<h5>'.$address_section_label.'</h5>';
												if(!empty($address))echo '<div class="info-box">'.$address.'</div>';
											?>
										</div>
								<?php }
									if(!empty($contact_section_label) || !empty($contact_info)){?>
										<div class="contact-box">
											<?php 
												if(!empty($contact_section_label))echo '<h5>'.$contact_section_label.'</h5>';
												if(!empty($contact_info))echo '<div class="info-box">'.$contact_info.'</div>';
											?>
										</div>
								<?php }
									if(!empty($social_section_label) || !empty($social_section)){?>
										<div class="social-box hideless-tablet showless-mobile">
											<?php 
												if(!empty($social_section_label))echo '<h5>'.$social_section_label.'</h5>';
												if(!empty($social_section)){
													echo '<ul class="socialLinks">';
													foreach($social_section as $ss_key => $ss_value){
											?>
														<li><a href="<?php echo $ss_value['link'];?>" target="_blank"><img class="svg" src="<?php echo $ss_value['icon']['url'];?>" alt="<?php echo $ss_value['icon']['alt'];?>"></a></li>
											<?php 
													}
													echo '</ul>';
												}
											?>
										</div>
								<?php }
									if(!empty($rightside_logo)){
								?>
										<div class="circle-logo hideless-tablet">
											<?php if(!empty($rightside_logo_link))echo '<a href="'.$rightside_logo_link.'" target="_blank">';?>
												<img src="<?php echo $rightside_logo['url'];?>" alt="<?php echo $rightside_logo['alt'];?>">
											<?php if(!empty($rightside_logo_link))echo '</a>';?>
										</div>
								<?php }?>
							</div>
						</div>
					</div>

				</div>
				<div class="footer-content-bottom">
					<div class="footer-wrap">
						<?php
							if(!empty($mailchimp_form_shortcode))echo '<div class="left-box"> 
							
								<div class="form-box subscribe-form">
								'.$mailchimp_form_shortcode.'
								</div>
							</div>';
							if(!empty($footer_links)){
								$c_ye = date('Y');
								echo '<div class="right-box">
										<div class="footer-linkWrap hideless-tablet">';
								foreach($footer_links as $f_key => $f_value){
									$link = $f_value['link'];
									$target = $link['target'];
									if(empty($target))
										$target = '_self';
									$title = $link['title'];
									$title = str_replace('##YEAR##', $c_ye, $title);
						?>
									<a href="<?php echo $link['url'];?>" target="<?php echo $target;?>" class="footer-link"><?php echo $title;?></a>
						<?php 
								}
								echo '</div>

									<div class="social-box showless-tablet hideless-mobile">
										'?>
											<?php 
											if(!empty($social_section)){
												echo '<ul class="socialLinks">';
												foreach($social_section as $ss_key => $ss_value){
											?>
													<li><a href="<?php echo $ss_value['link'];?>" target="_blank" class="circle-button" ><img src="<?php echo $ss_value['icon']['url'];?>" class="svg" alt="<?php echo $ss_value['icon']['alt'];?>"></a></li>
											<?php 
												}
												echo '</ul>';
											}
										?>
										<?php echo'
									</div>

								</div>';
							}
						?>
					</div>
				</div>

				<div class="last-footer showless-tablet">
					<div class="footer-wrap">
						<?php if(!empty($copyright_text)){
								$target = $copyright_text['target'];
								if(empty($target))
									$target = '_self';
						?>
							<div class="left-box footer-linkWrap showless-tablet">									
								<a href="<?php echo $copyright_text['url'];?>" target="<?php echo $target;?>" class="footer-link"><?php echo str_replace('##YEAR##', $c_ye, $copyright_text['title']);?></a>
							</div>
						<?php 
							}
							if(!empty($rightside_logo)){
							?>
								<div class="right-box circle-logo showless-tablet ">
									<?php if(!empty($rightside_logo_link))echo '<a href="'.$rightside_logo_link.'" target="_blank">';?>
										<img src="<?php echo $rightside_logo['url'];?>" alt="<?php echo $rightside_logo['alt'];?>">
									<?php if(!empty($rightside_logo_link))echo '</a>';?>
								</div>
						<?php }?>
					</div>
				</div>

			</div>
		</footer>
		<!-- footer end -->
		

	</div>
</main>


<!-- socialCart start -->
<div class="socialCart-box is-sticky">
  <div class="inner">
	<div class="social-box">
		<?php 
			if(!empty($social_section)){
				echo '<ul class="socialLinks">';
				foreach($social_section as $ss_key => $ss_value){
			?>
					<li><a href="<?php echo $ss_value['link'];?>" target="_blank" class="circle-button" ><img src="<?php echo $ss_value['icon']['url'];?>" alt="<?php echo $ss_value['icon']['alt'];?>"></a></li>
			<?php 
				}
				echo '</ul>';
			}
		?>
	</div>
	<?php if(!(is_cart() || is_checkout())){?>
	<div class="cart-box">
	  <span class="circle-button medium-size cart-trigger">
		<span>
			<?php if(WC()->cart->get_cart_contents_count() == 0){?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/cart-icon.svg" alt="">
				<?php }else{echo WC()->cart->get_cart_contents_count();}?>
		</span>
	</span>
	</div>
	<?php }?>
  </div>
</div>


</div><!-- #page -->

<?php wp_footer(); ?>
<script>
	/*cart popup script start*/


	$(document).on('keyup click', function (e) {
		var close = $('.cartPopup .close-btn');
		if($(e.target).is('.cart-trigger') || $(e.target).is('.cart-trigger img')) {
			$('body').addClass('cartPopup-open');
			$('body').addClass('popupOpen');
		}
		if (e.keyCode === 27) {
			if($('body').hasClass('cartPopup-open')) {
			$('body').removeClass('cartPopup-open');
			$('body').removeClass('popupOpen');
			}
		} /*else if (close.is(e.target)) {
			$('body').removeClass('cartPopup-open');
			$('body').removeClass('popupOpen');
		}*/
		$(close).click(function() {
			$('body').removeClass('cartPopup-open');
			$('body').removeClass('popupOpen');
		})
	})
	/*cart popup script end*/
</script>

</body>
</html>
