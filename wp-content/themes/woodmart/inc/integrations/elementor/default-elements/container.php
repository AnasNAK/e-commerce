<?php
/**
 * Elementor container custom controls
 *
 * @package xts
 */

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'woodmart_add_container_full_width_control' ) ) {
	/**
	 * Container full width option.
	 *
	 * @since 1.0.0
	 *
	 * @param object $element The control.
	 */
	function woodmart_add_container_full_width_control( $element ) {
		$element->start_controls_section(
			'wd_extra_layout',
			[
				'label' => esc_html__( '[XTemos] Layout', 'woodmart' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

		$element->add_control(
			'wd_container_stretch',
			[
				'label'        => esc_html__( 'Stretch container', 'woodmart' ),
				'description'  => esc_html__( 'This container will become a full-width wrapper for inner containers. "Content Width" option for the current element will stop working and content width need to be controlled via inner containers', 'woodmart' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'render_type'  => 'template',
				'prefix_class' => 'wd-section-',
				'return_value' => 'stretch',
			]
		);

		$element->end_controls_section();
	}

	add_action( 'elementor/element/container/section_layout_container/after_section_end', 'woodmart_add_container_full_width_control' );
}

if ( ! function_exists( 'woodmart_add_container_color_scheme_control' ) ) {
	/**
	 * Container custom controls.
	 *
	 * @since 1.0.0
	 *
	 * @param object $element The control.
	 */
	function woodmart_add_container_color_scheme_control( $element ) {
		$element->start_controls_section(
			'wd_extra_style',
			array(
				'label' => esc_html__( '[XTemos] Extra', 'woodmart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		/**
		 * Color scheme.
		 */
		$element->add_control(
			'wd_color_scheme',
			array(
				'label'        => esc_html__( 'Color Scheme', 'woodmart' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					''      => esc_html__( 'Inherit', 'woodmart' ),
					'light' => esc_html__( 'Light', 'woodmart' ),
					'dark'  => esc_html__( 'Dark', 'woodmart' ),
				),
				'default'      => '',
				'render_type'  => 'template',
				'prefix_class' => 'color-scheme-',
			)
		);

		$element->end_controls_section();
	}

	add_action( 'elementor/element/container/section_background_overlay/after_section_end', 'woodmart_add_container_color_scheme_control' );
}

if ( ! function_exists( 'woodmart_add_container_custom_controls' ) ) {
	/**
	 * Column section controls.
	 *
	 * @since 1.0.0
	 *
	 * @param Controls_Stack $element The control.
	 */
	function woodmart_add_container_custom_controls( $element ) {
		$element->start_controls_section(
			'wd_extra_advanced',
			[
				'label' => esc_html__( '[XTemos] Extra', 'woodmart' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		/**
		 * Animations
		 */
		woodmart_get_animation_map( $element );

		$element->end_controls_section();
	}

	add_action( 'elementor/element/container/section_layout/after_section_end', 'woodmart_add_container_custom_controls' );
}

if ( ! function_exists( 'woodmart_container_before_render' ) ) {
	/**
	 * Section before render.
	 *
	 * @since 1.0.0
	 *
	 * @param object $widget Element.
	 */
	function woodmart_container_before_render( $widget ) {
		$settings = $widget->get_settings_for_display();

		if ( isset( $settings['wd_animation'] ) && $settings['wd_animation'] ) {
			woodmart_enqueue_inline_style( 'animations' );
			woodmart_enqueue_js_script( 'animations' );
			woodmart_enqueue_js_library( 'waypoints' );
		}
	}

	add_action( 'elementor/frontend/container/before_render', 'woodmart_container_before_render', 10 );
}
