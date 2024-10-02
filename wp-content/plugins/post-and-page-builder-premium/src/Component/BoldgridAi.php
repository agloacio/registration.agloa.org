<?php
/**
* Class: BoldgridAi
*
* Add BoldgridAi Functionality
*
* @since 1.0.0
* @package    Boldgrid\PPBP\Component
* @subpackage Config
* @author     BoldGrid <support@boldgrid.com>
* @link       https://boldgrid.com
*/

namespace Boldgrid\PPBP\Component;

/**
* Class: BoldgridAi
*
* Add BoldGrid AI Functionality
*
* @since 1.2.2
*/
class BoldgridAi {

	/**
	 * Constructor
	 */
	public function __construct( $configs ) {
		$this->configs = $configs;
	}

	/**
	 * Init the class.
	 *
	 * @since 1.2.2
	 */
	public function init() {
		$this->add_actions();
		$this->custom_ai_prompts = new CustomAiPrompts( $this->configs );
		$this->custom_ai_prompts->init();
	}

	/**
	 * Add all actions.
	 *
	 * @since 1.2.0
	 */
	protected function add_actions() {
		add_action( 'load-bg_block_page_bgppb-settings', array( $this, 'toggle_ai_features' ) );

		if ( ! self::is_enabled() ) {
			return;
		}

		add_action( 'init', array( $this, 'register_user_meta' ) );
		add_action( 'media_buttons', array( $this, 'add_ai_button' ) );
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	/**
	 * Register REST routes.
	 *
	 * @since 1.2.0
	 */
	public function register_rest_routes() {
		register_rest_route( 'ppbp/v1/', '/text_diff', array(
			'methods' => 'POST',
			'callback' => array( $this, 'get_text_diff' ),
			'permission_callback' => '__return_true',
		) );
	}

	/**
	 * Get text diff.
	 *
	 * @since 1.2.0
	 */
	public function get_text_diff( $request ) {
		$items    = $request->get_params( 'items' );

		$diff = array();

		if ( is_array( $items ) && 0 !== count( $items ) ) {
			foreach( $items as $index => $item ) {
				$items[ $index ]['html'] = wp_text_diff( $item['before'], $item['after'] );
			}
		}

		return new \WP_REST_Response( $items, 200 );
	}

	/**
	 * Add AI button.
	 * 
	 * @since 1.2.2
	 */
	public function add_ai_button() {
		echo wp_kses_post(
			sprintf(
				// Translators: %s is the button text.
				'<div class="boldgrid-ai-tools-dropdown">' .
				'<button class="button button-primary" id="bgai-media-button"><span class="bgai-icon"></span>%1$s<span class="dashicons dashicons-arrow-down"></span></button>' . 
				'<ul>' .
				'<li data-context="new" data-action="BoldgridAiText">%2$s</li>' . 
				'<li data-context="edit" data-action="BoldgridAiText">%3$s</li>' .
				'<li data-context="edit" data-action="BoldgridAiReview">%4$s</li>' .
				'</ul>' . 
				'</div>',
				esc_html__( 'BoldGrid AI Tools', 'boldgrid' ),
				esc_html__( 'Generate New Content', 'boldgrid' ),
				esc_html__( 'Edit Existing Content', 'boldgrid' ),
				esc_html__( 'Review Content', 'boldgrid' )
			)
		);
	}

	/**
	 * Register user meta.
	 *
	 * @since 1.2.0
	 */
	public function register_user_meta() {
		register_meta( 'user', 'boldgrid_ai_user_defaults', array(
			'type' => 'object',
			'description' => 'User default settings for AI features',
			'single' => true,
			'show_in_rest' => array(
				'schema' => array(
					'type' => 'object',
					'properties' => array(
						'contentType' => array(
							'type' => 'string',
						),
						'promptContext' => array(
							'type' => 'string',
						),
						'responseTone' => array(
							'type' => 'string',
						),
						'writingStyle' => array(
							'type' => 'string',
						),
						'keywordFocusScore' => array(
							'type' => 'integer',
						),
						'keywords' => array(
							'type' => 'array',
							'items' => array(
								'type' => 'string',
							),
						),
						'minLenVal' => array(
							'type' => 'integer',
						),
						'maxLenVal' => array(
							'type' => 'integer',
						),
						'lengthUnit' => array(
							'type' => 'string',
						),
						'language' => array(
							'type' => 'string',
						),
					),
				),
			),
			'auth_callback' => function() {
				return current_user_can('edit_user', get_current_user_id() ); // Define who has access
			},
		) );
	}

	/**
	 * Toggle AI features.
	 *
	 * @since 1.2.0
	 */
	public function toggle_ai_features() {
		if ( isset( $_REQUEST['bgai_enabled'] ) ) {
			update_option( 'bgai_enabled', '1' === $_REQUEST['bgai_enabled'] ? true : false );
		}
	}

	/**
	 * Is AI enabled.
	 * 
	 * @since 1.2.2
	 */
	public static function is_enabled() {
		return get_option( 'bgai_enabled', false );
	}
}
