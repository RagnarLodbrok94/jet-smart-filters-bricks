<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Check_Range extends Jet_Smart_Filters_Bricks_Base {
	// Element properties
	public $category = 'jetsmartfilters'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-check-range'; // Make sure to prefix your elements
	public $icon = 'jet-smart-filters-icon-check-range-filter'; // Themify icon font class
	public $css_selector = '.jet-smart-filters-check-range'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'check-range';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Check Range Filter', 'jet-smart-filters' );
	}

	public function register_filter_settings_controls( $name ) {
		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'additional_settings',
					[
						'title' => esc_html__( 'Additional Settings', 'jet-smart-filters' ),
						'tab'   => 'content',
					]
				);

				break;

			case 'controls':
				// Include Additional Filter Settings
				include jet_smart_filters_bricks()->plugin_path( 'includes/bricks-views/elements/common-controls/additional-filter-settings.php' );
				break;
		}
	}

	public function register_filter_style_controls( $name ) {

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/check-range/css-scheme',
			[
				'item'                  => '.jet-checkboxes-list__row',
				'button'                => '.jet-checkboxes-list__button',
				'label'                 => '.jet-checkboxes-list__label',
				'checkbox'              => '.jet-checkboxes-list__decorator',
				'checkbox-checked-icon' => '.jet-checkboxes-list__checked-icon',
				'list-item'             => '.jet-checkboxes-list__row',
				'list-wrapper'          => '.jet-checkboxes-list-wrapper',
				'list-children'         => '.jet-list-tree__children',
			]
		);

		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_items_style',
					[
						'title' => esc_html__( $this->get_label() . ': Items', 'jet-smart-filters' ),
						'tab'   => 'style',
					]
				);

				$this->register_jet_control_group(
					'section_item_style',
					[
						'title' => esc_html__( $this->get_label() . ': Item', 'jet-smart-filters' ),
						'tab'   => 'style',
					]
				);

				$this->register_jet_control_group(
					'section_checkbox_style',
					[
						'title' => esc_html__( $this->get_label() . ': Checkbox', 'jet-smart-filters' ),
						'tab'   => 'style',
						'required' => [ 'show_decorator', '=', true ],
					]
				);

				$this->register_jet_control_group(
					'search_items_style_section',
					[
						'title'    => esc_html__( $this->get_label() . ': Search Items', 'jet-smart-filters' ),
						'tab'      => 'style',
						'required' => [ 'search_enabled', '=', true ],
					]
				);

				$this->register_jet_control_group(
					'more_less_style_section',
					[
						'title'    => esc_html__( $this->get_label() . ': More Less Toggle', 'jet-smart-filters' ),
						'tab'      => 'style',
						'required' => [ 'moreless_enabled', '=', true ],
					]
				);

				$this->register_jet_control_group(
					'dropdown_style_section',
					[
						'title'    => esc_html__( $this->get_label() . ': Dropdown', 'jet-smart-filters' ),
						'tab'      => 'style',
						'required' => [ 'dropdown_enabled', '=', true ],
					]
				);

				break;

			case 'controls':
				$this->start_jet_control_group( 'section_items_style' );

				$this->register_horizontal_layout_controls( $css_scheme );

				$this->end_jet_control_group();

				$this->start_jet_control_group( 'section_item_style' );

				$this->register_jet_control(
					'show_decorator',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Show Checkbox', 'jet-smart-filters' ),
						'type'    => 'checkbox',
						'default' => true,
					]
				);

				$this->register_jet_control(
					'item_typography',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Typography', 'jet-smart-filters' ),
						'type'  => 'typography',
						'css'   => [
							[
								'property' => 'typography',
								'selector' => $css_scheme['label'],
							],
						],
					]
				);

				$this->register_jet_control(
					'item_normal_bg_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Background color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'background-color',
								'selector' => $css_scheme['button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'item_padding',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Padding', 'jet-smart-filters' ),
						'type'  => 'dimensions',
						'css'   => [
							[
								'property' => 'padding',
								'selector' => $css_scheme['button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'item_border',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border', 'jet-smart-filters' ),
						'type'  => 'border',
						'css'   => [
							[
								'property' => 'border',
								'selector' => $css_scheme['button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'item_box_shadow',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Box shadow', 'jet-smart-filters' ),
						'type'  => 'box-shadow',
						'css'   => [
							[
								'property' => 'box-shadow',
								'selector' => $css_scheme['button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'item_checked_styles',
					[
						'tab'   => 'style',
						'type'  => 'separator',
						'label' => esc_html__( 'Checked State', 'jet-smart-filters' ),
					]
				);

				$this->register_jet_control(
					'item_checked_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'color',
								'selector' => '.jet-checkboxes-list__input:checked ~ ' . $css_scheme['button'] . ' ' . $css_scheme['label'],
							]
						],
					]
				);

				$this->register_jet_control(
					'item_checked_bg_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Background color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'background-color',
								'selector' => '.jet-checkboxes-list__input:checked ~ ' . $css_scheme['button'],
							]
						],
					]
				);

				$this->register_jet_control(
					'item_checked_border_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'border-color',
								'selector' => '.jet-checkboxes-list__input:checked ~ ' . $css_scheme['button'],
							]
						],
					]
				);

				$this->end_jet_control_group();

				$this->start_jet_control_group( 'section_checkbox_style' );

				$this->register_jet_control(
					'checkbox_size',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Box Size', 'jet-smart-filters' ),
						'type'    => 'slider',
						'units'   => [
							'px' => [
								'min' => 6,
								'max' => 60,
							],
						],
						'default' => '16px',
						'css'     => [
							[
								'property' => 'width',
								'selector' => $css_scheme['checkbox'],
							],
							[
								'property' => 'height',
								'selector' => $css_scheme['checkbox'],
							],
						],
					]
				);

				$this->register_jet_control(
					'checkbox_icon_size',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Icon Size', 'jet-smart-filters' ),
						'type'    => 'slider',
						'units'   => [
							'px' => [
								'min' => 6,
								'max' => 60,
							],
						],
						'default' => '16px',
						'css'     => [
							[
								'property' => 'font-size',
								'selector' => $css_scheme['checkbox-checked-icon'],
							],
						],
					]
				);

				$this->register_jet_control(
					'checkbox_offset',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Gap', 'jet-smart-filters' ),
						'type'    => 'slider',
						'units'   => [
							'px' => [
								'min' => 0,
								'max' => 60,
							],
						],
						'default' => '12px',
						'css'     => [
							[
								'property' => 'margin-right',
								'selector' => $css_scheme['checkbox'],
							],
						],
					]
				);

				$this->register_jet_control(
					'checkbox_align-v',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Vertical Alignment', 'jet-smart-filters' ),
						'type'    => 'align-items',
						'default' => 'center',
						'css'     => [
							[
								'property' => 'align-self',
								'selector' => $css_scheme['checkbox'],
							],
						],
					]
				);

				$this->register_jet_control(
					'checkbox_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Icon Color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'color',
								'selector' => $css_scheme['checkbox-checked-icon'],
							]
						],
					]
				);

				$this->register_jet_control(
					'checkbox_bg_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Background color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'background-color',
								'selector' => $css_scheme['checkbox'],
							]
						],
					]
				);

				$this->register_jet_control(
					'checkbox_border',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border', 'jet-smart-filters' ),
						'type'  => 'border',
						'css'   => [
							[
								'property' => 'border',
								'selector' => $css_scheme['checkbox'],
							],
						],
					]
				);

				$this->register_jet_control(
					'checkbox_checked_styles',
					[
						'tab'   => 'style',
						'type'  => 'separator',
						'label' => esc_html__( 'Checked State', 'jet-smart-filters' ),
					]
				);

				$this->register_jet_control(
					'checkbox_checked_bg_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Background color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'background-color',
								'selector' => '.jet-checkboxes-list__input:checked ~ ' . $css_scheme['button'] . ' ' . $css_scheme['checkbox'],
							]
						],
					]
				);

				$this->register_jet_control(
					'checkbox_checked_border_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'border-color',
								'selector' => '.jet-checkboxes-list__input:checked ~ ' . $css_scheme['button'] . ' ' . $css_scheme['checkbox'],
							]
						],
					]
				);

				$this->end_jet_control_group();

				// Include Additional Filter Settings Style
				include jet_smart_filters_bricks()->plugin_path( 'includes/bricks-views/elements/common-controls/additional-filter-style.php' );

				break;
		}
	}

	public function parse_jet_render_attributes( $attrs = [] ) {
		$attrs['show_decorator'] = $attrs['show_decorator'] ?? false;

		return $attrs;
	}
}