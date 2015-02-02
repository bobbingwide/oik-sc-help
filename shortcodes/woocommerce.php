<?php // (C) Copyright Bobbing Wide 2013-2015


// @TODO WooCommerce shortcode processing moved from 1.6.6 to 2.0
//oik_require( "shortcodes/shortcode-init.php", "woocommerce" );

/**
 * Shortcode help for WooCommerce shortcodes
 *
 * This list of shortcodes extracted from Woocommerce 2.2.10 -  class-wc-shortcodes.php on 2015/01/29
 
 $shortcodes = array(
			'add_to_cart'                => __CLASS__ . '::product_add_to_cart',
			'add_to_cart_url'            => __CLASS__ . '::product_add_to_cart_url',
			'best_selling_products'      => __CLASS__ . '::best_selling_products',
			'featured_products'          => __CLASS__ . '::featured_products',
			'product'                    => __CLASS__ . '::product',
			'product_attribute'          => __CLASS__ . '::product_attribute',
			'product_categories'         => __CLASS__ . '::product_categories',
			'product_category'           => __CLASS__ . '::product_category',
			'product_page'               => __CLASS__ . '::product_page',
			'products'                   => __CLASS__ . '::products',
			'recent_products'            => __CLASS__ . '::recent_products',
			'related_products'           => __CLASS__ . '::related_products',
			'sale_products'              => __CLASS__ . '::sale_products',
			'shop_messages'              => __CLASS__ . '::shop_messages',
			'top_rated_products'         => __CLASS__ . '::top_rated_products',
			'woocommerce_cart'           => __CLASS__ . '::cart',
			'woocommerce_checkout'       => __CLASS__ . '::checkout',
			'woocommerce_my_account'     => __CLASS__ . '::my_account',
			'woocommerce_order_tracking' => __CLASS__ . '::order_tracking',
      
      
 */
 

/** 
 *
 */
function add_to_cart__help() {
  return( "Show the price and add to cart button of a single product by ID" );
}

function add_to_cart__syntax( $shortcode="add_to_cart" ) {
  $syntax = array( "id" => bw_skv( null, "<id>product ID</i>", "Product ID" ));
  return( $syntax );
}

function add_to_cart_url__help() {
  return( "Echo the URL on the add to cart button of a single product by ID" );
}

function add_to_cart_url__syntax( $shortcode="add_to_cart_url" ) {
  $syntax = array( "id" => bw_skv( null, "<id>product ID</i>", "Product ID" ));
  return( $syntax );
}

function best_selling_products__help() {
  return( "Display best selling products" );
}

function best_selling_products__syntax() {
  $syntax = array( "per_page" => bw_skv( 12, "numeric", "Products per page" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 );
  return( $syntax );
}




function featured_products__help() { 
  return( "Display featured products" );
}

function featured_products__syntax() { 
  $syntax = array( "per_page" => bw_skv( 12, "numeric", "Products per page" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 , "orderby" => bw_skv( "date", "ID|title|parent|rand|menu_order", "Order" )
                 , "order" => bw_skv( "desc", "asc", "Sequence" )
                 );
  return( $syntax );
}

function product__help() { 
  return( "Show a single product by ID or SKU." );
}
                   
function product__syntax() {
  $syntax = array( "id" => bw_skv( null, "ID", "Product ID" )
                 , "sku" => bw_skv( null, "<i>SKU></i>", "Product SKU" )
                 );
  return( $syntax );
} 
                  
function product_attribute__help() { 
  return( "List products with an attribute" );
}
   
/** 
      
  [product_attribute attribute='color' filter='black']         
 */
function product_attribute__syntax() {
  $syntax = array( 'attribute' => bw_skv( null, "<i>attribute</i>", "Attribute name" )
                 , 'filter' => bw_skv( null, "<i>value</i>", "Attribute value" )
                 , "per_page" => bw_skv( 12, "numeric", "Products per page" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 , "orderby" => bw_skv( "title", "date|ID|parent|rand|menu_order", "Order" )
                 , "order" => bw_skv( "desc", "asc", "Sequence" )
                 );
  return( $syntax );                 
}

function product_categories__help() { 
  return( "Display product categories" );
}

/**
 *
 * The `number` field is used to display the number of products 
   and the `ids` field is to tell the shortcode which categories to display.

  [product_categories number="12" parent="0"]
  
  Set the parent parameter to 0 to only display top level categories. Set ids to a comma separated list of category ids to only show those.  
 */      
function product_categories__syntax() {
  $syntax = array( 'ids' => bw_skv( null, "<i>ids</i>", "Categories to display" )
                 , 'number' => bw_skv( null, 'number', "Number to display" )
                 , 'parent' => bw_skv( '', "<i>id</i>", "Parent category" )
                 , 'hide_empty' => bw_skv( '1', '0', "Hide empty (1=true)" )
                 , "orderby" => bw_skv( "name", "title|date|ID|parent|rand|menu_order", "Order" )
                 , "order" => bw_skv( "asc", "desc", "Sequence" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 );
  return( $syntax );
}
       
       
function product_category__help() { 
  return( "Show multiple products in a category by slug." );
}

/**
 * Syntax help for product_category shortcode
 *
 * [product_category category="appliances"]
 */
function product_category__syntax() { 
  $syntax = array( "category" => bw_skv( null, "<i>category_name</i>", "Category name" )
                 , "per_page" => bw_skv( 12, "numeric", "Products per page" )
                 , "orderby" => bw_skv( "title", "name|date|ID|parent|rand|menu_order", "Order" )
                 , "order" => bw_skv( "asc", "desc", "Sequence" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 );
  return( $syntax );
}

         
function product_page__help() { 
  return( "Show a full single product page by ID or SKU." );
}
/**
 *

   [product_page id="99"]
   [product_page sku="FOO"]    
 */          
function product_page__syntax() {
  $syntax = array( "id" => bw_skv( null, "ID", "Product ID" )
                 , "sku" => bw_skv( null, "<i>SKU></i>", "Product SKU" )
                 );
  return( $syntax );
}  
             
/*
function products__help() {                   
function products__syntax() {                   
function recent_products__help() {            
function recent_products__syntax() {            
function related_products__help() {           
function related_products__syntax() {           
function sale_products__help() {              
function sale_products__syntax() {              
function shop_messages__help() {              
function shop_messages__syntax() {              
function top_rated_products__help() {         
function top_rated_products__syntax() {         
function woocommerce_cart__help() {           
function woocommerce_cart__syntax() {           
function woocommerce_checkout__help() {       
function woocommerce_checkout__syntax() {       
function woocommerce_my_account__help() {     
function woocommerce_my_account__syntax() {     
function woocommerce_order_tracking__help() { 
function woocommerce_order_tracking__syntax() { 

*/
