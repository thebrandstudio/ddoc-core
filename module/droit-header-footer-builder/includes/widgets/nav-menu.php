<?php
namespace Elementor;

defined( 'ABSPATH' ) || exit;

class DRDT_Nav_Menu Extends Widget_Base{

    protected $index = 1;

    public function get_name() {
		return 'drdt-navmenu';
    }

    public function get_title() {
		return __( 'Navigation Menu', 'droithead' );
    }
    
    public function get_icon() {
		return 'eicon-bullet-list';
	}

    public function get_categories() {
		return [ 'drit-header-footer' ];
    }
    
    public function get_script_depends() {
		return [];
	}

    protected function get_menu_index() {
		return $this->index++;
    }
    
   /**
    * Name: register_controls
    * Desc: Register controls for this widgets
    * Params: no params
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    protected function register_controls() {
		$this->render_content_section();
		$this->render_style_section();
	}
    
    /**
    * Name: render_content
    * Desc: Register content
    * Params: no params
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function render_content_section(){
        
        $this->start_controls_section(
			'drdt_menu_sections',
			[
				'label' => __( 'Menu', 'droithead' ),
			]
		);
        
        $menus = $this->get_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'drdt_menus',
				[
					'label'        => __( 'Select Menu', 'droithead' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					'separator'    => 'after',
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'droithead' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'drdt_menus_alert',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'droithead' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator'       => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
        }

        $this->add_control(
            'drdt_layout',
            [
                'label'   => __( 'Layout', 'droithead' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => __( 'Horizontal', 'droithead' ),
                    'vertical'   => __( 'Vertical', 'droithead' ),
                    'expandible' => __( 'Expanded', 'droithead' ),
                    'flyout'     => __( 'Flyout', 'droithead' ),
                ],
            ]
        );
        
        $this->add_control(
            'submenu_icon',
            [
                'label'        => __( 'Submenu Icon', 'droithead' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'arrow',
                'options'      => [
                    'arrow'   => __( 'Arrows', 'droithead' ),
                    'plus'    => __( 'Plus Sign', 'droithead' ),
                    'classic' => __( 'Classic', 'droithead' ),
                ],
                'prefix_class' => 'drdt-submenu-icon-',
            ]
        );


        $this->add_responsive_control(
            'menu_alignment',
            [
                'label' => __( 'Alignment', 'droithead' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'droithead' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'droithead' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'droithead' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .drdt-nav-menu__toggle' => 'justify-content: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'show_sticky_menu',
            [
                'label' => __( 'Enable Sticky Menu', 'droithead' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Enable', 'droithead' ),
                'label_off' => __( 'Disable', 'droithead' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'drdt_hamburger_menu',
            [
                'label' => __( 'Hamburger Menu', 'droithead' ),
            ]
        );

        $this->add_control(
            'hamburger_menu_icon',
            [
                'label'       => __( 'Hamburger Menu Icon', 'droithead' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => 'true',
                'default'     => [
                    'value'   => 'fas fa-align-justify',
                    'library' => 'fa-solid',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hamburger_menu_close_icon',
            [
                'label'       => __( 'Close Icon', 'droithead' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => 'true',
                'default'     => [
                    'value'   => 'far fa-window-close',
                    'library' => 'fa-regular',
                ]
            ]
        );

        $this->add_control(
            'mobile_logo',
            [
                'label' => __( 'Mobile Logo', 'droithead' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ]

            ]
        );

        $this->add_responsive_control(
            'mobile_logo_max_width',
            [
                'label' => __( 'Max Width', 'droithead' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mobile-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_section();


    }

    /**
    * Name: render_style
    * Desc: Register style content
    * Params: no params
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    public function render_style_section() {

        /**
         * Style Tab
         * Start Menu Item Style
         */
        $this->start_controls_section(
            'menu_item_style', [
                'label' => __( 'Menu Item', 'droithead' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'menu_item_typo',
                'selector' => '
                    {{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item .drdt-menu-item
                ',
            ]
        );

        //------------------------- Start Menu Item Colors --------------------------//
        $this->start_controls_tabs(
            'menu_item_color_tabs'
        );

        // Normal Colors
        $this->start_controls_tab(
            'menu_item_normal_color', [
                'label' => __( 'Normal', 'droithead' ),
            ]
        );

        $this->add_control(
            'menu_item_normal_font_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item > .drdt-menu-item' => 'color: {{VALUE}};',
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item > .drdt-has-submenu-container > .drdt-menu-item' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'menu_item_normal_background_color',
            [
                'label' => __( 'Background Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item > .drdt-menu-item' => 'background: {{VALUE}};',
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item > .drdt-has-submenu-container > .drdt-menu-item' => 'background: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'menu_normal_border',
			    'label' => __( 'Border', 'droithead' ),
			    'selector' => '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item .drdt-menu-item',
		    ]
	    );
	    $this->add_group_control(
		    Group_Control_Text_Shadow::get_type(),
		    [
			    'name' => 'menu_normal_text_shadow',
			    'label' => __( 'Text Shadow', 'droithead' ),
			    'selector' => '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item .drdt-menu-item',
		    ]
	    );
	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'menu_normal_box_shadow',
			    'label' => __( 'Box Shadow', 'droithead' ),
			    'selector' => '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item .drdt-menu-item',
		    ]
	    );
        $this->end_controls_tab(); // End Normal Colors


        // Hover Colors
        $this->start_controls_tab(
            'menu_item_hover_color',
            [
                'label' => __( 'Hover', 'droithead' ),
            ]
        );

        $this->add_control(
            'menu_item_hover_text_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item > .drdt-menu-item:hover' => 'color: {{VALUE}};',
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item > .drdt-has-submenu-container > .drdt-menu-item:hover' => 'color: {{VALUE}};',
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu > .current-menu-parent.active > .drdt-has-submenu-container > .drdt-menu-item' => 'color: {{VALUE}};',
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu > .current-menu-item .active' => 'color: {{VALUE}};',
                    '.drdt-nav-menu__layout-horizontal .drdt_navmenu li:hover > .drdt-has-submenu-container a' => 'color: {{VALUE}};',
                ],
            ]
        );
	    $this->add_control(
		    'menu_hover_background_color',
		    [
			    'label' => __( 'Background Color', 'droithead' ),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '.drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item:hover' => 'background: {{VALUE}};',
				    '.drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-has-submenu-container > .drdt-menu-item:hover' => 'background: {{VALUE}};',
			    ],
		    ]
	    );
	    $this->add_group_control(
		    Group_Control_Text_Shadow::get_type(),
		    [
			    'name' => 'menu_hover_text_shadow',
			    'label' => __( 'Text Shadow', 'droithead' ),
			    'selector' => '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .menu-item .drdt-menu-item:hover',
		    ]
	    );
	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'menu_hover_box_shadow',
			    'label' => __( 'Box Shadow', 'droithead' ),
			    'selector' => '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .menu-item .drdt-menu-item:hover',
		    ]
	    );

        $this->end_controls_tab(); // Hover Colors

        $this->end_controls_tabs(); // End Tabs

        $this->add_responsive_control(
            'menu_item_sec_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        // Margin & Padding
        $this->add_responsive_control(
            'menu_item_margin',
            [
                'label' => __( 'Item Margin', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item .drdt-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_item_padding',
            [
                'label' => __( 'Item Padding', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_section(); // End Menu Items Style


        //================================== Start Sticky Menu Options ================================//
        $this->start_controls_section(
            'sticky_menu_item_style', [
                'label' => __( 'Sticky Menu Item', 'droithead' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_sticky_menu' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'sticky_menubar_style_',
            [
                'label' => __( 'Sticky Menu Item Style', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        //============== Colors Tabs
        $this->start_controls_tabs(
            'sticky_menu_item_color_tabs'
        );

        $this->start_controls_tab(
            'sticky_menu_item_normal_color', [
                'label' => __( 'Normal', 'droithead' ),
            ]
        );

        $this->add_control(
            'sticky_menu_item_normal_font_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.drdt_sticky_fixed .drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item > .drdt-menu-item' => 'color: {{VALUE}};',
                    '.drdt_sticky_fixed .drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item > .drdt-has-submenu-container > .drdt-menu-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sticky_menu_item_normal_bg_color',
            [
                'label' => __( 'Background Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-has-submenu-container > .drdt-menu-item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sticky_menu_normal_border',
                'label' => __( 'Border', 'droithead' ),
                'selector' => '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'sticky_menu_normal_text_shadow',
                'label' => __( 'Text Shadow', 'droithead' ),
                'selector' => '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sticky_menu_normal_box_shadow',
                'label' => __( 'Box Shadow', 'droithead' ),
                'selector' => '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'sticky_menu_item_hover_color',
            [
                'label' => __( 'Hover', 'droithead' ),
            ]
        );

        $this->add_control(
            'sticky_menu_item_hover_text_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.drdt_sticky_fixed .drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item:hover > .drdt-menu-item' => 'color: {{VALUE}};',
                    '.drdt_sticky_fixed .drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item:hover > .drdt-has-submenu-container > .drdt-menu-item' => 'color: {{VALUE}};',
                    '.drdt_sticky_fixed .drdt-nav-menu__layout-horizontal .current-menu-parent.active > .drdt-has-submenu-container > .drdt-menu-item' => 'color: {{VALUE}};',
                    '.drdt_sticky_fixed .drdt-nav-menu__layout-horizontal .drdt_navmenu > .menu-item.current-menu-item > .drdt-menu-item.active' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sticky_menu_item_hover_bg_color',
            [
                'label' => __( 'Background Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item:hover' => 'background: {{VALUE}};',
                    '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-has-submenu-container > .drdt-menu-item:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sticky_menu_hover_border',
                'label' => __( 'Border', 'droithead' ),
                'selector' => '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'sticky_menu_hover_text_shadow',
                'label' => __( 'Text Shadow', 'droithead' ),
                'selector' => '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sticky_menu_hover_box_shadow',
                'label' => __( 'Box Shadow', 'droithead' ),
                'selector' => '.drdt-header .drdt_menu_fixed .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu > .menu-item > .drdt-menu-item:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs(); // End Colors Tabs

        $this->add_control(
            'sticky_menubar_style_settings',
            [
                'label' => __( 'Sticky Menubar Style', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'sticky_menu_item_icon_size',
            [
                'label' => __( 'Height', 'droithead' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '.drdt-header .drdt_menu_fixed' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sticky_menu_item_bg_color',
            [
                'label' => __( 'Background Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.drdt-header.drdt_menu_fixed' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sticky_menu_item_box_shadow',
                'label' => __( 'Box Shadow', 'droithead' ),
                'selector' => '{{WRAPPER}} .drdt-header.drdt_menu_fixed',
            ]
        );

        $this->end_controls_section(); // End Sticky Menu Options


        //=================================== Start Sub Menu Options ======================================//
        $this->start_controls_section(
            'submenu_item_style', [
                'label' => __( 'Submenu', 'droithead' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'submenu_item_style_settings',
            [
                'label' => __( 'Submenu Item Style', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'submenu_item_margin',
            [
                'label' => __( 'Margin', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .sub-menu > li .drdt-sub-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'submenu_item_padding',
            [
                'label' => __( 'Padding', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .sub-menu > li .drdt-sub-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'droithead' ),
                'selector' => '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .sub-menu > li > a',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'submenu_menu_item_typo',
                'selector' => '
                    {{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .sub-menu li a
                ',
            ]
        );

        //============== Colors Options
        $this->start_controls_tabs(
            'submenu_item_color_tabs'
        );

        $this->start_controls_tab(
            'submenu_item_normal_color', [
                'label' => __( 'Normal', 'droithead' ),
            ]
        );
        $this->add_control(
            'submenu_item_normal_font_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .menu-item .drdt-sub-menu-item' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'submenu_item_normal_background',
            [
                'label' => __( 'Background', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .menu-item .drdt-sub-menu-item' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'submenu_item_hover_color',
            [
                'label' => __( 'Hover', 'droithead' ),
            ]
        );
        $this->add_control(
            'submenu_item_hover_text_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu li:hover > .drdt-has-submenu-container a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu li .sub-menu li:hover > a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu li .sub-menu a.active' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'submenu_item_hover_background',
            [
                'label' => __( 'Background', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu li:hover > .drdt-has-submenu-container a' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu li .sub-menu li:hover > a' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu li .sub-menu a.active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs(); // End Colors Options

        //================ Section Margin / Padding
        $this->add_control(
            'submenu_background_settings',
            [
                'label' => __( 'Submenu Background', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'submenu_left_position',
            [
                'label' => __( 'Position', 'droithead' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt-has-submenu > .sub-menu' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'submenu_margin',
            [
                'label' => __( 'Submenu Margin', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt-has-submenu > .sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'submenu_padding',
            [
                'label' => __( 'Submenu Padding', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt-has-submenu > .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'submenu_border_radius',
            [
                'label' => __( 'Border Radius', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .menu-item > .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'submenu_background',
                'label' => __( 'Background', 'droithead' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .menu-item .sub-menu',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submenu_border_box_shadow',
                'label' => __( 'Box Shadow', 'droithead' ),
                'selector' => '{{WRAPPER}} .drdt-nav-menu__layout-horizontal:not(.drbt_menu_active) .drdt_navmenu .menu-item > .sub-menu',
            ]
        );

        $this->end_controls_section(); // End Sub Menu Options


        //===================================== Offcanvas Menu  ==============================//
        $this->start_controls_section(
            'offcanvas_menu_style', [
                'label' => __( 'Offcanvas Menu', 'droithead' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'hamburger_icon_size',
			[
				'label' => __( 'Hamburger Icon Size', 'droithead' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .drdt-nav-menu .elementor-clickable i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'offcanvas_menu_item_style',
            [
                'label' => __( 'Offcanvas Menu Item Style', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'offcanvas_menu_item_margin',
            [
                'label' => __( 'Margin', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active ul.drdt_navmenu > li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'offcanvas_menu_item_padding',
            [
                'label' => __( 'Padding', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active ul.drdt_navmenu > li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'offcanvas_menu_item_typo',
                'selector' => '
                    {{WRAPPER}} .drbt_menu_offcanvas_wrap .drdt_navmenu > li.menu-item > .drdt-menu-item,
                    {{WRAPPER}} .drbt_menu_offcanvas_wrap .drdt_navmenu > li.menu-item > .drdt-has-submenu-container > .drdt-menu-item
                ',
            ]
        );
        //====================== Item Style ======================
        $this->start_controls_tabs(
            'mobile_menu_icon_tabs'
        );

        $this->start_controls_tab(
            'mobile_menu_color_normal', [
                'label' => __( 'Normal', 'droithead' ),
            ]
        );
        $this->add_control(
            'mobile_menu_item_color',
            [
                'label' => __( 'Menu Item Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu .menu-item a.drdt-menu-item' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mobile_menu_item_bg',
            [
                'label' => __( 'Menu Item Background', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu .menu-item a.drdt-menu-item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mobile_menu_hamburger_icon_color',
            [
                'label' => __( 'Hamburger Icon Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu .elementor-clickable i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'mobile_menu_color_hover_tabs',
            [
                'label' => __( 'Hover', 'droithead' ),
            ]
        );
        $this->add_control(
            'mobile_menu_active_item_color',
            [
                'label' => __( 'Menu Item Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu li:hover > .drdt-has-submenu-container a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mobile_menu_active_item_bg',
            [
                'label' => __( 'Menu Item Background', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu li:hover > .drdt-has-submenu-container a' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hamburger_menu_hover_icon_color',
            [
                'label' => __( 'Hamburger Icon Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-nav-menu__toggle > .drdt-nav-menu-icon > :hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs(); // End Color Options



        //================ Offcanvas Submenu =======================================
        $this->add_control(
            'offcanvas_submenu',
            [
                'label' => __( 'Offcanvas Submenu Style', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'offcanvas_submenu_item_margin',
            [
                'label' => __( 'Margin', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu .sub-menu > li .drdt-sub-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'offcanvas_submenu_item_padding',
            [
                'label' => __( 'Padding', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu .sub-menu > li .drdt-sub-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'offcanvas_submenu_item_border',
                'label' => __( 'Border', 'droithead' ),
                'selector' => '{{WRAPPER}} .drbt_menu_active .drdt_navmenu .sub-menu > li > a',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'offcanvas_submenu_menu_item_typo',
                'selector' => '
                    {{WRAPPER}} .drbt_menu_active .drdt_navmenu .sub-menu li a
                ',
            ]
        );

        //============== Colors Options
        $this->start_controls_tabs(
            'offcanvas_submenu_item_color_tabs'
        );
        $this->start_controls_tab(
            'offcanvas_submenu_item_normal_color', [
                'label' => __( 'Normal', 'droithead' ),
            ]
        );
        $this->add_control(
            'offcanvas_submenu_item_normal_font_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu .menu-item .drdt-sub-menu-item' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'offcanvas_submenu_item_normal_background',
            [
                'label' => __( 'Background', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu .menu-item .drdt-sub-menu-item' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'offcanvas_submenu_item_hover_color',
            [
                'label' => __( 'Hover', 'droithead' ),
            ]
        );
        $this->add_control(
            'offcanvas_submenu_item_hover_text_color',
            [
                'label' => __( 'Text Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu li:hover > .drdt-has-submenu-container a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu li .sub-menu li:hover > a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu li .sub-menu a.active' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'offcanvas_submenu_item_hover_background',
            [
                'label' => __( 'Background', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu li:hover > .drdt-has-submenu-container a' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu li .sub-menu li:hover > a' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .drbt_menu_active .drdt_navmenu li .sub-menu a.active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs(); // End Colors Options


        $this->add_responsive_control(
            'offcanvas_submenu_margin',
            [
                'label' => __( 'Submenu Margin', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt-has-submenu > .sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'offcanvas_submenu_padding',
            [
                'label' => __( 'Submenu Padding', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_active .drdt-has-submenu > .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'offcanvas_submenu_background',
                'label' => __( 'Background', 'droithead' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .drbt_menu_active .drdt_navmenu .menu-item .sub-menu',
            ]
        );
        // Submenu style end ====================================================================================




        $this->add_control(
            'mobile_menu_sec_bg',
            [
                'label' => __( 'Offcanvas Menu Wrapper', 'droithead' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'mobile_menu_sec_margin',
            [
                'label' => __( 'Margin', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_offcanvas_wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'mobile_menu_sec_padding',
            [
                'label' => __( 'Padding', 'droithead' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_offcanvas_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'mobile_menu_sec_bg_color',
            [
                'label' => __( 'Background Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drbt_menu_offcanvas_wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End Responsive Device

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
    protected function render() {
        $settings         = $this->get_settings_for_display();
        extract($settings); // extract settings data

        $args = [
			'echo'        => false,
			'menu'        => $drdt_menus,
			'menu_class'  => 'drdt_navmenu',
			'menu_id'     => 'menu-' . $this->get_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
			'walker'      => new \DroitHead\Includes\Menu_Walker,
        ];

        $menu_html = wp_nav_menu( $args );

        $this->add_render_attribute(
            'drdt-main-menu',
            'class',
            [
                'drdt-nav-menu',
                'drdt-layout-' . $drdt_layout,
            ]
        );
        
        $this->add_render_attribute(
            'drdt-nav-menu',
            'class',
            [
                'drdt-nav-menu__layout-' . $drdt_layout,
                'drdt-nav-menu__submenu-' . $submenu_icon,
            ]
        );

        if( $drdt_layout === 'flyout'){
            $this->add_render_attribute( 'drdt-flyout', 'class', 'drdt-flyout-wrapper' );
            ?>
            <div class="drdt-nav-menu__toggle elementor-clickable drdt-flyout-trigger" tabindex="0">
                <div class="drdt-nav-menu-icon">
                    <?php 
                    Icons_Manager::render_icon(
                        $hamburger_menu_icon,
                        [
                            'aria-hidden' => 'true',
                            'tabindex'    => '0',
                        ]
                    );
                    ?>
                </div>
			</div>
			<div <?php echo drdt_kses_html( $this->get_render_attribute_string( 'drdt-flyout' ) ); ?> >
				<div class="drdt-flyout-overlay elementor-clickable"></div>
				<div class="drdt-flyout-container">
					<div id="drdt-flyout-content-id-<?php echo esc_attr( $this->get_id() ); ?>" class="drdt-side drdt-flyout-<?php echo esc_attr( $drdt_layout ); ?> drdt-flyout-open">
						<div class="drdt-flyout-content push">						
							<nav <?php echo drdt_kses_html( $this->get_render_attribute_string( 'drdt-nav-menu' ) ); ?>>
                            
                            <?php echo $menu_html; ?>
                                
                            </nav>
							<div class="elementor-clickable drdt-flyout-close" tabindex="0">
                                <?php 
                                Icons_Manager::render_icon(
                                    $hamburger_menu_close_icon,
                                    [
                                        'aria-hidden' => 'true',
                                        'tabindex'    => '0',
                                    ]
                                );
                                ?>
							</div>
						</div>
					</div>
				</div>
			</div>
            <?php
        } else {
           
        ?>
        <div <?php echo $this->get_render_attribute_string( 'drdt-main-menu' ); ?>>
        <div class="offcanvus_menu_overlay"></div>
            <div class="drdt-nav-menu__toggle elementor-clickable">
                <div class="drdt-nav-menu-icon">
                    <?php
                    Icons_Manager::render_icon(
                        $hamburger_menu_icon,
                        [
                            'aria-hidden' => 'true',
                            'tabindex'    => '0',
                        ]
                    );
                    ?>
                </div>
            </div>
            <nav <?php echo $this->get_render_attribute_string( 'drdt-nav-menu' ); ?>>
                <div class="drdt_mobile_menu_logo_wrapper">
                    <div class="mobile-logo"><?php if( isset($mobile_logo['url']) && !empty($mobile_logo['url']) ){?><img src="<?php echo esc_url($mobile_logo['url']);?>" alt="<?php echo esc_html('Logo', 'droithead');?>"><?php }?></div>
                  <div class="elementor-clickable drdt-flyout-close" tabindex="0">
                    <?php 
                    Icons_Manager::render_icon(
                        $hamburger_menu_close_icon,
                        [
                            'aria-hidden' => 'true',
                            'tabindex'    => '0',
                        ]
                    );
                    ?>
                </div> 
                </div>
                  
                <?php echo $menu_html; ?>
                
            </nav>              
        </div>
        <?php
        }
    }


    /**
    * Name: render_style
    * Desc: Register style content
    * Params: no params
    * Return: @void
    * Since: @1.0.0
    * Package: @droithead
    * Author: DroitThemes
    * Developer: Hazi
    */
    private function get_menus() {
		$menus = wp_get_nav_menus();
		$options = [];
		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}
		return $options;
    }
    
}