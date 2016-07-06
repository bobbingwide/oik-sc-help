<?php
/*
Plugin Name: oik shortcode help shortcodes
Plugin URI: http://www.oik-plugins.com/oik-plugins/oik-sc-help
Description: [bw_code] and [bw_codes] shortcodes and help for wp-members, WooCommerce, Easy-Digital-Downloads, Jetpack and Genesis theme framework shortcodes
Version: 1.20.4
Author: bobbingwide
Author URI: http://www.oik-plugins.com/author/bobbingwide
License: GPL2

    Copyright 2012-2016 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

/**
 * Implement "oik_add_shortcodes" action for oik-sc-help
 *
 * Note that the shortcode functions are implemented by the oik base plugin 
 * 
 */
function oik_sc_help_init() { 
  bw_add_shortcode( "bw_codes", "bw_codes", oik_path( "shortcodes/oik-codes.php") , false );
  bw_add_shortcode( "bw_code", "bw_code", oik_path( "shortcodes/oik-codes.php") , false ); 
  oik_sc_help_wpmembers();
  oik_sc_help_woocommerce();
  oik_sc_help_easy_digital_downloads();
  oik_sc_help_jetpack();
	oik_sc_help_genesis();
	
	add_filter( "oiksc_shortcodes_components", "oik_sc_shortcodes_components", 11 );
	
}

/**
 * Associate a shortcode to a component
 * 
 * @param string $shortcode	- the shortcode
 * @param string $component - the component's slug
 */
function oik_sc_shortcode_component( $shortcode, $component ) {
	global $shortcode_components;
	$shortcode_components[ $shortcode ] = $component;
	//print_r( $shortcode_components );
}

/**
 * Implement "oiksc_shortcodes_components" for oik-sc-help
 * 
 * @param array $shortcodes - mapping of shortcode to component
 * @return array updated array
 */
function oik_sc_shortcodes_components( $shortcodes ) {
	global $shortcode_components;
	if ( is_array( $shortcode_components ) && count( $shortcode_components ) ) {
		foreach ( $shortcode_components as $shortcode => $component ) {	
			$shortcodes[ $shortcode ] = $component;
			echo "$shortcode -> $component " . PHP_EOL;
		}
	}
	return( $shortcodes );
}

/** 
 * Add shortcode help for the WP-members plugin 
 * 
 * Checks for presence of a shortcode before adding the others
 *  
 */
function oik_sc_help_wpmembers() {  
  if ( shortcode_exists( "wp-members" ) ) { 
    $path = oik_path( "shortcodes/wp-members.php", "oik-sc-help" );
    $shortcodes = bw_as_array( "wp-members,wpmem_field,wpmem_logged_in,wpmem_logged_out,wpmem_logout" );
    foreach ( $shortcodes as $key => $shortcode ) {
      bw_add_shortcode_file( $shortcode, $path );
			oik_sc_shortcode_component( $shortcode, "wp-members" );
    } 
  }
}

/** 
 * Add shortcode help for the WooCommerce plugin
 *
 * Up to v2.6.2 
 */
function oik_sc_help_woocommerce() {
  //if ( shortcode_exists( "add_to_cart" ) ) {
    $path = oik_path( "shortcodes/woocommerce.php", "oik-sc-help" );
    $shortcodes = array( 'add_to_cart' 
                    , 'add_to_cart_url'            
                    , 'best_selling_products'      
                    , 'featured_products'          
                    , 'product'                    
                    , 'product_attribute'          
                    , 'product_categories'         
                    , 'product_category'           
                    , 'product_page'               
                    , 'products'                   
                    , 'recent_products'            
                    , 'related_products'           
                    , 'sale_products'              
                    , 'shop_messages'              
                    , 'top_rated_products'         
                    , 'woocommerce_cart'           
                    , 'woocommerce_checkout'       
										, 'woocommerce_messages' 
                    , 'woocommerce_my_account'     
                    , 'woocommerce_order_tracking'
                    );
    foreach ( $shortcodes as $key => $shortcode ) {
      bw_add_shortcode_file( $shortcode, $path );
			oik_sc_shortcode_component( $shortcode, "woocommerce" );
    }
  //} 
}

/**
 * Add shortcode help for the Easy Digital Downloads plugin
 * 
 * Shortcode list created on 2015/02/01 from EDD version 2.2.1

shortcodes.php:add_shortcode( 'purchase_link', 'edd_download_shortcode' );
shortcodes.php:add_shortcode( 'download_history', 'edd_download_history' );
shortcodes.php:add_shortcode( 'purchase_history', 'edd_purchase_history' );
shortcodes.php:add_shortcode( 'download_checkout', 'edd_checkout_form_shortcode' );
shortcodes.php:add_shortcode( 'download_cart', 'edd_cart_shortcode' );
shortcodes.php:add_shortcode( 'edd_login', 'edd_login_form_shortcode' );
shortcodes.php:add_shortcode( 'edd_register', 'edd_register_form_shortcode' );
shortcodes.php:add_shortcode( 'download_discounts', 'edd_discounts_shortcode' );
shortcodes.php:add_shortcode( 'purchase_collection', 'edd_purchase_collection_shortcode' );
shortcodes.php:add_shortcode( 'downloads', 'edd_downloads_query' );
shortcodes.php:add_shortcode( 'edd_price', 'edd_download_price_shortcode' );
shortcodes.php:add_shortcode( 'edd_receipt', 'edd_receipt_shortcode' );
shortcodes.php:add_shortcode( 'edd_profile_editor', 'edd_profile_editor_shortcode' );
  
 */ 
function oik_sc_help_easy_digital_downloads() {                  
  $shortcodes = "purchase_link,download_history,purchase_history,download_checkout,download_cart,edd_login,edd_register,download_discounts,purchase_collection,downloads,edd_price,edd_receipt,edd_profile_editor"; 
  oik_sc_help_generic( "shortcodes/easy-digital-downloads.php", $shortcodes, "easy-digital-downloads" ); 
}

/**
 * Add shortcode help for Jetpack 
 *
 * All shortcodes from Jetpack 3.6.2
 * Latest version of Jetpack 4.0.4
 * 
 * Some shortcodes will not be active until the implementing module is activated
 * @TODO Add all the missing shortcodes to this list
 */ 
function oik_sc_help_jetpack() {
  $shortcodes = "archives,audio,contact-form,contact-field,portfolio,jetpack_portfolio,recipe,facebook,flickr,soundcloud,";
	$shortcodes .= "jetpack-related-posts,slideshow,videopress,wpvideo,";
	$shortcodes .= "latex,bandcamp,blip.tv,dailymotion,dailymotion-channel,digg,gist,googlemaps,googleplus,googlevideo,houzz,";
	$shortcodes .= "instagram,medium,mixcloud,";
  oik_sc_help_generic( "shortcodes/jetpack.php", $shortcodes, "jetpack" ); 
	
}

/**
 * Add shortcode help for Genesis
 * 
 * All shortcodes from Genesis v2.2.7.
 * Recently checked against Genesis v2.3.0
 */
function oik_sc_help_genesis() {
  $shortcodes = "footer_backtotop,footer_childtheme_link,footer_copyright,footer_genesis_link,footer_studiopress_link,footer_wordpress_link,footer_loginout";
	$shortcodes .= ",post_date,post_time,post_modified_date,post_modified_time";
	$shortcodes .= ",post_author,post_author_link,post_author_posts_link";
	$shortcodes .= ",post_comments,post_tags,post_categories,post_terms,post_edit";
  oik_sc_help_generic( "shortcodes/genesis.php", $shortcodes, "genesis" ); 
}
 
  
/**
 * Generic add shortcode file for any other plugin / theme
 *
 * The first shortcode in the array must be registered as a shortcode
 * for any further processing to take place.
 * Whether or not you create the shortcode help and syntax is up to you.
 * Note that the file is not loaded until the shortcode syntax is required.
 * 
 * @param string $file - the filename within the shortcodes folder e.g. shortcodes/plugin.php
 * @param mixed $shortcodes - CSV/array of shortcodes 
 * @param string $component  
 */ 
function oik_sc_help_generic( $file, $shortcodes, $component ) {
  $shortcodes = bw_as_array( $shortcodes );
  //$first = $shortcodes[0];
  //if ( shortcode_exists( $first ) ) {
    $path = oik_path( $file, "oik-sc-help" );
    foreach ( $shortcodes as $key => $shortcode ) {
      bw_add_shortcode_file( $shortcode, $path );
			oik_sc_shortcode_component( $shortcode, $component );
    }
  //} else {
	//	bw_trace2( $first, "shortcode does not exist", true, BW_TRACE_WARNING );
	//}
}

/**
 * Implement "oik_admin_menu" action for oik-sc-help
 * 
 * Set the plugin server
 * It's no longer necessary to relocate the plugin
 */
function oik_sc_help_admin_menu() {
  oik_register_plugin_server( __FILE__ );
  //bw_add_relocation( 'oik/oik-sc-help.php', 'oik-sc-help/oik-sc-help.php' );
  //add_theme_support( 'woocommerce' );
}

/**
 * Implement "admin_notices" for oik-sc-help plugin
 *
 * Now dependent upon oik v3.0.0 or higher
 */ 
function oik_sc_help_activation() {
  static $plugin_basename = null;
  if ( !$plugin_basename ) {
    $plugin_basename = plugin_basename(__FILE__);
    add_action( "after_plugin_row_oik-sc-help/oik-sc-help.php", "oik_sc_help_activation" );   
    if ( !function_exists( "oik_plugin_lazy_activation" ) ) { 
      require_once( "admin/oik-activation.php" );  
    }
  }  
  $depends = "oik:3.0.0";
  oik_plugin_lazy_activation( __FILE__, $depends, "oik_plugin_plugin_inactive" );
}
 
/**
 * Implement "_sc__help" filter to help find help for a shortcode
 *
 * Props: bartee for Shortcode Reference. It's helpful to know the function name at least
 * I don't need the Reflection logic yet.
 *
 * @param array $default_help array of help info found so far
 * @param string $shortcode the shortcode we're currently interested in
 * @return array updated with the function name if the help was missing but the shortcode is active
 */ 
function oik_sc_help_sc__help( $default_help, $shortcode ) {
	global $shortcode_tags;
	if ( !isset( $default_help[ $shortcode ] ) ) {
		if ( isset( $shortcode_tags[ $shortcode ] ) ) { 
			$function_name = $shortcode_tags[ $shortcode ];
			if ( is_string( $function_name ) ){
		 		$default_help[ $shortcode ] = $function_name;
			} else {
				$default_help[ $shortcode ] = /* $function_name[0] . '::'. */ $function_name[1];
			}
		}	
	}
	return( $default_help );
}

/** 
 * Function to invoke when oik-sc-help plugin loaded                             
 */
function oik_sc_help_plugin_loaded() {
  add_action( "oik_add_shortcodes", "oik_sc_help_init" );
  add_action( "oik_admin_menu", "oik_sc_help_admin_menu" );
  add_action( "admin_notices", "oik_sc_help_activation" );
	add_filter( "_sc__help", "oik_sc_help_sc__help", 10, 2 );
}

oik_sc_help_plugin_loaded();










