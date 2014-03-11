<?php

// Make Client Post Type
function fyc_clients_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'Clients', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Clients', 'fyc' ), /* This is the Title of the Group */
			'singular_name' => __( 'Client', 'fyc' ), /* This is the individual type */
			'all_items' => __( 'All Clients', 'fyc' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'fyc' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Client', 'fyc' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'fyc' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Client', 'fyc' ), /* Edit Display Title */
			'new_item' => __( 'New Client', 'fyc' ), /* New Display Title */
			'view_item' => __( 'View Client', 'fyc' ), /* View Display Title */
			'search_items' => __( 'Search Clients', 'fyc' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database. Click "Add New" to make a new Client. ', 'fyc' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'fyc' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is where you enter your Clients.', 'fyc' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => plugin_dir_url( __FILE__ ) . 'images/users.png', /* the icon for the Client type menu */
			'rewrite'	=> array( 'slug' => 'clients', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'clients', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your Client type */
	register_taxonomy_for_object_type( 'category', 'Clients' );
	
}
	// adding the function to the Wordpress init
	add_action( 'init', 'fyc_clients_post_type');	


function fyc_remove_comments() {
	remove_post_type_support( 'clients', 'comments' );
}
add_action( 'init', 'fyc_remove_comments' );




//hook into the init action and call create_Clients_nonhierarchical_taxonomy when it fires
		add_action( 'init', 'fyc_clients_tax', 0 );

		function fyc_clients_tax() {

		// Labels part for the GUI

		  $labels = array(
		    'name' => _x( 'Clients', 'taxonomy general name' ),
		    'singular_name' => _x( 'Client', 'taxonomy singular name' ),
		    'search_items' =>  __( 'Search Clients' ),
		    'popular_items' => __( 'Popular Clients' ),
		    'all_items' => __( 'All Clients' ),
		    'parent_item' => null,
		    'parent_item_colon' => null,
		    'edit_item' => __( 'Edit Client' ), 
		    'update_item' => __( 'Update Client' ),
		    'add_new_item' => __( 'Add New Client' ),
		    'new_item_name' => __( 'New Client Name' ),
		    'separate_items_with_commas' => __( 'Separate Clients with commas' ),
		    'add_or_remove_items' => __( 'Add or remove Clients' ),
		    'choose_from_most_used' => __( 'Choose from the most used Clients' ),
		    'menu_name' => __( 'Clients' ),
		    'priority' => __( 'high' ),
		  ); 

		// Now register the non-hierarchical taxonomy like tag

		  register_taxonomy(
		  	'Clients',
		  	array( 'clients','post' ),
		  	array( 'hierarchical' => false,
				   'labels' => $labels,
				   'show_ui' => true,
				   'show_admin_column' => true,
				   'update_count_callback' => '_update_post_term_count',
				   'query_var' => true,
				   'rewrite' => array( 'slug' => 'client' ),
		  ));
		}
?>
