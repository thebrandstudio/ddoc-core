<?php

namespace Elementor;

defined('ABSPATH') || exit;

class DRDT_Back_To_Top extends Widget_Base {

    protected $index = 1;

    public function get_name() {
        return 'drdt_back_to_top';
    }

    public function get_title() {
        return __('Back to Top', 'droithead');
    }

    public function get_icon() {
        return 'eicon-arrow-up';
    }

    public function get_categories() {
        return ['drit-header-footer'];
    }

    public function get_script_depends() {
        return [];
    }


    protected function register_controls()
    {
        $this->render_content_section();
        $this->render_style_section();
    }

    public function render_content_section() {

        $this->start_controls_section(
            'drdt_searchbar_sections',
            [
                'label' => __('Icon', 'droithead'),
            ]
        );

        $this->add_control(
            'drdt_icomoon_icon',
            [
                'label' => __( 'Icon', 'droithead' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'fa4compatibility' => 'icon',
            ]
        );

        $this->add_control(
            'drdt_icon_attributes',
            [
                'label' => __( 'Icon Attributes', 'rave-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Back to Top',
            ]
        );

        $this->end_controls_section();


    }


    public function render_style_section() {
        $this->start_controls_section(
            'drdt_style_btn_color',
            [
                'label' => __( 'Button Style', 'droithead' ),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );
        $this->add_control(
            'drdt_b2t_btn_style',
            [
                'label' => __( 'Button Normal & Hover Style', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs( 'drdt_icon_colors' );
        $this->start_controls_tab(
            'drdt_btn_color_normal',
            [
                'label' => __( 'Normal', 'droithead' ),
            ]
        );

        $this->add_control(
            'drdt_normal_icon_color',
            [
                'label' => __( 'Icon Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'drdt_normal_icon_bg_color',
            [
                'label' => __( 'Background Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'drdt_b2t_btn_box_shadow',
                'label' => __( 'Box Shadow', 'droithead' ),
                'selector' => '{{WRAPPER}} #drdt_back_to_top',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'drdt_border_group',
                'label' => __( 'Border', 'droithead' ),
                'selector' => '{{WRAPPER}} #drdt_back_to_top',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'drdt_btn_color_hover',
            [
                'label' => __( 'Hover', 'droithead' ),
            ]
        );

        $this->add_control(
            'drdt_hover_icon_color',
            [
                'label' => __( 'Icon Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'drdt_hover_icon_bg_color',
            [
                'label' => __( 'Background Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top:hover:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'drdt_hover_icon_border_color',
            [
                'label' => __( 'Background Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top:hover:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'drdt_b2t_btn_hover_box_shadow',
                'label' => __( 'Box Shadow', 'droithead' ),
                'selector' => '{{WRAPPER}} #drdt_back_to_top:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'drdt_b2t_btn_hover_border',
                'label' => __( 'Border', 'droithead' ),
                'selector' => '{{WRAPPER}} #drdt_back_to_top:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'drdt_b2t_btn_additional_style',
            [
                'label' => __( 'Additional Options', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'drdt_border_radius',
            [
                'label' => __( 'Border Radius', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'drdt_b2t_icon_size',
            [
                'label' => __( 'Icon Size', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'drdt_b2t_btn_height',
            [
                'label' => __( 'Height', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'drdt_width',
            [
                'label' => __( 'Width', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        // Back to Top Position
        $this->start_controls_section(
            'drdt_back_to_top_position',
            [
                'label' => __( 'Back to Top Icon Position', 'droithead' ),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'drdt_right',
            [
                'label' => __( 'Right', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'drdt_bottom',
            [
                'label' => __( 'Bottom', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} #drdt_back_to_top' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }


    /**
     * Name: render
     * Desc: Widgets Render
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @droithead
     * Author: DroitThemes
     * Developer: Hazi
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        extract($settings); // extract settings data
        
        ?>
        <div id="drdt_back_to_top" title="<?php echo esc_attr($drdt_icon_attributes) ?>">
            <i class="<?php echo esc_attr($drdt_icomoon_icon['value']) ?>"></i>
        </div>
        <?php

    }
}