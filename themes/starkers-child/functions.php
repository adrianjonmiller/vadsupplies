<?php

	// Modify Jquery 

	wp_deregister_script('jquery');
	wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"), false, '1.9.0', true);
	wp_enqueue_script('jquery');

	// Register Scripts

	function starkers_script_enqueuer() {
		wp_register_script( 'jsbehave', get_stylesheet_directory_uri().'/bower_components/jsbehave/application.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jsbehave' );

		wp_register_script( 'masonry', get_stylesheet_directory_uri().'/bower_components/masonry/maonsry.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'masonry' );

		wp_register_script( 'select2', get_stylesheet_directory_uri().'/bower_components/select2/select2.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'select2' );

		wp_register_script( 'behaviors', get_stylesheet_directory_uri().'/js/behaviors/behaviors.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'behaviors' );

		wp_register_style( 'dont-over-think-it', get_stylesheet_directory_uri().'/bower_components/dont_over_think_it/css/grid.css', '', '', 'screen' );
        wp_enqueue_style( 'dont-over-think-it' );

        wp_register_style( 'select2-css', get_stylesheet_directory_uri().'/bower_components/select2/select2.css', '', '', 'screen' );
        wp_enqueue_style( 'select2-css' );

        wp_register_style( 'ionicons', get_stylesheet_directory_uri().'/bower_components/ionicons/css/ionicons.min.css', '', '', 'screen' );
        wp_enqueue_style( 'ionicons' );

        wp_register_style( 'normalize', get_stylesheet_directory_uri().'/bower_components/normalize-css/normalize.css', '', '', 'screen' );
        wp_enqueue_style( 'normalize' );

        wp_register_style( 'main', get_stylesheet_directory_uri().'/styles/main.css', '', '', 'screen' );
        wp_enqueue_style( 'main' );

		wp_register_style( 'style', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'style' );
	}

function the_slug($echo=true){
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  if( $echo ) echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}

// Register Menus

register_nav_menu( 'primary', 'Primary Menu' );
register_nav_menu( 'secondary', 'Secondary Menu' );

function my_register_sidebars() {
	/**
 * Register our sidebars and widgetized areas.
 *
 */
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Primary' ),
			'description' => __( 'Primary sidebar.' ),
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

	register_sidebar(
		array(
			'id' => 'blog-sidebar',
			'name' => __( 'Blog Sidebar' ),
			'description' => __( 'Sidebar for LVAD Blog.' ),
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

	register_sidebar(
		array(
			'id' => 'product-sidebar',
			'name' => __( 'Product Sidebar' ),
			'description' => __( 'Sidebar for Product Page.' ),
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
}

add_action( 'widgets_init', 'my_register_sidebars' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'insurance_patients',
		array(
			'labels' => array(
				'name' => __( 'Insurance Patients' ),
				'singular_name' => __( 'Insurance Patient' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'insurance_patients'),
		)
	);
}

// add_action('init', 'my_custom_init');
// function my_custom_init() {
// 	add_post_type_support( 'design', 'thumbnail' );
// 	add_post_type_support( 'design', 'excerpt' );
// }

add_filter('show_admin_bar', '__return_false');

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


function wp_nav_menu_select_sort( $a, $b ) {
    return $a = $b;
}
 
function wp_nav_menu_select( $args = array() ) {
     
    $defaults = array(
        'theme_location' => '',
        'menu_class' => 'select-menu',
    );
     
    $args = wp_parse_args( $args, $defaults );
      
    if ( ( $menu_locations = get_nav_menu_locations() ) && isset( $menu_locations[ $args['theme_location'] ] ) ) {
        $menu = wp_get_nav_menu_object( $menu_locations[ $args['theme_location'] ] );
          
        $menu_items = wp_get_nav_menu_items( $menu->term_id );
         
        $children = array();
        $parents = array();
         
        foreach ( $menu_items as $id => $data ) {
            if ( empty( $data->menu_item_parent )  ) {
                $top_level[$data->ID] = $data;
            } else {
                $children[$data->menu_item_parent][$data->ID] = $data;
            }
        }
         
        foreach ( $top_level as $id => $data ) {
            foreach ( $children as $parent => $items ) {
                if ( $id == $parent  ) {
                    $menu_item[$id] = array(
                        'parent' => true,
                        'item' => $data,
                        'children' => $items,
                    );
                    $parents[] = $parent;
                }
            }
        }
         
        foreach ( $top_level as $id => $data ) {
            if ( ! in_array( $id, $parents ) ) {
                $menu_item[$id] = array(
                    'parent' => false,
                    'item' => $data,
                );
            }
        }
         
        // uksort( $menu_item, 'wp_nav_menu_select_sort' ); 
         
        ?>
            \\
        <?php
    } else {
        ?>
            <select class="menu-not-found">
                <option value=""><?php _e( 'Menu Not Found' ); ?></option>
            </select>
        <?php
    }
}