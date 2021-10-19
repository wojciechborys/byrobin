<?php
/**
 * Template Name: Coming Soon Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header(); 

global $device_type;

$banner_image = get_field('banner_image');
if($device_type == 'mobile')
	$banner_image = get_field('mobile_banner_image');
if(empty($banner_image))
	$banner_image = get_field('banner_image');
$banner_sub_title = get_field('banner_sub_title');
$banner_title = get_field('banner_title');
$sil_section_title = get_field('sil_section_title');
$sil_section_sub_title = get_field('sil_section_sub_title');
$sil_section_content = get_field('sil_section_content');
$sil_form_shortcode = get_field('sil_form_shortcode');
$left_side_image = get_field('left_side_image');
$right_side_content = get_field('right_side_content');
?>

<!-- comingSoon content start -->
<div class="comingSoon-pg">

      <!-- comingSoon banner start -->
      <section class="banner-box comingSoon-banner media-box">
         <div class="bannerSlider">
            <div class="slide-item">
				<?php if(!empty($banner_image)){?>
					<div class="bg-box" style="background-image: url(<?php echo $banner_image['url'];?>);"></div>
				<?php }?>
				<div class="content-box intro-box wrapp align-center">
					<?php 
						if(!empty($banner_sub_title))echo '<div class="subHeading">'.$banner_sub_title.'</div>';
						if(!empty($banner_title))echo '<div class="heading">'.$banner_title.'</div>';
					?>
					<div class="hasScroll">
                        <a class="scrollToNext" href="#scrollNext">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/scrollNext.svg" class="svg" alt="">
                        </a>
					</div>
				</div>
            </div>
         </div>
      </section>
      <!-- comingSoon banner end -->

      <!-- comingSoonContent section start -->
      <div class="left-title-right-content-sec stayInLoop has-arrow" id="scrollNext">
         <div class="wrapp">
            <div class="row">
                  <div class="col-5">
                     <div class="faq-content">
						<?php 
							if(!empty($sil_section_title))echo '<h2>'.$sil_section_title.'</h2>';
							if(!empty($sil_section_sub_title))echo '<p>'.$sil_section_sub_title.'</p>';
						?>				
                     </div>
                  </div>
                  <div class="col-7">
                     <div class="right-content-wrapper content-box">
                        <?php
							echo $sil_section_content;
                        if(!empty($sil_form_shortcode))echo '
                              <div class="form-box subscribe-form">
                              '.$sil_form_shortcode.'
                              </div>
                           ';
                        ?>
                     </div>
                  </div>
            </div>
         </div>
      </div>
      <!-- comingSoonContent section end -->
   
      <!-- liveSoon section start -->
      <div class="liveSoon-main">
         <div class="inner wrapp">
            <hr>
            <div class="liveSoon-box">
				<?php if(!empty($left_side_image)){?>
                  <div class="img-box">
                     <img src="<?php echo $left_side_image['url'];?>" alt="<?php echo $left_side_image['alt'];?>">
                  </div>
				<?php }?>
                  <div class="content-box">
					<?php echo $right_side_content;?>                     
                  </div>
            </div>
         </div>
      </div>
      <!-- liveSoon section end -->


</div>
<!-- comingSoon content end -->




<?php get_footer(); ?>