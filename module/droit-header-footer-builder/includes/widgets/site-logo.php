<?php
namespace Elementor;

defined( 'ABSPATH' ) || exit;

class DRDT_Site_Logo Extends Widget_Base{
    
    public function get_name() {
		return 'drdt-sitelogo';
    }

    public function get_title() {
		return __( 'Site Logo', 'droithead' );
    }
    
    public function get_icon() {
		return 'eicon-image';
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
			'drdt_site_logo_sections',
			[
				'label' => __( 'Logo', 'droithead' ),
			]
		);

        $this->add_control(
			'main_logo',
			[
				'label'     => __( 'Main Logo', 'droithead' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'sticky_logo',
			[
				'label'     => __( 'Sticky Logo', 'droithead' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
            'logo_max_width',
            [
                'label' => __( 'Max Width', 'makro-core' ),
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
                    '{{WRAPPER}} .drdt_custom_site_logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'main_logo_alignment',
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}}  .drdt_site_logo' => 'justify-content: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();


        /**
         * @@
         * Retina Logo
         * @@
         */
        $this->start_controls_section(
            'drdt_site_retina_logo_sections',
            [
                'label' => __( 'Retina Logo', 'droithead' ),
            ]
        );

        $this->add_control(
            'retina_logo',
            [
                'label'     => __( 'Main Logo', 'droithead' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'retina_sticky_logo',
            [
                'label'     => __( 'Sticky Logo', 'droithead' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'retina_logo_max_width',
            [
                'label' => __( 'Max Width', 'makro-core' ),
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
                    '{{WRAPPER}} .drdt_custom_site_logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
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
    public function render_style_section(){

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

        // Retina Logo
        $retina_logo = !empty($settings['retina_logo']['url']) ? "srcset='{$settings['retina_logo']['url']} 2x'" : '';
        $retina_sticky_logo = !empty($settings['retina_sticky_logo']['url']) ? "srcset='{$settings['retina_sticky_logo']['url']} 2x'" : '';
        ?>
        <div class="drdt_site_logo">
            <a href="<?php echo esc_url( home_url( '/' ) ) ?>" class="drdt_custom_site_logo">
                <img class="drdt_main_logo" src="<?php echo esc_url($main_logo['url']); ?>" <?php echo esc_url($retina_logo) ?> alt="<?php bloginfo( 'name' ); ?>">
                <img class="drdt_sticky_logo" src="<?php echo esc_url($sticky_logo['url']); ?>" <?php echo esc_url($retina_sticky_logo) ?> alt="<?php bloginfo( 'name' ); ?>">
            </a>
        </div>
        <?php

    }
}