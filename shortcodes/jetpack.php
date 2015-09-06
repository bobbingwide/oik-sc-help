<?php // (C) Copyright Bobbing Wide 2013-2015

/**
 * Implement shortcode syntax for shortcodes delivered by Jetpack
 * 
 * List of shortcodes found from jetpack.wp-a2z.org
 * on 2015/02/02
 * 
 * 
 * AudioShortcode::__construct() – Add all the actions & resgister the shortcode
 * Grunion_Contact_Form_Plugin::add_shortcode() -
 * Jetpack_Portfolio::__construct() – Conditionally hook into WordPress.
 * Jetpack_Recipes::action_init() -
 * Jetpack_RelatedPosts::action_frontend_init() – Load related posts assets if it’s a elegiable frontend page or execute search and return JSON if it’s an endpoint request.
Jetpack_RelatedPosts::_setup_shortcode() – Sets up the shortcode processing.
Jetpack_Slideshow_Shortcode::__construct() -
Jetpack_VideoPress_Shortcode::__construct() –
modules/latex.php
modules/shortcodes/archives.php
modules/shortcodes/bandcamp.php
modules/shortcodes/blip.php
modules/shortcodes/dailymotion.php
modules/shortcodes/diggthis.php
modules/shortcodes/facebook.php
modules/shortcodes/flickr.php
modules/shortcodes/gist.php
modules/shortcodes/googlemaps.php
modules/shortcodes/googleplus.php
modules/shortcodes/googlevideo.php
modules/shortcodes/instagram.php
modules/shortcodes/medium.php
modules/shortcodes/mixcloud.php
modules/shortcodes/scribd.php
modules/shortcodes/slideshare.php
modules/shortcodes/soundcloud.php
modules/shortcodes/ted.php
modules/shortcodes/twitter-timeline.php
modules/shortcodes/vimeo.php
modules/shortcodes/vine.php
modules/shortcodes/youtube.php
modules/subscriptions.php
PolldaddyShortcode::__construct() – Add all the actions & resgister the shortcode
Presentations::__construct() – Constructor
wp-includes/media.php
WPCOM_JSON_API_Post_Endpoint::get_post_by() -
WPCOM_JSON_API_Post_v1_1_Endpoint::get_post_by() -
WP_Embed::run_shortcode() – Process the [embed] shortcode.
WP_Embed::__construct() – Constructor
 */
 
 
/**
 * Help hook for [audio] shortcode
 */ 
function audio__help() {
  return( "Displays uploaded audio file as an audio player" );
}

/**
 * Syntax hook for [audio] shortcode
 * 
 */
 if ( !function_exists( "audio__syntax" ) ) {
function audio__syntax() {
  $syntax = array( "src,0" => bw_skv( null, "<i>url</i>", "URL of the audio file" )
                 , "width" => bw_skv( 180, "numeric", "Width" )
                 , "titles" => bw_skv( 1, "numeric", "Titles position" )
                 , "artists" => bw_skv( 2, "numeric", "Artists position" ) 
                 );
  return( $syntax );
}
} 

function contact_form__help() {
  return( "Display Grunion Contact form" );
}

/**
 * Syntax hook for [contact-form]
 *
 * Note: id and widget atts are supposed to be hidden from the user
 * I've not tried actually passing them as parameters
 */
function contact_form__syntax( $shortcode="contact-form" ) {
  $syntax = array( "to" =>  bw_skv( get_option( "admin_email" ), "<i>email</i>", "Email address for submission" )
                 , "subject" => bw_skv( '[' . get_option( 'blogname' ) . '] post title', "<i>text</i>", "Email Subject: " ) 
                 , "show_subject" => bw_skv( "no", "yes", "Show Subject" )
                 // , "widget" =>
                 //, "id" => bw_skv( null, "numeric", "
                 , "submit_button_text" => bw_skv( "Submit &darr;", "<i>text</i>", "Submit button text" )
                 );
  return( $syntax );
} 

function contact_field__help() {
  return( "Display Grunion Contact field" );
}

 
/**
 *  Syntax hook for [contact-field]
 *
 * The contact-field shortcode is a child field shortcode of contact-form
 * If no fields are present then the defaults are:
 * - Name, 
 * - Email
 * - Website
 * - Subject - depending on show_subject
 * - Message
 */              
function contact_field__syntax( $shortcode="contact-field" ) {
  $syntax = array( "label" => bw_skv( null, "<i>label</i>", "Field label" )
                 , "type" => bw_skv( null, "name|email|url|subject|textarea|telephone|select", "Field type" )
                 , "required" => bw_skv( null, "true", "True for a Required field" )
                 , "options" => bw_skv( null, "<i>option1,option2</i>", "Comma separated options" )
                 );
  return( $syntax );
} 

function jetpack_portfolio__help( $shortcode="jetpack_portfolio" ) {
  return( "Embed portfolio projects" );
}


  
/**
 * Syntax hook for [jetpack_portfolio[ shortcode
 *
 * These notes extracted from wordpress.com
 * 
 * - display_types: display Project Types. (true/false)
 * - display_tags: display Project Tags. (true/false)
 * - display_content: display project content. (true/false)
 * - include_type: display specific Project Types. Defaults to all. (comma-separated list of Project Type slugs)
 * - include_tag: display specific Project Tags. Defaults to all. (comma-separated list of Project Tag slugs)
 * - columns: number of columns in shortcode. Defaults to 2. (number, 1-6)
 * - showposts: number of projects to display. Defaults to all. (number)
 * - order: display projects in ascending or descending order. Defaults to ASC for sorting in ascending order, but you can reverse the order by using DESC to display projects in descending order instead. (ASC/DESC)
 * - orderby: sort projects by different criteria, including author name, project title, and even rand to display in a random order. Defaults to sorting by date. (author, date, title, rand)
 *
 * and this from v3.4.1 of the Jetpack plugin sourc
 * 
 * `$atts = shortcode_atts( array(
      'display_types'   => true,
      'display_tags'    => true,
      'display_content' => true,
      'show_filter'     => false,
      'include_type'    => false,
      'include_tag'     => false,
      'columns'         => 2,
      'showposts'       => -1,
      'order'           => 'asc',
      'orderby'         => 'date',
    ), $atts, 'portfolio' );`
    
 
*/
function jetpack_portfolio__syntax( $shortcode="jetpack_portfolio" ) {
  $syntax = array( "display_types" => bw_skv( "true", "false", "Display Project Types" )
                 , "display_tags" => bw_skv( "true", "false", "Display Project Tags" )
                 , "display_content" => bw_skv( "true", "false", "Display Project Content" )
                 , "show_filter" => bw_skv( "false", "true", "Display a filter" )
                 , "include_type" => bw_skv( null, "type1,type2", "Comma separated list of Project Type slugs to include" ) 
                 , "include_tag" => bw_skv( null, "tag1,tag2", "Comma separated list of Project Tag slugs to include" ) 
                 , "columns" =>  bw_skv( 2, "numeric", "Number of columns, between 1 and 6" )
                 , "showposts" => bw_skv( -1, "<i>numeric</i>", "Number of posts to show -1=all" )
                 , "order" => bw_skv( "ASC", "DESC", "Display projects in ascending or descending order" )
                 , "orderby" => bw_skv( "date", "author|title|rand", "Sort projects by different criteria" ) 
                 );
  return( $syntax );                 
}

/**
 * Help hook for the [portfolio] shortcode
 * 
 * [portfolio] is the legacy version of [jetpack_portfolio] 
 */
function portfolio__help() {
  return jetpack_portfolio__help();
}

/**
 * Syntax hook for the [portfolio] shortcode
 * 
 * [portfolio] is the legacy version of [jetpack_portfolio] 
 */
function portfolio__syntax() { 
  return jetpack_portfolio__syntax();
} 

/**
 * Help hook for [recipe] shortcode
 */
function recipe__help() {
  return( "Embeds a recipe" );
}
  
/**
 * Syntax help for [recipe] [/recipe] shortcode
 *
 * @link https://en.support.wordpress.com/recipes/
 * - Title: title of your recipe
 * - Servings: number of servings the recipe makes
 * - Time: total time the recipe takes
 * - Difficulty: how hard the recipe is to create
 * - Print: a link to print the recipe is displayed by default if you have added one or more of the attributes for servings, time, or difficulty. 
 * Or you can hide the print button by adding print=”false”
 * 
 */
function recipe__syntax( $shortcode="recipe" ) {
  $syntax = array( "title" => bw_skv( null, "<i>text</i>", "Recipe title" ) 
                 , 'servings' => bw_skv( null, "<i>number</i>", "Number of servings" )
                 , 'time' =>  bw_skv( null, "<i>hh:mm</i>", "Total time the recipe takes" )
                 , 'difficulty' => bw_skv( null, "text", "How hard the recipe is to create" )
                 , 'print' => bw_skv( "true", "false", "Display a link to print the recipe" )
                 );
  return( $syntax );
} 

function recipe__example( $shortcode="recipe" ) { 
  return( "A nice cuppa" );
} 

 


