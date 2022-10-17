<?php
namespace TH_ESSENTIAL\Manager;
defined( 'ABSPATH' ) || exit;

class Enqueue{

    private static $instance;

    public function register(){
        
        if(current_user_can('manage_options')){
            // admin script
            add_action( 'admin_enqueue_scripts', [ $this , 'admin_enqueue'] );
        }

        // public script
        add_action( 'wp_enqueue_scripts', [ $this , 'public_enqueue'], 9999);
        if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( '\Elementor\Plugin::instance' ) ) {
            add_action('elementor/frontend/before_register_scripts', [$this, 'public_enqueue'], 9999);
        }
    }

    public function admin_enqueue(){
        
        do_action('dlTheEss/admin/enqueue/before');

        $screen = get_current_screen();


        do_action('dlTheEss/admin/enqueue/after');

    }

    public function public_enqueue(){

        do_action('dlTheEss/public/enqueue/before');


/*
        // load css
        */
        wp_enqueue_style( 'niceselect-css', drdt_th_core()->vendor . 'nice-select/css/nice-select.css' );
        
        // load js
       
        wp_enqueue_script( 'niceselect-js', drdt_th_core()->vendor . 'nice-select/js/jquery.nice-select.min.js', ['jquery'], drdt_th_core()->version, true ); 
        
        do_action('dlTheEss/public/enqueue/after');

        //common css
        wp_enqueue_style( 'dlAddonsPro-common', drdt_th_core()->css . 'common.min.css', [], drdt_th_core()->version );

        // widgets js
        wp_register_script( 'dlAddonsPro-common', drdt_th_core()->js . 'common.min.js', ['jquery'], drdt_th_core()->version, true ); 
        wp_localize_script(
            'dlPro-common',
            'dlAddonsPro',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'admin_url' => admin_url('post.php'),
                'wp_nonce' => wp_create_nonce('dlAddons_widget_nonce'),
            )
        );

        do_action('dlTheEss/public/enqueue/end'); 
    }

    
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

