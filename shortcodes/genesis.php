<?php // (C) Copyright Bobbing Wide 2015,2016

/**
 * Shortcode help for Genesis shortcodes
 *
 * This link doesn't cover all the shortcodes
 *
 * {link https://my.studiopress.com/docs/shortcode-reference/}
 
 `
 footer.php:add_shortcode( 'footer_backtotop', 'genesis_footer_backtotop_shortcode' );
 footer.php:add_shortcode( 'footer_copyright', 'genesis_footer_copyright_shortcode' );
 footer.php:add_shortcode( 'footer_childtheme_link', 'genesis_footer_childtheme_link_shortcode' );
 footer.php:add_shortcode( 'footer_genesis_link', 'genesis_footer_genesis_link_shortcode' );
 footer.php:add_shortcode( 'footer_studiopress_link', 'genesis_footer_studiopress_link_shortcode' );
 footer.php:add_shortcode( 'footer_wordpress_link', 'genesis_footer_wordpress_link_shortcode' );
 footer.php:add_shortcode( 'footer_loginout', 'genesis_footer_loginout_shortcode' );
 
 post.php:add_shortcode( 'post_date', 'genesis_post_date_shortcode' );
 post.php:add_shortcode( 'post_time', 'genesis_post_time_shortcode' );
 post.php:add_shortcode( 'post_modified_date', 'genesis_post_modified_date_shortcode' );
 post.php:add_shortcode( 'post_modified_time', 'genesis_post_modified_time_shortcode' );
 post.php:add_shortcode( 'post_author', 'genesis_post_author_shortcode' );
 post.php:add_shortcode( 'post_author_link', 'genesis_post_author_link_shortcode' );
 post.php:add_shortcode( 'post_author_posts_link', 'genesis_post_author_posts_link_shortcode' );
 post.php:add_shortcode( 'post_comments', 'genesis_post_comments_shortcode' );
 post.php:add_shortcode( 'post_tags', 'genesis_post_tags_shortcode' );
 post.php:add_shortcode( 'post_categories', 'genesis_post_categories_shortcode' );
 post.php:add_shortcode( 'post_terms', 'genesis_post_terms_shortcode' );
 post.php:add_shortcode( 'post_edit', 'genesis_post_edit_shortcode' );
 
 `
 
 */
 
/**
 * Help hook for [footer_backtotop] shortcode
 */ 
function footer_backtotop__help() {
  return( "Produces the 'Return to Top' link" );
}

/**
 * Syntax hook for [footer_backtotop] shortcode
 * 
 */
function footer_backtotop__syntax() {
  $syntax = array( "text" => bw_skv( "Return to top of page", "<i>text</i>", "Link text" )
								 , "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 , "href" => bw_skv( "#wrap",  "<i>url</i>", "Link URL" )
								 , "nofollow" => bw_skv( "true", "false", "Use rel=nofollow" )
								 );
  return( $syntax );
}

/**
 * Help hook for [footer_copyright] shortcode
 */ 
function footer_copyright__help() {
  return( "Display copyright notice" );
}

/**
 * Syntax hook for [footer_copyright] shortcode
 * 
 */
function footer_copyright__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output notice" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output notice" )
								 , "copyright" => bw_skv( "&#x000A9;", "<i>text</li>", "Copyright symbol" )
								 , "first" => bw_skv( null, "<i>year</i>", "First year for Copyright dates" )
								 );
  return( $syntax );
}

/**
 * Help hook for [footer_childtheme_link] shortcode
 */ 
function footer_childtheme_link__help() {
  return( "Display link to child theme, if defined" );
}

/**
 * Syntax hook for [footer_childtheme_link] shortcode
 * 
 */
function footer_childtheme_link__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( '&#xB7', "<i>text</i>", "Before output link" )
								 );
  return( $syntax );
}

/**
 * Help hook for [footer_genesis_link] shortcode
 */ 
function footer_genesis_link__help() {
  return( "Display link to the Genesis Framework." );
}

/**
 * Syntax hook for [footer_genesis_link] shortcode
 * 
 */
function footer_genesis_link__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 );
  return( $syntax );
}

/**
 * Help hook for [footer_studiopress_link] shortcode
 */ 
function footer_studiopress_link__help() {
  return( "Display link to StudioPress." );
}

/**
 * Syntax hook for [footer_studiopress_link] shortcode
 * 
 */
function footer_studiopress_link__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( "by", "<i>text</i>", "Before output link" )
								 );
  return( $syntax );
}

/**
 * Help hook for [footer_wordpress_link] shortcode
 */ 
function footer_wordpress_link__help() {
  return( "Display link to WordPress." );
}

/**
 * Syntax hook for [footer_wordpress_link] shortcode
 * 
 */
function footer_wordpress_link__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 );
  return( $syntax );
}

/**
 * Help hook for [footer_loginout] shortcode
 */ 
function footer_loginout__help() {
  return( "Display link to WordPress." );
}

/**
 * Syntax hook for [footer_loginout] shortcode
 * 
 */
function footer_loginout__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 , "redirect" => bw_skv( null, "<i>URL</i>", "Path to redirect on login" )
								 );
  return( $syntax );
}

/**
 * Help hook for [post_date] shortcode
 */ 
function post_date__help() {
  return( "Display post publication date" );
}

/**
 * Syntax hook for [post_date] shortcode
 * 
 */
function post_date__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 , "format" => bw_skv( get_option( 'date_format' ), "<i>date format</i>|relative", "Date format" )
								 , "label" => bw_skv( null, "<i>text</i>", "Label" )
								 );
  return( $syntax );
}

/**
 * Help hook for [post_time] shortcode
 */ 
function post_time__help() {
  return( "Display post publication time" );
}

/**
 * Syntax hook for [post_time] shortcode
 * 
 */
function post_time__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 , "format" => bw_skv( get_option( 'time_format' ), "<i>time format</i>", "Time format" )
								 , "label" => bw_skv( null, "<i>text</i>", "Label" )
								 );
  return( $syntax );
}


/**
 * Help hook for [post_modified_date] shortcode
 */ 
function post_modified_date__help() {
  return( "Display post last modified date" );
}

/**
 * Syntax hook for [post_modified_date] shortcode
 * 
 */
function post_modified_date__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 , "format" => bw_skv( get_option( 'date_format' ), "<i>date format</i>|relative", "Date format" )
								 , "label" => bw_skv( null, "<i>text</i>", "Label" )
								 );
  return( $syntax );
}

/**
 * Help hook for [post_modified_time] shortcode
 */ 
function post_modified_time__help() {
  return( "Display post last modified time" );
}

/**
 * Syntax hook for [post_modified_time] shortcode
 * 
 */
function post_modified_time__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 , "format" => bw_skv( get_option( 'time_format' ), "<i>time format</i>", "Time format" )
								 , "label" => bw_skv( null, "<i>text</i>", "Label" )
								 );
  return( $syntax );
}

/**
 * Help hook for [post_author] shortcode
 */ 
function post_author__help() {
  return( "Display post author name" );
}

/**
 * Syntax hook for [post_author] shortcode
 * 
 */
function post_author__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 );
  return( $syntax );
}

/**
 * Help hook for [post_author_link] shortcode
 */ 
function post_author_link__help() {
  return( "Display post author link" );
}

/**
 * Syntax hook for [post_author_link] shortcode
 * 
 */
function post_author_link__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 );
  return( $syntax );
}

/**
 * Help hook for [post_author_posts_link] shortcode
 */ 
function post_author_posts_link__help() {
  return( "Display link to author's posts" );
}

/**
 * Syntax hook for [post_author_posts_link] shortcode
 * 
 */
function post_author_posts_link__syntax() {
  $syntax = array( "after" => bw_skv( null, "<i>text</i>", "After output link" )
								 , "before" => bw_skv( null, "<i>text</i>", "Before output link" )
								 );
  return( $syntax );
}




 
 
 
 
