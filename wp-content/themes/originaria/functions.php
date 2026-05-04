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
define( 'ORIGINARIA_VERSION', '1.0.1' );

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
 * Enqueue media uploader scripts for admin
 */
function originaria_enqueue_admin_scripts( $hook ) {
	global $post_type;
	if ( ( $hook == 'post.php' || $hook == 'post-new.php' ) && $post_type == 'proyecto' ) {
		wp_enqueue_media();
	}
}
add_action( 'admin_enqueue_scripts', 'originaria_enqueue_admin_scripts' );

/**
 * Meta Box Callback
 */
function originaria_proyecto_meta_box_callback( $post ) {
	wp_nonce_field( 'originaria_save_proyecto_meta', 'originaria_proyecto_nonce' );
	
	$subtitulo = get_post_meta( $post->ID, '_proyecto_subtitulo', true );
	$descripcion = get_post_meta( $post->ID, '_proyecto_descripcion', true );
	$tamano = get_post_meta( $post->ID, '_proyecto_tamano', true );
	$orden = get_post_meta( $post->ID, '_proyecto_orden', true );
	$imagen_detalle = get_post_meta( $post->ID, '_proyecto_imagen_detalle', true );
	$imagen_detalle_url = '';
	if ( $imagen_detalle ) {
		$imagen_detalle_url = wp_get_attachment_image_url( $imagen_detalle, 'full' );
	}
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
			<th><label for="proyecto_imagen_detalle">Imagen de detalle</label></th>
			<td>
				<input type="hidden" id="proyecto_imagen_detalle" name="proyecto_imagen_detalle" value="<?php echo esc_attr( $imagen_detalle ); ?>">
				<div id="proyecto_imagen_detalle_preview" style="margin-bottom: 10px;">
					<?php if ( $imagen_detalle_url ) : ?>
						<img src="<?php echo esc_url( $imagen_detalle_url ); ?>" style="max-width: 300px; height: auto; display: block; margin-bottom: 10px;">
					<?php endif; ?>
				</div>
				<button type="button" class="button" id="proyecto_imagen_detalle_button">
					<?php echo $imagen_detalle ? 'Cambiar imagen' : 'Seleccionar imagen'; ?>
				</button>
				<button type="button" class="button" id="proyecto_imagen_detalle_remove" style="<?php echo $imagen_detalle ? '' : 'display:none;'; ?>">
					Eliminar imagen
				</button>
				<p class="description">Imagen que se mostrará en el modal de detalle. Si no se selecciona, se usará la imagen destacada.</p>
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
		<strong>Nota:</strong> No olvides establecer una imagen destacada para el proyecto en el panel lateral derecho (se usará en la grilla).
	</div>
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		var mediaUploader;
		
		$('#proyecto_imagen_detalle_button').on('click', function(e) {
			e.preventDefault();
			
			if (mediaUploader) {
				mediaUploader.open();
				return;
			}
			
			mediaUploader = wp.media({
				title: 'Seleccionar imagen de detalle',
				button: {
					text: 'Usar esta imagen'
				},
				multiple: false
			});
			
			mediaUploader.on('select', function() {
				var attachment = mediaUploader.state().get('selection').first().toJSON();
				$('#proyecto_imagen_detalle').val(attachment.id);
				$('#proyecto_imagen_detalle_preview').html('<img src="' + attachment.url + '" style="max-width: 300px; height: auto; display: block; margin-bottom: 10px;">');
				$('#proyecto_imagen_detalle_button').text('Cambiar imagen');
				$('#proyecto_imagen_detalle_remove').show();
			});
			
			mediaUploader.open();
		});
		
		$('#proyecto_imagen_detalle_remove').on('click', function(e) {
			e.preventDefault();
			$('#proyecto_imagen_detalle').val('');
			$('#proyecto_imagen_detalle_preview').html('');
			$('#proyecto_imagen_detalle_button').text('Seleccionar imagen');
			$(this).hide();
		});
	});
	</script>
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

	// Guardar imagen de detalle
	if ( isset( $_POST['proyecto_imagen_detalle'] ) ) {
		$imagen_detalle = absint( $_POST['proyecto_imagen_detalle'] );
		if ( $imagen_detalle > 0 ) {
			update_post_meta( $post_id, '_proyecto_imagen_detalle', $imagen_detalle );
		} else {
			delete_post_meta( $post_id, '_proyecto_imagen_detalle' );
		}
	}
}
add_action( 'save_post_proyecto', 'originaria_save_proyecto_meta' );

/**
 * Dynamic logo swap on scroll
 */
function originaria_dynamic_logo_script() {
	$theme_uri = get_template_directory_uri();
	$logos     = array(
		'home'      => $theme_uri . '/images/logos/originaria-logo-pictograma.svg',
		'nosotros'  => $theme_uri . '/images/logos/originaria-pictograma-01.svg',
		'servicios' => $theme_uri . '/images/logos/originaria-pictograma-02.svg',
		'proyectos' => $theme_uri . '/images/logos/originaria-pictograma-03.svg',
	);
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const logo = document.getElementById('logo-desktop');
			if (!logo) return;

			const logoMap = <?php echo wp_json_encode( $logos ); ?>;
			const sections = Object.keys(logoMap)
				.map(id => {
					const el = document.getElementById(id);
					if (!el) return null;
					return { id, el, logo: logoMap[id] };
				})
				.filter(Boolean)
				.sort((a, b) => a.el.offsetTop - b.el.offsetTop);

			let currentSrc = logo.getAttribute('src') || logoMap.home;
			logo.setAttribute('src', currentSrc);
			let isTransitioning = false;
			const fadeDuration = 220;

			const swapLogo = (newSrc) => {
				if (!newSrc || currentSrc === newSrc || isTransitioning) return;

				isTransitioning = true;
				const preload = new Image();

				preload.onload = () => {
					logo.classList.add('is-switching');

					setTimeout(() => {
						logo.setAttribute('src', newSrc);
						currentSrc = newSrc;

						requestAnimationFrame(() => {
							logo.classList.remove('is-switching');
							setTimeout(() => {
								isTransitioning = false;
							}, fadeDuration);
						});
					}, fadeDuration);
				};

				preload.onerror = () => {
					isTransitioning = false;
				};

				preload.src = newSrc;
			};

			const updateLogo = () => {
				if (window.innerWidth <= 991) {
					// Restaurar logo original en mobile
					swapLogo(logoMap.home);
					return;
				}

				const viewportPointer = window.scrollY + window.innerHeight * 0.25;
				let activeLogo = logoMap.home;

				for (let i = 0; i < sections.length; i++) {
					const section = sections[i];
					const top = section.el.offsetTop;
					const bottom = top + section.el.offsetHeight;

					if (viewportPointer >= top && viewportPointer < bottom) {
						activeLogo = section.logo;
						break;
					}

					if (viewportPointer >= bottom) {
						activeLogo = section.logo;
					}
				}

				swapLogo(activeLogo);
			};

			updateLogo();
			setTimeout(updateLogo, 350);
			setTimeout(updateLogo, 1000);
			window.addEventListener('scroll', updateLogo);
			window.addEventListener('resize', updateLogo);
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'originaria_dynamic_logo_script', 1200 );

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

/**
 * Modal de proyectos - JavaScript
 */
function originaria_proyecto_modal_script() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// Inicializar Isotope en cada slide del carousel
			function initCarouselIsotope() {
				$('.proyectos-carousel-grid').each(function() {
					var $grid = $(this);
					if ($grid.length && typeof $.fn.isotope !== 'undefined') {
						$grid.imagesLoaded(function() {
							$grid.removeClass('grid-loading');
							$grid.isotope({
								layoutMode: 'masonry',
								itemSelector: '.grid-item',
								percentPosition: true,
								masonry: {
									columnWidth: '.grid-sizer',
								}
							});
							
							// Establecer altura mínima después de que Isotope se inicialice
							setCarouselSlideMinHeight();
						});
					}
				});
			}
			
			// Variable para almacenar la altura mínima
			var carouselMinHeight = 0;
			
			// Establecer altura mínima para todos los slides basándose en el primero
			function setCarouselSlideMinHeight() {
				// Si ya tenemos una altura mínima establecida, usarla
				if (carouselMinHeight > 0) {
					$('.carousel-item .proyectos-carousel-grid').css('min-height', carouselMinHeight + 'px');
					return;
				}
				
				// Calcular altura del primer slide (el que está activo inicialmente)
				var $firstSlide = $('.carousel-item:first-child .proyectos-carousel-grid');
				if ($firstSlide.length) {
					// Esperar a que Isotope termine de calcular
					setTimeout(function() {
						var firstSlideHeight = $firstSlide.outerHeight(true);
						if (firstSlideHeight > 0) {
							carouselMinHeight = firstSlideHeight;
							// Aplicar altura mínima a todos los slides
							$('.carousel-item .proyectos-carousel-grid').css('min-height', carouselMinHeight + 'px');
						}
					}, 500);
				}
			}
			
			// Inicializar cuando se carga la página
			initCarouselIsotope();
			
			// Reinicializar Isotope cuando cambia el slide del carousel
			if (typeof bootstrap !== 'undefined') {
				var carouselElement = document.getElementById('proyectosCarousel');
				if (carouselElement) {
					// Inicializar carousel sin auto-play
					var carousel = new bootstrap.Carousel(carouselElement, {
						interval: false, // Sin auto-play
						wrap: true,
						keyboard: false, // Desactivar navegación con teclado
						touch: true // Permitir swipe en móviles
					});
					
					// Asegurar que no haya auto-play
					carousel._config.interval = false;
					
					carouselElement.addEventListener('slid.bs.carousel', function() {
						// Esperar un poco para que el slide se muestre completamente
						setTimeout(function() {
							initCarouselIsotope();
							// Aplicar altura mínima si ya está establecida
							if (carouselMinHeight > 0) {
								$('.carousel-item .proyectos-carousel-grid').css('min-height', carouselMinHeight + 'px');
							}
						}, 100);
					});
				}
			}
			
			// Abrir modal al hacer clic en un proyecto
			$(document).on('click', '.proyecto-modal-trigger', function(e) {
				e.preventDefault();
				
				var $trigger = $(this);
				var titulo = $trigger.data('proyecto-titulo') || '';
				var subtitulo = $trigger.data('proyecto-subtitulo') || '';
				var descripcion = $trigger.data('proyecto-descripcion') || '';
				var imagen = $trigger.data('proyecto-imagen') || '';
				
				// Llenar el modal con los datos
				$('#proyecto-modal-titulo').text(titulo);
				$('#proyecto-modal-subtitulo').text(subtitulo);
				$('#proyecto-modal-descripcion').html(descripcion);
				$('#proyecto-modal-img').attr('src', imagen).attr('alt', titulo);
				
				// Mostrar el modal
				$('#proyecto-modal').addClass('active');
				$('body').addClass('modal-open');
			});
			
			// Cerrar modal al hacer clic en la cruz
			$(document).on('click', '.proyecto-modal-close, .proyecto-modal-overlay', function(e) {
				e.preventDefault();
				$('#proyecto-modal').removeClass('active');
				$('body').removeClass('modal-open');
			});
			
			// Cerrar modal con tecla ESC
			$(document).on('keydown', function(e) {
				if (e.key === 'Escape' && $('#proyecto-modal').hasClass('active')) {
					$('#proyecto-modal').removeClass('active');
					$('body').removeClass('modal-open');
				}
			});
			
			// Prevenir que el clic en el contenido del modal lo cierre
			$(document).on('click', '.proyecto-modal-container', function(e) {
				e.stopPropagation();
			});
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'originaria_proyecto_modal_script' );

/**
 * Configurar PHPMailer para usar SMTP
 */
function originaria_configure_smtp( $phpmailer ) {
	if ( defined( 'MAIL_HOST' ) && defined( 'MAIL_USERNAME' ) && defined( 'MAIL_PASSWORD' ) ) {
		$phpmailer->isSMTP();
		$phpmailer->Host       = MAIL_HOST;
		$phpmailer->SMTPAuth   = true;
		$phpmailer->Port       = defined( 'MAIL_PORT' ) ? MAIL_PORT : 2525;
		$phpmailer->Username   = MAIL_USERNAME;
		$phpmailer->Password   = MAIL_PASSWORD;
		
		// Mailtrap usa TLS en puerto 2525 o 587
		$port = defined( 'MAIL_PORT' ) ? MAIL_PORT : 2525;
		if ( $port == 587 || $port == 2525 ) {
			$phpmailer->SMTPSecure = 'tls';
		} elseif ( $port == 465 ) {
			$phpmailer->SMTPSecure = 'ssl';
		} else {
			$phpmailer->SMTPSecure = false;
		}
		
		$phpmailer->From       = defined( 'MAIL_FROM_ADDRESS' ) ? MAIL_FROM_ADDRESS : get_option( 'admin_email' );
		$phpmailer->FromName   = get_bloginfo( 'name' );
		$phpmailer->SMTPDebug  = 0; // Cambiar a 2 para debug
	}
}
add_action( 'phpmailer_init', 'originaria_configure_smtp' );

/**
 * Handler del formulario de contacto
 */
function originaria_handle_contact_form() {
	// Verificar nonce
	if ( ! isset( $_POST['originaria_contact_nonce'] ) || ! wp_verify_nonce( $_POST['originaria_contact_nonce'], 'originaria_contact_form' ) ) {
		wp_send_json_error( array( 'message' => 'Error de seguridad. Por favor, recarga la página e intenta nuevamente.' ) );
		return;
	}

	// Obtener y sanitizar datos
	$name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
	$subject_form = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : '';
	$message = isset( $_POST['comment'] ) ? sanitize_textarea_field( $_POST['comment'] ) : '';

	// Validar campos requeridos
	if ( empty( $name ) || empty( $email ) ) {
		wp_send_json_error( array( 'message' => 'Por favor, completa todos los campos requeridos.' ) );
		return;
	}

	// Validar email
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Por favor, ingresa un email válido.' ) );
		return;
	}

	// Preparar el email (destino: MAIL_TO_ADDRESS o correo del administrador)
	$to = defined( 'MAIL_TO_ADDRESS' ) ? MAIL_TO_ADDRESS : get_option( 'admin_email' );
	$email_subject = 'Consulta web'; // Subject fijo
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . get_bloginfo( 'name' ) . ' <' . ( defined( 'MAIL_FROM_ADDRESS' ) ? MAIL_FROM_ADDRESS : get_option( 'admin_email' ) ) . '>',
		'Reply-To: ' . $name . ' <' . $email . '>',
	);

	// URL del logo
	$logo_url = get_template_directory_uri() . '/images/logos/logo-color-sin-fondo.png';

	// Construir el cuerpo del mensaje con HTML formateado
	$email_message = '<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulta web</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
	<table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 40px 0;">
		<tr>
			<td align="center">
				<table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
					<!-- Header con logo -->
					<tr>
						<td style="background-color: #ffffff; padding: 40px 30px 30px; text-align: center; border-bottom: 2px solid #f0f0f0;">
							<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" style="max-width: 200px; height: auto;">
						</td>
					</tr>
					<!-- Contenido -->
					<tr>
						<td style="padding: 40px 30px;">
							<h2 style="color: #333333; font-size: 24px; margin: 0 0 30px 0; font-weight: 600;">Nueva consulta desde la web</h2>
							
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td style="padding: 15px 0; border-bottom: 1px solid #eeeeee;">
										<strong style="color: #666666; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Nombre:</strong>
										<p style="color: #333333; font-size: 16px; margin: 8px 0 0 0; font-weight: 500;">' . esc_html( $name ) . '</p>
									</td>
								</tr>
								<tr>
									<td style="padding: 15px 0; border-bottom: 1px solid #eeeeee;">
										<strong style="color: #666666; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Email:</strong>
										<p style="color: #333333; font-size: 16px; margin: 8px 0 0 0;">
											<a href="mailto:' . esc_attr( $email ) . '" style="color: #007bff; text-decoration: none;">' . esc_html( $email ) . '</a>
										</p>
									</td>
								</tr>';
	
	if ( ! empty( $subject_form ) ) {
		$email_message .= '
								<tr>
									<td style="padding: 15px 0; border-bottom: 1px solid #eeeeee;">
										<strong style="color: #666666; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Asunto:</strong>
										<p style="color: #333333; font-size: 16px; margin: 8px 0 0 0;">' . esc_html( $subject_form ) . '</p>
									</td>
								</tr>';
	}
	
	if ( ! empty( $message ) ) {
		$email_message .= '
								<tr>
									<td style="padding: 15px 0;">
										<strong style="color: #666666; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Mensaje:</strong>
										<p style="color: #333333; font-size: 16px; margin: 8px 0 0 0; line-height: 1.6; white-space: pre-wrap;">' . nl2br( esc_html( $message ) ) . '</p>
									</td>
								</tr>';
	}
	
	$email_message .= '
							</table>
						</td>
					</tr>
					<!-- Footer -->
					<tr>
						<td style="background-color: #f8f9fa; padding: 20px 30px; text-align: center; border-top: 1px solid #eeeeee;">
							<p style="color: #999999; font-size: 12px; margin: 0;">Este mensaje fue enviado desde el formulario de contacto de ' . esc_html( get_bloginfo( 'name' ) ) . '</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';

	// Enviar el email
	$sent = wp_mail( $to, $email_subject, $email_message, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => 'Mensaje enviado exitosamente, responderemos a la brevedad.' ) );
	} else {
		// Obtener el último error de PHPMailer si está disponible
		global $phpmailer;
		$error_message = 'Hubo un error al enviar tu mensaje. Por favor, intenta nuevamente más tarde.';
		if ( isset( $phpmailer ) && ! empty( $phpmailer->ErrorInfo ) ) {
			$error_message .= ' Error: ' . $phpmailer->ErrorInfo;
		}
		wp_send_json_error( array( 'message' => $error_message ) );
	}
}
add_action( 'admin_post_originaria_send_contact_form', 'originaria_handle_contact_form' );
add_action( 'admin_post_nopriv_originaria_send_contact_form', 'originaria_handle_contact_form' );

/**
 * JavaScript para manejar el formulario de contacto con AJAX
 */
function originaria_contact_form_script() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var $form = $('#contact-form-3');
			if (!$form.length) {
				return;
			}
			// Mensaje de resultado arriba del todo en la caja blanca del formulario
			var $box = $form.find('.bg-white').first();
			var $results = $form.find('.form-results').first();
			if ($box.length && $results.length) {
				$results.prependTo($box);
			}

			// Interceptar el envío del formulario de contacto
			$form.on('submit', function(e) {
				e.preventDefault();
				
				var $formEl = $(this);
				var $submitBtn = $formEl.find('.submit');
				if (!$submitBtn.data('originaria-label')) {
					$submitBtn.data('originaria-label', $submitBtn.text());
				}
				var $resultsEl = $formEl.find('.form-results').first();
				var formData = $formEl.serialize();
				
				// Validación básica del lado del cliente
				var hasError = false;
				$formEl.find('.required').each(function() {
					var $field = $(this);
					var value = $field.val().trim();
					
					$field.removeClass('required-error');
					
					if (!value) {
						hasError = true;
						$field.addClass('required-error');
					} else if ($field.attr('type') === 'email') {
						var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
						if (!emailPattern.test(value)) {
							hasError = true;
							$field.addClass('required-error');
						}
					}
				});
				
				if (hasError) {
					$resultsEl.removeClass('d-none alert-success').addClass('alert-danger').html('Por favor, completa todos los campos requeridos correctamente.').css('display', 'block').hide().fadeIn();
					return false;
				}
				
				// Deshabilitar botón y mostrar loading
				$submitBtn.prop('disabled', true).text('Enviando...');
				$resultsEl.removeClass('d-none alert-danger alert-success').html('').css('display', 'none');
				
				// Enviar formulario vía AJAX
				$.ajax({
					url: $formEl.attr('action'),
					type: 'POST',
					data: formData,
					dataType: 'json',
					success: function(response) {
						// Limpiar clases previas
						$resultsEl.removeClass('d-none alert-danger alert-success').html('');
						
						if (response && response.success === true) {
							// Éxito
							var successMessage = (response.data && response.data.message) ? response.data.message : 'Mensaje enviado exitosamente, responderemos a la brevedad.';
							
							$resultsEl.html(successMessage);
							$resultsEl.addClass('alert-success');
							$resultsEl.removeClass('d-none alert-danger');
							$resultsEl.css({
								'display': 'block',
								'visibility': 'visible',
								'opacity': '1'
							});
							
							$formEl[0].reset();
							$formEl.find('.required-error').removeClass('required-error');
							
							// Scroll suave al mensaje (arriba de la caja)
							setTimeout(function() {
								$('html, body').animate({
									scrollTop: $resultsEl.offset().top - 80
								}, 500);
							}, 100);
							
							// Ocultar mensaje después de 8 segundos
							setTimeout(function() {
								$resultsEl.fadeOut(function() {
									$(this).addClass('d-none').css('display', 'none');
								});
							}, 8000);
						} else {
							// Error en la respuesta
							var errorMessage = (response && response.data && response.data.message) ? response.data.message : 'Hubo un error al enviar tu mensaje.';
							$resultsEl.html(errorMessage);
							$resultsEl.addClass('alert-danger');
							$resultsEl.removeClass('d-none alert-success');
							$resultsEl.css({
								'display': 'block',
								'visibility': 'visible',
								'opacity': '1'
							});
						}
					},
					error: function(xhr, status, error) {
						// Error de conexión
						$resultsEl.removeClass('d-none alert-success').addClass('alert-danger');
						var errorMessage = 'Hubo un error al enviar tu mensaje. Por favor, intenta nuevamente más tarde.';
						
						// Intentar parsear la respuesta JSON
						try {
							if (xhr.responseText) {
								var jsonResponse = JSON.parse(xhr.responseText);
								if (jsonResponse.data && jsonResponse.data.message) {
									errorMessage = jsonResponse.data.message;
								} else if (jsonResponse.message) {
									errorMessage = jsonResponse.message;
								}
							}
						} catch(e) {}
						
						$resultsEl.html(errorMessage);
						$resultsEl.css({
							'display': 'block',
							'visibility': 'visible',
							'opacity': '1'
						});
					},
					complete: function() {
						$submitBtn.prop('disabled', false).text($submitBtn.data('originaria-label') || 'enviar mensaje');
					}
				});
				
				return false;
			});
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'originaria_contact_form_script' );

/**
 * Configurar PHPMailer para usar SMTP
 */
// Función duplicada eliminada - se usa la versión mejorada más arriba

/**
 * Handler para el formulario de contacto
 */
function originaria_send_contact_form() {
	// Verificar nonce
	if ( ! isset( $_POST['originaria_contact_nonce'] ) || ! wp_verify_nonce( $_POST['originaria_contact_nonce'], 'originaria_contact_form' ) ) {
		wp_send_json_error( array( 'message' => 'Error de seguridad. Por favor, intenta nuevamente.' ) );
		return;
	}

	// Obtener y sanitizar datos
	$name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : 'Nueva consulta desde ' . get_bloginfo( 'name' );
	$message = isset( $_POST['comment'] ) ? sanitize_textarea_field( $_POST['comment'] ) : '';

	// Validar campos requeridos
	if ( empty( $name ) || empty( $email ) ) {
		wp_send_json_error( array( 'message' => 'Por favor, completa todos los campos requeridos.' ) );
		return;
	}

	// Validar email
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Por favor, ingresa un correo electrónico válido.' ) );
		return;
	}

	// Preparar el email
	$to      = defined( 'MAIL_FROM_ADDRESS' ) ? MAIL_FROM_ADDRESS : get_option( 'admin_email' );
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . get_bloginfo( 'name' ) . ' <' . ( defined( 'MAIL_FROM_ADDRESS' ) ? MAIL_FROM_ADDRESS : get_option( 'admin_email' ) ) . '>',
		'Reply-To: ' . $name . ' <' . $email . '>',
	);

	// Construir el cuerpo del mensaje
	$email_message = '<html><body>';
	$email_message .= '<h2>Nueva consulta desde ' . esc_html( get_bloginfo( 'name' ) ) . '</h2>';
	$email_message .= '<p><strong>Nombre:</strong> ' . esc_html( $name ) . '</p>';
	$email_message .= '<p><strong>Email:</strong> ' . esc_html( $email ) . '</p>';
	if ( ! empty( $subject ) ) {
		$email_message .= '<p><strong>Asunto:</strong> ' . esc_html( $subject ) . '</p>';
	}
	if ( ! empty( $message ) ) {
		$email_message .= '<p><strong>Mensaje:</strong></p>';
		$email_message .= '<p>' . nl2br( esc_html( $message ) ) . '</p>';
	}
	$email_message .= '</body></html>';

	// Enviar el email
	$sent = wp_mail( $to, $subject, $email_message, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => '¡Gracias! Tu mensaje ha sido enviado correctamente. Nos pondremos en contacto contigo pronto.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Hubo un error al enviar tu mensaje. Por favor, intenta nuevamente más tarde.' ) );
	}
}
// Handler duplicado eliminado - se usa originaria_handle_contact_form
// add_action( 'admin_post_originaria_send_contact_form', 'originaria_send_contact_form' );
// add_action( 'admin_post_nopriv_originaria_send_contact_form', 'originaria_send_contact_form' );

