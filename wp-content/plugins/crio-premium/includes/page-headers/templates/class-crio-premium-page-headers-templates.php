<?php

/**
 * File: class=crio-premium-page-headers-templates.php
 *
 * Adds the Page Headers feature to Crio.
 *
 * @link       https://www.boldgrid.com/
 * @since      1.1.0
 *
 * @package    Crio_Premium
 * @subpackage Crio_Premium/includes/Page_Headers
 */

/**
 * Class: Crio_Premium_Page_Headers_Templates
 *
 * This is the class for managing the Custom Header Template Post Type.
 */
class Crio_Premium_Page_Headers_Templates {

	/**
	 * Page Headers Base
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_base
	 */
	public $base;

	/**
	 * Available Header Templates
	 *
	 * @since 1.1.0
	 * @var array
	 */
	public $available;

	/**
	 * Page Headers Meta
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_Templates_Meta
	 */
	public $meta;

	/**
	 * Page Headers Template Preivewer
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_Templates_Previewer
	 */
	public $previewer;

	/**
	 * Page Headers Template Navs
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_Templates_Previewer
	 */
	public $navs;

	/**
	 * Page Headers Template Editor
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_Templates_Editor
	 */
	public $editor;

	/**
	 * Page Headers Template Samples
	 *
	 * @since 1.1.0
	 * @var Crio_Premium_Page_Headers_Templates_Samples
	 */
	public $samples;

	/**
	 * Constructor
	 *
	 * @since 1.1.0
	 *
	 * @param Crio_Premium_Page_Headers_Base $page_headers_base Page Headers Base object.
	 */
	public function __construct( $base ) {
		$this->base      = $base;
		$this->available = $this->get_available();
		$this->meta      = new Crio_Premium_Page_Headers_Templates_Meta( $this->base );
		$this->editor    = new Crio_Premium_Page_Headers_Templates_Editor( $this->base );
		$this->navs      = new Crio_Premium_Page_Headers_Templates_Navs( $this->base );
		$this->samples   = new Crio_Premium_Page_Headers_Templates_Samples( $this->base );
	}

	/**
	 * Filter 'Add New' button url.
	 *
	 * This is the callback for the 'admin_url' filter.
	 * The filter is added in Crio_Premium_Page_Headers_Base::define_hooks()
	 *
	 * @since 1.1.0
	 *
	 * @param string $url     The unfiltered URL.
	 * @param string $path    The url without the domain.
	 * @param int    $blog_id The blog id.
	 *
	 * @return string The filtered URL.
	 */
	public function add_new_url( $url, $path, $blog_id ) {
		global $wp_query;

		if ( 'post-new.php?post_type=crio_page_header' !== $path ) {
			return $url;
		}

		// This check was added for 1.6.1 due to conflicts with other plugins.
		if ( isset( $wp_query ) && method_exists( $wp_query, 'get' ) ) {
			$template_locations = get_query_var( 'template_locations' );
		} else {
			$template_locations = $_REQUEST['template_locations']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}

		$url = add_query_arg( 'template_locations', $template_locations, $url );

		return $url;
	}

	/**
	 * Query Available Templates
	 *
	 * @since 1.1.0
	 *
	 * @param bool   $include_drafts    Include drafts.
	 * @param string $template_location Template location.
	 *
	 * @return array An array of available templates.
	 */
	public function get_available( $template_location = null, $include_drafts = true ) {
		$post_status = $include_drafts ? array( 'publish', 'draft' ) : array( 'publish' );
		if ( ! empty( $template_location ) ) {
			$posts = get_posts(
				array(
					'post_type'   => 'crio_page_header',
					'post_status' => $post_status,
					'numberposts' => -1,
					'tax_query'   => array(
						array(
							'taxonomy' => 'template_locations',
							'field'    => 'slug',
							'terms'    => $template_location,
						),
					),
				)
			);
		} else {
			$posts = get_posts(
				array(
					'post_type'   => 'crio_page_header',
					'post_status' => $post_status,
					'numberposts' => -1,
				)
			);
		}

		$available_templates = array();

		foreach ( $posts as $post ) {
			$available_templates[ $post->ID ] = $post->post_title;
		}
		return $available_templates;
	}

	/**
	 * Registers Page Headers Custom Post Type
	 *
	 * @since 1.1.0
	 */
	public function register_post_type() {

		set_user_setting( 'editor', 'tinymce' );

		register_post_type(
			'crio_page_header',
			array(
				'labels'              => array(
					'name'           => __( 'Custom Templates', 'crio-premium' ),
					'singlular_name' => __( 'Custom Template', 'crio-premium' ),
					'add_new_item'   => __( 'Add New Template', 'crio-premium' ),
					'edit_item'      => __( 'Edit Template', 'crio-premium' ),
					'view_items'     => __( 'Page Template', 'crio-premium' ),
				),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_rest'        => true,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'supports'            => array( 'editor', 'title', 'revisions' ),
			)
		);
	}

	/**
	 * Create Template Location Taxonomy.
	 *
	 * @since 1.5.0
	 */
	public function create_location_taxonomy() {
		// Labels part for the GUI

		$labels = array(
			'name'              => __( 'Template Location', 'bgtfw' ),
			'singular_name'     => _x( 'Template Location', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Template Locations', 'bgtfw' ),
			'all_items'         => null,
			'parent_item'       => null,
			'parent_item_colon' => null,
			'edit_item'         => __( 'Edit Template Location', 'bgtfw' ),
			'update_item'       => __( 'Update Template Location', 'bgtfw' ),
			'add_new_item'      => null,
			'new_item_name'     => null,
			'menu_name'         => __( 'Template Locations', 'bgtfw' ),
			'most_used'         => null,
		);

		// Now register the non-hierarchical taxonomy like tag

		register_taxonomy(
			'template_locations',
			'crio_page_header',
			array(
				'hierarchical'          => true,
				'labels'                => $labels,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => false,
				'show_in_rest'          => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'template_location' ),
				'meta_box_cb'           => array( $this, 'location_metabox_cb' ),
				'capabilities'          => array(
					'manage_terms' => '',
					'edit_terms'   => '',
					'delete_terms' => '',
					'assign_terms' => 'edit_posts',
				),
			)
		);

		$this->add_locations( 'template_locations' );
	}

	/**
	 * Set Custom Columns for Template Locations
	 *
	 * @param array $columns Array of Columns.
	 *
	 * @return array Array of Columns.
	 */
	public function set_custom_columns( $columns ) {
		$custom_col_order = array(
			'cb'                 => $columns['cb'],
			'title'              => $columns['title'],
			'template_locations' => __( 'Template Location', 'crio_premium' ),
			'date'               => $columns['date'],
		);

		return $custom_col_order;
	}

	/**
	 * Custom Template Column output
	 *
	 * @param string $column  Column Name.
	 * @param int    $post_id Post ID.
	 */
	public function custom_template_column( $column, $post_id ) {
		switch ( $column ) {
			case 'template_locations':
				$terms = wp_get_post_terms( $post_id, 'template_locations' );
				if ( ! empty( $terms ) ) {
					echo esc_html( $terms[0]->name );
				} else {
					echo esc_html( '' );
				}
				break;
		}
	}

	/**
	 * Adds Template locations if they haven't been added yet.
	 *
	 * @since 1.5.0
	 *
	 * @param string $taxonomy Taxonomy name.
	 */
	public function add_locations( $taxonomy ) {
		$locations = array(
			'header',
			'sticky-header',
			'footer',
		);

		foreach ( $locations as $slug ) {
			$name = ucwords( str_replace( '-', ' ', $slug ) );
			if ( ! term_exists( $slug, $taxonomy ) ) {
				wp_insert_term( $name, $taxonomy, array( 'slug' => $slug ) );
			}
		}

		$templates = get_posts(
			array(
				'post_type'   => 'crio_page_header',
				'post_status' => array( 'publish' ),
				'numberposts' => -1,
			)
		);

		foreach ( $templates as $template ) {
			$terms = wp_get_post_terms( $template->ID, $taxonomy );
			if ( empty( $terms ) ) {
				wp_set_object_terms( $template->ID, 'header', $taxonomy );
			}
		}
	}

	/**
	 * Display Movie Rating meta box
	 */
	public function location_metabox_cb( $post ) {
		$terms = get_terms(
			'template_locations',
			array(
				'hide_empty' => false,
				'orderby'    => 'term_id',
			)
		);

		$post     = get_post();
		$location = wp_get_object_terms(
			$post->ID,
			'template_locations',
			array(
				'orderby' => 'term_id',
				'order'   => 'ASC',
			)
		);
		$name     = '';

		if ( ! is_wp_error( $location ) ) {
			if ( isset( $location[0] ) && isset( $location[0]->name ) ) {
				$name = $location[0]->name;
			}
		}

		foreach ( $terms as $term ) {
			?>
			<label title='<?php echo esc_attr( $term->name ); ?>'>
				<input type="radio" name="template_locations" value="<?php echo esc_attr( $term->name ); ?>" <?php checked( $term->name, $name ); ?>>
				<span><?php echo esc_html( $term->name ); ?></span>
			</label><br>
			<?php
		}
	}

	/**
	 * Set Default Editor
	 *
	 * @since 1.1.0
	 */
	public function set_default_editor() {
		$option                     = Boldgrid_Editor_Option::get( 'default_editor' );
		$option                     = empty( $option ) ? array() : $option;
		$option['crio_page_header'] = 'bgppb';
		Boldgrid_Editor_Option::update( 'default_editor', $option );
	}

	/**
	 * Get the ID of the template being previewed.
	 *
	 * @since 2.15.0
	 *
	 * @param string $location The location of the template.
	 *
	 * @return int The ID of the template being previewed.
	 */
	public function get_template_preview( $location ) {
		$preview_id        = false;
		$template_preview  = get_query_var( 'template_preview' );
		$template_location = get_query_var( 'template_location' );
		$template_id       = get_query_var( 'template_id' );

		$location = 'sticky' === $location ? 'sticky-header' : $location;

		if ( ! $template_preview ) {
			return false;
		}

		if ( ! $template_location || $location !== $template_location ) {
			return false;
		}

		if ( $template_preview && $template_id ) {
			$preview_id = $template_id;
		}

		if ( $template_preview && $template_id ) {
			$revisions    = wp_get_post_revisions( $template_id );
			$revision_ids = array_keys( $revisions );
			$revision_id  = $revision_ids[0];
			$preview_id   = $revision_id;
		}

		return $preview_id;
	}

	/**
	 * Print Header Template to screen
	 *
	 * @since 1.1.0
	 */
	public function get_header() {
		global $boldgrid_theme_framework;
		$bgtfw_configs = $boldgrid_theme_framework->get_configs();
		if ( ! apply_filters( 'crio_premium_page_headers_enabled', false ) ) {
			return;
		}
		$current_template = apply_filters( 'crio_premium_get_page_header', get_the_ID() );

		if ( get_the_ID() === $current_template ) {
			return;
		}

		$template_meta = get_post_meta( $current_template );

		$primary_header_included = isset( $template_meta['crio-premium-include-site-header'] ) ? $template_meta['crio-premium-include-site-header'][0] : '0';

		$merge_page_header = isset( $template_meta['crio-premium-merge-site-header'] ) ? $template_meta['crio-premium-merge-site-header'][0] : '1';

		/*
		 * If the page header is included in this site header,
		 * then we need to capture the header as it is rendered using
		 * get_template_part(). This is captured and added to the $content string
		 */
		if ( ! empty( $primary_header_included ) ) {
			ob_start();
			get_template_part( 'templates/header/header', $bgtfw_configs['template']['header'] );
			$content = ob_get_contents();
			ob_end_clean();
			if ( ! empty( $merge_page_header ) ) {
				$this->merge_page_header();
				$content = str_replace( 'class="header', 'class="header merged-header', $content );
			} else {
				$content = str_replace( 'class="header', 'class="header included-site-header', $content );
			}
		} else {
			$content = '<header id="masthead" class="template-header template-' . $current_template . ' color-neutral-text-contrast color-neutral-background-color">';
		}

		// This is where we add the actual post pontent from the theme template.
		$content .= apply_filters( 'the_content', get_post_field( 'post_content', $current_template ) );

		/*
		 * The get_template_part() already prints the </header> tag,
		 * so we don't need to print that if the primary header
		 * is included.
		 */
		if ( empty( $primary_header_included ) ) {
			$content .= '</header>';
		}

		/*
		 * BGTFW prints the opening <div> tag for the #content element as part of the output of the page-title section, since that page title is
		 * printed within that section. In order to account for that, we have to manually print that tag here. However, if the page header does
		 * not contain a page title element, we need to let the default one display.
		 */
		$has_page_title = get_post_meta( $current_template, 'crio-premium-template-has-page-title', true );
		if ( $has_page_title ) {
			$content .= '</div><div id="content" ' . BoldGrid::add_class( 'site_content', array( 'site-content' ), false ) . ' role="document">';
		} else {
			$content .= '</div>';
		}

		if ( ! is_front_page() && is_home() ) {
			$id = get_option( 'page_for_posts' );
		} else {
			$id = get_the_ID();
		}
		$background_override     = get_post_meta( $id, 'crio-premium-page-header-background', true );
		$background_override_src = wp_get_attachment_image_src( $background_override, 'full' );

		$featured_image     = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
		$use_featured_image = get_post_meta( $id, 'crio-premium-page-header-featured-image-background', true );

		if ( isset( $featured_image[0] ) && '1' === $use_featured_image ) {
			$background_override_src = $featured_image;
		}

		/*
		 * These conditionals are designed to handle background image overrides for three scenarios in this order:
		 * 1. If the background-image for the section is already set in the inline styles.
		 * 2. If the background-image is NOT already set in the inline styles, but there are other inline styles existing for the .boldgrid-section element.
		 * 3. If the background-image is NOT already set in the inline styles, and there are NO other inline styles existing for the .boldgrid-section element.
		 */
		if ( isset( $background_override_src[0] ) && 1 === preg_match( "/background-image: .*url\('\S+'\)/", $content ) ) {
			$content = preg_replace(
				'/(<div[^>]*class="[^">]*boldgrid-section[^">]*"[^>]*style=")([^">]*)background-image: (.*)url\(\'\S+\'\)([^">]*"[^>]*)(>)/',
				"$1$2background-image: $3url('$background_override_src[0]')$4$5",
				$content
			);
		} elseif ( isset( $background_override_src[0] ) && 1 === preg_match( '/<div[^>]*class="[^">]*boldgrid-section[^">]*"[^">]*style="[^">]*"[^">]*>/', $content ) ) {
			$content = preg_replace( '/(<div[^>]*class="[^">]*boldgrid-section[^">]*"[^">]*)(style=")([^">]*"[^">]*>)/', "$1style=\"background-image: url('$background_override_src[0]');background-position: center;background-size: cover; $3", $content );
		} elseif ( isset( $background_override_src[0] ) && 1 === preg_match( '/<div[^>]*class="[^">]*boldgrid-section[^">]*"[^">]*[^">]*>/', $content ) ) {
			$content = preg_replace( '/(<div[^>]*class="[^">]*boldgrid-section[^">]*"[^">]*[^">]*)(>)/', "$1 style=\"background-image: url('$background_override_src[0]');background-position: center;background-size: cover;$3\">", $content );
		}

		if ( isset( $background_override_src[0] ) && 1 === preg_match( '/data-image-url="/', $content ) ) {
			$content = preg_replace( '/data-image-url=\"[^"]*\"/', "data-image-url=\"$background_override_src[0]\"", $content );
		}

		echo $content; // phpcs:ignore WordPress.XSS.EscapeOutput
	}

	/**
	 * Get the template for a page / post when in the editor.
	 *
	 * @since 1.1.0
	 *
	 * @param WP_Post $post WP_Post Object
	 *
	 * @return int Template ID.
	 */
	public function edit_post_template( $post ) {

		$global_template_id = (int) get_theme_mod( 'bgtfw_page_headers_global_template' );

		$theme_mod = '';
		if ( get_option( 'page_on_front' ) === $post->ID ) {
			$theme_mod = 'bgtfw_page_headers_home_template';
		} elseif ( get_option( 'page_for_posts' ) === $post->ID ) {
			$theme_mod = 'bgtfw_page_headers_blog_template';
		} elseif ( $this->is_woo( $post->ID ) ) {
			$theme_mod = 'bgtfw_page_headers_woo_template';
		} elseif ( 'page' === $post->post_type ) {
			$theme_mod = 'bgtfw_page_headers_pages_template';
		} else {
			$theme_mod = 'bgtfw_page_headers_posts_template';
		}

		$template = get_theme_mod( $theme_mod );

		if ( 'global' === $template && 'none' === get_theme_mod( 'bgtfw_page_headers_global_template' ) ) {
			return false;
		}

		if ( 'none' === $template ) {
			return false;
		}

		$template = 'global' === $template ? $global_template_id : (int) $template;

		return $template;
	}

	public function get_sticky_for_post( $post_id ) {
		return $this->get_for_post( $post_id, false, 'sticky' );
	}

	public function get_footer_for_post( $post_id ) {
		return $this->get_for_post( $post_id, false, 'footer' );
	}

	/**
	 * Get The template for this post
	 *
	 * Determines the correct template for a given post ID
	 *
	 * @since 1.1.0
	 *
	 * @param int  $post_id
	 * @param bool $allow_override Allow this to reflect post / page overrides.
	 *
	 * @return int Template ID.
	 */
	public function get_for_post( $post_id, $allow_override = true, $location = 'header' ) {
		$location_control_string = 'page_headers';
		switch ( $location ) {
			case 'sticky':
				$location_control_string = 'sticky_page_headers';
				break;
			case 'footer':
				$location_control_string = 'page_footers';
				break;
			default:
				$location_control_string = 'page_headers';
				break;
		}

		$preview_id = $this->get_template_preview( $location );

		if ( false !== $preview_id ) {
			return $preview_id;
		}

		/*
		 * Returning false in this method during template rendering
		 * causes the default customizer header to be displayed.
		 */
		if ( ! get_theme_mod( 'bgtfw_' . $location_control_string . '_global_enabled', true ) ) {
			return false;
		}

		$global_template_id = (int) get_theme_mod( 'bgtfw_' . $location_control_string . '_global_template' );

		$theme_mod = '';

		if ( is_front_page() && is_home() ) {
			// Default Homepage ( Latest Posts ).
			$theme_mod      = 'bgtfw_' . $location_control_string . '_home_template';
			$allow_override = false;
		} elseif ( is_front_page() ) {
			// Static Homepage.
			$theme_mod = 'bgtfw_' . $location_control_string . '_home_template';
		} elseif ( is_home() ) {
			$theme_mod = 'bgtfw_' . $location_control_string . '_blog_template';
		} elseif ( $this->is_woo( $post_id ) ) {
			$theme_mod = 'bgtfw_' . $location_control_string . '_woo_template';
		} elseif ( is_page() ) {
			// General Pages.
			$theme_mod = 'bgtfw_' . $location_control_string . '_pages_template';
		} elseif ( is_single() ) {
			// General Posts.
			$theme_mod = 'bgtfw_' . $location_control_string . '_posts_template';
		} elseif ( is_404() || is_search() || is_archive() ) {
			// Search / 404 Pages.
			$theme_mod = 'bgtfw_' . $location_control_string . '_search_template';
		}

		$template = get_theme_mod( $theme_mod );

		/*
		 * We need to only allow overriding the template if the "allow_override" flag is set to true. This is because
		 * Crio_Premium_Page_Headers_Templates_Meta::override_header_callback needs to be able to get the result of this
		 * call without the override.
		 */
		if ( true === $allow_override && 'post' === get_post_meta( $post_id, 'crio-premium-page-header-override', true ) ) {
			$template = get_post_meta( $post_id, 'crio-premium-page-header-select', true );
		}

		// These two conditionals allow sticky headers and footer template sellection to hide / disable the header / footer.
		$global_template = get_theme_mod( 'bgtfw_' . $location_control_string . '_global_template' );
		if ( ( 'sticky' === $location || 'footer' === $location ) &&
			'global' === $template && 'disabled' === $global_template ) {
				return 'disabled';
		}

		if ( ( 'sticky' === $location || 'footer' === $location ) && 'disabled' === $template ) {
				return 'disabled';
		}

		/*
		 * When this method returns false when rendering the template, the customizer template is shown instead
		 * of the page header. Therefore, if the template is set to global and the global is set to 'none',
		 * we return false.
		 */
		if ( 'global' === $template && 'none' === $global_template ) {
			return false;
		}

		if ( 'none' === $template ) {
			return false;
		}

		$template_id = 'global' === $template ? $global_template_id : (int) $template;

		return $template_id;
	}

	/**
	 * Is this a Woocommerce page.
	 *
	 * Determines if a given post_id is a woocommerce
	 * page, product, category, etc.
	 *
	 * @since 1.1.0
	 *
	 * @param int $post_id ID of the post to check.
	 *
	 * @return bool Whether or not it is a woocommerce page.
	 */
	public function is_woo( $post_id ) {
		if ( ! function_exists( 'is_woocommerce' ) ) {
			// WooCommerce is not Enabled
			return false;
		}

		/*
		 * If this is called from within the loop of the shop page,
		 * the $post_id value will be the first post listed, not the actual
		 * page's ID. Therefore we need to set the $post_id to the shop_id
		 */
		if ( is_shop() || is_product_category() ) {
			$post_id = get_option( 'woocommerce_shop_page_id' );
		}

		$post = get_post( $post_id );

		if ( $post && 'product' === $post->post_type ) {
			return true;
		}

		$option_keys = array(
			'woocommerce_shop_page_id',
			'woocommerce_terms_page_id',
			'woocommerce_cart_page_id',
			'woocommerce_checkout_page_id',
			'woocommerce_pay_page_id',
			'woocommerce_thanks_page_id',
			'woocommerce_myaccount_page_id',
			'woocommerce_edit_address_page_id',
			'woocommerce_view_order_page_id',
			'woocommerce_change_password_page_id',
			'woocommerce_logout_page_id',
			'woocommerce_lost_password_page_id',
		);

		$shop_page_ids = array();

		foreach ( $option_keys as $option_key ) {
			$id = get_option( $option_key );
			if ( $id ) {
				$shop_page_ids[] = (int) $id;
			}
		}

		if ( in_array( (int) $post_id, $shop_page_ids, true ) ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Merge Page Headers
	 *
	 * @since 1.1.0
	 */
	public function merge_page_header() {
		Boldgrid_Framework_Customizer_Generic::add_inline_style(
			'sticky-header-image-opacity',
			'#masthead { position: absolute; left: 0; right:0; background-color: rgba(0,0,0,0) !important}'
		);
	}

	/**
	 * Adjust Classes
	 *
	 * @sicne 1.9.0
	 *
	 * @param WP_Post $post Post object.
	 */
	public function adjust_classes( $post ) {

		// If not a post object, return.
		if ( ! $post instanceof WP_Post ) {
			return;
		}

		/**
		 * If the post content does not contain the class we are looking for, return.
		 * This prevents infinite recursion.
		 */
		if ( false === strpos( $post->post_content, 'bg-background-color' ) ) {
			return;
		}

		$content = $post->post_content;

		$adjusted_content = str_replace( 'bg-background-color', '', $content );

		// Only update the post if the content is changed.
		if ( $adjusted_content !== $content ) {
			wp_update_post(
				array(
					'ID'           => $post->ID,
					'post_content' => $adjusted_content,
				)
			);
		}
	}

	public function save_template_location( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['template_locations'] ) ) { // phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
			return;
		}

		$template_location = sanitize_text_field( $_POST['template_locations'] ); // phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification

		if ( ! empty( $template_location ) ) {
			$term = get_term_by( 'name', $template_location, 'template_locations' );
			if ( ! empty( $term ) && ! is_wp_error( $term ) ) {
				wp_set_object_terms( $post_id, $term->term_id, 'template_locations', false );
			}
		}
	}

	/**
	 * Actions On Save
	 *
	 * These are functions to be run anytime a template is saved or updated.
	 *
	 * @since 1.1.0
	 *
	 * @param int     $post_ID Post ID.
	 * @param WP_Post $post    Post object.
	 * @param bool    $update  Whether this is an existing post being updated.
	 */
	public function actions_on_save( $post_ID, $post, $update ) {
		$this->navs->update_menu_locations( $post );
		$this->meta->save_metadata( $post );
		$this->save_template_location( $post_ID );

		// Redirect to the go-to-customizer link if set.
		if ( isset( $_POST['go-to-customizer'] ) ) { //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
			if ( wp_safe_redirect( $_POST['go-to-customizer'] ) ) {
				exit; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
			}
		}

		// Redirect to the go-to-customizer link if set.
		if ( isset( $_POST['go-to-menu-assignment'] ) ) { //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
			if ( wp_safe_redirect( $_POST['go-to-menu-assignment'] ) ) {
				exit; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
			}
		}

		// Don't adjust classes on revisions.
		if ( ! wp_is_post_revision( $post_ID ) ) {
			$this->adjust_classes( $post );
		}
	}

	/**
	 * Actions on Delete
	 *
	 * This is run when a post is sent to the trash using the
	 * 'trash_posts' action hook. This is run for all posts, so
	 * be sure to filter for the crio_page_header post types.
	 *
	 * @since 1.1.0
	 *
	 * @param int $post_id Post ID number.
	 */
	public function actions_on_delete( $post_id ) {
		$post = get_post( $post_id );
		if ( 'crio_page_header' !== $post->post_type ) {
			return;
		}
		$options = array(
			'bgtfw_page_headers_posts_template',
			'bgtfw_page_headers_latest_template',
			'bgtfw_page_headers_blog_template',
			'bgtfw_page_headers_search_template',
			'bgtfw_page_headers_woo_template',
			'bgtfw_page_headers_pages_template',
			'bgtfw_page_headers_home_template',
		);

		/*
		 * If any of the options are set to use this template,
		 * we need to change them to use global instead.
		 */
		foreach ( $options as $option ) {
			if ( (int) get_theme_mod( $option ) === $post_id ) {
				set_theme_mod( $option, 'global' );
			}
		}

		/*
		 * If the global template is the one being deleted, this needs to revert to
		 * 'none' so that it uses the customizer settings.
		 */
		if ( (int) get_theme_mod( 'bgtfw_page_headers_global_template' ) === $post_id ) {
			set_theme_mod( 'bgtfw_page_headers_global_template', 'none' );
		}
	}

	/**
	 * Update Site Logo Ajax callback.
	 *
	 * @since 1.1.0
	 */
	public function update_site_logo() {
		$verified = false;
		if ( isset( $_POST ) && isset( $_POST['nonce'] ) ) {
			$verified = wp_verify_nonce(
				$_POST['nonce'],
				'crio_premium_update_site_logo'
			);
		}

		if ( ! $verified ) {
			return false;
		}

		$logo_id = isset( $_POST['logoId'] ) ? $_POST['logoId'] : '';
		set_theme_mod( 'custom_logo', $logo_id );

		$custom_logo = get_theme_mod( 'custom_logo' );

		if ( (string) $logo_id === (string) $custom_logo ) {
			wp_send_json( array( 'logoIdUpdated' => true ) );
		} else {
			wp_send_json( array( 'logoIdUpdated' => false ) );
		}
	}
}
