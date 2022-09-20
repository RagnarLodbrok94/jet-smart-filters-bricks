<?php

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
		'label'   => esc_html__( 'Additional Provider', 'jet-engine' ),
		'type'    => 'select',
		'options' => jet_smart_filters()->data->content_providers(),
	]
);

$repeater->add_control(
	'additional_query_id',
	[
		'label' => esc_html__( 'Additional Query ID', 'jet-engine' ),
		'type'  => 'text',
	]
);

$this->register_jet_control(
	'additional_providers_list',
	[
		'tab'           => 'content',
		'label'         => esc_html__( 'Additional Providers List', 'jet-engine' ),
		'type'          => 'repeater',
		'titleProperty' => 'additional_provider',
		'fields'        => $repeater->get_controls(),
		'required'      => [ 'additional_providers_enabled', '=', true ],
	]
);