<?php // (C) Copyright Bobbing Wide 2013-2016

/**
 * Implement shortcode syntax for shortcodes delivered by Jetpack
 * 
 * List of shortcodes found from jetpack.wp-a2z.org on 2015/02/02
 * updated for Jetpack v4.0.4 on  2016/07/04-05
 * 
 * Done? | Shortcode | Method / File
 * ---- | --------- | ---------------
 * y | archives | modules/shortcodes/archives.php
 * y | audio | AudioShortcode::__construct() 
 * y | contact-field | modules/contact-form/grunion-contact-form.php
 * y | contact-form | modules/contact-form/grunion-contact-form.php
 * y | facebook | modules/shortcodes/facebook.php
 * y | flickr | modules/shortcodes/flickr.php
 * y | jetpack_portfolio | modules/custom-post-types/portfolios.php
 * y | portfolio | modules/custom-post-types/portfolios.php 
 * y | recipe | modules/shortcodes/recipe.php
 * y | soundcloud | modules/shortcodes/soundcloud.php
 * y | jetpack-related-posts | modules/related-posts/jetpack-related-posts.php
 * y | slideshow | modules/shortcodes/slideshow.php
 * y | videopress | modules/videopress/shortcode.php  
 * y | wpvideo | modules/videopress/shortcode.php
 * y | latex | modules/latex.php
 * y | bandcamp | modules/shortcodes/bandcamp.php
 * y | blip.tv | modules/shortcodes/blip.php
 * * | dailymotion | modules/shortcodes/dailymotion.php
 * * | dailymotion-channel | modules/shortcodes/dailymotion.php
 * * | digg | modules/shortcodes/diggthis.php
 * * | gist | modules/shortcodes/gist.php
 * * | googlemaps | modules/shortcodes/googlemaps.php
 * * | googleplus | modules/shortcodes/googleplus.php
 * * | googlevideo | modules/shortcodes/googlevideo.php
 * * | houzz | modules/shortcodes/houzz.php
 * * | instagram | modules/shortcodes/instagram.php
 * * | medium | modules/shortcodes/medium.php
 * * | mixcloud | modules/shortcodes/mixcloud.php
 * * | polldaddy | modules/shortcodes/polldaddy.php
 * * | presentation | modules/shortcodes/presentations.php
 * * | slide | modules/shortcodes/presentations.php
 * * | scribd | modules/shortcodes/scribd.php
 * * | slideshare | modules/shortcodes/slideshare.php
 * * | ted | modules/shortcodes/ted.php
 * * | twitch | modules/shortcodes/twitchtv.php
 * * | twitchtv | modules/shortcodes/twitchtv.php
 * * | twitter-timeline | modules/shortcodes/twitter-timeline.php
 * * | vimeo | modules/shortcodes/vimeo.php
 * * | vine | modules/shortcodes/vine.php
 * * | wufoo | modules/shortcodes/wufoo.php
 * * | youtube | modules/shortcodes/youtube.php
 * * | jetpack_subscription_form | modules/subscriptions.php     
 * * | jetpack_top_posts_widget | modules\widgets\top-posts.php
 * * | testimonials | modules/custom-post-types/testimonial.php 			  
 * * | jetpack_testimonials | modules/custom-post-types/testimonial.php

* When all the above is y then 
* 1. Sort
* 2. Remove the comments below 

* Probably deprecated / deleted by now ( in v4.0.4 )
* 
* PolldaddyShortcode::__construct() � Add all the actions & resgister the shortcode
* Presentations::__construct() � Constructor
* wp-includes/media.php
* WPCOM_JSON_API_Post_Endpoint::get_post_by() -
* WPCOM_JSON_API_Post_v1_1_Endpoint::get_post_by() -
* WP_Embed::run_shortcode() � Process the [embed] shortcode.
* WP_Embed::__construct() � Constructor



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
 * Also implemented by WordPress itself
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
 * Syntax hook for [jetpack_portfolio] shortcode
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
 * and this from v3.4.1 of the Jetpack plugin source
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
 * Or you can hide the print button by adding print=�false�
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

function archives__help() {
	return( "Archive index" );
}

/**
 * Syntax hook for [archives] shortcode
 * 
 * {@link https://en.support.wordpress.com/archives-shortcode/}
 */
function archives__syntax() {
	$syntax = array( "type" => bw_skv( "postbypost", "yearly|monthly|weekly|daily", "The type of archives list to display" ) 
					, "format" => bw_skv( "html", "option|custom", "How to display the archives list" )
					,	"limit" => bw_skv( null, "integer", "The number of archive entries to display" )
					, "showcount" => bw_skv( "false", "true", "Display post count of each archive entry" )
					, "before" => bw_skv( null, "<i>text</i>", "Text to go before each archive entry" )
					, "after" => bw_skv( null, "<i>text</i>", "Text to go after each archive entry" )
					, "order" => bw_skv( "desc", "asc", "Sort order" )
					); 
	return( $syntax );										
}

/**
 *
 */ 
function facebook__help( $shortcode="facebook" ) {
	return( "Embed a Facebook update" );
}

/**
 */
function facebook__syntax( $shortcode="facebook" ) {
	$syntax = array( "url" => bw_skv( null, "<i>Facebook URL</i>", "Facebook URL or ID to embed" ) 
								 );
								 
	return( $syntax );
}

/**
 * Help for flickr shortcode
 */
function flickr__help() {
	return( "Embed a Flickr video or photo" );
}
	
/**
 * Syntax help for flickr shortcode
 */
function flickr__syntax() {
	$syntax = array( "video" => bw_skv( null, "<i>video</i>", "Video" )
	//         	
	//	'video'     => 0,
	//	'photo'     => 0,
//		'show_info' => 0,
//		'w'         => 400,
//		'h'         => 300,
//		'secret'    => 0,
//		'size'      => 0,
	 );
	return( $syntax );
}

/**
 * Help for soundcloud shortcode
 */
function soundcloud__help() {
	return( "Embed audio from SoundCloud" );
}

/**
 * Syntax help for soundcloud shortcode
  
	{@link  https://en.support.wordpress.com/soundcloud-audio-player/}
	
	`
  [soundcloud url=�https://api.soundcloud.com/tracks/156661852&#8243; 
	params=�auto_play=false&hide_related=false&visual=true� width=�100%� height=�450? iframe=�true� /]
	`
 */
function soundcloud__syntax() {
	$syntax = array( "url" => bw_skv( null, "<i>URL</i>", "Soundcloud URL" )
								 );
	return( $syntax );
}

/**
 * Help for jetpack-related-posts shortcode
 */
function jetpack_related_posts__help() {
	return( "Display Related posts" );
}

/**
 * Syntax help for jetpack-related-posts
 */
function jetpack_related_posts__syntax() {
	return( null );
} 

/**
 * Help for slideshow shortcode
 * 
 * [slideshow] is an old alias of [gallery type=slideshow]
 */
function slideshow__help() {
	return( "Display slideshow" );
}

/**
 * Syntax help for slideshow shortcode
 */
function slideshow__syntax() {
	$syntax = array( "trans" => bw_skv( "fade", "<i>transition</i>", "Slideshow transition type" )
								 , "order" => bw_skv( "ASC", "DESC", "Sort order ascending or descending" )
								 , "orderby" => bw_skv( "menu_order ID", "rand", "Sort by" )
								 , "id" => bw_skv( null, "<i>ID</i>", "ID - defaults to current post" )
								 , "include" => bw_skv( '', "<i>IDs</i>", "IDs to include, comma separated" )
								 , "exclude" => bw_skv( '', "<i>IDs</i>", "IDs to exclude, comma separated" )
								 , "autostart" => bw_skv( "true", "false", "Autostart the slideshow" )
								 , "size" => bw_skv( "full", "thumbnail|medium|<i>size</i>", "Image size" )
								 );
	return( $syntax );
}

/**
 * Help for videopress shortcode
 */
function videopress__help() {
	return( "Embed VideoPress video" );
}

/**
 * Syntax help for videopress shortcode
 */
function videopress__syntax() {
	$syntax = array( 'w' => bw_skv( 0, "<i>integer</i>", "Width of the video player, in pixels" )
								 , 'at' => bw_skv( 0, "<i>seconds</i>", "Start time. How many seconds in to initially seek to" )
								 , 'hd' => bw_skv( "false", "true", "Whether to display a high definition version" )
								 , 'loop' => bw_skv( "false", "true", "Whether to loop the video repeatedly" )
								 , 'freedom' => bw_skv( "false", "true", "Whether to use only free/libre codecs" )
								 , 'autoplay' => bw_skv( "false", "true", "Whether to autoplay the video on load" )
								 , 'permalink' => bw_skv( "true", "false", "Whether to display the permalink to the video" )
								 , 'flashonly' => bw_skv( "false", "true", "Whether to support the Flash player exclusively" )
								 , 'defaultlangcode' => bw_skv( "false", "<i>lang</i>", "Default language code" )
								 );
	return( $syntax );
}

function wpvideo__help() {
	return( videopress__help() );
}

function wpvideo__syntax() {
	return( videopress__syntax() );
}
 
/**
 * Help for latex shortcode
 */ 
function latex__help() {
	return( "Beautiful math using LaTeX" );
}

/**
 * Syntax help for latex shortcode
 */
function latex__syntax() {
	if ( function_exists( "latex_get_default_color" ) ) {
		$bg = latex_get_default_color( 'bg' ); 
		$fg = latex_get_default_color( 'text', '000' );
	} else {
		$bg = 'fff';
		$fg = '000';
	}
	$syntax = array( 's' => bw_skv( 0, "<i>integer</i>", "Font size in pixels" )
								 , 'bg' => bw_skv( $bg, "<i>hex</i>", "Hex code for background color" )
								 , 'fg' => bw_skv( $fg, "<i>hex</i>", "Hex code for text color" )
								 );
	return( $syntax );
} 

/**
 * Help for bandcamp shortcode
 */
function bandcamp__help() {
	return( "Embed from Bandcamp" );
}

/**
 * Syntax help for bandcamp shortcode
 */
function bandcamp__syntax() {
	$syntax = array( 'album' => bw_skv( null, "<i>integer</i>", "Album id" )
								 , 'track' => bw_skv( null, "<i>integer</i>", "Track id" )
								 , 'video' => bw_skv( null, "<i>integer</i>", "Track id for video player" )
								 , 'size' => bw_skv( 'venti', "venti|grande|grande2|grande3|tall_album|tall_track|tall2|short|large|medium|small", "Size" )
								 , 'bgcol' => bw_skv( 'FFFFFF', "<i>hex</i>", "Background color" )
								 , 'linkcol' => bw_skv( null, "<i>hex</i>", "Link color" )
								 , 'layout'      => bw_skv( null, "<i></i>", "encoded layout url" )
								 , 'width'       => bw_skv( null, "<i>width</i>", "Width, with optional '%'" )
								 , 'height'      => bw_skv( null, "<i>height</i>", "Height with optional '%'" )
								 , 'notracklist' => bw_skv( "false",  "true", "Don't display track list" )
								 , 'tracklist'   => bw_skv( "true", "false", "Display track list" )
								 , 'artwork'     => bw_skv( "large", "false|none|small", "Artwork" )
								 , 'minimal'     => bw_skv( "false", "true", "Minimal display" )
								 , 'theme'       => bw_skv( null, "light|dark", "Theme identifier string" )
								 , 'package'     => bw_skv( null, "<i>integer</i>", "Package id" )
								 , 't'           => bw_skv( null, "<i>integer</i>", "Track number" )
								 , 'tracks'      => bw_skv( null, "<i>tracks</i>", "comma separated list of allowed tracks" )
							 	 , 'esig'        => bw_skv( null, "<i>hex</i>", "MD5 digest for exclusive embedding" )
								);
	return( $syntax );
}


/**
 * Help for blip.tv shortcode
 */
function blip_tv__help() {
	return( "Embed blip.tv" );
}

/**
 * Syntax help for blip.tv shortcode
 * 
 * [blip.tv ?posts_id=4060324&dest=-1]
 * [blip.tv http://blip.tv/play/hpZTgffqCAI%2Em4v] // WLS
 * 
 */
function blip_tv__syntax() {
	$syntax = array( 0 => bw_skv( null, "?posts_id=<i>id</i>&dest=<i>-n</i>|http://blip.tv/play/<i>id</i>", "JavaScript or Embed parameter" )
								 );
	return( $syntax );								
} 

