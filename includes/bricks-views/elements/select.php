<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Select extends Jet_Smart_Filters_Bricks_Base {
	// Element properties
	public $category = 'general'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-select'; // Make sure to prefix your elements
	public $icon = 'ti-filter'; // Themify icon font class
	public $css_selector = '.jet-smart-filters-select'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'select';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Select Filter', 'jet-smart-filters' );
	}

	public function register_filter_style_controls( $name ) {

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/select/css-scheme',
			[
				'filter' => '.jet-select',
				'select' => '.jet-select__control',
			]
		);

		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_content_style',
					[
						'title' => esc_html__( $this->get_label() . ': Content', 'jet-smart-filters' ),
						'tab'   => 'style',
					]
				);

				$this->register_jet_control_group(
					'section_select_style',
					[
						'title' => esc_html__( $this->get_label() . ': Select', 'jet-smart-filters' ),
						'tab'   => 'style',
					]
				);
				break;

			case 'controls':
				$this->start_jet_control_group( 'section_content_style' );

				$this->register_jet_control(
					'content_position',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Direction', 'jet-smart-filters' ),
						'type'    => 'select',
						'options' => [
							'flex'  => esc_html__( 'Line', 'jet-smart-filters' ),
							'block' => esc_html__( 'Columns', 'jet-smart-filters' ),
						],
						'default' => 'block',
						'css'     => [
							[
								'property' => 'display',
								'selector' => '.jet-smart-filters-select' . ', .jet-smart-filters-hierarchy ' . $css_scheme['filter'],
							],
						],
					]
				);

				$this->register_jet_control(
					'content_alignment',
					[
						'tab'      => 'style',
						'label'    => esc_html__( 'Alignment', 'jet-smart-filters' ),
						'type'     => 'align-items',
						'css'      => [
							[
								'property' => 'align-items',
								'selector' => '.jet-smart-filters-select' . ', .jet-smart-filters-hierarchy ' . $css_scheme['filter'],
							],
						],
						'required' => [ 'content_position', '=', 'flex' ],
					]
				);

				$this->end_jet_control_group();

				$this->start_jet_control_group( 'section_select_style' );

				$this->register_jet_control(
					'select_width',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Select Width', 'jet-smart-filters' ),
						'type'    => 'slider',
						'units'   => [
							'%'  => [
								'min' => 10,
								'max' => 100,
							],
							'px' => [
								'min' => 50,
								'max' => 400,
							],
						],
						'default' => '',
						'css'     => [
							[
								'property' => 'max-width',
								'selector' => '.jet-smart-filters-select ' . $css_scheme['filter'] . ', .jet-smart-filters-hierarchy ' . $css_scheme['select'],
							],
							[
								'property' => 'flex-basis',
								'selector' => '.jet-smart-filters-select ' . $css_scheme['filter'] . ', .jet-smart-filters-hierarchy ' . $css_scheme['select'],
							],
						],
					]
				);

				$this->register_jet_control(
					'select_typography',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Typography', 'jet-smart-filters' ),
						'type'  => 'typography',
						'css'   => [
							[
								'property' => 'typography',
								'selector' => $css_scheme['select'],
							],
						],
					]
				);

				$this->register_jet_control(
					'select_bg_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Background color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'background-color',
								'selector' => $css_scheme['select'],
							],
						],
					]
				);

				$this->register_jet_control(
					'select_padding',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Padding', 'jet-smart-filters' ),
						'type'  => 'dimensions',
						'css'   => [
							[
								'property' => 'padding',
								'selector' => $css_scheme['select'],
							],
						],
					]
				);

				$this->register_jet_control(
					'select_border',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border', 'jet-smart-filters' ),
						'type'  => 'border',
						'css'   => [
							[
								'property' => 'border',
								'selector' => $css_scheme['select'],
							],
						],
					]
				);

				$this->register_jet_control(
					'select_box_shadow',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Box shadow', 'jet-smart-filters' ),
						'type'  => 'box-shadow',
						'css'   => [
							[
								'property' => 'box-shadow',
								'selector' => $css_scheme['select'],
							],
						],
					]
				);

				$this->end_jet_control_group();
				break;
		}
	}
}