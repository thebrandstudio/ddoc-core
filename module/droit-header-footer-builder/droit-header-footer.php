<?php
/**
 * @package droithead
 * @developer DroitLab Team
 */

// define the main file 
define( 'DROIT_HEAD_FILE_', __FILE__ );
 
// controller page
include 'controller.php';

// load of controller files
// after theme switch
add_action( 'after_switch_theme', 'drdt_head_active' );
// when plugin active
register_activation_hook(__FILE__, 'drdt_head_active');

/**
* Name: add_cpt_support
* Desc: Support custom posttype 
* Params: no params
* Return: @void
* version: 1.0.0
* Package: @droitedd
* Author: DroitThemes
* Developer: Hazi
*/

function drdt_head_active(){
    $cpt_support = get_option( 'elementor_cpt_support', [ 'page', 'post', 'portfolio' ] );
    foreach ( $cpt_support as $cpt_slug ) {
        add_post_type_support( $cpt_slug, 'elementor' );
    }
    // add custom posttype
    if( !in_array('droit-templates', $cpt_support) ){
        add_post_type_support( 'droit-templates', 'elementor' );
        $cpt_support[] = 'droit-templates';
        update_option('elementor_cpt_support', $cpt_support);
        flush_rewrite_rules();
    }
   
}

function drdt_kses_html( $content = ''){
    return $content;
}

// load plugin
add_action( 'plugins_loaded', function(){
	// load text domain
	load_plugin_textdomain( 'ddoc-core', false, basename( dirname( __FILE__ ) ) . '/languages'  );
	// load plugin instance
    \DroitHead\Dtdr_Controller::instance()->load();

    // load include
    \DroitHead\Includes\Dtdr_Load::_instance()->_init();

}, 10); 

// load admin acripts 

function ddoc_core_template_script( $page ) {

    global $post_type;

    if( 'droit-templates' == $post_type ){
        // load style
        wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'assets/scripts/admin.js' );
        //  localize script
        wp_localize_script( 'my_custom_script', 'four_zeor_editor',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce('four-zero-nonce')
        )
    );

    }
}

add_action('admin_enqueue_scripts', 'ddoc_core_template_script');

//  save 404 page editor meta 

add_action( 'wp_ajax_ddoc_404_page', 'ddoc_404_page' );
add_action( 'wp_ajax_nopriv_ddoc_404_page', 'ddoc_404_page' );

function ddoc_404_page() {
    $args = array(
        'numberposts' => -1,
        'post__not_in' => array( $_POST['post_id'] ),
        'post_type' => 'droit-templates',
        'meta_key'         => 'is_droit_404_active',
        'meta_value'       => 'yes',
    );
  
    $post_id = [];
    $get_post = get_posts($args);
    foreach($get_post as $post) {
        $post_id[] =  $post->ID;
    }
    
    if(!empty($post_id)) {
        foreach($post_id as $id) {
            update_post_meta($id, 'is_droit_404_active', 'no');
        }
    }
    update_post_meta($_POST['post_id'], 'is_droit_404_active',  $_POST['status']);
     
     if($_POST['status'] == 'yes') {
         echo "<span>404 page Actice successfully</span>";
     }else{
         echo "<span>404 page deactived</span>";
     }

    wp_die();
}
