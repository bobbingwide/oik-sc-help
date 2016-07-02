<?php // (C) Copyright Bobbing Wide 2012-2016

/**
 * 
 * Help and Syntax for Easy Digital Downloads ( EDD ) shortcodes
 * 
 * Latest version: 2.6.3
 *
 *
 * This table of shortcodes extracted from Easy Digital Downloads v2.6.2, on 2016/07/02.
 * Done | Shortcode | Function
 * ---- | ---------- | ---------
 * y | download_cart | edd_cart_shortcode
 * y | download_checkout | edd_checkout_form_shortcode
  | download_discounts | edd_discounts_shortcode
  | download_history | edd_download_history
  | downloads | edd_downloads_query
  | edd_login | edd_login_form_shortcode
  | edd_price | edd_download_price_shortcode
  | edd_profile_editor | edd_profile_editor_shortcode
  | edd_receipt | edd_receipt_shortcode
  | edd_register | edd_register_form_shortcode
  | purchase_collection | edd_purchase_collection_shortcode
  | purchase_history | edd_purchase_history
  | purchase_link | edd_download_shortcode
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
 * download_discounts', 'edd_discounts_shortcode' )
 */
function download_discounts__help() {
	return( "Show available discount codes" );
}

/**
 * purchase_link = edd_download_shortcode 
 */
function purchase_link__help() {
	return( "Display purchase button" );
} 

/** 
 * @link https://easydigitaldownloads.com/docs/display-purchase-buttons-purchase_link/

[purchase_link id="4747" text="Purchase" style="button" color="green"]

id – the ID number of the download for the button
text – the text displayed on the button
style – the style of the purchase link, either “button” or “text”
color- the color of the button (when using the “button” style”:
gray
blue
green
dark gray
yellow
class – one or more custom CSS classes you want applied to the button
} 


	extract( shortcode_atts( array(
			'id' 	=> $post->ID,
			'text'	=> isset( $edd_options[ 'add_to_cart_text' ] ) && $edd_options[ 'add_to_cart_text' ] != '' ? $edd_options[ 'add_to_cart_text' ] 	: __( 'Purchase', 'edd' ),
			'style' => isset( $edd_options[ 'button_style' ] ) 	 	? $edd_options[ 'button_style' ] 		: 'button',
			'color' => isset( $edd_options[ 'checkout_color' ] ) 	? $edd_options[ 'checkout_color' ] 		: 'blue',
			'class' => 'edd-submit'

 */
function purchase_link__syntax() {
	$syntax = array( "id" => bw_skv( "ID", "<i>download ID</i>", "ID of the download" )
									 , "text" => bw_skv( "", "<i>Add to cart text</i>", "Add to cart text" )
									 , "style" => bw_skv( "button", "text", "Defined button style" )
									 , "color" => bw_skv( "blue", "gray|green|dark gray|yellow", "Checkout button colour" )
									 , "class" => bw_skv( "edd-submit", "<i>CSS classes</i>", "one or more custom CSS classes" )
									 );
	return( $syntax );
} 

  
/** 
download_history', 'edd_download_history' );
*/
function download_history__help() {
	return( "Show user's download history" );
} 

/**  
 * purchase_history', 'edd_purchase_history' );
 */
function purchase_history__help() {
	return( "Show user's purchase history" );
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
	$syntax = null;
	return( $syntax );
}

/**
 * Help for edd_login shortcode
 *
 * edd_login', 'edd_login_form_shortcode' );
 */
function edd_login__help() {
	return( "Display the login form, if not already logged in" );
}
  
/**
 * Syntax help for edd_login shortcode
 */
function edd_login__syntax() {
	return( null );
} 

/**  
 * Help for purchase_collection shortcode
 *
 * purchase_collection', 'edd_purchase_collection_s
 */
function purchase_collection__help() {
	return( "Display a purchase collection link" );
}

/**
 * Syntax help for purchase_collection shortcode
 *
 */
function purchase_collection__syntax( $shortcode="purchase_collection" ) {
	$syntax = array( "taxonomy" => bw_skv( "", "<i>taxonomy</i>", "Taxonomy name" )
								 , "terms" => bw_skv( "", "<i>terms</i>", "Taxonomy terms" )
								 , "link" => bw_skv( "Purchase All Items", "link text", "Text for link to purchase all items" )
								 );
	return( $syntax );
}                   
/**
 * Help for downloads shortcode
 *
 * downloads', 'edd_downloads_query' );
 */
function downloads__help() {
	return( "Show downloads list / grid " );
}

/**
 * Syntax help for downloads shortcode
 *  
 * Extracted from version 1.3.2.1
 
	extract( shortcode_atts( array(
			'category' => '',
			'tags' => '',
			'relation' => 'OR',
			'number' => 10,
			'price' => 'yes',
			'excerpt' => 'yes',
			'full_content' => 'no',
			'buy_button' => 'yes',
			'columns' => 3,
			'thumbnails' => 'true',
			'orderby' => 'post_date',
			'order' => 'DESC'
		), $atts )
 */                
function downloads__syntax( $shortcode="downloads" ) {
	$syntax = array( "category" => bw_skv( "", "<i>category list</i>", "Categories to display" )
								 , "tags" => bw_skv( "", "<i>tag list</i>", "Tags to display " ) 
								 , "relation" => bw_skv( "OR", "?", "Relation" )
								 , "number" => bw_skv( 10, "<i>number</i>", "Number to show" )
								 , "excerpt" => bw_skv( "yes", "no", "Include excerpt?" )
								 , "full_content" => bw_skv( "no", "yes", "Include full content? " )
								 , "buy_button" => bw_skv( "yes", "no", "Include the Purchase button" )
								 , "columns" => bw_skv( 3, "number", "Number of columns per row" )
								 , "thumbnails" => bw_skv( "true", "false", "Display thumbnail images" )
								 , "orderby" => bw_skv( "post_date", "", "Sort sequence" )
								 , "order" => bw_skv( "DESC", "ASC", "Sort sequence" )
									 );
	return( $syntax );
} 
                  
/** 
 * Help for edd_price shortcode
 *
 * edd_price', 'edd_download_price_shortcode' );
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
	$syntax = array( "id" => bw_skv( "", "<i>download ID</i>", "ID of the download" ) );
	return( $syntax );
}

/**
 * Implement help hook for edd_profile_editor 
 */
function edd_profile_editor__help( $shortcode="edd_profile_editor" ) {
	return( "User profile editor" );
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
 
 
