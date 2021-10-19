<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package robin
 */

get_header();
$page_title = get_field('404_page_title', 'option');
$page_cta_button = get_field('404_page_cta_button', 'option');
?>
<section class="error-404">
	<div class="wrapp">
		<?php 
			if(!empty($page_title))echo '<h1>'.$page_title.'</h1>';
			if(!empty($page_cta_button)){
				$target = $page_cta_button['target'];
				if(empty($target))
					$target = '_self';
		?>
				<a href="<?php echo $page_cta_button['url'];?>" target="<?php echo $target;?>" class="button"><?php echo $page_cta_button['title'];?></a>
		<?php }?>
	</div>	
</section>
	
<?php
get_footer();
