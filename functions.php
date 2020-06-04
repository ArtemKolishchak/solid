<?php
/**
 * solid functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package solid
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'solid_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function solid_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on solid, use a find and replace
		 * to change 'solid' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'solid', get_template_directory() . '/languages' );

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

		add_image_size( 'blog-list', 850, 400, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( 
			array(
			'header-menu' => esc_html__( 'Header', 'solid' ),
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
				'solid_custom_background_args',
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
add_action( 'after_setup_theme', 'solid_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function solid_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'solid_content_width', 640 );
}
add_action( 'after_setup_theme', 'solid_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function solid_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'solid' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'solid' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="spacing"></div></section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><div class="hline"></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'solid' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here.', 'solid' ),
		'before_widget' => '<div id="%1$s" class="col-lg-4 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4><div class="hline-w"></div>',
	) );
}
add_action( 'widgets_init', 'solid_widgets_init' );

/*Custom Categories*/
function solid_categories($html, $args) {
	$html = str_replace('</a> (', '</a><span class="badge badge-theme pull-right">', $html);
	$html = str_replace(')', '</span>', $html);
	$html = str_replace('<a href', '<i class="list-categories-arrow fa fa-angle-right"></i><a href', $html);

	return $html;
}

add_filter( 'wp_list_categories', 'solid_categories', 10, 2 );

/*Custom Tag Cloud*/
function solid_tag_cloud($args) {

	$args['smallest']  = '14';
	$args['largest']   = '14';
	$args['unit']      = 'px';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'solid_tag_cloud');

/*Custom Tag Cloud change class*/
function solid_tag_cloud_link_class($tags_data) {

	$filtered_tags_data = array();

	foreach ($tags_data as $tag_data) {
		$tag_data['class'] = $tag_data['class'] . ' btn btn-theme';
		$filtered_tags_data[] = $tag_data;
	}

	return $filtered_tags_data;
}

add_filter( 'wp_generate_tag_cloud_data', 'solid_tag_cloud_link_class');

/**
 * Enqueue scripts and styles.
 *
 * Register and Enqueue Styles.
 */
function solid_styles() {
	wp_enqueue_style( 'solid-style', get_stylesheet_uri() );

	/*Bootstrap CSS File*/
	wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/assets/lib/bootstrap/css/bootstrap.min.css', array( 'solid-style' ) );

	/*Libraries CSS Files*/
	wp_enqueue_style( 'font-awesome', get_template_directory_uri(). '/assets/lib/font-awesome/css/font-awesome.min.css', array( 'solid-style' ) );

	wp_enqueue_style( 'hoverex-all', get_template_directory_uri(). '/assets/lib/hover/css/hoverex-all.css', array( 'solid-style' ) );

	wp_enqueue_style( 'prettyphoto', get_template_directory_uri(). '/assets/lib/prettyphoto/css/prettyphoto.css', array( 'solid-style' ) );

	/*Main Stylesheet File*/
	wp_enqueue_style( 'solid-main-style', get_template_directory_uri(). '/assets/css/style.css', array( 'solid-style' ) );
}

add_action( 'wp_enqueue_scripts', 'solid_styles' );

/**
 * Register and Enqueue Scripts.
 */
 function solid_scripts() {
 	
 	global $solid_option;

	/*jQuery*/
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, null, true );
    wp_enqueue_script( 'jquery' );
 	
	/*Bootstrap*/
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/lib/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '', true );

	/*Hoverdir*/
	wp_enqueue_script( 'jquery.hoverdir', get_template_directory_uri() . '/assets/lib/hover/js/hoverdir.js', array( 'jquery' ), '', true );

	/*Hoverex*/
	wp_enqueue_script( 'jquery.hoverex', get_template_directory_uri() . '/assets/lib/hover/js/hoverex.min.js', array( 'jquery' ), '', true );

	/*Isotope*/
	wp_enqueue_script( 'jquery.isotope', get_template_directory_uri() . '/assets/lib/isotope/isotope.min.js', array( 'jquery' ), '', true );

	/*PrettyPhoto*/
	wp_enqueue_script( 'jquery.prettyphoto', get_template_directory_uri() . '/assets/lib/prettyphoto/js/prettyphoto.js', array( 'jquery' ), '', true );
	
	/*Main Javascript File*/
	wp_enqueue_script( 'solid-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '', true );

	/*Google Maps APIs*/
	 wp_enqueue_script( 'map-api-key', 'https://maps.googleapis.com/maps/api/js?key=' . $solid_option['map-api-key']);

	/*Map*/
	if (is_page_template('page-contact.php')) {
		wp_enqueue_script( 'solid-map', get_template_directory_uri() . '/assets/js/map.js', array( 'jquery' ), '', true );
	}

	// Localize the script with new data
	$map_options = array(
    	'lat'	 => $solid_option['map-lat'],
    	'lng'    => $solid_option['map-lng'],
    	'zoom'   => $solid_option['map-zoom'],
	);
	wp_localize_script( 'solid-map', 'solid_map', $map_options );
	
	wp_enqueue_script( 'solid-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'solid-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
    	
add_action( 'wp_enqueue_scripts', 'solid_scripts' );

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

//Register TGM Plugin Activation
require get_template_directory() . '/inc/init-tgm-plugin-activation.php';

//Theme Options
require get_template_directory() . '/inc/theme-options.php';

//ACF
require get_template_directory() . '/inc/acf-options.php';

/**
 * Classes.
 */

//Register Custom Navigation Walker
require get_template_directory() . '/inc/classes/wp-bootstrap-navwalker.php';



