<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class DL_Image extends \Elementor\Group_Control_Base {

	
	protected static $fields;
	
	private static $_scheme_fields_keys = [ 'font_family', 'font_weight' ];

	public static function get_scheme_fields_keys() {
		return self::$_scheme_fields_keys;
	}
	
	public static function get_type() {
		return 'droit-image';
	}

	protected function init_fields() {
		$fields = [];


		$fields['image_width'] = [
			'label'      => esc_html__( 'Width', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
				'em' => [
					'min' => 1,
					'max' => 1000,
				],
				'%' => [
					'min' => 1,
					'max' => 1000,
				],
			],
			'responsive' => true,
			'size_units' => [ 'px', '%','em' ],
			'selector_value' => 'width: {{SIZE}}{{UNIT}} !important',
		];
		$fields['image_height'] = [
			'label'      => esc_html__( 'Height', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
				'em' => [
					'min' => 1,
					'max' => 1000,
				],
				'%' => [
					'min' => 1,
					'max' => 1000,
				],
			],
			'responsive' => true,
			'size_units' => [ 'px', '%','em' ],
			'selector_value' => 'height: {{SIZE}}{{UNIT}} !important',
		];
		$fields['image_object_fit'] = [
			'label'   => esc_html__( 'Object Fit', 'droit-addons-pro' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'' => __('Default', 'droit-addons-pro'),
				'fill' => __('Fill', 'droit-addons-pro'),
				'cover' => __('Cover', 'droit-addons-pro'),
				'contain' => __('Contain', 'droit-addons-pro'),
			],
			
			'render_type' => 'ui',
			'responsive' => true,
			'condition' => [
				'image_height!' => '',
			],
			'selector_value' => 'object-fit: {{VALUE}};',
		];
		$fields['image_border'] = [
			'label'   => esc_html__( 'Border Type', 'droit-addons-pro' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => [
				''       => __( 'None', 'droit-addons-pro' ),
				'solid'  => esc_html__( 'Solid', 'droit-addons-pro' ),
				'double' => esc_html__( 'Double', 'droit-addons-pro' ),
				'dotted' => esc_html__( 'Dotted', 'droit-addons-pro' ),
				'dashed' => esc_html__( 'Dashed', 'droit-addons-pro' ),
			],
			'selector_value' => 'border-style: {{VALUE}};',
		];

		$fields['image_border_width'] = [
			'label'     => esc_html__( 'Width', 'droit-addons-pro' ),
			'type'      => \Elementor\Controls_Manager::DIMENSIONS,
			'selector_value' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			'condition' => [
				'image_border!' => '',
			],
		];

		$fields['image_border_color'] = [
			'label' => esc_html__( 'Color', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '',
			'selector_value' => 'border-color: {{VALUE}};',
			'condition' => [
				'image_border!' => '',
			],
		];

		$fields['image_border_radius'] = [
			'label'     => esc_html__( 'Border Radius', 'droit-addons-pro' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selector_value' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		];
		$fields['image_padding'] = [
			'label'      => esc_html__( 'Padding', 'droit-addons-pro' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selector_value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		];
		$fields['image_margin'] = [
			'label'      => esc_html__( 'Margin', 'droit-addons-pro' ),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selector_value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		];
		$fields['allow_box_shadow'] = [
			'label' => esc_html__( 'Image Shadow', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'droit-addons-pro' ),
			'label_off' => esc_html__( 'No', 'droit-addons-pro' ),
			'return_value' => 'yes',
			'separator' => 'before',
			'render_type' => 'ui',
		];

		$fields['image_shadow'] = [
			'label'     => esc_html__( 'Image Shadow', 'droit-addons-pro' ),
			'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
			'condition' => [
				'allow_box_shadow!' => '',
			],
			'selector_value' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{image_shadow_position.VALUE}};',
		];

		$fields['image_shadow_position'] = [
			'label' => esc_html__( 'Position', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				' '     => esc_html__( 'Outline', 'droit-addons-pro' ),
				'inset' => esc_html__( 'Inset', 'droit-addons-pro' ),
			],
			'condition' => [
				'allow_box_shadow!' => '',
			],
			'default' => ' ',
			'render_type' => 'ui',
		];
		return $fields;
	}

	protected function prepare_fields( $fields ) {
		array_walk(
			$fields, function( &$field, $field_name ) {

				if ( in_array( $field_name, [ 'typography', 'popover_toggle' ] ) ) {
					return;
				}

				$selector_value = ! empty( $field['selector_value'] ) ? $field['selector_value'] : str_replace( '_', '-', $field_name ) . ': {{VALUE}};';

				$field['selectors'] = [
					'{{SELECTOR}}' => $selector_value,
				];
			}
		);
		return parent::prepare_fields( $fields );
	}

	protected function add_group_args_to_field( $control_id, $field_args ) {
		$field_args = parent::add_group_args_to_field( $control_id, $field_args );

		$field_args['groupPrefix'] = $this->get_controls_prefix();
		$field_args['groupType'] = 'image_setting';

		$args = $this->get_args();

		if ( in_array( $control_id, self::get_scheme_fields_keys() ) && ! empty( $args['scheme'] ) ) {
			$field_args['scheme'] = [
				'type' => self::get_type(),
				'value' => $args['scheme'],
				'key' => $control_id,
			];
		}
		return $field_args;
	}

	protected function get_default_options() {
		return [
			'popover' => [
				'starter_name' => 'image_setting',
				'starter_title' => esc_html__( 'Image Setting', 'droit-addons-pro' ),
				'settings' => [
					'render_type' => 'ui',
					'groupType' => 'image_setting',
					'global' => [
						'active' => true,
					],
				],
			],
		];
	}
}
