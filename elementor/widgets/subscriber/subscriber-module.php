<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Subscriber;

if (!defined('ABSPATH')) {exit;}

class Subscriber_Module{
    public static function get_name() {
        return 'droit-subscriber';
    }
    public static function get_title() {
        return esc_html__( 'Subscriber', 'droit-addons-pro' );
    }
    public static function get_icon() {
        return 'eicon-call-to-action addons-icon';
    }
    public static function get_keywords() {
       return [ 
        'subscribe',
        'dl subscribe',
        'droit subscribe',
        'droit',
        'dl',
        'dl subscribe pro'
       ];
    }
    public static function get_categories() {
        return ['droit_addons_pro', 'drth_custom_theme'];
    }
 
}