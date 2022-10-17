<?php

/**
 *
 * Custom Post Type And Taxonomies Class
 *
 */
namespace Ddoc_custom_post_type;

if ( ! defined( 'ABSPATH' ) ) exit;

class Ddoc_Custom_Post_type {

    private $dt_posts;

    public function __construct( ){

        $this->dt_posts = array();

        add_action('init', array($this, 'register_custom_post'));
    }

    public function ddoc_post_type( $posttype, $singular_label, $plural_label, $settings = array(), $admin_page_name = null ){
        
        $default_settings = array(
            'labels' => array(
                'name' => __($plural_label, ' ddoc-core'),
                'singular_name' => __($singular_label, 'ddoc-core'),
                'add_new_item' => __('Add New '.$singular_label, 'ddoc-core'),
                'edit_item'=> __('Edit '.$singular_label, 'ddoc-core'),
                'new_item'=>__('New '.$singular_label, 'ddoc-core'),
                'view_item'=>__('View '.$singular_label, 'ddoc-core'),
                'search_items'=>__('Search '.$plural_label, 'ddoc-core'),
                'not_found'=>__('No '.$plural_label.' found', 'ddoc-core'),
                'not_found_in_trash'=>__('No '.$plural_label.' found in trash', 'ddoc-core'),
                'parent_item_colon'=>__('Parent '.$singular_label, 'ddoc-core'),
                'menu_name' => __($plural_label,'ddoc-core')
            ),
            'public'=>true,
            'has_archive' => true,
            'menu_position'=>20,
            'show_in_menu' => $admin_page_name,
            'supports'=>array(
                'title',
                'editor',
                'thumbnail',
                'excerpt'
            ),
            'rewrite' => array(
                'slug' => sanitize_title_with_dashes($plural_label)
            )
        );
        $this->dt_posts[$posttype] = array_merge($default_settings, $settings);
    }

    public function register_custom_post(){
        foreach($this->dt_posts as $key=>$value) {
            register_post_type($key, $value);
            flush_rewrite_rules( false );
        }
    }
    
}

class Ddoc_Taxonomies {

    protected $taxonomies;

    public function __construct ( ){

        $this->taxonomies = array();
        add_action('init', array($this, 'register_taxonomy'));

    }

    public function ddoc_taxonomy( $taxonomy, $singular_label, $plural_label, $post_types, $settings = array() ){
        $default_settings = array(
            'labels' => array(
                'name' => __($plural_label, 'ddoc-core'),
                'singular_name' => __($singular_label, 'ddoc-core'),
                'add_new_item' => __('New '.$singular_label.' Name', 'ddoc-core'),
                'new_item_name' => __('Add New '.$singular_label, 'ddoc-core'),
                'edit_item'=> __('Edit '.$singular_label, 'ddoc-core'),
                'update_item'=> __('Update '.$singular_label, 'ddoc-core'),
                'add_or_remove_items'=> __('Add or remove '.strtolower($plural_label), 'ddoc-core'),
                'search_items'=>__('Search '.$plural_label, 'ddoc-core'),
                'popular_items'=>__('Popular '.$plural_label, 'ddoc-core'),
                'all_items'=>__('All '.$plural_label, 'ddoc-core'),
                'parent_item'=>__('Parent '.$singular_label, 'ddoc-core'),
                'choose_from_most_used'=> __('Choose from the most used '.strtolower($plural_label), 'ddoc-core'),
                'parent_item_colon'=>__('Parent '.$singular_label, 'ddoc-core'),
                'menu_name'=>__($singular_label, 'ddoc-core'),
            ),

            'public'=>true,
            'show_in_nav_menus' => true,
            'show_admin_column' => false,
            'hierarchical'      => true,
            'show_tagcloud'     => false,
            'show_ui'           => true,
            'rewrite' => array(
                'slug' => sanitize_title_with_dashes($plural_label)
            )
        );

        $this->taxonomies[$taxonomy]['post_types'] = $post_types;
        $this->taxonomies[$taxonomy]['args'] = array_merge($default_settings, $settings);
    }

    public function register_taxonomy(){
        foreach($this->taxonomies as $key => $value) {
            register_taxonomy($key, $value['post_types'], $value['args']);
        }
    }

}