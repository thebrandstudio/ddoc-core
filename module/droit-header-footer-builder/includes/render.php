<?php
namespace DroitHead\Includes;
defined( 'ABSPATH' ) || exit;

class Render Extends Common{
   

     /**
     * Current theme template
     *
     * @var String
     */
    public $template;

    /**
     * instance property
     *
     * @var String
     */
    public static $instance;

    public function __construct(){
        // other options call
        add_filter( 'body_class', [ $this, 'body_class' ] );
        add_action( 'switch_theme', [ $this, 'reset_unsupported' ] );

        // templates redirect for single page
        add_action( 'template_redirect', [ $this, 'template_frontend' ] );
        // single templates 
        add_filter( 'single_template', [ $this, 'load_template' ] );
        
        // shortcode
        add_shortcode( 'dtdr-template', [ $this, 'shortcode_template' ] );

        $this->template = get_template();
        
        add_action( 'init', [$this, 'setup_unsupported_theme'] );
    }

    /**
    * Name: body_class
    * Desc: Add Class in front-end body
    * Params 1: @array - Get all previous class list
    * Return: @array - all classes array
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function body_class( $classes ) {
		if ( $this->enabled_header() ) {
			$classes[] = 'droit-header';
		}

		if ( $this->enabled_footer() ) {
			$classes[] = 'droit-footer';
		}

		$classes[] = 'droit-template-' . $this->template;
		$classes[] = 'droit-stylesheet-' . get_stylesheet();

		return $classes;
    }

    /**
    * Name: template_frontend
    * Desc: Template load into Frontent.
    * Params: @void
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function template_frontend(){
        if ( is_singular( $this->posttype ) && ! current_user_can( 'edit_posts' ) ) {
			wp_redirect( site_url(), 301 );
			die;
		}
    }

    /**
    * Name: load_template
    * Desc: Single templates loader for single blog details page
    * Params: @template 
    * Return: @template
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function load_template( $template ){
        global $post;
       
        if ( $this->posttype == $post->post_type && defined('ELEMENTOR_PATH') ) {
			$canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';
			if ( file_exists( $canvas ) ) {
				return $canvas;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}
        return $template;
    }

    /**
    * Name: reset_unsupported
    * Desc: reset theme suport options data
    * Params: @void
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function reset_unsupported() {
		delete_user_meta( get_current_user_id(), 'unsupported-theme' );
	}
    

    /**
    * Name: setup_unsupported_theme
    * Desc: Custom theme suport for default loaded
    * Params: @void
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */

    public function setup_unsupported_theme(){
        // swithch theme support
        if ( ! current_theme_supports( 'droit-templates' ) ) {
            Supports\Defaults\Load::_instance();
        }

        //  default elementor post type support hook
        
    }

    /**
    * Name: shortcode_template
    * Desc: Shortcode for Render templates
    * Params: @atts
    * Return: @render templates
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function shortcode_template( $atts ){
        $atts = shortcode_atts(
			[
				'id' => '',
			],
			$atts,
			'dtdr-template'
		);
		$id = ! empty( $atts['id'] ) ? apply_filters( 'drdt_render_template_id', intval( $atts['id'] ) ) : '';
		if ( empty( $id ) ) {
			return '';
        }

        if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
            $css_file = new \Elementor\Core\Files\CSS\Post( $id );
            $css_file->enqueue();
		} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
            $css_file = new \Elementor\Post_CSS_File( $id );
            $css_file->enqueue();
		}
		return \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id );
    }

    public static function _instance(){
        if( is_null(self::$instance) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
}