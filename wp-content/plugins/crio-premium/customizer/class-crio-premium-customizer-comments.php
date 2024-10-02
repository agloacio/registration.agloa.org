<?php
/**
 * File: class-crio-premium-customizer-comments.php
 *
 * The customizer Comment Design panels, sections, and controls.
 *
 * @link       https://www.boldgrid.com/
 * @since      1.9.0
 *
 * @package    Crio_Premium
 * @subpackage Crio_Premium/customizer
 */

/**
 * The customizer Comment Design panels, sections, and controls.
 *
 * @since      1.9.0
 * @package    Crio_Premium
 * @subpackage Crio_Premium/customizer
 * @author     BoldGrid <pdt@boldgrid.com>
 */
class Crio_Premium_Customizer_Comments {
	/**
	 * customizer Base.
	 *
	 * @since 1.9.0
	 *
	 * @var Crio_Premium_Customizer
	 */
	private $customizer_base;

	/**
	 * Constructor.
	 *
	 * @since 1.9.0
	 *
	 * @param Crio_Premium_Customizer $customizer_base Customizer Base.
	 */
	public function __construct( $customizer_base ) {
		$this->customizer_base = $customizer_base;
	}

	/**
	 * Color Sanitize Callback.
	 *
	 * @since 1.9.0
	 *
	 * @param string $value Color value.
	 * @param array  $setting Setting.
	 */
	public function sanitize_color( $value, $setting ) {
		$valid_color_values = array_keys( $this->customizer_base->formatted_palette );

		$value_key = explode( ':', $value );
		$value_key = isset( $value_key[0] ) ? $value_key[0] : $value;

		if ( in_array( $value_key, $valid_color_values, true ) ) {
			return $value;
		} else {
			return $setting->default;
		}

	}

	/**
	 * Add Configs
	 *
	 * Callback method for the 'boldgrid_theme_framework_config' filter.
	 *
	 * @since 1.9.0
	 *
	 * @param array $config Array of configrations for BGTFW.
	 *
	 * @return array $config Array of configrations for BGTFW.
	 */
	public function add_configs( $config ) {
		$config = $this->add_panel( $config );
		$config = $this->add_sections( $config );
		$config = $this->add_controls( $config );

		return $config;
	}

	/**
	 * Add the Comments panel.
	 *
	 * @since 1.9.0
	 */
	public function add_panel( $config ) {
		$config['customizer']['panels']['bgtfw_comments'] = array(
			'title'       => __( 'Comments', 'bgtfw' ),
			'description' => '<div class="bgtfw-description"><p>' . esc_html__( 'Customize the design of the comments shown on your pages and posts.', 'bgtfw' ) . '</p><div class="help"><a href="https://www.boldgrid.com/support/boldgrid-crio/customizing-the-comments-design-in-boldgrid-crio/" target="_blank"><span class="dashicons"></span>' . esc_html__( 'Help', 'bgtfw' ) . '</a></div></div>',
			'panel'       => 'bgtfw_design_panel',
			'capability'  => 'edit_theme_options',
			'icon'        => 'dashicons-admin-comments',
			'edit_vars'   => array(
				array(
					'selector'    => '.comments ol.comment-list li.comment',
					'label'       => __( 'Comments', 'crio' ),
					'description' => __( 'Customize the design of your page / post comments', 'crio' ),
				),
			),
		);

		return $config;
	}

	/**
	 * Add the Comments sections.
	 *
	 * @since 1.9.0
	 *
	 * @param array $config Array of configrations for BGTFW.
	 *
	 * @return array $config Array of configrations for BGTFW.
	 */
	public function add_sections( $config ) {
		$config['customizer']['sections']['bgtfw_comments_colors'] = array(
			'title'       => __( 'Colors', 'crio' ),
			'description' => esc_html__( 'Change the colors of your Comment elements.', 'crio' ),
			'panel'       => 'bgtfw_comments',
			'capability'  => 'edit_theme_options',
			'priority'    => 1,
			'icon'        => 'dashicons-art',
		);

		$config['customizer']['sections']['bgtfw_comments_content'] = array(
			'title'       => __( 'Content', 'crio' ),
			'description' => esc_html__( 'Choose various options for the content of your comments such as button design, and gravitar placement.', 'crio' ),
			'panel'       => 'bgtfw_comments',
			'capability'  => 'edit_theme_options',
			'priority'    => 2,
			'icon'        => 'dashicons-welcome-widgets-menus',
		);

		$config['customizer']['sections']['bgtfw_comments_advanced'] = array(
			'title'       => __( 'Advanced', 'crio' ),
			'description' => esc_html__( 'Advanced settings for the appearance of your site\'s comments.', 'crio' ),
			'panel'       => 'bgtfw_comments',
			'capability'  => 'edit_theme_options',
			'priority'    => 3,
			'icon'        => 'dashicons-admin-generic',
		);

		$config = $this->add_advanced_sections( $config );

		return $config;
	}

	/**
	 * Add the Comments advanced sections.
	 *
	 * @since 1.9.0
	 *
	 * @param array $config Array of configrations for BGTFW.
	 *
	 * @return array $config Array of configrations for BGTFW.
	 */
	public function add_advanced_sections( $config ) {
		$config['customizer']['sections']['bgtfw_comments_margin_section'] = array(
			'title'       => __( 'Margin', 'crio' ),
			'panel'       => 'bgtfw_comments',
			'section'     => 'bgtfw_comments_advanced',
			'description' => esc_html__( 'Change the margin of your comments.', 'crio' ),
			'capability'  => 'edit_theme_options',
		);

		$config['customizer']['sections']['bgtfw_comments_padding_section'] = array(
			'title'       => __( 'Padding', 'crio' ),
			'panel'       => 'bgtfw_comments',
			'section'     => 'bgtfw_comments_advanced',
			'description' => esc_html__( 'Change the padding of your comments.', 'crio' ),
			'capability'  => 'edit_theme_options',
		);

		$config['customizer']['sections']['bgtfw_comments_border_section'] = array(
			'title'       => __( 'Border', 'crio' ),
			'panel'       => 'bgtfw_comments',
			'section'     => 'bgtfw_comments_advanced',
			'description' => esc_html__( 'Change the border of your comments.', 'crio' ),
			'capability'  => 'edit_theme_options',
		);

		$config['customizer']['sections']['bgtfw_comments_shadow_section'] = array(
			'title'       => __( 'Box Shadow', 'crio' ),
			'panel'       => 'bgtfw_comments',
			'section'     => 'bgtfw_comments_advanced',
			'description' => esc_html__( 'Change the box shadow of your comments.', 'crio' ),
			'capability'  => 'edit_theme_options',
		);

		return $config;
	}

	/**
	 * Add the Comments controls.
	 *
	 * @since 1.9.0
	 *
	 * @param array $config Array of configrations for BGTFW.
	 *
	 * @return array $config Array of configrations for BGTFW.
	 */
	public function add_controls( $config ) {

		$config = $this->add_color_controls( $config );

		// Buttons
		$config['customizer']['controls']['bgtfw_comment_reply_button_class'] = array(
			'type'              => 'radio-buttonset',
			'settings'          => 'bgtfw_comment_reply_button_class',
			'transport'         => 'postMessage',
			'label'             => esc_html__( 'Comment Reply Format', 'crio' ),
			'default'           => 'button-primary',
			'choices'           => array(
				'button-primary'   => esc_html__( 'Primary', 'crio' ),
				'button-secondary' => esc_html__( 'Secondary', 'crio' ),
				'link'             => esc_html__( 'Link', 'crio' ),
			),
			'section'           => 'bgtfw_comments_content',
			'sanitize_callback' => function( $value, $settings ) {
				return 'button-primary' === $value || 'button-secondary' === $value || 'link' === $value ?
					$value :
					$settings->default;
			},
		);

		// Avatar
		$config['customizer']['controls']['bgtfw_comments_avatar_display'] = array(
			'type'              => 'radio-buttonset',
			'settings'          => 'bgtfw_comments_avatar_display',
			'transport'         => 'refresh',
			'label'             => esc_html__( 'Avatar Display', 'crio' ),
			'default'           => 'pull-left',
			'choices'           => array(
				'pull-left'  => esc_html__( 'Left', 'crio' ),
				'pull-right' => esc_html__( 'Right', 'crio' ),
				'inside'     => esc_html__( 'Inside Heading', 'crio' ),
				'hidden'     => esc_html__( 'Hidden', 'crio' ),
			),
			'section'           => 'bgtfw_comments_content',
			'sanitize_callback' => function( $value, $settings ) {
				return in_array( $value, array( 'pull-left', 'pull-right', 'inside', 'hidden' ), true ) ?
					$value :
					$settings->default;
			},
		);

		// Show / Hide Date Time
		$config['customizer']['controls']['bgtfw_comments_date_display'] = array(
			'type'      => 'switch',
			'settings'  => 'bgtfw_comments_date_display',
			'transport' => 'refresh',
			'label'     => esc_html__( 'Show Date / Time', 'crio' ),
			'section'   => 'bgtfw_comments_content',
			'default'   => true,
			'priority'  => 11,
			'choices'   => array(
				'on'  => esc_html__( 'Show', 'crio' ),
				'off' => esc_html__( 'Hide', 'crio' ),
			),
		);

		// Allowed tags.
		$config['customizer']['controls']['bgtfw_comments_show_allowed_tags'] = array(
			'type'      => 'switch',
			'settings'  => 'bgtfw_comments_show_allowed_tags',
			'transport' => 'refresh',
			'label'     => esc_html__( 'Show Allowed Tags', 'crio' ),
			'section'   => 'bgtfw_comments_content',
			'default'   => true,
			'priority'  => 12,
			'choices'   => array(
				'on'  => esc_html__( 'Show', 'crio' ),
				'off' => esc_html__( 'Hide', 'crio' ),
			),
		);

		$config = $this->add_advanced_controls( $config );

		return $config;
	}

	/**
	 * Add color controls.
	 *
	 * @since 1.9.0
	 *
	 * @param array $config Array of configrations for BGTFW.
	 *
	 * @return array $config Array of configrations for BGTFW.
	 */
	public function add_color_controls( $config ) {
		$valid_color_values = array_keys( $this->customizer_base->formatted_palette );

		$config['customizer']['controls']['bgtfw_comments_header_background'] = array(
			'type'              => 'bgtfw-palette-selector',
			'transport'         => 'postMessage',
			'settings'          => 'bgtfw_comments_header_background',
			'label'             => esc_attr__( 'Header Background Color', 'crio' ),
			'section'           => 'bgtfw_comments_colors',
			'priority'          => 1,
			'default'           => 'color-2',
			'choices'           => array(
				'selector' => '.comments ol.comment-list .comment .comment-body .panel-heading',
				'colors'   => $this->customizer_base->formatted_palette,
				'size'     => $this->customizer_base->palette->get_palette_size( $this->customizer_base->formatted_palette ),
			),
			'sanitize_callback' => array( $this, 'sanitize_color' ),
		);

		$config['customizer']['controls']['bgtfw_comments_header_links'] = array(
			'type'              => 'bgtfw-palette-selector',
			'transport'         => 'postMessage',
			'settings'          => 'bgtfw_comments_header_links',
			'priority'          => 2,
			'label'             => esc_attr__( 'Header Link Color', 'bgtfw' ),
			'section'           => 'bgtfw_comments_colors',
			'default'           => get_theme_mod( 'bgtfw_body_link_color', 'color-1' ),
			'choices'           => array(
				'selector' => array(
					'.comments ol.comment-list .comment .comment-body .panel-heading',
				),
				'colors'   => $this->customizer_base->formatted_palette,
				'size'     => $this->customizer_base->palette->get_palette_size( $this->customizer_base->formatted_palette ),
			),
			'sanitize_callback' => array( $this, 'sanitize_color' ),
		);

		$config['customizer']['controls']['bgtfw_comments_body_background'] = array(
			'type'              => 'bgtfw-palette-selector',
			'transport'         => 'postMessage',
			'settings'          => 'bgtfw_comments_body_background',
			'label'             => esc_attr__( 'Body Background Color', 'crio' ),
			'section'           => 'bgtfw_comments_colors',
			'priority'          => 3,
			'default'           => 'color-neutral',
			'choices'           => array(
				'selector' => '.comments ol.comment-list .comment .comment-body .panel-body',
				'colors'   => $this->customizer_base->formatted_palette,
				'size'     => $this->customizer_base->palette->get_palette_size( $this->customizer_base->formatted_palette ),
			),
			'sanitize_callback' => array( $this, 'sanitize_color' ),
		);

		$config['customizer']['controls']['bgtfw_comments_body_links'] = array(
			'type'              => 'bgtfw-palette-selector',
			'transport'         => 'postMessage',
			'settings'          => 'bgtfw_comments_body_links',
			'label'             => esc_attr__( 'Body Link Color', 'bgtfw' ),
			'section'           => 'bgtfw_comments_colors',
			'priority'          => 4,
			'default'           => get_theme_mod( 'bgtfw_body_link_color', 'color-1' ),
			'choices'           => array(
				'selector' => array(
					'.comments ol.comment-list .comment .comment-body .panel-body',
				),
				'colors'   => $this->customizer_base->formatted_palette,
				'size'     => $this->customizer_base->palette->get_palette_size( $this->customizer_base->formatted_palette ),
			),
			'sanitize_callback' => array( $this, 'sanitize_color' ),
		);

		$config['customizer']['controls']['bgtfw_comments_footer_background'] = array(
			'type'              => 'bgtfw-palette-selector',
			'transport'         => 'postMessage',
			'settings'          => 'bgtfw_comments_footer_background',
			'label'             => esc_attr__( 'Footer Background Color', 'crio' ),
			'section'           => 'bgtfw_comments_colors',
			'priority'          => 5,
			'default'           => 'color-2',
			'choices'           => array(
				'selector' => '.comments ol.comment-list .comment .comment-body .panel-footer',
				'colors'   => $this->customizer_base->formatted_palette,
				'size'     => $this->customizer_base->palette->get_palette_size( $this->customizer_base->formatted_palette ),
			),
			'sanitize_callback' => array( $this, 'sanitize_color' ),
		);

		$config['customizer']['controls']['bgtfw_comments_footer_links'] = array(
			'type'              => 'bgtfw-palette-selector',
			'transport'         => 'postMessage',
			'settings'          => 'bgtfw_comments_footer_links',
			'label'             => esc_attr__( 'Footer Link Color', 'bgtfw' ),
			'section'           => 'bgtfw_comments_colors',
			'priority'          => 6,
			'default'           => get_theme_mod( 'bgtfw_body_link_color', 'color-1' ),
			'choices'           => array(
				'selector' => array(
					'.comments ol.comment-list .comment .comment-body .panel-footer',
				),
				'colors'   => $this->customizer_base->formatted_palette,
				'size'     => $this->customizer_base->palette->get_palette_size( $this->customizer_base->formatted_palette ),
			),
			'sanitize_callback' => array( $this, 'sanitize_color' ),
		);

		return $config;
	}

	/**
	 * Add advanced controls.
	 *
	 * @since 1.9.0
	 *
	 * @param array $config Array of configrations for BGTFW.
	 *
	 * @return array $config Array of configrations for BGTFW.
	 */
	public function add_advanced_controls( $config ) {
		// Margins.
		$config['customizer']['controls']['bgtfw_comments_margin'] = array(
			'type'              => 'kirki-generic',
			'transport'         => 'postMessage',
			'section'           => 'bgtfw_comments_margin_section',
			'settings'          => 'bgtfw_comments_margin',
			'label'             => '',
			'default'           => array(
				array(
					'media'    => array( 'base' ),
					'unit'     => 'px',
					'isLinked' => false,
					'values'   => array(
						'right'  => 0,
						'left'   => 0,
						'bottom' => 20,
						'top'    => 0,
					),
				),
			),
			'sanitize_callback' => array( 'Boldgrid_Framework_Customizer_Generic', 'sanitize' ),
			'choices'           => array(
				'name'     => 'boldgrid_controls',
				'type'     => 'Margin',
				'settings' => array(
					'responsive' => Boldgrid_Framework_Customizer_Generic::$device_sizes,
					'control'    => array(
						'selectors' => array( '.comments ol.comment-list li.comment .comment-body' ),
						'sliders'   => array(
							array(
								'name'        => 'top',
								'label'       => 'Top',
								'cssProperty' => 'margin-top',
							),
							array(
								'name'        => 'right',
								'label'       => 'Right',
								'cssProperty' => 'margin-right',
							),
							array(
								'name'        => 'bottom',
								'label'       => 'Bottom',
								'cssProperty' => 'margin-bottom',
							),
							array(
								'name'        => 'left',
								'label'       => 'Left',
								'cssProperty' => 'margin-left',
							),
						),
					),
					'slider'     => array(
						'px' => array(
							'min' => 0,
							'max' => 100,
						),
						'em' => array(
							'min' => 0,
							'max' => 5,
						),
					),
				),
			),
		);

		// Padding.
		$config['customizer']['controls']['bgtfw_comments_padding'] = array(
			'type'              => 'kirki-generic',
			'transport'         => 'postMessage',
			'section'           => 'bgtfw_comments_padding_section',
			'settings'          => 'bgtfw_comments_padding',
			'label'             => '',
			'default'           => array(
				array(
					'media'    => array( 'base' ),
					'unit'     => 'px',
					'isLinked' => false,
					'values'   => array(
						'right'  => 15,
						'left'   => 15,
						'bottom' => 10,
						'top'    => 10,
					),
				),
			),
			'sanitize_callback' => array( 'Boldgrid_Framework_Customizer_Generic', 'sanitize' ),
			'choices'           => array(
				'name'     => 'boldgrid_controls',
				'type'     => 'Padding',
				'settings' => array(
					'responsive' => Boldgrid_Framework_Customizer_Generic::$device_sizes,
					'control'    => array(
						'selectors' => array(
							'.comments ol.comment-list .comment .comment-body .panel-heading',
							'.comments ol.comment-list .comment .comment-body .panel-body',
							'.comments ol.comment-list .comment .comment-body .panel-footer',
						),
						'sliders'   => array(
							array(
								'name'        => 'top',
								'label'       => 'Top',
								'cssProperty' => 'padding-top',
							),
							array(
								'name'        => 'right',
								'label'       => 'Right',
								'cssProperty' => 'padding-right',
							),
							array(
								'name'        => 'bottom',
								'label'       => 'Bottom',
								'cssProperty' => 'padding-bottom',
							),
							array(
								'name'        => 'left',
								'label'       => 'Left',
								'cssProperty' => 'padding-left',
							),
						),
					),
				),
			),
		);

		// Border Controls.
		$config['customizer']['controls']['bgtfw_comments_border'] = array(
			'type'              => 'kirki-generic',
			'transport'         => 'postMessage',
			'section'           => 'bgtfw_comments_border_section',
			'settings'          => 'bgtfw_comments_border',
			'priority'          => 10,
			'label'             => '',
			'default'           => array(
				array(
					'media'    => array( 'base' ),
					'unit'     => 'px',
					'isLinked' => false,
					'values'   => array(
						'right'  => 1,
						'left'   => 1,
						'bottom' => 1,
						'top'    => 1,
					),
					'type'     => 'solid',
				),
			),
			'sanitize_callback' => array( 'Boldgrid_Framework_Customizer_Generic', 'sanitize' ),
			'choices'           => array(
				'name'     => 'boldgrid_controls',
				'type'     => 'Border',
				'settings' => array(
					'responsive' => Boldgrid_Framework_Customizer_Generic::$device_sizes,
					'control'    => array(
						'selectors' => array(
							'.comments ol.comment-list .comment .comment-body .panel',
							'.comments ol.comment-list .comment .comment-body .panel-heading',
							'.comments ol.comment-list .comment .comment-body .panel-footer',
						),
					),
				),
			),
		);

		$config['customizer']['controls']['bgtfw_comments_border_color'] = array(
			'type'              => 'bgtfw-palette-selector',
			'transport'         => 'postMessage',
			'settings'          => 'bgtfw_comments_border_color',
			'label'             => esc_attr__( 'Border Color', 'crio' ),
			'section'           => 'bgtfw_comments_border_section',
			'priority'          => 20,
			'default'           => 'color-2',
			'choices'           => array(
				'colors' => $this->customizer_base->formatted_palette,
				'size'   => $this->customizer_base->palette->get_palette_size( $this->customizer_base->formatted_palette ),
			),
			'sanitize_callback' => array( $this->customizer_base->sanitize, 'sanitize_palette_selector' ),
		);

		$config['customizer']['controls']['bgtfw_comments_border_radius_top'] = array(
			'type'              => 'kirki-generic',
			'transport'         => 'postMessage',
			'section'           => 'bgtfw_comments_border_section',
			'settings'          => 'bgtfw_comments_border_radius_top',
			'priority'          => 30,
			'label'             => '',
			'default'           => array(
				array(
					'media'    => array( 'base' ),
					'unit'     => 'px',
					'isLinked' => true,
					'values'   => array(
						'top-right' => 4,
						'top-left'  => 4,
					),
				),
			),
			'sanitize_callback' => array( 'Boldgrid_Framework_Customizer_Generic', 'sanitize' ),
			'choices'           => array(
				'name'     => 'boldgrid_controls',
				'type'     => 'BorderRadius',
				'settings' => array(
					'responsive' => Boldgrid_Framework_Customizer_Generic::$device_sizes,
					'control'    => array(
						'title'     => esc_html__( 'Border Radius Top', 'crio' ),
						'name'      => 'border-radius-top',
						'selectors' => array(
							'.comments ol.comment-list .comment .comment-body .panel',
							'.comments ol.comment-list .comment .comment-body .panel-heading',
						),
						'sliders'   => array(
							array(
								'name'        => 'top-left',
								'label'       => 'Top Left',
								'cssProperty' => 'border-top-left-radius',
							),
							array(
								'name'        => 'top-right',
								'label'       => 'Top Right',
								'cssProperty' => 'border-top-right-radius',
							),
						),
					),
				),
			),
		);

		$config['customizer']['controls']['bgtfw_comments_border_radius_bottom'] = array(
			'type'              => 'kirki-generic',
			'transport'         => 'postMessage',
			'section'           => 'bgtfw_comments_border_section',
			'settings'          => 'bgtfw_comments_border_radius_bottom',
			'priority'          => 30,
			'label'             => '',
			'default'           => array(
				array(
					'media'    => array( 'base' ),
					'unit'     => 'px',
					'isLinked' => true,
					'values'   => array(
						'bottom-right' => 4,
						'bottom-left'  => 4,
					),
				),
			),
			'sanitize_callback' => array( 'Boldgrid_Framework_Customizer_Generic', 'sanitize' ),
			'choices'           => array(
				'name'     => 'boldgrid_controls',
				'title'    => esc_html__( 'Border Radius Bottom', 'crio' ),
				'type'     => 'BorderRadius',
				'settings' => array(
					'responsive' => Boldgrid_Framework_Customizer_Generic::$device_sizes,
					'control'    => array(
						'title'     => esc_html__( 'Border Radius Bottom', 'crio' ),
						'name'      => 'border-radius-bottom',
						'selectors' => array(
							'.comments ol.comment-list .comment .comment-body .panel',
							'.comments ol.comment-list .comment .comment-body .panel-footer',
						),
						'sliders'   => array(
							array(
								'name'        => 'bottom-left',
								'label'       => 'Bottom Left',
								'cssProperty' => 'border-bottom-left-radius',
							),
							array(
								'name'        => 'bottom-right',
								'label'       => 'Bottom Right',
								'cssProperty' => 'border-bottom-right-radius',
							),
						),
					),
				),
			),
		);

		// Box Shadow Control.
		$config['customizer']['controls']['bgtfw_comments_shadow'] = array(
			'type'              => 'kirki-generic',
			'transport'         => 'postMessage',
			'section'           => 'bgtfw_comments_shadow_section',
			'settings'          => 'bgtfw_comments_shadow',
			'label'             => '',
			'default'           => '',
			'sanitize_callback' => array( 'Boldgrid_Framework_Customizer_Generic', 'sanitize' ),
			'choices'           => array(
				'name'     => 'boldgrid_controls',
				'type'     => 'BoxShadow',
				'settings' => array(
					'responsive' => Boldgrid_Framework_Customizer_Generic::$device_sizes,
					'control'    => array(
						'selectors' => array( '.comments ol.comment-list .comment .comment-body .panel' ),
					),
				),
			),
		);

		return $config;
	}
}
