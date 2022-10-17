<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Button_Hover extends \Elementor\Group_Control_Base {

	protected static $fields;
	
	public static function get_type() {
		return 'droit-button-hover';
	}

	protected function init_fields() {
		$fields = [];
		$fields['text_color'] = [
			'label' => esc_html__( 'Text Color', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '',
			'title' => esc_html__( 'Text Color', 'droit-addons-pro' ),
			'selector_value' => 'color: {{VALUE}};',
		];
		$fields['background'] = [
			'label'       => esc_html__( 'Background Type', 'droit-addons-pro' ),
			'type'        => \Elementor\Controls_Manager::CHOOSE,
			'options'     => [
				'classic' => [
					'title' => esc_html__( 'Classic', 'droit-addons-pro' ),
					'icon' => 'eicon-paint-brush',
				],
				'gradient' => [
					'title' => esc_html__( 'Gradient', 'droit-addons-pro' ),
					'icon' => 'eicon-barcode',
				],
			],
			'label_block' => false,
			'render_type' => 'ui',
			'of_type' => 'background',
		];

		$fields['color'] = [
			'label' => esc_html__( 'Color', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '',
			'title' => esc_html__( 'Background Color', 'droit-addons-pro' ),
			'selector_value' => 'background-color: {{VALUE}};',
			'condition' => [
				'background' => [ 'classic', 'gradient' ],
			],
		];

		$fields['color_stop'] = [
			'label' => esc_html__( 'Location', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default' => [
				'unit' => '%',
				'size' => 0,
			],
			'render_type' => 'ui',
			'condition' => [
				'background' => [ 'gradient' ],
			],
			'of_type' => 'gradient',
		];

		$fields['color_b'] = [
			'label' => esc_html__( 'Second Color', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '#f2295b',
			'render_type' => 'ui',
			'condition' => [
				'background' => [ 'gradient' ],
			],
			'of_type' => 'gradient',
		];

		$fields['color_b_stop'] = [
			'label' => esc_html__( 'Location', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default' => [
				'unit' => '%',
				'size' => 100,
			],
			'render_type' => 'ui',
			'condition' => [
				'background' => [ 'gradient' ],
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_type'] = [
			'label' => esc_html__( 'Type', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'linear' => esc_html__( 'Linear', 'droit-addons-pro' ),
				'radial' => esc_html__( 'Radial', 'droit-addons-pro' ),
			],
			'default' => 'linear',
			'render_type' => 'ui',
			'condition' => [
				'background' => [ 'gradient' ],
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_angle'] = [
			'label' => esc_html__( 'Angle', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'deg' ],
			'default' => [
				'unit' => 'deg',
				'size' => 180,
			],
			'range' => [
				'deg' => [
					'step' => 10,
				],
			],
			'selector_value' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
			'condition' => [
				'background' => [ 'gradient' ],
				'gradient_type' => 'linear',
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_position'] = [
			'label' => esc_html__( 'Position', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'center center' => esc_html__( 'Center Center', 'droit-addons-pro' ),
				'center left' => esc_html__( 'Center Left', 'droit-addons-pro' ),
				'center right' => esc_html__( 'Center Right', 'droit-addons-pro' ),
				'top center' => esc_html__( 'Top Center', 'droit-addons-pro' ),
				'top left' => esc_html__( 'Top Left', 'droit-addons-pro' ),
				'top right' => esc_html__( 'Top Right', 'droit-addons-pro' ),
				'bottom center' => esc_html__( 'Bottom Center', 'droit-addons-pro' ),
				'bottom left' => esc_html__( 'Bottom Left', 'droit-addons-pro' ),
				'bottom right' => esc_html__( 'Bottom Right', 'droit-addons-pro' ),
			],
			'default' => 'center center',
			'selector_value' =>'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
			'condition' => [
				'background' => [ 'gradient' ],
				'gradient_type' => 'radial',
			],
			'of_type' => 'gradient',
		];

		$fields['image'] = [
			'label' => esc_html__( 'Image', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'responsive' => true,
			'title' => esc_html__( 'Background Image', 'droit-addons-pro' ),
			'selector_value' =>'background-image: url("{{URL}}");',
			'render_type' => 'template',
			'condition' => [
				'background' => [ 'classic' ],
			],
		];

		$fields['position'] = [
			'label' => esc_html__( 'Position', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'responsive' => true,
			'options' => [
				'' => esc_html__( 'Default', 'droit-addons-pro' ),
				'center center' => esc_html__( 'Center Center', 'droit-addons-pro' ),
				'center left' => esc_html__( 'Center Left', 'droit-addons-pro' ),
				'center right' => esc_html__( 'Center Right', 'droit-addons-pro' ),
				'top center' => esc_html__( 'Top Center', 'droit-addons-pro' ),
				'top left' => esc_html__( 'Top Left', 'droit-addons-pro' ),
				'top right' => esc_html__( 'Top Right', 'droit-addons-pro' ),
				'bottom center' => esc_html__( 'Bottom Center', 'droit-addons-pro' ),
				'bottom left' => esc_html__( 'Bottom Left', 'droit-addons-pro' ),
				'bottom right' => esc_html__( 'Bottom Right', 'droit-addons-pro' ),
				'initial' => esc_html__( 'Custom', 'droit-addons-pro' ),

			],
			'selector_value' => 'background-position: {{VALUE}};',
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
			],
		];

		$fields['xpos'] = [
			'label' => esc_html__( 'X Position', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vw' ],
			'default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'tablet_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'mobile_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'range' => [
				'px' => [
					'min' => -800,
					'max' => 800,
				],
				'em' => [
					'min' => -100,
					'max' => 100,
				],
				'%' => [
					'min' => -100,
					'max' => 100,
				],
				'vw' => [
					'min' => -100,
					'max' => 100,
				],
			],
			'selector_value' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
			'condition' => [
				'background' => [ 'classic' ],
				'position' => [ 'initial' ],
				'image[url]!' => '',
			],
			'required' => true,
			'device_args' => [
				\Elementor\Controls_Stack::RESPONSIVE_TABLET => [
					'selector_value' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_tablet.SIZE}}{{ypos_tablet.UNIT}}',
					'condition' => [
						'background' => [ 'classic' ],
						'position_tablet' => [ 'initial' ],
					],
				],
				\Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
					'selector_value' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_mobile.SIZE}}{{ypos_mobile.UNIT}}',
					'condition' => [
						'background' => [ 'classic' ],
						'position_mobile' => [ 'initial' ],
					],
				],
			],
		];

		$fields['ypos'] = [
			'label' => esc_html__( 'Y Position', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vh' ],
			'default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'tablet_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'mobile_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'range' => [
				'px' => [
					'min' => -800,
					'max' => 800,
				],
				'em' => [
					'min' => -100,
					'max' => 100,
				],
				'%' => [
					'min' => -100,
					'max' => 100,
				],
				'vh' => [
					'min' => -100,
					'max' => 100,
				],
			],
			'selector_value' => 'background-position: {{xpos.SIZE}}{{xpos.UNIT}} {{SIZE}}{{UNIT}}',
			'condition' => [
				'background' => [ 'classic' ],
				'position' => [ 'initial' ],
				'image[url]!' => '',
			],
			'required' => true,
			'device_args' => [
				\Elementor\Controls_Stack::RESPONSIVE_TABLET => [
					'selector_value' => 'background-position: {{xpos_tablet.SIZE}}{{xpos_tablet.UNIT}} {{SIZE}}{{UNIT}}',
					'condition' => [
						'background' => [ 'classic' ],
						'position_tablet' => [ 'initial' ],
					],
				],
				\Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
					'selector_value' => 'background-position: {{xpos_mobile.SIZE}}{{xpos_mobile.UNIT}} {{SIZE}}{{UNIT}}',
					'condition' => [
						'background' => [ 'classic' ],
						'position_mobile' => [ 'initial' ],
					],
				],
			],
		];

		$fields['attachment'] = [
			'label' => esc_html__( 'Attachment', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'' => esc_html__( 'Default', 'droit-addons-pro' ),
				'scroll' => esc_html__( 'Scroll', 'droit-addons-pro' ),
				'fixed' => esc_html__( 'Fixed', 'droit-addons-pro' ),
			],
			'selector_value' => [
				'(desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
			],
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
			],
		];

		$fields['attachment_alert'] = [
			'type' => \Elementor\Controls_Manager::RAW_HTML,
			'content_classes' => 'elementor-control-field-description',
			'raw' => __( 'Note: Attachment Fixed works only on desktop.', 'droit-addons-pro' ),
			'separator' => 'none',
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
				'attachment' => 'fixed',
			],
		];

		$fields['repeat'] = [
			'label' => esc_html__( 'Repeat', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'responsive' => true,
			'options' => [
				'' => esc_html__( 'Default', 'droit-addons-pro' ),
				'no-repeat' => esc_html__( 'No-repeat', 'droit-addons-pro' ),
				'repeat' => esc_html__( 'Repeat', 'droit-addons-pro' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'droit-addons-pro' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'droit-addons-pro' ),
			],
			'selector_value' => 'background-repeat: {{VALUE}};',
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
			],
		];

		$fields['size'] = [
			'label' => esc_html__( 'Size', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'responsive' => true,
			'default' => '',
			'options' => [
				'' => esc_html__( 'Default', 'droit-addons-pro' ),
				'auto' => esc_html__( 'Auto', 'droit-addons-pro' ),
				'cover' => esc_html__( 'Cover', 'droit-addons-pro' ),
				'contain' => esc_html__( 'Contain', 'droit-addons-pro' ),
				'initial' => esc_html__( 'Custom', 'droit-addons-pro' ),
			],
			'selector_value' => 'background-size: {{VALUE}};',
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
			],
		];

		$fields['bg_width'] = [
			'label' => esc_html__( 'Width', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vw' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
				'vw' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default' => [
				'size' => 100,
				'unit' => '%',
			],
			'required' => true,
			'selector_value' => 'background-size: {{SIZE}}{{UNIT}} auto',
			'condition' => [
				'background' => [ 'classic' ],
				'size' => [ 'initial' ],
				'image[url]!' => '',
			],
			'device_args' => [
				\Elementor\Controls_Stack::RESPONSIVE_TABLET => [
					'selector_value' => 'background-size: {{SIZE}}{{UNIT}} auto',
					'condition' => [
						'background' => [ 'classic' ],
						'size_tablet' => [ 'initial' ],
					],
				],
				\Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
					'selector_value' => 'background-size: {{SIZE}}{{UNIT}} auto',
					'condition' => [
						'background' => [ 'classic' ],
						'size_mobile' => [ 'initial' ],
					],
				],
			],
		];
		$fields['button_border_color'] = [
			'label' => esc_html__( 'Border Color', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '',
			'selector_value' => 'border-color: {{VALUE}};',
		];

		$fields['button_transition'] = [
			'label' => esc_html__( 'Transition Duration', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'range' => [
				'px' => [
					'max' => 10,
					'step' => 0.1,
				],
			],
			'render_type' => 'ui',
			'selector_value' => 'transition: {{SIZE}}s',
		];
		$fields['allow_box_shadow'] = [
			'label' => esc_html__( 'Shadow', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'droit-addons-pro' ),
			'label_off' => esc_html__( 'No', 'droit-addons-pro' ),
			'return_value' => 'yes',
			'separator' => 'before',
			'render_type' => 'ui',
		];

		$fields['button_shadow'] = [
			'label'     => esc_html__( 'Button Shadow', 'droit-addons-pro' ),
			'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
			'condition' => [
				'allow_box_shadow!' => '',
			],
			'selector_value' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{button_shadow_position.VALUE}};',
		];

		$fields['button_shadow_position'] = [
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

				if ( in_array( $field_name, [ 'hover_normal', 'popover_toggle' ] ) ) {
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
				'starter_name' => 'hover_normal',
				'starter_title' => esc_html__( 'Hover Setting', 'droit-addons-pro' ),
				'settings' => [
					'render_type' => 'ui',
					'groupType' => 'hover_normal',
					'global' => [
						'active' => true,
					],
				],
			],
		];
	}
}
