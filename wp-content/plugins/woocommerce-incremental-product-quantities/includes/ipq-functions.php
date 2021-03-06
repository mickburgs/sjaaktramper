<?php 
/*
*	Given the product, this will check which rule is being applied to a product
* 	If there is a rule, the values will be returned otherwise it is inactive 
*	or overridden (from the product meta box).
*
*	@params object	$product WC_Product object
*	@return mixed 	String of rule status / Object top rule post 
*/
function wpbo_get_applied_rule( $product ) {
	
	// Check for site wide rule
	$options = get_option( 'ipq_options' );
	
	if ( get_post_meta( $product->id, '_wpbo_deactive', true ) == 'on' ) {
		return 'inactive';
		
	} elseif ( get_post_meta( $product->id, '_wpbo_override', true ) == 'on' ) {
		return 'override';
	
	} elseif ( isset( $options['ipq_site_rule_active'] ) and $options['ipq_site_rule_active'] == 'on' ) {
		return 'sitewide';
		
	} else {
		return wpbo_get_applied_rule_obj( $product );
	}
}

/*
*	Get the Rule Object thats being applied to a given product.
*	Will return null if no rule is applied.
*
*	@params object	$product WC_Product object
*	@return mixed 	Null if no rule applies / Object top rule post 
*/
function wpbo_get_applied_rule_obj( $product ) {

	// Get Product Terms
	$product_cats = wp_get_post_terms( $product->id, 'product_cat' );
	$product_tags = wp_get_post_terms( $product->id, 'product_tag' );
	
	// Combine all product terms
	$product_terms = array_merge( $product_cats, $product_tags );
	
	// Get all Rules
	$args = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'post_type'        => 'quantity-rule',
		'post_status'      => 'publish',
	); 
	
	$rules = get_posts( $args );
	$top = null;
	$top_rule = null;
	
	// Loop through the rules and find the ones that apply
	foreach ( $rules as $rule ) {
	 
	 	$apply_rule = false;
	 	
	 	// Get the Rule's Cats and Tags
	 	$cats = get_post_meta( $rule->ID, '_cats' );
	 	$tags = get_post_meta( $rule->ID, '_tags' );
	 	
	 	if( $cats != false ) {
		 	$cats = $cats[0];
	 	}
	 	
	 	if( $tags != false ) {
		 	$tags = $tags[0];
	 	}

	 	$rule_taxes = array_merge( $tags, $cats );

	 	// Loop through the Product's Categories
	 	// If they are in the rule flag it
	 	foreach ( $product_terms as $term ) {
		 	if ( in_array( $term->term_id, $rule_taxes ) ) {
			 	$apply_rule = true;
		 	}
	 	}
	 	
	 	// If the rule applies, check the priority
	 	if ( $apply_rule == true ) {
	 	
	 		$priority = get_post_meta( $rule->ID, '_priority', true );	

	 		if( $priority != '' and $top > $priority or $top == null ) {
	 			$top = $priority;
	 			$top_rule = $rule;
		 	}
		}
	}
	
	return $top_rule;	
}

/*
*	Get the Input Value (min/max/step/priority/all) for a product given a rule
*
*	@params string	$type Product type
*	@params object 	$produt Product Object 
*	@params object	$rule Quantity Rule post object
*	@return void 	 
*/
function wpbo_get_value_from_rule( $type, $product, $rule ) {
	
	// Validate $type
	if ( $type != 'min' and $type != 'max' and $type != 'step' and $type != 'all' and $type != 'priority' ) {
		return null;
	
	// Validate for missing rule	
	} elseif ( $rule == null ) {
		return null;
	
	// Return Null if Inactive
	} elseif ( $rule == 'inactive' ) {
		return null;
	
	// Return Product Meta if Override is on
	} elseif ( $rule == 'override' ) {
		
		switch ( $type ) {
			case 'all':
				return array( 
						'min_value' => get_post_meta( $product->id, '_wpbo_minimum', true ),
						'max_value' => get_post_meta( $product->id, '_wpbo_maximum', true ),
						'step' 		=> get_post_meta( $product->id, '_wpbo_step', true )
					);
				break;
			case 'min':
				return get_post_meta( $product->id, '_wpbo_minimum', true );
				break;
			
			case 'max': 
				return get_post_meta( $product->id, '_wpbo_maximum', true );
				break;
				
			case 'step':
				return get_post_meta( $product->id, '_wpbo_step', true );
				break;
				
			case 'priority':
				return null;
				break;
		}		
	
	// Check for Site Wide Rule
	} elseif ( $rule == 'sitewide' ) {

		$options = get_option( 'ipq_options' );
		
		if( isset( $options['ipq_site_min'] ) ) {
			$min = $options['ipq_site_min'];
		} else {
			$min = '';
		}

		if( isset( $options['ipq_site_max'] ) ) {
			$max = $options['ipq_site_max'];
		} else {
			$max = '';
		}

		if( isset( $options['ipq_site_step'] ) ) {
			$step = $options['ipq_site_step'];			
		} else {
			$step = '';			
		}

		switch ( $type ) {
			case 'all':
				return array( 
					'min_value' => $min, 
					'max_value' => $max, 
					'step' 		=> $step
				);
				break;
				
			case 'min':
				return array( 'min' => $min );					
				break;
			
			case 'max': 
				return array( 'max' => $max );		
				break;
				
			case 'step':
				return array( 'step' => $step );				
				break;
				
			case 'priority':
				return null;
				break;
		
		}
		
	// Return Values from the Rule based on $type requested
	} else {
	
		switch ( $type ) {
			case 'all':
				return array( 
						'min_value' => get_post_meta( $rule->ID, '_min', true ),
						'max_value' => get_post_meta( $rule->ID, '_max', true ),
						'step' 		=> get_post_meta( $rule->ID, '_step', true ),
						'priority'  => get_post_meta( $rule->ID, '_priority', true )
					);
				break;
				
			case 'min':
				return get_post_meta( $rule->ID, '_min', true );
				break;
			
			case 'max': 
				return get_post_meta( $rule->ID, '_max', true );
				break;
				
			case 'step':
				return get_post_meta( $rule->ID, '_step', true );
				break;
				
			case 'priority':
				return get_post_meta( $rule->ID, '_priority', true );
				break;
		}				
	}
}

/*
*	Validate inputs as numbers and set them to null if 0
*/
function wpbo_validate_number( $number ) {
	
	$number = intval( $number );
	
	if ( $number == 0 ) {
		return null;
	} elseif ( $number < 0 ) {
		return null;
	} 
	
	return $number;
}