<?php
namespace TH_ESSENTIAL\Elementor;
defined( 'ABSPATH' ) || exit;


use \TH_ESSENTIAL\DRTH_Plugin as DR_Plugin;

class Loader{

	private static $instance;

	public static function elementor_url(){
		return DR_Plugin::dtdr_th_url().'elementor/';
	}

	public static function elementor_dir(){
		return DR_Plugin::dtdr_th_dir().'elementor/';
	}

	public function _init(){
		// load group control
		if (did_action('elementor/loaded')) {
            
            // control loader
            Control_Loader::_instance()->load();

             // editor load
            if( !class_exists('\DROIT_ELEMENTOR_PRO\Dl_Editor')){
                self::_elementor_autoload('\DROIT_ELEMENTOR_PRO\Dl_Editor');
                \DROIT_ELEMENTOR_PRO\Dl_Editor::instance()->init();
            }
            // subscribe
            if( !class_exists('\DROIT_ELEMENTOR_PRO\Dl_Subscribe')){

                self::_elementor_autoload('\DROIT_ELEMENTOR_PRO\Providers\DL_Mailchimp');
                self::_elementor_autoload('\DROIT_ELEMENTOR_PRO\Providers\DL_Response');

                self::_elementor_autoload('\DROIT_ELEMENTOR_PRO\Dl_Subscribe');
                \DROIT_ELEMENTOR_PRO\Dl_Subscribe::instance()->init();
            }
            // custom css
            if( !class_exists('\DROIT_ELEMENTOR_PRO\DL_Custom_CSS')){
                self::_elementor_autoload('\DROIT_ELEMENTOR_PRO\DL_Custom_CSS');
                \DROIT_ELEMENTOR_PRO\DL_Custom_CSS::instance()->init();
            }
            if( !class_exists('\DROIT_ELEMENTOR_PRO\Module\Query\Grid_Query')){
                require __DIR__.'/query/posts-grid.php';
                new \DROIT_ELEMENTOR_PRO\Module\Query\Grid_Query;
            }
           
            // load widgets
           //
           Widgets_Loader::_instance()->load();
		}
		
	}


    public static function add_mapping_class(){
		$elementor = [

            // group control
			'Content_Typography' => 'controls/groups/content-typography.php',
            'DL_Image' => 'controls/groups/image.php',
            'Icon' => 'controls/groups/icon.php',
            'Icon_SVG' => 'controls/groups/icon-svg.php',
            'Position' => 'controls/groups/position.php',
            'Button' => 'controls/groups/button.php',
            'Button_Size' => 'controls/groups/button-size.php',
            'Button_Hover' => 'controls/groups/button-hover.php',
            'Button_Hover_Advanced' => 'controls/groups/button-hover-advanced.php',
            'Button_Hover_Advanced_Second' => 'controls/groups/button-hover-advanced-second.php',

            // section 
            'CSS_Transform' => 'controls/sections/transform/class-transform.php',
            'Parallax' => 'controls/sections/parallax/class-parallax.php',
            'Effect' => 'controls/sections/effect/class-effect.php',
            'Lottie' => 'controls/sections/lottie/class-lottie.php',

            // modules
            'Dl_Editor' => 'editor/popup-editor.php',
            'Dl_Subscribe' => 'subscribe/subscribe.php',
            'Providers\DL_Mailchimp' => 'subscribe/providers/mailchimp.php',
            'Providers\DL_Response' => 'subscribe/providers/response.php',
            'DL_Custom_CSS' => 'custom-css/custom-css.php',
            'DL_Page_Scroll' => 'page-scroll/page-scroll.php',
		];
		return $elementor;
	}
    public static function _elementor_autoload( $ld ){
        $map = self::add_mapping_class();
        $relative_class_name = substr(preg_replace( '/\b'.'DROIT_ELEMENTOR_PRO\\\/', '', $ld ), 1);
        if( isset( $map[ $relative_class_name ] ) ){
            $name = $map[ $relative_class_name ];
            $filename = self::elementor_dir() . $name;
            if ( is_readable( $filename ) ) {
                require_once( $filename );
             }
        }
    }


	public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}