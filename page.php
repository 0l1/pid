<?php get_header(); ?>
<div class="l-main">
  <section class="l-content">
    <?php if (have_posts()) : ?>
  <aside class="m-singlepost-topnav">
    <?php the_breadcrumb(); ?>
    </aside>
    
    <?php while (have_posts()) : the_post(); ?>
          <article class="m-singlepost">
          <header role="heading">
      <div class="post-banner is-hidden">
        <?php the_post_thumbnail('singlepage-banner'); ?>
      </div>
      <h1 class="m-singlepost-title"><?php the_title(); ?></h1>
      </header>
            <main class="m-singlepost-content" role="article">
              <?php the_content(); ?>
            </main>
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
