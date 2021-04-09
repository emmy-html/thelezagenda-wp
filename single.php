<?php get_header(); ?>
<section id="main-content">
    <div class="blog single-post-template">
        <div class="content-wrapper">
            <article class="blog-single-post">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1><?php the_title() ?></h1>
                <?php the_content() ?>
                <hr>
                        <?php if (comments_open() && !post_password_required()) {
                            comments_template('', true);
                        } ?>
                <?php endwhile;
                endif; ?>
            </article>
        </div>
    </div>
    <?php get_sidebar(); ?>
    </section>
    <footer class="footer">
        <?php get_template_part('nav', 'below-single'); ?>
    </footer>
    </main>
    <?php get_footer(); ?>