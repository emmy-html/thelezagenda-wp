<?php /* Template Name: Front Page Template */ ?>
<?php get_header(); ?>
<main>
    <section id="main-content">
        <div class="blog front-page">
            <div class="content-wrapper">
                <?php 
                // the query
                $the_query = new WP_Query( array( 'author_name' => 'em-admin') ); ?>

                <?php if ( $the_query->have_posts() ) : ?>

                <!-- the loop -->
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="blog-single-post-gradient-wrapper">
                    <article class="blog-single-post">
                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <h3 class="blog-post-metadata">Posted On <?php echo get_the_date(); ?> By <span class="blog-post-author"><?php the_author_posts_link(); ?></span></h3>
                        <?php the_content( 'Read More', false ); ?> 
                    </article>
                </div>
                <?php endwhile; ?>

                <!-- end of the loop -->
                <?php wp_reset_postdata(); ?>

                <?php else : ?>
                <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </section>
</main>

<?php get_footer(); ?>