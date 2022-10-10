<?php

use Jet_Engine\Bricks_Views\Helpers\Options_Converter;

$this->register_jet_control(
	'additional_providers_enabled',
	[
		'tab'     => 'content',
		'label'   => esc_html__( 'Additional Providers Enabled', 'jet-smart-filters' ),
		'type'    => 'checkbox',
		'default' => false,
	]
);

$repeater = new \Jet_Engine\Bricks_Views\Helpers\Repeater();

$repeater->add_control(
	'additional_provider',
	[
		'label'      => esc_html__( 'Additional Provider', 'jet-smart-filters' ),
		'type'       => 'select',
		'options'    => Options_Converter::remove_placeholder_from_options( jet_smart_filters()->data->content_providers() ),
		'searchable' => true,
	]
);

$repeater->add_control(
	'additional_query_id',
	[
		'label' => esc_html__( 'Additional Query ID', 'jet-smart-filters' ),
		'type'  => 'text',
	]
);

$this->register_jet_control(
	'additional_providers_list',
	[
		'tab'           => 'content',
		'label'         => esc_html__( 'Additional Providers List', 'jet-smart-filters' ),
		'type'          => 'repeater',
		'titleProperty' => 'additional_provider',
		'fields'        => $repeater->get_controls(),
		'required'      => [ 'additional_providers_enabled', '=', true ],
	]
);