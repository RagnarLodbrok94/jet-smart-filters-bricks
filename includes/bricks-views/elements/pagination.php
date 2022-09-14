<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
use Bricks\Helpers;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Pagination extends \Jet_Engine\Bricks_Views\Elements\Base {
	// Element properties
	public $category = 'general'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-pagination'; // Make sure to prefix your elements
	public $icon = 'ti-angle-double-right'; // Themify icon font class
	public $css_selector = '.jet-filters-pagination'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'pagination';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'JetSmartFilters Pagination', 'jet-smart-filters' );
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
			'section_controls',
			[
				'title' => esc_html__( 'Controls', 'jet-smart-filters' ),
				'tab'   => 'content',
			]
		);

		$this->register_jet_control_group(
			'pagination_style',
			[
				'title' => esc_html__( 'Pagination', 'jet-smart-filters' ),
				'tab'   => 'style',
			]
		);

		$this->register_jet_control_group(
			'pagination_items_style',
			[
				'title' => esc_html__( 'Items', 'jet-smart-filters' ),
				'tab'   => 'style',
			]
		);


	}

	// Set builder controls
	public function set_controls() {

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/pagination/css-scheme',
			[
				'container'               => '.jet-smart-filters-pagination',
				'pagination'              => '.jet-filters-pagination',
				'pagination-item'         => '.jet-filters-pagination__item',
				'pagination-link'         => '.jet-filters-pagination__link',
				'pagination-link-current' => '.jet-filters-pagination__current .jet-filters-pagination__link',
				'pagination-dots'         => '.jet-filters-pagination__dots',
			]
		);

		$this->start_jet_control_group( 'section_general' );

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
			'query_id',
			[
				'tab'         => 'content',
				'label'       => esc_html__( 'Query ID', 'jet-smart-filters' ),
				'type'        => 'text',
				'description' => esc_html__( 'Set unique query ID if you use multiple widgets of same provider on the page. Same ID you need to set for filtered widget.', 'jet-smart-filters' ),
			]
		);

		$this->end_jet_control_group();

		$this->start_jet_control_group( 'section_controls' );

		$this->register_jet_control(
			'enable_prev_next',
			[
				'tab'     => 'content',
				'label'   => esc_html__( 'Enable Prev/Next buttons', 'jet-smart-filters' ),
				'type'    => 'checkbox',
				'default' => true,
			]
		);

		$this->register_jet_control(
			'prev_text',
			[
				'tab'      => 'content',
				'label'    => esc_html__( 'Prev Text', 'jet-smart-filters' ),
				'type'     => 'text',
				'default'  => esc_html__( 'Prev', 'jet-smart-filters' ),
				'required' => [ 'enable_prev_next', '=', true ],
			]
		);

		$this->register_jet_control(
			'next_text',
			[
				'tab'      => 'content',
				'label'    => esc_html__( 'Next Text', 'jet-smart-filters' ),
				'type'     => 'text',
				'default'  => esc_html__( 'Next', 'jet-smart-filters' ),
				'required' => [ 'enable_prev_next', '=', true ],
			]
		);

		$this->register_jet_control(
			'pages_center_offset',
			[
				'tab'         => 'content',
				'label'       => esc_html__( 'Items center offset', 'jet-smart-filters' ),
				'type'        => 'number',
				'default'     => 0,
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'description' => esc_html__( 'Set number of items to either side of current page, not including current page.Set 0 to show all items.', 'jet-smart-filters' ),
				'required'    => [ 'enable_prev_next', '=', true ],
			]
		);

		$this->register_jet_control(
			'pages_end_offset',
			[
				'tab'         => 'content',
				'label'       => esc_html__( 'Items edge offset', 'jet-smart-filters' ),
				'type'        => 'number',
				'default'     => 0,
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'description' => esc_html__( 'Set number of items on either the start and the end list edges.', 'jet-smart-filters' ),
				'required'    => [ 'enable_prev_next', '=', true ],
			]
		);

		$this->register_jet_control(
			'provider_top_offset',
			[
				'tab'         => 'content',
				'label'       => esc_html__( 'Provider top offset', 'jet-smart-filters' ),
				'type'        => 'number',
				'default'     => 0,
				'min'         => 0,
				'max'         => 999,
				'step'        => 1,
				'description' => esc_html__( 'Set the distance from the top edge when reloading the content via AJAX.', 'jet-smart-filters' ),
				'required'    => [
					[ 'apply_type', '=', [ 'ajax', 'mixed' ] ],
					[ 'enable_prev_next', '=', true ],
				],
			]
		);

		$this->end_jet_control_group();

		$this->start_jet_control_group( 'pagination_style' );

		$this->register_jet_control(
			'pagination_background_color',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Background', 'jet-engine' ),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'background-color',
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_margin',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Margin', 'jet-engine' ),
				'type'  => 'dimensions',
				'default' => '0',
				'css'   => [
					[
						'property' => 'margin',
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_padding',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Padding', 'jet-engine' ),
				'type'  => 'dimensions',
				'css'   => [
					[
						'property' => 'padding',
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_border',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Border', 'jet-engine' ),
				'type'  => 'border',
				'css'   => [
					[
						'property' => 'border',
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_shadow',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Box shadow', 'jet-engine' ),
				'type'  => 'box-shadow',
				'css'   => [
					[
						'property' => 'box-shadow',
					],
				],
			]
		);

		$this->end_jet_control_group();

		$this->start_jet_control_group( 'pagination_items_style' );

		$this->register_jet_control(
			'pagination_items_typography',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Typography', 'jet-engine' ),
				'type'  => 'typography',
				'css'   => [
					[
						'property' => 'typography',
						'selector' => $css_scheme['pagination-link'],
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_items_bg_color',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Background', 'jet-engine' ),
				'type'  => 'background',
				'css'   => [
					[
						'property' => 'background',
						'selector' => $css_scheme['pagination-link'] . ', ' . $css_scheme['pagination-dots'],
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_items_width',
			[
				'tab'      => 'style',
				'label'    => esc_html__( 'Item Width', 'jet-engine' ),
				'type'     => 'slider',
				'units'    => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
					],
				],
				'css'      => [
					[
						'property' => 'min-width',
						'selector' => $css_scheme['pagination-item'],
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_items_gap',
			[
				'tab'      => 'style',
				'label'    => esc_html__( 'Gap Between Items', 'jet-engine' ),
				'type'     => 'slider',
				'units'    => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
					],
				],
				'default'  => 10,
				'css'      => [
					[
						'property' => 'gap',
					],
					[
						'property' => 'display',
						'value'    => 'flex',
					],
					[
						'property' => 'flex-wrap',
						'value'    => 'wrap',
					],
					[
						'property' => 'margin-right',
						'selector' => $css_scheme['pagination-item'],
						'value'    => '0',
					],
					[
						'property' => 'margin-bottom',
						'selector' => $css_scheme['pagination-item'],
						'value'    => '0',
					],
					[
						'property' => 'margin-left',
						'selector' => $css_scheme['pagination-item'],
						'value'    => '0',
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_items_alignment',
			[
				'tab'         => 'style',
				'label'       => esc_html__( 'Alignment', 'jet-engine' ),
				'type'        => 'justify-content',
				'css'         => [
					[
						'property' => 'justify-content',
					],
					[
						'property' => 'display',
						'value'    => 'flex',
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_items_padding',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Padding', 'jet-engine' ),
				'type'  => 'dimensions',
				'css'   => [
					[
						'property' => 'padding',
						'selector' => $css_scheme['pagination-link'] . ', ' . $css_scheme['pagination-dots'],
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_items_border',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Border', 'jet-engine' ),
				'type'  => 'border',
				'css'   => [
					[
						'property' => 'border',
						'selector' => $css_scheme['pagination-link'] . ', ' . $css_scheme['pagination-dots'],
					],
				],
			]
		);

		$this->register_jet_control(
			'pagination_item_current',
			[
				'tab'   => 'style',
				'type'  => 'separator',
				'label' => esc_html__( 'Current Item', 'jet-engine' ),
			]
		);

		$this->register_jet_control(
			'pagination_item_color_current',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Color', 'jet-engine' ),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'color',
						'selector' => $css_scheme['pagination-link-current'],
					]
				],
			]
		);

		$this->register_jet_control(
			'pagination_item_bg_color_current',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Background', 'jet-engine' ),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'background-color',
						'selector' => $css_scheme['pagination-link-current'],
					]
				],
			]
		);

		$this->register_jet_control(
			'pagination_item_border_color_current',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Border Color', 'jet-engine' ),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'border-color',
						'selector' => $css_scheme['pagination-link-current'],
					]
				],
			]
		);

		$this->register_jet_control(
			'pagination_item_dots',
			[
				'tab'   => 'style',
				'type'  => 'separator',
				'label' => esc_html__( 'Dots Item', 'jet-engine' ),
			]
		);

		$this->register_jet_control(
			'pagination_item_color_dots',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Color', 'jet-engine' ),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'color',
						'selector' => $css_scheme['pagination-dots'],
					]
				],
			]
		);

		$this->register_jet_control(
			'pagination_item_bg_color_dots',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Background', 'jet-engine' ),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'background-color',
						'selector' => $css_scheme['pagination-dots'],
					]
				],
			]
		);

		$this->register_jet_control(
			'pagination_item_border_color_dots',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Border Color', 'jet-engine' ),
				'type'  => 'color',
				'css'   => [
					[
						'property' => 'border-color',
						'selector' => $css_scheme['pagination-dots'],
					]
				],
			]
		);

		$this->register_jet_control(
			'',
			[
				'tab'         => 'style',
				'label'       => esc_html__( '', 'jet-smart-filters' ),
				'type'        => '',
				'default'     => '',
				'description' => esc_html__( '', 'jet-smart-filters' ),
				'required'    => [ '', '=', '' ],
			]
		);

		$this->end_jet_control_group();


	}

	// Enqueue element styles and scripts
	public function enqueue_scripts() {
		wp_enqueue_style( 'jet-smart-filters-frontend' );
	}

	public function get_jet_render_instance() {

		if ( ! $this->jet_element_render_instance ) {

			/*$args = $this->parse_jet_render_attributes( $this->get_jet_settings() );

			$this->jet_element_render_instance = jet_smart_filters()->filter_types->get_filter_instance(
				$args['filter_id'], $this->jet_element_render, $args
			);*/
		}

		return $this->jet_element_render_instance;

	}

	// Render element HTML
	public function render() {
		jet_smart_filters()->set_filters_used();

		$base_class       = $this->name;
		$settings         = $this->parse_jet_render_attributes( $this->get_jet_settings() );
		$content_provider = $settings['content_provider'];
		$apply_type       = $settings['apply_type'];
		$query_id         = ! empty( $settings['query_id'] ) ? $settings['query_id'] : 'default';
		$controls_enabled = isset( $settings['enable_prev_next'] ) ? $settings['enable_prev_next'] : '';

		if ( true === $controls_enabled ) {

			$controls = array(
				'nav'  => true,
				'prev' => $settings['prev_text'],
				'next' => $settings['next_text'],
			);

		} else {
			$controls['nav'] = false;
		}

		$controls['pages_mid_size']      = ! empty( $settings['pages_center_offset'] ) ? absint( $settings['pages_center_offset'] ) : 0;
		$controls['pages_end_size']      = ! empty( $settings['pages_end_offset'] ) ? absint( $settings['pages_end_offset'] ) : 0;
		$controls['provider_top_offset'] = ! empty( $settings['provider_top_offset'] ) ? absint( $settings['provider_top_offset'] ) : 0;

//		$this->enqueue_scripts();

		/*$render = $this->get_jet_render_instance();

		if ( ! $render ) {
			return esc_html__( 'Listing renderer class not found', 'jet-engine' );
		}*/

		echo "<div {$this->render_attributes( '_root' )}>";
		printf(
			'<div
				class="%1$s"
				data-apply-provider="%2$s"
				data-content-provider="%2$s"
				data-query-id="%3$s"
				data-controls="%4$s"
				data-apply-type="%5$s"
			>',
			$base_class,
			$content_provider,
			$query_id,
			htmlspecialchars( json_encode( $controls ) ),
			$apply_type
		);

		if ( bricks_is_builder_call() ) {
			$pagination_filter_type = jet_smart_filters()->filter_types->get_filter_types( 'pagination' );
			$pagination_filter_type->render_pagination_sample( $controls );
		}

		echo '</div>';
		echo "</div>";
	}

	public function parse_jet_render_attributes( $attrs = [] ) {

		$attrs['enable_prev_next'] = $attrs['enable_prev_next'] ?? false;

		return $attrs;
	}
}