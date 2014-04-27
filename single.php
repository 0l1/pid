<?php get_header(); ?>
<div class="l-main">
  <section class="l-content">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
          <article class="post">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <aside class="post-info">
              Posté le <?php the_date(); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
            </aside>
            <section class="post-content">
              <?php the_content(); ?>
            </section>
            <aside class="post-comments">
              <?php comments_template(); ?>
            </aside>
          </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
