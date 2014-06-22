<?php get_header(); ?>
  <div class="l-main">
    <section class="l-content" role="region">
      <?php query_posts(array('post__in'=>get_option('sticky_posts'))); ?>
        <header class="m-slider swiper-container" role="slider">
          <div class="swiper-wrapper">
            <?php while (have_posts()) : the_post(); ?>
          		<article class="swiper-slide" role="article">
          			<h1 role="heading"><a href="<?php the_permalink(); ?>" class="logo" title="<?php the_title(); ?>" role="link"><?php the_title(); ?></a></h1>
          			<a class="sliderthumb" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link"><?php the_post_thumbnail('sliderthumb'); ?></a>
          		</article>
          	<?php endwhile; ?>
          </div>
		    <div class="pagination"></div>
        </header>
      <?php wp_reset_query(); ?>
      <?php $postcount = 0; ?>
	  <?php $query = new WP_Query( array( 'ignore_sticky_posts' => 1) );?>
      <main class="m-postlist">
        <?php while ($query->have_posts() ) : $query->the_post(); ?>
          <?php $postcount++; ?>
          <article class="post<?php if ( $postcount%3 == 1 ) { echo ' is-cleared'; } ?>" role="article">
            <div class="box<?php if ( $postcount%3 == 2 ) { echo ' second'; } ?><?php if ( $postcount%3 == 0 ) { echo ' is-right'; } ?>">
            	<a class="post-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link"><?php the_post_thumbnail('mosaicthumb'); ?></a>
              <div class="post-infos is-transparent">
                <h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link"><?php the_title(); ?></a></h1>
                <div class="sep"></div>
                <a class="post-desc" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link"><?php echo get_excerpt(70); ?></a>
                <a class="post-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link">Lire</a>
			        </div>
            </div>
          </article>
        <?php endwhile; ?>
      </main>
      <?php wp_reset_query(); ?>
    </section>
    <?php get_sidebar(); ?>
  </div>
  <a class="m-backtop is-hidden" href="#">^</a>
  <?php get_footer(); ?>

