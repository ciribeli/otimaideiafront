<?php
function titulo_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'titulo' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'titulo_wp_title', 10, 2 );


// adicionar suporte a thumbnails
add_theme_support( 'post-thumbnails' );
the_post_thumbnail();
the_post_thumbnail('thumbnail');       // Thumbnail (default 150px x 150px max)
the_post_thumbnail('medium');          // Medium resolution (default 300px x 300px max)
the_post_thumbnail('large');           // Large resolution (default 640px x 640px max)
the_post_thumbnail('full');            // Original image resolution (unmodified)
the_post_thumbnail( array(500, 500) );  // Other resolutions



// Limite de caracteres, famoso excerpt
function excerpt($limit) {
$excerpt = explode(' ', get_the_excerpt(), $limit);
if (count($excerpt)>=$limit) {
array_pop($excerpt);
$excerpt = implode(" ",$excerpt).'...';
} else {
$excerpt = implode(" ",$excerpt);
}
$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
return $excerpt;
}

// Registrar menu no painel
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );


//Menu Bootstrap - NAVWALKER
if ( ! class_exists( 'WP_Bootstrap_Navwalker' ) ) {
	class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {


		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\" nav-dropdown nav-submenu \" >\n";
		}


		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';


			if ( 0 === strcasecmp( $item->attr_title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->title, 'divider' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} elseif ( 0 === strcasecmp( $item->attr_title, 'dropdown-header' ) && 1 === $depth ) {
				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
			} elseif ( 0 === strcasecmp( $item->attr_title, 'disabled' ) ) {
				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
			} else {
				$class_names = $value = '';
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				if ( $args->has_children ) {
					$class_names .= ' dropdown'; }
				if ( in_array( 'current-menu-item', $classes, true ) ) {
					$class_names .= ' active'; }
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
				$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
				$output .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $value . $class_names . '>';
				$atts = array();

				if ( empty( $item->attr_title ) ) {
		  			$atts['title']  = ! empty( $item->title )   ? strip_tags( $item->title ) : '';
				} else {
		  			$atts['title'] = $item->attr_title;
				}

				$atts['target'] = ! empty( $item->target )	? $item->target	: '';
				$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
				// If item has_children add atts to a.
				if ( $args->has_children && 0 === $depth ) {
					$atts['href']   		= '#';
					$atts['data-toggle']	= 'dropdown';
					$atts['class']			= 'dropdown-toggle';
					$atts['aria-haspopup']	= 'true';
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				}
				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
				$item_output = $args->before;

				if ( ! empty( $item->attr_title ) ) :
								$pos = strpos( esc_attr( $item->attr_title ), 'glyphicon' );
					if ( false !== $pos ) :
						$item_output .= '<a' . $attributes . '><span class="glyphicon ' . esc_attr( $item->attr_title ) . '" aria-hidden="true"></span>&nbsp;';
								else :
									$item_output .= '<a' . $attributes . '><i class="fa ' . esc_attr( $item->attr_title ) . '" aria-hidden="true"></i>&nbsp;';
											endif;
				else :
					$item_output .= '<a' . $attributes . '>';
				endif;
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ( $args->has_children && 0 === $depth ) ? ' </a>' : '</a>';
				$item_output .= $args->after;
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}


		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return; }
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}


		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {

				/* Get Arguments. */
				$container = $args['container'];
				$container_id = $args['container_id'];
				$container_class = $args['container_class'];
				$menu_class = $args['menu_class'];
				$menu_id = $args['menu_id'];

				if ( $container ) {
					echo '<' . esc_attr( $container );
					if ( $container_id ) {
						echo ' id="' . esc_attr( $container_id ) . '"';
					}
					if ( $container_class ) {
						echo ' class="' . sanitize_html_class( $container_class ) . '"'; }
					echo '>';
				}
				echo '<ul';
				if ( $menu_id ) {
					echo ' id="' . esc_attr( $menu_id ) . '"'; }
				if ( $menu_class ) {
					echo ' class="' . esc_attr( $menu_class ) . '"'; }
				echo '>';
				echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="">' . esc_attr( 'Add a menu', '' ) . '</a></li>';
				echo '</ul>';
				if ( $container ) {
					echo '</' . esc_attr( $container ) . '>'; }
			}
		}
	}
}


/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }

  /*
   * Nonce verification
   */
  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
    return;

  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );

  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;

  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {

    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );

    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );

    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }

    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        if( $meta_key == '_wp_old_slug' ) continue;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }


    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );

/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  }
  return $actions;
}

add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);


// Replace ícone
function replace_admin_menu_icons_css() {
    ?>
    <style>
        #adminmenu #toplevel_page_woocommerce .menu-icon-generic div.wp-menu-image::before {
            font-family: dashicons !important;
            content: "\f508";
        }
    </style>
    <?php
}

add_action( 'admin_head', 'replace_admin_menu_icons_css' );