<?php
$img_gallery = false;
/**** LOGIN FORM  ****/
add_shortcode('wc_login_form', 'mnb_wc_login_form');

function mnb_wc_login_form() {
    if (is_admin())
        return;
    ob_start();
    if (!is_user_logged_in()) {

	?>
		<!-- loginPopup start -->
		<div class="formPopup loginPopup">
			<div class="inner-wrap">

				<div class="close-btn">
					<svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
						<g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
							<path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
							<path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
						</g>
					</svg>
				</div>

				<div class="form-box">
					<div class="heading-box mobile-show desktop-hide">
						<h4>Login</h4>
					</div>
					<div class="form-group right-text register-box">
						<span class="trigger-btn register-trigger has-icon">No account? Register</span>
					</div>
				
					<form id="login" action="login" method="post" class="form">
						<div class="form-group input-group">
						   <div class="input-wrap">
                               <input id="username-login" class="form-input" name="username" type="text" required=""/>
                               <label class="form-label" for="username-login">Email address</label>      
                               <span class="resetTrigger"></span>            
                           </div>
						   <p class="field-error error-msg"></p>
						</div>
						<div class="form-group input-group">
						   <div class="input-wrap">
						        <input id="password-login" class="form-input" name="password" type="password" required="" />
                                <label class="form-label" for="password-login">Password</label>
                            </div>
						</div>
						<div class="form-group checkbox-group right-text">
						   <span class="forgotPass-trigger">Forgot password?</span>
						</div>
						<div class="form-group submit-box">
							<button class="button submit-button">Login</button>
						</div>
						<div class="form-group notification-box">
							<p class="status mt-3 mb-0 text-center"></p>
						</div>
					 </form>
				</div>

			</div>
		</div>
		<!-- loginPopup end -->
	
        <?php
        // END OF COPIED HTML
        // ------------------     
    }
    return ob_get_clean();
}

/**** REGISTER FORM  ****/
add_shortcode( 'Register_form', 'mnb_registration_form' );    
function mnb_registration_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return;
   ob_start();
 
   //do_action( 'woocommerce_before_customer_login_form' );
   
?>
   
	<!-- registerPopup start -->
    <div class="formPopup registerPopup">
        <div class="inner-wrap">
            <div class="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
                    <g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
                        <path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                        <path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
                    </g>
                </svg>
            </div>

            <div class="form-box">
                <div class="heading-box mobile-show desktop-hide">
                    <h4>Register</h4>
                </div>
                <div class="form-group right-text register-box">
                    <span class="trigger-btn login-trigger has-icon">Already an account? Login</span>
                </div>                
                <form id="register" action="register" role="form" method="post" class="form">
                    <div class="form-group input-group">
                       <div class="input-wrap">
                           <input id="first" class="form-input" name="first_name" type="text" required=""/>
                           <label class="form-label" for="first">First name*</label>
                       </div>
                    </div>
                    <div class="form-group input-group">
                       <div class="input-wrap">
                           <input id="last" class="form-input" name="last_name" type="text" required=""/>
                           <label class="form-label" for="last">Last name*</label>
                       </div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-wrap">
                            <input id="email_address" class="form-input" name="email" type="text" required=""/>
                            <label class="form-label" for="email_address">Email address*</label>
                            <span class="resetTrigger"></span>
                        </div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-wrap">
                            <input id="password" class="form-input" name="password" type="password" required=""/>
                            <label class="form-label" for="password">Password*</label>
                        </div>
                    </div>
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="subscribe" name="is_subscribe">
                        <label for="subscribe">Subscribe to our newsletter</label>
                    </div>
                    <div class="form-group submit-box">
                        <button class="button submit-button">Register</button>
                    </div>
					<div class="form-group notification-box">
						<p class="status mt-3 mb-0 text-center"></p>
					</div>
                 </form>
            </div>

        </div>
    </div>
    <!-- registerPopup end -->
   
   <?php 
     
   return ob_get_clean();
}

add_action('wp_ajax_ajax_login', 'ajax_login');
add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');

function ajax_login() {
	global $wpdb;

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
	
	$l_res = $wpdb->get_results("SELECT ID, user_login FROM wp_users WHERE user_login='".$_POST['username']."'", ARRAY_A);
	
	if(empty($l_res)){		
		echo json_encode(array('loggedin' => false, 'message' => __('Wrong email/username or password.')));
		die;
	}

    $user_signon = wp_signon($info, false); 
	 
    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Wrong email/username or password.')));
    } else {
        echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...')));
    }

    die();
}

add_action('wp_ajax_ajax_register', 'ajax_register');
add_action('wp_ajax_nopriv_ajax_register', 'ajax_register');

function ajax_register() {
    // First check the nonce, if it fails the function will break
    //check_ajax_referer('register-nonce', 'security_register');
    $params = array();
    parse_str($_POST['form_var'], $params);
    $email = $params['email'];
    $pass = $params['password'];
    $username = $email;//$params['username'];
    $first_name = $params['first_name'];
    $last_name = $params['last_name'];
    $is_subscribe = $params['is_subscribe'];  
    
    $userdata = array(
        'user_login' => $username,
        'user_pass' => $pass,
        'user_email' => $email,
        'first_name' => $first_name,
        'last_name' => $last_name,
    );

    $user_id = wp_insert_user($userdata);
    

    if (!empty($user_id) && !isset($user_id->errors)) {
		update_user_meta($user_id, 'is_subscribe', sanitize_text_field($is_subscribe));

        if (!is_user_logged_in()) {
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            $user = get_user_by('id', $user_id);
            do_action('wp_login', $user->user_login, $user); 
        }
    }
    if (empty($email))
        $errors[] = 'email';
    if (empty($pass))
        $errors[] = 'password';    
	if (empty($first_name))
        $errors[] = 'first_name';
    if (empty($last_name))
        $errors[] = 'last_name';
    
    if ($errors) {
        echo json_encode(array('status' => false, 'message' => $errors));
    } elseif (is_wp_error($user_id)) {
        echo json_encode(array('status' => false, 'message' => 'Sorry, that email address already exists!', 'user_exists' => 'yes'));
    } else {
        echo json_encode(array('status' => true, 'message' => __('We have Created an account for you.')));
    }
    exit();
}

/** Forgot password **/
add_action('wp_ajax_ajax_forgot_pwd', 'ajax_forgot_pwd');
add_action('wp_ajax_nopriv_ajax_forgot_pwd', 'ajax_forgot_pwd');

function ajax_forgot_pwd() {
    // First check the nonce, if it fails the function will break
    check_ajax_referer('ajax-forgot-pwd-nonce', 'security_forgot');

    // Nonce is checked, get the POST data and sign user on

    $user_login = $_POST['username'];


    $errors = new WP_Error();

    if (empty($user_login)) {
        echo json_encode(array('status' => false, 'message' => __('Enter a username or e-mail address.')));
        die;
    } else if (strpos($user_login, '@')) {
        $user_data = get_user_by('email', trim($user_login));
        if (empty($user_data)) {
            echo json_encode(array('status' => false, 'message' => __('There is no user registered with that email address.')));
            die;
        }
    } else {
        $login = trim($user_login);
        $user_data = get_user_by('login', $login);
    }

    do_action('lostpassword_post', $errors);

    if ($errors->get_error_code()) {
        echo json_encode(array('status' => false, 'message' => $errors));
        die;
    }

    if (!$user_data) {
        echo json_encode(array('status' => false, 'message' => __('Invalid username or email.')));
        die;
    }

    // Redefining user_login ensures we return the right case in the email.
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $key = get_password_reset_key($user_data);

    if (is_wp_error($key)) {
        echo json_encode(array('status' => false, 'message' => $key));
        die;
    }

    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
    $message .= network_home_url('/') . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";

    // replace PAGE_ID with reset page ID
    //$message .= esc_url( get_permalink( PAGE_ID ) . "/?action=rp&key=$key&login=" . rawurlencode($user_login) ) . "\r\n";

    if (is_multisite())
        $blogname = $GLOBALS['current_site']->site_name;
    else
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf(__('[%s] Password Reset'), $blogname);

    $title = apply_filters('retrieve_password_title', $title, $user_login, $user_data);

    $message = apply_filters('retrieve_password_message', $message, $key, $user_login, $user_data);

    if (!wp_mail($user_email, wp_specialchars_decode($title), $message)) {
        echo json_encode(array('status' => false, 'message' => __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.')));
        die;
    }


    // display error message
    if ($errors->get_error_code())
        echo json_encode(array('status' => false, 'message' => $errors->get_error_message($errors->get_error_code())));
    else
        echo json_encode(array('status' => true, 'message' => __('Check your e-mail for the confirmation link.')));

    die();
}
/** Forgot password **/

/******************* Subscribe Option for ADMIN ****/
if(is_admin()){
	add_action( 'show_user_profile', 'extra_user_profile_fields' );
	add_action( 'edit_user_profile', 'extra_user_profile_fields' );
	function extra_user_profile_fields( $user ) { ?>
		<h3><?php _e("Extra profile information", "blank"); ?></h3>

		<table class="form-table">
		<tr>
			<th><label for="address">Subscribe</label></th>
			<td>
				<input type="checkbox" id="subscribe" name="is_subscribe" <?php if(esc_attr( get_the_author_meta( 'is_subscribe', $user->ID ) ))echo 'checked="checked"'; ?>>
				<label for="subscribe">Is subscribe to our newsletter</label>
			</td>
		</tr>
		</table>
	<?php }

	add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
	add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
	function save_extra_user_profile_fields( $user_id ) {
		if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
			return;
		}
		
		if ( !current_user_can( 'edit_user', $user_id ) ) { 
			return false; 
		}
		update_user_meta( $user_id, 'is_subscribe', $_POST['is_subscribe'] );
	}
}
/******************* Subscribe Option for ADMIN ****/

/******* Shop Widget *******/
if ( function_exists('register_sidebar') ) 
register_sidebar(array(
    'name' => 'Sidebar',
    'before_widget' => '<div class = "widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
    )
);


/**** SHOP MENU  ****/
add_shortcode('shop_menu_shortcode', 'shop_menu_shortcode_fun');

function shop_menu_shortcode_fun() {
    if (is_admin())
        return;
    ob_start();
	
	$category_section = get_field('category_section', 'option');
	$collection_image = get_field('collection_image', 'option');
	$collection_link = get_field('collection_link', 'option');
	$shop_cta_button = get_field('shop_cta_button', 'option');
	    
	?>
	 <!-- shopMenu popup start -->
		<div class="shopMenuPopup">
			<div class="popup-wrap">
				<!-- <div class="close-btn">
					<svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
						<g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
							<path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
							<path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
						</g>
					</svg>
				</div> -->
				<div class="menu-wrap">
					<?php 
						if(!empty($category_section)){
							echo '<div class="hoverMenu">
									<div class="hoverMenu-list">
										<ul>';
							foreach($category_section as $cs_key => $cs_value){
								$product_category = $cs_value['product_category'];							
								$category_relevant_image = $cs_value['category_relevant_image'];
								if(!empty($product_category) && !empty($category_relevant_image)){
					?>
								<li>
									<a href="<?php echo get_term_link($product_category->term_id);?>"><?php echo $product_category->name;?></a>
									<div class="subContent">
										<div class="img-box" style="background-image: url(<?php echo $category_relevant_image['url'];?>);"> </div>
									</div>
								</li>
					<?php
								}
							}
							echo '</ul>
								</div>';
								
							if(!empty($shop_cta_button)){	
								$target = $shop_cta_button['target'];
								if(empty($target))
									$target = '_self';
								echo '<div class="heading"><a href="'.$shop_cta_button['url'].'" target="'.$target.'>">'.$shop_cta_button['title'].'</a></div>';
							}
							echo '</div>';
						}
						
						if(!empty($collection_image) && !empty($collection_link)){
							$target = $collection_link['target'];
							if(empty($target))
								$target = '_self';
					?>
					<div class="menuCollection">
						<div class="imgHeading">
							<a href="<?php echo $collection_link['url'];?>" target="<?php echo $target;?>"><div class="img-box" style="background-image: url(<?php echo $collection_image['url'];?>);"></div></a>
							<div class="heading"><a href="<?php echo $collection_link['url'];?>" target="<?php echo $target;?>"><?php echo $collection_link['title'];?></a></div>
						</div>
					</div>
					<?php }?>
				</div>
				
			</div>
		</div>
		<!-- shopMenu popup end -->
	
	<?php
    
    return ob_get_clean();
}
/****  SHOP MENU  ***/


/**** SHOP MENU COLLECTIONS  ****/
add_shortcode('collections_menu_shortcode', 'collections_menu_shortcode_fun');

function collections_menu_shortcode_fun() {
    if (is_admin())
        return;
    ob_start();
	
	$category_section = get_field('category_section_coll', 'option');
	$collection_image = get_field('collection_image_coll', 'option');
	$collection_link = get_field('collection_link_coll', 'option');
	$shop_cta_button = get_field('shop_cta_button_coll', 'option');
	    
	?>
	 <!-- shopMenu popup start -->
		<div class="shopMenuPopup">
			<div class="popup-wrap">
				<!-- <div class="close-btn">
					<svg xmlns="http://www.w3.org/2000/svg" width="11.016" height="11.016" viewBox="0 0 11.016 11.016">
						<g id="Group_Copy" data-name="Group Copy" transform="translate(10.23 0.786) rotate(90)">
							<path id="Stroke_6992" data-name="Stroke 6992" d="M0,0,9.444,9.444" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
							<path id="Stroke_6993" data-name="Stroke 6993" d="M0,9.444,9.444,0" fill="none" stroke="#666" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.111"/>
						</g>
					</svg>
				</div> -->
				<div class="menu-wrap">
					<?php 
						if(!empty($category_section)){
							echo '<div class="hoverMenu">
									<div class="hoverMenu-list">
										<ul>';
							foreach($category_section as $cs_key => $cs_value){
								$product_category = $cs_value['product_category'];							
								$category_relevant_image = $cs_value['category_relevant_image'];
								if(!empty($product_category) && !empty($category_relevant_image)){
					?>
								<li>
									<a href="<?php echo get_term_link($product_category->term_id);?>"><?php echo $product_category->name;?></a>
									<div class="subContent">
										<div class="img-box" style="background-image: url(<?php echo $category_relevant_image['url'];?>);"> </div>
									</div>
								</li>
					<?php
								}
							}
							echo '</ul>
								</div>';
								
							if(!empty($shop_cta_button)){	
								$target = $shop_cta_button['target'];
								if(empty($target))
									$target = '_self';
								echo '<div class="heading"><a href="'.$shop_cta_button['url'].'" target="'.$target.'>">'.$shop_cta_button['title'].'</a></div>';
							}
							echo '</div>';
						}
						
						if(!empty($collection_image) && !empty($collection_link)){
							$target = $collection_link['target'];
							if(empty($target))
								$target = '_self';
					?>
					<div class="menuCollection">
						<div class="imgHeading">
							<a href="<?php echo $collection_link['url'];?>" target="<?php echo $target;?>"><div class="img-box" style="background-image: url(<?php echo $collection_image['url'];?>);"></div></a>
							<div class="heading"><a href="<?php echo $collection_link['url'];?>" target="<?php echo $target;?>"><?php echo $collection_link['title'];?></a></div>
						</div>
					</div>
					<?php }?>
				</div>
				
			</div>
		</div>
		<!-- shopMenu popup end -->
	
	<?php
    
    return ob_get_clean();
}
/****  SHOP MENU  ***/

add_action('after_setup_theme', 'mytheme_add_woocommerce_support', 99);
function mytheme_add_woocommerce_support() {
    add_theme_support('woocommerce');
    //add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart');
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

// Creating the widget 
class wpb_widget extends WP_Widget {
  
function __construct() {
parent::__construct(
  
// Base ID of your widget
'wpb_widget', 
  
// Widget name will appear in UI
__('Shop Filter', 'wpb_widget_domain'), 
  
// Widget description
array( 'description' => __( 'It includes Product Category, Attribute and Collection', 'wpb_widget_domain' ), ) 
);
}
  
// Creating widget front-end
  
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
  
// before and after widget arguments are defined by themes
echo $args['before_widget'];


$c1_is_display = get_field('c1_is_display', 'widget_' . $args['widget_id']);
$c1_title = get_field('c1_title', 'widget_' . $args['widget_id']);
$c2_is_display = get_field('c2_is_display', 'widget_' . $args['widget_id']);
$c2_is_mobile_only = get_field('c2_is_mobile_only', 'widget_' . $args['widget_id']);
$c2_title = get_field('c2_title', 'widget_' . $args['widget_id']);
$c3_is_display = get_field('c3_is_display', 'widget_' . $args['widget_id']);
$c3_title = get_field('c3_title', 'widget_' . $args['widget_id']);
$collection_display_type = get_field('collection_display_type', 'widget_' . $args['widget_id']);
$number_of_collection = get_field('number_of_collection', 'widget_' . $args['widget_id']);
$custom_collection = get_field('custom_collection', 'widget_' . $args['widget_id']);

?>

<div class="filterOptions">
	<?php if($c1_is_display){
		$pa_colours = get_terms( array( 'taxonomy' => 'pa_colours', 'parent' => 0 ) );
	?>
	<div class="option-item colorOption">
		<?php
			if(!empty($c1_title))echo '<h4>'.$c1_title.'</h4>';
			if(!empty($pa_colours)){
				echo '<div class="colorList">
						<div class="listRow">';
				foreach($pa_colours as $p_key => $p_value){
					$p_id = $p_value->taxonomy.'_'.$p_value->term_id ;
					$color_code = get_field('color_code', $p_id);
					if(is_shop()){
						$link = get_permalink( woocommerce_get_page_id( 'shop' ) ).'?c_id='.$p_value->term_id;
					}else{
						$curr_obj = get_queried_object();
						$cu_o_id = $curr_obj->term_id ;
						$link = get_term_link( $cu_o_id ).'?c_id='.$p_value->term_id;
					}
						
		?>
				<div class="color-item <?php if($_REQUEST['c_id'] == $p_value->term_id)echo 'is-active';?>"><a href="<?php echo $link;?>"><span class="color" style="background-color: <?php echo $color_code;?>;"></span></a></div>
		<?php
				}
				echo '</div>
				</div>';
			}
		?>		
	</div>
	<?php
		}
		if(!empty($c2_is_display)){
			$product_cat = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0 ) );
	?>
	<div class="option-item shopOption <?php if($c2_is_mobile_only)echo 'showless-tablet';?>">
		<?php if(!empty($c2_title))echo '<h4>'.$c2_title.'</h4>';?>
		<?php 
			$cu_o_id = 99999999;
			$cls_nm = '';
			if(is_shop()){
				$cls_nm = 'is-active';
			}else{
				$curr_obj = get_queried_object();
				$cu_o_id = $curr_obj->term_id ;
			}
			if(!empty($product_cat)){
				echo '<ul class="product-categories">
						<li class="cat-item cat-item-15 '.$cls_nm.'"><a href="'.get_permalink( woocommerce_get_page_id( 'shop' ) ).'">All</a></li>';
				foreach($product_cat as $p_key => $p_value){
		?>
					<li class="cat-item cat-item-17 <?php if($cu_o_id == $p_value->term_id)echo 'is-active';?>"><a href="<?php echo get_term_link($p_value->term_id);?>"><?php echo $p_value->name;?></a></li>
		<?php
				}
				echo '</ul>';
			}
		?>
	</div>
	<?php
		}
		if(!empty($c3_is_display)){
	?>
	<div class="option-item collectionsOption">
		<?php if(!empty($c3_title))echo '<h4>'.$c3_title.'</h4>';?>
		<?php 						
			if($collection_display_type == 'custom_post' && !empty($custom_collection))
			{
				$args = array('post_type' => 'collection', 'posts_per_page' => -1, 'post__in' => $custom_collection, 'post_status' => 'publish','orderby' => 'post__in');
			}
			else
			{
				$args = array('post_type' => 'collection', 'posts_per_page' => $number_of_collection, 'post_status' => 'publish');                
			}
			$query = new WP_Query($args);

			if ($query->have_posts()):    
				echo '<ul>';
				while ($query->have_posts()): $query->the_post();					
		?> 	
					<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>					
		<?php
				endwhile;
				echo '</ul>';
			endif;
			wp_reset_query();
		?>
	</div>
	<?php }?>
</div>

<?php 
echo $args['after_widget'];
}
          
// Widget Backend 
public function form( $instance ) {
// Widget admin form
}
      
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();

return $instance;
}
 
// Class wpb_widget ends here
}  
 
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

//Add Content Before Listing
add_action('woocommerce_before_shop_loop', 'woocommerce_before_shop_loop_fun');
function woocommerce_before_shop_loop_fun() {
	echo '<div class="shop-pg pt-180">';
	?>
	 <!-- filterMain section start -->
    <div class="filterMain-box">
        <div class="wrapp">
            <div class="filter-wrap">
                
                <div class="filterList">
                	<?php 
						//dynamic_sidebar( 'sidebar-shop' ); 
						$product_cat = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0 ) );
						$cu_o_id = 99999999;
						$cls_nm = '';
						if(is_shop()){
							$cls_nm = 'is-active';
						}else{
							$curr_obj = get_queried_object();
							$cu_o_id = $curr_obj->term_id ;
						}
						if(!empty($product_cat)){
							echo '<ul class="product-categories">
									<li class="cat-item cat-item-15 '.$cls_nm.'"><a href="'.get_permalink( woocommerce_get_page_id( 'shop' ) ).'">All</a></li>';
							foreach($product_cat as $p_key => $p_value){
					?>
								<li class="cat-item cat-item-17 <?php if($cu_o_id == $p_value->term_id)echo 'is-active';?>"><a href="<?php echo get_term_link($p_value->term_id);?>"><?php echo $p_value->name;?></a></li>
					<?php
							}
							echo '</ul>';
						}
					?>
                </div>
                
                <div class="filterSetting">
                    <div class="filterPopup-trigger"> Filter </div>
                </div>

            </div>                        
        </div>
    </div>
    <!-- filterMain section end -->
	<?php
}

/***** SHOP PAGE   ****/
add_action('woocommerce_before_shop_loop_item', 'fun_woocommerce_before_shop_loop_item', 9);
function fun_woocommerce_before_shop_loop_item(){
	echo '<div class="productList-card">';
}
add_action('woocommerce_after_shop_loop_item', 'fun_woocommerce_after_shop_loop_item', 9);
function fun_woocommerce_after_shop_loop_item(){
	echo '</div>';
}

add_action('woocommerce_before_shop_loop_item_title', 'fun_woocommerce_before_shop_loop_item_title', 12);
function fun_woocommerce_before_shop_loop_item_title(){
	echo '<div class="info-box">';
}
add_action('woocommerce_after_shop_loop_item_title', 'fun_woocommerce_after_shop_loop_item_title', 12);
function fun_woocommerce_after_shop_loop_item_title(){
	echo '</div>';
}


remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
function woocommerce_template_loop_product_thumbnail(){
	echo '<div class="img-box">';
	$product = new WC_product(get_the_ID());
	$image = wp_get_attachment_image_src( $product->get_image_id(), 'shop' )[0];
	if(!empty($image)){?>
		<div class="img-box">
			<img src="<?php echo $image;?>" alt="<?php the_title();?>">
		</div>
	<?php }
	echo '</div>';
}

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
add_action('woocommerce_shop_loop_item_title', 'fun_woocommerce_shop_loop_item_title', 10);
function fun_woocommerce_shop_loop_item_title(){
	echo '<div class="title">'.get_the_title().'</div>';
}

add_action('woocommerce_after_shop_loop', 'fun_woocommerce_after_shop_loop', 10);
function fun_woocommerce_after_shop_loop(){
	echo '</div>';
}
/***** SHOP PAGE   ****/

add_action( 'pre_get_posts', function( $query ){
  	if (!is_admin() && $query->is_main_query() && (is_post_type_archive('product') || is_product_category()) && isset($_REQUEST['c_id'])) {
		$cat_a = explode(',', $_REQUEST['c_id']);	

		$tax_query = array();
		
		$tax_query = array(
				  'relation'    => 'AND');
		
		if(isset($_REQUEST['c_id'])){
			$tax_query[] = array(
				'taxonomy' => 'pa_colours',
				'field'    => 'id',
				'terms'   => $cat_a,
			);
		}
		$query->set( 'tax_query', $tax_query );		
	}  
} );

/***** Empty cart ***/
add_action('wp_ajax_wc_woocommerce_clear_cart_url', 'wc_woocommerce_clear_cart_url');
add_action('wp_ajax_nopriv_wc_woocommerce_clear_cart_url', 'wc_woocommerce_clear_cart_url'); 

function wc_woocommerce_clear_cart_url() {
	global $woocommerce;
	$returned = ['status'=>'error','msg'=>'Your order could not be emptied'];
	$woocommerce->cart->empty_cart();
	if ( $woocommerce->cart->get_cart_contents_count() == 0 ) {    
		$returned = ['status'=>'success','msg'=>'Your order has been reset!'];       
	}
	die(json_encode($returned));
}
/***** Empty cart ***/



add_action( 'woocommerce_account_dashboard', 'woocommerce_account_edit_account' );
add_action('woocommerce_account_dashboard', 'fun_woocommerce_before_my_account', 9);
function fun_woocommerce_before_my_account(){	
	echo '<div class="personal-info-wrapper"><h3>Contact</h3>';
}
add_action('woocommerce_after_my_account', 'fun_woocommerce_after_my_account', 9);
function fun_woocommerce_after_my_account(){
	echo '</div>';
}

add_filter( 'woocommerce_account_menu_items', 'QuadLayers_remove_acc_address', 9999 );
function QuadLayers_remove_acc_address( $items ) {
unset( $items['edit-account'] );
unset( $items['edit-address'] );
return $items;
}

add_filter( 'woocommerce_account_menu_items', 'QuadLayers_rename_acc_adress_tab', 9999 );
function QuadLayers_rename_acc_adress_tab( $items ) {
$items['dashboard'] = 'Personal information';
return $items;
}


add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_safe_redirect( home_url() );
  exit;
}

// Add the custom field "favorite_color"
add_action( 'woocommerce_edit_account_form', 'add_favorite_color_to_edit_account_form' );
function add_favorite_color_to_edit_account_form() {
    $user = wp_get_current_user();
	$billing_first_name = get_user_meta($user->id, 'billing_first_name', true);
	$billing_last_name = get_user_meta($user->id, 'billing_last_name', true);
	$billing_phone = get_user_meta($user->id, 'billing_phone', true);
	$billing_company = get_user_meta($user->id, 'billing_company', true);
	$billing_country = get_user_meta($user->id, 'billing_country', true);
	$billing_address_1 = get_user_meta($user->id, 'billing_address_1', true);
	$billing_address_2 = get_user_meta($user->id, 'billing_address_2', true);
	$billing_postcode = get_user_meta($user->id, 'billing_postcode', true);
	$billing_state = get_user_meta($user->id, 'billing_state', true);
	$billing_city = get_user_meta($user->id, 'billing_city', true);
	
	$shipping_first_name = get_user_meta($user->id, 'shipping_first_name', true);
	$shipping_last_name = get_user_meta($user->id, 'shipping_last_name', true);
	$shipping_company = get_user_meta($user->id, 'shipping_company', true);
	$shipping_country = get_user_meta($user->id, 'shipping_country', true);
	$shipping_address_1 = get_user_meta($user->id, 'shipping_address_1', true);
	$shipping_address_2 = get_user_meta($user->id, 'shipping_address_2', true);
	$shipping_postcode = get_user_meta($user->id, 'shipping_postcode', true);
	$shipping_phone = get_user_meta($user->id, 'shipping_phone', true);
	$shipping_city = get_user_meta($user->id, 'shipping_city', true);
	$shipping_state = get_user_meta($user->id, 'shipping_state', true);
	
	$ship_to_same_address = get_user_meta($user->id, 'ship_to_same_address', true);
	
	echo '<div class="billing-wrap"><h3>Billing Address</h3>';
	woocommerce_form_field('billing_first_name', array(
        'type' => 'text',
        'label' => __('First Name'),
        'required' => true,
		'class' => array('half-col'),
    ),$billing_first_name);
    woocommerce_form_field('billing_last_name', array(
        'type' => 'text',
        'label' => __('Last Name'),
        'required' => true,
		'class' => array('half-col'),
    ),$billing_last_name);
	woocommerce_form_field('billing_phone', array(
        'type' => 'tel',
        'label' => __('Phone number'),
        'required' => true,
		'class' => array('half-col'),
    ), $billing_phone);
	woocommerce_form_field('billing_company', array(
        'type' => 'tel',
        'label' => __('Company name'),
        'required' => false,
		'class' => array('half-col'),
    ), $billing_company);
    woocommerce_form_field('billing_country', array(
        'type' => 'country',
        'class' => array('chzn-drop'),
        'label' => __('Please select your country'),
        'placeholder' => __('Choose your country.'),
        'required' => true,
        'clear' => true
    ), $billing_country);	
	woocommerce_form_field('billing_postcode', array(
        'type' => 'text',
        'label' => __('Zip Code'),
        'required' => true,
		'class' => array('half-col'),
    ), $billing_postcode);
    woocommerce_form_field('billing_address_1', array(
        'type' => 'text',
        'label' => __('Address'),
        'required' => true,
		'class' => array('three-col'),
    ), $billing_address_1);
    woocommerce_form_field('billing_address_2', array(
        'type' => 'text',
        'label' => __('Apt'),
        'required' => false,
		'class' => array('three-col'),
    ), $billing_address_2);	
    woocommerce_form_field('billing_state', array(
        'type' => 'state',
        'label' => __('State'),
        'required' => true,
		'class' => array('half-col'),
    ), $billing_state);
    woocommerce_form_field('billing_city', array(
        'type' => 'text',
        'label' => __('City'),
        'required' => true,
		'class' => array('half-col'),
    ), $billing_city);
	echo '</div>';
	?>
	<h4 id="ship-to-different-address">
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
			<input id="ship-checkbox" class="woocommerce-form__input input-checkbox" type="checkbox" name="ship_to_same_address" <?php if($ship_to_same_address)echo 'checked=""';?> /><span><?php esc_html_e( 'Shipping address is the same as my billing address?', 'woocommerce' );?></span>
		</label>
	</h4>

<?php
	if($ship_to_same_address)
		echo '<div class="shipping-wrap" id="shipping_result" style="display:none"><h3>Shipping address</h3>';
	else
		echo '<div class="shipping-wrap" id="shipping_result"><h3>Shipping address</h3>';
	woocommerce_form_field('shipping_first_name', array(
        'type' => 'text',
        'label' => __('First Name'),
        'required' => true,
		'class' => array('half-col'),
    ),$shipping_first_name);
    woocommerce_form_field('shipping_last_name', array(
        'type' => 'text',
        'label' => __('Last Name'),
        'required' => true,
		'class' => array('half-col'),
    ),$shipping_last_name);
	woocommerce_form_field('shipping_phone', array(
        'type' => 'tel',
        'label' => __('Phone number'),
        'required' => true,
		'class' => array('half-col'),
    ), $shipping_phone);
	woocommerce_form_field('shipping_company', array(
        'type' => 'tel',
        'label' => __('Company name'),
        'required' => false,
		'class' => array('half-col'),
    ), $shipping_company);
    woocommerce_form_field('shipping_country', array(
        'type' => 'country',
        'class' => array('chzn-drop'),
        'label' => __('Please select your country'),
        'placeholder' => __('Choose your country.'),
        'required' => true,
        'clear' => true
    ), $shipping_country);	
	woocommerce_form_field('shipping_postcode', array(
        'type' => 'text',
        'label' => __('Zip Code'),
        'required' => true,
		'class' => array('half-col'),
    ), $shipping_postcode);
    woocommerce_form_field('shipping_address_1', array(
        'type' => 'text',
        'label' => __('Address'),
		'class' => array('three-col'),
        'required' => true,
    ), $shipping_address_1);
    woocommerce_form_field('shipping_address_2', array(
        'type' => 'text',
        'label' => __('Apt'),
        'required' => false,
		'class' => array('three-col'),
    ), $shipping_address_2);   
    woocommerce_form_field('shipping_city', array(
        'type' => 'text',
        'label' => __('City'),
        'required' => true,
		'class' => array('half-col'),
    ), $shipping_city);
	 woocommerce_form_field('shipping_state', array(
        'type' => 'state',
        'label' => __('State'),
        'required' => true,
		'class' => array('half-col'),
    ), $shipping_state);
	echo '</div>';
    

}

add_action( 'woocommerce_save_account_details_errors','wooc_validate_custom_field', 10, 1 );

function wooc_validate_custom_field( $args )
{
	if ( empty( $_POST['billing_first_name'] ) )
        $args->add( 'error', __( 'Billing firstname is a required field.', 'woocommerce' ),'');
	if ( empty( $_POST['billing_last_name'] ) )
        $args->add( 'error', __( 'Billing lastname is a required field.', 'woocommerce' ),'');
	if ( empty( $_POST['billing_phone'] ) )
        $args->add( 'error', __( 'Billing phone is a required field.', 'woocommerce' ),'');
	if ( empty( $_POST['billing_country'] ) )
        $args->add( 'error', __( 'Billing country is a required field.', 'woocommerce' ),'');
	if ( empty( $_POST['billing_address_1'] ) )
        $args->add( 'error', __( 'Billing address is a required field.', 'woocommerce' ),'');
	if ( empty( $_POST['billing_postcode'] ) )
        $args->add( 'error', __( 'Billing postcode is a required field.', 'woocommerce' ),'');
	if ( empty( $_POST['billing_city'] ) )
        $args->add( 'error', __( 'Town / City is a required field.', 'woocommerce' ),'');
	
	if( !isset( $_POST['ship_to_same_address'] ) ){
		if ( empty( $_POST['shipping_first_name'] ) )
			$args->add( 'error', __( 'Shipping firstname is a required field.', 'woocommerce' ),'');
		if ( empty( $_POST['shipping_last_name'] ) )
			$args->add( 'error', __( 'Shipping lastname is a required field.', 'woocommerce' ),'');
		if ( empty( $_POST['shipping_last_name'] ) )
			$args->add( 'error', __( 'Shipping lastname is a required field.', 'woocommerce' ),'');
		if ( empty( $_POST['shipping_phone'] ) )
			$args->add( 'error', __( 'Shipping phone number is a required field.', 'woocommerce' ),'');
		if ( empty( $_POST['shipping_country'] ) )
			$args->add( 'error', __( 'Shipping country is a required field.', 'woocommerce' ),'');
		if ( empty( $_POST['shipping_address_1'] ) )
			$args->add( 'error', __( 'Shipping address is a required field.', 'woocommerce' ),'');
		if ( empty( $_POST['shipping_postcode'] ) )
			$args->add( 'error', __( 'Shipping postcode is a required field.', 'woocommerce' ),'');
		if ( empty( $_POST['shipping_city'] ) )
			$args->add( 'error', __( 'Shipping city is a required field.', 'woocommerce' ),'');	
		if ( empty( $_POST['shipping_country'] ) )
			$args->add( 'error', __( 'Shipping country is a required field.', 'woocommerce' ),'');
    }
}

// Save the custom field 'favorite_color' 
add_action( 'woocommerce_save_account_details', 'save_favorite_color_account_details', 12, 1 );
function save_favorite_color_account_details( $user_id ) {
   
    if( isset( $_POST['billing_first_name'] ) )
        update_user_meta( $user_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	if( isset( $_POST['billing_last_name'] ) )
        update_user_meta( $user_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
	if( isset( $_POST['billing_company'] ) )
        update_user_meta( $user_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );
	if( isset( $_POST['billing_country'] ) )
        update_user_meta( $user_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );
	if( isset( $_POST['billing_address_1'] ) )
        update_user_meta( $user_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
	if( isset( $_POST['billing_address_2'] ) )
        update_user_meta( $user_id, 'billing_address_2', sanitize_text_field( $_POST['billing_address_2'] ) );
	if( isset( $_POST['billing_postcode'] ) )
        update_user_meta( $user_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );
	if( isset( $_POST['billing_city'] ) )
        update_user_meta( $user_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
	if( isset( $_POST['billing_state'] ) )
        update_user_meta( $user_id, 'billing_state', sanitize_text_field( $_POST['billing_state'] ) );
	if( isset( $_POST['billing_phone'] ) )
        update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
	if( isset( $_POST['billing_email'] ) )
        update_user_meta( $user_id, 'billing_email', sanitize_text_field( $_POST['billing_email'] ) );
	
	if( isset( $_POST['shipping_first_name'] ) )
        update_user_meta( $user_id, 'shipping_first_name', sanitize_text_field( $_POST['shipping_first_name'] ) );
	if( isset( $_POST['shipping_last_name'] ) )
        update_user_meta( $user_id, 'shipping_last_name', sanitize_text_field( $_POST['shipping_last_name'] ) );
	if( isset( $_POST['shipping_phone'] ) )
        update_user_meta( $user_id, 'shipping_phone', sanitize_text_field( $_POST['shipping_phone'] ) );
	if( isset( $_POST['shipping_company'] ) )
        update_user_meta( $user_id, 'shipping_company', sanitize_text_field( $_POST['shipping_company'] ) );
	if( isset( $_POST['shipping_country'] ) )
        update_user_meta( $user_id, 'shipping_country', sanitize_text_field( $_POST['shipping_country'] ) );
	if( isset( $_POST['shipping_address_1'] ) )
        update_user_meta( $user_id, 'shipping_address_1', sanitize_text_field( $_POST['shipping_address_1'] ) );
	if( isset( $_POST['shipping_address_2'] ) )
        update_user_meta( $user_id, 'shipping_address_2', sanitize_text_field( $_POST['shipping_address_2'] ) );
	if( isset( $_POST['shipping_postcode'] ) )
        update_user_meta( $user_id, 'shipping_postcode', sanitize_text_field( $_POST['shipping_postcode'] ) );
	if( isset( $_POST['shipping_city'] ) )
        update_user_meta( $user_id, 'shipping_city', sanitize_text_field( $_POST['shipping_city'] ) );
	if( isset( $_POST['shipping_state'] ) )
        update_user_meta( $user_id, 'shipping_state', sanitize_text_field( $_POST['shipping_state'] ) );
	
	//if( isset( $_POST['ship_to_same_address'] ) )
        update_user_meta( $user_id, 'ship_to_same_address', sanitize_text_field( $_POST['ship_to_same_address'] ) );
}


/****** Create New Tab Newsletter in Myaccount ******/
function mnb_add_newsletter_endpoint() {
    add_rewrite_endpoint( 'newsletter', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'delete_account', EP_ROOT | EP_PAGES );
}  
add_action( 'init', 'mnb_add_newsletter_endpoint' );  
// ------------------
// 2. Add new query
function mnb_newsletter_query_vars( $vars ) {
    $vars[] = 'newsletter';
	$vars[] = 'delete_account';
    return $vars;
}  
add_filter( 'query_vars', 'mnb_newsletter_query_vars', 0 );  
// ------------------
// 3. Insert the new endpoint 
function mnb_add_newsletter_link_my_account( $items ) {
    $main_item = array();
	if(!empty($items)){
		foreach($items as $i_key => $i_value){
			$main_item[$i_key] = $i_value;
			if($i_key == 'orders'){				
				$main_item['newsletter'] = 'Newsletter';
			}
		}
	}
	$main_item['delete_account'] = 'Delete account';
    return $main_item;
}  
add_filter( 'woocommerce_account_menu_items', 'mnb_add_newsletter_link_my_account' );
// ------------------
// 4. Add content to the new endpoint  
function mnb_newsletter_content() {
	$user_id = get_current_user_id();
	$is_subscribe = get_user_meta($user_id, 'is_subscribe');
	$nwl_section_title = get_field('nwl_section_title', 'option');
	$nwl_section_content = get_field('nwl_section_content', 'option');
?>

<div class="newsletter-content">
	<?php
		if(!empty($nwl_section_title))echo '<h2>'.$nwl_section_title.'</h2>';
		echo $nwl_section_content;
	?>
	<div class="switch-toggle">
		<label class="switch">
		  <input type="checkbox" name="is_subscribe" id="is_subscribe_chk" <?php if($is_subscribe)echo 'checked=""';?>>
		  <span class="slider round"></span>
		</label>
		<p class="message-cls"></p>
	</div>
</div>

<?php
}  
add_action( 'woocommerce_account_newsletter_endpoint', 'mnb_newsletter_content' );

function mnb_delete_account_content(){
	wp_logout();
	wp_redirect(home_url());
	exit;	
}
add_action( 'woocommerce_account_delete_account_endpoint', 'mnb_delete_account_content' );
/****** Create New Tab Newsletter in Myaccount ******/

/***** Empty cart ***/
add_action('wp_ajax_is_subscribe_update', 'is_subscribe_update');
add_action('wp_ajax_nopriv_is_subscribe_update', 'is_subscribe_update'); 

function is_subscribe_update() {
	global $woocommerce;
	$user_id = get_current_user_id();
	
	$is_subscribe = $_REQUEST['is_subscribe'];
	
	update_user_meta($user_id, 'is_subscribe', sanitize_text_field($is_subscribe));
	$returned = ['status'=>'success','msg'=>'Your order has been reset!'];       
	
	die(json_encode($returned));
}
/***** Empty cart ***/

/******* Product Detail Page *******/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
//remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

add_action('woocommerce_before_single_product_summary', 'woocommerce_before_single_product_summary_wrap', 10);
function woocommerce_before_single_product_summary_wrap(){
	echo '<section class="summary-wrap">';
	/** images and description start**/
	echo '<div class="listContent-box">';
}
add_action('woocommerce_after_single_product_summary', 'woocommerce_after_single_product_summary_wrap', 10);
function woocommerce_after_single_product_summary_wrap(){
	$p_id = get_the_ID();
	$product_information = get_field('product_information', $p_id);
?>
	<div class="discription-wrap in-tablet-only">			
		<div class="discription-box">
			<h5>Description</h5>
			<?php the_content();?>
		</div>
		<?php if(!empty($product_information))echo '<div class="information-box">'.$product_information.'</div>';?>
	</div>
<?php
	echo '</section>';
}

add_action('woocommerce_before_single_product_summary', 'woocommerce_before_single_product_summary_description', 30);
function woocommerce_before_single_product_summary_description(){
	$p_id = get_the_ID();
	$product_information = get_field('product_information', $p_id);
?>
	<div class="discription-wrap">
		<div class="discription-box">
			<h5>Description</h5>
			<?php the_content();?>
		</div>
		<?php if(!empty($product_information))echo '<div class="information-box">'.$product_information.'</div>';?>
	</div>
	<!-- /** images and description end**/ -->
	</div>
<?php
}

add_action('woocommerce_single_product_summary', 'woocommerce_single_product_summary_shipping_info', 40);
function woocommerce_single_product_summary_shipping_info(){
	$p_id = get_the_ID();
	$shipping_content = get_field('shipping_content', $p_id);
	if(!empty($shipping_content))echo '<div class="shipping-info">'.$shipping_content.'</div>';
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to bag', 'woocommerce' ); 
}



/***** Update Variation Image ***/
add_action('wp_ajax_update_variation_image', 'update_variation_image');
add_action('wp_ajax_nopriv_update_variation_image', 'update_variation_image'); 

function update_variation_image() {
	
	$var_id = $_REQUEST['var_id'];
	$variation = new WC_Product_Variation( $var_id );
	$image_id = $variation->get_image_id();
	$image_array = wp_get_attachment_image_src($image_id, 'full');
	$image_src = $image_array[0];
	$i_flag = false;
	ob_start();
	if(!empty($image_src)){
		$i_flag = true;
?>
		<div class="list-item">
			<div class="media-box has-image">
				<div class="img-box"><img src="<?php echo $image_src;?>" alt="<?php the_title();?>"></div>
			</div>
		</div>
<?php
	}
	$has_variation_gallery_images = (bool)get_post_meta($var_id, 'rtwpvg_images', true);
	if ($has_variation_gallery_images) {
		$gallery_images = (array)get_post_meta($var_id, 'rtwpvg_images', true);
	} else {
		$gallery_images = $variation->get_gallery_image_ids();
	}
	if(!empty($gallery_images)){
		foreach($gallery_images as $g_key => $g_value){
			$image_array = wp_get_attachment_image_src($g_value, 'full');
			$image_src = $image_array[0];
			if(!empty($image_src)){
?>
			<div class="list-item">
				<div class="media-box has-image">
					<div class="img-box"><img src="<?php echo $image_src;?>" alt="<?php the_title();?>"></div>
				</div>
			</div>
<?php
			}
		}		
	}
	$returned['html'] = ob_get_contents();
	ob_end_clean();
	
	
	//print_r($gallery_images);
	
	

	if ( $i_flag ) {    
		$returned['status'] = 'success'; 
	}
	else{
		$returned['status'] = 'error'; 
	}
	die(json_encode($returned));
}
/***** Update Variation Image ***/


/***** Plus and minus add in quantity ***/
add_action('woocommerce_before_quantity_input_field', 'woocommerce_before_quantity_input_field_minus');
function woocommerce_before_quantity_input_field_minus(){
	echo '<div class="wac-qty-button"><b><a href="" class="wac-btn-sub">-</a></b></div>';
}
add_action('woocommerce_after_quantity_input_field', 'woocommerce_after_quantity_input_field_plus');
function woocommerce_after_quantity_input_field_plus(){
	echo '<div class="wac-qty-button"><b><a href="" class="wac-btn-inc">+</a></b></div>';
}
/***** Plus and minus add in quantity ***/

/** Gallery Images **/
function get_product_gallery_images(){
	global $product;
	$product_gallery = get_field('product_gallery', $product->id);
	$img = get_the_post_thumbnail_url();

	if(!empty($product_gallery)){
		foreach($product_gallery as $pg_key => $pg_value){
			$image_or_video = $pg_value['image_or_video'];
			
			if($image_or_video == 'Video'){			
				$video_type = $pg_value['video_type'];
				$video_file = $pg_value['video_file'];
				$embed_script = $pg_value['embed_script'];
	?>
			<div class="list-item swiper-slide">
				<div class="media-box has-video">				
					<div class="video-box">
						<?php if($video_type == 'file_upload' && !empty($video_file)){?>
							<div class="upload-video">
								<video poster="<?php echo $img;?>" autoplay="" loop="" muted>
									<source src="<?php echo $video_file['url'];?>">
									<p class="warning">Your browser does not support HTML5 video.</p>
								</video>
							</div>
						<?php 
							}elseif($video_type == 'youtube' && !empty($embed_script)){
								echo '<div class="youtube-video">'.$embed_script.'</div>';					
							}elseif($video_type == 'vimeo' && !empty($embed_script)){
								echo '<div class="vimeo-video">'.$embed_script.'</div>';
							}
						?>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>
	<?php
			} else {
				$image = $pg_value['image'];
				if(!empty($image)){
	?>
				<div class="list-item swiper-slide">
					<div class="media-box has-image">
						<div class="img-box"><img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>"></div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
				
	<?php
				}
			}
		}
	}	
}
/** Gallery Images **/
/******* Product Detail Page *******/

/******** Cart Page ********/
function checkout_stepbox(){
	global $woocommerce;
	$cart_cls = '';
	if(is_cart())
		$cart_cls = 'is_active';
	
	$checkout_cls = '';
	if(is_checkout()){
		$cart_cls = 'is_active';
		$checkout_cls = 'is_active';
	}
	
	$confirmation_cls = '';
	if(is_wc_endpoint_url( 'order-received' )){
		$cart_cls = 'is_active';
		$checkout_cls = 'is_active';
		$confirmation_cls = 'is_active';
	}
?>
		<div class="cartStep-box">
			<div class="step-wrap">
				<div class="step-item <?php echo $cart_cls;?>">
					<div class="step-label">Shopping Cart</div>
				</div>
				<div class="step-item <?php echo $checkout_cls;?>">
					<div class="step-label">Checkout details</div>
				</div>
				<div class="step-item <?php echo $confirmation_cls;?>">
					<div class="step-label">Order completed</div>
				</div>
			</div>
		</div>	
<?php
}
/******** Cart Page ********/

function my_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" placeholder="Search …" value="' . get_search_query() . '" name="s">
				</label>
				<input type="submit" class="search-submit button button-fill " value="'. esc_attr__( 'Search' ) .'">
			</form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form', 100 );

add_action('comment_form_defaults', 'comment_form_submit_field_button_cls', 10, 2);
function comment_form_submit_field_button_cls($argu){
	$argu['class_submit'] = 'submit button button-fill';
	return $argu;
}

add_filter('site_transient_update_plugins', 'filter_plugin_updates');
function filter_plugin_updates($value) {
    unset($value->response['woocommerce-ajax-cart/wooajaxcart.php']);
    return $value;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
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
	<?php
	
	$fragments['div.cart-box'] = ob_get_clean();
	
	return $fragments;
}

add_filter( 'woocommerce_product_upsells_products_heading', 'bbloomer_translate_may_also_like' );
  
function bbloomer_translate_may_also_like() {
   return 'RELATED PRODUCTS';
}