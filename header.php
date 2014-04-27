<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php the_title(); ?></title>
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="l-wrap">
      <header class="l-head">
        <h1 class="m-logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
        <nav class="m-mainnav" role="navigation">
          <?php
          wp_nav_menu( array('menu_class' => 'menu',
                                    'container' => '',
                                    'container_class' => '',
                                    'theme_location' => 'Main Nav',
                                    'items_wrap' => '<ul>%3$s</ul>',
                                    'walker'=> new Customed_Walker_Nav_Menu()
                                    ) );?>
          <?php dynamic_sidebar('Nav'); ?>
        </nav>
      </header>
