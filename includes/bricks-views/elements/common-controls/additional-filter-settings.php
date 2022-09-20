<?php

$this->start_jet_control_group( 'additional_settings' );


/**
 * Search controls
 */
$this->register_jet_control(
	'search_enabled',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'Search Enabled', 'jet-smart-filters' ),
		'type'    => 'checkbox',
		'default' => false,
	]
);

$this->register_jet_control(
	'search_placeholder',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'Search Placeholder', 'jet-smart-filters' ),
		'type'    => 'text',
		'default' => esc_html__( 'Search...', 'jet-smart-filters' ),
		'required' => [ 'search_enabled', '=', true ],
	]
);


/**
 * More Less controls
 */
$this->register_jet_control(
	'moreless_enabled',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'More/Less Enabled', 'jet-smart-filters' ),
		'type'    => 'checkbox',
		'default' => false,
	]
);

$this->register_jet_control(
	'less_items_count',
	[
		'tab'      => 'content',
		'label'    => esc_html__( 'Less Items Count', 'jet-smart-filters' ),
		'type'     => 'number',
		'min'      => 1,
		'max'      => 50,
		'default'  => 5,
		'required' => [ 'moreless_enabled', '=', true ],
	]
);

$this->register_jet_control(
	'more_text',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'More Text', 'jet-smart-filters' ),
		'type'    => 'text',
		'default' => esc_html__( 'More', 'jet-smart-filters' ),
		'required' => [ 'moreless_enabled', '=', true ],
	]
);

$this->register_jet_control(
	'less_text',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'Less Text', 'jet-smart-filters' ),
		'type'    => 'text',
		'default' => esc_html__( 'Less', 'jet-smart-filters' ),
		'required' => [ 'moreless_enabled', '=', true ],
	]
);


/**
 * Dropdown controls
 */
$this->register_jet_control(
	'dropdown_enabled',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'Dropdown Enabled', 'jet-smart-filters' ),
		'type'    => 'checkbox',
		'default' => false,
	]
);

$this->register_jet_control(
	'dropdown_placeholder',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'Placeholder', 'jet-smart-filters' ),
		'type'    => 'text',
		'default' => esc_html__( 'Select some options', 'jet-smart-filters' ),
		'required' => [ 'dropdown_enabled', '=', true ],
	]
);


/**
 * Scroll controls
 */
$this->register_jet_control(
	'scroll_enabled',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'Scroll Enabled', 'jet-smart-filters' ),
		'type'    => 'checkbox',
		'default' => false,
	]
);

$this->register_jet_control(
	'scroll_height',
	[
		'tab'      => 'content',
		'label'    => esc_html__( 'Scroll Height(px)', 'jet-smart-filters' ),
		'type'     => 'number',
		'min'      => 100,
		'max'      => 1000,
		'default'  => 290,
		'required' => [ 'scroll_enabled', '=', true ],
	]
);

$this->end_jet_control_group();