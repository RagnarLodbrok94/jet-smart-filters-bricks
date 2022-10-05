<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Color_Image extends Jet_Smart_Filters_Bricks_Base {
	// Element properties
	public $category = 'jetsmartfilters'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-color-image'; // Make sure to prefix your elements
	public $icon = 'jet-smart-filters-icon-color-image-filter'; // Themify icon font class
	public $css_selector = '.jet-smart-filters-color-image'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'color-image';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Visual Filter', 'jet-smart-filters' );
	}

	public function register_filter_settings_controls( $name ) {
		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_display_options',
					[
						'title' => esc_html__( 'Filter Options', 'jet-smart-filters' ),
						'tab'   => 'content',
					]
				);

				$this->register_jet_control_group(
					'additional_settings',
					[
						'title' => esc_html__( 'Additional Settings', 'jet-smart-filters' ),
						'tab'   => 'content',
					]
				);

				break;

			case 'controls':
				$this->start_jet_control_group( 'section_display_options' );

				$this->register_jet_control(
					'show_items_label',
					[
						'tab'     => 'content',
						'label'   => esc_html__( 'Show items label', 'jet-smart-filters' ),
						'type'    => 'checkbox',
						'default' => true,
					]
				);

				$this->register_jet_control(
					'filter_image_size',
					[
						'tab'     => 'content',
						'label'   => esc_html__( 'Image Size', 'jet-smart-filters' ),
						'type'    => 'select',
						'options' => jet_smart_filters()->utils->get_image_sizes(),
						'default' => 'full',
					]
				);

				$this->end_jet_control_group();

				// Include Additional Filter Settings
				include jet_smart_filters_bricks()->plugin_path( 'includes/bricks-views/elements/common-controls/additional-filter-settings.php' );

				break;
		}
	}

	public function register_filter_style_controls( $name ) {

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/color-image/css-scheme',
			array(
				'item'                 => '.jet-color-image-list__row',
				'button'               => '.jet-color-image-list__button',
				'label'                => '.jet-color-image-list__label',
				'decorator'            => '.jet-color-image-list__decorator',
				'list-item'            => '.jet-color-image-list__row',
				'list-wrapper'         => '.jet-color-image-list-wrapper',
				'filter'               => '.jet-filter',
				'filters-label'        => '.jet-filter-label',
				'apply-filters'        => '.apply-filters',
				'apply-filters-button' => '.apply-filters__button',
			)
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
					'section_color_image_style',
					[
						'title' => esc_html__( $this->get_label() . ': Color / Image', 'jet-smart-filters' ),
						'tab'   => 'style',
					]
				);

				break;

			case 'controls':
				$this->start_jet_control_group( 'section_items_style' );

				$this->register_jet_control(
					'filters_direction',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Direction', 'jet-smart-filters' ),
						'type'  => 'direction',
						'css'   => [
							[
								'property' => 'flex-direction',
								'selector' => $css_scheme['list-wrapper'],
							],
						],
					]
				);

				$this->register_jet_control(
					'filters_align_main_axis',
					[
						'tab'      => 'style',
						'label'    => esc_html__( 'Align main axis', 'jet-smart-filters' ),
						'type'     => 'justify-content',
						'exclude'  => [
							'space-between',
							'space-around',
							'space-evenly',
						],
						'css'      => [
							[
								'property' => 'justify-content',
								'selector' => $css_scheme['list-wrapper'],
							],
						],
						'required' => [ 'filters_direction', '=', 'row' ],
					]
				);

				$this->register_jet_control(
					'filters_gap',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Gap', 'jet-smart-filters' ),
						'type'  => 'slider',
						'units' => [
							'px' => [
								'min' => 0,
								'max' => 40,
							],
						],
						'css'   => [
							[
								'property' => 'gap',
								'selector' => $css_scheme['list-wrapper'],
							],
						],
					]
				);

				$this->end_jet_control_group();

				$this->start_jet_control_group( 'section_item_style' );

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
					'item_bg',
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
					'item_checked_heading',
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
								'selector' => '.jet-color-image-list__input:checked ~ ' . $css_scheme['button'] . ' ' . $css_scheme['label'],
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
								'selector' => '.jet-color-image-list__input:checked ~ ' . $css_scheme['button'],
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
								'selector' => '.jet-color-image-list__input:checked ~ ' . $css_scheme['button'],
							]
						],
						'required' => [ 'item_border', '!=', '' ],
					]
				);

				$this->end_jet_control_group();

				$this->start_jet_control_group( 'section_color_image_style' );

				$this->register_jet_control(
					'color_image_size',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Size', 'jet-smart-filters' ),
						'type'    => 'slider',
						'units'   => [
							'px' => [
								'min' => 0,
								'max' => 400,
							],
						],
						'default' => '32px',
						'css'     => [
							[
								'property' => 'width',
								'selector' => $css_scheme['decorator'] . ' > *',
							],
							[
								'property' => 'height',
								'selector' => $css_scheme['decorator'] . ' .jet-color-image-list__color',
							],
						],
					]
				);

				$this->register_jet_control(
					'color_image_gap',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Gap', 'jet-smart-filters' ),
						'type'    => 'slider',
						'units'   => [
							'px' => [
								'min' => 0,
								'max' => 40,
							],
						],
						'default' => '12px',
						'css'     => [
							[
								'property' => 'gap',
								'selector' => $css_scheme['button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'color_image_border',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border', 'jet-smart-filters' ),
						'type'  => 'border',
						'css'   => [
							[
								'property' => 'border',
								'selector' => $css_scheme['decorator'] . ' > *',
							],
						],
					]
				);

				$this->register_jet_control(
					'color_image_checked_heading',
					[
						'tab'   => 'style',
						'type'  => 'separator',
						'label' => esc_html__( 'Checked State', 'jet-smart-filters' ),
						'required' => [ 'color_image_border', '!=', '' ],
					]
				);

				$this->register_jet_control(
					'color_image_checked_border_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'border-color',
								'selector' => '.jet-color-image-list__input:checked ~ ' . $css_scheme['button'] . ' ' . $css_scheme['decorator'] . ' > *',
							]
						],
						'required' => [ 'color_image_border', '!=', '' ],
					]
				);

				$this->end_jet_control_group();

				break;
		}
	}

	public function parse_jet_render_attributes( $attrs = [] ) {

		$attrs['show_items_label'] = $attrs['show_items_label'] ?? false;

		return $attrs;
	}
}