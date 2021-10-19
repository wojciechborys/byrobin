<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


get_header(); 
$byvp_logo = get_field('byvp_logo');
?>

<!-- about content start -->
<section class="about-pg">

	<!-- intro section start -->
	<div class="aboutIntro-box pt-180">
		<div class="wrapp">
			<div class="content-box">
				<h1><?php the_title();?></h1>
				<?php the_content();?>
				<?php if(!empty($byvp_logo)){?>
				<div class="rightImg"><img src="<?php echo $byvp_logo['url'];?>" alt="<?php echo $byvp_logo['alt'];?>"></div>
				<?php }?>
			</div>
		</div>
	</div>
	<!-- intro section end -->
	
	<?php 
		if ( have_rows( 'flexible_content' ) ) : 
			while ( have_rows('flexible_content' ) ) : the_row();
				if(get_row_layout() == 'image_content' ):
					$image = get_sub_field('image');
					$circle_text = get_sub_field('circle_text');
					$is_display_content_area_below_image = get_sub_field('is_display_content_area_below_image');
					if($is_display_content_area_below_image){
						$title = get_sub_field('title');
						$info = get_sub_field('info');
						$cta_button = get_sub_field('cta_button');
					}
	?>
					<!-- centerImage start -->
					<section class="centerImage-box has-circle-text left-bottom">
						<div class="inner wrapp">
							<?php if(!empty($image)){?>
								<div class="imageCircle-text">
									<?php if(!empty($circle_text))echo '<div class="circle-text">'.$circle_text.'</div>';?>									
									
									<div class="section-img to-scale">
										<img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
									</div>										
								</div>
							<?php }?>
							<?php if($is_display_content_area_below_image){	?>
									<div class="section-content to-stagger-set">
										<?php if(!empty($title))echo '<h2 class="title to-stagger-first">'.$title.'</h2>';?>
										<?php if(!empty($info))echo '<p class="description to-stagger">'.$info.'</p>';?>
										<?php 
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
							<?php }?>
						</div>
					</section>
				<!-- centerImage end -->				
	<?php
				endif;
				
				if(get_row_layout() == 'testimonial_section' ):
					$quote_text = get_sub_field('quote_text');
					$author_text = get_sub_field('author_text');
	?>
					<section class="testimonial-box">
						<div class="inner wrapp">
							<div class="testimonial-content">
								<?php 
									if(!empty($quote_text))echo '<h2>'.$quote_text.'</h2>';
									if(!empty($author_text))echo '<div class="authorName">'.$author_text.'</div>';
								?>
							</div>
						</div>
					</section>
	<?php
				endif;
			endwhile;
		endif;
	?>

</section>
<!-- about content start -->

<?php get_footer(); ?>