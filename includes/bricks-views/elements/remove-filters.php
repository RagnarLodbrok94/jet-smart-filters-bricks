<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Remove_Filters extends \Jet_Engine\Bricks_Views\Elements\Base {
	// Element properties
	public $category = 'general'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-remove-filters'; // Make sure to prefix your elements
	public $icon = 'ti-filter'; // Themify icon font class
	public $css_selector = '.jet-smart-filters-remove-filters'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'remove-filters';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Remove Filters', 'jet-smart-filters' );
	}

	// Set builder control groups
	public function set_control_groups() {

		$this->register_jet_control_group(
			'section_general',
			[
				'title' => esc_html__( 'Content', 'jet-smart-filters' ),
				'tab'   => 'content',
			]
		);

		$this->register_jet_control_group(
			'section_remove_filters_button_style',
			[
				'title' => esc_html__( $this->get_label() . 'Button', 'jet-smart-filters' ),
				'tab'   => 'style',
			]
		);
	}

	// Set builder controls
	public function set_controls() {

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/remove-filters/css-scheme',
			array(
				'filter'               => '.jet-filter',
				'remove-filters'        => '.jet-remove-all-filters',
				'remove-filters-button' => '.jet-remove-all-filters__button',
			)
		);

		$this->start_jet_control_group( 'section_general' );

		$this->register_jet_control(
			'content_provider',
			[
				'tab'     => 'content',
				'label'   => esc_html__( 'This filter for', 'jet-smart-filters' ),
				'type'    => 'select',
				'options' => jet_smart_filters()->data->content_providers(),
			]
		);

		$this->register_jet_control(
			'apply_type',
			[
				'tab'     => 'content',
				'label'   => esc_html__( 'Apply type', 'jet-smart-filters' ),
				'type'    => 'select',
				'options' => [
					'ajax'   => esc_html__( 'AJAX', 'jet-smart-filters' ),
					'reload' => esc_html__( 'Page reload', 'jet-smart-filters' ),
					'mixed'  => esc_html__( 'Mixed', 'jet-smart-filters' ),
				],
				'default' => 'ajax',
			]
		);

		$this->register_jet_control(
			'remove_filters_text',
			[
				'tab'            => 'content',
				'label'          => esc_html__( 'Remove button text', 'jet-smart-filters' ),
				'type'           => 'text',
				'hasDynamicData' => false,
				'default'        => esc_html__( 'Remove filters', 'jet-smart-filters' ),
			]
		);

		$this->register_jet_control(
			'query_id',
			[
				'tab'            => 'content',
				'label'          => esc_html__( 'Query ID', 'jet-smart-filters' ),
				'type'           => 'text',
				'hasDynamicData' => false,
				'description'    => esc_html__( 'Set unique query ID if you use multiple widgets of same provider on the page. Same ID you need to set for filtered widget.', 'jet-smart-filters' ),
			]
		);

		// Include Additional Providers Settings
		include jet_smart_filters_bricks()->plugin_path( 'includes/bricks-views/elements/common-controls/additional-providers.php' );

		$this->end_jet_control_group();

		$this->start_jet_control_group( 'section_remove_filters_button_style' );

		$this->register_jet_control(
			'remove_filters_button_typography',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Typography', 'jet-smart-filters' ),
				'type'  => 'typography',
				'css'   => [
					[
						'property' => 'typography',
						'selector' => $css_scheme['remove-filters-button'],
					],
				],
			]
		);

		$this->register_jet_control(
			'remove_filters_button_bg_color',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Background color', 'jet-smart-filters' ),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'background-color',
						'selector' => $css_scheme['remove-filters-button'],
					],
				],
			]
		);

		$this->register_jet_control(
			'remove_filters_button_margin',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Margin', 'jet-smart-filters' ),
				'type'  => 'dimensions',
				'css'   => [
					[
						'property' => 'margin',
						'selector' => $css_scheme['remove-filters-button'],
					],
				],
			]
		);

		$this->register_jet_control(
			'remove_filters_button_padding',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Padding', 'jet-smart-filters' ),
				'type'  => 'dimensions',
				'css'   => [
					[
						'property' => 'padding',
						'selector' => $css_scheme['remove-filters-button'],
					],
				],
			]
		);

		$this->register_jet_control(
			'remove_filters_button_border',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Border', 'jet-smart-filters' ),
				'type'  => 'border',
				'css'   => [
					[
						'property' => 'border',
						'selector' => $css_scheme['remove-filters-button'],
					],
				],
			]
		);

		$this->register_jet_control(
			'remove_filters_button_box_shadow',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Box shadow', 'jet-smart-filters' ),
				'type'  => 'box-shadow',
				'css'   => [
					[
						'property' => 'box-shadow',
						'selector' => $css_scheme['remove-filters-button'],
					],
				],
			]
		);

		$this->register_jet_control(
			'remove_filters_button_alignment',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Alignment', 'jet-smart-filters' ),
				'type'  => 'align-items',
				'css'   => [
					[
						'property' => 'align-items',
						'selector' => $css_scheme['remove-filters'],
					],
				],
			]
		);

		$this->end_jet_control_group();
	}

	// Render element HTML
	public function render() {

		jet_smart_filters()->set_filters_used();

		$base_class           = $this->name;
		$settings             = $this->parse_jet_render_attributes( $this->get_jet_settings() );
		$provider             = ! empty( $settings['content_provider'] ) ? $settings['content_provider'] : '';
		$query_id             = ! empty( $settings['query_id'] ) ? $settings['query_id'] : 'default';
		$additional_providers = jet_smart_filters()->utils->get_additional_providers( $settings );
		$edit_mode            = bricks_is_builder_call();

		echo "<div {$this->render_attributes( '_root' )}>";

		echo '<div class="' . $base_class . ' jet-filter">';
		include jet_smart_filters()->get_template( 'common/remove-filters.php' );
		echo '</div>';

		echo "</div>";

	}
}