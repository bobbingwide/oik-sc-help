<?php // (C) Copyright Bobbing Wide 2014

function wpmem_field__help( $shortcode="wpmem_field" ) {
  return( "Display a member's field value" );
}

function wp_members__help( $shortcode="wp-members" ) {
  return( "Display a WP-members page" );
}

/**
 * Syntax help for wp-members
 *
 */
function wp_members__syntax( $shortcode="wp-members" ) {
  $syntax = array( "page" => bw_skv( null, "register|user-profile|user-edit|password|login|tos|user-list", "Special WP-Members page to display" )
                 );
  return( $syntax );
}

