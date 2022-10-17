<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Ddoc_Iconbox extends Widget_Base {

	public function get_name() {
		return 'drth-iconbox';
	}

	public function get_title() {
		return __( 'Ddoc IconBox', 'ddoc-core' );
	}

	public function get_icon() {
		return 'eicon-lightbox';
	}

    public function get_categories()
    {
        return ['drth_custom_theme'];
    }

    public function get_keywords()
    {
        return [ 'icon', ];
    }

	protected function register_controls() {

		// ----------------------------------------  online content ------------------------------
		$this->start_controls_section(
			'online_content_opt',
			[
				'label' => esc_html__( 'Content', 'ddoc-core' ),
			]
		);
        $this->add_control(
            'item_number',
            [
                'label' => esc_html__( 'Number', 'ddoc-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'online_title',
            [
                'label' => esc_html__( 'Title', 'ddoc-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'title_url',
            [
                'label' => esc_html__( 'Title URL', 'ddoc-core' ),
                'type' => Controls_Manager::URL,
            ]
        );
        $this->add_control(
            'content_details',
            [
                'label' => esc_html__( 'Content', 'ddoc-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'read_more_button',
            [
                'label' => esc_html__( 'Button Text', 'ddoc-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More',
            ]
        );
        $this->add_control(
            'button_url',
            [
                'label' => esc_html__( 'Button URL', 'ddoc-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon Type', 'droit-addons-pro' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-atom',
                    'library' => 'fa-solid',
                ],
            ]
        );
                
		$this->end_controls_section(); // End Documentation Item


        //  Style Section Start
        $this->start_controls_section(
            'content_sction_style',
            [
                'label'         => esc_html__( 'Content Section Style', 'ddoc-core' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_heading',
            [
                'label' => __( 'Number Style', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
        'number_style',
            [
                'label' => __( 'Number Color', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .online_document_item .number' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .online_document_item .number',
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => __( 'Title Style', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
          'title_style',
            [
                'label' => __( 'Title Color', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'ddoc-core' ),
                'selector' => '{{WRAPPER}} .doc_title',
            ]
        );

        $this->add_control(
            'content_heading',
            [
                'label' => __( 'Content Style', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
          'content_style',
            [
                'label' => __( 'content Color', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_details' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Content Typography', 'ddoc-core' ),
                'selector' => '{{WRAPPER}} .doc_details',
            ]
        );

        $this->add_control(
            'icon_heading',
            [
                'label' => __( 'Icon', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'icon_margin',
            [
                'label' => __( 'Margin Bottom', 'ddoc-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .doc_icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
            ]
        );

        $this->add_control(
          'inco_gb_color',
            [
                'label' => __( 'Icon Background Color', 'ddoc-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                   '{{WRAPPER}} .doc_icon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
          'button_color',
            [
                'label' => __( 'Button Color', 'ddoc-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                   '{{WRAPPER}} .read_more' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
          'button_hover_color',
            [
                'label' => __( 'Button Hover Color', 'ddoc-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                   '{{WRAPPER}} .read_more:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Button Typography', 'ddoc-core' ),
                'selector' => '{{WRAPPER}} .read_more',
            ]
        );

        $this->end_controls_section();
        

      }

	protected function render() {
		$settings = $this->get_settings();
        $icon_type = isset($settings['icon_type']) ? $settings['icon_type'] : '';
        ?>
       <div class="online_document_item knowledge">
            <?php if(!empty($settings['item_number'])):?>
                <div class="number">
                    <?php echo esc_html($settings['item_number']); ?>
                </div>
            <?php endif; ?>
            <div class="doc_icon">
                <?php \Elementor\Icons_Manager::render_icon( $icon_type, [ 'aria-hidden' => 'true' ] ); ?>
            </div>
            <?php if( !empty($settings['online_title']) ): ?>
                <?php if(!empty($settings['title_url']['url'])) : ?>
                <a href="<?php echo esc_url($settings['title_url']['url']) ?>" <?php ddoc_is_exno($settings['title_url']) ?>>
                <?php endif; ?>
                    <h4 class="doc_title"><?php echo esc_html($settings['online_title']); ?></h4>
                <?php if(!empty($settings['title_url']['url'])) : ?> </a> <?php endif; ?>
            <?php endif; ?>
            <?php if( !empty($settings['content_details']) ): ?>
                <p class="doc_details"><?php echo wp_kses_post($settings['content_details']); ?></p>
            <?php endif; ?>
            <?php if(!empty($settings['read_more_button'])): ?>
                <a href="<?php echo esc_url( $settings['button_url'] ); ?>" class="read_more">
                    <?php echo esc_html($settings['read_more_button']); ?> <i class="flaticon-next"></i>
                </a>
            <?php endif; ?>
        </div>
       <?php
	}
}