<?php
namespace DroitHead\Includes;
defined( 'ABSPATH' ) || exit;

use \DroitHead\Dtdr_Controller as Contr;

class Dtdr_Load{

    /**
     * instance property
     *
     * @var String
     */
    private static $instance;

    public $option_keys = 'drdt-dark-options-settings';

    public function _init(){
        if(current_user_can('manage_options')){
            add_action( 'admin_menu', array( $this, 'init_menu' ) );
            // all admin notices hidden
            add_action( 'admin_head', [$this, 'hidden_admin_notices'], 1 );

            // save setting data 
            add_action( 'wp_ajax_dtsave_settings', [ $this, 'save_settings'] );
        } 

        // admin script
        add_action( 'admin_enqueue_scripts', [ $this , 'admin_enqueue'] );

        // public enqueue
        add_action( 'wp_enqueue_scripts', [ $this , 'public_enqueue'] );

        // call Posttype page
        Posttype::_instance();

        // call Render page
        Render::_instance();

        // widgets loader for Elementor Page builder
        Widgets_Loader::_instance()->load();
              
    }
    
    /**
    * Name: init_menu
    * Desc: Add Admin Menu in WordPress Dashboard
    * Params: no params
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function init_menu(){
        
        do_action('drdt_header_admin_menu_start');

        /*add_menu_page( 
            __( 'Droit Header','droithead' ),
            __( 'Droit Header & Footer', 'droithead' ),
            'manage_options',
            'droit-head-settings',
            [$this, 'settings_page'],
            'dashicons-chart-pie',
            7
        );

        // render post type
        add_submenu_page(
			'droit-head-settings',
			__( 'Settings', 'droithead' ),
			__( 'Settings', 'droithead' ),
            'manage_options',
            'droit-head-settings',
            [$this, 'settings_page']
        );

        do_action('drdt_header_admin_menu_middle');
        
        // render post type
        add_submenu_page(
			'droit-head-settings',
			__( 'Create Template', 'droithead' ),
			__( 'Create Template', 'droithead' ),
			'edit_pages',
            'edit.php?post_type=droit-templates'
        );*/
        
        add_menu_page(
			__( 'Create Template', 'droithead' ),
			__( 'Droit Templates', 'droithead' ),
			'edit_pages',
            'edit.php?post_type=droit-templates',
            '',
            'dashicons-chart-pie',
            7
        );

        do_action('drdt_header_admin_menu_end');
    }
    
    /**
    * Name: hidden_admin_notices
    * Desc: Hidden all notices from Admin Dashboard
    * Params: @void
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function hidden_admin_notices(){
        $screen = get_current_screen();
        if( in_array($screen->id, [ 'toplevel_page_droit-head-settings']) ){
            remove_all_actions('admin_notices');
        }
    }
    
    public function settings_page(){
        // get options data
        $data = get_option($this->option_keys, true);
        // include view page
        include_once( Contr::dtdr_dir() . 'templates/admin/settings.php');
    }

    public function admin_enqueue(){
        wp_register_script( 'dtdr-clipboard', Contr::dtdr_url() . 'assets/scripts/clipboard/clipboard.min.js', ['jquery'], Contr::version(), true );

        wp_register_style( 'dtdr-settings-head', Contr::dtdr_url() . 'assets/css/settings.css', false, Contr::version() );
        wp_register_style( 'dtdr-admin-head', Contr::dtdr_url() . 'assets/css/admin-mode.css', false, Contr::version() );
        wp_register_script( 'dtdr-settings-head', Contr::dtdr_url() . 'assets/scripts/settings.js', ['jquery', 'dtdr-clipboard'], Contr::version(), true );
        wp_localize_script(
            'dtdr-settings-head',
            'dtdr',
            [
                'ajax_url'           => admin_url( 'admin-ajax.php' ),
                'rest_url'           => get_rest_url(),
            ]
        );

        global $pagenow;
        $screen = get_current_screen();
        
        if( in_array($screen->id, [ 'toplevel_page_droit-head-settings', 'droit-templates', 'edit-droit-templates']) ){
            wp_enqueue_style('dtdr-settings-head');
            wp_enqueue_script('dtdr-clipboard');
            wp_enqueue_script('dtdr-settings-head');
            
        }
 
        if( ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) || in_array($screen->id, [ 'toplevel_page_droit-head-settings', 'droit-templates', 'edit-droit-templates']) ){
            wp_enqueue_style('dtdr-admin-head');
            
        }
    }

    public function public_enqueue(){
        wp_register_style( 'drdt-header-footer', Contr::dtdr_url() . 'assets/css/public-mode.css', false, Contr::version() );
        wp_register_style( 'themify-icon', Contr::dtdr_url() . 'assets/css/themify-icons.css', false, Contr::version() );
        wp_register_script( 'drdt-header-footer', Contr::dtdr_url() . 'assets/scripts/public.js', ['jquery'], Contr::version(), true );

        // public css
        wp_enqueue_style( 'drdt-header-footer' );
        wp_enqueue_style( 'themify-icon' );
        wp_enqueue_script('drdt-header-footer');
    }

    /**
    * Name: save_settings
    * Desc: Save admin settings data
    * Params: no params
    * Return: @void
    * version: 1.0.0
    * Package: @droitedd
    * Author: DroitThemes
    * Developer: Hazi
    */

    public function save_settings(){
        $post = wp_slash($_POST);

        if( !isset( $post['form_data'] )){
            wp_send_json_error( ['error' => true, 'message' => 'Couldn\'t found any data']);
        }

        wp_parse_str( $_POST['form_data'], $formdata);

        $settings = ($formdata['drdt-setting']) ?? [];
        update_option($this->option_keys, $settings);

        wp_send_json_success($settings);
    }

    public static function _instance(){

        if( is_null(self::$instance) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}