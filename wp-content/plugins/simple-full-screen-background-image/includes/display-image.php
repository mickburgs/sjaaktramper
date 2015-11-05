<?php

function fsb_display_image() {
	global $fsb_options;

	if ( isset( $fsb_options['image'] ) ) {
		$image = $fsb_options['image'];
		if( is_ssl() ) {
			$image = str_replace( 'http://', 'https://', $image );
		}
		echo '<img src="' . esc_url( $image ) . '" id="fsb_image"/>';
	}
}
add_action( 'wp_footer', 'fsb_display_image' );