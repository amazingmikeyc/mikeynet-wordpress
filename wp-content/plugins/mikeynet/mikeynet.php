<?php
/*
Plugin Name: Mikeynet
Plugin URI: www.mikeynet.co.uk
Description: Makes mikeynet
Author: Mike Congreve
Version: 1
Author URI: www.mikecongreve.com
*/
$labels = array(
   'name' => _x('meta_page', 'post type general name'),
   'singular_name' => _x('Meta_Page', 'post type singular name'),
   'add_new' => _x('Add New', 'MetaPage'),
   'add_new_item' => __('Add MetaPage'),
   'edit_item' => __('Edit MetaPage'),
   'new_item' => __('New MetaPage'),
   'view_item' => __('View MetaPage'),
   'search_items' => __('Search MetaPage'),
   'not_found' =>  __('Nothing found'),
   'not_found_in_trash' => __('Nothing found in Trash'),
   'parent_item_colon' => ''
);
 
$args = array(
   'labels' => $labels,
   'public' => true,
   'publicly_queryable' => true,
   'show_ui' => true,
   'query_var' => true,
   'menu_icon' => get_stylesheet_directory_uri() . '/images/newsletter.gif',
   'rewrite' => false,
   'capability_type' => 'post',
   'hierarchical' => false,
   'menu_position' => 20,
   'supports' => array('title','editor', 'excerpt')
);
 
//Register the newsletter post type.
register_post_type( 'meta_page' , $args );

function add_image() {
        //lol
}

//d_meta_box("image-box", "Image", "add_image", "page", "side", "low");



?>
