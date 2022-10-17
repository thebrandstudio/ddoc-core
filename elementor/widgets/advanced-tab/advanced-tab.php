<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Tab\Advanced_Tab_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Tab\Advanced_Tab_Module as Module;


if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Advanced_Tab extends Control
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
        $this->_dl_pro_tabs_preset_controls();
        $this->_dl_pro_tabs_content__controls();
        $this->_dl_pro_adv_tab_style_controls();
        $this->_dl_pro_adv_tab_controls();

        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Html render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $style = $this->get_pro_tabs_settings('_dl_pro_tabs_skin');
        $id = $this->get_id();

        include 'style/' . $style . '.php';
    }

    protected function content_template()
    {}
}