<?php
woodmart_enqueue_inline_style( 'header-elements-base' );
$params['source'] = 'header';

if ( isset( $id ) ) {
	$params['wrapper_classes'] = ' whb-' . $id;
}

echo woodmart_shortcode_info_box($params, $params['content']);
