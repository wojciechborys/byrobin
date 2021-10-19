<?php
/********** Admin login logo,link and tooltip change ********** */
$map_include = false;
function my_login_logo_one() {
	$footer_logo = get_field('footer_logo', 'option');
    ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo $footer_logo['url']?>); 
            background-size:45%;
            width:95% !important;
            height:150px !important;           
        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'my_login_logo_one');

function loginpage_custom_link() {
    return get_bloginfo('url');
}

add_filter('login_headerurl', 'loginpage_custom_link');

function change_title_on_logo() {
    return get_bloginfo('name');
}

add_filter('login_headertitle', 'change_title_on_logo');
/* * ******** Admin login logo,link and tooltip change ********** */

/* * ********* ACf Options Page ********* */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'wp-theme-options',
        'capability' => 'manage_options',
        'redirect' => true
    ));
}
/* * ******** ACf Options Page ********* */

function my_acf_format_value($value, $post_id, $field) {

    // run do_shortcode on all textarea values
    $value = do_shortcode($value);

    return $value;
}

add_filter('acf/format_value/type=textarea', 'my_acf_format_value', 10, 3);
add_filter('acf/format_value/type=text', 'my_acf_format_value', 10, 3);
add_filter('widget_text', 'do_shortcode');

function mkt_get_number_of_char_from_string($string, $char) {
    $string = strip_tags($string);
    $newtext = wordwrap($string, $char, "<br />\n");
    $newtext = explode("<br />", $newtext);
    //print_r($newtext);    
    if (count($newtext) > 1) {
	return "<p>" . $newtext[0] . "...</p>";
        //return "<p>" . $newtext[0] . "</p>";
    } else {
        return "<p>" . $newtext[0] . "</p>";
    }
}

function mkt_get_number_of_char_from_string_without_p($string, $char) {
    $string = strip_tags($string);
    $newtext = wordwrap($string, $char, "<br />\n");
    $newtext = explode("<br />", $newtext);
    //print_r($newtext);    
    if (count($newtext) > 1) {
        return $newtext[0] . "...";
    } else {
        return $newtext[0];
    }
}

/* * *** Support SVG ***** */

function wpcontent_svg_mime_type($mimes = array()) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['ttf'] = 'application/x-font-ttf';
    $mimes['woff'] = 'application/font-woff';
    $mimes['woff2'] = 'application/font-woff2';
    $mimes['eot'] = 'application/font-eot';
    return $mimes;
}

add_filter('upload_mimes', 'wpcontent_svg_mime_type');
/* * *** Support SVG ***** */

function view_button($option, $content) {
    global $post;
    $html = '';
    if (!isset($option['target'])) {
        $option['target'] = '_self';
    }
    if (isset($option['title'])) {
        $title = $option['title'];
    } else {
        $title = $content;
    }

    $html .= '<a href="' . $option['href'] . '" class="' . $option['class'] . '" title="' . $title . '" target="' . $option['target'] . '">' . $content . '</a>';

    //echo $content;
    return $html;
}

add_shortcode('Button', 'view_button');

function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

add_filter('default_page_template_title', function() {
    return __('General Template', 'your_text_domain');
});

add_action( 'wp_ajax_search_form_header', 'search_form_header' );
add_action( 'wp_ajax_nopriv_search_form_header', 'search_form_header' );

function search_form_header() {
    
    $se_sub = $_REQUEST['se_sub'];
	
	ob_start();
    
    $args = array('post_type' => array('post', 'product'), 'posts_per_page' => 20, 'post_status' => 'publish');
	
	if(!empty($se_sub)){
		$args['s'] = $se_sub;
    
		$query = new WP_Query($args);
		$total_news = $query->found_posts;
		
		if ($query->have_posts()):           
			while ($query->have_posts()): $query->the_post();   
	?> 			
			<a href="<?php the_permalink();?>" >
				<div class="result-item">					
					<div class="search-text">
						<span class="main-text"><?php echo highlight(mkt_get_number_of_char_from_string_without_p(get_the_title(),25), $se_sub);?></span>
					</div>
					<div class="categories-text">
						<span class="main-text"><?php echo get_post_type(get_the_ID());?></span>
					</div>
					<div class="link-text">
						<span class="more-btn">
							<svg xmlns="http://www.w3.org/2000/svg" width="24.207" height="17.414" viewBox="0 0 24.207 17.414">
								<g id="Group_4_Copy_6" data-name="Group 4 Copy 6" transform="translate(0.5 0.707)" opacity="0.502">
									<path id="Stroke_6998" data-name="Stroke 6998" d="M23,0H0" transform="translate(0 8)" fill="none" stroke="#313131" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"/>
									<path id="Stroke_6999" data-name="Stroke 6999" d="M0,0,8,8" transform="translate(15)" fill="none" stroke="#313131" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"/>
									<path id="Stroke_7000" data-name="Stroke 7000" d="M8,0,0,8" transform="translate(15 8)" fill="none" stroke="#313131" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"/>
								</g>
							</svg>
						</span>
					</div>					
				</div>		
			</a>
	<?php			
			endwhile; 
		else:
			echo '<div class="result-item no-result">
					<div class="search-text">
						<span class="main-text">No results</span>
					</div>
				</div>';
		endif;
	}
    $contents = ob_get_contents();
    ob_end_clean();    
    
    $response['html']= $contents;
    
    echo json_encode($response);
    wp_reset_query();
    die();
}

function highlight($text, $words) {
	preg_match_all('~\w+~', $words, $m);
	if(!$m)
		return $text;
	//$re = '~\\b(' . implode('|', $m[0]) . ')\\b~i';
	$re = '/' . implode('|', $m[0]) . '/i';
	return preg_replace($re, '<span class="highlight-text">$0</span>', $text);
}

/********* Custom POST ***********/
add_action( 'init', 'custom_post_type', 0 );
function custom_post_type() {
		
		/**************** Collection ****************/
        register_post_type( 'collection',
            array(
              'labels' => array(
                'name' => __( 'Collections' ),
                'singular_name' => __( 'Collection' )
              ),
              'supports'            => array( 'title', 'editor', 'author', 'revisions', 'custom-fields', 'thumbnail' ),
              'public' => true,
			  'publicly_queryable' => true,
              'has_archive' => false,
              'rewrite' => array('slug' => 'collection', 'with_front' => false),
            )
        );
		
		$labels = array(
			'name'                       => _x( 'Collections ', 'taxonomy general name', 'textdomain' ),
			'singular_name'              => _x( 'Collection Category', 'taxonomy singular name', 'textdomain' ),
			'search_items'               => __( 'Search Collection Category', 'textdomain' ),
			'popular_items'              => __( 'Popular Collection Category', 'textdomain' ),
			'all_items'                  => __( 'All Collection Category', 'textdomain' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Collection Category', 'textdomain' ),
			'update_item'                => __( 'Update Collection Category', 'textdomain' ),
			'add_new_item'               => __( 'Add New Collection Category', 'textdomain' ),
			'new_item_name'              => __( 'New Collection Category Name', 'textdomain' ),
			'separate_items_with_commas' => __( 'Separate Collection Category with commas', 'textdomain' ),
			'add_or_remove_items'        => __( 'Add or remove Collection Category', 'textdomain' ),
			'choose_from_most_used'      => __( 'Choose from the most used Collection Category', 'textdomain' ),
			'not_found'                  => __( 'No writers found.', 'textdomain' ),
			'menu_name'                  => __( 'Collection Category', 'textdomain' ),
		);
		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'collection-category', 'with_front' => false, 'hierarchical' => true),
		);
		register_taxonomy( 'collection-category', 'collection', $args );
		/**************** Videos ****************/
}