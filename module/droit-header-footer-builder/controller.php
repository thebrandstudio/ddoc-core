<?php
namespace DroitHead;
defined( 'ABSPATH' ) || exit;

final class Dtdr_Controller{

    private static $instance;

    public function __construct(){
        self::_run(); 
    }
    
    public static function version(){
        return time();
        return '1.0.0';
    }
 
    public static function php_version(){
        return '5.6';
    }

	public static function dtdr_file(){
		return  DROIT_HEAD_FILE_;
	}
  
	public static function dtdr_url(){
		return trailingslashit(plugin_dir_url( self::dtdr_file() ));
	}

	public static function dtdr_dir(){
		return trailingslashit(plugin_dir_path( self::dtdr_file() ));
    }

 
    public function load(){  
        if ( version_compare( PHP_VERSION, self::php_version(), '<' ) ) {
			add_action( 'admin_notices', function(){
                $class = 'notice notice-error';
                $message = sprintf( __( '<b>Droit Header</b> requires PHP version %1$s+, which is currently NOT RUNNING on this server.', 'droit-dark' ), '5.6' );
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message); 
            } );
			return;
        }
        
        if ( !defined( 'ELEMENTOR_VERSION' ) && !is_callable( 'Elementor\Plugin::instance' ) ) {
            add_action( 'admin_notices', [ $this, 'elementor_not_available' ] );
			add_action( 'network_admin_notices', [ $this, 'elementor_not_available' ] );
            return;
        }
    }

    public static function _run() {
		spl_autoload_register( [ __CLASS__, 'autoloading' ] );
    }

    private static function autoloading( $ld ) {
        if ( 0 !== strpos( $ld, __NAMESPACE__ ) ) {
            return;
        }
        // get map setup data
        $map = self::class_map();
        $relative_class_name = preg_replace( '/^' . __NAMESPACE__ . '\\\/', '', $ld );
        if( isset( $map[ $relative_class_name ] ) ){
            $name = $map[ $relative_class_name ];
        } else {
            $name = strtolower(preg_replace([ '/\b'.__NAMESPACE__.'\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ], [ '', '$1-$2', '-', DIRECTORY_SEPARATOR], $ld) );
            $name = str_replace('dtdr-', '', $name). '.php';    
        }
        $filename = self::dtdr_dir() . $name;
        if ( is_readable( $filename ) ) {
           require_once( $filename );
        }
    }

    // class map
    public static function class_map(){
        return [
            'Includes\Dtdr_Load' => 'includes/load.php',
        ];
    } 

    public function elementor_not_available() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			if ( ! ( current_user_can( 'activate_plugins' ) && current_user_can( 'install_plugins' ) ) ) {
				return;
			}

			$class = 'notice notice-error';
			$message = sprintf( __( 'The %1$sElementor - Header Footer and Blocks%2$s plugin requires %1$sElementor%2$s plugin installed & activated.', 'header-footer-elementor' ), '<strong>', '</strong>' );
			$plugin = 'elementor/elementor.php';

			if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
				$action_url   = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$button_label = __( 'Activate Elementor', 'header-footer-elementor' );
			} else {
				$action_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				$button_label = __( 'Install Elementor', 'header-footer-elementor' );
			}
			$button = '<p><a href="' . $action_url . '" class="button-primary">' . $button_label . '</a></p><p></p>';
			printf( '<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr( $class ), drdt_kses_html( $message ), drdt_kses_html( $button ) );
		}
	}
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
            do_action( 'droitHead/loaded' );
        }
        return self::$instance;
    }

}