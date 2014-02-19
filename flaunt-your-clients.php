<?php
/**
 * Plugin Name: Flaunt Your Clients
 * Plugin URI: http:#
 * Description: Flaunt Your Clients is a plugin for Professional Photographers to create Client Hubs that display related posts, Love Stories, and Reviews from your Clients. It's the perfect social proof for gaining new clients.
 * Version: 0.5
 * Author: William Bay of Flaunt Your Site
 * Author URI: http://flauntyoursite.com
 * License: GPL2
 * Contributors: bahia0019, brainfestation 
 */


/******************************
* global variables
******************************/

$fyc_prefix = 'fyc_';
$fyc_plugin_name = 'Flaunt Your Clients';

/******************************
* includes
******************************/

global $acf;
if( !$acf )
{
    define( 'ACF_LITE' , true );
    include_once('includes/advanced-custom-fields/acf.php' );
}

include('includes/custom-post-types.php'); // Custom Post Types for the Client Pages
include('includes/client-template.php' );

/******************************
* script control
******************************/

function fyc_load_styles() {
		wp_enqueue_style( 'fyc-styles', plugin_dir_url( __FILE__ ) . 'css/fyc-styles.css' );
	}
add_action( 'wp_enqueue_scripts', 'fyc_load_styles' );



/******************************
* Flush Post Type rewrite Rules
******************************/

function fyc_activate() {
	// register taxonomies/post types here
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'fyc_activate' );

function fyc_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'fyc_deactivate' );




/******************************
* ACF Custom Fields
******************************/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_client-id',
		'title' => 'Client ID',
		'fields' => array (
			array (
				'key' => 'field_530179f4f51dc',
				'label' => 'Select your client',
				'name' => 'client_id',
				'type' => 'taxonomy',
				'required' => 1,
				'taxonomy' => 'Clients',
				'field_type' => 'select',
				'allow_null' => 1,
				'load_save_terms' => 1,
				'return_format' => 'id',
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_clients',
		'title' => 'Clients',
		'fields' => array (
			array (
				'key' => 'field_5303c9333e37f',
				'label' => 'Client Featured Image',
				'name' => 'client_featured_image',
				'type' => 'image',
				'required' => 1,
				'save_format' => 'url',
				'preview_size' => 'large',
				'library' => 'all',
			),
			array (
				'key' => 'field_5303bfbc6b9b7',
				'label' => 'Client Proofing Url',
				'name' => 'client_proofing_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'http://proofingsite.com/client-123',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5303c0116b9b8',
				'label' => 'Client Story',
				'name' => 'client_story',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_5303c0436b9b9',
				'label' => 'Client Review',
				'name' => 'client_review',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'clients',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'author',
				7 => 'format',
				8 => 'featured_image',
				9 => 'categories',
				10 => 'tags',
				11 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

			function remove_clients_metabox() 
			{
				remove_meta_box('tagsdiv-'.Clients, post, 'side' );
			        
			        // $custom_taxonomy_slug is the slug of your taxonomy, e.g. 'genre' )
			        // $custom_post_type is the "slug" of your post type, e.g. 'movies' )
			}
			add_action( 'admin_menu', 'remove_clients_metabox' );		