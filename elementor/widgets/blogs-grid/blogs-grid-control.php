<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Blogs_Grid;

use \DROIT_ELEMENTOR_PRO\Module\Query\Grid_Query as Grid_Module;

if (!defined('ABSPATH')) {exit;}

abstract class Blogs_Grid_Control extends \Elementor\Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_blog_grid_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
    //Preset
    public function _dl_pro_blog_grid_preset_controls()
    {
        $this->start_controls_section(
            '_dl_blogs_grid_preset_section',
            [
                'label' => __('Preset', 'droit-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_blogs_grid_skin',
            [
                'label' => esc_html__('Design Layout', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/blog/grid/control_presets', [
                    '' => 'Default',
                ]),
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    public function _dl_pro_blog_grid_registerd_controls()
    {
        $this->_dl_pro_blog_grid_layouts_controls();
        $this->_dl_pro_blog_grid_query_controls();
        $this->_dl_pro_blog_grid_ordering_controls();
        $this->_dl_pro_blog_grid_read_more_controls();
        $this->_dl_pro_blog_grid_show_hide_controls();
        $this->_dl_pro_blog_grid_pagination_controls();
        $this->_dl_pro_bog_grid_grid_general_style_controls();
        $this->_dl_pro_blog_content_box_controls();
        $this->_dl_pro_blog_grid_title_style_controls();
        $this->_dl_pro_blog_grid_content_style_controls();
        $this->_dl_pro_blog_grid_thumbnail_style_controls();
        $this->_dl_pro_blog_grid_button_style_controls();
        $this->_dl_blogs_grid_category_style_controls();
        $this->_dl_blogs_grid_auth_style_controls();
        $this->_dl_blogs_grid_date_style_controls();
        $this->_dl_blogs_grid_time_style_controls();
        $this->_dl_blogs_grid_comments_style_controls();
    }
    // Blog Layouts
    public function _dl_pro_blog_grid_layouts_controls()
    {
        do_action('dl_widgets/pro/blog/grid/section/layout/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_layouts_section',
            [
                'label' => esc_html__('Layouts', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_content_layout',
            [
                'label' => __('Block Layouts', 'roit-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'default_layout' => [
                        'title' => __('Default', 'droit-addons-pro'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'layout_left' => [
                        'title' => __('Left', 'droit-addons-pro'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'layout_right' => [
                        'title' => __('Right', 'droit-addons-pro'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'default_layout',
                'toggle' => true,
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_title_length',
            [
                'label' => __('Title Length', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '',
                'description' => __('Keep empty for display full title', 'droit-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_title') => 'yes',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_content_type',
            [
                'label' => __('Content Type', 'droit-addons-pro'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => ['excerpt'],
                'options' => [
                    'excerpt' => __('Excerpt', 'droit-addons-pro'),
                    'content' => __('Content', 'droit-addons-pro'),
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_excerpt_length',
            [
                'label' => __('Excerpt Length', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => apply_filters('excerpt_length', 50),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_excerpt') => 'yes',
                ],

            ]
        );

        $this->add_responsive_control(
            '_dl_pro_blog_grid_per_row',
            [
                'label' => __('Posts Per Row', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_grid_columns_spacing',
            [
                'label' => __('Rows Spacing', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .blog-grid-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_blog_grid_spacing',
            [
                'label' => __('Columns Spacing', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_meta_data',
            [
                'label' => __('Meta Data', 'droit-addons-pro'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT2,
                'default' => [],
                'multiple' => true,
                'options' => [
                    'author' => __('Author', 'droit-addons-pro'),
                    'date' => __('Date', 'droit-addons-pro'),
                    'time' => __('Time', 'droit-addons-pro'),
                    'comments' => __('Comments', 'droit-addons-pro'),
                    'modified' => __('Date Modified', 'droit-addons-pro'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_auth_type',
            [
                'label' => esc_html__('Author Media Type', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-addons-pro'),
                        'icon' => 'fa fa-gear',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-addons-pro'),
                        'icon' => 'fa fa-picture-o',
                    ],
                ],
                'default' => 'icon',
                'seperator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'author',
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_auth_selected_icon',
            [
                'label' => __('Icon', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'far fa-user',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'author',
                    $this->get_control_id('_dl_pro_blog_grid_auth_type') => ['icon'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_date_type',
            [
                'label' => esc_html__('Date Media Type', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-addons-pro'),
                        'icon' => 'fa fa-gear',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-addons-pro'),
                        'icon' => 'fa fa-picture-o',
                    ],
                ],
                'default' => 'icon',
                'seperator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'date',
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_date_selected_icon',
            [
                'label' => __('Icon', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'far fa-calendar-alt',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'date',
                    $this->get_control_id('_dl_pro_blog_grid_date_type') => ['icon'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_date_image', [
                'label' => __('Image', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'show_label' => true,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'date',
                    $this->get_control_id('_dl_pro_blog_grid_date_type') => ['image'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_time_type',
            [
                'label' => esc_html__('Time Media Type', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-addons-pro'),
                        'icon' => 'fa fa-gear',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-addons-pro'),
                        'icon' => 'fa fa-picture-o',
                    ],
                ],
                'default' => 'icon',
                'seperator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_time_selected_icon',
            [
                'label' => __('Icon', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'far fa-clock',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                    $this->get_control_id('_dl_pro_blog_grid_time_type') => ['icon'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_time_image', [
                'label' => __('Image', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'show_label' => true,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                    $this->get_control_id('_dl_pro_blog_grid_time_type') => ['image'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_comments_type',
            [
                'label' => esc_html__('Comments Media Type', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'droit-addons-pro'),
                        'icon' => 'fa fa-gear',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'droit-addons-pro'),
                        'icon' => 'fa fa-picture-o',
                    ],
                ],
                'default' => 'icon',
                'seperator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_comments_selected_icon',
            [
                'label' => __('Icon', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'far fa-comment-dots',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                    $this->get_control_id('_dl_pro_blog_grid_comments_type') => ['icon'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_comments_image', [
                'label' => __('Image', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'show_label' => true,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                    $this->get_control_id('_dl_pro_blog_grid_comments_type') => ['image'],
                ],
            ]
        );
        do_action('dl_widgets/pro/blog/grid/section/layout/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/pro/blog/grid/section/layout/after', $this);
    }
    // Blog Query
    public function _dl_pro_blog_grid_query_controls()
    {
        do_action('dl_widgets/pro/blog/grid/section/query/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_query_section',
            [
                'label' => esc_html__('Query', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_filter',
            array(
                'label' => __('Source', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'post' => __('Recent Post', 'droit-addons-pro'),
                    'category' => __('Category Post', 'droit-addons-pro'),
                    'by_id' => __('Manual Selection', 'droit-addons-pro'),
                ],
                'default' => 'post',
            )
        );
        $this->add_control(
            '_dl_pro_blog_grid_manual_include',
            [
                'label' => __('Posts', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'show_label' => false,
                'label_block' => true,
                'multiple' => true,
                'options' => Grid_Module::get_posts_list(),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter') => ['by_id'],
                ],
            ]
        );
        $this->add_control('_dl_pro_blog_grid_category',
            [
                'label' => esc_html__('Select Categories', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'default' => '1',
                'options' => Grid_Module::get_categories(),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter') => ['category'],
                ],
            ]
        );
        $this->_dl_pro_blog_grid_order_orderby_controls();
        $this->add_control(
            '_dl_pro_blog_grid_ignore_sticky_posts', [
                'label' => __('Ignore Sticky Posts', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => __('Sticky-posts ordering is visible on frontend only', 'droit-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter!') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_posts_per_page', [
                'label' => esc_html__('Posts Per Page', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'droit-addons-pro'),
                'default' => 3,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter!') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_offset', [
                'label' => esc_html__('Offset', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
                'min' => '0',
                'label_block' => false,
                'description' => __('This option is used to exclude number of initial posts from being display.)', 'droit-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter!') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_query_exclude_current',
            [
                'label' => __('Exclude Current Post', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'description' => __('This option will remove the current post from the query.', 'droit-addons-pro'),
                'label_on' => __('Yes', 'droit-addons-pro'),
                'label_off' => __('No', 'droit-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter!') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            'empty_query_text',
            array(
                'label' => __('Empty Query Text', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            )
        );
        $this->end_controls_section();
        do_action('dl_widgets/pro/blog/grid/section/query/after', $this);
    }
    // Order
    protected function _dl_pro_blog_grid_order_orderby_controls()
    {
        $this->add_control(
            '_dl_pro_blog_grid_order_by',
            [
                'label' => __('Order By', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'modified' => __('Modified', 'droit-addons-pro'),
                    'date' => __('Date', 'droit-addons-pro'),
                    'rand' => __('Rand', 'droit-addons-pro'),
                    'ID' => __('ID', 'droit-addons-pro'),
                    'title' => __('Title', 'droit-addons-pro'),
                    'author' => __('Author', 'droit-addons-pro'),
                    'name' => __('Name', 'droit-addons-pro'),
                    'parent' => __('Parent', 'droit-addons-pro'),
                    'menu_order' => __('Menu Order', 'droit-addons-pro'),
                ],
                'separator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter!') => ['by_id'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_order',
            [
                'label' => __('Order', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase' => __('Ascending Order', 'droit-addons-pro'),
                    'desc' => __('Descending Order', 'droit-addons-pro'),
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter!') => ['by_id'],
                ],
            ]
        );
    }

    // Blog Order Repeater
    public function _dl_pro_blog_grid_ordering_controls() {
        $this->start_controls_section(
            '_dl_pro_blog_grid_ordering_section',
            [
                'label' => esc_html__('Content Ordering', 'droit-addons-pro'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_pro_blog_grid_order_label',
            [
                'label' => __('Label', 'droit-addons-pro'),
                'type'  => \Elementor\Controls_Manager::HIDDEN,
            ]
        );
        $repeater->add_control(
            '_dl_pro_blog_grid_order_id',
            [
                'label' => __('Id', 'droit-addons-pro'),
                'type'  => \Elementor\Controls_Manager::HIDDEN,
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_ordering_data',
            [
                'label' => __('Re-order', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'item_actions' => [
                    'duplicate' => false,
                    'add'       => false,
                    'remove'    => false,
                ],
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_pro_blog_grid_order_label' => 'Category',
                        '_dl_pro_blog_grid_order_id' => 'category',
                    ],
                    [
                        '_dl_pro_blog_grid_order_label' => 'Title',
                        '_dl_pro_blog_grid_order_id' => 'title',
                    ],
                    [
                        '_dl_pro_blog_grid_order_label' => 'Content',
                        '_dl_pro_blog_grid_order_id' => 'content',
                    ],
                    [
                        '_dl_pro_blog_grid_order_label' => 'Meta',
                        '_dl_pro_blog_grid_order_id' => 'meta',
                    ],
                    [
                        '_dl_pro_blog_grid_order_label' => 'Read More',
                        '_dl_pro_blog_grid_order_id' => 'read_more',
                    ],
                ],
                'title_field' => '<i class="eicon-editor-list-ul"></i>{{{ _dl_pro_blog_grid_order_label }}}',
            ]
        );
        $this->end_controls_section();
    }

    // Blog Pagination
    public function _dl_pro_blog_grid_pagination_controls()
    {
        do_action('dl_widgets/blog/pro/section/pagination/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_pagination_section',
            [
                'label'     => esc_html__('Pagination', 'droit-addons-pro'),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_filter!') => ['by_id'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_paging',
            [
                'label' => __('Enable Pagination', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'description' => __('Pagination is the process of dividing the posts into discrete pages', 'droit-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_pro_blog_pagination_ajax',
            [
                'label' => __('Enable Ajax', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_paging') => ['yes'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_max_pages',
            [
                'label' => __('Page Limit', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_paging') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_pagination_strings',
            [
                'label' => __('Enable Pagination Next/Prev Strings', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_paging') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_prev_text',
            [
                'label' => __('Previous Page String', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Previous', 'droit-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_paging') => ['yes'],
                    $this->get_control_id('_dl_pro_blog_pagination_strings') => ['yes'],
                ],
            ]
        );

        $this->add_control(
            '_dl_pro_blog_next_text',
            [
                'label' => __('Next Page String', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Next', 'droit-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_paging') => ['yes'],
                    $this->get_control_id('_dl_pro_blog_pagination_strings') => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_blog_pagination_align',
            [
                'label' => __('Alignment', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => __('Left', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => __('Center', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => __('Right', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-right',
                    ),
                ),
                'default' => 'right',
                'toggle' => false,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_paging') => ['yes'],
                ],
                'selectors' => array(
                    '{{WRAPPER}} .dl-grid-blog-pagination' => 'text-align: {{VALUE}}',
                ),
            ]
        );
        do_action('dl_widgets/blog/pro/section/pagination/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro/section/pagination/after', $this);
    }
    // Read More
    public function _dl_pro_blog_grid_read_more_controls()
    {
        do_action('dl_widgets/blog/pro/section/read_more/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_read_section',
            [
                'label' => esc_html__('Read More', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_read_more_text',
            [
                'label' => __('Read More Text', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Learn More »', 'droit-addons-pro'),
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_read_more') => 'yes',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_read_more_new_tab',
            [
                'label' => __('New Tab', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'after',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_read_more') => 'yes',
                    $this->get_control_id('_dl_pro_blog_grid_read_more_text!') => '',
                ],
            ]
        );
        $this->add_control(
			'_dl_pro_blog_grid_read_more_icon',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $this->add_control(
			'_dl_pro_blog_grid_read_more_icon_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);
        do_action('dl_widgets/blog/pro/section/read_more/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro/section/read_more/after', $this);
    }
    // Show Hide
    public function _dl_pro_blog_grid_show_hide_controls()
    {
        do_action('dl_widgets/blog/pro/section/options/before', $this);
        $this->start_controls_section(
            '_dl_pro_blog_option_section',
            [
                'label' => esc_html__('Show/Hide', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_show_title',
            [
                'label' => __('Title', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'droit-addons-pro'),
                'label_off' => __('Hide', 'droit-addons-pro'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_title_tag',
            [
                'label' => __('Title HTML Tag', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_title') => ['yes'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_show_excerpt',
            [
                'label' => __('Content', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => __('Hide', 'droit-addons-pro'),
                'label_on' => __('Show', 'droit-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_show_thumb',
            [
                'label' => __('Show Image', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => __('Hide', 'droit-addons-pro'),
                'label_on' => __('Show', 'droit-addons-pro'),
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_show_read_more',
            [
                'label' => __('Read More', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'droit-addons-pro'),
                'label_off' => __('Hide', 'droit-addons-pro'),
                'default' => '',
            ]
        );
        $this->add_control(
            '_dl_pro_blog_grid_show_cat',
            [
                'label' => __('Show Category', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => __('Hide', 'droit-addons-pro'),
                'label_on' => __('Show', 'droit-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_blog_grid_show_meta',
            [
                'label' => __('Meta', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'droit-addons-pro'),
                'label_off' => __('Hide', 'droit-addons-pro'),
                'default' => 'yes',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data!') => [],
                ],
            ]
        );
        do_action('dl_widgets/blog/pro/section/options/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/blog/pro/section/options/after', $this);
    }
    // General
    public function _dl_pro_bog_grid_grid_general_style_controls()
    {
        do_action('dl_widgets/pro/blog/grid/section/style/general/before', $this);
        $this->start_controls_section(
            '_dl_pro_bog_grid_general_style_section',
            [
                'label' => esc_html__('General', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_bog_grid_general_bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .blog-grid-item',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_bog_grid_general_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .blog-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_bog_grid_general_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .blog-grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_bog_grid_general_border',
                'label' => esc_html__('Border', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .blog-grid-item',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_bog_grid_general_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .blog-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_pro_bog_grid_general_box_shadow',
                'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .blog-grid-item',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_bog_grid_align',
            [
                'label' => __('Alignment', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'droit-addons-pro'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        do_action('dl_widgets/pro/blog/grid/section/style/general/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/pro/blog/grid/section/style/general/after', $this);
    }

    public function _dl_pro_blog_content_box_controls()
    {
        $this->start_controls_section(
            '_dl_pro_blog_content_box_section',
            [
                'label' => esc_html__('Blog Content Box', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_content_bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .dl_pro_blog_grid_widget .dl_single_info_box_content',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_bog_content_box_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_blog_grid_widget .dl_single_info_box_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    //Blog Title
    public function _dl_pro_blog_grid_title_style_controls()
    {
        do_action('dl_widgets/pro/blog/grid/section/style/title/before', $this);
        $this->start_controls_section(
            '_dl_blogs_grid_title_style_section',
            [
                'label' => esc_html__('Title', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_title') => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('_dl_blogs_grid_title_tabs');

        $this->start_controls_tab('_dl_blogs_grid_title_normal_tab',
            [
                'label' => esc_html__('Normal', 'droit-addons-pro'),
            ]
        );
        $this->_dl_blogs_grid_title_normal_controls();
        do_action('dl_widgets/pro/blog/grid/section/style/title/normal', $this);
        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_blogs_grid_title_hover',
            [
                'label' => esc_html__('Hover', 'droit-addons-pro'),
            ]
        );
        $this->_dl_pro_blog_title_hover_controls();
        do_action('dl_widgets/pro/blog/grid/section/style/title/hover', $this);
        $this->end_controls_tab();

        $this->end_controls_tabs();
        do_action('dl_widgets/pro/blog/grid/section/style/title/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/pro/blog/grid/section/style/title/after', $this);
    }

    //Blog Title Normal
    protected function _dl_blogs_grid_title_normal_controls()
    {
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'dl_blog_grid_title_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit-blog-grid-entry-title.dl_title',
			]
		);
        $this->add_control(
			'dl_blog_grid_title_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit-blog-grid-entry-title.dl_title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'dl_blog_grid_title_spacing',
			[
				'label' => __( 'Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .droit-blog-grid-entry-title.dl_title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
    }
    //Blog Title Hover
    protected function _dl_pro_blog_title_hover_controls()
    {
        $this->add_control(
            '_dl_pro_blogs_grid_hover_title_color',
            [
                'label' => __('Color', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .blog-grid-item:hover .droit-blog-grid-entry-title.dl_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        do_action('dl_widgets/pro/blog/grid/section/style/title/hover', $this);
    }
    //Blog Content
    public function _dl_pro_blog_grid_content_style_controls()
    {
        $this->start_controls_section(
			'dl_blog_grid_section',
			[
				'label' => __( 'Description', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'dl_blog_grid_description_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_single_info_box_content p',
			]
		);
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button::get_type(),
            [
                'name'     => 'dl_blog_item_style',
                'label'    => __('Background Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_single_info_box_content',
            ]
        );
        $this->add_control(
			'dl_blog_grid_description_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_single_info_box_content p' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'dl_blog_grid_description_spacing',
			[
				'label' => __( 'Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_info_box_content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
        do_action('dl_widgets/pro/blog/grid/section/style/content', $this);
    }

    //Blog Button
    public function _dl_pro_blog_grid_button_style_controls()
    {
        do_action('dl_widgets/pro/blog/grid/section/style/button/before', $this);
        $this->start_controls_section(
            '_dl_blogs_grid_button_style_section',
            [
                'label' => esc_html__('Button', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_read_more') => ['yes'],
                ],
            ]
        );

        $this->start_controls_tabs('_dl_blogs_grid_button_tabs');

        $this->start_controls_tab('_dl_blogs_grid_button_normal_tab',
            [
                'label' => esc_html__('Normal', 'droit-addons-pro'),
            ]
        );
        $this->_dl_blogs_grid_button_normal_controls();
        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_blogs_grid_button_hover',
            [
                'label' => esc_html__('Hover', 'droit-addons-pro'),
            ]
        );
        $this->_dl_pro_blog_grid_button_hover_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        do_action('dl_widgets/pro/blog/grid/section/style/button/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/pro/blog/grid/section/style/button/after', $this);
    }
    //Blog Button Normal
    protected function _dl_blogs_grid_button_normal_controls()
    {

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'dl_pro_blog_btn_content_typography',
                'label' => __('Typography', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .droit-blog-grid-entry-read-more',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'dl_pro_btn_content_typography' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button::get_type(),
            [
                'name' => 'dl_pro_blog_btn_style_setting',
                'label' => __('Button Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .droit-blog-grid-entry-read-more',
            ]
        );
        $this->add_control(
			'dl_pro_blog_btn_spacing',
			[
				'label' => __( 'Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .droit-blog-grid-entry-read-more' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        do_action('dl_widgets/blog/pro/section/style/button/gaping', $this);
        $this->end_popover();
        do_action('dl_widgets/blog/pro/section/style/button/bottom', $this);
    }
    //Blog Button Hover
    protected function _dl_pro_blog_grid_button_hover_controls()
    {
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button_Hover::get_type(),
            [
                'name' => '_dl_blogs_grid_button_hover_bg',
                'label' => __('Hover Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .droit-blog-grid-entry-read-more:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '__dl_blogs_grid_button_hover_bg',
                'label' => __('Background(After)', 'droit-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .droit-blog-grid-entry-read-more:hover',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'droit-addons-pro'),
                        'default' => '',
                    ],
                    'color' => [
                        'default' => '',
                    ],
                ],

            ]
        );

        do_action('dl_widgets/blog/pro/section/style/button/hover', $this);
    }
    //Blog Image
    public function _dl_pro_blog_grid_thumbnail_style_controls()
    {
        $this->start_controls_section(
            '_dl_pro_blog_grid_thumbnail_style_section',
            [
                'label' => esc_html__('Thumbnail', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_thumb') => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\DL_Image::get_type(),
            [
                'name' => '_dl_pro_blog_grid_image_setting',
                'label' => __('Image Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .dl_single_blog_img img',
                'fields_options' => [
                    'image_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_image_setting' => 'custom',
                    'image_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],

            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_grid_img_space',
            [
                'label' => __('Space', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    $this->get_control_id('_dl_blogs_grid_date_position') => ['yes'],
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_blog_grid_widget.default_layout .dl_single_blog_img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        do_action('dl_pro_acco_thumbnail_style', $this);
        $this->end_controls_section();
    }
    //Blog Category
    public function _dl_blogs_grid_category_style_controls()
    {
        do_action('dl_widgets/pro/blog/grid/section/style/category/before', $this);
        $this->start_controls_section(
            '_dl_blogs_grid_category_style_section',
            [
                'label' => esc_html__('Category', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_show_cat') => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('_dl_blogs_grid_category_tabs');

        $this->start_controls_tab('_dl_blogs_grid_category_normal_tab',
            [
                'label' => esc_html__('Normal', 'droit-addons-pro'),
            ]
        );
        $this->_dl_blogs_grid_category_normal_controls();
        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_blogs_grid_category_hover',
            [
                'label' => esc_html__('Hover', 'droit-addons-pro'),
            ]
        );
        $this->_dl_pro_blog_category_hover_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        do_action('dl_widgets/pro/blog/grid/section/style/category/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/pro/blog/grid/section/style/category/after', $this);
    }
     //Blog Category Normal
    protected function _dl_blogs_grid_category_normal_controls()
    {

        
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_blogs_grid_category_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .droit-blog-entry-category',
			]
		);
        $this->add_control(
			'_dl_blogs_grid_category_position_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .droit-blog-entry-category' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
            '_dl_blogs_grid_category_position',
            [
                'label' => __('Spacing', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'droit-addons-pro'),
                'label_on' => __('Custom', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_grid_category_horizontal',
            [
                'label' => __('Spacing', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .droit-blog-entry-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        do_action('dl_widgets/pro/blog/grid/section/style/title/normal/bottom', $this);
    }

    //Blog Category Hover
    protected function _dl_pro_blog_category_hover_controls()
    {
        $this->add_control(
            '_dl_pro_blogs_grid_hover_category_color',
            [
                'label' => __('Color', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner:hover .droit-blog-entry-category' => 'color: {{VALUE}}',
                ],
            ]
        );
        do_action('dl_widgets/pro/blog/grid/section/style/title/hover', $this);
    }
    //Blog Author
    public function _dl_blogs_grid_auth_style_controls()
    {
        $this->start_controls_section(
            '_dl_blogs_grid_author_style_section',
            [
                'label' => esc_html__('Author', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'author',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'dl_pro_blog_grid_author_name_style',
                'label' => __('Typography', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .dl-author-name',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'author',
                ],
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'dl_pro_blog_grid_author_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
            '_dl_blogs_grid_author_position',
            [
                'label' => __('Position', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'droit-addons-pro'),
                'label_on' => __('Custom', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'author',
                ],
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            '_dl_pro_blog_grid_author_horizontal',
            [
                'label' => __('Horizontal', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition' => [
                    $this->get_control_id('_dl_blogs_grid_author_position') => ['yes'],
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_grid_author_vertical',
            [
                'label' => __('Vertical', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],

                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .dl-author-name' => 'transform: translate({{SIZE}}{{UNIT}},{{_dl_pro_blog_grid_author_horizontal.SIZE}}{{_dl_pro_blog_grid_author_horizontal.UNIT}});',
                ],
            ]
        );
        $this->end_popover();
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\DL_Image::get_type(),
            [
                'name' => '_dl_pro_blog_grid_auth_setting',
                'label' => __('Image Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .dl-avater-img',
                'fields_options' => [
                    'image_setting' => [
                        'default' => 'yes',
                    ],
                    '_dl_pro_blog_grid_auth_setting' => 'custom',
                    'image_width' => [
                        'default' => [
                            'size' => '45',
                            'unit' => 'px',
                        ],
                    ],
                    'image_height' => [
                        'default' => [
                            'size' => '45',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'author',
                    $this->get_control_id('_dl_pro_blog_grid_auth_type') => 'image',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon::get_type(),
            [
                'name' => '_dl_pro_blog_grid_auth_icon_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .droit-blog-grid-auth_icon',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_auth_icon_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'author',
                    $this->get_control_id('_dl_pro_blog_grid_auth_type') => 'icon',
                    $this->get_control_id('_dl_pro_blog_grid_auth_selected_icon[library]!') => 'svg',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon_SVG::get_type(),
            [
                'name' => '_dl_pro_blog_grid_auth_svg_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .droit-blog-grid-auth_icon svg',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_svg_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_auth_svg_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'author',
                    $this->get_control_id('_dl_pro_blog_grid_auth_type') => 'icon',
                    $this->get_control_id('_dl_pro_blog_grid_auth_selected_icon[library]') => 'svg',
                ],
            ]
        );
        do_action('dl_widgets/pro/blog/grid/auth/style', $this);
        $this->end_controls_section();
    }
    //Blog Date
    public function _dl_blogs_grid_date_style_controls()
    {
        $this->start_controls_section(
            '_dl_blogs_grid_date_style_section',
            [
                'label' => esc_html__('Date', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'date',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_blogs_grid_date_typography',
				'label' => __( 'Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .droit-blog-entry-date i, .droit-blog-entry-date .dl-grid-date',
			]
		);
        $this->add_control(
			'_dl_blogs_grid_date_color',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit-blog-entry-date i, .droit-blog-entry-date .dl-grid-date' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
            '_dl_blogs_grid_date_position',
            [
                'label' => __('Position', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'droit-addons-pro'),
                'label_on' => __('Custom', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'date',
                ],
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            '_dl_pro_blog_grid_date_horizontal',
            [
                'label' => __('Horizontal', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition' => [
                    $this->get_control_id('_dl_blogs_grid_date_position') => ['yes'],
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .droit-blog-entry-date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_grid_date_vertical',
            [
                'label' => __('Vertical', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],

                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .droit-blog-entry-date' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\DL_Image::get_type(),
            [
                'name' => '_dl_pro_blog_grid_date_setting',
                'label' => __('Image Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .dl-avater-img',
                'fields_options' => [
                    'image_setting' => [
                        'default' => 'yes',
                    ],
                    '_dl_pro_blog_grid_date_setting' => 'custom',
                    'image_width' => [
                        'default' => [
                            'size' => '45',
                            'unit' => 'px',
                        ],
                    ],
                    'image_height' => [
                        'default' => [
                            'size' => '45',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'date',
                    $this->get_control_id('_dl_pro_blog_grid_date_type') => 'image',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon::get_type(),
            [
                'name' => '_dl_pro_blog_grid_date_icon_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .droit-blog-grid-date_icon',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_date_icon_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'date',
                    $this->get_control_id('_dl_pro_blog_grid_date_type') => 'icon',
                    $this->get_control_id('_dl_pro_blog_grid_date_selected_icon[library]!') => 'svg',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon_SVG::get_type(),
            [
                'name' => '_dl_pro_blog_grid_date_svg_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .droit-blog-grid-date_icon svg',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_svg_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_date_svg_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'date',
                    $this->get_control_id('_dl_pro_blog_grid_date_type') => 'icon',
                    $this->get_control_id('_dl_pro_blog_grid_date_selected_icon[library]') => 'svg',
                ],
            ]
        );
        do_action('dl_widgets/pro/blog/grid/date/style', $this);
        $this->end_controls_section();
    }
    //Blog Time
    public function _dl_blogs_grid_time_style_controls()
    {
        $this->start_controls_section(
            '_dl_blogs_grid_time_style_section',
            [
                'label' => esc_html__('Time', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'dl_pro_blog_grid_time_name_style',
                'label' => __('Typography', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .dl-grid-time',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                ],
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'dl_pro_blog_grid_time_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
            '_dl_blogs_grid_time_position',
            [
                'label' => __('Position', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'droit-addons-pro'),
                'label_on' => __('Custom', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                ],
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            '_dl_pro_blog_grid_time_horizontal',
            [
                'label' => __('Horizontal', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition' => [
                    $this->get_control_id('_dl_blogs_grid_time_position') => ['yes'],
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_grid_time_vertical',
            [
                'label' => __('Vertical', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],

                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .dl-grid-time' => 'transform: translate({{SIZE}}{{UNIT}},{{_dl_pro_blog_grid_time_horizontal.SIZE}}{{_dl_pro_blog_grid_time_horizontal.UNIT}});',
                ],
            ]
        );
        $this->end_popover();
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\DL_Image::get_type(),
            [
                'name' => '_dl_pro_blog_grid_time_setting',
                'label' => __('Image Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .dl-avater-img',
                'fields_options' => [
                    'image_setting' => [
                        'default' => 'yes',
                    ],
                    '_dl_pro_blog_grid_time_setting' => 'custom',
                    'image_width' => [
                        'default' => [
                            'size' => '45',
                            'unit' => 'px',
                        ],
                    ],
                    'image_height' => [
                        'default' => [
                            'size' => '45',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                    $this->get_control_id('_dl_pro_blog_grid_time_type') => 'image',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon::get_type(),
            [
                'name' => '_dl_pro_blog_grid_time_icon_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .droit-blog-grid-time_icon',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_time_icon_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                    $this->get_control_id('_dl_pro_blog_grid_time_type') => 'icon',
                    $this->get_control_id('_dl_pro_blog_grid_time_selected_icon[library]!') => 'svg',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon_SVG::get_type(),
            [
                'name' => '_dl_pro_blog_grid_time_svg_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .droit-blog-grid-time_icon svg',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_svg_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_time_svg_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'time',
                    $this->get_control_id('_dl_pro_blog_grid_time_type') => 'icon',
                    $this->get_control_id('_dl_pro_blog_grid_time_selected_icon[library]') => 'svg',
                ],
            ]
        );
        do_action('dl_widgets/pro/blog/grid/time/style', $this);
        $this->end_controls_section();
    }
    //Blog Comments
    public function _dl_blogs_grid_comments_style_controls()
    {
        $this->start_controls_section(
            '_dl_blogs_grid_comments_style_section',
            [
                'label' => esc_html__('Comments', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'dl_pro_blog_grid_comments_name_style',
                'label' => __('Typography', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .dl-grid-comments',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                ],
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'dl_pro_blog_grid_comments_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
            '_dl_blogs_grid_comments_position',
            [
                'label' => __('Position', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'droit-addons-pro'),
                'label_on' => __('Custom', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                ],
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            '_dl_pro_blog_grid_comments_horizontal',
            [
                'label' => __('Horizontal', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'condition' => [
                    $this->get_control_id('_dl_blogs_grid_comments_position') => ['yes'],
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_blog_grid_comments_vertical',
            [
                'label' => __('Vertical', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],

                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl__blog--grid-wrapper .dl__blog--grid-inner .dl-grid-comments' => 'transform: translate({{SIZE}}{{UNIT}},{{_dl_pro_blog_grid_comments_horizontal.SIZE}}{{_dl_pro_blog_grid_comments_horizontal.UNIT}});',
                ],
            ]
        );
        $this->end_popover();
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\DL_Image::get_type(),
            [
                'name' => '_dl_pro_blog_grid_comments_setting',
                'label' => __('Image Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .dl-avater-img',
                'fields_options' => [
                    'image_setting' => [
                        'default' => 'yes',
                    ],
                    '_dl_pro_blog_grid_comments_setting' => 'custom',
                    'image_width' => [
                        'default' => [
                            'size' => '45',
                            'unit' => 'px',
                        ],
                    ],
                    'image_height' => [
                        'default' => [
                            'size' => '45',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                    $this->get_control_id('_dl_pro_blog_grid_comments_type') => 'image',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon::get_type(),
            [
                'name' => '_dl_pro_blog_grid_comments_icon_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .droit-blog-grid-comments_icon',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_comments_icon_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                    $this->get_control_id('_dl_pro_blog_grid_comments_type') => 'icon',
                    $this->get_control_id('_dl_pro_blog_grid_comments_selected_icon[library]!') => 'svg',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon_SVG::get_type(),
            [
                'name' => '_dl_pro_blog_grid_comments_svg_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__blog-grid-meta .droit-blog-grid-comments_icon svg',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_svg_setting' => [
                        'default' => '',
                    ],
                    '_dl_pro_blog_grid_comments_svg_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_blog_grid_meta_data') => 'comments',
                    $this->get_control_id('_dl_pro_blog_grid_comments_type') => 'icon',
                    $this->get_control_id('_dl_pro_blog_grid_comments_selected_icon[library]') => 'svg',
                ],
            ]
        );
        do_action('dl_widgets/pro/blog/grid/comments/style', $this);
        $this->end_controls_section();
    }
}