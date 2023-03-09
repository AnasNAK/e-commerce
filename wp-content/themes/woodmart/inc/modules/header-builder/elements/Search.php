<?php if ( ! defined( 'WOODMART_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
 * ------------------------------------------------------------------------------------------------
 * Search form. A few kinds of it.
 * ------------------------------------------------------------------------------------------------
 */

if ( ! class_exists( 'WOODMART_HB_Search' ) ) {
	class WOODMART_HB_Search extends WOODMART_HB_Element {


		public function __construct() {
			parent::__construct();

			$this->template_name = 'search';
		}

		public function map() {
			$this->args = array(
				'type'            => 'search',
				'title'           => esc_html__( 'Search', 'woodmart' ),
				'text'            => esc_html__( 'Search form', 'woodmart' ),
				'icon'            => 'xts-i-search',
				'editable'        => true,
				'container'       => false,
				'edit_on_create'  => true,
				'drag_target_for' => array(),
				'drag_source'     => 'content_element',
				'removable'       => true,
				'addable'         => true,
				'desktop'         => true,
				'params'          => array(
					'display'                => array(
						'id'          => 'display',
						'title'       => esc_html__( 'Display', 'woodmart' ),
						'type'        => 'selector',
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'value'       => 'full-screen',
						'options'     => array(
							'full-screen'   => array(
								'value' => 'full-screen',
								'label' => esc_html__( 'Full screen', 'woodmart' ),
							),
							'full-screen-2' => array(
								'value' => 'full-screen',
								'label' => esc_html__( 'Full screen 2', 'woodmart' ),
							),
							'dropdown'      => array(
								'value' => 'dropdown',
								'label' => esc_html__( 'Dropdown', 'woodmart' ),
							),
							'form'          => array(
								'value' => 'form',
								'label' => esc_html__( 'Form', 'woodmart' ),
							),
						),
						'description' => esc_html__( 'Display search icon/form in the header in different views.', 'woodmart' ),
					),
					'categories_dropdown'    => array(
						'id'       => 'categories_dropdown',
						'title'    => esc_html__( 'Show product categories dropdown', 'woodmart' ),
						'type'     => 'switcher',
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'value'    => false,
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
						),
					),
					'cat_selector_style'     => array(
						'id'       => 'cat_selector_style',
						'title'    => esc_html__( 'Product categories selector style', 'woodmart' ),
						'type'     => 'selector',
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'value'    => 'bordered',
						'options'  => array(
							'default'   => array(
								'value' => 'default',
								'label' => esc_html__( 'Default', 'woodmart' ),
							),
							'bordered'  => array(
								'value' => 'bordered',
								'label' => esc_html__( 'Bordered', 'woodmart' ),
							),
							'separated' => array(
								'value' => 'separated',
								'label' => esc_html__( 'Separated', 'woodmart' ),
							),
						),
						'requires' => array(
							'display'             => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
							'categories_dropdown' => array(
								'comparison' => 'equal',
								'value'      => true,
							),
						),
					),
					'popular_requests'       => array(
						'id'          => 'popular_requests',
						'title'       => esc_html__( 'Show popular requests', 'woodmart' ),
						'type'        => 'switcher',
						'description' => __( 'You can write a list of popular requests in Theme Settings -> General -> Search', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'value'       => false,
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'form', 'dropdown' ),
							),
						),
					),
					'ajax'                   => array(
						'id'          => 'ajax',
						'title'       => esc_html__( 'Search with AJAX', 'woodmart' ),
						'type'        => 'switcher',
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'value'       => false,
						'description' => esc_html__( 'Enable instant AJAX search functionality for this form.', 'woodmart' ),
					),
					'ajax_result_count'      => array(
						'id'          => 'ajax_result_count',
						'title'       => esc_html__( 'AJAX search results count', 'woodmart' ),
						'description' => esc_html__( 'Number of products to display in AJAX search results.', 'woodmart' ),
						'type'        => 'slider',
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'from'        => 3,
						'to'          => 50,
						'value'       => 20,
						'units'       => '',
						'requires'    => array(
							'ajax' => array(
								'comparison' => 'equal',
								'value'      => true,
							),
						),
					),
					'post_type'              => array(
						'id'      => 'post_type',
						'title'   => esc_html__( 'Post type', 'woodmart' ),
						'type'    => 'selector',
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'value'   => 'product',
						'options' => array(
							'product'   => array(
								'value' => 'product',
								'label' => esc_html__( 'Product', 'woodmart' ),
							),
							'post'      => array(
								'value' => 'post',
								'label' => esc_html__( 'Post', 'woodmart' ),
							),
							'portfolio' => array(
								'value' => 'portfolio',
								'label' => esc_html__( 'Portfolio', 'woodmart' ),
							),
							'page'      => array(
								'value' => 'page',
								'label' => esc_html__( 'Page', 'woodmart' ),
							),
							'any'       => array(
								'value' => 'any',
								'label' => esc_html__( 'All post types', 'woodmart' ),
							),
						),
					),
					'style'                  => array(
						'id' => 'style',
						'title' => esc_html__( 'Icon display', 'woodmart' ),
						'type' => 'selector',
						'tab' => esc_html__( 'General', 'woodmart' ),
						'value' => 'icon',
						'options' => array(
							'icon' => array(
								'value' => 'icon',
								'label' => esc_html__( 'Icon', 'woodmart' ),
							),
							'text' => array(
								'value' => 'text',
								'label' => esc_html__( 'Icon with text', 'woodmart' ),
							)
						),
						'description' => esc_html__( 'You can show the icon only or display "Search" text too.', 'woodmart' ),
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
						),
					),
					'icon_design'            => array(
						'id'       => 'icon_design',
						'title'    => esc_html__( 'Icon design', 'woodmart' ),
						'type'     => 'selector',
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'value'    => '1',
						'options'  => array(
							'1' => array(
								'value' => '1',
								'label' => esc_html__( 'First', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/search-icons/first.jpg',
							),
							'6' => array(
								'value' => '6',
								'label' => esc_html__( 'Second', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/search-icons/second.jpg',
							),
							'7' => array(
								'value' => '7',
								'label' => esc_html__( 'Third', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/search-icons/third.jpg',
							),
							'8' => array(
								'value' => '8',
								'label' => esc_html__( 'Fourth', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/search-icons/fourth.jpg',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
						),
					),
					'wrap_type'              => array(
						'id'      => 'wrap_type',
						'title'   => esc_html__( 'Background wrap type', 'woodmart' ),
						'type'    => 'selector',
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'value'   => 'icon_only',
						'options' => array(
							'icon_only' => array(
								'value' => 'icon_only',
								'label' => esc_html__( 'Icon only', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/bg-wrap-type/search-wrap-icon.jpg',
							),
							'icon_and_text' => array(
								'value' => 'icon_and_text',
								'label' => esc_html__( 'Icon and text', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/bg-wrap-type/search-wrap-icon-and-text.jpg',
							),
						),
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'style' => array(
								'comparison' => 'equal',
								'value'      => 'text',
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => array( '6', '7' ),
							),
						),
					),
					'color'                  => array(
						'id'          => 'color',
						'title'       => esc_html__( 'Color', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'type'        => 'color',
						'value'       => '',
						'selectors'   => array(
							'whb-row .{{WRAPPER}}.wd-tools-element .wd-tools-inner, .whb-row .{{WRAPPER}}.wd-tools-element > a > .wd-tools-icon' => array(
								'color: {{VALUE}};',
							),
						),
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => array( '7', '8' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'hover_color'            => array(
						'id'       => 'hover_color',
						'title'    => esc_html__( 'Hover color', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'color',
						'value'    => '',
						'selectors'   => array(
							'whb-row .{{WRAPPER}}.wd-tools-element:hover .wd-tools-inner, .whb-row .{{WRAPPER}}.wd-tools-element:hover > a > .wd-tools-icon' => array(
								'color: {{VALUE}};',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => array( '7', '8' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'bg_color'               => array(
						'id'       => 'bg_color',
						'title'    => esc_html__( 'Background color', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'color',
						'value'    => '',
						'selectors'   => array(
							'whb-row .{{WRAPPER}}.wd-tools-element .wd-tools-inner, .whb-row .{{WRAPPER}}.wd-tools-element > a > .wd-tools-icon' => array(
								'background-color: {{VALUE}};',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => array( '7', '8' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'bg_hover_color'         => array(
						'id'       => 'bg_hover_color',
						'title'    => esc_html__( 'Hover background color', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'color',
						'value'    => '',
						'selectors'   => array(
							'whb-row .{{WRAPPER}}.wd-tools-element:hover .wd-tools-inner, .whb-row .{{WRAPPER}}.wd-tools-element:hover > a > .wd-tools-icon' => array(
								'background-color: {{VALUE}};',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => array( '7', '8' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_color'             => array(
						'id'       => 'icon_color',
						'title'    => esc_html__( 'Icon color', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'color',
						'value'    => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-tools-element.wd-design-8 .wd-tools-icon' => array(
								'color: {{VALUE}};',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => '8',
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_hover_color'       => array(
						'id'       => 'icon_hover_color',
						'title'    => esc_html__( 'Hover icon color', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'color',
						'value'    => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-tools-element.wd-design-8:hover .wd-tools-icon' => array(
								'color: {{VALUE}};',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => '8',
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_bg_color'          => array(
						'id'       => 'icon_bg_color',
						'title'    => esc_html__( 'Icon background color', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'color',
						'value'    => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-tools-element.wd-design-8 .wd-tools-icon' => array(
								'background-color: {{VALUE}};',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => '8',
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_bg_hover_color'    => array(
						'id'       => 'icon_bg_hover_color',
						'title'    => esc_html__( 'Hover icon background color', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'color',
						'value'    => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-tools-element.wd-design-8:hover .wd-tools-icon' => array(
								'background-color: {{VALUE}};',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen-2', 'form' ),
							),
							'icon_design' => array(
								'comparison' => 'equal',
								'value'      => '8',
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_type'              => array(
						'id'      => 'icon_type',
						'title'   => esc_html__( 'Icon type', 'woodmart' ),
						'type'    => 'selector',
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'value'   => 'default',
						'options' => array(
							'default' => array(
								'value' => 'default',
								'label' => esc_html__( 'Default', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/default-icons/search-default.jpg',
							),
							'custom'  => array(
								'value' => 'custom',
								'label' => esc_html__( 'Custom', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/settings.jpg',
							),
						),
					),
					'custom_icon'            => array(
						'id'          => 'custom_icon',
						'title'       => esc_html__( 'Custom icon', 'woodmart' ),
						'type'        => 'image',
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'value'       => '',
						'description' => '',
						'requires'    => array(
							'icon_type' => array(
								'comparison' => 'equal',
								'value'      => 'custom',
							),
						),
					),
					'search_style'           => array(
						'id'       => 'search_style',
						'title'    => esc_html__( 'Search style', 'woodmart' ),
						'type'     => 'selector',
						'tab'      => esc_html__( 'Form style', 'woodmart' ),
						'value'    => 'default',
						'options'  => array(
							'default'   => array(
								'value' => 'default',
								'label' => esc_html__( 'Default', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/search/default.jpg',
							),
							'with-bg'   => array(
								'value' => 'with-bg',
								'label' => esc_html__( 'With background', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/search/with-bg.jpg',
							),
							'with-bg-2' => array(
								'value' => 'with-bg-2',
								'label' => esc_html__( 'With background 2', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/search/with-bg-2.jpg',
							),
						),
						'requires' => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
						),
					),
					'form_color'             => array(
						'id'          => 'form_color',
						'title'       => esc_html__( 'Form text color', 'woodmart' ),
						'type'        => 'color',
						'tab'         => esc_html__( 'Form style', 'woodmart' ),
						'value'       => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-search-form.wd-header-search-form .searchform' => array(
								'--wd-form-color: {{VALUE}};',
							),
						),
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'form_placeholder_color' => array(
						'id'          => 'form_placeholder_color',
						'title'       => esc_html__( 'Form placeholder color', 'woodmart' ),
						'type'        => 'color',
						'tab'         => esc_html__( 'Form style', 'woodmart' ),
						'value'       => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-search-form.wd-header-search-form .searchform' => array(
								'--wd-form-placeholder-color: {{VALUE}};',
							),
						),
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'form_brd_color'         => array(
						'id'          => 'form_brd_color',
						'title'       => esc_html__( 'Form border color', 'woodmart' ),
						'type'        => 'color',
						'tab'         => esc_html__( 'Form style', 'woodmart' ),
						'value'       => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-search-form.wd-header-search-form .searchform' => array(
								'--wd-form-brd-color: {{VALUE}};',
							),
						),
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'form_brd_color_focus'   => array(
						'id'          => 'form_brd_color_focus',
						'title'       => esc_html__( 'Form border color focus', 'woodmart' ),
						'type'        => 'color',
						'tab'         => esc_html__( 'Form style', 'woodmart' ),
						'value'       => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-search-form.wd-header-search-form .searchform' => array(
								'--wd-form-brd-color-focus: {{VALUE}};',
							),
						),
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'form_bg'                => array(
						'id'          => 'form_bg',
						'title'       => esc_html__( 'Form background color', 'woodmart' ),
						'type'        => 'color',
						'tab'         => esc_html__( 'Form style', 'woodmart' ),
						'value'       => '',
						'selectors'   => array(
							'{{WRAPPER}}.wd-search-form.wd-header-search-form .searchform' => array(
								'--wd-form-bg: {{VALUE}};',
							),
						),
						'requires'    => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'form_shape'             => array(
						'id'            => 'form_shape',
						'title'         => esc_html__( 'Form shape', 'woodmart' ),
						'type'          => 'select',
						'tab'           => esc_html__( 'Form style', 'woodmart' ),
						'value'         => '',
						'generate_zero' => true,
						'options'       => array(
							'' => array(
								'label' => esc_html__( 'Inherit', 'woodmart' ),
								'value' => '',
							),
							'0'       => array(
								'label' => esc_html__( 'Square', 'woodmart' ),
								'value' => '0',
							),
							'5'       => array(
								'label' => esc_html__( 'Rounded', 'woodmart' ),
								'value' => '5',
							),
							'35'      => array(
								'label' => esc_html__( 'Round', 'woodmart' ),
								'value' => '35',
							),
						),
						'selectors'     => array(
							'{{WRAPPER}}' => array(
								'--wd-form-brd-radius: {{VALUE}}px;',
							),
						),
						'requires'      => array(
							'display' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'full-screen', 'dropdown' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
				),
			);
		}

	}

}
