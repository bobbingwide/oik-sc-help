<?php // (C) Copyright Bobbing Wide 2013-2016

/**
 * Help and Syntax for WooCommerce shortcodes
 * 
 * Latest version: 2.6.2
 *
 *
 * @TODO WooCommerce shortcode processing moved from 1.6.6 to 2.0
 *
 *
 * This list of shortcodes extracted from Woocommerce 2.2.10 ( class-wc-shortcodes.php ) on 2015/01/29.
 * Latest list ( 2.6.2 ) includes/class-wc-shortcodes.php, is the same as for 2.2.10, plus woocommerce_messages
 *
 * Done? | Shortcode | Implementing method
 * ----- | --------- | -------------------
 * y | 'add_to_cart'                | __CLASS__ . '::product_add_to_cart',
 * y | 'add_to_cart_url'            | __CLASS__ . '::product_add_to_cart_url',
 * y | 'best_selling_products'      | __CLASS__ . '::best_selling_products',
 * y | 'featured_products'          | __CLASS__ . '::featured_products',
 * y | 'product'                    | __CLASS__ . '::product',
 * y | 'product_attribute'          | __CLASS__ . '::product_attribute',
 * y | 'product_categories'         | __CLASS__ . '::product_categories',
 * y | 'product_category'           | __CLASS__ . '::product_category',
 * y | 'product_page'               | __CLASS__ . '::product_page',
 * y | 'products'                   | __CLASS__ . '::products',
 * y | 'recent_products'            | __CLASS__ . '::recent_products',
 * y | 'related_products'           | __CLASS__ . '::related_products',
 * y | 'sale_products'              | __CLASS__ . '::sale_products',
 * y | 'shop_messages'              | __CLASS__ . '::shop_messages',
  'top_rated_products'         | __CLASS__ . '::top_rated_products',
  'woocommerce_cart'           | __CLASS__ . '::cart',
  'woocommerce_checkout'       | __CLASS__ . '::checkout',
  'woocommerce_my_account'     | __CLASS__ . '::my_account',     
  'woocommerce_order_tracking' | __CLASS__ . '::order_tracking',
 * y |'woocommerce_messages' | __CLASS__::shop_messages 
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
             
function products__help() {  
	return( "Show products" ); 
}								 
/** 
 * Syntax help for products shortcode
 *
 */ 
function products__syntax() {
  $syntax = array( "ids" => bw_skv( null, "<i>ids</i>", "Product ids. Comma separated." )
								 , "skus" => bw_skv( null, "<i>skus</i>", "Product SKUs. Comma separated." ) 
                 , "orderby" => bw_skv( "title", "name|date|ID|parent|rand|menu_order", "Order" )
                 , "order" => bw_skv( "asc", "desc", "Sequence" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 );
	return( $syntax ); 
}

                
function recent_products__help() { 
	return( "Recent products" );
}						
/**
 * Syntax help for recent_products shortcode
 */ 
function recent_products__syntax() {
  $syntax = array( "category" => bw_skv( null, "<i>category_name</i>", "Category name" )
								 , "operator" => bw_skv( "IN", "NOT IN|AND", "Comparison operator" )
                 , "per_page" => bw_skv( 12, "numeric", "Products per page" )
                 , "orderby" => bw_skv( "date", "title|name|ID|parent|rand|menu_order", "Order" )
                 , "order" => bw_skv( "desc", "asc", "Sequence" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 );
  return( $syntax );
}
           
function related_products__help() {           
	return( "Related Products" );
}

function related_products__syntax() {  
  $syntax = array( "per_page" => bw_skv( 12, "numeric", "Products per page" )
                 , "orderby" => bw_skv( "rand", "title|name|date|ID|parent|menu_order", "Order" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 );
  return( $syntax );
}
         
function sale_products__help() {
	return( "Sale Products" );
}

/**
 * Syntax help for sale_products shortcode
 */
function sale_products__syntax() { 
  $syntax = array( "per_page" => bw_skv( 12, "numeric", "Products per page" )
                 , "orderby" => bw_skv( "title", "name|date|ID|parent|rand|menu_order", "Order" )
                 , "order" => bw_skv( "asc", "desc", "Sequence" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 );
  return( $syntax );
}

/**
 * Help for shop_messages shortcode
 */
function shop_messages__help() { 
	return( "Show messages" );
}

/**
 * Syntax help for shop_messages shortcode
 */            
function shop_messages__syntax() { 
	return( null );
}
             
function top_rated_products__help() { 
	return( "Top rated products" );
}
 
/**
 * Syntax help for top_rated_products shortcode
 */       
function top_rated_products__syntax() { 
  $syntax = array( "category" => bw_skv( null, "<i>category_name</i>", "Category name" )
								 , "operator" => bw_skv( "IN", "NOT IN|AND", "Comparison operator" )
                 , "per_page" => bw_skv( 12, "numeric", "Products per page" )
                 , "orderby" => bw_skv( "title", "date|name|ID|parent|rand|menu_order", "Order" )
                 , "order" => bw_skv( "asc", "desc", "Sequence" )
                 , "columns" => bw_skv( 4, "numeric", "Columns" )
                 );
  return( $syntax );
}        
/* 
function woocommerce_cart__help() {           
function woocommerce_cart__syntax() {           
function woocommerce_checkout__help() {       
function woocommerce_checkout__syntax() {       
function woocommerce_my_account__help() {     
function woocommerce_my_account__syntax() {     
function woocommerce_order_tracking__help() { 
function woocommerce_order_tracking__syntax() { 

*/

/**
 * Help for woocommerce_messages shortcode
 *
 * woocommerce_messages is an alias of shop_messages
 */            
function woocommerce_messages__help() { 
	return( show_messages__help() );
}

/**
 * Syntax help for woocommerce_messages shortcode
 * 
 * woocommerce_messages is an alias of shop_messages
 */            
function woocommerce_messages__syntax() { 
	return( shop_messages__syntax() );
}             
