<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'left-nav-sidebar' ); ?>>
<?php wp_body_open(); ?>

<!-- start header -->
<header>
    <div class="left-nav">
        <!-- start logo -->
        <div class="sidebar-part1">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" class="logo">
                <img class="logo-desktop" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-vert-fondo-azul.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/logos/logo-vert-fondo-azul.png" alt="<?php bloginfo( 'name' ); ?>">
                <img class="logo-mobile" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-color-sin-fondo.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/logos/logo-color-sin-fondo.png" alt="<?php bloginfo( 'name' ); ?>">
            </a> 
        </div>
        <!-- end logo -->
        <div class="sidebar-part2">  
            <div class="sidebar-middle">
                <div class="sidebar-middle-menu alt-font font-weight-600">
                    <nav class="navbar bootsnav navbar-expand-lg alt-font">  
                        <div id="navbar-menu" class="collapse navbar-collapse no-padding">
                            <ul class="nav navbar-nav margin-80px-bottom">
                                <li>
                                    <a href="#home" title="Home">Home</a>
                                </li>
                                <li>
                                    <a href="#nosotros" title="Nosotros">Nosotros</a>
                                </li>
                                <li>
                                    <a href="#servicios" title="Servicios">Servicios</a>
                                </li>
                                <li>
                                    <a href="#proyectos" title="Proyectos">Proyectos</a>
                                </li>
                                <li>
                                    <a href="#contacto" title="Contacto">Contacto</a>
                                </li>
                                <li>
                                    <div class="side-left-menu-close close-side"></div>
                                </li>
                            </ul>
                        </div>  
                    </nav>
                    <div class="right-bg">
                        <div class="vertical-text">AGENCIA DE RAÍZ CREATIVA</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-part3">
            <div class="bottom-menu-icon">
                <a href="javascript:void(0);" class="right-menu-button text-extra-dark-gray nav-icon" id="showRightPush">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div> 
        </div>
    </div>
</header>
<!-- end header -->

