<?php
namespace DroitHead\Includes;
defined( 'ABSPATH' ) || exit;

class Common{
   
    public $posttype = 'droit-templates';

    public function all_posts( $arg = ['post_type' => 'page', 'post_status' => 'publish'], $index = [])
    {
        if( !isset($arg['posts_per_page']) ){
            $arg['posts_per_page'] = -1;
        }
        

        $page = get_posts( $arg );
        $pages = [];
        foreach($page as $v){
            if( !isset($v->ID) ){
                continue;
            }
            $pages[$v->ID] = $v->post_title;
        }
        if( !empty($index)){
            if( is_array($index) ){
                return array_map(function( $in, $pg){
                    return ($pg[$in]) ?? '';
                }, $index, $pages);
            }
            return isset($pages[$index]) ?? '';
        }

        return $pages;
    }

    public function template_type_array( $index = ''){
        $type = apply_filters('drdt_head_template_type', [
            'header' => __('Header', 'droithead'),
            'footer' => __('Footer', 'droithead'),
            'banner' => __('Banner', 'droithead'),
            '404' => __('404 Pages', 'droithead')
        ]);
        if( !empty($index) ){
            return ($type[$index]) ?? '';
        }
        return $type;
    }

    

    public function working_posttype(){
        $post_types = get_post_types();
        $removeCate = [
            'elementor_library',
            'attachment',
            'revision',
            'nav_menu_item',
            'custom_css',
            'customize_changeset',
            'wp_block',
            'droit-templates',
            'edd_log',
            'oembed_cache',
        ];

        foreach($removeCate as $d){
            if( in_array( $d, $post_types) ){
                unset($post_types[array_search($d, $post_types)]);
            }
        }
        return apply_filters('drdt_head_template_select_posttype', array_values($post_types) );
    }
    

    public function enabled_header( $type = '' ){
        return true;
    }

    public function enabled_footer( $type = '' ){
        return true;
    }

}