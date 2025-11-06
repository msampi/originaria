<?php
/**
 * Originaria Theme Functions
 *
 * @package Originaria
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define theme version
 */
define( 'ORIGINARIA_VERSION', '1.0.0' );

/**
 * Theme setup
 */
function originaria_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'originaria' ),
		)
	);

	// Switch default core markup to output valid HTML5.
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for custom logo.
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
add_action( 'after_setup_theme', 'originaria_setup' );

/**
 * Enqueue scripts and styles
 */
function originaria_scripts() {
	$theme_version = ORIGINARIA_VERSION;

	// Stylesheets
	wp_enqueue_style( 'originaria-bootsnav', get_template_directory_uri() . '/css/bootsnav.css', array(), $theme_version );
	wp_enqueue_style( 'originaria-font-icons', get_template_directory_uri() . '/css/font-icons.min.css', array(), $theme_version );
	wp_enqueue_style( 'originaria-theme-vendors', get_template_directory_uri() . '/css/theme-vendors.min.css', array(), $theme_version );
	
	// Revolution Slider CSS
	wp_enqueue_style( 'originaria-revolution-settings', get_template_directory_uri() . '/revolution/css/settings.css', array(), $theme_version );
	wp_enqueue_style( 'originaria-revolution-layers', get_template_directory_uri() . '/revolution/css/layers.css', array(), $theme_version );
	wp_enqueue_style( 'originaria-revolution-navigation', get_template_directory_uri() . '/revolution/css/navigation.css', array(), $theme_version );
	
	// Main styles
	wp_enqueue_style( 'originaria-main-style', get_template_directory_uri() . '/css/style.css', array(), $theme_version );
	wp_enqueue_style( 'originaria-responsive', get_template_directory_uri() . '/css/responsive.css', array(), $theme_version );

	// Scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'originaria-bootsnav', get_template_directory_uri() . '/js/bootsnav.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'originaria-jquery-nav', get_template_directory_uri() . '/js/jquery.nav.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'originaria-hamburger', get_template_directory_uri() . '/js/hamburger-menu.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'originaria-theme-vendors', get_template_directory_uri() . '/js/theme-vendors.min.js', array( 'jquery' ), $theme_version, true );
	
	// Revolution Slider
	wp_enqueue_script( 'originaria-revolution-tools', get_template_directory_uri() . '/revolution/js/jquery.themepunch.tools.min.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'originaria-revolution', get_template_directory_uri() . '/revolution/js/jquery.themepunch.revolution.min.js', array( 'jquery', 'originaria-revolution-tools' ), $theme_version, true );
	
	// Revolution Slider Extensions
	wp_enqueue_script( 'originaria-revolution-actions', get_template_directory_uri() . '/revolution/js/extensions/revolution.extension.actions.min.js', array( 'originaria-revolution' ), $theme_version, true );
	wp_enqueue_script( 'originaria-revolution-layeranimation', get_template_directory_uri() . '/revolution/js/extensions/revolution.extension.layeranimation.min.js', array( 'originaria-revolution' ), $theme_version, true );
	wp_enqueue_script( 'originaria-revolution-navigation', get_template_directory_uri() . '/revolution/js/extensions/revolution.extension.navigation.min.js', array( 'originaria-revolution' ), $theme_version, true );
	wp_enqueue_script( 'originaria-revolution-parallax', get_template_directory_uri() . '/revolution/js/extensions/revolution.extension.parallax.min.js', array( 'originaria-revolution' ), $theme_version, true );
	wp_enqueue_script( 'originaria-revolution-slideanims', get_template_directory_uri() . '/revolution/js/extensions/revolution.extension.slideanims.min.js', array( 'originaria-revolution' ), $theme_version, true );
	
	// Main script
	wp_enqueue_script( 'originaria-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'originaria_scripts' );

/**
 * Add smooth scroll inline script
 */
function originaria_smooth_scroll() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// Smooth scroll para enlaces del menú lateral
			$('.sidebar-part2 a[href^="#"]').on('click', function(e) {
				e.preventDefault();
				
				var target = $(this.getAttribute('href'));
				if (target.length) {
					// Cerrar el menú lateral removiendo la clase left-nav-on
					$('body').removeClass('left-nav-on');
					
					// Cambiar el icono de vuelta a hamburguesa (remover clase active)
					$('#showRightPush').removeClass('active');
					
					// Scroll suave a la sección
					$('html, body').animate({
						scrollTop: target.offset().top - 80
					}, 1000);
				}
			});
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'originaria_smooth_scroll' );

/**
 * Fix Isotope initialization for portfolio grid and suppress vendor errors
 */
function originaria_fix_isotope() {
	?>
	<script type="text/javascript">
		jQuery(window).on('load', function() {
			// Asegurar que Isotope se inicialice correctamente
			if (typeof jQuery.fn.isotope !== 'undefined') {
				jQuery('.portfolio-wrapper').each(function() {
					var $grid = jQuery(this);
					if ($grid.length && $grid.hasClass('grid')) {
						$grid.isotope('layout');
					}
				});
			}
		});
		
		// Suprimir errores específicos de theme-vendors que no afectan la funcionalidad
		window.addEventListener('error', function(e) {
			// Suprimir errores de "Cannot read properties of null (reading 'nodeName')"
			// que ocurren en theme-vendors.min.js sin afectar la funcionalidad
			if (e.message && e.message.includes("Cannot read properties of null") && 
			    e.filename && e.filename.includes('theme-vendors.min.js')) {
				e.preventDefault();
				return true;
			}
		}, true);
	</script>
	<?php
}
add_action( 'wp_footer', 'originaria_fix_isotope', 999 );

