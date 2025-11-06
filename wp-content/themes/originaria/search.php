<?php
/**
 * The template for displaying search results pages
 *
 * @package Originaria
 */

get_header();
?>

<section class="wow animate__fadeIn padding-100px-top padding-50px-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center margin-70px-bottom">
                <h1 class="alt-font text-extra-dark-gray margin-20px-bottom">
                    <?php
                    printf(
                        /* translators: %s: search query. */
                        esc_html__( 'Resultados de búsqueda para: %s', 'originaria' ),
                        '<span class="text-deep-pink">' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </div>
        </div>
        
        <div class="row">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <div class="col-lg-4 col-md-6 margin-30px-bottom">
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail margin-20px-bottom">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'medium', array( 'class' => 'w-100' ) ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <h3 class="alt-font text-extra-dark-gray margin-15px-bottom">
                                    <a href="<?php the_permalink(); ?>" class="text-extra-dark-gray">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                
                                <div class="post-meta text-small text-medium-gray margin-15px-bottom">
                                    <span class="posted-on">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="byline">
                                        / <?php the_author(); ?>
                                    </span>
                                </div>
                                
                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="btn btn-small btn-dark-gray margin-15px-top">
                                    Leer más
                                </a>
                            </div>
                        </article>
                    </div>
                    <?php
                endwhile;

                // Pagination
                ?>
                <div class="col-12 text-center margin-50px-top">
                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 2,
                            'prev_text' => __( '← Anterior', 'originaria' ),
                            'next_text' => __( 'Siguiente →', 'originaria' ),
                        )
                    );
                    ?>
                </div>
                <?php
            else :
                ?>
                <div class="col-12 text-center">
                    <h3 class="alt-font text-extra-dark-gray margin-30px-bottom">
                        No se encontraron resultados
                    </h3>
                    <p class="text-large margin-30px-bottom">
                        Lo sentimos, pero no se encontraron resultados para tu búsqueda. 
                        Por favor, intenta con otras palabras clave.
                    </p>
                    <div class="search-form-wrapper">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();

