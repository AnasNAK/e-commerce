<?php

if ( ! defined( 'WOODMART_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * ------------------------------------------------------------------------------------------------
 *  WPBakery Button element
 * ------------------------------------------------------------------------------------------------
 */

if ( ! class_exists( 'WOODMART_HB_Button' ) ) {
	class WOODMART_HB_Button extends WOODMART_HB_Element {

		public function __construct() {
			parent::__construct();
			$this->template_name = 'button';
		}

		public function map() {
			$this->args = array(
				'type'            => 'button',
				'title'           => esc_html__( 'Button', 'woodmart' ),
				'text'            => esc_html__( 'Button with link', 'woodmart' ),
				'icon'            => 'xts-i-button',
				'editable'        => true,
				'container'       => false,
				'edit_on_create'  => true,
				'drag_target_for' => array(),
				'drag_source'     => 'content_element',
				'removable'       => true,
				'addable'         => true,
				'params'          => array(
					'title'                       => array(
						'id'    => 'title',
						'title' => esc_html__( 'Title', 'woodmart' ),
						'tab'   => esc_html__( 'General', 'woodmart' ),
						'type'  => 'text',
						'value' => '',
					),
					'link'                        => array(
						'id'    => 'link',
						'title' => esc_html__( 'Link', 'woodmart' ),
						'tab'   => esc_html__( 'General', 'woodmart' ),
						'type'  => 'link',
						'value' => array( 'url' => '' ),
					),
					'color'                       => array(
						'id'      => 'color',
						'title'   => esc_html__( 'Predefined button color', 'woodmart' ),
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'type'    => 'selector',
						'value'   => 'default',
						'options' => array(
							'default' => array(
								'label' => esc_html__( 'Default', 'woodmart' ),
								'value' => 'default',
							),
							'primary' => array(
								'label' => esc_html__( 'Primary color', 'woodmart' ),
								'value' => 'primary',
							),
							'alt'     => array(
								'label' => esc_html__( 'Alternative color', 'woodmart' ),
								'value' => 'alt',
							),
							'white'   => array(
								'label' => esc_html__( 'White', 'woodmart' ),
								'value' => 'white',
							),
							'black'   => array(
								'label' => esc_html__( 'Black', 'woodmart' ),
								'value' => 'black',
							),
						),
					),
					'size'                        => array(
						'id'      => 'size',
						'title'   => esc_html__( 'Button size', 'woodmart' ),
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'type'    => 'selector',
						'value'   => 'default',
						'options' => array(
							'default'     => array(
								'label' => esc_html__( 'Default', 'woodmart' ),
								'value' => 'default',
							),
							'extra-small' => array(
								'label' => esc_html__( 'Extra Small', 'woodmart' ),
								'value' => 'extra-small',
							),
							'small'       => array(
								'label' => esc_html__( 'Small', 'woodmart' ),
								'value' => 'small',
							),
							'large'       => array(
								'label' => esc_html__( 'Large', 'woodmart' ),
								'value' => 'large',
							),
							'extra-large' => array(
								'label' => esc_html__( 'Extra Large', 'woodmart' ),
								'value' => 'extra-large',
							),
						),
					),
					'style'                       => array(
						'id'      => 'style',
						'title'   => esc_html__( 'Button style', 'woodmart' ),
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'type'    => 'selector',
						'value'   => 'default',
						'options' => array(
							'default'  => array(
								'label' => esc_html__( 'Default', 'woodmart' ),
								'value' => 'default',
							),
							'bordered' => array(
								'label' => esc_html__( 'Bordered', 'woodmart' ),
								'value' => 'bordered',
							),
							'link'     => array(
								'label' => esc_html__( 'Link button', 'woodmart' ),
								'value' => 'link',
							),
							'3d'       => array(
								'label' => esc_html__( '3D', 'woodmart' ),
								'value' => '3d',
							),
						),
					),
					'shape'                       => array(
						'id'       => 'shape',
						'title'    => esc_html__( 'Button shape', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'selector',
						'value'    => 'rectangle',
						'options'  => array(
							'rectangle'  => array(
								'label' => esc_html__( 'Rectangle', 'woodmart' ),
								'value' => 'rectangle',
							),
							'round'      => array(
								'label' => esc_html__( 'Circle', 'woodmart' ),
								'value' => 'round',
							),
							'semi-round' => array(
								'label' => esc_html__( 'Round', 'woodmart' ),
								'value' => 'semi-round',
							),
						),
						'requires' => array(
							'style' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'round', 'link' ),
							),
						),
					),
					'icon_library'                => array(
						'id'      => 'icon_library',
						'title'   => esc_html__( 'Icon library', 'woodmart' ),
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'type'    => 'select',
						'value'   => 'fontawesome',
						'options' => array(
							'fontawesome' => array(
								'label' => esc_html__( 'Font Awesome', 'woodmart' ),
								'value' => 'fontawesome',
							),
							'openiconic'  => array(
								'label' => esc_html__( 'Open Iconic', 'woodmart' ),
								'value' => 'openiconic',
							),
							'typicons'    => array(
								'label' => esc_html__( 'Typicons', 'woodmart' ),
								'value' => 'typicons',
							),
							'entypo'      => array(
								'label' => esc_html__( 'Entypo', 'woodmart' ),
								'value' => 'entypo',
							),
							'linecons'    => array(
								'label' => esc_html__( 'Linecons', 'woodmart' ),
								'value' => 'linecons',
							),
							'monosocial'  => array(
								'label' => esc_html__( 'Mono Social', 'woodmart' ),
								'value' => 'monosocial',
							),
							'material'    => array(
								'label' => esc_html__( 'Material', 'woodmart' ),
								'value' => 'material',
							),
						),
					),
					'icon_fontawesome'            => array(
						'id'          => 'icon_fontawesome',
						'title'       => esc_html__( 'Icon', 'woodmart' ),
						'description' => esc_html__( 'Enter the class name of the icon. For example "fas fa-check".', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'type'        => 'text',
						'value'       => '',
						'requires'    => array(
							'icon_library' => array(
								'comparison' => 'equal',
								'value'      => 'fontawesome',
							),
						),
					),
					'icon_openiconic'             => array(
						'id'          => 'icon_openiconic',
						'title'       => esc_html__( 'Icon', 'woodmart' ),
						'description' => esc_html__( 'Enter the class name of the icon. For example "oi oi-check".', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'type'        => 'text',
						'value'       => '',
						'requires'    => array(
							'icon_library' => array(
								'comparison' => 'equal',
								'value'      => 'openiconic',
							),
						),
					),
					'icon_typicons'               => array(
						'id'          => 'icon_typicons',
						'title'       => esc_html__( 'Icon', 'woodmart' ),
						'description' => esc_html__( 'Enter the class name of the icon. For example "typcn typcn-input-checked".', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'type'        => 'text',
						'value'       => '',
						'requires'    => array(
							'icon_library' => array(
								'comparison' => 'equal',
								'value'      => 'typicons',
							),
						),
					),
					'icon_entypo'                 => array(
						'id'          => 'icon_entypo',
						'title'       => esc_html__( 'Icon', 'woodmart' ),
						'description' => esc_html__( 'Enter the class name of the icon. For example "entypo-icon entypo-icon-check".', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'type'        => 'text',
						'value'       => '',
						'requires'    => array(
							'icon_library' => array(
								'comparison' => 'equal',
								'value'      => 'entypo',
							),
						),
					),
					'icon_linecons'               => array(
						'id'          => 'icon_linecons',
						'title'       => esc_html__( 'Icon', 'woodmart' ),
						'description' => esc_html__( 'Enter the class name of the icon. For example "vc_li vc_li-star".', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'type'        => 'text',
						'value'       => '',
						'requires'    => array(
							'icon_library' => array(
								'comparison' => 'equal',
								'value'      => 'linecons',
							),
						),
					),
					'icon_monosocial'             => array(
						'id'          => 'icon_monosocial',
						'title'       => esc_html__( 'Icon', 'woodmart' ),
						'description' => esc_html__( 'Enter the class name of the icon. For example "vc-mono vc-mono-addme".', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'type'        => 'text',
						'value'       => '',
						'requires'    => array(
							'icon_library' => array(
								'comparison' => 'equal',
								'value'      => 'monosocial',
							),
						),
					),
					'icon_material'               => array(
						'id'          => 'icon_material',
						'title'       => esc_html__( 'Icon', 'woodmart' ),
						'description' => esc_html__( 'Enter the class name of the icon. For example "vc-material vc-material-check".', 'woodmart' ),
						'tab'         => esc_html__( 'General', 'woodmart' ),
						'type'        => 'text',
						'value'       => '',
						'requires'    => array(
							'icon_library' => array(
								'comparison' => 'equal',
								'value'      => 'material',
							),
						),
					),
					'icon_position'               => array(
						'id'      => 'icon_position',
						'title'   => esc_html__( 'Button icon position', 'woodmart' ),
						'tab'     => esc_html__( 'General', 'woodmart' ),
						'type'    => 'selector',
						'value'   => 'left',
						'options' => array(
							'left'  => array(
								'label' => esc_html__( 'Left', 'woodmart' ),
								'value' => 'left',
							),
							'right' => array(
								'label' => esc_html__( 'Right', 'woodmart' ),
								'value' => 'right',
							),
						),
					),
					'full_width'                  => array(
						'id'    => 'full_width',
						'title' => esc_html__( 'Full width', 'woodmart' ),
						'tab'   => esc_html__( 'General', 'woodmart' ),
						'type'  => 'switcher',
						'value' => false,
					),
					'button_inline'               => array(
						'id'    => 'button_inline',
						'title' => esc_html__( 'Button inline', 'woodmart' ),
						'tab'   => esc_html__( 'General', 'woodmart' ),
						'type'  => 'switcher',
						'value' => false,
					),
					'align'                       => array(
						'id'       => 'align',
						'title'    => esc_html__( 'Align', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'selector',
						'value'    => 'left',
						'options'  => array(
							'left'   => array(
								'label' => esc_html__( 'Left', 'woodmart' ),
								'value' => 'left',
							),
							'center' => array(
								'label' => esc_html__( 'Center', 'woodmart' ),
								'value' => 'center',
							),
							'right'  => array(
								'label' => esc_html__( 'Right', 'woodmart' ),
								'value' => 'right',
							),
						),
						'requires' => array(
							'button_inline' => array(
								'comparison' => 'not_equal',
								'value'      => array( 'yes' ),
							),
						),
					),
					'button_smooth_scroll'        => array(
						'id'    => 'button_smooth_scroll',
						'title' => esc_html__( 'Smooth scroll', 'woodmart' ),
						'tab'   => esc_html__( 'General', 'woodmart' ),
						'type'  => 'switcher',
						'value' => false,
					),
					'button_smooth_scroll_time'   => array(
						'id'       => 'button_smooth_scroll_time',
						'title'    => esc_html__( 'Smooth scroll time (ms)', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'text',
						'value'    => '',
						'requires' => array(
							'button_smooth_scroll' => array(
								'comparison' => 'equal',
								'value'      => true,
							),
						),
					),
					'button_smooth_scroll_offset' => array(
						'id'       => 'button_smooth_scroll_offset',
						'title'    => esc_html__( 'Smooth scroll offset (px)', 'woodmart' ),
						'tab'      => esc_html__( 'General', 'woodmart' ),
						'type'     => 'text',
						'value'    => '',
						'requires' => array(
							'button_smooth_scroll' => array(
								'comparison' => 'equal',
								'value'      => true,
							),
						),
					),
					'el_class'                    => array(
						'id'    => 'el_class',
						'title' => esc_html__( 'Extra class name', 'woodmart' ),
						'tab'   => esc_html__( 'General', 'woodmart' ),
						'type'  => 'text',
						'value' => '',
					),
					'bg_color'                    => array(
						'id'    => 'bg_color',
						'title' => esc_html__( 'Background color', 'woodmart' ),
						'tab'   => esc_html__( 'Custom color', 'woodmart' ),
						'type'  => 'color',
						'value' => '',
					),
					'color_scheme'                => array(
						'id'      => 'color_scheme',
						'title'   => esc_html__( 'Text color scheme', 'woodmart' ),
						'tab'     => esc_html__( 'Custom color', 'woodmart' ),
						'type'    => 'selector',
						'value'   => 'light',
						'options' => array(
							'light' => array(
								'label' => esc_html__( 'Light', 'woodmart' ),
								'value' => 'light',
							),
							'dark'  => array(
								'label' => esc_html__( 'Dark', 'woodmart' ),
								'value' => 'dark',
							),
						),
					),
					'bg_color_hover'              => array(
						'id'    => 'bg_color_hover',
						'title' => esc_html__( 'Background color on hover', 'woodmart' ),
						'tab'   => esc_html__( 'Custom color', 'woodmart' ),
						'type'  => 'color',
						'value' => '',
					),
					'color_scheme_hover'          => array(
						'id'      => 'color_scheme_hover',
						'title'   => esc_html__( 'Text color scheme on hover', 'woodmart' ),
						'tab'     => esc_html__( 'Custom color', 'woodmart' ),
						'type'    => 'selector',
						'value'   => 'light',
						'options' => array(
							'light' => array(
								'label' => esc_html__( 'Light', 'woodmart' ),
								'value' => 'light',
							),
							'dark'  => array(
								'label' => esc_html__( 'Dark', 'woodmart' ),
								'value' => 'dark',
							),
						),
					),
				),
			);
		}
	}
}
