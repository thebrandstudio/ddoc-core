<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Advanced_Accordion;

if (!defined('ABSPATH')) {exit;}

abstract class Advanced_Accordion_Control extends \Elementor\Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    
    public function get_pro_accordions_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }

    //Preset
    public function _dl_pro_accordions_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pro_accordions_preset_section',
            [
                'label' => __('Preset', 'droit-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_accordions_skin',
            [
                'label' => esc_html__('Design Layout', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/accordions/control_presets', [
                    '_skin_1' => 'Default',
                ]),
                'default' => '_skin_1',
            ]
        );

        $this->end_controls_section();
    }

    public function _dl_pro_accordion_style__controls()
    {
        $this->_dl_pro_accordions_content__controls();
        $this->_dl_pro_accordions_active_style__controls();
        $this->_dl_pro_accordion_title_style__controls();
        $this->_dl_pro_accordion_title_icon_controls();
        $this->_dl_pro_accordion_icon_after_controls();
        
    }
    //Accordion Content
    public function _dl_pro_accordions_content__controls()
    {
        
        do_action('dl_widgets/accordions/pro_/section/content/tab/before', $this);

        $this->start_controls_section(
            '_dl_pro_accordion_content_section_',
            [
                'label' => __('Accordion', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_pro_accordions_skin') => ['_skin_1'],
                ],
            ]
        );

        $this->_dl_pro_accordions_content_repeater__controls();

        do_action('dl_widgets/accordions/pro_/section/content/tab/inner', $this);

        $this->end_controls_section();

        do_action('dl_widgets/accordions/pro_/section/content/tab/after', $this);
    }

    //Accordion Repeater
    protected function _dl_pro_accordions_content_repeater__controls()
    {
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_pro_accordions_title_',
            [
                'label' => __('Accordion Title', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Accordion Title', 'droit-addons-pro'),
                'placeholder' => __('Enter your title', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );
        

        $repeater->add_control(
            '_dl_pro_accordions_show_as_default_',
            [
                'label' => __('Set as Default', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            '_dl_pro_accordions_after_icon',
            [
                'label' => __('After Icon', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
            ]
        );
        
        $repeater->add_control(
            '_dl_pro_accordion_selected_icon',
            [
                'label' => __( 'Icon', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => ['_dl_pro_accordions_after_icon' => 'yes'],
            ]
        );
        
        do_action('dl_widgets/accordions/pro_/content/tab/repeater_', $repeater);

        $this->add_control(
            '_dl_pro_accordions_list_',
            [
                'label' => __('Accordions', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_pro_accordions_title_' => esc_html__('Accordion Title 1', 'droit-addons-pro'),
                        '_dl_pro_accordions_description_' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'droit-addons-pro'),
                       
                    ],
                    [
                        '_dl_pro_accordions_title_' => esc_html__('Accordion Title 2', 'droit-addons-pro'),
                        '_dl_pro_accordions_description_' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'droit-addons-pro'),
                        
                    ],
                    [
                        '_dl_pro_accordions_title_' => esc_html__('Accordion Title 3', 'droit-addons-pro'),
                        '_dl_pro_accordions_description_' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'droit-addons-pro'),
                        
                    ],
                    [
                        '_dl_pro_accordions_title_' => esc_html__('Accordion Title 4', 'droit-addons-pro'),
                        '_dl_pro_accordions_description_' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'droit-addons-pro'),
                        
                    ],
                ],
                'title_field' => '{{{ _dl_pro_accordions_title_ }}}',
            ]
        );
    }



    // accordion active 
    public function _dl_pro_accordions_active_style__controls(){

         do_action('dl_widgets/accordions/pro_/section/style/title/tab/before', $this);

         $this->start_controls_section(
             '_dl_pro_accordions_style__section',
             [
                 'label' => esc_html__('Genaral', 'droit-addons-pro'),
                 'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                 'condition' => [
                     $this->get_control_id('_dl_pro_accordions_skin') => ['_skin_1'],
                 ],
             ]
         );
 
         $this->start_controls_tabs('_dl_pro_accordions_Backgrounds_tabs_');
 
         $this->start_controls_tab('_dl_pro_accordions_Backgrounds_',
             [
                 'label' => esc_html__('Normal', 'droit-addons-pro'),
             ]
         );
         $this->_dl_pro_accordions_general_style__controls();
         $this->end_controls_tab();
 
         $this->start_controls_tab('_dl_pro_accordions_active_',
             [
                 'label' => esc_html__('Active', 'droit-addons-pro'),
             ]
         );
         $this->_dl_pro_accordions_background_active();
         $this->end_controls_tab();
 
         $this->end_controls_tabs();
         $this->end_controls_section();

         do_action('dl_widgets/accordions/pro_/section/style/title/tab/after', $this);
    }

    //  accordion active 

    protected function _dl_pro_accordions_Background()
    {
        $this->add_control(
            '_dl_pro_accordions_Background_',
            [
                'label' => __('Background Color', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_accordions_item_border',
                'label' => __( 'Border', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item',
            ]
        );
            
        do_action('dl_widgets/accordions/pro_/style/title/tab/normal', $this);
    }

     protected function _dl_pro_accordions_background_active()
    {
        $this->add_control(
            '_dl_pro_accordions_active_Background_',
            [
                'label' => __('Background Color', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item.is-active' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            '_dl_pro_accordions_active_border_',
            [
                'label' => __('Border Color', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item.is-active' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        do_action('dl_widgets/accordions/pro_/style/title/tab/normal', $this);
    }


    //Accordion Title
    public function _dl_pro_accordion_title_style__controls()
    {
        do_action('dl_widgets/accordions/pro_/section/style/title/tab/before', $this);
        $this->start_controls_section(
            '_dl_pro_accordions_title_style__section',
            [
                'label' => esc_html__('Title', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('_dl_pro_accordions_skin') => ['_skin_1'],
                ],
            ]
        );

        $this->start_controls_tabs('_dl_pro_accordions_title_tabs_');

        $this->start_controls_tab('_dl_pro_accordions_title_normal_tab_',
            [
                'label' => esc_html__('Normal', 'droit-addons-pro'),
            ]
        );
        $this->_dl_pro_accordions_title_normal__controls();
        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_accordions_title_active_',
            [
                'label' => esc_html__('Active', 'droit-addons-pro'),
            ]
        );
        $this->_dl_pro_accordion_title_active__controls();
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
        do_action('dl_widgets/accordions/pro_/section/style/title/tab/after', $this);
    }

    //Accordion Title Normal
    protected function _dl_pro_accordions_title_normal__controls()
    {
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_accordions_title_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item .dl_accordion_title',
			]
		);
        $this->add_control(
            '_dl_pro_accordions_title_color_',
            [
                'label' => __('Color', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item .dl_accordion_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        do_action('dl_widgets/accordions/pro_/style/title/tab/normal', $this);
    }
    //Accordion Title Active
    protected function _dl_pro_accordion_title_active__controls()
    {

        $this->add_control(
            '_dl_pro_accordions_active_title_color_',
            [
                'label' => __('Color', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item .dl-pro-active .dl_accordion_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        do_action('dl_widgets/accordions/pro_/style/title/tab/active', $this);
    }

    // new 
    public function _dl_pro_accordion_icon_after_controls()
    {
        $this->start_controls_section(
            '_dl_pro_accordions_icon_after_style_section',
            [
                'label' => esc_html__('Icon After', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
			'style_tabs1'
		);

        $this->add_control(
			'_dl_pro_accordions_icon_after_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_accordion_icon_after' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'_dl_pro_accordions_icon_after_font_size',
			[
				'label' => __( 'Font Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_accordion_icon_after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_accordions_icon_After_Margin',
			[
				'label' => __( 'Margin Right', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_accordion_icon_after' => 'margin-right: {{size}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_tab();
        $this->end_controls_tabs();
		
		$this->end_controls_tab();
        
        $this->end_controls_section();

    }

    public function _dl_pro_accordion_title_icon_controls()
    {
        $this->start_controls_section(
            '_dl_pro_accordions_icon_style_section',
            [
                'label' => esc_html__('Icon', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'dl_pro_accordion_style_hover_tab',
			[
				'label' => __( 'Normal', 'droit-addons-pro' ),
			]
		);

		$this->add_control(
			'_dl_pro_accordions_title_icon_id',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-down',
					'library' => 'solid',
				],
			]
		);
        $this->add_control(
			'_dl_pro_accordions_active_icon_id',
			[
				'label' => __( 'Active Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-up',
					'library' => 'solid',
				],
			]
		);
        $this->add_control(
			'_dl_pro_accordions_icon_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_accordion_item_title .dl_pro_accordion_icon' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'_dl_pro_accordions_icon_font_size',
			[
				'label' => __( 'Font Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_accordion_icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_accordions_icon_height',
			[
				'label' => __( 'Height', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 200,
				'step' => 1,
                'selectors' => [
					'{{WRAPPER}} .dl_accordion_title_icon' => 'height: {{VALUE}}px',
				],
			]
		);
        $this->add_control(
			'_dl_pro_accordions_icon_width',
			[
				'label' => __( 'Width', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 200,
				'step' => 1,
                'selectors' => [
					'{{WRAPPER}} .dl_accordion_title_icon' => 'width: {{VALUE}}px',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_pro_accordions_icon_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_accordion_title_icon',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_dl_pro_accordions_icon_border',
				'label' => __( 'Border', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_accordion_title_icon',
			]
		);
        $this->add_control(
			'_dl_pro_accordions_icon_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_accordion_title_icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'dl_pro_accordion_style_active_tab',
			[
				'label' => __( 'Active', 'droit-addons-pro' ),
			]
		);
        $this->add_control(
			'_dl_pro_accordions_active_icon_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_accordion_item_title.dl-pro-active .dl_pro_accordion_icon' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_pro_accordions_active_icon_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_accordion_item_title.dl-pro-active .dl_accordion_title_icon',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_dl_pro_accordions_active_icon_border',
				'label' => __( 'Border', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_accordion_item_title.dl-pro-active .dl_accordion_title_icon',
			]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();
        
        $this->end_controls_section();

    }
    
    // General
    public function _dl_pro_accordions_general_style__controls()
    {
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_accordions_bg_',
                'label' => __('Background', 'droit-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background Color', 'droit-addons-pro'),
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '',
                    ],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_accordions_border_',
                'label' => __('Box Border', 'droit-addons-pro'),
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => 0,
                            'bottom' => 1,
                            'left' => 0,
                            'right' => 0,
                            'unit' => 'px',
                        ],
                    ],
                    'color' => [
                        'default' => '#e5e5e5',
                    ],
                ],
                'selector' => '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_accordions_box_padding_',
            [
                'label' => __('Padding', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_accordions_box_border_radius_',
            [
                'label' => __('Border Radius', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_pro_accordions_box_shadow_',
                'label' => __('Box Shadow', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item',
                'fields_options' => [
                    'box_shadow_type' => [
                        'default' => 'yes',
                    ],
                    'box_shadow' => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical' => 0,
                            'blur' => 0,
                            'spread' => 0,
                            'color' => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_accordions_box_spacing_',
            [
                'label' => __('Box Space', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_accordions_align_',
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
                    '{{WRAPPER}} .droit__pro_accordion._skin_ .dl_accordion_item' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        do_action('dl_widgets/accordions/pro_/style/general/tab/inner', $this);

    }
}
