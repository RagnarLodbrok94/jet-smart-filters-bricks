<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

use Jet_Engine\Bricks_Views\Helpers\Options_Converter;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Bricks_Apply_Button extends \Jet_Engine\Bricks_Views\Elements\Base {
	// Element properties
	public $category = 'jetsmartfilters'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-apply-button'; // Make sure to prefix your elements
	public $icon = 'jet-smart-filters-icon-apply-filter'; // Themify icon font class
	public $css_selector = '.jet-smart-filters-apply-button'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'apply-button';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Apply Button', 'jet-smart-filters' );
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
			'section_filter_apply_button_style',
			[
				'title' => esc_html__( $this->get_label() . ': Button', 'jet-smart-filters' ),
				'tab'   => 'style',
			]
		);
	}

	// Set builder controls
	public function set_controls() {

		$this->start_jet_control_group( 'section_general' );

		$this->register_jet_control(
			'content_provider',
			[
				'tab'        => 'content',
				'label'      => esc_html__( 'This filter for', 'jet-smart-filters' ),
				'type'       => 'select',
				'options'    => Options_Converter::remove_placeholder_from_options( jet_smart_filters()->data->content_providers() ),
				'searchable' => true,
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
				],
				'default' => 'ajax',
			]
		);

		$this->register_jet_control(
			'apply_button_text',
			[
				'tab'            => 'content',
				'label'          => esc_html__( 'Apply button text', 'jet-smart-filters' ),
				'type'           => 'text',
				'hasDynamicData' => false,
				'default'        => esc_html__( 'Apply filters', 'jet-smart-filters' ),
			]
		);

		$this->register_jet_control(
			'apply_redirect',
			[
				'tab'     => 'content',
				'label'   => esc_html__( 'Apply Redirect', 'jet-smart-filters' ),
				'type'    => 'checkbox',
				'default' => false,
			]
		);

		$this->register_jet_control(
			'redirect_path',
			[
				'tab'            => 'content',
				'label'          => esc_html__( 'Redirect Path', 'jet-smart-filters' ),
				'type'           => 'text',
				'hasDynamicData' => false,
				'required'       => [ 'apply_redirect', '=', true ],
			]
		);

		$this->register_jet_control(
			'redirect_in_new_window',
			[
				'tab'      => 'content',
				'label'    => esc_html__( 'Open in new window', 'jet-smart-filters' ),
				'type'     => 'checkbox',
				'default'  => false,
				'required' => [ 'apply_redirect', '=', true ],
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

		$css_scheme = apply_filters(
			'jet-smart-filters/widgets/apply-button/css-scheme',
			array(
				'filter'               => '.jet-filter',
				'apply-filters'        => '.apply-filters',
				'apply-filters-button' => '.apply-filters__button',
			)
		);

		$this->start_jet_control_group( 'section_filter_apply_button_style' );

		$this->register_jet_control(
			'filter_apply_button_typography',
			[
				'tab'     => 'style',
				'label'   => esc_html__( 'Typography', 'jet-smart-filters' ),
				'type'    => 'typography',
				'exclude' => [
					'text-align',
				],
				'css'     => [
					[
						'property' => 'typography',
						'selector' => $css_scheme['apply-filters-button'],
					],
				],
			]
		);

		$this->register_jet_control(
			'filter_apply_button_bg',
			[
				'tab'   => 'style',
				'label' => esc_html__( 'Background color', 'jet-smart-filters' ),
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
				],
			]
		);

		$this->end_jet_control_group();
	}

	/**
	 * Apply button container data attributes
	 *
	 * @return String
	 */
	public function container_data_atts() {
		$output                 = '';
		$settings               = $this->parse_jet_render_attributes( $this->get_jet_settings() );
		$provider               = ! empty( $settings['content_provider'] ) ? $settings['content_provider'] : '';
		$query_id               = ! empty( $settings['query_id'] ) ? $settings['query_id'] : 'default';
		$additional_providers   = jet_smart_filters()->utils->get_additional_providers( $settings );
		$apply_type             = ! empty( $settings['apply_type'] ) ? $settings['apply_type'] : 'ajax';
		$redirect               = ! empty( $settings['apply_redirect'] ) ? $settings['apply_redirect'] : false;
		$redirectPath           = ! empty( $settings['redirect_path'] ) ? $settings['redirect_path'] : false;
		$redirect_in_new_window = ! empty( $settings['redirect_in_new_window'] ) ? $settings['redirect_in_new_window'] : false;

		$data_atts = array(
			'data-content-provider'     => $provider,
			'data-query-id'             => $query_id,
			'data-additional-providers' => $additional_providers,
			'data-apply-type'           => $apply_type
		);

		$data_atts['data-redirect'] = $redirect;
		if ( $redirect && $redirectPath ) {
			$data_atts['data-redirect-path'] = $redirectPath;

			if ( $redirect_in_new_window ) {
				$data_atts['data-redirect-in-new-window'] = $redirect_in_new_window;
			}
		}

		foreach ( $data_atts as $key => $value ) {
			$output .= sprintf( ' %1$s="%2$s"', $key, $value );
		}

		return $output;
	}

	// Render element HTML
	public function render() {

		jet_smart_filters()->set_filters_used();

		$base_class = $this->name;
		$settings   = $this->parse_jet_render_attributes( $this->get_jet_settings() );
		$data_atts  = $this->container_data_atts();

		echo "<div {$this->render_attributes( '_root' )}>";

		$settings['apply_button'] = 'yes';

		echo '<div class="' . $base_class . ' jet-filter">';
		include jet_smart_filters()->get_template( 'common/apply-filters.php' );
		echo '</div>';

		echo "</div>";

	}
}