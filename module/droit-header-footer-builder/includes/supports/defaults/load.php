<?php
namespace DroitHead\Includes\Supports\Defaults;

defined( 'ABSPATH' ) || exit;

use \DroitHead\Includes\Supports\Support as Support;

class Load Extends Support{

    public static $instance;

    public function __construct(){
        
        if(  $this->get_method() == 'method2'){
            add_action( 'wp', [ $this, 'apply_method2' ] );
        } else {
            add_action( 'wp', [ $this, 'apply_method1' ] );
        }

    }

    public function apply_method1(){
        // render header template


 
    }
    
    public function apply_method2(){

        if( $this->enabled_header('header') || $this->enabled_header('top_header') || $this->enabled_header('bottom_header') ){
            // Replace header.php template by DroitLab Pluhin
            add_action( 'get_header', [ $this, 'replace_header_method2' ] );

            // render top header templates
            if( $this->enabled_header('top_header') ){
                add_action('droithead_header_before', [ $this, 'render_header_top']);
            }

            // render header templates
            if( $this->enabled_header('header') ){
                add_action('droithead_header', [ $this, 'render_header']);
                add_action('wp_body_open', [ $this, 'render_header']);
            }

            // render bottom header templates
            if( $this->enabled_header('bottom_header') ){
                add_action('droithead_header_after', [ $this, 'render_header_bottom']);
            }
            
            
        }
        // rendfer footer template
        if( $this->enabled_footer('footer') || $this->enabled_footer('before_footer') ){
            // Replace footer.php template.
            //add_action( 'get_footer', [ $this, 'replace_footer_method2' ] );
        }

        // before footer
        if( $this->enabled_header('before_footer') ){
            add_action('wp_footer', [ $this, 'render_footer_before'], 20);
        }
        // footer templates
        if( $this->enabled_header('footer') ){
            add_action('wp_footer', [ $this, 'render_footer'], 50);
        }
    }

    public function replace_header(){
        require __DIR__ . '/header.php';

		$templates   = [];
		$templates[] = 'header.php';
		remove_all_actions( 'wp_head' );
		ob_start();
		locate_template( $templates, true );
        ob_get_clean();
        
    }

    public function replace_header_method2(){
        $templates   = [];
        $templates[] = 'header.php';
        locate_template( $templates, true );
        if ( ! did_action( 'wp_body_open' ) ) {
            did_action('droithead_header');
        }
    }

    public function replace_footer(){
        require __DIR__ . '/footer.php';

		$templates   = [];
		$templates[] = 'footer.php';
		remove_all_actions( 'wp_footer' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();  
    }

    public function replace_footer_method2(){

    }


    public static function _instance(){
        if( is_null(self::$instance) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}