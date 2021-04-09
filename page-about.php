<?php
/*
Template Name: About
*/
?>
<?php get_header(); ?>
<section id="main-content">
      <article class="about-page">
        <div class="content-wrapper">
          <h1>Meet the Creator</h1>
          <div class="about-page-content">
            <aside>
              <img src="<?php the_field('photo') ?>" alt="Headshot of Emmy with Pink hair wearing a dark blue button up with rainbow stripes" />
              <h2>Emmy [she/they]
                <span>is creating content, writing articles, and the voice behind <i>The Lez Agenda</i>.</span>
              </h2>
            </aside>
            <p><?php the_field('mini_bio') ?></p>
            <h1>Social Media</h1>
            <div class="about-page-social-media">
                <a href="https://twitter.com/emmydoesit"><i class="fab fa-twitter-square fa-2x"></i></a>
                <a href="https://www.instagram.com/emmydoesit/"><i class="fab fa-instagram-square fa-2x"></i></a>
            </div>
          </div>
        </div>
        </article>
    <?php get_sidebar(); ?>
    </section>
    </main>
    <?php get_footer(); ?>