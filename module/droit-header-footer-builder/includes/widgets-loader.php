<?php
namespace DroitHead\Includes;
defined( 'ABSPATH' ) || exit;

class Widgets_Loader{

    private static $instance;
    
    private static $elementor;

    private $widgets = [];

    public function load(){
        $this->widgets = apply_filters('drdt_header_widgets', [
            'nav-menu' => 'Nav menu',
            'site-logo' => 'Site Logo',
            'search-bar' => 'Search bar',
            'back-to-top' => 'Back To Top',
            'hover-thumbnails-mega-menu' => 'Hover Thumbnails Mega Menu',
        ]);

        // checking elementor widgets
        if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {

            self::$elementor = \Elementor\Plugin::instance();
            
            add_action( 'elementor/elements/categories_registered', [$this, 'register_category' ] );
            add_action( 'elementor/widgets/widgets_registered', [$this, 'register_widgets' ] );

            // add section class for sticky
            if ( !defined('DROIT_EL_PRO_FILE')) {
                add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'sticky_option'], 99, 1);
                add_action('elementor/frontend/section/before_render', [ $this, 'sticky_render'], 1 );
            }

        }
        // Add svg support.
        add_filter( 'upload_mimes', [$this, 'svg_mime_add']);
        
    }

    /**
    * Name: svg_mime_types
    * Desc: Support Svg image upload in wordpress directory
    * Params: no params
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function svg_mime_add($mimes){
        $mimes['svg'] = 'image/svg+xml';
		return $mimes;
    }

    /**
    * Name: register_category
    * Desc: Register categories in elementor editor list
    * Params: @$categories
    * Return: @$categories
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */

    public function register_category( $categories ) {
		$category = __( 'Droit Header & Footer', 'droithead' );
		$categories->add_category(
			'drit-header-footer',
			[
				'title' => $category,
				'icon'  => 'eicon-font',
			]
		);
		return $categories;
    }
    
    /**
    * Name: register_widgets
    * Desc: Register widgets in elementor editor list
    * Params: no params
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */

    public function register_widgets(){
        if( !empty($this->widgets) ){
            foreach($this->widgets as $k=>$v){
                $files = __DIR__ . '/widgets/'.$k.'.php';
                if( !is_readable($files) || !is_file($files) ){
                    continue;
                }
                require_once( $files );
                $clsssName = str_replace([' ', '-', ''], '_', ucwords(str_replace([' ', '-', ''], ' ', $k)) );
                $class = "\Elementor\DRDT_".$clsssName;
                if( class_exists($class) ){
                    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                }
            }
        }
    }


    public function sticky_option($el){
        if ( 'section' === $el->get_name()) {
            $el->start_controls_section(
                'dl_sticky_section',
                [
                    'label' => __( 'Sticky Section', 'droithead' ) ,
                    'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
                ]
            );

            $el->add_control(
                'dl_sticky_section_enable',
                [
                    'label' => __( 'Enable', 'droithead' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'droithead' ),
                    'label_off' => __( 'No', 'droithead' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $el->end_controls_section();
        }
    }

    public function sticky_render( $el ){
        if ( 'section' === $el->get_name() ) {
            $settings = $el->get_settings_for_display();
            $id = $el->get_id();
            $sctionEnable = isset($settings['dl_sticky_section_enable']) ? $settings['dl_sticky_section_enable'] : 'no';
            if($sctionEnable == 'yes'){
                $attr['class'] = 'drdt_is_sticky_header';
                $el->add_render_attribute(
                    '_wrapper',
                    $attr
                );
            }
        }

    }

    public static function _instance(){
        if( is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}