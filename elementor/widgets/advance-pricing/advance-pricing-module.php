<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Advance_Pricing;

if (!defined('ABSPATH')) {exit;}

class Advance_Pricing_Module{
    
    public static function get_name() {
        return 'droit-advance_pricing';
    }
    
    public static function get_title() {
        return esc_html__( 'Pricing With Switch', 'droit-addons-pro' );
    }

    public static function get_icon() {
        return 'dlicons-pricing-Table addons-icon';
    }

    public static function get_keywords() {
        return [
            'price',
            'pricing',
            'table',
            'product',
            'plan',
            'button',
            'droit-pricing',
            'droit-table',
            'droit-product',
            'droit-plan',
            'droit-button',
            'dl-pricing',
            'dl-table',
            'dl-product',
            'dl-plan',
            'dl-button',
            'droit',
            'dl',
            'addons',
            'addon'
        ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro', 'drth_custom_theme'];
    }
 
}