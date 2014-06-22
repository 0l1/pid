<?php get_header(); ?>
  <div class="l-main">
    <section class="l-content">
    <?php if (have_posts()) : ?>

    <aside class="m-singlepost-topnav">
  	 <?php the_breadcrumb(); ?>
    </aside>
      <?php $postcount = 0; ?>
      <div class="m-postlist">
        <header role="heading">
          <?php if(is_category()): ?>
            <?php
            $cats = get_the_category();
            $cat_name = $cats[0]->name;
            ?>
            <h1 class="m-archive-title"><?php echo $cat_name; ?></h1>
          <?php elseif(is_author()): ?>
            <h1 class="m-archive-title"><?php the_author(); ?>'s Posts</h1>
          <?php elseif(is_tag()): ?>
            <h1 class="m-archive-title"><?php single_tag_title(''); ?></h1>
          <?php endif; ?>
        </header>
        <?php while (have_posts()) : the_post(); ?>
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

	  <?php else : ?>
	  	<p>Aucun article disponnible</p>
      <?php endif; ?>
      </div>
    </section>
    <?php get_sidebar(); ?>
  </div>
  <a class="m-backtop is-hidden" href="#">^</a>
  <?php get_footer(); ?>