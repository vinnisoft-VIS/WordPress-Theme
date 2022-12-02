<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'themes_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function themes_setup() {
		$hook_result = apply_filters_deprecated( 'custom_hook_for_theme', [ true ], '2.0', 'my_theme_add_theme_support' );
		if ( apply_filters( 'my_theme_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			
		}
	}
}
add_action( 'after_setup_theme', 'themes_setup' );

if ( ! function_exists( 'added_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function added_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'theme_enqueue_style', [ true ], '2.0', 'themes_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'themes_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'my-theme',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				THEME_VERSION
			);
		}

		if ( apply_filters( 'theme_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'my-theme-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				THEME_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'added_scripts_styles' );