<?php // (C) Copyright Bobbing Wide 2017


/**
 * Shortcode help for [wpseo_breadcrumb]
 */
function wpseo_breadcrumb__help( $shortcode="wpseo_breadcrumbs" ) {
	return( "Display breadcrumbs" );
}

/**
 * Syntax help for [wpseo_breadcrumb]
 * 
 * No parameters in 4.2.1
 */
function wpseo_breadcrumb__syntax( $shortcode="wpseo_breadcrumbs" ) {
	$syntax = array( );
	return( $syntax );
}


/**
 * Shortcode help for [wpseo_sitemap]
 * 
 * Note: A particularly useless shortcode unless you have Yoast SEO premium
 */
function wpseo_sitemap__help( $shortcode="wpseo_sitemap" ) {
	return( "Display HTML sitemap - deprecated" );
}



function wpseo_sitemap__syntax( $shortcode="wpseo_sitemap" ) {
	$syntax = array();
	return( $syntax );
}
