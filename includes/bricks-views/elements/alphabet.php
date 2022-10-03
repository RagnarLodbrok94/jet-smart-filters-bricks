<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Alphabet extends Jet_Smart_Filters_Bricks_Base {
	// Element properties
	public $category = 'general'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-alphabet'; // Make sure to prefix your elements
	public $icon = 'ti-filter'; // Themify icon font class
	public $css_selector = '.jet-smart-filters-alphabet'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'alphabet';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Alphabet filter', 'jet-smart-filters' );
	}

	public function register_filter_style_controls( $name ) {

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/alphabet/css-scheme',
			array(
				'list-wrapper' => '.jet-alphabet-list__wrapper',
				'list-item'    => '.jet-alphabet-list__row',
				'item'         => '.jet-alphabet-list__item',
				'button'       => '.jet-alphabet-list__button',
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

				break;

			case 'controls':

				$this->start_jet_control_group( 'section_items_style' );

				$this->register_jet_control(
					'items_gap',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Gap', 'jet-smart-filters' ),
						'type'  => 'slider',
						'units' => [
							'px' => [
								'min' => 0,
								'max' => 50,
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

				$this->register_jet_control(
					'items_align',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Alignment', 'jet-smart-filters' ),
						'type'    => 'justify-content',
						'exclude' => [
							'space-between',
							'space-around',
							'space-evenly',
						],
						'css'     => [
							[
								'property' => 'justify-content',
								'selector' => $css_scheme['list-wrapper'],
							],
						],
					]
				);

				$this->end_jet_control_group();

				$this->start_jet_control_group( 'section_item_style' );

				$this->register_jet_control(
					'item_min_width',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Min Width', 'jet-smart-filters' ),
						'type'  => 'slider',
						'units' => [
							'px' => [
								'min' => 0,
								'max' => 200,
							],
						],
						'css'   => [
							[
								'property' => 'min-width',
								'selector' => $css_scheme['button'],
							],
						],
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
								'selector' => $css_scheme['button'],
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
								'selector' => '.jet-alphabet-list__input:checked ~ ' . $css_scheme['button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'item_checked_bg',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Background color', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'background-color',
								'selector' => '.jet-alphabet-list__input:checked ~ ' . $css_scheme['button'],
							],
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
								'selector' => '.jet-alphabet-list__input:checked ~ ' . $css_scheme['button'],
							],
						],
					]
				);

				$this->end_jet_control_group();

				break;
		}
	}
}