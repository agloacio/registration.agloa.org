<?php

/**
 * File: class=crio-premium-header-templates-customizer-controls.php
 *
 * Adds the Header Template Customizer Controls
 *
 * @link       https://www.boldgrid.com/
 * @since      1.1.0
 *
 * @package    Crio_Premium
 * @subpackage Crio_Premium/includes/Page_Headers
 */

/**
 * Class: Crio_Premium_Page_Headers_Customizer_Controls
 *
 * This Class Handles the creation and rendering of customizer controls
 * for the header templates.
 */
class Crio_Premium_Page_Headers_Customizer_Controls {

	/**
	 * Header Templates Base
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_Base
	 */
	public $base;

	/**
	 * Support URL
	 *
	 * URL for the Page Headers Support article;
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_Base
	 */
	public $support_url;

	/**
	 * Constructor
	 *
	 * @since 1.1.0
	 *
	 * @param Crio_Premium_Page_Headers_Base $page_headers_base Page Headers Base object.
	 */
	public function __construct( $base ) {
		$this->base        = $base;
		$this->support_url = 'https://www.boldgrid.com/support/boldgrid-crio-supertheme-product-guide/page-headers/?source=customize-page-headers';
	}

	/**
	 * Load Customizer Specific Scripts
	 *
	 * @since 1.1.0
	 */
	public function load_customizer_scripts() {
		wp_register_script(
			'crio-premium-customizer',
			plugin_dir_url( WP_PLUGIN_DIR . '/crio-premium/admin/js/crio-premium-customizer.js' ) . 'crio-premium-customizer.js',
			array( 'jquery', 'customize-controls' ),
			CRIO_PREMIUM_VERSION,
			true
		);

		wp_localize_script(
			'crio-premium-customizer',
			'CrioPremiumUrls',
			$this->get_control_urls()
		);

		wp_enqueue_script( 'crio-premium-customizer' );
	}

	/**
	 * Get Control Urls
	 *
	 * Creates an array of urls to redirect to
	 * when making changes to the page / post type
	 * controls.
	 *
	 * @since 1.1.0
	 *
	 * @return array An array of urls to direct to in preview pane.
	 */
	public function get_control_urls() {
		$posts = get_posts(
			array(
				'post_type'   => 'post',
				'post_status' => 'publish',
			)
		);

		$pages = get_posts(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'numberposts' => -1,
			)
		);

		$id_of_page = false;
		foreach ( $pages as $page ) {
			if ( (int) get_option( 'woocommerce_shop_page_id' ) === (int) $page->ID
				|| (int) get_option( 'woocommerce_myaccount_page_id' ) === (int) $page->ID
				|| (int) get_option( 'woocommerce_checkout_page_id' ) === (int) $page->ID
				|| (int) get_option( 'woocommerce_cart_page_id' ) === (int) $page->ID
				|| (int) get_option( 'woocommerce_terms_page_id' ) === (int) $page->ID
				|| (int) get_option( 'page_on_front' ) === (int) $page->ID
				|| (int) get_option( 'page_for_posts' ) === (int) $page->ID ) {
				continue;
			}

			$id_of_page = $page->ID;

			break;
		}

		$shop = get_option( 'woocommerce_shop_page_id' );

		$template_locations = array( 'page_headers', 'sticky_page_headers', 'page_footers' );

		$control_urls = array();

		foreach ( $template_locations as $template_location ) {
			$control_urls = array_merge(
				$control_urls,
				array(
					'bgtfw_' . $template_location . '_posts_template'  => $posts ? get_permalink( $posts[0] ) : get_home_url(),
					'bgtfw_' . $template_location . '_blog_template'   => get_post_type_archive_link( 'post' ),
					'bgtfw_' . $template_location . '_search_template' => get_home_url() . '/this-page-does-not-exist/',
					'bgtfw_' . $template_location . '_pages_template'  => $id_of_page ? get_permalink( $id_of_page ) : get_home_url(),
					'bgtfw_' . $template_location . '_home_template'   => get_home_url(),
				)
			);

			if ( function_exists( 'is_woocommerce' ) ) {
				$control_urls[ 'bgtfw_' . $template_location . '_woo_template' ] = $shop ? get_permalink( $shop ) : get_home_url();
			}
		};

		return $control_urls;
	}

	/**
	 * Page Header Configs.
	 *
	 * Set Configs for page header controls.
	 *
	 * @since 1.5.0
	 *
	 * @return array $config Configs for page header controls.
	 */
	public function page_header_configs( $config ) {
		$config['customizer']['sections']['bgtfw_page_headers'] = array(
			'title'       => __( 'Header Templates', 'crio-premium' ),
			'panel'       => 'bgtfw_header_layouts',
			'description' => '<div class="bgtfw-description"><p>' . __(
				'This section helps you to configure the Header templates used on your website.
				Here you can select which page header appears in various places.',
				'crio'
			) . '</p><div class="help"><a href="' . $this->support_url . '" target="_blank"><span class="dashicons"></span>Help</a></div></div>',
			'capability'  => 'edit_theme_options',
			'priority'    => 1,
			'icon'        => 'dashicons-table-row-before',
		);

		$config['customizer']['controls']['bgtfw_page_headers_global_enabled'] = array(
			'type'      => 'switch',
			'transport' => 'auto',
			'settings'  => 'bgtfw_page_headers_global_enabled',
			'label'     => __( 'Enable Header Templates', 'crio-premium' ),
			'section'   => 'bgtfw_page_headers',
			'priority'  => 1,
			'default'   => true,
			'choices'   => array(
				'on'  => __( 'Enabled', 'crio-premium' ),
				'off' => __( 'Disabled', 'crio-premium' ),
			),
		);

		$config['customizer']['controls']['bgtfw_page_headers_default_template'] = $this->get_template_selector( 'global', 'Global Page Header', 2 );

		$config['customizer']['controls']['bgtfw_page_headers_default_template']['description'] = (
			'<p>' . esc_html__(
				'By default, the Global Page Header will be set to use customizer settings.
				This will cause the standard customizer menu and page headers will be used instead of the new page header templates.',
				'crio-premium'
			) . '</p>
			<p>
				<a class="button goto-layout-button" data-focus-id="bgtfw_header_presets" data-focus-type="section">' .
					esc_html__( 'Edit Customizer Header Layout', 'crio-premium' ) . '</a>
				<a class="button" href="' . admin_url( 'edit.php?post_type=crio_page_header' ) . '">' . esc_html__( 'Edit Page Header Templates', 'crio-premium' ) . '</a>
			</p>'
		);

		$config['customizer']['controls']['bgtfw_page_headers_info'] = array(
			'type'            => 'generic',
			'settings'        => 'bgtfw_page_headers_info',
			'label'           => __( 'Post and Page Header Templates', 'crio-premium' ),
			'description'     => __( 'All post and page types will use the Global Page Header by default. Here, you can select a specific header to use for different post and page types.' ),
			'section'         => 'bgtfw_page_headers',
			'default'         => '',
			'choices'         => array(),
			'priority'        => 3,
			'active_callback' => function() {
				$global_headers_enabled = get_theme_mod( 'bgtfw_page_headers_global_enabled' );
				return $this->available_templates_exist( 'header' ) && $global_headers_enabled;
			},
		);

		$config['customizer']['controls']['bgtfw_no_page_headers_set'] = array(
			'type'            => 'generic',
			'settings'        => 'bgtfw_no_page_headers_set',
			'label'           => __( 'No Page Headers have been Created', 'crio-premium' ),
			'description'     => '<a class="button" href="' . admin_url( 'edit.php?post_type=crio_page_header' ) . '">' . esc_html__( 'Click Here to Create a New Page Header', 'crio-premium' ) . '</a>',
			'section'         => 'bgtfw_page_headers',
			'default'         => '',
			'choices'         => array(),
			'priority'        => 3,
			'active_callback' => function() {
				$global_headers_enabled = get_theme_mod( 'bgtfw_page_headers_global_enabled' );
				return ! $this->available_templates_exist( 'header' ) && $global_headers_enabled;
			},
		);

		if ( get_option( 'fresh_site' ) ) {
			$config['customizer']['controls']['bgtfw_no_page_headers_set']['description'] = 'For a better user experience, we recommend publishing the starter content before creating new header templates. <a class="button customizer_install_samples" href="' . admin_url( 'edit.php?post_type=crio_page_header' ) . '">' . esc_html__( 'Click Here to Create a New Page Header', 'crio-premium' ) . '</a>';
		}

		return $config;
	}

	/**
	 * Sticky Header Configs.
	 *
	 * Set Configs for sticky header controls.
	 *
	 * @since 1.5.0
	 */
	public function sticky_header_configs( $config ) {
		$config['customizer']['sections']['bgtfw_sticky_page_headers'] = array(
			'title'       => __( 'Sticky Header Templates', 'crio-premium' ),
			'panel'       => 'bgtfw_sticky_header_layouts',
			'description' => '<div class="bgtfw-description"><p>' . __(
				'This section helps you to configure the Page Headers used on the sticky header of your website.
				Here you can select which page header appears in various places.',
				'crio'
			) . '</p><div class="help"><a href="' . $this->support_url . '" target="_blank"><span class="dashicons"></span>Help</a></div></div>',
			'capability'  => 'edit_theme_options',
			'priority'    => 1,
			'icon'        => 'dashicons-cover-image',
		);

		$config['customizer']['controls']['bgtfw_sticky_page_headers_global_enabled'] = array(
			'type'      => 'switch',
			'transport' => 'auto',
			'settings'  => 'bgtfw_sticky_page_headers_global_enabled',
			'label'     => __( 'Enable Sticky Header Templates', 'crio-premium' ),
			'section'   => 'bgtfw_sticky_page_headers',
			'priority'  => 1,
			'default'   => true,
			'choices'   => array(
				'on'  => __( 'Enabled', 'crio-premium' ),
				'off' => __( 'Disabled', 'crio-premium' ),
			),
		);

		$config['customizer']['controls']['bgtfw_sticky_page_headers_default_template'] = $this->get_template_selector( 'global', 'Global Sticky Header Template', 2, 'sticky-header' );

		$config['customizer']['controls']['bgtfw_sticky_page_headers_default_template']['description'] = (
			'<p>' . esc_html__(
				'By default, the Global Page Header will be set to use customizer settings.
				This will cause the standard customizer menu and page headers will be used instead of the new page header templates.',
				'crio-premium'
			) . '</p>
			<p>
				<a class="button goto-layout-button" data-focus-id="bgtfw_sticky_header_layout_advanced" data-focus-type"section">' .
					esc_html__( 'Edit Customizer Sticky Header Layout', 'crio-premium' ) .
				'</a>
				<a class="button" href="' . admin_url( 'edit.php?post_type=crio_page_header&template_locations=sticky-header' ) . '">' . esc_html__( 'Edit Sticky Header Templates', 'crio-premium' ) . '</a>
			</p>'
		);

		$config['customizer']['controls']['bgtfw_sticky_page_headers_info'] = array(
			'type'            => 'generic',
			'settings'        => 'bgtfw_sticky_page_headers_info',
			'label'           => __( 'Post and Page Sticky Header Templates', 'crio-premium' ),
			'description'     => __( 'All post and page types will use the Global Sticky Page Header by default. Here, you can select a specific header to use for different post and page types.' ),
			'section'         => 'bgtfw_sticky_page_headers',
			'default'         => '',
			'choices'         => array(),
			'priority'        => 3,
			'active_callback' => function() {
				$global_headers_enabled = get_theme_mod( 'bgtfw_sticky_page_headers_global_enabled' );
				return $this->available_templates_exist( 'sticky-header' ) && $global_headers_enabled;
			},
		);

		$config['customizer']['controls']['bgtfw_no_sticky_page_headers_set'] = array(
			'type'            => 'generic',
			'settings'        => 'bgtfw_no_sticky_page_headers_set',
			'label'           => __( 'No Page Headers have been Created', 'crio-premium' ),
			'description'     => '<a class="button" href="' . admin_url( 'edit.php?post_type=crio_page_headertemplate_locations=sticky-header' ) . '">' . esc_html__( 'Click Here to Create a New Page Header', 'crio-premium' ) . '</a>',
			'section'         => 'bgtfw_sticky_page_headers',
			'default'         => '',
			'choices'         => array(),
			'priority'        => 3,
			'active_callback' => function() {
				$global_headers_enabled = get_theme_mod( 'bgtfw_sticky_page_headers_global_enabled' );
				return ! $this->available_templates_exist( 'sticky-header' ) && $global_headers_enabled;
			},
		);

		if ( get_option( 'fresh_site' ) ) {
			$config['customizer']['controls']['bgtfw_no_sticky_page_headers_set']['description'] = 'For a better user experience, we recommend publishing the starter content before creating new header templates. <a class="button customizer_install_samples" href="' . admin_url( 'edit.php?post_type=crio_page_header' ) . '">' . esc_html__( 'Click Here to Create a New Page Header', 'crio-premium' ) . '</a>';
		}

		return $config;
	}

	/**
	 * Footer Template Configs.
	 *
	 * Set Configs for footer template controls.
	 *
	 * @since 1.5.0
	 *
	 * @return array $configs Configs for page header controls.
	 */
	public function footer_template_configs( $config ) {
		$config['customizer']['sections']['bgtfw_page_footers'] = array(
			'title'       => __( 'Footer Templates', 'crio-premium' ),
			'panel'       => 'bgtfw_footer',
			'description' => '<div class="bgtfw-description"><p>' . __(
				'This section helps you to configure the Footer Templates used on your website.
				Here you can select which footer template appears in various places.',
				'crio'
			) . '</p><div class="help"><a href="' . $this->support_url . '" target="_blank"><span class="dashicons"></span>Help</a></div></div>',
			'capability'  => 'edit_theme_options',
			'priority'    => 1,
			'icon'        => 'dashicons-table-row-before',
		);

		$config['customizer']['controls']['bgtfw_page_footers_global_enabled'] = array(
			'type'      => 'switch',
			'transport' => 'auto',
			'settings'  => 'bgtfw_page_footers_global_enabled',
			'label'     => __( 'Enable Footer Templates', 'crio-premium' ),
			'section'   => 'bgtfw_page_footers',
			'priority'  => 1,
			'default'   => true,
			'choices'   => array(
				'on'  => __( 'Enabled', 'crio-premium' ),
				'off' => __( 'Disabled', 'crio-premium' ),
			),
		);

		$config['customizer']['controls']['bgtfw_page_footers_default_template'] = $this->get_template_selector( 'global', 'Global Footer Template', 2, 'footer' );

		$config['customizer']['controls']['bgtfw_page_footers_default_template']['description'] = (
			'<p>' . esc_html__(
				'By default, the Global Footer Template will be set to use the footer layout in your customizer settings.
				This will cause the standard customizer footer layout to be used instead of the new footer templates.',
				'crio-premium'
			) . '</p>
			<p>
				<a class="button goto-layout-button" data-focus-type="section" data-focus-id="boldgrid_footer_panel">' . esc_html__( 'Edit Customizer Footer Layout', 'crio-premium' ) . '</a>
				<a class="button" href="' . admin_url( 'edit.php?post_type=crio_page_header&template_locations=footer' ) . '">' . esc_html__( 'Edit Footer Templates', 'crio-premium' ) . '</a>
			</p>'
		);

		$config['customizer']['controls']['bgtfw_page_footers_info'] = array(
			'type'            => 'generic',
			'settings'        => 'bgtfw_page_footers_info',
			'label'           => __( 'Post and Page Footer Templates', 'crio-premium' ),
			'description'     => __( 'All post and page types will use the Global Footer Template by default. Here, you can select a specific footer template to use for different post and page types.' ),
			'section'         => 'bgtfw_page_footers',
			'default'         => '',
			'choices'         => array(),
			'priority'        => 3,
			'active_callback' => function() {
				$global_headers_enabled = get_theme_mod( 'bgtfw_page_footers_global_enabled' );
				return $this->available_templates_exist( 'footer' ) && $global_headers_enabled;
			},
		);

		$config['customizer']['controls']['bgtfw_no_page_footers_set'] = array(
			'type'            => 'generic',
			'settings'        => 'bgtfw_no_page_footers_set',
			'label'           => __( 'No Footer Templates have been Created', 'crio-premium' ),
			'description'     => '<a class="button" href="' . admin_url( 'edit.php?post_type=crio_page_header&template_locations=footer' ) . '">' . esc_html__( 'Click Here to Create a New Footer Template', 'crio-premium' ) . '</a>',
			'section'         => 'bgtfw_page_footers',
			'default'         => '',
			'choices'         => array(),
			'priority'        => 3,
			'active_callback' => function() {
				$global_headers_enabled = get_theme_mod( 'bgtfw_page_footers_global_enabled' );
				return ! $this->available_templates_exist( 'footer' ) && $global_headers_enabled;
			},
		);

		if ( get_option( 'fresh_site' ) ) {
			$config['customizer']['controls']['bgtfw_no_page_footers_set']['description'] = 'For a better user experience, we recommend publishing the starter content before creating new header templates. <a class="button customizer_install_samples" href="' . admin_url( 'edit.php?post_type=crio_page_header' ) . '">' . esc_html__( 'Click Here to Create a New Footer Template', 'crio-premium' ) . '</a>';
		}

		return $config;
	}

	/**
	 * Get Post and Page Types
	 *
	 * @since 1.5.0
	 *
	 * @return array
	 */
	public function get_post_types() {
		$post_page_types = array(
			'pages'  => __( 'Pages', 'crio-premium' ),
			'posts'  => __( 'Posts', 'crio-premium' ),
			'home'   => __( 'Home Page', 'crio-premium' ),
			'blog'   => __( 'Blog page', 'crio-premium' ),
			'search' => __( '404, Search & Archives', 'crio-premium' ),
		);

		if ( function_exists( 'is_woocommerce' ) ) {
			$post_page_types['woo'] = __( 'WooCommerce Shop pages', 'crio-premium' );
		}

		return $post_page_types;
	}

	/**
	 * Add Customizer Controls
	 *
	 * @since 1.1.0
	 */
	public function add_customizer_controls( $config ) {
		// Adds controls for Page Headers.
		$config = $this->page_header_configs( $config );

		// Adds controls for Sticky Headers
		$config = $this->sticky_header_configs( $config );

		// Adds controls for Footer Templates.
		$config = $this->footer_template_configs( $config );

		// Get Post Page Types.
		$post_page_types = $this->get_post_types();

		// Add controls for each page & post type.
		$config = $this->template_section_controls( $config, $post_page_types );

		return $config;
	}

	public function filter_template_location( $control ) {
		if ( isset( $control['settings'] ) && preg_match( '/bgtfw_.*_template$/', $control['settings'] ) ) {
			$slug     = strpos( $control['settings'], 'global' ) ? 'global' : null;
			$location = 'header';
			if ( false !== strpos( $control['settings'], 'sticky' ) ) {
				$location = 'sticky-header';
			} elseif ( false !== strpos( $control['settings'], 'footer' ) ) {
				$location = 'footer';
			}
			$control['choices'] = $this->get_template_choices( $location, $slug );
		}
		return $control;
	}

	/**
	 * Available Templates Exist
	 *
	 * Returns true if there are available templates,
	 * false if there are not.
	 *
	 * @since 1.1.0
	 *
	 * @return bool Whether templates exist.
	 */
	public function available_templates_exist( $template_type = 'header' ) {
		if ( array() === $this->base->templates->get_available( $template_type, false ) ) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Add Template Section Controls.
	 *
	 * @since 1.1.0
	 *
	 * @param array $config   BGTFW Config Array.
	 * @param array $sections Array of sections to create controls for.
	 *
	 * @return array BGTFW Config Array.
	 */
	public function template_section_controls( $config, $sections ) {
		// This is the priority of the first Template section control.
		$priority = 4;

		foreach ( $sections as $slug => $label ) {
			$config['customizer']['controls'][ 'bgtfw_page_headers_' . $slug . '_template' ]        = $this->get_template_selector( $slug, $label, $priority );
			$config['customizer']['controls'][ 'bgtfw_page_footers_' . $slug . '_template' ]        = $this->get_template_selector( $slug, $label, $priority, 'footer' );
			$config['customizer']['controls'][ 'bgtfw_sticky_page_headers_' . $slug . '_template' ] = $this->get_template_selector( $slug, $label, $priority, 'sticky-header' );
			$priority++;
		}

		return $config;
	}

	/**
	 * Get Template Toggle Control
	 *
	 * @since 1.1.0
	 *
	 * @param string $slug     Section Slug.
	 * @param string $label    Section Label.
	 * @param int    $priority Control Priority.
	 */
	public function get_toggle_control( $slug, $label, $priority ) {
		return array(
			'type'            => 'toggle',
			'settings'        => 'bgtfw_page_headers_' . $slug . '_enabled',
			'label'           => $label,
			'section'         => 'bgtfw_page_headers',
			'default'         => '1',
			'priority'        => $priority,
			'active_callback' => function() {
				$global_headers_enabled = get_theme_mod( 'bgtfw_page_headers_global_enabled' );
				return $this->available_templates_exist( 'header' ) && $global_headers_enabled;
			},
		);
	}

	/**
	 * Get Template Selector Control
	 *
	 * @since 1.1.0
	 *
	 * @param string $slug     Section Slug.
	 * @param string $label    Section Label.
	 * @param int    $priority Control Priority.
	 * @param string $type     Control Type.
	 *
	 * @return array
	 */
	public function get_template_selector( $slug, $label, $priority, $template_type = 'header' ) {
		$section = 'bgtfw_page_headers';
		switch ( $template_type ) {
			case 'sticky-header':
				$section = 'bgtfw_sticky_page_headers';
				break;
			case 'footer':
				$section = 'bgtfw_page_footers';
				break;
			default:
				$section = 'bgtfw_page_headers';
				break;
		}

		$settings = $section . '_' . $slug . '_template';

		$template_selectors = array(
			'type'            => 'select',
			'settings'        => $settings,
			'label'           => $label,
			'priority'        => $priority,
			'choices'         => $this->get_template_choices( $template_type, $slug ),
			'default'         => 'global',
			'section'         => $section,
			'active_callback' => function( $control ) {
				$template_type = 'header';
				if ( false !== strpos( $control->id, 'sticky' ) ) {
					$template_type = 'sticky-header';
					$theme_mod = 'bgtfw_sticky_page_headers_global_enabled';
				} elseif ( false !== strpos( $control->id, 'footer' ) ) {
					$template_type = 'footer';
					$theme_mod = 'bgtfw_page_footers_global_enabled';
				} else {
					$theme_mod = 'bgtfw_page_headers_global_enabled';
				}
				$global_headers_enabled = get_theme_mod( $theme_mod );

				return $this->available_templates_exist( $template_type ) && $global_headers_enabled;
			},
		);

		if ( 'global' === $slug ) {
			unset( $template_selectors['choices']['optgroup1'][1]['global'] );
			$template_selectors['default'] = 'none';
		}

		return $template_selectors;
	}

	/**
	 * Get Template Choices
	 *
	 * @since 1.1.0
	 *
	 * @param string $template_type Template Type.
	 *
	 * @return array An Array of Available Templates.
	 */
	public function get_template_choices( $template_type = null, $slug = null ) {
		$available_templates = $this->base->templates->get_available( $template_type, false );

		foreach ( $available_templates as $template_id => $template_title ) {
			if ( ! $template_title ) {
				$available_templates[ $template_id ] = '( Untitled Draft )';
			}
		}

		$choices = array(
			'optgroup1' => array(
				esc_attr__( 'Default Options', 'crio-premium' ),
				array(
					'none' => esc_attr__( 'Use Customizer Settings', 'crio-premium' ),
				),
			),
			'optgroup2' => array(
				esc_attr__( 'Available Templates', 'crio-premium' ),
				$available_templates,
			),
		);

		if ( 'global' !== $slug ) {
			$choices['optgroup1'][1]['global'] = esc_attr__( 'Use Global Settings', 'crio-premium' );
		}

		if ( 'sticky-header' === $template_type ) {
			$choices['optgroup1'][1]['disabled'] = esc_attr__( 'Hide Sticky Header', 'crio-premium' );
		}

		if ( 'footer' === $template_type ) {
			$choices['optgroup1'][1]['disabled'] = esc_attr__( 'Hide Footer', 'crio-premium' );
		}

		return $choices;
	}
}
