<?php

/**
 * File: class=crio-premium-page-headers-templates-editor.php
 *
 * Handles changes that override PPB TinyMCE Editor functionality.
 *
 * @link       https://www.boldgrid.com/
 * @since      1.1.0
 *
 * @package    Crio_Premium
 * @subpackage Crio_Premium/includes/Page_Headers/Templates
 */

/**
 * Class: Crio_Premium_Page_Headers_Editor
 *
 * Handles changes that override PPB TinyMCE Editor functionality.
 */
class Crio_Premium_Page_Headers_Templates_Editor {
	/**
	 * Base
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_base
	 */
	public $base;

	/**
	 * Styles
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_Templates_Editor_Styles
	 */
	public $styles;

	/**
	 * Constructor
	 *
	 * @since 1.1.0
	 *
	 * @param Crio_Premium_Page_Headers_Base $page_headers_base Page Headers Base object.
	 */
	public function __construct( $base ) {
		$this->base   = $base;
		$this->styles = new Crio_Premium_Page_Headers_Templates_Editor_Styles( $base );
	}

	/**
	 * Load Scripts
	 *
	 * @since 1.1.0
	 *
	 * @param array $mce_settings
	 */
	public function load_scripts( $mce_settings ) {
		global $boldgrid_theme_framework;
		global $pagenow;
		$configs          = $boldgrid_theme_framework->get_configs();
		$script_url       = plugin_dir_url( WP_PLUGIN_DIR . '/crio-premium/admin/js/crio-premium-editor.js' ) . 'crio-premium-editor.js';
		$boldgrid_scripts = new Boldgrid_Framework_Scripts( $configs );

		if ( 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
			return;
		}

		$screen = get_current_screen();

		// Ensure this is only enqueued if we are on a crio_page_header custom post type.
		if ( $screen && 'crio_page_header' !== $screen->post_type ) {
			return;
		}

		wp_enqueue_script(
			'bgtfw-smartmenus',
			$configs['framework']['js_dir'] . 'smartmenus/jquery.smartmenus.min.js',
			array( 'jquery' ),
			'1.4',
			true
		);

		wp_register_script(
			'boldgrid-front-end-scripts',
			$boldgrid_scripts->get_webpack_url( $configs['framework']['js_dir'], 'front-end.min.js' ),
			array( 'jquery' ),
			$configs['version'],
			true
		);

		wp_register_script(
			'float-labels',
			$configs['framework']['js_dir'] . 'float-labels.js/float-labels.min.js',
			array(),
			$configs['version'],
			true
		);

		wp_register_script(
			'crio-premium-editor',
			$script_url,
			array( 'jquery' ),
			CRIO_PREMIUM_VERSION,
			true
		);

		wp_enqueue_script( 'boldgrid-front-end-scripts' );
		wp_enqueue_script( 'float-labels' );

		wp_enqueue_script(
			'bgtfw-modernizr',
			$configs['framework']['js_dir'] . 'modernizr.min.js',
			array( 'boldgrid-front-end-scripts' ),
			$configs['version'],
			true
		);

		wp_localize_script(
			'boldgrid-front-end-scripts',
			'highlightRequiredFields',
			array( get_option( 'woocommerce_checkout_highlight_required_fields', 'yes' ) )
		);

		wp_localize_script(
			'boldgrid-front-end-scripts',
			$boldgrid_scripts->get_asset_path(),
			array( $configs['framework']['root_uri'] )
		);

		wp_localize_script(
			'boldgrid-front-end-scripts',
			'bgtfwButtonClasses',
			$boldgrid_scripts->get_button_classes()
		);

		ob_start();
		get_template_part( 'templates/header/header', $configs['template']['header'] );
		$header = ob_get_contents();
		ob_end_clean();

		$post_meta =

		wp_localize_script(
			'crio-premium-editor',
			'CrioPremiumData',
			array(
				'ajaxUrl'             => admin_url( 'admin-ajax.php' ),
				'mceInlineStyleNonce' => wp_create_nonce( 'bgtfw_mce_inline_styles' ),
				'headerMarkup'        => $header,
				'includeSiteHeader'   => get_post_meta( get_the_ID(), 'crio-premium-include-site-header', true ),
				'mergePageHeader'     => get_post_meta( get_the_ID(), 'crio-premium-merge-site-header', true ),
				'background'          => array(
					'image'      => get_theme_mod( 'background_image' ),
					'size'       => get_theme_mod( 'boldgrid_background_image_size' ),
					'repeat'     => get_theme_mod( 'background_repeat' ),
					'attachment' => get_theme_mod( 'boldgrid_background_attachment' ),
					'type'       => get_theme_mod( 'boldgrid_background_type' ),
				),
			)
		);

		wp_localize_script(
			'crio-premium-editor',
			'BGTFW = BGTFW || {}; BGTFW.assets = BGTFW.assets || {}; BGTFW.assets.path',
			array( $configs['framework']['root_uri'] )
		);

		wp_enqueue_script( 'crio-premium-editor' );
	}

	/**
	 * Load MCE Script
	 *
	 * @since 1.1.0
	 */
	public function load_mce_script() {
		global $boldgrid_theme_framework;
		global $wp_styles;

		if ( is_admin() ) {
			$screen = get_current_screen();
			return $screen;
		}

		// Ensure this is only enqueued if we are on a crio_page_header custom post type.
		if ( $screen && 'crio_page_header' !== $screen->post_type ) {
			return;
		}

		$configs     = $boldgrid_theme_framework->get_configs();
		$script_urls = array(
			'crio-premium-front-end' => $configs['framework']['js_dir'] . 'front-end.min.js',
			'crio-premium-editor'    => plugin_dir_url( WP_PLUGIN_DIR . '/crio-premium/admin/js/crio-premium-editor.js' ) . 'crio-premium-editor-mce.js',
		);

		foreach ( $script_urls as $script => $url ) {
			// phpcs:disable
			printf(
				'<script type="text/javascript" id="%s" src="%s"></script>',
				$script,
				$url
			);
			// phpcs:enable
		}
	}

	/**
	 * WP Ajax MCE Inline Styles.
	 *
	 * Uses an AJAX call to insert inline styles in the TinyMCE editor.
	 *
	 * @since 1.5.0
	 *
	 * @return void
	 */
	public function wp_ajax_mce_inline_styles() {
		$verified = false;
		if ( isset( $_POST ) && isset( $_POST['mceInlineStyleNonce'] ) ) {
			$verified = wp_verify_nonce(
				$_POST['mceInlineStyleNonce'],
				'bgtfw_mce_inline_styles'
			);
		}

		if ( ! $verified ) {
			return false;
		}

		$mce_inline_styles = '';
		$mce_inline_styles = apply_filters( 'boldgrid_mce_inline_styles', $mce_inline_styles );

		$kirki_css          = Kirki_Modules_CSS::get_instance();
		$mce_inline_styles .= apply_filters( 'kirki_global_dynamic_css', $kirki_css::loop_controls( 'global' ) );
		$mce_inline_styles .= apply_filters( 'kirki_bgtfw_dynamic_css', $kirki_css::loop_controls( 'bgtfw' ) );

		wp_send_json_success( $mce_inline_styles );

	}

	/**
	 * Filters the preview link and adds new query args.
	 *
	 * This is the callback for the 'preview_post_link' filter.
	 * This filter is added in Crio_Premium_Page_Headers_Base::define_hooks().
	 *
	 * @since 1.6.0
	 *
	 * @param string  $preview_link The unfiltered preview link.
	 * @param WP_Post $post         The current WP_Post object.
	 *
	 * @return string
	 */
	public function filter_preview_link( $preview_link, $post ) {
		if ( 'crio_page_header' === $post->post_type ) {
			$location = get_the_terms( $post->ID, 'template_locations' );

			if ( empty( $location )
				&& isset( $_REQUEST['template_locations'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$location = $_REQUEST['template_locations']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			} elseif ( empty( $location ) ) {
				$location = 'header';
			} else {
				$location = $location[0]->slug;
			}
			$existing_args = explode( '?', $preview_link )[1];
			$existing_args = explode( '&', $existing_args );
			foreach ( $existing_args as $key => $value ) {
				if ( false !== strpos( $value, 'p=' ) ) {
					unset( $existing_args[ $key ] );
				}
			}
			$existing_args = implode( '&', $existing_args );
			$preview_link  = $this->get_preview_link( $post ) . '?' . $existing_args;
			$query_args    = array(
				'template_preview'  => 'true',
				'template_id'       => $post->ID,
				'template_location' => $location,
			);
			$preview_link  = add_query_arg( $query_args, $preview_link );
		}

		return $preview_link;
	}

	/**
	 * Determines the page or post to use for template previews.
	 *
	 * @since 1.6.0
	 *
	 * @param WP_Post $post The current WP_Post object.
	 *
	 * @return string The preview link.
	 */
	public function get_preview_link( $post ) {
		$preview_template_id = $post->ID;
		$preview_type        = 'home';
		$theme_mods          = array(
			'global' => get_theme_mod( 'bgtfw_page_headers_global_template' ),
			'pages'  => get_theme_mod( 'bgtfw_page_headers_pages_template' ),
			'posts'  => get_theme_mod( 'bgtfw_page_headers_posts_template' ),
			'home'   => get_theme_mod( 'bgtfw_page_headers_home_template' ),
			'blog'   => get_theme_mod( 'bgtfw_page_headers_blog_template' ),
			'search' => get_theme_mod( 'bgtfw_page_headers_search_template' ),
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

		$posts = get_posts(
			array(
				'post_type'   => 'post',
				'post_status' => 'publish',
			)
		);

		$preview_urls = array(
			'posts'  => $posts ? get_permalink( $posts[0] ) : get_home_url(),
			'blog'   => get_post_type_archive_link( 'post' ),
			'search' => get_home_url() . '/this-page-does-not-exist/',
			'pages'  => $id_of_page ? get_permalink( $id_of_page ) : get_home_url(),
			'home'   => get_home_url(),
			'global' => get_home_url(),
		);

		foreach ( $theme_mods as $location => $location_template_id ) {
			if ( intval( $preview_template_id ) === intval( $location_template_id ) ) {
				$preview_type = $location;
			}
		}

		$preview_url = $preview_urls[ $preview_type ];

		return $preview_url;
	}
}
