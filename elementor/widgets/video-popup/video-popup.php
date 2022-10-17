<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Widgets;

use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Video_Popup\Video_Popup_Control as Control;
use \DROIT_ELEMENTOR_PRO\Modules\Widgets\Video_Popup\Video_Popup_Module as Module;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Video_Popup extends Control
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
        $this->_dl_pro_video_popup_content_controls();
        $this->_dl_pro_popup_video_content_controls();
        $this->_dl_pro_video_popup_style_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    //Html render
    protected function render()
    {

        $settings = $this->get_settings_for_display();
        extract($settings);

        $id_int = substr($this->get_id_int(), 0, 4);
        $this->add_render_attribute(
            '_dl_pro_video_popup_wrapper',
            [
                'id' => "button-{$id_int}",
                'class' => ['dl-video-wrapper-pro', 'video_popup_area', 'dl-button-wrapper'],
            ]
        );

        $this->add_render_attribute('button', 'class', 'droit-buttons droit-video-popup');
        if ('yes' === $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_adv_hover_enable')) {
            $this->add_render_attribute('button', 'class', 'droit-buttons---adv-hover');
        }
        if (!empty($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_adv_icon_reverse'))) {
            $this->add_render_attribute('button', 'class', 'reverse-' . $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_adv_icon_reverse'));
        }

        if (!empty($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type')) && 'none' != $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type')) {
            $migrated = isset($this->_dl_pro_video_popup_settings('__fa4_migrated')['_dl_pro_video_popup_selected_icon']);

            if (!empty($this->_dl_pro_video_popup_settings('icon')) && !\Elementor\Icons_Manager::is_migration_allowed()) {

                $settings['icon'] = 'fas fa-play-circle';
            }

            $is_new = empty($this->_dl_pro_video_popup_settings('icon')) && \Elementor\Icons_Manager::is_migration_allowed();
            $has_icon = (!$is_new || !empty($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_selected_icon')['value']));
        }
        $embed_url = $this->_dl_pro_video_popup_settings('embed_url');
        $url_string = parse_url($embed_url, PHP_URL_QUERY);
        parse_str($url_string, $args);
        $video_id =  isset($args['v']) ? $args['v'] : false;

        $urlParams = [];

        if ($autoplay) {
            $urlParams['autoplay'] = 1;
            $urlParams['mute'] = 1;
        }

        if ($loop) {
            $urlParams['loop'] = 1;
            $urlParams['playlist'] = $video_id;
        }

        if ($controls) {
            $urlParams['controls'] = 1;
        }else{
            $urlParams['controls'] = 0;
        }
        
        $urlParams['version'] = 3;
        
        if ($this->_dl_pro_video_popup_settings('video_type') == 'youtube') {
            $dl_video_popup_url = 'https://www.youtube.com/watch?v=' . $video_id . '?' . http_build_query($urlParams);
        } else {
            $dl_video_popup_url = $embed_url . '?' . http_build_query($urlParams);
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('_dl_pro_video_popup_wrapper'); ?>>
            <a href="<?php echo esc_url($dl_video_popup_url); ?>" <?php echo $this->get_render_attribute_string('button'); ?>>
            <?php
            if ($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type') != 'none') {
                if ($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type') == 'icon') {
                    if ($is_new || $migrated) {?>
                        <span class="droit-buttons-media droit-buttons_icon" aria-hidden="true">
                            <?php \Elementor\Icons_Manager::render_icon($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_selected_icon'));?>
                        </span>
                    <?php }
                } elseif ($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_type') == 'image' && !empty($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_image')['url'])) {
                    ?>
                        <span class="droit-buttons-media droit-buttons_image" aria-hidden="true">
                            <img src="<?php echo esc_url($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_icon_image')['url']); ?>" alt="Button Icon">
                        </span>
                    <?php }
                }

            ?>
            <?php if (!empty($this->_dl_pro_video_popup_settings('_dl_pro_video_popup_text'))): ?>
                <span class="dl-button-text">
                    <?php echo $this->_dl_pro_video_popup_settings('_dl_pro_video_popup_text') ?>
                </span>
            <?php endif?>
            </a>
            </div>
            <?php
}
    protected function content_template()
    {}
}