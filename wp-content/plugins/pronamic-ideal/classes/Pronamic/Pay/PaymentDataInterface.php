<?php

/**
 * Title: Payment data interface
 * Description: 
 * Copyright: Copyright (c) 2005 - 2013
 * Company: Pronamic
 * @author Remco Tolsma
 * @since 1.4.0
 */
interface Pronamic_Pay_PaymentDataInterface {
	/**
	 * Get the title of the payment
	 * 
	 * @return string
	 */
	public function get_title();

	/**
	 * Get credit card object
	 * 
	 * @return Pronamic_Pay_CreditCard
	 */
	public function get_credit_card();

	//////////////////////////////////////////////////
	// URL's
	//////////////////////////////////////////////////
	
	public function get_normal_return_url();
	
	public function get_cancel_url();
	
	public function get_success_url();
	
	public function get_error_url();
}
