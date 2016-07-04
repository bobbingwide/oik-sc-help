<?php // (C) Copyright Bobbing Wide 2012-2016

/**
 * 
 * Help and Syntax for Easy Digital Downloads ( EDD ) shortcodes
 * 
 * Latest version: 2.6.3
 *
 *
 * This table of shortcodes extracted from Easy Digital Downloads v2.6.2 ( includes/shortcodes.php) on 2016/07/02.
 * 
 * Done | Shortcode | Function
 * ---- | ---------- | ---------
 * y | download_cart | edd_cart_shortcode
 * y | download_checkout | edd_checkout_form_shortcode
 * y | download_discounts | edd_discounts_shortcode
 * y | download_history | edd_download_history
 * y | downloads | edd_downloads_query
 * y | edd_login | edd_login_form_shortcode
 * y | edd_price | edd_download_price_shortcode
 * y | edd_profile_editor | edd_profile_editor_shortcode
 * y | edd_receipt | edd_receipt_shortcode
 * y | edd_register | edd_register_form_shortcode
 * y | purchase_collection | edd_purchase_collection_shortcode
 * y | purchase_history | edd_purchase_history
 * y | purchase_link | edd_download_shortcode
 *
 */
 
/*
 * @TODO - reinstate this logic for when EDD is not actually active
 *
 * Currently commented out since EDD shortcodes don't work properly when EDD is not actually active.
 * but if we do this it could look as if they are. 
		`
		$path = oik_path( "includes/shortcodes.php", "easy-digital-downloads" );
		if ( file_exists( $path ) ) {
			oik_require( "includes/shortcodes.php", "easy-digital-downloads" );
		}
 * `
 */
 
/**
 * Help for download_cart
 */
function download_cart__help() {
	return( "Show the shopping cart" );
}

/**
 * Syntax help for download_cart
 */
function download_cart__syntax() {
	return( null );
}

/**
 * Help for download_checkout shortcode
 */
function download_checkout__help() {
	return( "Show the checkout form" );
}

/**
 * Syntax help for download_checkout
 */
function download_checkout__syntax() {
	return( null );
}

/** 
 * Help for download_discounts shortcode
 */
function download_discounts__help() {
	return( "Show available discount codes" );
}

/** 
 * Syntax help for download_discounts shortcode
 */
function download_discounts__syntax() {
	return( null );
}
  
/** 
 * Help for download_history shortcode
 */
function download_history__help() {
	return( "Show user's download history" );
}
 
/** 
 * Syntax help for download_history shortcode
 */
function download_history__syntax() {
	return( null );
}

/**
 * Help for downloads shortcode
 */
function downloads__help() {
	return( "Show downloads list / grid " );
}

/**
 * Syntax help for downloads shortcode
 *  
 * Originally extracted from version 1.3.2.1.
 * Rechecked and updated against 2.6.2
 * 
 */                
function downloads__syntax( $shortcode="downloads" ) {
	$syntax = array( "category" => bw_skv( "", "<i>category list</i>", "Categories to display" )
								 , "exclude_category" => bw_skv( "", "<i>category list</i>", "Categories to exclude" )
								 , "tags" => bw_skv( "", "<i>tag list</i>", "Tags to display " ) 
								 , "exclude_tags" => bw_skv( "", "<i>tag list</i>", "Tags to exclude" )
								 , "relation" => bw_skv( "OR", "?", "Relation" )
								 , "number" => bw_skv( 9, "<i>number</i>", "Number to show" )
								 , "price" => bw_skv( "no", "yes", "Include price?" )
								 , "excerpt" => bw_skv( "yes", "no", "Include excerpt?" )
								 , "full_content" => bw_skv( "no", "yes", "Include full content? " )
								 , "buy_button" => bw_skv( "yes", "no", "Include the Purchase button?" )
								 , "columns" => bw_skv( 3, "number", "Number of columns per row" )
								 , "thumbnails" => bw_skv( "true", "false", "Display thumbnail images" )
								 , "orderby" => bw_skv( "post_date", "price|title|id|random|post__in", "Sort sequence" )
								 , "order" => bw_skv( "DESC", "ASC", "Sort sequence" )
								 , "ids" => bw_skv( null, "<i>IDs</i>", "IDs to display" )
								 , "pagination" => bw_skv( "true", "false", "Support pagination" )
									 );
	return( $syntax );
}
 
/**
 * Help for edd_login shortcode
 * 
 */
function edd_login__help() {
	return( "Display the login form, if not already logged in" );
}
  
/**
 * Syntax help for edd_login shortcode
 * 
 * @{see edd_login_form_shortcode() } for latest logic
 *
 * @TODO Check edd_get_option() is available? 
 */
function edd_login__syntax() {
	$purchase_history = edd_get_option( 'purchase_history_page', null );
	if ( $purchase_history ) {
		$redirect = get_permalink( $purchase_history );
	} else {
		$redirect = home_url();
	}
	$syntax = array( "redirect" => bw_skv( $redirect, "<i>URL</i>", "Redirect URL after login." ) );
	return( $syntax );
} 
                  
/** 
 * Help for edd_price shortcode
 */
function edd_price__help( ) {
	return( "Display the download's price" );
}

/**
 * Syntax help for edd_price shortcode
 *
 * Uses $post->ID if not specified 
 */
function edd_price__syntax( $shortcode="edd_price" ) {
	$syntax = array( "id" => bw_skv( "", "<i>download ID</i>", "ID of the download" )
								 , "price_id" => bw_skv( "false", "<i>price ID</i>", "ID of the variable price" )
								 );
	return( $syntax );
}

/**
 * Implement help hook for edd_profile_editor 
 */
function edd_profile_editor__help( $shortcode="edd_profile_editor" ) {
	return( "User profile editor" );
}

/**
 * Syntax help for edd_profile_editor
 */
function edd_profile_editor__syntax() {
	return( null );
}

/**
 * Implement example hook for edd_profile_editor
 *
 * Fatal error: Call to undefined function edd_get_template_part() in 
 * C:\apache\htdocs\wordpress\wp-content\plugins\easy-digital-downloads\includes\shortcodes.php on line 569
 */
function edd_profile_editor__example( $shortcode="edd_profile_editor" ) {
	if ( function_exists( "EDD" ) ) {
		oik_require( "includes/template-functions.php", "easy-digital-downloads" );
		//EDD();
		$text = "Easy Digital Downloads Profile Editor" ;
		$example = '';
		bw_invoke_shortcode( $shortcode, $example, $text );
	} else {
		e( "Example not possible at this time. EDD not active" ); 
	}  
}

/**
 * Help for edd_receipt
 */
function edd_receipt__help() {
	return( "Display purchase receipt" );
}

/**
 * Syntax help for edd_receipt
  
	$edd_receipt_args = shortcode_atts( array(
		'error'           => __( 'Sorry, trouble retrieving payment receipt.', 'easy-digital-downloads' ),
		'price'           => true,
		'discount'        => true,
		'products'        => true,
		'date'            => true,
		'notes'           => true,
		'payment_key'     => false,
		'payment_method'  => true,
		'payment_id'      => true
	), $atts, 'edd_receipt' );
 */
function edd_receipt__syntax() {
	$error =  __( 'Sorry, trouble retrieving payment receipt.', 'easy-digital-downloads' );
	$syntax = array( "error" => bw_skv( $error, "<i>text</i>", "Error text" )
								 , "price" => bw_skv( "true", "false", "Display price" )
								 , "discount" => bw_skv( "true", "false", "Display discount" )
								 , "date" => bw_skv( "true", "false", "Display date" )
 								 , "notes" => bw_skv( "true", "false", "Display notes" )
 								 , "payment_key" => bw_skv( "false", "<i>payment_key</i>", "Payment key" )
 								 , "payment_method" => bw_skv( "true", "false", "Display payment method" )
 								 , "payment_id" => bw_skv( "true", "false", "Display payment ID" )
								 );
	return( $syntax );
} 


/**
 * Help for edd_register shortcode
 * 
 */
function edd_register__help() {
	return( "Display the registration form, if not already logged in." );
}
  
/**
 * Syntax help for edd_register shortcode
 * 
 * edd_register implements the same logic as for edd_login.
 * So, by default, after registering, the user gets redirected to the purchase history page
 * or home URL if that's not set.
 */
function edd_register__syntax() {
	$purchase_history = edd_get_option( 'purchase_history_page', null );
	if ( $purchase_history ) {
		$redirect = get_permalink( $purchase_history );
	} else {
		$redirect = home_url();
	}
	$syntax = array( "redirect" => bw_skv( $redirect, "<i>URL</i>", "Redirect URL after login." ) );
	return( $syntax );
}
 
/**  
 * Help for purchase_collection shortcode
 */
function purchase_collection__help() {
	return( "Display a purchase collection link" );
}

/**
 * Syntax help for purchase_collection shortcode
 */
function purchase_collection__syntax( $shortcode="purchase_collection" ) {
	$text	= __('Purchase All Items','easy-digital-downloads' );
	$syntax = array( "taxonomy" => bw_skv( "", "<i>taxonomy</i>", "Taxonomy name" )
								 , "terms" => bw_skv( "", "<i>terms</i>", "Taxonomy terms" )
								 , "text" => bw_skv( $text, "<i>link text</i>", "Text for link to purchase all items" )
								 , "style" => bw_skv( edd_get_option( 'button_style', 'button' ), "plain", "Button style" )
								 , "color" => bw_skv( edd_get_option( 'checkout_color', 'blue' ), "white|gray|red|green|yellow|orange|dark-gray|inherit", "Button color" )
								 , "class" => bw_skv( "edd-submit", "<i>CSS classes</i>", "One or more custom CSS class names" )
								 );
	return( $syntax );
} 

/**  
 * Help for purchase_history shortcode
 */
function purchase_history__help() {
	return( "Show user's purchase history" );
}

/**  
 * Syntax help for purchase_history shortcode
 */
function purchase_history__syntax() {
	return( null );
}

/**
 * Help for purchase_link shortcode 
 */
function purchase_link__help() {
	return( "Display purchase button" );
} 

/**
 * Syntax help for purchase_link shortcode
 * 
 * Updated for 2.6.3
 */
function purchase_link__syntax() {
	$syntax = array( "id" => bw_skv( "ID", "<i>download ID</i>", "ID of the download" )
								 , "price_id" => bw_skv( "false", "<i>price ID</i>", "ID of the variable price" )
								 , "sku" => bw_skv( "", "<i>SKU</i>", "Stock Keeping Unit" )
								 , "price" => bw_skv( "1", "0", "no", "Display price?" )
								 , "direct" => bw_skv( "0", "1", "no", "Buy now?" )
								 , "text" => bw_skv( "", "<i>text</i>", "Add to cart or Buy now text" )
								 , "style" => bw_skv( edd_get_option( 'button_style', 'button' ), "plain", "Button style" )
								 , "color" => bw_skv( edd_get_option( 'checkout_color', 'blue' ), "white|gray|red|green|yellow|orange|dark-gray|inherit", "Button color" )
								 , "class" => bw_skv( "edd-submit", "<i>CSS classes</i>", "One or more custom CSS class names" )
								 , "form_id" => bw_skv( null, "<i>form ID</i>", "Form ID" )
								 );
	return( $syntax );
} 




 
 
