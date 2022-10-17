<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Tab;

if (!defined('ABSPATH')) {exit;}

class Advanced_Tab_Module{
    
    public static function get_name() {
        return 'droit-tabs';
    }
    
    public static function get_title() {
        return esc_html__( 'Advanced Tab ttt', 'droit-addons-pro' );
    }

    public static function get_icon() {
        return 'dlicons-Tab addons-icon';
    }

    public static function get_keywords() {
        return [ 
            'tabs',
            'tabs pro',
            'toggle',
            'dl tabs',
            'dl advanced tabs',
            'tabs content',
            'addons',
            'dl',
        ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro', 'drth_custom_theme'];
    }
}