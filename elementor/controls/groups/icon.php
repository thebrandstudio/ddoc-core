<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Icon extends \Elementor\Group_Control_Base {

	
	protected static $fields;
	
	private static $_scheme_fields_keys = [ 'font_family', 'font_weight' ];

	public static function get_scheme_fields_keys() {
		return self::$_scheme_fields_keys;
	}
	public static function get_type() {
		return 'droit-icon';
	}

	protected function init_fields() {
		$fields = [];
		$fields['icon_color'] = [
			'label' => esc_html__( 'Color', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '',
			'selector_value' => 'color: {{VALUE}};',
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
			'size_units' => [ 'px', 'em'],
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
		$fields['icon_horizontal'] = [
			'label' => esc_html__( 'Horizontal', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => ['px', '%'],
			'range' => [
				'px' => [
					'min' => -1000,
					'max' => 1000,
				],
				'%' => [
					'min' => -1000,
					'max' => 1000,
				],
				'em' => [
					'min' => -1000,
					'max' => 1000,
				],
				'rem' => [
					'min' => -1000,
					'max' => 1000,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => '',
			],
			'responsive' => true,
			'render_type' => 'ui',
			'seperator' => 'before',
			'of_type' => 'icon_horizontal',
		];
		$fields['icon_vertical'] = [
			'label' => esc_html__( 'Vertical', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => ['px', '%', 'em', 'rem'],
			'range' => [
				'px' => [
					'min' => -1000,
					'max' => 1000,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => '0',
			],
			'responsive' => true,
			'render_type' => 'ui',
			'selector_value' => 'transform: translate({{SIZE}}{{UNIT}}, {{icon_horizontal.SIZE}}{{icon_horizontal.UNIT}});',
		];
		$fields['allow_box_shadow'] = [
			'label' => esc_html__( 'Icon Shadow', 'droit-addons-pro' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'droit-addons-pro' ),
			'label_off' => esc_html__( 'No', 'droit-addons-pro' ),
			'return_value' => 'yes',
			'separator' => 'before',
			'render_type' => 'ui',
		];
		
		$fields['icon_shadow'] = [
			'label'     => esc_html__( 'Icon Shadow', 'droit-addons-pro' ),
			'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
			'condition' => [
				'allow_box_shadow!' => '',
			],
			'selector_value' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{icon_shadow_position.VALUE}};',
		];

		$fields['icon_shadow_position'] = [
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
		$field_args['groupType'] = 'icon_setting';

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
				'starter_name' => 'icon_setting',
				'starter_title' => esc_html__( 'Icon Setting', 'droit-addons-pro' ),
				'settings' => [
					'render_type' => 'ui',
					'groupType' => 'icon_setting',
					'global' => [
						'active' => true,
					],
				],
			],
		];
	}
}
