<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
/**
 * WooCommerce Gallery Widget Hook Filter
 *
 * Hook anf Filter into woocommerce plugin
 *
 * Table Of Contents
 *
 *
 * plugin_extra_links()
 * product_cycle_style()
 * product_cycle_script()
 */
class WC_Gallery_Widget_Hook_Filter 
{
	public static function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != WC_GALLERY_WIDGET_NAME) {
			return $links;
		}
		$links[] = '<a href="http://docs.a3rev.com/user-guides/woocommerce/woo-widget-product-slideshow/" target="_blank">'.__('Documentation', 'woo_gallery_widget').'</a>';
		$links[] = '<a href="http://wordpress.org/support/plugin/woo-widget-product-slideshow" target="_blank">'.__('Support', 'woo_gallery_widget').'</a>';
		return $links;
	}
	
	public static function product_cycle_style() {
		wp_enqueue_style( 'woo-product-cycle-style', WC_GALLERY_WIDGET_CSS_URL . '/product_cycle_widget.css' );
	}
	
	public static function product_cycle_script() {
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'a3-cycle-script', WC_GALLERY_WIDGET_JS_URL . '/jquery.cycle.all.js', array(), false, true );
	}
}
?>