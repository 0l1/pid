<?php get_header(); ?>
<div class="l-main">
  <section class="l-content">
    <?php if (have_posts()) : ?>
	<aside class="m-singlepost-topnav">
		<?php the_breadcrumb(); ?>
		<a href="#comments" class="t-singlelink is-right"><?php comments_number( 'Aucun commentaire', '1 commentaire', '% commentaires' ); ?> </a>
    </aside>
    
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
            <footer class="m-singlepost-author" role="contentinfo">
				<?php the_author_posts_link(); ?>
			  </footer>
			<nav role="navigation" class="m-singlepost-nav">
				<span class="m-singlepost-previous is-left"><?php previous_post_link('&lsaquo; %link','Article précédent'); ?></span>
				<span class="m-singlepost-next is-right"><?php next_post_link('%link &rsaquo; ','Article suivant'); ?></span>
			</nav>
		    <aside class="m-singlepost-cta">
		  	  <a href="#comments" class="t-singlelink m-comment-cta"><?php comments_number( 'Aucun commentaire', '1 commentaire', '% commentaires' ); ?> </a> <span class="t-bulletsep m-comment-cta">•</span> 
		  	  <a href="#comments" class="t-singlelink m-comment-cta">Ajouter un commentaire</a>
		  	  <div class="m-singlepost-social is-right">
		  	  	<a class="facebook is-left is-static" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + location.href, 'sharer', 'width=626,height=436');
		    return false;">Share on Facebook</a>
			    <a class="twitter is-left is-static" href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink()); ?>&related=PID_blog&text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>&via=PID_blog" 
class="twitter-share" data-via="PID_blog" data-size="large" 
data-related="PID_blog" data-hash tags="PID">Tweet</a>
			  </div>
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
