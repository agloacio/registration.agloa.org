<?php
/**
* Class: CustomAiPrompts
*
* Add Custom AI Prompt post types
*
* @since 1.0.0
* @package    Boldgrid\PPBP\Component
* @subpackage Config
* @author     BoldGrid <support@boldgrid.com>
* @link       https://boldgrid.com
*/

namespace Boldgrid\PPBP\Component;

/**
* Class: CustomAiPrompts
*
* Add BoldGrid AI Functionality
*
* @since 1.2.2
*/
class CustomAiPrompts {

	/**
	 * Custom Post Type ID
	 * 
	 * @var string
	 * 
	 * @since 1.2.3
	 */
	public $post_type_id = 'ppbp-ai-prompt';

	/**
	 * Supported Prompt Types
	 * 
	 * @var array
	 * 
	 * @since 1.2.3
	 */
	public $supported_types = array(
		array(
			'id'    => 'review',
			'label' => 'Review Prompt',
			'help'  => 'These prompts will show up in the AI Review Panel. ' . 
				'These prompts will ask the AI Model to read through your entire content ' . 
				'and provide feedback on the overall quality of the content. ' . 
				'You will then be provided with a list of suggestions to improve your content. ' . 
				'<br/>Example: "Review my content and check for grammar and spelling errors."',
		),
		array(
			'id'    => 'quick_action',
			'label' => 'Quick Action Prompt',
			'help'  => 'These prompts will show up in the quick actions that display on the popovers ' . 
				'inside the editor. These are useful for asking for specific changes to specific sections ' . 
				'of your content, such as a single paragraph or a column. Please be aware that depending on ' . 
				'your prompt, the AI Model may possibly break existing layout structures. You may have to ' . 
				'adjust the layout after the AI Model has made the changes, or you may have to adjust the ' .
				'prompt to be more specific.<br/>Example: "Rewrite this paragraph to be more engaging."',
		),
	);

	/**
	 * Meta Fields
	 * 
	 * An array of meta fields.
	 * 
	 * @var array
	 * 
	 * @since 1.2.3
	 */
	public $meta_fields = array(
		'type' => array(
			'meta_name' => 'ai-prompt-type',
			'label'     => 'Prompt Type',
			'position'  => 'normal',
			'priority'  => 'high',
		),
		'prompt' => array(
			'meta_name' => 'ai-prompt',
			'label'     => 'Prompt',
			'position'  => 'normal',
			'priority'  => 'low',
		),
	);

	/**
	 * Constructor
	 */
	public function __construct( $configs ) {
		$this->configs = $configs;
	}

	/**
	 * Init the class.
	 *
	 * @since 1.2.3
	 */
	public function init() {
		$this->add_actions();
	}

	/**
	 * Add all actions.
	 *
	 * @since 1.2.3
	 */
	protected function add_actions() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'admin_init', array( $this, 'add_meta_fields' ) );
		add_action( "save_post_{$this->post_type_id}", array( $this, 'save_meta_fields' ) );
		add_action( "manage_{$this->post_type_id}_posts_custom_column", array( $this, 'manage_columns' ), 10, 2 );
		add_filter( 'manage_edit-' . $this->post_type_id . '_columns', array( $this, 'edit_columns' ) );
	}

	/**
	 * Manage Columns.
	 * 
	 * @since 1.2.3
	 * 
	 * @param string $column_name The column name.
	 */
	public function manage_columns( $column_name ) {
		global $post;
		switch ( $column_name ) {
			case 'type':
				$type = get_post_meta( $post->ID, 'ai-prompt-type', true );
				echo esc_html( $type );
				break;
			case 'prompt':
				$prompt = get_post_meta( $post->ID, 'ai-prompt', true );
				echo esc_html( $prompt );
				break;
			default:
				break;
		}
	}

	/**
	 * Edit columns.
	 *
	 * @since 1.2.3
	 * 
	 * @param array $columns The columns.
	 */
	public function edit_columns( $columns ) {
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'title'     => 'Prompt Title',
			'type'      => 'Type',
			'prompt'    => 'Prompt',
		);

		return $columns;
	}

	/**
	 * Save meta fields.
	 *
	 * @since 1.2.3
	 * 
	 * @param int $post_id The post ID.
	 */
	public function save_meta_fields( $post_id ) {
		// Check if this is an autosave or not
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check if the post is being saved from the admin
		if ( is_admin() ) {
			$title = get_post_field( 'post_title', $post_id );
			
			// If title is empty, prevent save
			if ( empty( $title ) ) {
				wp_die( __( 'Error: The title field is required. Please fill it in before saving.' ) );
			}
		}
		foreach( $this->meta_fields as $field_id => $meta_field ) {
			$meta_name = $meta_field['meta_name'];
			if ( isset( $_POST[ $meta_name ] ) ) {
				$nonce = $meta_name . '_nonce';
				if ( ! wp_verify_nonce( $_POST[ $nonce ], $meta_name ) ) {
					continue;
				}
				update_post_meta( $post_id, $meta_name, trim( $_POST[ $meta_name ] ) );
			}
		}
	}

	/**
	 * Add meta fields.
	 *
	 * @since 1.2.3
	 */
	public function add_meta_fields() {
		foreach( $this->meta_fields as $field_id => $meta_field ) {
			add_meta_box(
				$meta_field['meta_name'],
				$meta_field['label'],
				array( $this, 'render_meta_boxes' ),
				$this->post_type_id,
				$meta_field['position'],
				$meta_field['priority'],
				array( 'field_id' => $field_id, 'meta_name' => $meta_field['meta_name'] )
			);
		}
	}

	/**
	 * Register the Custom AI Prompt post type.
	 *
	 * @since 1.2.3
	 */
	public function register_post_type() {
		$icon   = $this->get_svg_base64( BGPPB_PREMIUM_PATH . '/src/assets/img/ai_icon.svg' );
		$labels = array(
			'name'               => _x('Custom AI Prompts', 'post type general name'),
			'singular_name'      => _x('Custom AI Prompt', 'post type singular name'),
			'add_new'            => _x('Add New Prompt', 'Add New Prompt'),
			'add_new_item'       => __('Add New Prompt'),
			'edit_item'          => __('Edit Prompt'),
			'new_item'           => __('New Prompt'),
			'view_item'          => __('View Prompt'),
			'search_items'       => __('Search Prompts'),
			'not_found'          =>  __('Nothing found'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon'  => ''
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'query_var'          => false,
			'menu_icon'          => $icon,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' ),
			'show_in_menu'       => 'edit.php?post_type=bg_block',
		);
		register_post_type( $this->post_type_id, $args );
	}

	/**
	 * Render meta boxes.
	 *
	 * @since 1.2.3
	 * 
	 * @param WP_Post $post The post object.
	 * @param array   $args The arguments.
	 */
	public function render_meta_boxes( $post, $args ) {
		$field_id  = $args['args']['field_id'];
		$meta_name = $args['args']['meta_name'];
		$value     = get_post_meta( $post->ID, $meta_name, true );

		// If the method exists, call it.
		if ( method_exists( $this, 'render_' . $field_id . '_field' ) ) {
			$nonce = wp_create_nonce( $meta_name . '_nonce' );
			call_user_func( array( $this, 'render_' . $field_id . '_field' ), $meta_name, $value );
		} else {
			echo '';
		}
	}

	/**
	 * Render type field.
	 *
	 * @since 1.2.3
	 * 
	 * @param string $meta_name The meta name.
	 * @param string $value     The value.
	 * @param string $nonce     The nonce.
	 */
	public function render_type_field( $meta_name, $value ) {
		?>
		<div class="boldgrid-ai-prompt-help">
			<?php
			foreach( $this->supported_types as $type ) {
				echo '<h3 class="boldgrid-ai-prompt-help-title ' . $type['id'] . '">' . esc_html( $type['label'] ) . '</h3>';
				echo '<p class="boldgrid-ai-prompt-help-text ' . $type['id'] . ' ">' . wp_kses_post( $type['help'] ) . '</p>';
			}
			?>
		</div>
		<select name="<?php echo esc_attr( $meta_name ); ?>" id="<?php echo esc_attr( $meta_name ); ?>">
			<option value=""><?php esc_html_e( 'Select a Prompt Type', 'boldgrid' ); ?></option>
			<?php foreach( $this->supported_types as $type ) : ?>
				<option value="<?php echo esc_attr( $type['id'] ); ?>" <?php selected( $value, $type['id'] ); ?>><?php echo esc_html( $type['label'] ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php wp_nonce_field( $meta_name, $meta_name . '_nonce' );
	}

	/**
	 * Render prompt field.
	 *
	 * @since 1.2.3
	 * 
	 * @param string $meta_name The meta name.
	 * @param string $value     The value.
	 * @param string $nonce     The nonce.
	 */
	public function render_prompt_field( $meta_name, $value ) {
		?>
		<textarea
			style="width:100%"
			name="<?php echo esc_attr( $meta_name ); ?>"
			id="<?php echo esc_attr( $meta_name ); ?>"
			><?php echo esc_html( $value ); ?></textarea>
		<?php wp_nonce_field( $meta_name, $meta_name . '_nonce' );
	}

	function get_svg_base64( $file_path ) {
		if ( file_exists( $file_path ) && is_readable( $file_path ) ) {
			$svg_content = file_get_contents( $file_path );
			$base64_svg  = 'data:image/svg+xml;base64,' . base64_encode( $svg_content );
			return $base64_svg;
		}
		return '';
	}
}