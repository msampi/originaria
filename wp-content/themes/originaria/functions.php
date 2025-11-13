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
			// Esperar un poco más para asegurar que Isotope esté completamente inicializado
			setTimeout(function() {
				if (typeof jQuery.fn.isotope !== 'undefined') {
					jQuery('.portfolio-wrapper').each(function() {
						var $grid = jQuery(this);
						if ($grid.length && $grid.hasClass('grid')) {
							// Verificar si ya está inicializado
							if ($grid.data('isotope')) {
								$grid.isotope('layout');
								// Asegurar que los items sean visibles
								$grid.find('.grid-item').css('visibility', 'visible');
							}
						}
					});
				}
			}, 1000);
		});
		
		// Suprimir errores específicos de theme-vendors y revolution que no afectan la funcionalidad
		window.addEventListener('error', function(e) {
			// Suprimir errores de "Cannot read properties of null (reading 'nodeName')"
			// que ocurren en theme-vendors.min.js sin afectar la funcionalidad
			if (e.message && e.message.includes("Cannot read properties of null") && 
			    e.filename && e.filename.includes('theme-vendors.min.js')) {
				e.preventDefault();
				return true;
			}
		}, true);
		
		// Suprimir warnings de Revolution Slider sobre valores undefined
		var originalConsoleWarn = console.warn;
		console.warn = function() {
			var message = arguments[0];
			if (typeof message === 'string' && 
			    (message.includes('invalid width tween value') || 
			     message.includes('invalid height tween value'))) {
				return;
			}
			originalConsoleWarn.apply(console, arguments);
		};
	</script>
	<?php
}
add_action( 'wp_footer', 'originaria_fix_isotope', 999 );

/**
 * Register Custom Post Type: Proyectos
 */
function originaria_register_proyectos_cpt() {
	$labels = array(
		'name'               => 'Proyectos',
		'singular_name'      => 'Proyecto',
		'menu_name'          => 'Proyectos',
		'add_new'            => 'Agregar Nuevo',
		'add_new_item'       => 'Agregar Nuevo Proyecto',
		'edit_item'          => 'Editar Proyecto',
		'new_item'           => 'Nuevo Proyecto',
		'view_item'          => 'Ver Proyecto',
		'search_items'       => 'Buscar Proyectos',
		'not_found'          => 'No se encontraron proyectos',
		'not_found_in_trash' => 'No se encontraron proyectos en la papelera',
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'proyecto' ),
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => false,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		'supports'            => array( 'title', 'thumbnail' ),
	);

	register_post_type( 'proyecto', $args );
}
add_action( 'init', 'originaria_register_proyectos_cpt' );

/**
 * Add Meta Boxes for Proyectos
 */
function originaria_add_proyecto_meta_boxes() {
	add_meta_box(
		'proyecto_details',
		'Detalles del Proyecto',
		'originaria_proyecto_meta_box_callback',
		'proyecto',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'originaria_add_proyecto_meta_boxes' );

/**
 * Meta Box Callback
 */
function originaria_proyecto_meta_box_callback( $post ) {
	wp_nonce_field( 'originaria_save_proyecto_meta', 'originaria_proyecto_nonce' );
	
	$subtitulo = get_post_meta( $post->ID, '_proyecto_subtitulo', true );
	$descripcion = get_post_meta( $post->ID, '_proyecto_descripcion', true );
	$tamano = get_post_meta( $post->ID, '_proyecto_tamano', true );
	$orden = get_post_meta( $post->ID, '_proyecto_orden', true );
	?>
	
	<table class="form-table">
		<tr>
			<th><label for="proyecto_subtitulo">Subtítulo/Categoría</label></th>
			<td>
				<input type="text" id="proyecto_subtitulo" name="proyecto_subtitulo" value="<?php echo esc_attr( $subtitulo ); ?>" class="regular-text">
				<p class="description">Ejemplo: Branding and Brochure</p>
			</td>
		</tr>
		<tr>
			<th><label for="proyecto_descripcion">Descripción</label></th>
			<td>
				<textarea id="proyecto_descripcion" name="proyecto_descripcion" rows="3" class="large-text"><?php echo esc_textarea( $descripcion ); ?></textarea>
				<p class="description">Descripción breve del proyecto (opcional)</p>
			</td>
		</tr>
		<tr>
			<th><label for="proyecto_tamano">Tamaño en la grilla</label></th>
			<td>
				<select id="proyecto_tamano" name="proyecto_tamano">
					<option value="normal" <?php selected( $tamano, 'normal' ); ?>>Normal (1 columna)</option>
					<option value="ancho" <?php selected( $tamano, 'ancho' ); ?>>Ancho (2 columnas)</option>
					<option value="alto" <?php selected( $tamano, 'alto' ); ?>>Alto (altura doble)</option>
					<option value="grande" <?php selected( $tamano, 'grande' ); ?>>Grande (2x2)</option>
				</select>
				<p class="description">Define cómo se mostrará el proyecto en la grilla</p>
			</td>
		</tr>
		<tr>
			<th><label for="proyecto_orden">Orden de visualización</label></th>
			<td>
				<input type="number" id="proyecto_orden" name="proyecto_orden" value="<?php echo esc_attr( $orden ? $orden : 0 ); ?>" min="0" step="1">
				<p class="description">Número para ordenar los proyectos (menor = primero)</p>
			</td>
		</tr>
	</table>
	
	<div style="margin-top: 20px; padding: 15px; background: #f0f0f1; border-left: 4px solid #2271b1;">
		<strong>Nota:</strong> No olvides establecer una imagen destacada para el proyecto en el panel lateral derecho.
	</div>
	<?php
}

/**
 * Save Meta Box Data
 */
function originaria_save_proyecto_meta( $post_id ) {
	// Verificar nonce
	if ( ! isset( $_POST['originaria_proyecto_nonce'] ) || ! wp_verify_nonce( $_POST['originaria_proyecto_nonce'], 'originaria_save_proyecto_meta' ) ) {
		return;
	}

	// Verificar autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Verificar permisos
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Guardar subtítulo
	if ( isset( $_POST['proyecto_subtitulo'] ) ) {
		update_post_meta( $post_id, '_proyecto_subtitulo', sanitize_text_field( $_POST['proyecto_subtitulo'] ) );
	}

	// Guardar descripción
	if ( isset( $_POST['proyecto_descripcion'] ) ) {
		update_post_meta( $post_id, '_proyecto_descripcion', sanitize_textarea_field( $_POST['proyecto_descripcion'] ) );
	}

	// Guardar tamaño
	if ( isset( $_POST['proyecto_tamano'] ) ) {
		$tamano_permitido = array( 'normal', 'ancho', 'alto', 'grande' );
		$tamano = sanitize_text_field( $_POST['proyecto_tamano'] );
		if ( in_array( $tamano, $tamano_permitido ) ) {
			update_post_meta( $post_id, '_proyecto_tamano', $tamano );
		}
	}

	// Guardar orden
	if ( isset( $_POST['proyecto_orden'] ) ) {
		update_post_meta( $post_id, '_proyecto_orden', absint( $_POST['proyecto_orden'] ) );
	}
}
add_action( 'save_post_proyecto', 'originaria_save_proyecto_meta' );

/**
 * Customize login logo
 */
function originaria_custom_login_logo() {
	$logo_url = get_template_directory_uri() . '/images/logos/logo-color-sin-fondo.png';
	?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url('<?php echo esc_url( $logo_url ); ?>');
			height: 50px;
			width: 220px;
			background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
			padding-bottom: 0;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'originaria_custom_login_logo' );

function originaria_custom_login_logo_url() {
	return home_url( '/' );
}
add_filter( 'login_headerurl', 'originaria_custom_login_logo_url' );

function originaria_custom_login_logo_title() {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'originaria_custom_login_logo_title' );

