<?php
/**
 * The template for displaying archive pages
 *
 * @package Originaria
 */

get_header();
?>

<section class="wow animate__fadeIn padding-100px-top padding-50px-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center margin-70px-bottom">
                <?php
                the_archive_title( '<h1 class="alt-font text-extra-dark-gray margin-20px-bottom">', '</h1>' );
                the_archive_description( '<div class="archive-description text-large">', '</div>' );
                ?>
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
                    <p class="text-large">No se encontraron publicaciones.</p>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();

