<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Base extends \Jet_Engine\Bricks_Views\Elements\Base {
	public $jet_element_render = 'base';

	// Set builder control groups
	public function set_control_groups() {

		$this->register_jet_control_group(
			'section_general',
			[
				'title' => esc_html__( 'Content', 'jet-smart-filters' ),
				'tab'   => 'content',
			]
		);

		$this->register_filter_style_controls( 'group' );

		$this->base_controls_section_filter_label( 'group' );

		$this->base_controls_section_filter_apply_button( 'group' );

		$this->base_controls_section_filter_group( 'group' );

	}

	// Set builder controls
	public function set_controls() {

		$this->start_jet_control_group( 'section_general' );

		$this->register_jet_control(
			'filter_id',
			$this->get_filter_control_settings()
		);

		$this->register_jet_control(
			'content_provider',
			[
				'tab'     => 'content',
				'label'   => esc_html__( 'Pagination for:', 'jet-smart-filters' ),
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
				'tab'      => 'content',
				'label'    => esc_html__( 'Apply button text', 'jet-smart-filters' ),
				'type'     => 'text',
				'default'  => esc_html__( 'Apply filter', 'jet-smart-filters' ),
				'required' => [ 'apply_button', '=', true ],
			]
		);

		$this->register_jet_control(
			'show_label',
			[
				'tab'     => 'content',
				'label'   => esc_html__( 'Show filter label', 'jet-smart-filters' ),
				'type'    => 'checkbox',
				'default' => false,
			]
		);

		$this->register_jet_control(
			'query_id',
			[
				'tab'         => 'content',
				'label'       => esc_html__( 'Query ID', 'jet-smart-filters' ),
				'type'        => 'text',
				'description' => esc_html__( 'Set unique query ID if you use multiple widgets of same provider on the page. Same ID you need to set for filtered widget.', 'jet-smart-filters' ),
			]
		);

		// Include Additional Providers Settings
		include jet_smart_filters_bricks()->plugin_path( 'includes/bricks-views/elements/common-controls/additional-providers.php' );

		$this->end_jet_control_group();

		$this->register_filter_settings_controls();

		$this->register_filter_style_controls( 'controls' );

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/base/css-scheme',
			[
				'filter'               => '.jet-filter',
				'filters-label'        => '.jet-filter-label',
				'apply-filters'        => '.apply-filters',
				'apply-filters-button' => '.apply-filters__button',
			]
		);

		$this->base_controls_section_filter_label( 'controls', $css_scheme );

		$this->base_controls_section_filter_apply_button( 'controls', $css_scheme );

		$this->base_controls_section_filter_group( 'controls', $css_scheme );

	}

	/**
	 * Returns filter control settings
	 *
	 * @return array
	 */
	public function get_filter_control_settings() {
		return [
			'label'       => esc_html__( 'Select filter', 'jet-smart-filters' ),
			'type'        => 'select',
			'placeholder' => esc_html__( 'Select...', 'jet-smart-filters' ),
			'multiple'    => true,
			'options'     => jet_smart_filters()->data->get_filters_by_type( $this->jet_element_render ),
		];
	}

	/**
	 * Returns widget filter type
	 */
	public function get_widget_fiter_type() {
		return str_replace( 'jet-smart-filters-', '', $this->name );
	}

	public function base_controls_section_filter_label( $name, $css_scheme = null ) {
		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_label_style',
					[
						'title' => esc_html__( $this->get_label() . ': Label', 'jet-smart-filters' ),
						'tab'   => 'style',
						'required' => [ 'show_label', '=', true ],
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

	public function base_controls_section_filter_apply_button( $name, $css_scheme = null ) {
		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_filter_apply_button_style',
					[
						'title' => esc_html__( $this->get_label() . ': Button', 'jet-smart-filters' ),
						'tab'   => 'style',
						'required' => [ 'apply_button', '=', true ],
					]
				);
				break;
			case 'controls':
				$this->start_jet_control_group( 'section_filter_apply_button_style' );

				$this->register_jet_control(
					'filter_apply_button_typography',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Typography', 'jet-smart-filters' ),
						'type'  => 'typography',
						'css'   => [
							[
								'property' => 'typography',
								'selector' => $css_scheme['apply-filters-button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_background_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Background', 'jet-smart-filters' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'background-color',
								'selector' => $css_scheme['apply-filters-button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_alignment',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Alignment', 'jet-smart-filters' ),
						'type'  => 'align-items',
						'css'   => [
							[
								'property' => 'align-items',
								'selector' => $css_scheme['apply-filters'],
							],
							[
								'property' => 'align-self',
								'selector' => $css_scheme['apply-filters-button'],
								'value'    => 'auto',
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_margin',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Margin', 'jet-smart-filters' ),
						'type'  => 'dimensions',
						'css'   => [
							[
								'property' => 'margin',
								'selector' => $css_scheme['apply-filters-button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_padding',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Padding', 'jet-smart-filters' ),
						'type'  => 'dimensions',
						'css'   => [
							[
								'property' => 'padding',
								'selector' => $css_scheme['apply-filters-button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_border',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Border', 'jet-smart-filters' ),
						'type'  => 'border',
						'css'   => [
							[
								'property' => 'border',
								'selector' => $css_scheme['apply-filters-button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_box_shadow',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Box shadow', 'jet-smart-filters' ),
						'type'  => 'box-shadow',
						'css'   => [
							[
								'property' => 'box-shadow',
								'selector' => $css_scheme['apply-filters-button'],
							],
						],
					]
				);

				$this->end_jet_control_group();

				break;
		}
	}

	public function base_controls_section_filter_group( $name, $css_scheme = null ) {
		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_group_filters_style',
					[
						'title' => esc_html__( $this->get_label() . ': Grouped Filters', 'jet-smart-filters' ),
						'tab'   => 'style',
					]
				);
				break;
			case 'controls':
				$this->start_jet_control_group( 'section_group_filters_style' );

				$this->register_jet_control(
					'group_filters_content_position',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Direction', 'jet-smart-filters' ),
						'type'  => 'direction',
						'css'   => [
							[
								'property' => 'flex-direction',
								'selector' => '.jet-filters-group',
							],
							[
								'property' => 'display',
								'selector' => '.jet-filters-group',
								'value'    => 'flex',
							],
						],
					]
				);

				$this->register_jet_control(
					'group_filters_align_main_axis',
					[
						'tab'      => 'style',
						'label'    => esc_html__( 'Align main axis', 'jet-smart-filters' ),
						'type'     => 'justify-content',
						'css'      => [
							[
								'property' => 'justify-content',
								'selector' => '.jet-filters-group',
							],
						],
						'required' => [ 'group_filters_content_position', '=', 'row' ],
					]
				);

				$this->register_jet_control(
					'group_filters_wrap',
					[
						'tab'      => 'style',
						'label'    => esc_html__( 'Flex wrap', 'bricks' ),
						'type'     => 'select',
						'options'  => [
							'nowrap' => esc_html__( 'No wrap', 'jet-smart-filters' ),
							'wrap'   => esc_html__( 'Wrap', 'jet-smart-filters' ),
						],
						'default'  => 'nowrap',
						'css'      => [
							[
								'property' => 'flex-wrap',
								'selector' => '.jet-filters-group',
							],
						],
						'required' => [ 'group_filters_content_position', '=', 'row' ],
					]
				);

				$this->register_jet_control(
					'group_filters_item_width',
					[
						'tab'      => 'style',
						'label'    => esc_html__( 'Group Item Width', 'jet-smart-filters' ),
						'type'     => 'slider',
						'units'    => [
							'%'  => [
								'min' => 10,
								'max' => 100,
							],
							'px' => [
								'min' => 50,
								'max' => 500,
							],
						],
						'default'  => '',
						'css'      => [
							[
								'property' => 'max-width',
								'selector' => '.jet-filters-group .jet-filter, .jet-filter .jet-filters-group .jet-select',
							],
							[
								'property' => 'width',
								'selector' => '.jet-filters-group .jet-filter, .jet-filter .jet-filters-group .jet-select',
								'value'    => '100%',
							],
						],
						'required' => [ 'group_filters_content_position', '=', 'row' ],
					]
				);

				$this->register_jet_control(
					'group_filters_horizontal_offset',
					[
						'tab'      => 'style',
						'label'    => esc_html__( 'Horizontal Space Between', 'jet-smart-filters' ),
						'type'     => 'slider',
						'units'    => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'default'  => '',
						'css'      => [
							[
								'property' => 'column-gap',
								'selector' => '.jet-filters-group',
							],
						],
						'required' => [ 'group_filters_content_position', '=', 'row' ],
					]
				);

				$this->register_jet_control(
					'group_filters_vertical_offset',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Vertical Space Between', 'jet-smart-filters' ),
						'type'    => 'slider',
						'units'   => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'default' => '',
						'css'     => [
							[
								'property' => 'row-gap',
								'selector' => '.jet-filters-group',
							],
						],
					]
				);

				$this->end_jet_control_group();

				break;
		}
	}

	/**
	 * Register filter settings controls. Specific for each widget.
	 *
	 * @return void
	 */
	public function register_filter_settings_controls() {

	}

	/**
	 * Register filter style controls. Specific for each widget.
	 *
	 * @return void
	 */
	public function register_filter_style_controls( $name ) {

	}

	/**
	 * Register filter style controls. Specific for each widget.
	 *
	 * @return void
	 */
	public function register_horizontal_layout_controls( $css_scheme ) {

		/*$this->register_jet_control(
			'filters_position',
			[
				'tab'     => 'style',
				'label'   => esc_html__( 'Filters Position', 'jet-smart-filters' ),
				'type'    => 'direction',
				'css'     => [
					[
						'property' => 'display',
						'selector' => $css_scheme['list-item'] . ', ' . $css_scheme['list-children'],
					],
				],
			]
		);*/

		$this->register_jet_control(
			'filters_position',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Filters Position', 'jet-smart-filters' ),
				'type'  => 'direction',
				'default'  => 'column',
				'css'   => [
					[
						'property' => 'flex-direction',
						'selector' => $css_scheme['list-wrapper'] . ', ' . $css_scheme['list-children'],
					],
					[
						'property' => 'display',
						'selector' => $css_scheme['list-wrapper'] . ', ' . $css_scheme['list-children'],
						'value'    => 'flex',
					],
					[
						'property' => 'flex-wrap',
						'selector' => $css_scheme['list-wrapper'] . ', ' . $css_scheme['list-children'],
						'value'    => 'wrap',
					],
				],
			]
		);

		$this->register_jet_control(
			'filters_list_alignment',
			[
				'tab'      => 'style',
				'label'    => esc_html__( 'Align main axis', 'jet-smart-filters' ),
				'type'     => 'justify-content',
				'css'      => [
					[
						'property' => 'justify-content',
						'selector' => $css_scheme['list-wrapper'] . ', ' . $css_scheme['list-children'],
					],
				],
				'required' => [ 'filters_position', '=', 'row' ],
			]
		);

		$this->register_jet_control(
			'filters_gap',
			[
				'tab'     => 'style',
				'label'   => esc_html__( 'Gap', 'jet-smart-filters' ),
				'type'    => 'slider',
				'units'   => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => '',
				'css'     => [
					[
						'property' => 'gap',
						'selector' => $css_scheme['list-wrapper'] . ', ' . $css_scheme['list-children'],
					],
					[
						'property' => 'margin',
						'selector' => $css_scheme['list-wrapper'] . ', ' . $css_scheme['list-item'] . ', ' . $css_scheme['list-children'],
						'value' => '0',
					],
					[
						'property' => 'padding-top',
						'selector' => $css_scheme['list-item'] . ', ' . $css_scheme['list-children'],
						'value' => '0',
					],
					[
						'property' => 'margin-bottom',
						'selector' => '.jet-checkboxes-list__item',
						'value' => '0',
					],
				],
			]
		);

		/*$this->register_jet_control(
			'horizontal_layout_description',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Horizontal Offset control works only with Line Filters Position', 'jet-smart-filters' ),
				'type'  => 'info',
			]
		);*/

		/*$this->register_jet_control(
			'filters_space_between_horizontal',
			[
				'tab'     => 'style',
				'label'   => esc_html__( 'Horizontal Offset', 'jet-smart-filters' ),
				'type'    => 'slider',
				'units'   => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'default' => '',
				'css'     => [
					[
						'property' => 'margin-top',
					],
				],

			]
		);*/

		/*$this->register_jet_control(
			'filters_list_alignment',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Alignment', 'jet-smart-filters' ),
				'type'  => 'text-align',
				'css'   => [
					[
						'property' => 'text-align',
						'selector' => $css_scheme['list-wrapper'],
					],
				],
			]
		);*/
	}

	// Render element HTML
	public function render() {

		jet_smart_filters()->set_filters_used();

		$base_class      = $this->name;
		$settings        = $this->parse_jet_render_attributes( $this->get_jet_settings() );
		$indexer_class   = '';
		$show_counter    = false;
		$show_items_rule = 'show';
		$group           = false;

		if ( empty( $settings['filter_id'] ) ) {
			/* if ( Plugin::instance()->editor->is_edit_mode() ) {
				echo '<div></div>';
			} */

			return;
		}

		$filter_ids = $settings['filter_id'];

		if ( ! is_array( $filter_ids ) ) {
			$filter_ids = array( $filter_ids );
		}

		if ( 1 < count( $filter_ids ) ) {
			$group = true;
		}

		if ( 'submit' === $settings['apply_on'] && in_array( $settings['apply_type'], [ 'ajax', 'mixed' ] ) ) {
			$apply_type = $settings['apply_type'] . '-reload';
		} else {
			$apply_type = $settings['apply_type'];
		}

		$query_id          = ! empty( $settings['query_id'] ) ? $settings['query_id'] : 'default';
		$show_label        = ! empty( $settings['show_label'] ) ? filter_var( $settings['show_label'], FILTER_VALIDATE_BOOLEAN ) : false;
		$show_items_label  = ! empty( $settings['show_items_label'] ) ? $settings['show_items_label'] : false;
		$show_decorator    = ! empty( $settings['show_decorator'] ) ? $settings['show_decorator'] : false;
		$apply_indexer     = ! empty( $settings['apply_indexer'] ) ? filter_var( $settings['apply_indexer'], FILTER_VALIDATE_BOOLEAN ) : false;
		$filter_image_size = ! empty( $settings['filter_image_size'] ) ? $settings['filter_image_size'] : 'full';
		$change_items_rule = ! empty( $settings['change_items_rule'] ) ? $settings['change_items_rule'] : 'always';
		// search
		$search_enabled     = ! empty( $settings['search_enabled'] ) ? filter_var( $settings['search_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;
		$search_placeholder = ! empty( $settings['search_placeholder'] ) && $search_enabled ? $settings['search_placeholder'] : false;
		// more/less
		$less_items_count = ! empty( $settings['moreless_enabled'] ) && ! empty( $settings['less_items_count'] ) ? (int) $settings['less_items_count'] : false;
		$more_text        = ! empty( $settings['more_text'] ) ? $settings['more_text'] : false;
		$less_text        = ! empty( $settings['less_text'] ) ? $settings['less_text'] : false;
		// dropdown
		$dropdown_enabled     = ! empty( $settings['dropdown_enabled'] ) ? $settings['dropdown_enabled'] : false;
		$dropdown_placeholder = ! empty( $settings['dropdown_placeholder'] ) ? $settings['dropdown_placeholder'] : false;
		// scroll
		$scroll_height = ! empty( $settings['scroll_enabled'] ) && ! empty( $settings['scroll_height'] ) ? (int) $settings['scroll_height'] : false;

		if ( $apply_indexer ) {
			$indexer_class   = 'jet-filter-indexed';
			$show_counter    = 'yes' === $settings['show_counter'] ? $settings['show_counter'] : false;
			$show_items_rule = ! empty( $settings['show_items_rule'] ) ? $settings['show_items_rule'] : 'show';
		}

		echo "<div {$this->render_attributes( '_root' )}>";

		if ( $group ) {
			echo '<div class="jet-filters-group">';
		}

		foreach ( $filter_ids as $filter_id ) {

			$filter_id = apply_filters( 'jet-smart-filters/render_filter_template/filter_id', $filter_id );

			jet_smart_filters()->admin_bar->register_post_item( $filter_id );

			printf(
				'<div class="%1$s jet-filter %2$s" data-indexer-rule="%3$s" data-show-counter="%4$s" data-change-counter="%5$s">',
				apply_filters( 'jet-smart-filters/render_filter_template/base_class', $base_class, $filter_id ),
				$indexer_class,
				$show_items_rule,
				$show_counter,
				$change_items_rule
			);

			$provider             = ! empty( $settings['content_provider'] ) ? $settings['content_provider'] : '';
			$additional_providers = jet_smart_filters()->utils->get_additional_providers( $settings );

			$filter_template_args = array(
				'filter_id'            => $filter_id,
				'content_provider'     => $provider,
				'additional_providers' => $additional_providers,
				'apply_type'           => $apply_type,
				'query_id'             => $query_id,
				'show_label'           => $show_label,
				'display_options'      => array(
					'show_items_label'  => $show_items_label,
					'show_decorator'    => $show_decorator,
					'filter_image_size' => $filter_image_size,
					'show_counter'      => $show_counter,
				),
			);

			// hide main label is hierarchical select
			if ( $this->name === 'jet-smart-filters-select' && filter_var( get_post_meta( $filter_id, '_is_hierarchical', true ), FILTER_VALIDATE_BOOLEAN ) ) {
				$show_label = false;
			}

			// search
			if ( $search_enabled ) {
				$filter_template_args['search_enabled'] = $search_enabled;
			}
			if ( $search_placeholder ) {
				$filter_template_args['search_placeholder'] = $search_placeholder;
			}
			// more/less
			if ( $less_items_count ) {
				$filter_template_args['less_items_count'] = $less_items_count;
			}
			if ( $more_text ) {
				$filter_template_args['more_text'] = $more_text;
			}
			if ( $less_text ) {
				$filter_template_args['less_text'] = $less_text;
			}
			//dropdown
			if ( $dropdown_enabled ) {
				$filter_template_args['dropdown_enabled'] = $dropdown_enabled;
			}
			if ( $dropdown_placeholder ) {
				$filter_template_args['dropdown_placeholder'] = $dropdown_placeholder;
			}
			// scroll
			if ( $scroll_height ) {
				$filter_template_args['scroll_height'] = $scroll_height;
			}
			//indexer
			if ( $apply_indexer ) {
				$filter_template_args['apply_indexer'] = $apply_indexer;
			}

			include jet_smart_filters()->get_template( 'common/filter-label.php' );

			jet_smart_filters()->filter_types->render_filter_template( $this->jet_element_render, $filter_template_args );

			echo '</div>';

		}

		if ( $group ) {
			echo '</div>';
		}

		include jet_smart_filters()->get_template( 'common/apply-filters.php' );

		echo "</div>";

	}
}