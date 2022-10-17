<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Button_Hover_Advanced_Second extends \Elementor\Group_Control_Base {

	protected static $fields;
	
	public static function get_type() {
		return 'button-hover-advanced-second';
	}

	protected function init_fields() {
		$fields = [];

		$fields['button_direction'] = [
			'label' => esc_html__('Direction', 'droit-addons-pro'),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options'     => [
				'left' => [
					'title' => esc_html__( 'Left', 'droit-addons-pro' ),
					'icon' => 'eicon-h-align-left',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'droit-addons-pro' ),
					'icon' => 'eicon-h-align-right',
				],
			],
			'default' => 'left',
			'render_type' => 'ui',
			'selector_value' => 'transform-origin: {{VALUE}};',
		];
		$fields['button_transform'] = [
			'label' => esc_html__( 'Transform', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range' => [
				'px' => [
					'max' => 10,
					'step' => 0.1,
				],
			],
			'default' => [
				'unit' => '%',
				'size' => 1,
			],
			'render_type' => 'ui',
			'condition' => [
				'button_direction' => [ 'left', 'right' ],
			],
			'selector_value' => 'transform: scaleX({{SIZE}});',
		];
		$fields['button_transform_s'] = [
			'label' => esc_html__( 'Transform', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range' => [
				'px' => [
					'max' => 10,
					'step' => 0.1,
				],
			],
			'default' => [
				'unit' => '%',
				'size' => 0,
			],
			'render_type' => 'ui',
			'condition' => [
				'button_direction' => [ 'top', 'bottom' ],
			],
			'selector_value' => 'transform: scaleY({{SIZE}});',
		];
		return $fields;
	}

	protected function prepare_fields( $fields ) {
		array_walk(
			$fields, function( &$field, $field_name ) {

				if ( in_array( $field_name, [ 'after_hover', 'popover_toggle' ] ) ) {
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

	protected function get_default_options() {
		return [
			'popover' => [
				'starter_name' => 'after_hover',
				'starter_title' => esc_html__( 'After Hover', 'droit-addons-pro' ),
				'settings' => [
					'render_type' => 'ui',
					'groupType' => 'after_hover',
					'global' => [
						'active' => true,
					],
				],
			],
		];
	}
}
