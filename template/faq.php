<?php
/**
 * Template Name: FAQ Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


get_header();
$contact_section_label = get_field('contact_section_label', 'option');
$contact_info = get_field('contact_info', 'option'); 
$accordion_section = get_field('accordion_section'); 
?>

<div class="left-title-right-content-sec">
	<div class="wrapp">
		<div class="row">
			<div class="col-5">
				<div class="faq-content">
					<h2><?php the_title();?></h2>
					<?php 
						if(!empty($contact_section_label) || !empty($contact_info)){?>
							<div class="faq-contact-content-wrapper">
								<?php 
									if(!empty($contact_section_label))echo '<h3>'.$contact_section_label.'</h3>';
									if(!empty($contact_info))echo '<div class="info-box">'.$contact_info.'</div>';
								?>
							</div>
					<?php }?>
				</div>
			</div>
			<?php
				if(!empty($accordion_section)){
					echo '<div class="col-7">
							<div class="right-content-wrapper">
								<ul class="accordion">';
					foreach($accordion_section as $as_key => $as_value){
			?>
						<li>
							<a class="toggle" href="javascript:void(0);"><?php echo $as_value['title'];?></a>
						    <div class="inner">
								<?php echo $as_value['content'];?>
						    </div>
						</li>
			<?php
					}
					echo '</ul>
						</div>
					</div>';
				}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>