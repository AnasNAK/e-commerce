<?php if ( ! defined( 'WOODMART_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
 * ------------------------------------------------------------------------------------------------
 *  Get categories dropdown vertical menu
 * ------------------------------------------------------------------------------------------------
 */

if ( ! class_exists( 'WOODMART_HB_Categories' ) ) {
	class WOODMART_HB_Categories extends WOODMART_HB_Element {

		public function __construct() {
			parent::__construct();
			$this->template_name = 'categories';
		}

		public function map() {
			$this->args = array(
				'type'            => 'categories',
				'title'           => esc_html__( 'Categories', 'woodmart' ),
				'text'            => esc_html__( 'Categories dropdown', 'woodmart' ),
				'icon'            => 'xts-i-dropdown',
				'editable'        => true,
				'container'       => false,
				'edit_on_create'  => true,
				'drag_target_for' => array(),
				'drag_source'     => 'content_element',
				'removable'       => true,
				'addable'         => true,
				'desktop'         => true,
				'params'          => array(
					'menu_id'               => array(
						'id'          => 'menu_id',
						'title'       => esc_html__( 'Choose menu', 'woodmart' ),
						'type'        => 'select',
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'value'       => '',
						'callback'    => 'get_menu_options_with_empty',
						'description' => esc_html__( 'Choose which menu to display in the header as a categories dropdown.', 'woodmart' ),
					),
					'categories_title'      => array(
						'id'          => 'categories_title',
						'title'       => esc_html__( 'Menu title', 'woodmart' ),
						'type'        => 'text',
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'value'       => '',
						'description' => esc_html__( 'Specify your custom title for this menu dropdown or leave it empty to keep "Browse categories".', 'woodmart' ),
					),
					'icon_type'             => array(
						'id'      => 'icon_type',
						'title'   => esc_html__( 'Icon type', 'woodmart' ),
						'type'    => 'selector',
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'value'   => 'default',
						'options' => array(
							'default' => array(
								'value' => 'default',
								'label' => esc_html__( 'Default', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/default-icons/burger-default.jpg',
							),
							'custom'  => array(
								'value' => 'custom',
								'label' => esc_html__( 'Custom', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/settings.jpg',
							),
						),
					),
					'custom_icon'           => array(
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
					'design'                => array(
						'id'      => 'design',
						'title'   => esc_html__( 'Dropdown design', 'woodmart' ),
						'type'    => 'select',
						'tab'     => esc_html__( 'Dropdown', 'woodmart' ),
						'value'   => 'default',
						'options' => array(
							'default' => array(
								'label' => esc_html__( 'Default', 'woodmart' ),
								'value' => 'default',
							),
							'with-bg' => array(
								'label' => esc_html__( 'With background', 'woodmart' ),
								'value' => 'with-bg',
							),
						),
					),
					'more_cat_button'       => array(
						'id'          => 'more_cat_button',
						'title'       => esc_html__( 'Limit categories', 'woodmart' ),
						'type'        => 'switcher',
						'tab'         => esc_html__( 'Dropdown', 'woodmart' ),
						'value'       => false,
						'description' => __( 'Display a certain number of categories and "show more" button', 'woodmart' ),
					),
					'more_cat_button_count' => array(
						'id'          => 'more_cat_button_count',
						'title'       => esc_html__( 'Number of categories', 'woodmart' ),
						'description' => esc_html__( 'Specify the number of categories to be shown initially', 'woodmart' ),
						'type'        => 'slider',
						'tab'         => esc_html__( 'Dropdown', 'woodmart' ),
						'from'        => 1,
						'to'          => 100,
						'value'       => 5,
						'units'       => '',
						'requires'    => array(
							'more_cat_button' => array(
								'comparison' => 'equal',
								'value'      => true,
							),
						),
					),
					'mouse_event'           => array(
						'id'      => 'mouse_event',
						'title'   => esc_html__( 'Open on mouse event', 'woodmart' ),
						'type'    => 'selector',
						'tab'     => esc_html__( 'Dropdown', 'woodmart' ),
						'value'   => 'hover',
						'options' => array(
							'hover' => array(
								'value' => 'hover',
								'label' => esc_html__( 'Hover', 'woodmart' ),
							),
							'click' => array(
								'value' => 'click',
								'label' => esc_html__( 'Click', 'woodmart' ),
							),
						),
					),
					'open_dropdown'         => array(
						'id'          => 'open_dropdown',
						'title'       => esc_html__( 'Open menu item dropdown', 'woodmart' ),
						'description' => __( 'Submenu dropdown stays open after cursor leaves the parent menu item. Stops working if "Open categories menu" options is enabled on a page.', 'woodmart' ),
						'type'        => 'switcher',
						'tab'         => esc_html__( 'Dropdown', 'woodmart' ),
						'value'       => false,
					),
					'bg_overlay'            => array(
						'id'    => 'bg_overlay',
						'title' => esc_html__( 'Background overlay', 'woodmart' ),
						'description' => __( 'Highlight dropdowns by darkening the background behind.', 'woodmart' ),
						'type'  => 'switcher',
						'tab'   => esc_html__( 'Dropdown', 'woodmart' ),
						'value' => false,
					),
					'color_scheme'          => array(
						'id'          => 'color_scheme',
						'title'       => esc_html__( 'Text color scheme', 'woodmart' ),
						'type'        => 'selector',
						'tab'         => esc_html__( 'Colors', 'woodmart' ),
						'value'       => 'light',
						'options'     => array(
							'dark'  => array(
								'value' => 'dark',
								'label' => esc_html__( 'Dark', 'woodmart' ),
							),
							'light' => array(
								'value' => 'light',
								'label' => esc_html__( 'Light', 'woodmart' ),
							),
						),
						'description' => esc_html__( 'Select different text color scheme depending on your header background.', 'woodmart' ),
					),
					'background'            => array(
						'id'          => 'background',
						'title'       => esc_html__( 'Background settings', 'woodmart' ),
						'type'        => 'bg',
						'tab'         => esc_html__( 'Colors', 'woodmart' ),
						'value'       => '',
						'description' => '',
					),
					'border'                => array(
						'id'              => 'border',
						'title'           => esc_html__( 'Border', 'woodmart' ),
						'type'            => 'border',
						'sides'           => array( 'bottom', 'top', 'left', 'right' ),
						'tab'             => esc_html__( 'Colors', 'woodmart' ),
						'colorpicker_top' => true,
						'container'       => false,
						'value'           => '',
						'description'     => esc_html__( 'Border settings for this element.', 'woodmart' ),
					),
				),
			);
		}

	}

}
