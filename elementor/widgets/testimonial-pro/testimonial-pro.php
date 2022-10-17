<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Testimonial_Pro extends \Elementor\Widget_Base{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_testimonials_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }

    public function get_name()
    {
        return 'dladdons-testimonial-pro';
    }

    public function get_title()
    {
        return esc_html__( 'Testmonial Pro', 'droit-addons-pro' );
    }

    public function get_icon()
    {
        return ' eicon-testimonial-carousel addons-icon';
    }

    public function get_categories()
    {
        return ['droit_addons_pro'];
    }

    public function get_keywords()
    {
        return [ 'testimonial','testimonial pro','dl testimonial slider'];
    }

    protected function register_controls()
    {
        do_action('dl_widgets/testimonial/register_control/start', $this);

        // add content 
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
        do_action('dl_widgets/testimonial/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_dl_testimonial_Content_section',
            [
                'label' => __('Content', 'droit-addons-pro'),
            ]
        );

        $this->content_repeater_controls();

        $this->end_controls_section();
        //start subscribe layout end

        $this->slider_option_controls();
        $this->rating_controls();
        $this->icon_controls();
        $this->ordering_controls();

    }

    // Testimonial Repeater
    protected function content_repeater_controls()
    {
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'droit_rating',
			[
				'label' => __( 'Rating', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
				'default' => 5,
				'dynamic' => [
					'active' => true,
				],
			]
		);
        $repeater->add_control(
			'_dl_testimonial_author',
			[
				'label' => __( 'Author Logo', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $repeater->add_control(
			'droit_rating_title',
			[
				'label' => __( 'Title', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				],
			]
		);
        $repeater->add_control(
            '_dl_pro_testimonial_name', [
                'label' => __('Name', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Name', 'droit-addons-pro'),
                'default' => __('Enter Name', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_pro_testimonial_designation', [
                'label' => __('Designation', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Designation', 'droit-addons-pro'),
                'default' => __('Enter Designation', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_pro_testimonial_text', [
                'label' => __('Content', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter Content', 'droit-addons-pro'),
                'default' => __('Enter Content', 'droit-addons-pro'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            '_dl_pro_testimonial_image', [
                'label' => __('Client Image', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'show_label' => false,
            ]
        );
        do_action('dl_pro_testimonial', $repeater);
        $this->add_control(
            '_dl_pro_testimonial_list',
            [
                'label' => __('Testimonial', 'droit-addons-pro'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_pro_testimonial_name' => __('Droitthemes', 'droit-addons-pro'),
                        '_dl_pro_testimonial_designation' => __('CTO, Droitthemes', 'droit-addons-pro'),
                        '_dl_pro_testimonial_text' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'droit-addons-pro'),
                        '_dl_pro_testimonial_image' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        '_dl_pro_testimonial_name' => __('Droitthemes', 'droit-addons-pro'),
                        '_dl_pro_testimonial_designation' => __('CTO, Droitthemes', 'droit-addons-pro'),
                        '_dl_pro_testimonial_text' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'droit-addons-pro'),
                        '_dl_pro_testimonial_image' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        '_dl_pro_testimonial_name' => __('Droitthemes', 'droit-addons-pro'),
                        '_dl_pro_testimonial_designation' => __('CTO, Droitthemes', 'droit-addons-pro'),
                        '_dl_pro_testimonial_text' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'droit-addons-pro'),
                        '_dl_pro_testimonial_image' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        '_dl_pro_testimonial_name' => __('Droitthemes', 'droit-addons-pro'),
                        '_dl_pro_testimonial_designation' => __('CTO, Droitthemes', 'droit-addons-pro'),
                        '_dl_pro_testimonial_text' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'droit-addons-pro'),
                        '_dl_pro_testimonial_image' => \Elementor\Utils::get_placeholder_image_src(),
                    ],

                ],
                'title_field' => '{{{ _dl_pro_testimonial_name }}}',
            ]
        );
    }

    // Slider Option
    public function slider_option_controls()
    {
        $this->start_controls_section(
            '_dl_pro_testimonial_options_section',
            [
                'label' => esc_html__('Settings', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'dl_testimonial_perpage',
            [
                'label' => __( 'Perpage', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control(
            'dl_testimonial_speed',
            [
                'label' => __( 'Speed', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'min' => 1,
                'max' => 1000000,
                'step' => 100,
                'default' => 1000,
            ]
        );
        
        $this->add_control(
            'dl_testimonial_autoplay',
            [
                'label' => __('Autoplay', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'dl_testimonial_auto_delay',
            [
                'label' => __( 'Delay [autoplay]', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000,
                'step' => 1,
                'default' => 500,
                'condition' => [ 'dl_testimonial_autoplay' => 'true']
            ]
        );
        $this->add_control(
            'dl_testimonial_direction',
            [
                'label' => __('Enable Vertical', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'dl_testimonial_loop',
            [
                'label' => __('Enable Loop', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        
        $this->add_control(
            'dl_testimonial_centered',
            [
                'label' => __('Centered', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_testimonial_pagination',
            [
                'label' => __('Enable Pagination', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_testimonial_pagination_type',
            [
                'label' => __( 'Pagi Type', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'bullets' => 'Bullets',
                    'fraction' => 'Fraction',
                    'progressbar' => 'Progressbar',
                ],
                'default' => 'bullets',
                'condition' => [ 'dl_testimonial_pagination' => 'yes']
            ]
        );

        $this->add_control(
            'dl_testimonial_space',
            [
                'label' => __( 'Space Between', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $this->add_control(
            'dl_testimonial_effect',
            [
                'label' => __( 'Effect', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'slide' => 'Slide',
                    'fade' => 'Fade',
                    'cube' => 'Cube',
                    'coverflow' => 'Coverflow',
                    'flip' => 'Flip',
                ],
                'default' => 'slide',
            ]
        );

        $this->add_control(
            'dl_testimonial_enable_slide_control',
            [
                'label' => __('Enable Slide Control', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_testimonial_nav_left_icon',
            [
                'label' => __( 'Left Icon', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'solid',
                ],
                'condition' => [ 'dl_testimonial_enable_slide_control' => 'yes']
            ]
        );

        $this->add_control(
            'dl_testimonial_nav_right_icon',
            [
                'label' => __( 'Right Icon', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],
                'condition' => [ 'dl_testimonial_enable_slide_control' => 'yes']
            ]
        );
        
        $this->add_control(
            'dl_breakpoints_enable',
            [
                'label' => esc_html__('Responsive', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'label_off',
                'separator' => 'before'
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'dl_breakpoints_width',
            [
                'label' => __('Max Width', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 3000,
                'step' => 1,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_perpage',
            [
                'label' => __('Slides Per View', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_space',
            [
                'label' => __('Space Between', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_center',
            [
                'label' => esc_html__('Center', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'dl_breakpoints_slide_control',
            [
                'label' => __('Disabled Slide Control', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
		$repeater->add_control(
            'dl_breakpoints_pagination',
            [
                'label' => __('Disabled Pagination', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        do_action('dl_widgets/adslider/settings/repeater', $repeater);
        
        $this->add_control(
            'dl_breakpoints',
            [
                'label' => __('Content', 'droit-addons-pro'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'dl_breakpoints_width' => 1440,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 1024,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 768,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 576,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],

                ],
                'title_field' => 'Max Width: {{{ dl_breakpoints_width }}}',
                'condition' => [
                    'dl_breakpoints_enable' => ['yes'],
                ],
            ]
        );


        $this->add_control(
            'dl_testimonial_mouseover',
            [
                'label' => __( 'MouseOver Settings', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'dl_testimonial_mouseover_enable',
            [
                'label' => esc_html__('Enable', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'droit-addons-pro'),
                'label_off' => esc_html__('No', 'droit-addons-pro'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
    }

    // Testimonial Repeater
    protected function rating_controls()
    {
        $this->start_controls_section(
			'droit_section_rating',
			[
				'label' => __( 'Rating', 'droit-addons-pro' ),
			]
		);

        $this->add_control(
			'testimonial_ratting_icon',
			[
				'label' => __( 'Show Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        

		$this->add_control(
			'droit_rating_scale',
			[
				'label' => __( 'Rating Scale', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'5' => '0-5',
					'10' => '0-10',
				],
				'default' => '5',
                'condition' => [
                    $this->get_control_id('testimonial_ratting_icon') => ['yes'],
                ],
			]
		);

		$this->add_control(
			'droit_star_style',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'star_fontawesome' => 'Font Awesome',
					'star_unicode' => 'Unicode',
				],
				'default' => 'star_fontawesome',
				'render_type' => 'template',
				'prefix_class' => 'elementor--star-style-',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'droit_unmarked_star_style',
			[
				'label' => __( 'Unmarked Style', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Solid', 'droit-addons-pro' ),
						'icon' => 'eicon-star',
					],
					'outline' => [
						'title' => __( 'Outline', 'droit-addons-pro' ),
						'icon' => 'eicon-star-o',
					],
				],
				'default' => 'solid',
			]
		);

		$this->end_controls_section();
    }

    // Testimonial Icon
    protected function icon_controls()
    {
        $this->start_controls_section(
			'droit_section_icon',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
			]
		);
        $this->add_control(
			'droit_section_testimonial_icon',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

        $this->end_controls_section();
    }

    // Ordering Repeater
    public function ordering_controls(){
        $this->start_controls_section(
            '_dl_testimonial_repeater_order_section',
            [
                'label' => esc_html__('Content Ordering', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            '_dl_testimonial_order_enable',
            [
                'label' => __('Enable', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            '_dl_testimonial_order_label',
            [
                'label' => __('Label', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );
        $repeater->add_control(
            '_dl_testimonial_order_id',
            [
                'label' => __('Id', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );
        
        $this->add_control(
            '_dl_testimonial_ordering_data',
            [
                'label' => __('Re-order', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'item_actions' =>[
                    'duplicate' => false,
                    'add' => false,
                    'remove' => false
                ],
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_testimonial_order_enable' => 'yes',
                        '_dl_testimonial_order_label' => 'Rating',
                        '_dl_testimonial_order_id' => 'testimonial_rating',
                    ],
                    [
                        '_dl_testimonial_order_enable' => 'yes',
                        '_dl_testimonial_order_label' => 'Testimonial Icon',
                        '_dl_testimonial_order_id' => 'dl_testimonial_icon',
                    ],
                    [
                        '_dl_testimonial_order_enable' => 'no',
                        '_dl_testimonial_order_label' => 'ClientsLogo',
                        '_dl_testimonial_order_id' => 'dl_author_logo',
                    ],
                    [
                        '_dl_testimonial_order_enable' => 'yes',
                        '_dl_testimonial_order_label' => 'Content',
                        '_dl_testimonial_order_id' => 'testimonial_description',
                    ],
                    [
                        '_dl_testimonial_order_enable' => 'yes',
                        '_dl_testimonial_order_label' => 'Client Info',
                        '_dl_testimonial_order_id' => 'testimonial_client_info',
                    ],
                ],
                'title_field' => '<i class="eicon-editor-list-ul"></i>{{{ _dl_testimonial_order_label }}}',
            ]
        );
        $this->end_controls_section();
    }
    
    public function _styles_control(){
        $this->general_style_controls();
        $this->content_style_controls();
        $this->client_info_controls();
        $this->rating_info_controls();
        $this->icon_style_controls();
        $this->navigation_style_controls();
    }
    public function general_style_controls()
    {
        $this->start_controls_section(
            '_dl_pro_testimonials_general_style_section',
            [
                'label' => _x('General', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_testimonials_bg',
                'label' => __('Background', 'droit-addons-pro'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper',
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
        
        $this->add_responsive_control(
            '_dl_pro_testimonials_box_padding',
            [
                'label' => __('Padding', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => '40',
                    'right' => '40',
                    'bottom' => '40',
                    'left' => '40',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_testimonials_border',
                'label' => __('Box Border', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper',
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_testimonials_box_border_radius',
            [
                'label' => __('Border Radius', 'droit-addons-pro'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_pro_testimonials_box_shadow',
                'label' => __('Box Shadow', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper',
            ]
        );

        $this->add_responsive_control(
            '_dl_pro_testimonials_align',
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
                    '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        do_action('dl_pro_testimonial_general', $this);
        $this->end_controls_section();
    }
    public function content_style_controls()
    {

        $this->start_controls_section(
            '_dl_pro_testimonial__content_style_section',
            [
                'label' => _x('Content', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_testimonial_content_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_text',
			]
		);

        $this->add_control(
			'_dl_pro_testimonial_content_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_text' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
            'dl_pro_testimonial_slider_wrapper_spacing',
            [
                'label' => __( 'Padding', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        do_action('dl_pro_testimonial_content', $this);
        $this->end_controls_section();
    }

    public function client_info_controls()
    {

        $this->start_controls_section(
            '_dl_pro_testimonial_client_info_section',
            [
                'label' => _x('Client Info', 'droit-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'testimonial_client_spacing',
			[
				'label' => __( 'Spacing', 'droit-addons-pro' ),
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
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_client_info_inner ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_testimonial_image_separator',
			[
				'label' => __( 'Images', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'separator' => 'before',
			]
		);
        $this->add_control(
			'_dl_pro_testimonial_image_size',
			[
				'label' => __( 'Image Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_client_info_inner .dl-testimonial-reviewer img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_pro_testimonial_image_position',
			[
				'label' => __( 'Image Position', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-addons-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Center', 'droit-addons-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'droit-addons-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);
        $this->add_control(
			'_dl_pro_testimonial_image_bottom_spacng',
			[
				'label' => __( 'Image Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_client_info_inner .dl-testimonial-reviewer' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_testimonial_image_position') => ['top'],
                ],
			]
		);
        $this->add_control(
			'_dl_pro_testimonial_image_left_spacng',
			[
				'label' => __( 'Image Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_client_info_inner .dl-testimonial-reviewer' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_testimonial_image_position') => ['left'],
                ],
			]
		);
        $this->add_control(
			'_dl_pro_testimonial_image_right_spacng',
			[
				'label' => __( 'Image Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_client_info_inner .dl-testimonial-reviewer' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_testimonial_image_position') => ['right'],
                ],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_dl_pro_testimonial_image_border',
				'selector' => '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_client_info_inner .dl-testimonial-reviewer img',
			]
		);
		$this->add_control(
			'_dl_pro_testimonial_image_border_radius',
			[
				'label' => __( 'Border Radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_client_info_inner .dl-testimonial-reviewer img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'_dl_pro_testimonial_mane_separator',
			[
				'label' => __( 'Name', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_testimonial_mane_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_name',
			]
		);
        $this->add_control(
			'_dl_pro_testimonial_name_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_name' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'dl_pro_testimonial_slider_name_spacing',
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
					'size' => 7,
				],
				'selectors' => [
                    '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_name' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
			]
		);

        $this->add_control(
			'_dl_pro_testimonial_position_separator',
			[
				'label' => __( 'Position', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_dl_pro_testimonial_position_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_position',
			]
		);
        $this->add_control(
			'_dl_pro_testimonial_position_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_position' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'dl_pro_testimonial_slider_position_spacing',
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
					'size' => 0,
				],
				'selectors' => [
                    '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .dl_position' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
			]
		);

        do_action('dl_pro_testimonial_client_info', $this);
        $this->end_controls_section();
    }

    public function rating_info_controls()
    {
        $this->start_controls_section(
			'section_stars_style',
			[
				'label' => __( 'Stars', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'testimonial_rating_spacing',
			[
				'label' => __( 'Spacing', 'droit-addons-pro' ),
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
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .droit-star-rating__wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_testimonial_rating_title',
			[
				'label' => __( 'Title', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_rating_title',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .droit-star-rating__title',
			]
		);
        $this->add_control(
			'testimonial_rating_title_color',
			[
				'label' => __( 'Title Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .droit-star-rating__title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'testimonial_rating_title_spacing',
			[
				'label' => __( 'Spacing', 'droit-addons-pro' ),
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
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_slider_wrapper .droit-star-rating__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'_dl_testimonial_rating_icon',
			[
                'label' => __( 'Icon', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .droit-star-rating i:not(:last-of-type)' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .droit-star-rating i:not(:last-of-type)' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'stars_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit-star-rating i:before' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'stars_unmarked_color',
			[
				'label' => __( 'Unmarked Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .droit-star-rating i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
    }

    public function icon_style_controls()
    {
        $this->start_controls_section(
			'testimonial_icon_style',
			[
				'label' => __( 'Icon', 'droit-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'testimonial_icon_font_size',
			[
				'label' => __( 'Size', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_icon i, .dl_pro_testimonial_icon span, .dl_pro_testimonial_icon svg' => 'width: {{SIZE}}{{UNIT}};font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'testimonial_icon_font_color',
			[
				'label' => __( 'Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_icon i, .dl_pro_testimonial_icon span' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'testimonial_icon_position',
			[
				'label' => __( 'Icon Position', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal'  => __( 'Normal', 'droit-addons-pro' ),
					'fixed' => __( 'Fixed', 'droit-addons-pro' ),
				],
			]
		);
        $this->add_responsive_control(
			'testimonial_icon_spacing',
			[
				'label' => __( 'Space', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
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
					'{{WRAPPER}} .dl_pro_testimonial_icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'testimonial_icon_position' => ['normal'],
                ],
			]
		);
        $this->add_responsive_control(
			'testimonial_fixed_left_icon_spacing',
			[
				'label' => __( 'Left', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_testimonial_icon' => 'right: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'testimonial_icon_position' => ['fixed'],
                ],
			]
		);
        $this->add_responsive_control(
			'testimonial_fixed_top_icon_spacing',
			[
				'label' => __( 'Top', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
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
					'{{WRAPPER}} .dl_pro_testimonial_icon' => 'top: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'testimonial_icon_position' => ['fixed'],
                ],
			]
		);

        $this->end_controls_section();
    }

    public function navigation_style_controls()
    {
        $this->start_controls_section(
            'testimonial_btn_navigation_style_content',
            [
                'label' => __( 'Navigation', 'droit-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'dl_testimonial_enable_slide_control' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_nav_button_icon_alignment',
            [
                'label' => __( 'Position', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'relative' => __( 'Normal', 'droit-addons-pro' ),
                    'absolute' => __( 'Fixed', 'droit-addons-pro' ),
                ],
                'default' => 'relative',
                'selectors' => [
                    '{{wrapper}} .swiper_testimonial_nav_button' => 'position: {{VALUE}}'
                ],
                
            ]
        );

        $this->add_control(
            'swiper_testimonial_next_nav_button_inner',
            [
                'label' => __( 'Next', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_control(
            'swiper_testimonial_next_nav_button_align',
            [
                'label' => __( 'Alignment', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'droit-addons-pro' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'droit-addons-pro' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_nav_button_top_spacing',
            [
                'label' => __( 'Top', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-next ' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_nav_button_left_spacing',
            [
                'label' => __( 'Left', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-next ' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_next_nav_button_align' => ['left'],
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_nav_button_right_spacing',
            [
                'label' => __( 'Right', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-next ' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                    'swiper_testimonial_next_nav_button_align' => ['right'],
                ],
            ]
        );
        
        $this->add_control(
            'swiper_testimonial_prev_nav_button_section',
            [
                'label' => __( 'Previous', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_control(
            'swiper_testimonial_prev_nav_button_align',
            [
                'label' => __( 'Alignment', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'droit-addons-pro' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'droit-addons-pro' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_prev_nav_button_top_spacing',
            [
                'label' => __( 'Top', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_prev_nav_button_left_spacing',
            [
                'label' => __( 'Left', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_prev_nav_button_align' => ['left'],
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_prev_nav_button_right_spacing',
            [
                'label' => __( 'Right', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-prev' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                    'swiper_testimonial_prev_nav_button_align' => ['right'],
                ],
            ]
        );	

        $this->add_control(
            '_dl_testimonial_navigation_section',
            [
                'label' => __( 'Button', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_navigation_height',
            [
                'label' => __( 'Height', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button' => 'height: {{VALUE}}px',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonial_btn_navigation_width',
            [
                'label' => __( 'Width', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button' => 'width: {{VALUE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_navigation_button_Horizontal_spacing',
            [
                'label' => __( 'Horizontal Position', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['relative'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_navigation_button_Vartical_spacing',
            [
                'label' => __( 'Vartical Position', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['relative'],
                ],
            ]
        );

        $this->add_control(
            'testimonial_btn_navigation_Typography_border_radius',
            [
                'label' => __( 'Border Radius', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonial_btn_navigation_Typography',
            [
                'label' => __( 'Font Size', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_btn_navigation_Box_Shadow',
                'label' => __( 'Box Shadow', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button',
            ]
        );
        

        $this->start_controls_tabs(
            'testimonial_btn_navigation_style_tabs'
        );

        $this->start_controls_tab(
            'testimonial_btn_navigation_style_normal_tab',
            [
                'label' => __( 'Normal', 'droit-addons-pro' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_btn_navigation_background',
                'label' => __( 'Background', 'droit-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_btn_navigation_border',
                'label' => __( 'Border', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button',
            ]
        );
        $this->add_control(
            'testimonial_btn_navigation_icon_color',
            [
                'label' => __( 'Icon Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button' => 'color: {{VALUE}}'],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'testimonial_btn_navigation_style_hover_tab',
            [
                'label' => __( 'Hover', 'droit-addons-pro' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_btn_navigation_hover_background',
                'label' => __( 'Background', 'droit-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button:hover',
            ]
        );
        $this->add_control(
            'testimonial_btn_navigation_hover_icon_color',
            [
                'label' => __( 'Icon Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button:hover' => 'color: {{VALUE}}'],
            ]
        );
        $this->add_control(
            'testimonial_btn_navigation_hover_border',
            [
                'label' => __( 'Border Color', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button:hover' => 'border-color: {{VALUE}}'],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_btn_navigation_hover_Box_Shadow',
                'label' => __( 'Box Shadow', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button:hover',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_tab_pagination_style_section',
            [
                'label' => __( 'Pagination', 'droit-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'dl_testimonial_pagination' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_pagination_button_alignment_Position',
            [
                'label' => __( 'Position', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'relative'  => __( 'Normal', 'droit-addons-pro' ),
                    'absolute' => __( 'absolute', 'droit-addons-pro' ),
                    'fixed' => __( 'Fixed', 'droit-addons-pro' ),
                ],
                'default' => 'relative',
                'selectors' => [
                    '{{wrapper}} .dl_swiper_testimonial_pagination' => 'position: {{VALUE}}'
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_pagination_top_position',
            [
                'label' => __( 'Top', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 120,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_testimonial_pagination' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_pagination_button_alignment_Position' => ['absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_pagination_left_position',
            [
                'label' => __( 'Left', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_testimonial_pagination' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_pagination_button_alignment_Position' => ['absolute'],
                ],
            ]
        );

        $this->add_control(
            '_dl_testimonial_slider_pagination_title',
            [
                'label' => __( 'Pagination', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_pagination_dot_alignment',
            [
                'label' => __( 'Pagination Alignment', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'flex-start',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'droit-addons-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'droit-addons-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'droit-addons-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_testimonial_pagination' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_pagination_button_Horizontal_spacing',
            [
                'label' => __( 'Horizontal Spacing', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet:not(:first-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'swiper_testimonial_pagination_button_Vartical_spacing',
            [
                'label' => __( 'Vartical Spacing', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_testimonial_pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_btn_pagination_border_radius',
            [
                'label' => __( 'Border Radius', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        

        $this->start_controls_tabs(
            'testimonial_tab_pagination_style_tabs'
        );

        $this->start_controls_tab(
            'testimonial_tab_pagination_style_normal_tab',
            [
                'label' => __( 'Normal', 'droit-addons-pro' ),
            ]
        );
        
        $this->add_responsive_control(
            'testimonial_btn_pagination_height',
            [
                'label' => __( 'Height', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{VALUE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_pagination_width',
            [
                'label' => __( 'Width', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{VALUE}}px',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_btn_pagination_background',
                'label' => __( 'Background', 'droit-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_btn_pagination_border',
                'label' => __( 'Border', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'testimonial_tab_pagination_style_active_tab',
            [
                'label' => __( 'Active', 'droit-addons-pro' ),
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_active_pagination_height',
            [
                'label' => __( 'Height', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'height: {{VALUE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_active_pagination_width',
            [
                'label' => __( 'Width', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{VALUE}}px',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_btn_active_pagination_background',
                'label' => __( 'Background', 'droit-addons-pro' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_btn_active_pagination_border',
                'label' => __( 'Border', 'droit-addons-pro' ),
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        do_action('dl_pro_testimonial_navigation', $this);
    }

    /**
	 * @since 2.3.0
	 * @access protected
	 */
	protected function get_rating( $ratting ) {
		$settings = $this->get_settings_for_display();
		$dl_rating_scale = (int) $settings['droit_rating_scale'];
		$rating = (float)  $ratting > $dl_rating_scale ? $dl_rating_scale :  $ratting;
		return [ $rating, $dl_rating_scale ];
	}

	/**
	 * Print the actual stars and calculate their filling.
	 *
	 * Rating type is float to allow stars-count to be a fraction.
	 * Floored-rating type is int, to represent the rounded-down stars count.
	 * In the `for` loop, the index type is float to allow comparing with the rating value.
	 *
	 * @since 2.3.0
	 * @access protected
	 */
	protected function render_stars( $icon, $dat = 0 ) {
		$dl_rating_data = $this->get_rating( $dat );
		$rating = (float) $dl_rating_data[0];
		$floored_rating = floor( $rating );
		$stars_html = '';

		for ( $stars = 1.0; $stars <= $dl_rating_data[1]; $stars++ ) {
			if ( $stars <= $floored_rating ) {
				$stars_html .= '<i class="droit-star-full">' . $icon . '</i>';
			} elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
				$stars_html .= '<i class="droit-star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i>';
			} else {
				$stars_html .= '<i class="droit-star-empty">' . $icon . '</i>';
			}
		}
		return $stars_html;
	}

    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
       
		$icon = '&#xE934;';
        
        $testimonial_id = $this->get_id();

        $testimonial_settings = [];
        $testimonial_settings['slidesPerView'] = $dl_testimonial_perpage;
        $testimonial_settings['loop'] = ($dl_testimonial_loop == 'yes') ? true : false;
        $testimonial_settings['speed'] = $dl_testimonial_speed;
		if( $dl_testimonial_autoplay == true){
            $testimonial_settings['autoplay']['delay'] = $dl_testimonial_auto_delay;
        } 
        
        $testimonial_settings['effect'] = $dl_testimonial_effect;
        $testimonial_settings['spaceBetween'] = $dl_testimonial_space;
        $testimonial_settings['slidesPerColumnFill'] = 'column';
        $testimonial_settings['centeredSlides'] = ($dl_testimonial_centered == 'yes') ? true : false;
        $testimonial_settings['direction'] = ($dl_testimonial_direction == 'yes') ? 'vertical' : 'horizontal';
        if( $dl_testimonial_enable_slide_control == 'yes'){
            $testimonial_settings['navigation']['nextEl'] = '.dl-slider-next'.$testimonial_id;
            $testimonial_settings['navigation']['prevEl'] = '.dl-slider-prev'.$testimonial_id;
        }
        if( $dl_testimonial_pagination == 'yes'){
            $testimonial_settings['pagination']['el'] = '.dl_testimonial_pag'.$testimonial_id;
            $testimonial_settings['pagination']['type'] = $dl_testimonial_pagination_type;
            $testimonial_settings['pagination']['clickable'] = '!0';
        }
        if( $dl_breakpoints_enable == 'yes'){
            foreach($dl_breakpoints as $k=>$v){
                $width = $v['dl_breakpoints_width'];
                $testimonial_settings['breakpoints'][$width]['slidesPerView'] = $v['dl_breakpoints_perpage'];
                $testimonial_settings['breakpoints'][$width]['spaceBetween'] = $v['dl_breakpoints_space'];
                $testimonial_settings['breakpoints'][$width]['centeredSlides'] = $v['dl_breakpoints_center'];

                if( $v['dl_breakpoints_pagination'] == 'yes'){
					$testimonial_settings['breakpoints'][$width]['pagination'] = [ 'enable' => false];
				}
				if( $v['dl_breakpoints_slide_control'] == 'yes'){
					$testimonial_settings['breakpoints'][$width]['navigation'] = [ 'enable' => false];
				}
                
            }
        }
        $testimonial_settings['dl_mouseover'] = ($dl_testimonial_mouseover_enable == 'yes') ? true : false;
        $testimonial_settings['dl_autoplay'] = $dl_testimonial_autoplay;
       
        ?>
    
        <div class="dl_pro_testimonial_wrapper dl-slider-<?php echo esc_attr($testimonial_id);?>">  
            <div class="dl_pro_testimonial_slider swiper-container" data-settings='<?php echo json_encode($testimonial_settings, true);?>'>
                <div class="swiper-wrapper">
                    <?php if (isset($_dl_pro_testimonial_list) && !empty($_dl_pro_testimonial_list)):
                        foreach ($_dl_pro_testimonial_list as $item):
                            // image
                            $image = wp_get_attachment_image_url( $item['_dl_pro_testimonial_image']['id'], $this->get_pro_testimonials_settings('thumbnail_size') );
                            if ( ! $image ) {
                                $image = $item['_dl_pro_testimonial_image']['url'];
                            }

                            $dl_rating_data = $this->get_rating( $item['droit_rating'] );
                            $textual_rating = $dl_rating_data[0] . '/' . $dl_rating_data[1];

                    ?>
                      <div class="swiper-slide">
                        <div class="dl_pro_testimonial_slider_wrapper">
                        <?php
                            $_testomonial_ordering = $_dl_testimonial_ordering_data;
                            foreach( $_testomonial_ordering as $order ) :
                            if('yes' !== $order['_dl_testimonial_order_enable'] ){
                                continue;
                            }
                            switch( $order['_dl_testimonial_order_id'] ):
                                case 'testimonial_rating':
                                    ?>
                                        <div class="dl_testimonial_rating">
                                            <?php
                                                if ( 'star_fontawesome' === $settings['droit_star_style'] ) {
                                                    if ( 'outline' === $settings['droit_unmarked_star_style'] ) {
                                                        $icon = '&#xE933;';
                                                    }
                                                } elseif ( 'star_unicode' === $settings['droit_star_style'] ) {
                                                    $icon = '&#9733;';
                                        
                                                    if ( 'outline' === $settings['droit_unmarked_star_style'] ) {
                                                        $icon = '&#9734;';
                                                    }
                                                }
                                        
                                                $this->add_render_attribute( 'icon_wrapper', [
                                                    'class' => 'droit-star-rating',
                                                    'title' => $textual_rating,
                                                    'itemscope' => '',
                                                    'itemprop' => 'reviewRating',
                                                ] );
                                        
                                                $schema_rating = '<span itemprop="ratingValue" class="elementor-screen-only">' . $textual_rating . '</span>';
                                                $stars_element = '<div ' . $this->get_render_attribute_string( 'icon_wrapper' ) . '>' . $this->render_stars( $icon, $item['droit_rating'] ) . ' ' . $schema_rating . '</div>';
                                                ?>
                                                <div class="droit-star-rating__wrapper">
                                                    <?php if ( ! \Elementor\Utils::is_empty( $item['droit_rating_title'] ) ) : ?>
                                                        <div class="droit-star-rating__title"><?php echo $item['droit_rating_title']; ?></div>
                                                    <?php endif; ?>

                                                    <?php if ( $testimonial_ratting_icon == 'yes' ) : ?>
                                                        <?php echo $stars_element; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php
                                            ?>
                                        </div>
                                    <?php
                                break;
                                case 'dl_testimonial_icon':
                                    ?>
                                        <div class="dl_pro_testimonial_icon <?php echo 'icon_position_' .$testimonial_icon_position ?> ">
			                                <?php \Elementor\Icons_Manager::render_icon( $settings['droit_section_testimonial_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php
                                break;
                                case 'testimonial_client_info':
                                    ?>
                                        <div class="dl_client_info">
                                            <div class="dl_client_info_inner <?php echo 'image_align_' .$_dl_pro_testimonial_image_position ?>">
                                                <?php if ( !empty( $image ) ) : ?>
                                                    <div class="dl-testimonial-reviewer">
                                                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['_dl_pro_testimonial_name'] ); ?>" class="dl_client_img">
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <div class="dl-testimonial-content">
                                                    <h5 class="dl_name"><?php echo __($item['_dl_pro_testimonial_name'], 'droit-addons-pro'); ?></h5>
                                                    <p class="dl_position"><?php echo __($item['_dl_pro_testimonial_designation'], 'droit-addons-pro'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                break;
                                case 'dl_author_logo':
                                    ?>
                                        <?php \Elementor\Icons_Manager::render_icon( $item['_dl_testimonial_author'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php
                                break;
                                case 'testimonial_description':
                                    ?>
                                        <p class="dl_text">
                                            <?php echo $item['_dl_pro_testimonial_text']; ?>
                                        </p>
                                    <?php
                                break;
                            endswitch;
                        endforeach;
                        ?>
                        </div>
                    </div>
                    <?php endforeach;
                endif;?>
                </div>
            </div>
            <?php if( $dl_testimonial_enable_slide_control == 'yes'){?>
            <div class="dl_testimonial_swiper_navigation">
                <div class="swiper_testimonial_nav_button dl-slider-prev dl-slider-prev<?php echo esc_attr($testimonial_id) ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['dl_testimonial_nav_left_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <div class="swiper_testimonial_nav_button dl-slider-next dl-slider-next<?php echo esc_attr($testimonial_id) ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['dl_testimonial_nav_right_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
            </div>
            <?php }
            
            if( $dl_testimonial_pagination == 'yes'){?>
            <div class="dl_swiper_testimonial_pagination dl_testimonial_pag<?php echo esc_attr($testimonial_id) ?>"></div>
            <?php } ?>
        </div>

        <?php
    }

    protected function content_template()
    {}
}