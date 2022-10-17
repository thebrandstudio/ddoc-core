<?php
namespace Elementor;

defined( 'ABSPATH' ) || exit;

class DRDT_Search_Bar Extends Widget_Base{

    protected $index = 1;

    public function get_name() {
		return 'drdt-searchbar';
    }

    public function get_title() {
		return __( 'Search Bar', 'droithead' );
    }
    
    public function get_icon() {
		return 'eicon-search';
	}

    public function get_categories() {
		return [ 'drit-header-footer' ];
    }
    
    public function get_script_depends() {
		return [];
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
            'drdt_searchbar_sections',
            [
                'label' => __( 'Search Icon', 'droithead' ),
            ]
        );

        $this->add_control(
            'search_icon',
            [
                'label' => __( 'Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();


        // Overlay Search Form
        $this->start_controls_section(
            'overlay_search_form',
            [
                'label' => __( 'Overlay Search Form', 'droithead' ),
            ]
        );

        $this->add_control(
            'overlay_search_icon',
            [
                'label' => __( 'Search Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'overlay_close_icon',
            [
                'label' => __( 'Close Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-window-close',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'overlay_placeholder_text',
            [
                'label' => __( 'Placeholder Text', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Search here ...',
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

        // ============================= Search Icon Style ============================= //
        $this->start_controls_section(
            'search_icon_style',
            [
                'label' => __( 'Search Icon', 'droithead' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        //------------------------- Start Search Icon Colors --------------------------//
        $this->start_controls_tabs(
            'search_icon_color_tabs'
        );

        // Normal Colors
        $this->start_controls_tab(
            'search_icon_normal_tabs', [
                'label' => __( 'Normal', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'search_icon_normal_color',
            [
                'label' => __( 'Icon Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-search-form > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_icon_normal_opacity',
            [
                'label' => __( 'Opacity', 'droithead' ),
                'type' => Controls_Manager::NUMBER,
                'max' => 1,
                'min' => 0.10,
                'step' => 0.01,
                'selectors' => [
                    '{{WRAPPER}} .drdt-search-form > a' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End Normal Colors


        // Hover Colors
        $this->start_controls_tab(
            'search_icon_hover_tabs',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'search_icon_hover_color',
            [
                'label' => __( 'Icon Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-search-form > a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_icon_hover_opacity',
            [
                'label' => __( 'Opacity', 'droithead' ),
                'type' => Controls_Manager::NUMBER,
                'max' => 1,
                'min' => 0.10,
                'step' => 0.01,
                'selectors' => [
                    '{{WRAPPER}} .drdt-search-form > a:hover' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // Hover Colors

        $this->end_controls_tabs(); // End Tabs

        $this->add_responsive_control(
            'search_icon_size',
            [
                'label' => __( 'Size', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-search-form > a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'search_icon_alignment',
            [
                'label' => __( 'Alignment', 'makro-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'makro-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'makro-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'makro-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .drdt-search-form' => 'justify-content: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );


        $this->end_controls_section(); // End Search Icon Style


        //============================= Overlay search form ============================== //
        $this->start_controls_section(
            'overlay_search_form_icon_style',
            [
                'label' => __( 'Overlay Search Form', 'droithead' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'overlay_search_form_placeholder_typo',
                'label' => __( 'Placeholder Typography', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} .droit-search-box .drdt-input-group input::-webkit-input-placeholder',
            ]
        );

        $this->add_control(
            'overlay_search_form_placeholder_color',
            [
                'label' => __( 'Placeholder Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-search-box .drdt-input-group input::-webkit-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_search_form_icon_color',
            [
                'label' => __( 'Search Icon Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-input-group-append > .btn > i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'overlay_search_form_close_icon_color',
            [
                'label' => __( 'Close Icon Color', 'droithead' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .drdt-input-group-append > .btn > i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'overlay_search_form_icon_size',
            [
                'label' => __( 'Icon Size', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .drdt-input-group-append > .btn > i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_search_form_bg_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'overlay_search_form_bg_color',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .droit-search-box:before',
            ]
        );

        $this->add_control(
            'overlay_search_form_bg_opacity',
            [
                'label' => __( 'Opacity', 'droithead' ),
                'type' => Controls_Manager::NUMBER,
                'max' => 1,
                'min' => 0.10,
                'step' => 0.01,
                'selectors' => [
                    '{{WRAPPER}} .droit-search-box:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End Overlay search form

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

        ?>
        <div class="drdt-search-form">
            <a class="drdt-search-btn" href="javascript:void(0);">
                <?php \Elementor\Icons_Manager::render_icon( $search_icon, [ 'aria-hidden' => 'true' ] ); ?>
            </a>
            <form action="<?php echo esc_url(home_url( '/')) ?>" class="droit-search-box" role="search">
                <div class="drdt-search-box-inner">
                    <div class="drdt-close-icon">
                        <?php \Elementor\Icons_Manager::render_icon( $overlay_close_icon, [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                    <div class="drdt-input-group">
                        <input type="text" name="s" class="form_control drdt-search-input" placeholder="<?php echo esc_attr($overlay_placeholder_text) ?>">
                        <div class="drdt-input-group-append">
                            <button class="btn" type="submit">
                                <?php \Elementor\Icons_Manager::render_icon( $overlay_search_icon, [ 'aria-hidden' => 'true' ] ); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

}