<?php
//Activation Thumbnails
add_theme_support( 'post-thumbnails' );
add_image_size( 'sliderthumb', 705, 355, true);
add_image_size( 'mosaicthumb', 210, 210, true);
add_image_size( 'singlepage-banner', 705, 215, true);
if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Bannière du Post',
            'id' => 'singlepage-banner',
            'post_type' => 'post',
        )
    );
}

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = "/path/to/default.png";
  }
  return $first_img;
}

function set_featured_image_on_save($post_id){
    $attachments = get_posts(array('numberposts' => '1', 'post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC'));
    if(sizeof($attachments) > 0){
        set_post_thumbnail($post_id, $attachments[0]->ID);
    }else{
        // not loaded the we upload it as an attachment
        // required libraries for media_sideload_image
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // load the image
        $img  = catch_that_image();
        if ("/images/default.jpg" != $img){
            $result = media_sideload_image($img, $post_id);
            $attachments = get_posts(array('numberposts' => '1', 'post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC'));
            if(sizeof($attachments) > 0)
                set_post_thumbnail($post_id, $attachments[0]->ID);
        }else{
            //no images found
            return;
        }
    }
}



add_action( 'save_post', 'auto_set_post_image' );


// Special Excerpt
function get_excerpt_by_id($post_id){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 35; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);
    if(count($words) > $excerpt_length) :
    array_pop($words);
    array_push($words, '…');
    $the_excerpt = implode(' ', $words);
    endif;
    return $the_excerpt;
}

/**
 * runs on post save and check's if we already have a post thumbnail, if not it gets one
 * 
 * @param  (int) $post_id 
 * @return Void
 */
function auto_set_post_image( $post_id ) {
    // verify if this is an auto save routine. 
      // If it is our form has not been submitted, so we dont want to do anything
      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
          return;

    // Check permissions
    if ( 'page' == $_POST['post_type'] ){
        if ( !current_user_can( 'edit_page', $post_id ) )
        return;
    }else{
        if ( !current_user_can( 'edit_post', $post_id ) )
            return;
    }

    // OK, we're authenticated: we need to find and save the data

    //check if we have a post thumnail set already
    $attch = get_post_meta($post_id,"_thumbnail_id",true);
    if (empty($attch)){
        set_featured_image_on_save($post_id);
    }
}

// Activation widget Sidebar
if ( function_exists('register_sidebar') ){
	register_sidebar(array(
		'name'=> 'About',
		'id' => 'about',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
	register_sidebar(array(
		'name'=> 'Objet du jour',
		'id' => 'dailyobject',
		'before_widget' => '<section class="m-daily-object">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="m-daily-title">',
		'after_title' => '</h2>'
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
		$class_names = ' class="level-'. esc_attr( $depth ) .' is-left"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li class="sep is-left"> • </li><li' . $value . $class_names .'>';

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

//Breadcrumb
function the_breadcrumb() {
    global $post;
    echo '<nav role="navigation" class="is-left">';
	echo '<ul class="m-breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo '</a></li><li> > </li>';
        if (is_category()) {
            $cats = get_the_category();
            $cat_name = $cats[0]->name;
            echo '<li>Catégorie : <span>';
            echo $cat_name; 
            echo'</span></li>';
        } elseif (is_single()) {
            echo '<li>';
            the_category(' </li><li> > </li><li> ');
            echo '</li><li> > </li><li><span>';
            the_title();
            echo '</span></li>';
        } elseif (is_author()) {
            echo'<li>'.get_the_author().'\'s Posts</li>';
        }  elseif (is_tag()) {
            echo '<li>Tag : <span>';
            single_tag_title('');
            echo '</span></li>';
        }   elseif (is_page()) {
            echo '<li><span>';
            the_title();
            echo '</span></li>';
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
	echo '</nav>';
}

// Limiter longueur de l'excerpt
function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'...';
  return $excerpt;
}

// Enregistrement des scripts
function scripts() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", null, '1.11.0', true);
	wp_enqueue_script('jquery');
    wp_register_script( 'function', get_template_directory_uri() . '/js/function.js', null, '1.0.0', true);
    wp_enqueue_script( 'function');
    
    if( is_home()){
	   wp_register_script( 'slider', get_template_directory_uri() . '/js/idangerous.swiper.min.js', null,'2.5.1', true);
	   wp_enqueue_script( 'slider');
    }
    if( is_single()){
       wp_register_script('twitter', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://platform.twitter.com/widgets.js", null, null, true);
       wp_enqueue_script( 'twitter');
    }
}

//Enregistrement des styles
function styles() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', null, '1.0.0' );
	
    if( is_home()){
        wp_enqueue_style( 'slider', get_template_directory_uri() . '/js/idangerous.swiper.css', null, '2.5.1' );
    }
}

// Appel des scripts et des styles
add_action( 'wp_enqueue_scripts', 'scripts');
add_action( 'wp_enqueue_scripts', 'styles');
