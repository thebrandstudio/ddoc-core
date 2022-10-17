<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Video_Popup;

if (!defined('ABSPATH')) {exit;}

class Video_Popup_Module
{

    public static function get_name()
    {
        return 'droit-video_popup';
    }

    public static function get_title()
    {
        return esc_html__('Video Popup', 'droit-addons-pro');
    }

    public static function get_icon()
    {
        return 'eicon-video-playlist addons-icon';
    }

    public static function get_keywords()
    {
        return [
            'video',
            'player',
            'embed',
            'youtube',
            'vimeo',
            'dailymotion',
            'popup',
            'Popup button',
            'Popup button pro',
            'droit',
            'dl',
            'pro',
        ];
    }

    public static function get_categories()
    {
        return ['droit_addons_pro'];
    }

}
