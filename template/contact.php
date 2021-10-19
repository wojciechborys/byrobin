<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header(); 
		$column_1_detail = get_field('column_1_detail');
		$column_2_detail = get_field('column_2_detail');
?>
<div class="left-title-right-content-sec">
	<div class="wrapp">
		<div class="row">
			<div class="col-5">
				<h2><?php the_title();?></h2>
			</div>
			<div class="col-7">
				<div class="right-content-wrapper">
					<?php 
						the_content();
						if(!empty($column_1_detail) || !empty($column_2_detail)){
							echo '<div class="contact-content-wrapper">
									<div class="row">';
									
							if(!empty($column_1_detail))echo '<div class="col-6">'.$column_1_detail.'</div>';
							if(!empty($column_2_detail))echo '<div class="col-6">'.$column_2_detail.'</div>';
									
							echo '</div>
								</div>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
?>