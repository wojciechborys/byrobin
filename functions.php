<?php
/**
 * robin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package robin
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'robin_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function robin_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on robin, use a find and replace
		 * to change 'robin' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'robin', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'robin' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'robin_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'robin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function robin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'robin_content_width', 640 );
}
add_action( 'after_setup_theme', 'robin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function robin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'robin' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'robin' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Topbar for Shop', 'robin' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here.', 'robin' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop Filter', 'robin' ),
			'id'            => 'sidebar-shop-filter',
			'description'   => esc_html__( 'Add widgets here.', 'robin' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'robin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function robin_scripts() {
	wp_enqueue_style( 'robin-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'slick-style', get_theme_file_uri( '/assets/css/library/slick.css' ), array( 'robin-style' ), '1.0' );
	wp_enqueue_style( 'megamenu-style', get_theme_file_uri( '/assets/css/megamenu.css' ), array( 'robin-style' ), '1.0' );
	wp_enqueue_style( 'dashboard-style', get_theme_file_uri( '/assets/css/dashboard-style.css' ), array( 'robin-style' ), '1.0' );
	wp_enqueue_style( 'main-style', get_theme_file_uri( '/assets/css/main.css' ), array( 'robin-style' ), '1.0' );
	wp_style_add_data( 'robin-style', 'rtl', 'replace' );

	wp_enqueue_script( 'robin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'gsap-script', get_theme_file_uri( '/assets/js/library/gsap.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'smooth-scrollbar-script', get_theme_file_uri( '/assets/js/library/smooth-scrollbar.js' ), array(), '1.0', true );
	wp_enqueue_script( 'ScrollTrigger-script', get_theme_file_uri( '/assets/js/library/ScrollTrigger.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'ScrollToPlugin-script', get_theme_file_uri( '/assets/js/library/ScrollToPlugin.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'slick-script', get_theme_file_uri( '/assets/js/library/slick.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'browser-selector-script', get_theme_file_uri( '/assets/js/scrollCustom.js' ), array(), '1.0', true );
	wp_enqueue_script( 'scrollCustom-script', get_theme_file_uri( '/assets/js/library/css_browser_selector.min.js' ), array(), '1.0', true );
	wp_enqueue_script( 'general-script', get_theme_file_uri( '/assets/js/general.js' ), array(), '1.0', true );
	wp_enqueue_script( 'general-dev-js', get_theme_file_uri( '/assets/js/general_dev.js' ), array(), '1.0', true );
	
	wp_localize_script( 'general-dev-js', 'myAjax_new', array( 
		'site_url' => site_url(),
		'ajaxurl' => admin_url( 'admin-ajax.php' ), 
		'redirecturl' => get_permalink( get_option('woocommerce_myaccount_page_id') ),
		'loadingmessage' => __('Sending user info, please wait...')
	));
	wp_enqueue_script( 'general-dev-js' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if(!is_admin()){
		wp_dequeue_script('rtwpvg-slider');
		wp_dequeue_script('rtwpvg');
		wp_dequeue_style('rtwpvg-slider');
		wp_dequeue_style('rtwpvg');
	}
}
add_action( 'wp_enqueue_scripts', 'robin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Functions
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Woocommerce Functions.
 */
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Detect Device Functions.
 */
require get_template_directory() . '/inc/device_detect.php';
