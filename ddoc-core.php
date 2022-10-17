<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 */
/*
Plugin Name: Ddoc Core
Plugin URI: https://droitthemes.com/droit-elementor-addons/
Description: Droit Elementor Addons is a bundle of super useful widgets. This Elementor compatible plugin is easy to use and you can customize different features as you like. Just plug and play.
Version: 1.0.3
Author: DroitThemes
Author URI: https://droitthemes.com/
License: GPLv3
Text Domain: ddoc-core
Domain Path: /languages
 */

// If this file is called firectly, abort!!!
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

/**
 * Constant
 * Feature added by : DroitLab Team
 * @since 1.0.0
 */

define('DRO_TH_ESS', __FILE__);
define('DRO_TH_ESS_CSS_RENDER', true);

include __DIR__ . '/function.php';
include __DIR__ . '/plugin.php';

// load plugin
add_action( 'plugins_loaded', function(){
    // load text domain
    load_plugin_textdomain( 'ddoc-core', false, basename( dirname( __FILE__ ) ) . '/languages'  );
    
    // load plugin instance
    \TH_ESSENTIAL\DRTH_Plugin::instance()->load();
    
}, 999); 

//  Load header fotoer builder
require_once __DIR__.'/module/droit-header-footer-builder/droit-header-footer.php';
require_once __DIR__.'/gutenbarg-block/gutenbarg-block.php';

require_once __DIR__.'/wp-widgets/widgets.php';