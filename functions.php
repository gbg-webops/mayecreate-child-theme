<?php

// NOTE: To overwrite the script file in the parent theme uncomment this section and copy the mayecreate_sripts.js file into a folder called js in your child theme. Then edit that file.
add_action('wp_enqueue_scripts', 'mayecreate_script_fix', 100);
function mayecreate_script_fix()
{
    wp_dequeue_script('mayecreatejs');
    wp_dequeue_script('mc-block-editor-script');
    wp_enqueue_script( 'mc-block-editor-script_child', get_stylesheet_directory_uri() . '/js/mayecreate_scripts.js', false, '1.0', 'all' );
    wp_enqueue_script('child_theme_mayecreatejs', get_stylesheet_directory_uri().'/js/mayecreate_scripts.js', array('jquery'));
}

add_action( 'wp_enqueue_scripts', 'mc_enqueue_child_theme_styles', PHP_INT_MAX);
function mc_enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style')  );
}


/* NOTE: These functions are functions that don't need to be in the parent theme because not every site will have them. */
function build_taxonomies() {
   register_taxonomy( 'projectcategory', 'menu', array( 'hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true, 'show_in_rest' => true ) );
}

function mayecreate_create_post_type_child() {
	
	// Register the "Project" custom post type if this is not needed, DELETE ME.
		register_post_type( 'projects',
			array(
				'labels' => array(
					'name'              => __( 'Projects'),
					'singular_name'     => __( 'Project' ),
					'add_new'           => __( 'Add Project' ),
					'add_new_item'      => __( 'Add New Project' ),
					'edit_item'         => __( 'Edit Project' ),  
					
				),
			'public' => true,
			'menu_position' => 10,
			'rewrite' => array('slug' => 'project', 'with_front' => false),
			'supports' => array('title','thumbnail','revisions','editor'),
			'menu_icon'         => 'dashicons-art',
			'taxonomies' => array('projectcategory'),
			'show_in_rest' => true,
			'has_archive' => true 
			)
		);
    
 
	
	
	
}
add_action( 'init', 'mayecreate_create_post_type_child' );

function child_theme_colors() {
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Black', 'mayecreate-child-theme' ),
				'slug'  => 'black',
				'color' => '#000',
			),
			array(
				'name'	=> __( 'White', 'mayecreate-child-theme' ),
				'slug'	=> 'white',
				'color'	=> '#fff',
			),
			array(
				'name'	=> __( 'Grey', 'mayecreate-child-theme' ),
				'slug'	=> 'grey',
				'color'	=> '#ccc',
			),
			array(
				'name'	=> __( 'Dark Grey', 'mayecreate-child-theme' ),
				'slug'	=> 'dark-grey',
				'color'	=> '#707070',
			),
			array(
				'name'	=> __( 'Hot Pink', 'mayecreate-child-theme' ),
				'slug'	=> 'hotpink',
				'color'	=> '#f542e6',
			),
			array(
				'name'	=> __( 'Blue', 'mayecreate-child-theme' ),
				'slug'	=> 'blue',
				'color'	=> '#1E2773',
			),
			array(
				'name'	=> __( 'Yellow', 'mayecreate-child-theme' ),
				'slug'	=> 'yellow',
				'color'	=> '#F5B813',
			),
		) );
	}
add_action( 'after_setup_theme', 'child_theme_colors' );



if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Contact Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	
}