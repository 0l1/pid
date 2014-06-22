<?php get_header(); ?>
<div class="l-main">
  <section class="l-content" role="region">
    <?php if (have_posts()) : ?>
    <aside class="m-singlepost-topnav" role="complementary">
    <?php the_breadcrumb(); ?>
    </aside>
    
    <?php while (have_posts()) : the_post(); ?>
          <main class="m-singlepost" role="article">
          <header role="heading">
          <div class="post-banner is-hidden">
            <?php the_post_thumbnail('singlepage-banner'); ?>
          </div>
          <h1 class="m-singlepost-title"><?php the_title(); ?></h1>
          </header>
            <main class="m-singlepost-content">
              <?php the_content(); ?>
            </main>
          </main>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<a class="m-backtop is-hidden" href="#">^</a>
<?php get_footer(); ?>
