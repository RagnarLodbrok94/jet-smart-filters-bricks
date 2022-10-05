<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Sorting extends Jet_Smart_Filters_Bricks_Base {
	// Element properties
	public $category = 'jetsmartfilters'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-sorting'; // Make sure to prefix your elements
	public $icon = 'jet-smart-filters-icon-sorting-filter'; // Themify icon font class
	public $css_selector = '.jet-smart-filters-sorting'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'sorting';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Sorting Filter', 'jet-smart-filters' );
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

		$this->register_filter_settings_controls( 'group' );

		$this->register_filter_style_controls( 'group' );

		$this->controls_section_filter_label( 'group' );

		$this->base_controls_section_filter_apply_button( 'group' );
	}

	// Set builder controls
	public function set_controls() {

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/sorting/css-scheme',
			array(
				'filter'               => '.jet-sorting',
				'filters-label'        => '.jet-sorting-label',
				'select'               => '.jet-sorting-select',
				'apply-filters'        => '.apply-filters',
				'apply-filters-button' => '.apply-filters__button',
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
			'epro_posts_notice',
			[
				'tab'      => 'content',
				'label'    => esc_html__( 'Please set <b>jet-smart-filters</b> into Query ID option of Posts widget you want to filter', 'jet-smart-filters' ),
				'type'     => 'info',
				'required' => [ 'content_provider', '=', [ 'epro-posts', 'epro-portfolio' ] ],
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
			'apply_on',
			[
				'tab'      => 'content',
				'label'    => esc_html__( 'Apply on', 'jet-smart-filters' ),
				'type'     => 'select',
				'options'  => [
					'value'  => esc_html__( 'Value change', 'jet-smart-filters' ),
					'submit' => esc_html__( 'Click on apply button', 'jet-smart-filters' ),
				],
				'default'  => 'value',
				'required' => [ 'apply_type', '=', [ 'ajax', 'mixed' ] ],
			]
		);

		$this->register_jet_control(
			'apply_button',
			[
				'tab'     => 'content',
				'label'   => esc_html__( 'Show apply button', 'jet-smart-filters' ),
				'type'    => 'checkbox',
				'default' => false,
			]
		);

		$this->register_jet_control(
			'apply_button_text',
			[
				'tab'            => 'content',
				'label'          => esc_html__( 'Apply button text', 'jet-smart-filters' ),
				'type'           => 'text',
				'hasDynamicData' => false,
				'default'        => esc_html__( 'Apply filter', 'jet-smart-filters' ),
				'required'       => [ 'apply_button', '=', true ],
			]
		);

		$this->register_jet_control(
			'label',
			[
				'tab'            => 'content',
				'label'          => esc_html__( 'Label', 'jet-smart-filters' ),
				'type'           => 'text',
				'hasDynamicData' => false,
			]
		);

		$this->register_jet_control(
			'label_block',
			[
				'tab'      => 'content',
				'label'    => esc_html__( 'Label Block', 'jet-smart-filters' ),
				'type'     => 'checkbox',
				'default'  => true,
				'required' => [ 'label', '!=', '' ],
			]
		);

		$this->register_jet_control(
			'placeholder',
			[
				'tab'            => 'content',
				'label'          => esc_html__( 'Placeholder', 'jet-smart-filters' ),
				'type'           => 'text',
				'hasDynamicData' => false,
				'default'        => esc_html__( 'Sort...', 'jet-smart-filters' ),
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

		$this->register_filter_settings_controls( 'controls' );

		$this->register_filter_style_controls( 'controls', $css_scheme );

		$this->controls_section_filter_label( 'controls', $css_scheme );

		$this->base_controls_section_filter_apply_button( 'controls', $css_scheme );
	}

	public function register_filter_style_controls( $name, $css_scheme = null ) {

		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_content_style',
					[
						'title' => esc_html__( $this->get_label() . ': Content', 'jet-smart-filters' ),
						'tab'   => 'style',
						'required' => [ 'label_block', '=', false ],
					]
				);

				$this->register_jet_control_group(
					'section_select_style',
					[
						'title'    => esc_html__( $this->get_label() . ': Select', 'jet-smart-filters' ),
						'tab'      => 'style',
					]
				);
				break;

			case 'controls':
				$this->start_jet_control_group( 'section_content_style' );

				$this->register_jet_control(
					'content_align_main_axis',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Align main axis', 'jet-smart-filters' ),
						'type'  => 'align-items',
						'css'   => [
							[
								'property' => 'align-items',
								'selector' => $css_scheme['filter'],
							],
						],
					]
				);

				$this->register_jet_control(
					'content_align_cross_axis',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Align cross axis', 'jet-smart-filters' ),
						'type'  => 'justify-content',
						'css'   => [
							[
								'property' => 'justify-content',
								'selector' => $css_scheme['filter'],
							],
						],
					]
				);

				$this->end_jet_control_group();

				$this->start_jet_control_group( 'section_select_style' );

				$this->register_jet_control(
					'select_width',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Select Width', 'jet-smart-filters' ),
						'type'  => 'slider',
						'units' => [
							'%'  => [
								'min' => 10,
								'max' => 100,
							],
							'px' => [
								'min' => 50,
								'max' => 400,
							],
						],
						'css'   => [
							[
								'property' => 'max-width',
								'selector' => $css_scheme['select'],
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

	public function controls_section_filter_label( $name, $css_scheme = null ) {
		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_label_style',
					[
						'title'    => esc_html__( $this->get_label() . ': Label', 'jet-smart-filters' ),
						'tab'      => 'style',
						'required' => [ 'label', '!=', '' ],
					]
				);
				break;
			case 'controls':
				$this->start_jet_control_group( 'section_label_style' );

				$this->register_jet_control(
					'label_typography',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Typography', 'jet-smart-filters' ),
						'type'  => 'typography',
						'css'   => [
							[
								'property' => 'typography',
								'selector' => $css_scheme['filters-label'],
							],
						],
					]
				);

				$this->register_jet_control(
					'label_margin',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Margin', 'jet-smart-filters' ),
						'type'  => 'dimensions',
						'css'   => [
							[
								'property' => 'margin',
								'selector' => $css_scheme['filters-label'],
							],
						],
					]
				);

				$this->register_jet_control(
					'label_padding',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Padding', 'jet-smart-filters' ),
						'type'  => 'dimensions',
						'css'   => [
							[
								'property' => 'padding',
								'selector' => $css_scheme['filters-label'],
							],
						],
					]
				);

				$this->register_jet_control(
					'label_border',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border', 'jet-smart-filters' ),
						'type'  => 'border',
						'css'   => [
							[
								'property' => 'border',
								'selector' => $css_scheme['filters-label'],
							],
						],
					]
				);

				$this->end_jet_control_group();

				break;
		}
	}

	public function register_filter_settings_controls( $name ) {
		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_sorting_list',
					[
						'title' => esc_html__( 'Sorting List', 'jet-smart-filters' ),
						'tab'   => 'content',
					]
				);

				break;

			case 'controls':
				$this->start_jet_control_group( 'section_sorting_list' );

				$repeater = new \Jet_Engine\Bricks_Views\Helpers\Repeater();

				$repeater->add_control(
					'title',
					[
						'label'          => esc_html__( 'Title', 'jet-smart-filters' ),
						'type'           => 'text',
						'hasDynamicData' => false,
					]
				);

				$repeater->add_control(
					'orderby',
					[
						'label'   => esc_html__( 'Order By', 'jet-smart-filters' ),
						'type'    => 'select',
						'options' => jet_smart_filters()->filter_types->get_filter_types( $this->jet_element_render )->orderby_options(),
					]
				);

				$repeater->add_control(
					'meta_key',
					[
						'label'          => esc_html__( 'Key', 'jet-smart-filters' ),
						'type'           => 'text',
						'hasDynamicData' => false,
						'required'       => [ 'orderby', '=', [ 'meta_value', 'meta_value_num', 'clause_value' ] ],
					]
				);

				$repeater->add_control(
					'order',
					[
						'label'    => esc_html__( 'Order', 'jet-smart-filters' ),
						'type'     => 'select',
						'options'  => array(
							'ASC'  => esc_html__( 'ASC', 'jet-smart-filters' ),
							'DESC' => esc_html__( 'DESC', 'jet-smart-filters' )
						),
						'required' => [ 'orderby', '!=', [ 'none', 'rand' ] ],
					]
				);

				$this->register_jet_control(
					'sorting_list',
					[
						'tab'           => 'content',
						'label'         => esc_html__( 'Sorting List', 'jet-smart-filters' ),
						'type'          => 'repeater',
						'titleProperty' => 'title',
						'fields'        => $repeater->get_controls(),
						'default'       => [
							[
								'title'   => esc_html__( 'By title from lowest to highest', 'jet-smart-filters' ),
								'orderby' => 'title',
								'order'   => 'ASC'
							],
							[
								'title'   => esc_html__( 'By title from highest to lowest', 'jet-smart-filters' ),
								'orderby' => 'title',
								'order'   => 'DESC'
							],
							[
								'title'   => esc_html__( 'By date from lowest to highest', 'jet-smart-filters' ),
								'orderby' => 'date',
								'order'   => 'ASC'
							],
							[
								'title'   => esc_html__( 'By date from highest to lowest', 'jet-smart-filters' ),
								'orderby' => 'date',
								'order'   => 'DESC'
							],
						],
					]
				);

				$this->end_jet_control_group();
				break;
		}
	}

	// Render element HTML
	public function render() {
		jet_smart_filters()->set_filters_used();

		$settings            = $this->parse_jet_render_attributes( $this->get_jet_settings() );
		$sorting_filter_type = jet_smart_filters()->filter_types->get_filter_types( $this->jet_element_render );
		$sorting_options     = $sorting_filter_type->sorting_options( $settings['sorting_list'] );
		$container_data_atts = $sorting_filter_type->container_data_atts( $settings );
		$placeholder         = ! empty( $settings['placeholder'] ) ? $settings['placeholder'] : esc_html__( 'Sort...', 'jet-smart-filters' );
		$label               = ! empty( $settings['label'] ) ? $settings['label'] : '';

		echo "<div {$this->render_attributes( '_root' )}>";

		include jet_smart_filters()->get_template( 'filters/sorting.php' );
		include jet_smart_filters()->get_template( 'common/apply-filters.php' );

		echo "</div>";

	}

	public function parse_jet_render_attributes( $attrs = [] ) {

		$attrs['label_block'] = $attrs['label_block'] ?? false;

		return $attrs;
	}
}