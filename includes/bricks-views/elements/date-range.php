<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
use Bricks\Element;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Date_Range extends Jet_Smart_Filters_Bricks_Base {
	// Element properties
	public $category = 'general'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-date-range'; // Make sure to prefix your elements
	public $icon = 'ti-filter'; // Themify icon font class
	public $css_selector = '.jet-smart-filters-date-range'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'date-range';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Date Range Filter', 'jet-smart-filters' );
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

		$this->base_controls_section_filter_label( 'group' );

		$this->controls_section_filter_apply_button( 'group' );


	}

	// Set builder controls
	public function set_controls() {

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/date-range/css-scheme',
			[
				'filter-wrapper'            => '.jet-smart-filters-date-range',
				'filter-content'            => '.jet-smart-filters-date-range .jet-date-range',
				'filters-label'             => '.jet-filter-label',
				'inputs'                    => '.jet-date-range__inputs',
				'input'                     => '.jet-date-range__inputs > input',
				'apply-filters-button'      => '.jet-date-range__submit',
				'apply-filters-button-icon' => '.jet-date-range__submit-icon',
				'calendar-wrapper'          => '.ui-datepicker',
				'calendar'                  => '.ui-datepicker-calendar',
				'calendar-header'           => '.ui-datepicker-header',
				'calendar-prev-button'      => '.ui-datepicker-prev',
				'calendar-next-button'      => '.ui-datepicker-next',
				'calendar-title'            => '.ui-datepicker-title',
				'calendar-body-header'      => '.ui-datepicker-calendar thead',
				'calendar-body-content'     => '.ui-datepicker-calendar tbody',
			]
		);

		$this->start_jet_control_group( 'section_general' );

		$this->register_jet_control(
			'filter_id',
			array_merge(
				$this->get_filter_control_settings(),
				[
					'multiple' => false,
				]
			)
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
			'hide_apply_button',
			[
				'tab'     => 'content',
				'label'   => esc_html__( 'Hide apply button', 'jet-smart-filters' ),
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
				'required'       => [ 'hide_apply_button', '=', false ],
			]
		);

		$this->register_jet_control(
			'apply_button_icon',
			[
				'tab'      => 'content',
				'label'    => esc_html__( 'Apply button icon', 'jet-smart-filters' ),
				'type'     => 'icon',
				'default'  => '',
				'required' => [ 'hide_apply_button', '=', false ],
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

		$this->base_controls_section_filter_label( 'controls', $css_scheme );

		$this->controls_section_filter_apply_button( 'controls', $css_scheme );
	}

	public function controls_section_filter_apply_button( $name, $css_scheme = null ) {
		switch ( $name ) {
			case 'group':
				$this->register_jet_control_group(
					'section_filter_apply_button_style',
					[
						'title'    => esc_html__( $this->get_label() . ': Button', 'jet-smart-filters' ),
						'tab'      => 'style',
						'required' => [ 'hide_apply_button', '=', false ],
					]
				);

				$this->register_jet_control_group(
					'section_filter_apply_button_icon_style',
					[
						'title'    => esc_html__( $this->get_label() . ': Button Icon', 'jet-smart-filters' ),
						'tab'      => 'style',
						'required' => [
							[ 'hide_apply_button', '=', false ],
							[ 'apply_button_icon', '!=', '' ],
						],
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

				$this->start_jet_control_group( 'section_filter_apply_button_icon_style' );

				$this->register_jet_control(
					'filter_apply_button_icon_direction',
					[
						'tab'       => 'style',
						'label'     => esc_html__( 'Direction', 'jet-engine' ),
						'type'      => 'direction',
						'direction' => 'row',
						'css'       => [
							[
								'property' => 'flex-direction',
								'selector' => $css_scheme['apply-filters-button'],
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_icon_color',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Icon Color', 'jet-engine' ),
						'type'  => 'color',
						'css'   => [
							[
								'property' => 'color',
								'selector' => $css_scheme['apply-filters-button-icon'],
							],
							[
								'property' => 'fill',
								'selector' => $css_scheme['apply-filters-button-icon'] . ' :is(svg, path)',
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_icon_size',
					[
						'tab'   => 'style',
						'label' => esc_html__( 'Icon Size', 'jet-engine' ),
						'type'  => 'number',
						'units' => true,
						'css'   => [
							[
								'property' => 'font-size',
								'selector' => $css_scheme['apply-filters-button-icon'],
							],
						],
					]
				);

				$this->register_jet_control(
					'filter_apply_button_icon_gap',
					[
						'tab'     => 'style',
						'label'   => esc_html__( 'Icon Gap', 'jet-engine' ),
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
								'selector' => $css_scheme['apply-filters-button'],
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

		$base_class = $this->name;
		$settings   = $this->parse_jet_render_attributes( $this->get_jet_settings() );

		if ( empty( $settings['filter_id'] ) ) {
			/* if ( Plugin::instance()->editor->is_edit_mode() ) {
				echo '<div></div>';
			} */

			return;
		}

		echo "<div {$this->render_attributes( '_root' )}>";

		printf( '<div class="%1$s jet-filter">', $base_class );

		if ( 'ajax' === $settings['apply_type'] ) {
			$apply_type = 'ajax-reload';
		} else {
			$apply_type = $settings['apply_type'];
		}

		$filter_id            = $settings['filter_id'];
		$provider             = ! empty( $settings['content_provider'] ) ? $settings['content_provider'] : '';
		$query_id             = ! empty( $settings['query_id'] ) ? $settings['query_id'] : 'default';
		$show_label           = ! empty( $settings['show_label'] ) ? filter_var( $settings['show_label'], FILTER_VALIDATE_BOOLEAN ) : false;
		$additional_providers = jet_smart_filters()->utils->get_additional_providers( $settings );
		$icon                 = '';

		if ( isset( $settings['apply_button_icon'] ) ) {
			$rendered_icon = Element::render_icon( $settings['apply_button_icon'] );
			$format        = '<span class="jet-date-range__submit-icon">%s</span>';
			$icon          = sprintf( $format, $rendered_icon );
		}

		$hide_button = ! empty( $settings['hide_apply_button'] ) ? $settings['hide_apply_button'] : false;
		$hide_button = filter_var( $hide_button, FILTER_VALIDATE_BOOLEAN );

		$filter_template_args = array(
			'filter_id'            => $settings['filter_id'],
			'content_provider'     => $provider,
			'additional_providers' => $additional_providers,
			'apply_type'           => $apply_type,
			'hide_button'          => $hide_button,
			'button_text'          => $settings['apply_button_text'],
			'button_icon'          => $icon,
			'query_id'             => $query_id,
		);

		jet_smart_filters()->admin_bar->register_post_item( $filter_id );

		include jet_smart_filters()->get_template( 'common/filter-label.php' );

		jet_smart_filters()->filter_types->render_filter_template( $this->get_widget_fiter_type(), $filter_template_args );

		echo '</div>';

		echo "</div>";

	}

}