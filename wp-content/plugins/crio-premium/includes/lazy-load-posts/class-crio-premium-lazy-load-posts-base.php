<?php

/**
 * File: class=crio-premium-lazy-load-posts-base.php
 *
 * Adds the Lazy Loading Posts feature to Crio Premium
 *
 * @link       https://www.boldgrid.com/
 * @since      1.9.0
 *
 * @package    Crio_Premium
 * @subpackage Crio_Premium/includes/Lazy_Load_Posts
 */

/**
 * Class: Crio_Premium_Page_Headers_Base
 *
 * This is the base class for adding the Lazy Loading Posts feature
 * to Crio Premium.
 */
class Crio_Premium_Lazy_Load_Posts_Base {
	/**
	 * Constructor
	 *
	 * @since 1.9.0
	 */
	public function __construct() {
		$this->define_hooks();
	}

	/**
	 * Define the hooks for the Lazy Loading Posts feature.
	 *
	 * @since 1.9.0
	 */
	public function define_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'boldgrid_after_paging_nav', array( $this, 'add_load_more' ) );
	}

	/**
	 * Add the Load More hidden span to the bottom of the page.
	 *
	 * @since 1.9.0
	 */
	public function add_load_more() {
		global $wp_query;

		if ( ! get_theme_mod( 'crio_premium_lazy_load_posts', false ) ) {
			return;
		}

		printf(
			'<div class="load-more" style="display:none" data-totalpages="%s"></div>',
			esc_attr( $wp_query->max_num_pages ),
			esc_html__( 'Load More', 'crio-premium' )
		);
	}

	/**
	 * Enqueue the scripts for the Lazy Loading Posts feature.
	 *
	 * @since 1.9.0
	 */
	public function enqueue_scripts() {
		if ( ! get_theme_mod( 'crio_premium_lazy_load_posts', false ) ) {
			return;
		}
		if ( is_archive() || is_home() ) {
			wp_enqueue_script(
				'crio-premium-lazy-load-posts',
				CRIO_PREMIUM_URL . 'public/js/crio-premium-lazy-load-posts.js',
				array( 'jquery' ),
				'1.0.0',
				true
			);
		}
	}
}
