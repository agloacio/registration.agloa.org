<?php
/**
 * Plugin configuration file
 *
 * @link http://www.boldgrid.com
 * @since 1.0.0
 *
 * @package PPBP
 */

return array(
	'ajax_calls' => array(
		'get_plugin_version' => '/api/open/get-plugin-version',
		'get_asset' => '/api/open/get-asset',
	),
	'boldgrid_ai' => array(
		'bgai_enabled' => get_option( 'bgai_enabled', false ),
		'endpoints' => array(
			'textGenerate'     => '/ai/text/generate',
			'textFeedback'     => '/ai/text/feedback',
			'textEdit'         => '/ai/text/edit',
			'reviewContent'    => '/ai/text/review',
		),
		'tone_options' => array(
			'Creative',
			'Concise',
			'Critical',
			'Cynical',
			'Dramatic',
			'Emotional',
			'Excited',
			'Funny',
			'Honest',
			'Informative',
			'Ironic',
			'Joyful',
			'Logical',
			'Motivating',
			'Objective',
			'Persuasive',
			'Polite',
			'Respectful',
			'Serious',
			'Thoughtful',
		),
		'translate_options' => array(
			'Chinese',
			'Spanish',
			'English',
			'Hindi',
			'French',
			'Arabic',
			'Russian',
			'Japanese',
		),
		'ai_provider' => 'openai',
	),
	'asset_server' => 'https://api.boldgrid.com',
	'plugin_name' => 'post-and-page-builder-premium',
	'plugin_key_code' => 'editor-premium',
	'main_file_path' => BGPPB_PREMIUM_ENTRY,
	'plugin_transient_name' => 'boldgrid_ppbp_version_data',
);
