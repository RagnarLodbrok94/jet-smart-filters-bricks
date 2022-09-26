<?php
/**
 * Datepicker style controls
 */

$this->start_jet_control_group( 'section_calendar_styles' );

$this->register_jet_control(
	'calendar_offset_top',
	[
		'tab'     => 'style',
		'label'   => esc_html__( 'Offset Top', 'jet-smart-filters' ),
		'type'    => 'slider',
		'units'   => [
			'px' => [
				'min' => 0,
				'max' => 40,
			],
		],
		'default' => '10px',
		'css'     => [
			[
				'property' => 'margin-top',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-wrapper'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_width',
	[
		'tab'     => 'style',
		'label'   => esc_html__( 'Calendar Width', 'jet-smart-filters' ),
		'type'    => 'slider',
		'units'   => [
			'px' => [
				'min' => 0,
				'max' => 1000,
			],
		],
		'default' => '300px',
		'css'     => [
			[
				'property' => 'width',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-wrapper'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_body_bg',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Background color', 'jet-engine' ),
		'type'  => 'color',
		'css'   => [
			[
				'property' => 'background-color',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-wrapper'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_body_padding',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Padding', 'jet-engine' ),
		'type'  => 'dimensions',
		'css'   => [
			[
				'property' => 'padding',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-wrapper'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_body_border',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Border', 'jet-engine' ),
		'type'  => 'border',
		'css'   => [
			[
				'property' => 'border',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-wrapper'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_body_box_shadow',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Box shadow', 'jet-engine' ),
		'type'  => 'box-shadow',
		'css'   => [
			[
				'property' => 'box-shadow',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-wrapper'],
			],
		],
	]
);

$this->end_jet_control_group();

$this->start_jet_control_group( 'section_calendar_title' );

$this->register_jet_control(
	'calendar_title_typography',
	[
		'tab'     => 'style',
		'label'   => esc_html__( 'Typography', 'jet-engine' ),
		'type'    => 'typography',
		'exclude' => [
			'text-align',
		],
		'css'     => [
			[
				'property' => 'typography',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-wrapper'],
			],
		],
	]
);

$this->end_jet_control_group();

$this->start_jet_control_group( 'section_calendar_prev_next' );

$this->register_jet_control(
	'calendar_prev_next_size',
	[
		'tab'     => 'style',
		'label'   => esc_html__( 'Size', 'jet-smart-filters' ),
		'type'    => 'slider',
		'units'   => [
			'px' => [
				'min' => 0,
				'max' => 30,
			],
		],
		'default' => '15px',
		'css'     => [
			[
				'property' => 'border-width',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-prev-button'],
			],
			[
				'property' => 'border-width',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-next-button'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_prev_next_normal_color',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'color', 'jet-engine' ),
		'type'  => 'color',
		'css'   => [
			[
				'property' => 'border-left-color',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-prev-button'],
			],
			[
				'property' => 'border-right-color',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-next-button'],
			],
		],
	]
);

$this->end_jet_control_group();

$this->start_jet_control_group( 'section_calendar_header' );

$this->register_jet_control(
	'calendar_header_bg',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Header background color', 'jet-engine' ),
		'type'  => 'color',
		'css'   => [
			[
				'property' => 'background-color',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-body-header'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_header_border',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Border', 'jet-engine' ),
		'type'  => 'border',
		'css'   => [
			[
				'property' => 'border',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-body-header'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_header_cells_heading',
	[
		'tab'   => 'style',
		'type'  => 'separator',
		'label' => esc_html__( 'Day', 'jet-engine' ),
	]
);

$this->register_jet_control(
	'calendar_header_cells_padding',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Padding', 'jet-engine' ),
		'type'  => 'dimensions',
		'css'   => [
			[
				'property' => 'padding',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-body-header'] . ' > tr > th',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_header_cells_border',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Border', 'jet-engine' ),
		'type'  => 'border',
		'css'   => [
			[
				'property' => 'border',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-body-header'] . ' > tr > th',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_header_cells_content',
	[
		'tab'   => 'style',
		'type'  => 'separator',
		'label' => esc_html__( 'Day Content', 'jet-engine' ),
	]
);

$this->register_jet_control(
	'calendar_header_cells_content_typography',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Typography', 'jet-smart-filters' ),
		'type'  => 'typography',
		'css'   => [
			[
				'property' => 'typography',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}} ' . $css_scheme['calendar-body-header'] . ' > tr > th > span',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_header_cells_content_bg',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Background', 'jet-smart-filters' ),
		'type'  => 'color',
		'css'   => [
			[
				'property' => 'background-color',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}} ' . $css_scheme['calendar-body-header'] . ' > tr > th > span',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_header_cells_content_padding',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Padding', 'jet-smart-filters' ),
		'type'  => 'dimensions',
		'css'   => [
			[
				'property' => 'padding',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}} ' . $css_scheme['calendar-body-header'] . ' > tr > th > span',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_header_cells_content_border',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Border', 'jet-smart-filters' ),
		'type'  => 'border',
		'css'   => [
			[
				'property' => 'border',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}} ' . $css_scheme['calendar-body-header'] . ' > tr > th > span',
			],
		],
	]
);

$this->end_jet_control_group();

$this->start_jet_control_group( 'section_calendar_content' );

$this->register_jet_control(
	'calendar_content_bg',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Header background color', 'jet-engine' ),
		'type'  => 'color',
		'css'   => [
			[
				'property' => 'background-color',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-body-header'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_content_border',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Border', 'jet-engine' ),
		'type'  => 'border',
		'css'   => [
			[
				'property' => 'border',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-body-header'],
			],
		],
	]
);

$this->register_jet_control(
	'calendar_content_cells_heading',
	[
		'tab'   => 'style',
		'type'  => 'separator',
		'label' => esc_html__( 'Day', 'jet-engine' ),
	]
);

$this->register_jet_control(
	'calendar_content_cells_padding',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Padding', 'jet-engine' ),
		'type'  => 'dimensions',
		'css'   => [
			[
				'property' => 'padding',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-body-header'] . ' > tr > th',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_content_cells_border',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Border', 'jet-engine' ),
		'type'  => 'border',
		'css'   => [
			[
				'property' => 'border',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}}' . $css_scheme['calendar-body-header'] . ' > tr > th',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_content_cells_content',
	[
		'tab'   => 'style',
		'type'  => 'separator',
		'label' => esc_html__( 'Day Content', 'jet-engine' ),
	]
);

$this->register_jet_control(
	'calendar_content_cells_content_typography',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Typography', 'jet-smart-filters' ),
		'type'  => 'typography',
		'css'   => [
			[
				'property' => 'typography',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}} ' . $css_scheme['calendar-body-header'] . ' > tr > th > span',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_content_cells_content_bg',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Background', 'jet-smart-filters' ),
		'type'  => 'color',
		'css'   => [
			[
				'property' => 'background-color',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}} ' . $css_scheme['calendar-body-header'] . ' > tr > th > span',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_content_cells_content_padding',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Padding', 'jet-smart-filters' ),
		'type'  => 'dimensions',
		'css'   => [
			[
				'property' => 'padding',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}} ' . $css_scheme['calendar-body-header'] . ' > tr > th > span',
			],
		],
	]
);

$this->register_jet_control(
	'calendar_content_cells_content_border',
	[
		'tab'   => 'style',
		'label' => esc_html__( 'Border', 'jet-smart-filters' ),
		'type'  => 'border',
		'css'   => [
			[
				'property' => 'border',
				'selector' => '.jet-smart-filters-datepicker-{{$this->id}} ' . $css_scheme['calendar-body-header'] . ' > tr > th > span',
			],
		],
	]
);

$this->end_jet_control_group();