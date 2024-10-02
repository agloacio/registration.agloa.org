<?php
return array(
	// Page Header Samples.
	array(
		'template_name'    => 'Header Template 1',
		'location'         => 'header',
		'menus'            => array(
			array(
				'type'  => 'social_menu',
				'align' => 'right',
			),
			array(
				'type'  => 'main_menu',
				'align' => 'center',
			),
		),
		'postarr'          => array(
			'post_title'  => 'Header with Centered Menu and Page Title',
			'post_status' => 'publish',
			'post_type'   => 'crio_page_header',
		),
		'template_content' => include __DIR__ . '/sample-layout-1.content.php',
	),
	array(
		'template_name'    => 'Header Template 2',
		'location'         => 'header',
		'menus'            => array(
			array(
				'type'  => 'main_menu',
				'align' => 'right',
			),
		),
		'postarr'          => array(
			'post_title'  => 'Header with Right Menu and CTA Buttons',
			'post_status' => 'publish',
			'post_type'   => 'crio_page_header',
		),
		'template_content' => include __DIR__ . '/sample-layout-2.content.php',
	),
	// Sticky Page Header Samples
	array(
		'template_name'    => 'Sticky Header Template 1',
		'location'         => 'sticky-header',
		'menus'            => array(
			array(
				'type'  => 'main_menu',
				'align' => 'left',
			),
		),
		'postarr'          => array(
			'post_title'  => 'Sticky Header with Centered Menu',
			'post_status' => 'publish',
			'post_type'   => 'crio_page_header',
		),
		'template_content' => include __DIR__ . '/sample-sticky-layout-1.content.php',
	),
	array(
		'template_name'    => 'Sticky Header template 2',
		'location'         => 'sticky-header',
		'menus'            => array(),
		'postarr'          => array(
			'post_title'  => 'Sticky Header with Right CTA Buttons',
			'post_status' => 'publish',
			'post_type'   => 'crio_page_header',
		),
		'template_content' => include __DIR__ . '/sample-sticky-layout-2.content.php',
	),
	// Footer Template Samples
	array(
		'template_name'    => 'Footer Template 1',
		'location'         => 'footer',
		'menus'            => array(
			array(
				'type'      => 'main_menu',
				'align'     => 'left',
				'direction' => 'flex-column',
			),
		),
		'postarr'          => array(
			'post_title'  => 'Three Column Footer with Menu',
			'post_status' => 'publish',
			'post_type'   => 'crio_page_header',
		),
		'template_content' => include __DIR__ . '/sample-footer-layout-1.content.php',
	),
	array(
		'template_name'    => 'Footer Template 2',
		'location'         => 'footer',
		'menus'            => array(),
		'postarr'          => array(
			'post_title'  => 'Two Column Footer with Map',
			'post_status' => 'publish',
			'post_type'   => 'crio_page_header',
		),
		'template_content' => include __DIR__ . '/sample-footer-layout-2.content.php',
	),
);
