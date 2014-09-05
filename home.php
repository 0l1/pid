<?php get_header(); ?>
  <div class="l-main">
    <section class="l-content" role="region">
      <?php query_posts(array('post__in'=>get_option('sticky_posts'))); ?>
        <header class="m-slider swiper-container" role="slider">
          <div class="swiper-wrapper">
            <?php $i = 0; while (have_posts() && $i < 4) : the_post(); ?>
          		<article class="swiper-slide" role="article">
          			<h1 role="heading"><a href="<?php the_permalink(); ?>" class="logo" title="<?php the_title(); ?>" role="link"><?php the_title(); ?></a></h1>
          			<a class="sliderthumb" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link"><?php the_post_thumbnail('sliderthumb'); ?></a>
          		</article>
          	<?php $i++; endwhile; ?>
          </div>
		    <div class="pagination"></div>
        </header>
      <?php wp_reset_query(); ?>
      <?php $postcount = 0; ?>
      <?php 
          $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
          $custom_args = array(
            'post_type' => 'post',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => 12,
            'paged' => $paged
          );
          $custom_query = new WP_Query( $custom_args ); 
      ?>
      <main class="m-postlist">
        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
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
      <nav class="m-pagination" role="navigation">
        <?php
          if (function_exists(custom_pagination)) {
            custom_pagination($custom_query->max_num_pages,"",$paged);
          }
        ?>
      </nav>
    </section>
    <?php get_sidebar(); ?>
  </div>
  <a class="m-backtop is-hidden" href="#">^</a>
  <?php get_footer(); ?>

