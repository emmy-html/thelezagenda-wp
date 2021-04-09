<?php get_header(); ?>
<section id="main-content">
    <div class="blog">
        <div class="content-wrapper">
            <article class="blog-single-post">
                <?php
                $args = array(
                    'post_type'   => 'post',
                    'author_name' => 'em-admin'
                );
                $the_blog = new WP_Query($args);

                if ($the_blog->have_posts()) :
                ?>
                    <?php while ($the_blog->have_posts()) : $the_blog->the_post() ?>
                        <h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
                        <h3 class="blog-post-metadata">Posted on <?php the_date() ?> by <span class="blog-post-author"><a href="/about"><?php the_author() ?></a></span></h3>
                        <?php the_content(); ?>
                        <p>
                        <hr>
                        <?php endwhile ?>
                    <?php else : ?>
                        <! – Content If No Posts –>
                        <?php endif ?>
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