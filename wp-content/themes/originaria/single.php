<?php
/**
 * The template for displaying all single posts
 *
 * @package Originaria
 */

get_header();
?>

<section class="wow animate__fadeIn padding-100px-top padding-50px-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header margin-50px-bottom">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail margin-30px-bottom">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-100' ) ); ?>
                                </div>
                            <?php endif; ?>
                            
                            <h1 class="entry-title alt-font text-extra-dark-gray margin-20px-bottom"><?php the_title(); ?></h1>
                            
                            <div class="entry-meta text-medium-gray margin-20px-bottom">
                                <span class="posted-on">
                                    <i class="ti-calendar margin-5px-right"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                                <span class="byline margin-20px-left">
                                    <i class="ti-user margin-5px-right"></i>
                                    <?php the_author(); ?>
                                </span>
                                <?php if ( has_category() ) : ?>
                                    <span class="cat-links margin-20px-left">
                                        <i class="ti-folder margin-5px-right"></i>
                                        <?php the_category( ', ' ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links margin-30px-top">' . esc_html__( 'Páginas:', 'originaria' ),
                                    'after'  => '</div>',
                                )
                            );
                            ?>
                        </div>

                        <?php if ( get_the_tags() ) : ?>
                            <footer class="entry-footer margin-50px-top padding-30px-top border-top border-color-medium-gray">
                                <div class="tags-links">
                                    <strong class="margin-10px-right">Tags:</strong>
                                    <?php the_tags( '', ', ', '' ); ?>
                                </div>
                            </footer>
                        <?php endif; ?>
                    </article>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        ?>
                        <div class="comments-area margin-80px-top">
                            <?php comments_template(); ?>
                        </div>
                        <?php
                    endif;

                endwhile;
                ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();

