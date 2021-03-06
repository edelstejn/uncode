<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$title = $nav_menu = $nav_menu_horizontal = $el_class = '';
$output = '';

extract(shortcode_atts(array(
	'title' => '',
	'nav_menu' => '',
	'nav_menu_horizontal' => '',
	'el_class' => '',
), $atts));

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_custommenu wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'Uncode_Nav_Menu_Widget';
if ($nav_menu_horizontal) $args = array('menu_class' => 'menu-smart sm menu-horizontal');
else $args = array();

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	if ( function_exists('uncode_sidebar_al') ) {
		ob_start();
		uncode_sidebar_al( $type, $atts, $args );
		$output .= ob_get_clean();
	}

	$output .= '</div>';

	echo $output;
} else {
	echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_custommenu' );
}
