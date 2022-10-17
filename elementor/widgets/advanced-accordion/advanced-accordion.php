<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Accordion\Advanced_Accordion_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Accordion\Advanced_Accordion_Module as Module;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Advanced_Accordion extends Control
{

    public function get_name()
    {
        return Module::get_name();
    }

    public function get_title()
    {
        return Module::get_title();
    }

    public function get_icon()
    {
        return Module::get_icon();
    }

    public function get_categories()
    {
        return Module::get_categories();
    }

    public function get_keywords()
    {
        return Module::get_keywords();
    }

    protected function register_controls()
    {
        $this->_dl_pro_accordions_preset_controls();
        $this->_dl_pro_accordion_style__controls();

        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Html render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $style = $this->get_pro_accordions_settings('_dl_pro_accordions_skin');
        $id = $this->get_id();
        
        extract($settings);
        
        include 'style/' . $style . '.php';
    }

    protected function content_template(){}
}