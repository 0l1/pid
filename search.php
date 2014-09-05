<?php get_header(); ?>
  <div class="l-main">
    <section class="l-content" role="region">
    <?php if (have_posts()) : ?>

    <aside class="m-singlepost-topnav" role="complementary">
  	 <?php the_breadcrumb(); ?>
    </aside>
      <?php $postcount = 0; ?>
      <main class="m-postlist">
        <header role="heading">
            <h1 class="m-archive-title"><?php _e( 'Résultat pour ', 'your-theme' ); ?>"<?php the_search_query(); ?>"</h1>
        </header>
        <?php while (have_posts()) : the_post(); ?>
          <?php $postcount++; ?>
          <article class="post<?php if ( $postcount%3 == 1 ) { echo ' is-cleared'; } ?>" role="article">
            <div class="box<?php if ( $postcount%3 == 2 ) { echo ' second'; } ?><?php if ( $postcount%3 == 0 ) { echo ' is-right'; } ?>">
            	<a class="post-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link">
            		<?php the_post_thumbnail('mosaicthumb'); ?>
            	</a>
              <div class="post-infos is-transparent">
                <h1 class="post-title" role="heading"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                <div class="sep"></div>
                <a class="post-desc" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link"><?php echo get_excerpt(70); ?></a>
                <a class="post-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" role="link">Lire</a>
			        </div>
            </div>
          </article>
        <?php endwhile; ?>

	  <?php else : ?>
	  	<p>Aucun résultat pour '<?php the_search_query(); ?>'</p>
      <?php endif; ?>
      </main>
      <?php wp_reset_query(); ?>
      <?php global $wp_query; ?>
      <?php $big = 999999999; // need an unlikely integer ?>
      <?php $pagination_args = array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages
      ); ?>
      <nav class="m-pagination" role="navigation">
        <?php echo paginate_links($pagination_args); ?>
      </nav>
    </section>
    <?php get_sidebar(); ?>
  </div>
  <a class="m-backtop is-hidden" href="#">^</a>
  <?php get_footer(); ?>