<div class="m-searchform">
	<h2 class="m-searchform-title">Recherche</h2>
	<form method="get" action="<?php bloginfo('url'); ?>/">
	  <input class="m-searchform-input" type="text" value="<?php the_search_query(); ?>" name="s" id="s">
	  <input type="submit" class="m-searchform-cta">
	</form>
</div>