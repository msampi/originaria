<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Originaria
 */

get_header();
?>

<section class="wow animate__fadeIn padding-150px-top padding-100px-bottom text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <h1 class="alt-font font-weight-600 text-extra-dark-gray margin-30px-bottom" style="font-size: 120px;">404</h1>
                <h3 class="alt-font text-extra-dark-gray margin-20px-bottom">Página no encontrada</h3>
                <p class="text-large margin-40px-bottom">Lo sentimos, la página que buscas no existe o ha sido movida.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-dark-gray btn-medium margin-20px-top">Volver al inicio</a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();

