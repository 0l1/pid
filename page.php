<?php get_header(); ?>
<div class="l-main">
  <section class="l-content">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article class="post">
          <h1 class="post-title"><?php the_title(); ?></h1>
          <section class="post-content">
            <?php the_content(); ?>
          </section>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
