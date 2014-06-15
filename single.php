<?php get_header(); ?>
<div class="l-main">
  <section class="l-content">
    <?php if (have_posts()) : ?>
	<?php the_breadcrumb(); ?>
	<a href="#comments" class="t-singlelink is-right"><?php comments_number( 'Aucun commentaire', '1 commentaire', '% commentaires' ); ?> </a>
    <?php while (have_posts()) : the_post(); ?>
          <article class="m-singlepost">
			<header role="heading">
				<div class="post-banner is-hidden">
				<?php MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'singlepage-banner', NULL,  'singlepage-banner'); ?>
				</div>
            	<h1 class="m-singlepost-title"><?php the_title(); ?></h1>
			</header>
            <main class="m-singlepost-content" role="article">
              <?php the_content(); ?>
            </main>
			<nav role="navigation" class="m-singlepost-nav">
				<span class="m-singlepost-previous is-left"><?php previous_post_link('&lsaquo; %link','Article précédent'); ?></span>
				<span class="m-singlepost-next is-right"><?php next_post_link('%link &rsaquo; ','Article suivant'); ?></span>
			</nav>
		    <aside>
		  	  <a href="#comments" class="t-singlelink"><?php comments_number( 'Aucun commentaire', '1 commentaire', '% commentaires' ); ?> </a> <span class="t-bulletsep">•</span> 
		  	  <a href="#comments" class="t-singlelink">Ajouter un commentaire</a>
	  	    </aside>
            <aside id="comments" class="m-singlepost-comments">
			  	<?php $formargs = array(
			       	
					'comment_notes_after' => '',
					'comment_field' =>  '<div class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Commentaire">' .
					    '</textarea></div>',
					'fields' => apply_filters( 'comment_form_default_fields', array(

					    'author' =>
					      '<div><input id="author" name="author" placeholder="Nom *" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					      '" size="30"' . $aria_req . ' /></div>',

					    'email' =>
					      
					      '<div><input id="email" name="email" placeholder="E-mail *" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					      '" size="30"' . $aria_req . ' /></div>',

					    'url' =>
					      
					      '<div><input id="url" name="url" placeholder="Site internet" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					      '" size="30" /></div>'
					    )
					  ),
				); ?>
				    
				<?php comment_form($formargs); ?>  
				
				<?php $postid= get_the_ID(); ?>
		  		<?php $commentargs = array('post_id' => $postid, 'status' => 'approve'); ?>
				       
		  		<?php $comments = get_comments($commentargs);?>
				<div class="m-comments-number"><?php comments_number( 'Aucun commentaire', '1 commentaire', '% commentaires' ); ?> </div> 
				<ul class="m-comments-list">
					<?php wp_list_comments( $arg, $comments ); ?>
				</ul>
            </aside>
				
				
				
          </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<a class="m-backtop is-hidden" href="#">^</a>
<?php get_footer(); ?>
