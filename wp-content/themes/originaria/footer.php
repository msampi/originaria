<!-- start footer --> 
<footer class="footer-center-logo padding-five-tb sm-padding-30px-tb">
    <div class="container">
        <div class="row align-items-center">
            <!-- start copyright -->
            <div class="col-lg-4 col-md-5 text-small text-center alt-font sm-margin-15px-bottom">
                <!-- &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> -->
            </div>
            <!-- end copyright -->
            <!-- start logo -->
            <div class="col-lg-4 col-md-2 text-center sm-margin-10px-bottom">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="footer-logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-color-sin-fondo.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/logos/logo-color-sin-fondo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
            </div>
            <!-- end logo -->
            <!-- start social media -->
            <div class="col-lg-4 col-md-5 text-center">
                <div class="social-icon-style-8 d-inline-block align-middle">
                </div>
            </div>
            <!-- end social media -->
        </div>
    </div>
</footer>
<!-- end footer -->

<!-- start scroll to top -->
<a class="scroll-top-arrow" href="javascript:void(0);"><i class="ti-arrow-up"></i></a>
<!-- end scroll to top -->

<?php wp_footer(); ?>
</body>
</html>

