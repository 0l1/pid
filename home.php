<?php get_header(); ?>
<div class="l-main">
  <section class="l-content">
    <?php query_posts(array('post__in'=>get_option('sticky_posts'))); ?>
      <div class="m-slider swiper-container">
        <div class="swiper-wrapper">
          <?php while (have_posts()) : the_post(); ?>
        		<article class="swiper-slide">
        			<h1><a href="<?php the_permalink(); ?>" class="logo" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
        			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'slider-image', NULL,  'sliderthumb'); ?></a>
        		</article>
        	<?php endwhile; ?>
        </div>
      </div>
    <?php wp_reset_query(); ?>
    <?php $postcount = 0; ?>
    <div class="m-postlist">
      <?php while (have_posts()) : the_post(); ?>
        <?php $postcount++; ?>
        <article class="post<?php if ( $postcount%3 == 1 ) { echo ' is-cleared'; } ?>">
          <div class="box<?php if ( $postcount%3 == 2 ) { echo ' second'; } ?><?php if ( $postcount%3 == 0 ) { echo ' is-right'; } ?>">
          	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('mosaicthumb'); ?></a>
            <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <div class="sep"></div>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_excerpt(75); ?></a>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Lire</a>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
