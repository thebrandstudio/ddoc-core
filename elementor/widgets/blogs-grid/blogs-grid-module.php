<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Blogs_Grid;

if (!defined('ABSPATH')) {exit;}

class Blogs_Grid_Module
{

    public static function get_name()
    {
        return 'droit-blogs_grid';
    }

    public static function get_title()
    {
        return esc_html__('Post Grid', 'droit-addons-pro');
    }

    public static function get_icon()
    {
        return 'eicon-posts-grid addons-icon';
    }

    public static function get_keywords()
    {
        return [
            'blog',
            'blogs',
            'grid',
            'grid post',
            'blog grid',
            'post',
            'posts',
            'droit blog',
            'droit blogs',
            'droit posts',
            'dl blog',
            'dl blogs',
            'dl posts',
            'droit',
            'dl',
            'addons',
            'addon',
            'pro',
        ];
    }

    public static function get_categories()
    {
        return ['droit_addons_pro'];
    }

}
