<?php 

/*
Plugin Name: Multiple Pickup Locations for Woocommerce (Mick version)
Plugin URI: http://www.tychesoftwares.com/store/free-plugin/order-delivery-date-on-checkout/
Description: This plugin allows customers to choose their preferred Order Delivery Date during checkout.
Author: Ashok Rane
Version: 1.0
Author URI: http://www.tychesoftwares.com/about
Contributor: Tyche Softwares, http://www.tychesoftwares.com/
*/

$wpefield_version = '1.0';



add_action('woocommerce_after_checkout_billing_form', 'pickup_location_field'); 

function pickup_location_field( $checkout ) {	
    
    wp_enqueue_style( 'jquery-ui', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" , '', '', false);

	echo '<script language="javascript">jQuery(document).ready(function(){
	jQuery("#e_pickuplocation").width("290px");

});</script>';
	
	echo '<div id="pickup_location_field" style="width: 202%; float: left;">';     

	woocommerce_form_field( 'e_pickuplocation', array(        

				'type'          => 'select',    
            
                                'options'  => array(
                                    'leeg' => '',
                                    'werkplaats' => 'Werkplaats Kapelle (op afspraak)',
                                    'goes_agri' => 'Standplaats Agrimarkt Goes (di-do-vr-za)',
                                    'goes_molenplein' => 'Standplaats Molenplein Goes (wo)',
                                    'hansweert' => 'Standplaats Hansweert (vr)',
                                    'hansweert' => 'Standplaats Heinkenszand (do-za)',
                                    'kapelle_wagen' => 'Standplaats Kapelle (wo)',
                                    'krabbendijke' => 'Standplaats Krabbendijke (di)',
                                    'kruiningen' => 'Standplaats Kruiningen (di)',
                                    'rilland' => 'Standplaats Rilland (do)',
                                    'wemeldinge' => 'Standplaats Wemeldinge (wo-za)',
                                    'yerseke' => 'Standplaats Yerseke (vr)'
                                ),

				'label'         => __('Afhaallocatie (<a href="http://www.sjaaktramper.nl/standplaatsen" target="_blank">Standplaatsen</a>) <small style=font-size:10px;>  (Indien van toepassing)</small>'),		

				'required'  	=> false,		
       

				), 

				$checkout->get_value( 'e_pickuplocation' ));     

				echo '</div>'; 

}

add_action('woocommerce_checkout_update_order_meta', 'pickup_location_field_update_order_meta'); 

function pickup_location_field_update_order_meta( $order_id ) {    

	if ($_POST['e_pickuplocation']) {

		update_post_meta( $order_id, 'Afhaallocatie', esc_attr($_POST['e_pickuplocation']));

	}
	
}

?>