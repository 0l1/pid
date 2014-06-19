<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
     <?php 
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
    $url = $thumb['0'];
    ?>
    <meta property="og:title" content="<?php get_the_title();?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php the_permalink(); ?>"/>
    <meta property="og:image" content="<?php echo $url; ?>"/>
    <meta property="og:site_name" content="Princess In Disguise"/>
    <meta property="fb:admins" content="1031929272"/>
    <meta property="fb:app_id" content="1414506962170574"/>
    <meta property="og:description"
          content="<?php get_the_excerpt(); ?>"/>
    <title><?php the_title(); ?></title>
    <?php wp_head(); ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
  </head>
  <body>
    <div class="l-wrap">
      <header class="l-header">
        <h1 class="m-logo is-left"><a class="is-left" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
        <nav class="m-mainnav is-right" role="navigation">
          <?php
          wp_nav_menu( array('menu_class' => 'menu',
                                    'container' => '',
                                    'container_class' => '',
                                    'theme_location' => 'Main Nav',
                                    'items_wrap' => '<ul>%3$s</ul>',
                                    'walker'=> new Customed_Walker_Nav_Menu()
                                    ) );?>
        </nav>
      <div class="m-sep"></div>
      </header>
