<?php


// Load Stylesheets
function load_css()
{


		wp_register_style('bootstrap', get_template_directory_uri() . '/bs/css/bootstrap.min.css', array(), false, 'all' );
		wp_enqueue_style('bootstrap');


		// wp_register_style('magnific', get_template_directory_uri() . '/css/magnific-popup.css', array(), false, 'all' );
		// wp_enqueue_style('magnific');


		wp_register_style('main', get_template_directory_uri() . '/cssjs/main.css', array(), false, 'all' );
		wp_enqueue_style('main');


	
}
add_action('wp_enqueue_scripts','load_css');



// Load Javascript
function load_js()
{	
		wp_enqueue_script('jquery');

		wp_register_script('bootstrap', get_template_directory_uri() . '/bs/js/bootstrap.min.js', 'jquery', false, true);
		wp_enqueue_script('bootstrap');

		// wp_register_script('magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', 'jquery', false, true);
		// wp_enqueue_script('magnific');


		// wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', 'jquery', false, true);
		// wp_enqueue_script('custom');

}
add_action('wp_enqueue_scripts', 'load_js');




// Theme Options
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');



// Menus
register_nav_menus(

		array(

			'top-menu' => 'Top Menu Location',
			'mobile-menu' => 'Mobile Menu Location',
			'footer-menu' => 'Footer Menu Location',

		)

);


// Custom Image Sizes
add_image_size('blog-large', 800, 600, false);
add_image_size('blog-small', 300, 200, true);

//Register Sidebars
function my_sidebars()
{


			register_sidebar(

						array(

								'name' => 'Page Sidebar',
								'id' => 'page-sidebar',
								'before_title' => '<h3 class="widget-title">',
								'after_title' => '</h3>'

						)

			);


			register_sidebar(

						array(

								'name' => 'Blog Sidebar',
								'id' => 'blog-sidebar',
								'before_title' => '<h3 class="widget-title">',
								'after_title' => '</h3>'

						)

			);



}
add_action('widgets_init','my_sidebars');

function my_first_post_type()
{
	$args = array(
		'labels'=> array(
			'name' => 'Cars',
			'singular_name' => 'Car',
		),
		'hierarchical' => true,
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => array('title','editor','thumbnail','custom-fields'),
		// 'rewrite' => array('slug'=>'cars'),
	);

	register_post_type('cars',$args);


}
add_action('init','my_first_post_type');


function my_first_taxonomy()
{
	$args=array(
		'labels'=> array(
			'name' => 'Brands',
			'singular_name' => 'Brand',
		),
		'public' => true,
		'hierarchical' => true,
	);
	register_taxonomy('brands',array('cars'),$args);
}

add_action('init','my_first_taxonomy');


//Adding LoginIn and LogOut link in Nav Menu
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li>'. $loginoutlink .'</li>';
    return $items;
}