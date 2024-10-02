<?php
/**
* Class: Config
*
* Override the PPB Component configurations.
*
* @since 1.0.0
* @package    Boldgrid\PPBP\Component
* @subpackage Config
* @author     BoldGrid <support@boldgrid.com>
* @link       https://boldgrid.com
*/

namespace Boldgrid\PPBP\Component;

/**
* Class: Config
*
* Override the PPB Component configurations.
*
* @since 1.0.0
*/
class Config {

	/**
	 * Configurations for the plugin.
	 *
	 * @since 1.2.0
	 *
	 * @var array Plugin Configs.
	 */
	public $configs;

	/**
	 * Constructor
	 * 
	 * @param {array} $configs Plugin Configs.
	 */
	public function __construct( $configs ) {
		$this->configs = $configs;
	}

	/**
	 * Init the class.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_filter( 'BoldgridEditor\Config', function ( $configs ) {
			$configs['component_controls'][ 'components' ][ 'wp_boldgrid_component_post' ] = [
				'name'       => 'wp_boldgrid_component_post',
				'js_control' => [
					'icon' => '<span class="dashicons dashicons-admin-post"></span>'
				],
			];

			$configs['component_controls'][ 'components' ][ 'wp_boldgrid_component_postlist' ] = [
				'name'       => 'wp_boldgrid_component_postlist',
				'js_control' => [
					'icon' => '<span class="dashicons dashicons-exerpt-view"></span>'
				],
			];

			$ai_configs = $this->configs['boldgrid_ai'];

			$configs['boldgrid_ai'] = $this->configs['boldgrid_ai'];

			$configs['boldgrid_ai']['custom_prompts' ] = $this->get_custom_prompts();

			return $configs;
		} );
	}

	/**
	 * Get custom prompts.
	 *
	 * @since 1.2.3
	 *
	 * @return array Custom Prompts.
	 */
	protected function get_custom_prompts() {
		// Query to get all posts of the custom post type 'ppbp-ai-prompt'
		$args = array(
			'post_type'      => 'ppbp-ai-prompt',
			'posts_per_page' => -1, // Get all posts
			'post_status'    => 'publish' // Only get published posts
		);
	
		$query = new \WP_Query($args);
	
		$prompts = array();
	
		// Loop through each post
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				
				// Get the meta fields
				$prompt_type = get_post_meta( get_the_ID(), 'ai-prompt-type', true );
				$prompt      = get_post_meta( get_the_ID(), 'ai-prompt', true );
				
				// If both fields exist, group them accordingly
				if ( $prompt_type && $prompt ) {
					if ( ! isset( $prompts[$prompt_type] ) ) {
						$prompts[ $prompt_type ] = array();
					}
					$prompts[ $prompt_type ][] = array(
						'id' => 'custom-prompt-' . get_the_ID(),
						'label' => get_the_title(),
						'prompt' => $prompt
					);
				}
			}
		}
	
		// Reset post data
		wp_reset_postdata();

		return $prompts;
	}
}
