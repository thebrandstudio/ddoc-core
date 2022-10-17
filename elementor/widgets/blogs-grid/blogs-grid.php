<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Blogs_Grid\Blogs_Grid_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Blogs_Grid\Blogs_Grid_Module as Module;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Blogs_Grid extends Control
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

    protected function register_controls() {
        $this->_dl_pro_blog_grid_preset_controls();
        $this->_dl_pro_blog_grid_registerd_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $skin = $this->get_pro_blog_grid_settings('_dl_blogs_grid_skin');
        ?>
        <?php
        if (in_array($skin, array(''), true) ) {
            include 'style/default.php';
        }
        ?>

    <?php }
    protected function get_empty_query_message($notice)
    {
        if (empty($notice)) {
            $notice = __('The current query has no posts. Please make sure you have published items matching your query.', 'droit-addons-pro');
        }
        ?>
        <div class="blog-grid-error-notice">
            <?php echo wp_kses_post($notice); ?>
        </div>
        <?php
    }
    
    protected function content_template()
    {}
}