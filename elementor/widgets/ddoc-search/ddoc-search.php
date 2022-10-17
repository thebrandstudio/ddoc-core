<?php
namespace Elementor;

if (!defined('ABSPATH')) {exit;}

class DRTH_ESS_Ddoc_Search extends Widget_Base {

	public function get_name() {
		return 'drth-search';
	}

	public function get_title() {
		return __( 'Doc Search (ddoc)', 'ddoc-core' );
	}

	public function get_icon() {
		return 'eicon-site-search';
	}

	public function get_categories()
    {
        return ['drth_custom_theme'];
    }

    public function get_keywords()
    {
        return [ 'search', 'doc search', 'ddoc search'];
    }

	protected function register_controls() {

		$repeater = new \Elementor\Repeater();

        // ---Start Document Setting
        $this->start_controls_section(
            'document_filter', [
                'label' => __( 'Search Settings', 'ddoc-core' ),
            ]
        );
        $this->add_control(
			'show_category_filter',
			[
				'label' => esc_html__( 'Show Category', 'ddoc-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ddoc-core' ),
				'label_off' => esc_html__( 'Hide', 'ddoc-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'show_suggestions',
			[
				'label' => esc_html__( 'Show Suggestions', 'ddoc-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ddoc-core' ),
				'label_off' => esc_html__( 'Hide', 'ddoc-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'add_popular_keywords', [
                'label' => esc_html__( 'Suggestions Keywords', 'ddoc-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'how to, install, plugin, ajax, elemenor', 'ddoc-core' ),
                'condition' => [
                    'show_suggestions' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
        $this-> _styles_control();

        // end Document Setting Section
      }

      public function _styles_control(){
        $this->general_style_controls();
        $this->search_category_style();
    }

    public function general_style_controls()
    {
        $this->start_controls_section(
            '_dl_pro_testimonials_general_style_section',
            [
                'label' => __( 'Genaral', 'droit-addons-pro' ),
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
        $this-> end_controls_section();
    }

    public function search_category_style(){
        $this->start_controls_section(
            '_search_category',
            [
                'label' => __( 'Category Suggation', 'droit-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'dl_category_typography',
				'label' => __( 'Typography', 'droit-addons-pro' ),
				'selector' => '{{WRAPPER}} .search-suggation',
			]
		);
		$this->add_control(
			'doc_category_color',
			[
				'label' => __( 'Category Color', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-suggation' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'doc_category_item_padding',
			[
				'label' => __( 'Category Item Padding', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .search-suggation span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'doc_category_item_border_radius',
			[
				'label' => __( 'Border-radius', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .search-suggation span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'doc_category_item_background',
				'label' => __( 'Background', 'droit-addons-pro' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .search-suggation span',
			]
		);
        $this->add_control(
			'doc_category_item_gap',
			[
				'label' => __( 'Margin', 'droit-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .search-suggation span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this-> end_controls_section();
    }


	protected function render() {
		$settings = $this->get_settings();
        $form_wrapper_class = ($settings['show_category_filter'] != 'yes') ? 'input-group position-relative inner-search-button' : 'input-group position-relative';

   ?>

 <!-- Start dt_our_live_document_wrap-->
 <div class="docoment search">
        <div class="form-content">
          <div class="<?php echo  esc_attr( $form_wrapper_class ); ?>">
            <input type="text" class="form-control ddoc-keyworkd-imports" placeholder="<?php esc_attr_e('¿Que estás buscando hoy?', 'ddoc-core'); ?>" aria-label="Search...">
                <div class="ddoc-live-search position-absolute bg-warning d-none list-group">

                </div>
              <?php if($settings['show_category_filter'] == 'yes') : ?>
               <select class="form-select category-select" aria-label="select">
                    <option selected><?php esc_html_e('Categoría', 'ddoc-core'); ?></option>
                    <?php echo get_doc_category_in_options(); ?>
                </select>
              <?php endif; ?>
              <?php if($settings['show_category_filter'] == 'yes') : ?>
                <button type="button" class="ddoc-doc-ajax-search"><?php esc_html_e('Buscar', 'ddoc-core'); ?></button>
                <?php  else : ?>
                    <button type="button" class="ddoc-doc-ajax-search"><i class="fa fa-search"></i></button>
                <?php endif; ?>
          </div>
          <?php if($settings['show_suggestions'] == 'yes') : ?>
            <div class="search-suggation text-center"><b><?php esc_html_e( 'Lo más buscado :', 'ddoc-core' ); ?></b>
                <?php $get_keywords = $settings['add_popular_keywords'];
                    $make_arr = explode(',', $get_keywords);
                    foreach($make_arr as $keywords) {
                        echo '<span style="margin: 0px 6px 0px 6px;">'. $keywords.'</span>';
                    }
                ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- end dt_our_live_document_wrap -->
<?php
 }
}
