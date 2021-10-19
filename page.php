<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package robin
 */

get_header();

	global $wp;
    $request = explode( '/', $wp->request );

     if( ( is_account_page() ) ){
?>
	
		<div class="profile-wrapper"><?php the_content();?></div>
		
<?php
	}elseif(is_cart()){
		?>


			<div class="cart-pg pt-180">
				<div class="inner wrapp">

					<div class="cartMain-wrap">

						<?php the_content();?>

					</div>

				</div>
			</div>

		<?php
	}
	elseif(is_wc_endpoint_url( 'order-received' )){
	?>
		<div class="cart-pg pt-180">
			<div class="inner wrapp">
				<div class="cartMain-wrap">
					
					
					
					<div class="success-msg-box-wrapper">
						<?php checkout_stepbox();?>
						<div class="success-msg-box">
						<img src="http://staging.project-progress.net/projects/robin/wp-content/themes/robin/assets/images/round-with-check.svg">
						<h2>We received your order</h2>
						<p>You should receive a confirmation email from us very soon.<br> In the meantime you can check out or social meadi :)</p>
					<?php 
						
					$social_section = get_field('social_section', 'option');
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
					</div>
					
				</div>
			</div>
		</div>
	<?php
	}
	elseif(is_checkout()){
		?>


			<div class="cart-pg checkOut-pg pt-180">
				<div class="inner wrapp">

					<?php the_content();?>

				</div>
			</div>

		<?php
	}	
	else{


		$cls_nm = 'right-content-wrapper';
		$is_table_structure_in_content = get_field('is_table_structure_in_content');
		if($is_table_structure_in_content)
			$cls_nm = 'shipping-content-wrapper shipping-table';
?>
		<div class="left-title-right-content-sec">
			<div class="wrapp">
				<div class="row">
					<div class="col-5">
						<h2><?php the_title();?></h2>
					</div>
					<div class="col-7">
						<div class="<?php echo $cls_nm;?>">	
							<?php the_content();?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}
get_footer();
?>
