<?php
namespace DROIT_ELEMENTOR_PRO;


use \Elementor\Controls_Stack;
use \Elementor\Core\DynamicTags\Dynamic_CSS;
use \Elementor\Core\Files\CSS\Post;
use \Elementor\Element_Base;

defined('ABSPATH') || die();

if (!class_exists('DL_Custom_CSS')) {
    class DL_Custom_CSS
    {
        private static $instance = null;

        public static function url(){
            if (defined('DROIT_ADDONS_PRO_FILE_')) {
                $file = trailingslashit(plugin_dir_url( DROIT_ADDONS_PRO_FILE_ )). 'modules/custom-css/';
            } else {
                $file = trailingslashit(plugin_dir_url( __FILE__ ));
            }
            return $file;
        }
    
        public static function dir(){
            if (defined('DROIT_ADDONS_PRO_FILE_')) {
                $file = trailingslashit(plugin_dir_path( DROIT_ADDONS_PRO_FILE_ )). 'modules/custom-css/';
            } else {
                $file = trailingslashit(plugin_dir_path( __FILE__ ));
            }
            return $file;
        }
    
        public static function version(){
            if( defined('DROIT_ADDONS_VERSION_PRO') ){
                return DROIT_ADDONS_VERSION_PRO;
            } else {
                return apply_filters('dladdons_pro_version', '1.0.0');
            }
            
        }

        public function init()
        {
            
            add_action( 'elementor/editor/after_enqueue_scripts', function() {              
                    wp_enqueue_script("dl-custom-css", self::url() . 'js/custom.min.js', ['jquery'], self::version(), true);
                } 
            );

            //add_action('dl_widget/section/style/custom_css', [$this, '_droit_custom_css'], 1);
            
            add_action('elementor/element/column/section_advanced/after_section_end', [$this, '_droit_custom_css'], 1);
            add_action('elementor/element/section/section_advanced/after_section_end', [$this, '_droit_custom_css'], 1);
            add_action('elementor/element/common/_section_style/after_section_end', [$this, '_droit_custom_css'], 1);

            add_action( 'elementor/element/parse_css', [ $this, '_droit_add_post_css' ], 10, 2 );
            add_action( 'elementor/css-file/post/parse', [ $this, '_droit_add_page_settings_css' ] );
        }

        public function _droit_custom_css( Element_Base $el ) {
            $el->start_controls_section(
                '_droit_custom_css_section',
                [
                    'label' => __( 'Custom CSS', 'droit-addons-pro' ) . dl_get_icon() ,
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    
                ]
            );
            $el->add_control(
                'droit_custom_css_title',
                [
                    'raw' => __( 'Add your own custom CSS here', 'droit-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                ]
            );
            $el->add_control(
                '_droit_custom_css',
                [
                    'type' => \Elementor\Controls_Manager::CODE,
                    'label' => __( 'Custom CSS', 'droit-addons-pro' ),
                    'language' => 'css',
                    'render_type' => 'ui',
                    'show_label' => false,
                    'separator' => 'none',
                ]
            );

            $el->add_control(
                '_droit_custom_css_description',
                [
                    'raw' => __( 'Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector', 'droit-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-descriptor',
                ]
            );
            $el->end_controls_section();
        }

        public function _droit_add_post_css( $post_css, $element ) {
            if ( $post_css instanceof Dynamic_CSS ) {
                return;
            }

            $element_settings = $element->get_settings();
            if ( empty( $element_settings['_droit_custom_css'] ) ) {
                return;
            }

            $css = trim( $element_settings['_droit_custom_css'] );

            if ( empty( $css ) ) {
                return;
            }
            $css = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $css );

            $css = sprintf( '/* Start custom CSS for %s, class: %s */', $element->get_name(), $element->get_unique_selector() ) . $css . '/* End custom CSS */';

            $post_css->get_stylesheet()->add_raw_css( $css );
        }

        public function _droit_add_page_settings_css( $post_css ) {
            $document = \Elementor\Plugin::instance()->documents->get( $post_css->get_post_id() );
            $custom_css = $document->get_settings( '_droit_custom_css' );

            $custom_css = trim( $custom_css );

            if ( empty( $custom_css ) ) {
                return;
            }

            $custom_css = str_replace( 'selector', $document->get_css_wrapper_selector(), $custom_css );

            $custom_css = '/* Start Droit custom CSS */' . $custom_css . '/* End Droit custom CSS */';

            $post_css->get_stylesheet()->add_raw_css( $custom_css );
        }
        
        public static function instance(){
            if( is_null(self::$instance) ){
                self::$instance = new self();
            }
            return self::$instance;
        }
    }
}
