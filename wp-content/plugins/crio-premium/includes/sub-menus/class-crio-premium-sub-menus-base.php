<?php

/**
 * File: class=crio-premium-sub-menus-base.php
 *
 * Adds the Sub Menus feature to Crio.
 *
 * @link       https://www.boldgrid.com/
 * @since      1.8.0
 *
 * @package    Crio_Premium
 * @subpackage Crio_Premium/Sub_Menus
 */

/**
 * Class: Crio_Premium_Sub_Menus_Base
 *
 * This is the base class for adding the Custom Sub Menus feature
 * to Crio Premium.
 */
class Crio_Premium_Sub_Menus_Base {

	/**
	 * Default Submenu Width.
	 *
	 * @var int $default_submenu_width
	 * @access private
	 * @since 1.8.0
	 */
	private $default_submenu_width = 500;

	/**
	 * Default Width Unit.
	 *
	 * @var int $default_width_unit
	 * @access private
	 * @since 1.8.0
	 */
	private $default_width_unit = 'px';

	/**
	 * Constructor
	 *
	 * @since 1.8.0
	 */
	public function __construct() {
		$this->define_hooks();
	}

	/**
	 * Define Hooks
	 *
	 * @since 1.8.0
	 *
	 * @access private
	 */
	private function define_hooks() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_filter( 'wp_nav_menu_items', array( $this, 'wp_nav_menu_items' ), 10, 2 );
		add_action( 'add_meta_boxes_crio_custom_submenu', array( $this, 'submenu_item_meta_box' ) );
		add_action( 'save_post_crio_custom_submenu', array( $this, 'update_submenu_postmeta' ), 10, 2 );
		add_action( 'mce_external_plugins', array( $this, 'add_tinymce_plugin' ) );
	}

	/**
	 * Get Post Type.
	 *
	 * @since 1.8.0
	 *
	 * @access private
	 * =
	 * @return string Post Type.
	 */
	private function get_post_type() {
		global $post;

		if ( $post ) {
			return $post->post_type;
		} else {
			return '';
		}
	}

	/**
	 * Add Tinymce Plugin
	 *
	 * Adds the submenu JS to the editor script queue.
	 *
	 * @since 1.8.0
	 *
	 * @param  $plugin_array array An array of TinyMCE plugins.
	 *
	 * @return array An array of TinyMCE plugins.
	 */
	public function add_tinymce_plugin( $plugin_array ) {
		if ( ! $this->is_custom_submenu() ) {
			return;
		}

		$plugin_array['crio-premium-submenus'] = CRIO_PREMIUM_URL . 'admin/js/crio-premium-submenus.js';

		return $plugin_array;
	}

	/**
	 * Is Custom Submenu
	 *
	 * Determines whether post currently being edited is a custom submenu.
	 *
	 * @since 1.8.0
	 *
	 * @access private
	 *
	 * @return boolean
	 */
	private function is_custom_submenu() {
		global $pagenow;

		$valid_pages = array(
			'customize.php',
			'post.php',
			'post-new.php',
		);

		$valid_post_types = array(
			'crio_custom_submenu',
		);

		if ( ! empty( $pagenow ) && ! in_array( $pagenow, $valid_pages, true ) ) {
			return false;
		}

		if ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) {
			if ( ! in_array( $this->get_post_type(), $valid_post_types, true ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Submenu Item Meta Box
	 *
	 * Adds the submenu item meta box to the submenu post type.
	 *
	 * @since 1.8.0
	 */
	public function submenu_item_meta_box() {
		add_meta_box(
			'custom_submenu_width',
			'Custom Submenu Width',
			array( $this, 'render_submenu_metabox' ),
			'crio_custom_submenu',
			'side',
			'default'
		);
	}

	/**
	 * Render Submenu Metabox
	 *
	 * @since 1.8.0
	 *
	 * @param WP_POST $post
	 */
	public function render_submenu_metabox( $post ) {
		$submenu_width = get_post_meta( $post->ID, 'custom_submenu_width', true );
		$submenu_unit  = get_post_meta( $post->ID, 'custom_submenu_unit', true );
		$submenu_width = empty( $submenu_width ) ? $this->default_submenu_width : $submenu_width;
		$submenu_unit  = empty( $submenu_unit ) ? $this->default_width_unit : $submenu_unit;
		wp_nonce_field( basename( __FILE__ ), 'custom_submenu_width_nonce' );
		?>
		<p>
			<label>
				Submenu Width:<br />
				<input type="number" name="custom_submenu_width" value="<?php echo esc_attr( $submenu_width ); ?>"/>
			</label>
		</p>
		<p>
			<input type="radio" name="custom_submenu_unit" value="px" <?php checked( $submenu_unit, 'px' ); ?> /><label>px</label>
			<input type="radio" name="custom_submenu_unit" value="%" <?php checked( $submenu_unit, '%' ); ?> /><label>%</label>
		<?php
	}

	/**
	 * Update Submenu Postdata
	 *
	 * Updates the postdata whenever saving a submenu.
	 *
	 * @param int     $post_id The ID of the post being saved.
	 * @param WP_POST $post    Post object.
	 *
	 * @since 1.8.0
	 */
	public function update_submenu_postmeta( $post_id, $post ) {
		// Verify Nonce.
		if ( ! isset( $_POST['custom_submenu_width_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['custom_submenu_width_nonce'], basename( __FILE__ ) ) ) {
			return;
		}

		// Verify a post meta change
		if ( ! isset( $_POST['custom_submenu_width'] ) || ! isset( $_POST['custom_submenu_unit'] ) ) {
			return;
		}

		// Verify Capabilities.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Only update when saving, not autosave, ajax, or revision.
		if ( wp_doing_ajax() || wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
			return;
		}

		$old_width = get_post_meta( $post_id, 'custom_submenu_width', true );
		$new_width = isset( $_POST['custom_submenu_width'] ) ? wp_strip_all_tags( $_POST['custom_submenu_width'] ) : '';

		$old_unit = get_post_meta( $post_id, 'custom_submenu_unit', true );
		$new_unit = isset( $_POST['custom_submenu_unit'] ) ? wp_strip_all_tags( $_POST['custom_submenu_unit'] ) : '';

		if ( ! $new_width && $old_width ) {
			update_post_meta( $post_id, 'custom_submenu_width', $this->default_submenu_width );
		} elseif ( $new_width !== $old_width ) {
			update_post_meta( $post_id, 'custom_submenu_width', $new_width );
		}

		if ( ! $new_unit && $old_unit ) {
			update_post_meta( $post_id, 'custom_submenu_unit', $this->default_width_unit );
		} elseif ( $old_unit !== $new_unit ) {
			update_post_meta( $post_id, 'custom_submenu_unit', $new_unit );
		}
	}

	/**
	 * WP Nav Menu Items
	 *
	 * This method is run when filtering the html output of a nav menu.
	 * This is where we actually do the work of replacing the menu item contents
	 * with the custom submenu contents.
	 *
	 * @param string   $menu_html The html output of the menu.
	 * @param stdClass $args      The arguments used to build the menu.
	 *
	 * @return string The html output of the menu.
	 *
	 * @since 1.8.0
	 */
	public function wp_nav_menu_items( $menu_html, $args ) {
		if ( '' === $menu_html ) {
			return $menu_html;
		}

		if ( false === strpos( $menu_html, 'menu-item-object-crio_custom_submenu' ) ) {
			return $menu_html;
		}

		// Custom page headers pass the menu id as an integer, otherwise it's an object.
		$menu_items    = 'integer' === gettype( $args->menu ) ? wp_get_nav_menu_items( $args->menu ) : wp_get_nav_menu_items( $args->menu->term_id );
		$submenu_items = array();

		foreach ( $menu_items as $menu_item ) {
			if ( 'crio_custom_submenu' === $menu_item->object ) {
				$submenu_items[] = $menu_item;
			}
		}

		if ( empty( $submenu_items ) ) {
			return $menu_html;
		} else {
			$menu_html = $this->substitute_menu_html( $menu_html, $submenu_items );
		}

		return $menu_html;
	}

	/**
	 * Substitute Menu HTML
	 *
	 * This method uses DOMDocument to parse the menu html and replace the menu item.
	 *
	 * @param  string $menu_html     The html output of the menu.
	 * @param  array  $submenu_items The submenu items to replace.
	 *
	 * @return string The html output of the menu.
	 *
	 * @since 1.8.0
	 *
	 * @access private
	 */
	private function substitute_menu_html( $menu_html, $submenu_items ) {
		$dom_html = new DOMDocument();
		libxml_use_internal_errors( true );
		$dom_html->loadHTML( '<ul>' . $menu_html . '</ul>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
		$finder = new DomXPath( $dom_html );

		foreach ( $submenu_items as $submenu_item ) {
			$submenu_id   = $submenu_item->object_id;
			$menu_item_id = 'menu-item-' . $submenu_item->ID;
			$post_content = get_post_field( 'post_content', $submenu_item->object_id );

			// This is needed to ensure that shortcodes are parsed.
			$post_content = apply_filters( 'the_content', $post_content );

			$submenu_width = get_post_meta( $submenu_id, 'custom_submenu_width', true );
			$submenu_width = empty( $submenu_width ) ? $this->default_submenu_width : $submenu_width;

			$submenu_width_unit = get_post_meta( $submenu_id, 'custom_submenu_unit', true );
			$submenu_width_unit = empty( $submenu_width_unit ) ? $this->default_width_unit : $submenu_width_unit;

			$dom_menu_items    = $finder->query( "//*[contains(concat(' ', normalize-space(@class), ' '), ' $menu_item_id ')]" );
			$dom_menu_item     = $dom_menu_items[0];
			$menu_item_classes = $dom_menu_items[0]->getAttribute( 'class' );
			$dom_menu_item->setAttribute( 'class', $menu_item_classes . ' menu-item-has-children' );

			$submenu_id_string = 'crio-custom-menu-' . $submenu_id;
			$insert_string     = sprintf(
				'<ul class="sub-menu custom-sub-menu" data-width="%2$s%3$s"><li class="custom-sub-menu" id="%1$s">%4$s</li></ul>',
				$submenu_id_string,
				$submenu_width,
				$submenu_width_unit,
				$post_content
			);

			$insert = new DOMDocument();
			$insert->loadHTML( $insert_string, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

			$insert = $dom_html->importNode( $insert->documentElement, true ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase

			// This disables the original link for the sub-menu's parent level item.
			$disabled_link = $dom_menu_item->getElementsbyTagName( 'a' )->item( 0 );
			$disabled_link->setAttribute( 'href', 'javascript:;' );

			$dom_menu_item->appendChild( $insert );
		}

		$menu_html = $dom_html->saveHTML();

		$menu_html = preg_replace( '/^<ul>/', '', $menu_html );
		$menu_html = preg_replace( '/<\/ul>$/', '', $menu_html );

		return $menu_html;
	}

	/**
	* Register the Custom Post Type for submenus
	*
	* @since 1.0.0
	*/
	public function register_post_type() {
		register_post_type(
			'crio_custom_submenu',
			array(
				'labels'       => array(
					'name'          => __( 'Mega Menu Items', 'crio-premium' ),
					'singular_name' => __( 'Mega Menu Item', 'crio-premium' ),
					'add_new_item'  => __( 'Add New Mega Menu Item', 'crio-premium' ),
					'edit_item'     => __( 'Edit Mega Menu Item', 'crio-premium' ),
					'view_items'    => __( 'Mega Menu Items', 'crio-premium' ),
					'menu_name'     => __( 'Mega Menus', 'crio-premium' ),
				),
				'public'       => true,
				'show_ui'      => true,
				'show_in_menu' => 'crio_premium',
				'show_in_rest' => true,
				'supports'     => array( 'editor', 'title', 'revisions' ),
			)
		);
	}
}
