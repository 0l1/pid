<?php get_header(); ?>
  <div class="l-main">
    <section class="l-content">
      <?php query_posts(array('post__in'=>get_option('sticky_posts'))); ?>
        <div class="m-slider swiper-container" role="slider">
          <div class="swiper-wrapper">
            <?php while (have_posts()) : the_post(); ?>
          		<article class="swiper-slide">
          			<h1><a href="<?php the_permalink(); ?>" class="logo" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
          			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('sliderthumb'); ?></a>
          		</article>
          	<?php endwhile; ?>
          </div>
		  <div class="pagination"></div>
        </div>
      <?php wp_reset_query(); ?>
      <?php $postcount = 0; ?>
	  <?php $query = new WP_Query( array( 'ignore_sticky_posts' => 1) );?>
      <div class="m-postlist">
        <?php while ($query->have_posts() ) : $query->the_post(); ?>
          <?php $postcount++; ?>
          <article class="post<?php if ( $postcount%3 == 1 ) { echo ' is-cleared'; } ?>">
            <div class="box<?php if ( $postcount%3 == 2 ) { echo ' second'; } ?><?php if ( $postcount%3 == 0 ) { echo ' is-right'; } ?>">
            	<a class="post-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('mosaicthumb'); ?></a>
              <div class="post-infos is-transparent">
                <h1 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                <div class="sep"></div>
                <a class="post-desc" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_excerpt(75); ?></a>
                <a class="post-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Lire</a>
			  </div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
      <?php wp_reset_query(); ?>
    </section>
    <?php get_sidebar(); ?>
  </div>
  <a class="m-backtop hiding" href="#">^</a>
  <?php get_footer(); ?>

