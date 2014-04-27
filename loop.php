<?php if (have_posts()) : ?>
  <section class="l-content">
      <?php while (have_posts()) : the_post(); ?>
        <article class="post">
          <h1 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h1>
          <aside class="post-info">
            Posté le <?php the_date(); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
          </aside>
          <section class="post-content">
            <?php the_content(); ?>
          </section>
        </article>
      <?php endwhile; ?>
  </section>
<?php else : ?>
  <section class="l-content nothing">
    Il n'y a pas de Post à afficher !
  </section>
<?php endif; ?>
