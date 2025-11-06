<?php
/**
 * The template for displaying all pages
 *
 * @package Originaria
 */

get_header();
?>

<section class="wow animate__fadeIn padding-100px-top padding-50px-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header margin-50px-bottom">
                            <h1 class="entry-title alt-font text-extra-dark-gray"><?php the_title(); ?></h1>
                        </header>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'originaria' ),
                                    'after'  => '</div>',
                                )
                            );
                            ?>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();

