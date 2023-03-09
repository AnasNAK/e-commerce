<?php if ( ! defined('WOODMART_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 *	Shopping cart widget element
 * ------------------------------------------------------------------------------------------------
 */

if( ! class_exists( 'WOODMART_HB_Cart' ) ) {
	class WOODMART_HB_Cart extends WOODMART_HB_Element {

		public function __construct() {
			parent::__construct();
			$this->template_name = 'cart';
		}

		public function map() {
			$this->args = array(
				'type' => 'cart',
				'title' => esc_html__( 'Cart', 'woodmart' ),
				'text' => esc_html__( 'Shopping widget', 'woodmart' ),
				'icon' => 'xts-i-cart',
				'editable' => true,
				'container' => false,
				'edit_on_create' => true,
				'drag_target_for' => array(),
				'drag_source' => 'content_element',
				'removable' => true,
				'addable' => true,
				'params' => array(
					'position' => array(
						'id' => 'position',
						'title' => esc_html__( 'Position', 'woodmart' ),
						'type' => 'selector',
						'tab' => esc_html__( 'General', 'woodmart' ),
						'value' => 'side',
						'options' => array(
							'side' => array(
								'value' => 'side',
								'label' => esc_html__( 'Hidden sidebar', 'woodmart' ),
							),
							'dropdown' => array(
								'value' => 'dropdown',
								'label' => esc_html__( 'Dropdown', 'woodmart' ),
							),
							'without' => array(
								'value' => 'without',
								'label' => esc_html__( 'Without', 'woodmart' ),
							),
						),
					),
					'design' => array(
						'id' => 'design',
						'title' => esc_html__( 'Display', 'woodmart' ),
						'type' => 'selector',
						'tab' => esc_html__( 'General', 'woodmart' ),
						'value' => '',
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
						'description' => esc_html__( 'You can show the icon only or display “Cart” contents info too.', 'woodmart' ),
					),
					'style' => array(
						'id' => 'style',
						'title' => esc_html__( 'Icon design', 'woodmart' ),
						'type' => 'selector',
						'tab' => esc_html__( 'General', 'woodmart' ),
						'value' => '1',
						'options' => array(
							'1' => array(
								'value' => '1',
								'label' => esc_html__( 'First', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/first.jpg',
							),
							'2' => array(
								'value' => '2',
								'label' => esc_html__( 'Second', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/second.jpg',
							),
							'3' => array(
								'value' => '3',
								'label' => esc_html__( 'Third', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/third.jpg',
							),
							'4' => array(
								'value' => '4',
								'label' => esc_html__( 'Fourth', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/fourth.jpg',
							),
							'5' => array(
								'value' => '5',
								'label' => esc_html__( 'Fifths', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/fifths.jpg',
							),
							'6' => array(
								'value' => '6',
								'label' => esc_html__( 'Sixth', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/six.jpg',
							),
							'7' => array(
								'value' => '7',
								'label' => esc_html__( 'Seventh', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/seventh.jpg',
							),
							'8' => array(
								'value' => '8',
								'label' => esc_html__( 'Eighth', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/eighth.jpg',
							),
						),
					),
					'wrap_type' => array(
						'id'      => 'wrap_type',
						'title'   => esc_html__( 'Background wrap type', 'woodmart' ),
						'type'    => 'selector',
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'value'   => 'icon_only',
						'options' => array(
							'icon_only' => array(
								'value' => 'icon_only',
								'label' => esc_html__( 'Icon only', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/bg-wrap-type/cart-bg-wrap-icon.jpg',
							),
							'icon_and_text' => array(
								'value' => 'icon_and_text',
								'label' => esc_html__( 'Icon and text', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/bg-wrap-type/cart-bg-wrap-icon-and-text.jpg',
							),
						),
						'requires'    => array(
							'design' => array(
								'comparison' => 'equal',
								'value'      => 'text',
							),
							'style' => array(
								'comparison' => 'equal',
								'value'      => array( '6', '7' ),
							),
						),
					),
					'color' => array(
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
							'style' => array(
								'comparison' => 'equal',
								'value'      => array( '7', '8' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'hover_color' => array(
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
							'style' => array(
								'comparison' => 'equal',
								'value'      => array( '7', '8' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'bg_color' => array(
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
							'style' => array(
								'comparison' => 'equal',
								'value'      => array( '7', '8' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'bg_hover_color' => array(
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
							'style' => array(
								'comparison' => 'equal',
								'value'      => array( '7', '8' ),
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_color' => array(
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
							'style' => array(
								'comparison' => 'equal',
								'value'      => '8',
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_hover_color' => array(
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
							'style' => array(
								'comparison' => 'equal',
								'value'      => '8',
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_bg_color' => array(
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
							'style' => array(
								'comparison' => 'equal',
								'value'      => '8',
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_bg_hover_color' => array(
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
							'style' => array(
								'comparison' => 'equal',
								'value'      => '8',
							),
						),
						'extra_class' => 'xts-col-6',
					),
					'icon_type' => array(
						'id' => 'icon_type',
						'title' => esc_html__( 'Icon type', 'woodmart' ),
						'type' => 'selector',
						'tab' => esc_html__( 'General', 'woodmart' ),
						'value' => 'cart',
						'options' => array(
							'cart' => array(
								'value' => 'cart',
								'label' => esc_html__( 'Cart', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/cart.jpg',
							),
							'bag' => array(
								'value' => 'bag',
								'label' => esc_html__( 'Bag', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/cart-icons/bag.jpg',
							),
							'custom' => array(
								'value' => 'custom',
								'label' => esc_html__( 'Custom', 'woodmart' ),
								'image' => WOODMART_ASSETS_IMAGES . '/header-builder/settings.jpg',
							),
						),
					),
					'custom_icon' => array(
						'id' => 'custom_icon',
						'title' => esc_html__( 'Custom icon', 'woodmart' ),
						'type' => 'image',
						'tab' => esc_html__( 'General', 'woodmart' ),
						'value' => '',
						'description' => '',
						'requires' => array(
							'icon_type' => array(
								'comparison' => 'equal',
								'value' => 'custom'
							)
						),
					),
				)
			);
		}

	}

}
