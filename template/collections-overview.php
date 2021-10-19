<?php
/**
 * Template Name: Collections Overview
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


get_header(); 
	$number_of_post = get_field('number_of_post');
?>
<section class="collection-pg">
	<!-- intro section start -->
	<div class="left-title-right-content-sec intro-box has-arrow">
		<div class="wrapp">
			<div class="row">
				<div class="col-5">
					<div class="faq-content">
						<h2><?php the_title();?></h2>						
					</div>
				</div>
				<div class="col-7">
					<div class="right-content-wrapper content-box">
						<?php the_content();?>
					</div>
				</div>
			</div>
		</div>
		<div class="hasScroll">
			<a class="scrollToNext" href="#scrollNext">
	            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/scrollNext.svg" class="svg" alt="">
	        </a>
    	</div>
	</div>
	<!-- intro section end -->

	<div class="full-content" id="scrollNext">
	<?php
		$ii = 0;
		$args = array('post_type' => 'collection', 'posts_per_page' => $number_of_post, 'post_status' => 'publish', 'paged' => get_query_var('paged') ? get_query_var('paged') : 1);
		$query = new WP_Query($args);	
		if ($query->have_posts()):  
			while ($query->have_posts()): $query->the_post();
				$ii++;
				$img = get_the_post_thumbnail_url();
				$cls_nm = 'section-product-left';
				if($ii%2 == 0)
					$cls_nm = 'section-product-right';
	?>
				<!-- section-product start -->
				<section class="section-product section-detail <?php echo $cls_nm;?> spacer-y-1x">
					<div class="introText">
						<div class="inner wrapp">
							<div class="heading"><?php echo get_field('tag_text');?></div>
						</div>
					</div>
					<?php if(!empty($img)){?>					
						<div class="imageCircle-text">
							<div class="section-img to-scale">
								<a href="<?php the_permalink();?>">
									<img src="<?php echo $img;?>" alt="<?php the_title();?>" />
								</a>
							</div>
						</div>
					<?php }?>
					<div class="section-content to-stagger-set">
						<div class="inner wrapp">
							<h2 class="title to-stagger-first"><?php the_title();?></h2>
							<p class="description to-stagger"><?php echo mkt_get_number_of_char_from_string_without_p(get_the_content(), 200);?></p>							
							<a href="<?php the_permalink();?>" class="button to-stagger">Discover collection</a>
						</div>
					</div>
				</section>
				<!-- section-product end -->

	<?php
			endwhile;
		endif;
		
		$big = 999999999; // need an unlikely integer
		$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $query->max_num_pages,
			'type'  => 'array',
			'prev_text' => '←',
			'next_text' => '→'
			
		) );
		if( is_array( $pages ) ) {
			$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
			echo '<nav class="woocommerce-pagination"><ul class="page-numbers">';
			foreach ( $pages as $page ) {
				echo "<li>$page</li>";
			}
			echo '</ul></nav>';
		}
	
		
		
		wp_reset_query(); 	
	?>
	</div>

</section>




<?php get_footer(); ?>