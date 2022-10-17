<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Subscriber;

if (!defined('ABSPATH')) {exit;}

abstract class Subscriber_Control extends \Elementor\Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_subscriber_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
   
    //Preset
    public function _dl_pro_subscriber_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_subscriber_layout_section',
            [
                'label' => __('Layout', 'droit-addons-pro'),
            ]
        );

        $this->add_control(
            '_dl_pro_subscriber_skin',
            [
                'label' => esc_html__('Preset', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/subscriber/control_presets', [
                    '' => 'Default',
                ]),
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    /** subscriber content style controls function list wrapper **/
    protected function _dl_pro_subscriber_content_controls()
    {
        $this->start_controls_section(
            '_dl_pro_subs_from_content',
            [
                'label' => __( 'Genaral', 'droit-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_subs_from_wrapper_style();

        $this->end_controls_section();
    }

    protected function _dl_pro_subscriber_checkbox_style_controls()
    {
        $this->start_controls_section(
            '_dl_pro_subs_from_checkbox',
            [
                'label' => __( 'Checkbox Style', 'droit-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_subs_from_checkbox_style();

        $this->end_controls_section();
    }

    protected function _dl_pro_subscriber_btn_controls()
    {
        $this->start_controls_section(
            '_dl_pro_subs_from_btn_content',
            [
                'label' => __( 'Button Style', 'droit-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_subs_from_btn_style();

        $this->end_controls_section();
    }

    protected function _dl_pro_subscriber_input_style_controls()
    {
        $this->start_controls_section(
            '_dl_pro_subs_from_input_content',
            [
                'label' => __( 'Input Style', 'droit-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_subs_from_input_style();

        $this->end_controls_section();
    }

    

    //advance tab general Style
    public function _dl_pro_subs_from_wrapper_style()
    {
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_subs_from_content_bg_controls',
                'label' => __( 'Background', 'droit-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form',
            ]
        );
        $this->add_control(
			'_dl_pro_subs_from_margin_controls',
			[
				'label' => __( 'Margin', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'_dl_pro_subs_from_padding_controls',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_subs_from_border_controls',
                'label' => __( 'Border', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form',
            ]
        );
        $this->add_responsive_control(
			'_dl_pro_subs_from_border_radius_controls',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            '_dl_pro_subs_content_alignment',
            [
                'label' => __( 'Content Alignment', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                // 'label_block' => false,
                'default' => 'space-bwetween',
                'options' => apply_filters('dl_widgets/pro/subscriber/control_presets',[
                    'flex-start' => 'flex-start',
                    'center'=> 'center',
                    'flex-end' => 'flex-end',
                    'space-bwetween' => 'space-between',
                ]),
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'_dl_pro_subs_content_width',
			[
				'label' => __( 'Width', 'droit-addons-pro' ),
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
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form' => ' width: {{SIZE}}{{UNIT}};',
				],
			]
		);
    }

    //advance tab btn Style
    public function _dl_pro_subs_from_btn_style()
    {
        do_action('dl_widgets/button/pro/section/style/before', $this);
        $this->start_controls_tabs('_dl_pro_buttons_tabs');

        $this->start_controls_tab('_dl_pro_adv_tab_normal',
            [
                'label' => esc_html__('Normal', 'droit-addons-pro'),
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button::get_type(),
            [
                'name' => '_dl_pro_subs_from_btn_normal_controls',
                'label' => __( 'Button style', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn ',
            ]
        );
        $this->add_responsive_control(
			'por_subs_button_width',
			[
                'label' => __( 'Width', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'step' => 1,
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn' => 'width: {{VALUE}}%;',
				],
			]
		);
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => '_dl_pro_subs_from_btn_normal_controls',
                'label' => __( 'Button Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn ',
            ]
        );
            

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_adv_tab_hover',
            [
                'label' => esc_html__('Hover', 'droit-addons-pro'),
            ]
        );
        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Button_Hover::get_type(),
            [
                'name' => '_dl_pro_subs_from_btn_hover_controls',
                'label' => __( 'Button style', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn:hover',
            ]
        );
        $this->add_control(
            '_dl_pro_subs_from_btn_hover_color_controls',
            [
                'label' => __( 'Title Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

    }

    //advance tab general input Style
    public function _dl_pro_subs_from_input_style()
    {
        do_action('dl_widgets/button/pro/section/style/before', $this);
        $this->start_controls_tabs('_dl_pro_subs_form_input');

        $this->start_controls_tab('_dl_pro_search_form_normal',
            [
                'label' => esc_html__('Normal', 'droit-addons-pro'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'por_subs_input_bg_color',
                'label' => __( 'Background', 'droit-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control',
            ]
        );
        $this->add_control(
			'por_subs_input_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'por_subs_input_paceholder_color',
			[
				'label' => __( 'Paceholder Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'por_subs_input_content_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control',
			]
		);
        $this->add_responsive_control(
			'por_subs_input_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'por_subs_input_margin',
			[
				'label' => __( 'Margin', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'por_subs_input_col_width',
			[
				'label' => __( 'input Col Width', 'droit-addons-pro' ),
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
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .dl_pro_subscribe_form .dl_form_control_wrap' => ' width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'por_subs_input_col_margin',
			[
                'label' => __( 'input Col Margin', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    	'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control_wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'_por_subs_input_border_radius_controls',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
                'name' => 'pro_subs_input_border',
                'label' => __( 'Border', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control',
			]
		);
        

        $this->end_controls_tab();


        $this->start_controls_tab('_dl_pro_search_form_hover',
            [
                'label' => esc_html__('Focus', 'droit-addons-pro'),
            ]
        );

        $this->add_control(
			'por_subs_input_focus_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control:focus' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'por_subs_input_focus_paceholder_color',
			[
				'label' => __( 'Paceholder Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control:focus::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
                'name' => 'pro_subs_focus_input_border',
                'label' => __( 'Border', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control:focus',
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

    }

    //advance tab Checkbox Style
    public function _dl_pro_subs_from_checkbox_style()
    {
        do_action('dl_widgets/button/pro/section/style/before', $this);
        $this->start_controls_tabs('_dl_pro_subs_checkbox');

        $this->start_controls_tab('_dl_pro_adv_checkbox_normal',
            [
                'label' => esc_html__('Normal', 'droit-addons-pro'),
            ]
        );
        $this->add_control(
            '_por_subs_checkbox_color',
            [
                'label' => __( 'Checkbox Alignment', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/subscriber/control_presets',[
                    'left' => [
                        'title' => esc_html__('Left', 'droit-addons-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'droit-addons-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'droit-addons-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ]),
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form .dl_checkbox' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'por_subs_checkbox_content_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_checkbox',
			]
		);
        $this->add_control(
			'_por_subs_checkbox_text_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}}  .dl_pro_subscribe_form .dl_checkbox' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'_por_subs_checkbox_before_width',
			[
				'label' => __( 'Checkbox Width', 'droit-addons-pro' ),
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
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_checkbox label:before' => ' width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'por_subs_checkbox_margin',
			[
				'label' => __( 'Margin', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_checkbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'por_subs_checkbox_label_padding',
			[
				'label' => __( 'Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_checkbox label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_subs_checkbox_border_controls',
                'label' => __( 'Border', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_checkbox label:before',
            ]
        );
        $this->add_control(
			'_dl_pro_subs_checkbox_border_radius_controls',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_checkbox label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    
    
}
