<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Video_Popup;

if (!defined('ABSPATH')) {exit;}

abstract class Video_Popup_Control extends \Elementor\Widget_Base
{
    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function _dl_pro_video_popup_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }

    // Button Content
    public function _dl_pro_video_popup_content_controls()
    {
        $this->start_controls_section(
            '_dl_pro_video_popup_content_section',
            [
                'label' => __('Button Content', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->_dl_pro_video_popups_data_controls();
        $this->end_controls_section();
    }

    public function _dl_pro_popup_video_content_controls()
    {
        $this->start_controls_section(
            '_dl_pro_popup_video_content_section',
            [
                'label' => __('Video', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->_dl_pro_popup_video_controls();
        $this->end_controls_section();
    }
    // Button data
    protected function _dl_pro_video_popups_data_controls()
    {
        $this->add_control(
            '_dl_pro_video_popup_text', [
                'label' => __('Text', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Text', 'droit-addons-pro'),
                'default' => '',
                'label_block' => true,
                'description' => __('This text display in button section. NB: Keep empty for hide.', 'droit-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_video_popup_icon_type',
            [
                'label' => esc_html__('Media Type', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'droit-addons-pro'),
                        'icon' => 'fa fa-ban',
                    ],
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
            ]
        );
        $this->add_control(
            '_dl_pro_video_popup_adv_icon_reverse',
            [
                'label' => esc_html__('Position', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => '',
                'options' => [
                    '' => [
                        'title' => esc_html__('Left', 'droit-addons-pro'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'droit-addons-pro'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'top' => [
                        'title' => esc_html__('Top', 'droit-addons-pro'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'droit-addons-pro'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_text!') => '',
                    $this->get_control_id('_dl_pro_video_popup_icon_type') => ['icon', 'image'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_video_popup_selected_icon',
            [
                'label' => __('Icon', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-play-circle',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_icon_type') => ['icon'],
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_video_popup_icon_image',
            [
                'label' => esc_html__('Image', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_icon_type') => ['image'],
                ],
            ]
        );
        do_action('dl_widgets/video/popup/pro/content', $this);
    }
    // Video Data
    protected function _dl_pro_popup_video_controls()
    {
        $this->add_control(
            'video_type',
            [
                'label' => __('Source', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'seperator' => 'before',
                'default' => 'youtube',
                'options' => [
                    'youtube' => __('YouTube', 'droit-addons-pro'),
                    'vimeo' => __('Vimeo', 'droit-addons-pro'),
                ],
            ]
        );

        $this->add_control(
            'embed_url',
            [
                'label' => __('Video URL', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('https://www.youtube.com/watch?v=XHOmBV4js_E', 'droit-addons-pro'),
                'default' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
                'description' => 'Insert video url.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 1,
                'default' => 0,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 1,
                'default' => 0,
            ]
        );

        $this->add_control(
            'controls',
            [
                'label' => __('Player Controls', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 1,
                'default' => 1,
            ]
        );
    }

    //Button Style
    public function _dl_pro_video_popup_style_controls()
    {
        do_action('dl_widgets/video/popup/pro/section/style/before', $this);
        $this->start_controls_section(
            '_dl_pro_video_popups_style_section',
            [
                'label' => esc_html__('Button', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('_dl_pro_video_popups_tabs');

        $this->start_controls_tab('_dl_pro_video_popups_normal_tab',
            [
                'label' => esc_html__('Normal', 'droit-addons-pro'),
            ]
        );
        $this->_dl_pro_video_popups_normal_controls();

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_video_popups_hover',
            [
                'label' => esc_html__('Hover', 'droit-addons-pro'),
            ]
        );
        $this->_dl_pro_video_popup_hover_controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        do_action('dl_widgets/video/popup/pro/section/style/inner', $this);
        $this->end_controls_section();
        do_action('dl_widgets/video/popup/pro/section/style/after', $this);
    }
    //Button Style Normal
    protected function _dl_pro_video_popups_normal_controls()
    {
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button_Size::get_type(),
            [
                'name' => 'button_sizes',
                'label' => __('Size', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons',
                'fields_options' => [
                    'button_size' => [
                        'default' => '',
                    ],
                    'button_sizes' => 'custom',
                    'button_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                    'button_height' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'button_style',
                'label' => __('Typography', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons',
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_text!') => '',
                ],
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'button_style' => 'custom',
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
                'name' => 'button_style_bg',
                'label' => __('Button Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons',
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\DL_Image::get_type(),
            [
                'name' => 'button_image_setting',
                'label' => __('Image Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons .droit-buttons-media img',
                'fields_options' => [
                    'image_setting' => [
                        'default' => '',
                    ],
                    'button_image_setting' => 'custom',
                    'image_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_icon_type') => ['image'],
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon::get_type(),
            [
                'name' => 'button_icon_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons .droit-buttons-media i',
                'exclude' => [
                    'background', 'color', 'color_stop', 'color_b',
                    'color_b_stop', 'gradient_type', 'gradient_angle',
                    'gradient_position', 'image', 'position', 'icon_margin', 'xpos', 'ypos',
                    'attachment', 'attachment_alert', 'repeat', 'size', 'bg_width',
                ],
                'fields_options' => [
                    'icon_setting' => [
                        'default' => '',
                    ],
                    'button_icon_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_icon_type') => ['icon'],
                    $this->get_control_id('_dl_pro_video_popup_selected_icon[library]!') => 'svg',
                ],
            ]
        );

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Icon_SVG::get_type(),
            [
                'name' => 'button_icon_svg_setting',
                'label' => __('Icon Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons .droit-buttons-media svg',
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
                    'button_icon_svg_setting' => 'custom',
                    'icon_width' => [
                        'default' => [
                            'size' => '',
                            'unit' => 'px',
                        ],
                    ],
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_icon_type') => ['icon'],
                    $this->get_control_id('_dl_pro_video_popup_selected_icon[library]') => 'svg',
                ],
            ]
        );

        // do_action('dl_widgets/video/popup/pro/section/style/normal', $this);
        // $this->add_group_control(
        //     \DROIT_ELEMENTOR_PRO\Position::get_type(),
        //     [
        //         'name' => 'position',
        //         'label' => __('Position', 'droit-addons-pro'),
        //         'selector' => '{{WRAPPER}} .dl-video-wrapper-pro',
        //         'fields_options' => [
        //             'box_position_type' => [
        //                 'default' => '',
        //             ],
        //             'box_horizontal' => [
        //                 'default' => [
        //                     'size' => '0',
        //                     'unit' => 'px',
        //                 ],
        //             ],
        //             'box_vertical' => [
        //                 'default' => [
        //                     'size' => '0',
        //                     'unit' => 'px',
        //                 ],
        //             ],
        //         ],
        //     ]
        // );

        do_action('dl_widgets/video/popup/pro/section/style/normal/gaping', $this);
        $this->end_popover();
        do_action('dl_widgets/video/popup/pro/section/style/normal/bottom', $this);
    }
    //Button Style Hover
    protected function _dl_pro_video_popup_hover_controls()
    {
        $this->add_control(
            'button_hover__svg_color',
            [
                'label' => esc_html__('SVG Color', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons:hover svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_icon_type') => ['icon'],
                    $this->get_control_id('_dl_pro_video_popup_selected_icon[library]') => 'svg',
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button_Hover::get_type(),
            [
                'name' => 'button_hover_style',
                'label' => __('Hover Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons:hover',
            ]
        );
        $this->add_control(
            '_dl_pro_video_popup_adv_hover_enable',
            [
                'label' => esc_html__('Advanced Hover', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button_Hover_Advanced::get_type(),
            [
                'name' => 'button_hover_style_adv',
                'label' => __('After Setting', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons.droit-buttons---adv-hover:after',
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_adv_hover_enable') => ['yes'],
                ],
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button_Hover_Advanced_Second::get_type(),
            [
                'name' => 'button_hover_style_adv_second',
                'label' => __('After Hover', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl-video-wrapper-pro .droit-buttons.droit-buttons---adv-hover:hover:after',
                'condition' => [
                    $this->get_control_id('_dl_pro_video_popup_adv_hover_enable') => ['yes'],
                ],
            ]
        );
        do_action('dl_widgets/video/popup/pro/section/style/hover', $this);
    }
}
