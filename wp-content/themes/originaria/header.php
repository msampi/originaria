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
    
    <!-- Vertical text CSS -->
    <style>
        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2px;
            color: rgba(40, 40, 40, 0.5);
            text-transform: uppercase;
            white-space: nowrap;
            line-height: 1;
        }
        
        .right-bg {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        
        /* Footer logo size */
        .footer-logo {
            max-width: 180px !important;
            max-height: none !important;
            width: 100%;
            height: auto;
        }
        
        /* Logo responsivo */
        .logo-mobile {
            display: none;
        }
        
        @media (max-width: 991px) {
            .logo-desktop {
                display: none !important;
            }
            
            .sidebar-part1 {
                width: auto !important;
                overflow: visible !important;
            }
            
            .sidebar-part1 .logo {
                position: relative;
                width: auto !important;
                display: inline-block !important;
            }
            
            .logo-mobile {
                display: block !important;
                max-height: 40px !important;
                width: 120px !important;
                height: auto !important;
                margin-top: 15px;
                margin-left: 10px;
            }
        }
        
        /* Hide first image in "Nosotros" section on mobile */
        @media (max-width: 767px) {
            #nosotros .row .col-sm-6:nth-child(1) {
                display: none !important;
            }
            
            /* Reduce height of second image on mobile */
            #nosotros .row .col-sm-6:nth-child(2) img {
                max-height: 350px;
                object-fit: cover;
                width: 100%;
            }
        }
        
        /* Custom background color for portfolio hover */
        .portfolio-img.bg-custom-blue {
            background-color: #a6c8e9 !important;
        }
        
        .btn-dark-gray {
            background-color: #697480 !important;
            border-color: #697480 !important;
            color: #ffffff !important;
        }
        
        .btn-dark-gray:hover,
        .btn-dark-gray:focus {
            background-color: transparent !important;
            color: #697480 !important;
            border-color: #697480 !important;
        }
        
        /* Custom grid item sizes for projects */
        .grid-4col .grid-item.size-ancho {
            width: 50%;
        }
        
        .grid-4col .grid-item.size-alto img {
            height: auto;
            min-height: 400px;
            object-fit: cover;
        }
        
        .grid-4col .grid-item.size-grande {
            width: 50%;
        }
        
        .grid-4col .grid-item.size-grande img {
            height: auto;
            min-height: 400px;
            object-fit: cover;
        }
        
        @media (max-width: 767px) {
            .grid-4col .grid-item.size-ancho,
            .grid-4col .grid-item.size-grande {
                width: 100%;
            }
            
            .grid-4col .grid-item.size-alto img,
            .grid-4col .grid-item.size-grande img {
                min-height: auto;
            }
        }
    </style>
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
                        <div class="vertical-text">RAÍZ CREATIVA</div>
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

