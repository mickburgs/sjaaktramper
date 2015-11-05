<?php

function fsb_load_css() {
	global $fsb_options;
	if( isset( $fsb_options['image'] ) )
		wp_enqueue_style( 'fsb-image', plugin_dir_url( __FILE__ ) . 'fullscreen-image.css' );
}
add_action( 'init', 'fsb_load_css' );

function fsb_load_admin_scripts( $hook ) {
	if( 'appearance_page_full-screen-background' !== $hook )
		return;
	wp_enqueue_script( 'fsb-scripts', plugin_dir_url( __FILE__ ) . 'fsb-scripts.js', array( 'jquery', 'media-upload', 'thickbox' ), filemtime( plugin_dir_path( __FILE__ ) . 'fsb-scripts.js' ) );
}
function fsb_load_admin_styles( $hook ) {
	if( 'appearance_page_full-screen-background' !== $hook )
		return;
	wp_enqueue_style( 'thickbox' );
}
add_action( 'admin_enqueue_scripts', 'fsb_load_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'fsb_load_admin_styles' );
