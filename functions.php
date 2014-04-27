<?php
//Activation Thumbnails
add_theme_support( 'post-thumbnails' );
add_image_size( 'sliderthumb',735,375,true);
add_image_size( 'mosaicthumb',230,230,true);
if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Slider Image',
            'id' => 'slider-image',
            'post_type' => 'post',
        )
    );
}

// Activation widget Sidebar
if ( function_exists('register_sidebar') ){
	register_sidebar(array(
		'name'=> 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
	register_sidebar(array(
		'name'=> 'Nav',
		'id' => 'nav',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
}

// Activation menu
register_nav_menus( array(
    'Main Nav' => 'Navigation principale',
    'Scroll Nav' => 'Navigation principale fixed au scroll',
) );

//	Cleaner et personnafier les classes du menu
class Customed_Walker_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="level-'. esc_attr( $depth ) .' is-inlineblock"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

	  // new addition for active class on the a tag
	  if(in_array('current-menu-item', $classes)) {
	      $attributes .= ' class="is-active"';
	  }

		$item_output = $args->before;
		$item_output .= '<a class="t-navlink"'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// Limiter longueur de l'excerpt
function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'... <a href="'.$permalink.'">more</a>';
  return $excerpt;
}

// Enregistrement des scripts
function scripts() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", null, '1.11.0', true);
	wp_enqueue_script('jquery');
	wp_register_script( 'swiper', get_template_directory_uri() . '/js/idangerous.swiper.min.js', null,'2.5.1', true);
	wp_enqueue_script( 'swiper');
	wp_register_script( 'function', get_template_directory_uri() . '/js/function.js', null, '1.0.0', true);
	wp_enqueue_script( 'function');
}

//Enregistrement des styles
function styles() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', null, '1.0.0' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/js/idangerous.swiper.css', null, '1.0.0' );
}

// Appel des scripts et des styles
add_action( 'wp_enqueue_scripts', 'scripts');
add_action( 'wp_enqueue_scripts', 'styles');
