<?php

namespace Jet_Smart_Filters\Bricks_Views\Elements;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Jet_Smart_Filters_Select_Widget extends Jet_Smart_Filters_Base_Widget {
	// Element properties
	public $category = 'general'; // Use predefined element category 'general'
	public $name = 'jet-smart-filters-select'; // Make sure to prefix your elements
	public $icon = 'ti-filter'; // Themify icon font class
	public $css_selector = '.jet-filters-pagination'; // Default CSS selector
	public $scripts = []; // Script(s) run when element is rendered on frontend or updated in builder

	public $jet_element_render = 'select';

	// Return localised element label
	public function get_label() {
		return esc_html__( 'Select Filter', 'jet-smart-filters' );
	}

	/*// Set builder control groups
	public function set_control_groups() {

		$this->register_jet_control_group(
			'',
			[
				'title' => esc_html__( '', 'jet-smart-filters' ),
				'tab'   => 'content',
			]
		);

	}

	// Set builder controls
	public function set_controls() {

		$this->start_jet_control_group( '' );

		$this->register_jet_control(
			'',
			[
				'tab'     => 'content',
				'label'   => esc_html__( '', 'jet-smart-filters' ),
				'type'    => '',
			]
		);

		$this->end_jet_control_group();
	}*/
}