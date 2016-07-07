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
 * y | dailymotion | modules/shortcodes/dailymotion.php
 * y | dailymotion-channel | modules/shortcodes/dailymotion.php
 * y | digg | modules/shortcodes/diggthis.php
 * y | gist | modules/shortcodes/gist.php
 * y | googlemaps | modules/shortcodes/googlemaps.php
 * y | googleplus | modules/shortcodes/googleplus.php
 * y | googlevideo | modules/shortcodes/googlevideo.php
 * y | houzz | modules/shortcodes/houzz.php
 * y | instagram | modules/shortcodes/instagram.php
 * y | medium | modules/shortcodes/medium.php
 * y | mixcloud | modules/shortcodes/mixcloud.php
 * y | polldaddy | modules/shortcodes/polldaddy.php
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
* PolldaddyShortcode::__construct() – Add all the actions & resgister the shortcode
* Presentations::__construct() – Constructor
* wp-includes/media.php
* WPCOM_JSON_API_Post_Endpoint::get_post_by() -
* WPCOM_JSON_API_Post_v1_1_Endpoint::get_post_by() -
* WP_Embed::run_shortcode() – Process the [embed] shortcode.
* WP_Embed::__construct() – Constructor



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
 *
 * Note: The 'size' parameter, found in the code for v4.0.4, is not used; so it's not documented here.
 */
function flickr__syntax() {
	$syntax = array( "video" => bw_skv( null, "<i>URL</i>", "Video URL" )
								 , 'photo'=> bw_skv( null, "<i>URL</i>", "Photo URL" )
								 , 'show_info' => bw_skv( "no", "yes|true|false" , "Show info box?" )
								 , 'w' => bw_skv( 400, "<i>integer</i>", "Width" )
								 , 'h' => bw_skv( 300, "<i>integer</i>", "Height" )
								 , 'secret' => bw_skv( null, "<i>text</i>", "Photo secret" )
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
  [soundcloud url=”https://api.soundcloud.com/tracks/156661852&#8243; 
	params=”auto_play=false&hide_related=false&visual=true” width=”100%” height=”450? iframe=”true” /]
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

/**
 * Help for dailymotion shortcode
 */
function dailymotion__help() {
	return( "Embed DailyMotion video" );
}

/**
 * Syntax help for dailymotion shortcode
 */
function dailymotion__syntax() {
	$syntax = array ( "id,0" => bw_skv( null, "<i>id</id>", "ID part of the dailymotion URL" )
									,	"title" => bw_skv( null, "<i>title</i>", "Title. For use with video parameter." )
									, "user" => bw_skv( null, "<i>userid</i>", "User id" )
									, "video" => bw_skv( null, "<i>video</i>", "Video id" )
									);
	return( $syntax );
}

								
/**
 * Help for dailymotion-channel shortcode
 */
function dailymotion_channel__help() {
	return( "Embed DailyMotion channel" );
}

/**
 * Syntax help for dailymotion-channel shortcode
 */
function dailymotion__channel__syntax() {
	$syntax = array ( "user" => bw_skv( null, "<i>username</i>", "User name" )
								  , "type" => bw_skv( "badge", "grid|carousel", "Display type" )
									);
	return( $syntax );
}	

/**
 * Help for digg shortcode
 */
function digg__help() {
	return( "digg shortcode is no longer supported" );
}	

/**
 * Help for gist shortcode
 */
function gist__help() {
	return( "Embed a Gist from GitHub" );
}

/**
 * Syntax help for gist shortcode
 *
 * Note: The Gist ID can be passed in content. e.g. [gist]Gist ID[/gist]
 */
function gist__syntax() {
	$syntax = array( "0" => bw_skv( null, "<i>id</i>|https://gist.github.com/<i>id</i>", "Gist ID or Gist URL" )
								 );
	return( $syntax );								
}

/**
 * Help for googlemaps shortcode
 */
function googlemaps__help() {
	return( "Display Google Map" );
}

/** 
 * Syntax help for googlemaps shortcode
 *
 * Example usage:
 * `
 *   [googlemaps http://maps.google.com/maps?f=q&hl=en&geocode=&q=San+Francisco,+CA&sll=43.469466,-83.998504&sspn=0.01115,0.025942&g=San+Francisco,+CA&ie=UTF8&z=12&iwloc=addr&ll=37.808156,-122.402458&output=embed&s=AARTsJp56EajYksz3JXgNCwT3LJnGsqqAQ&w=425&h=350]
 *   [googlemaps https://mapsengine.google.com/map/embed?mid=zbBhkou4wwtE.kUmp8K6QJ7SA&w=640&h=480]
 * `
 */
function googlemaps__syntax() {
	$syntax = array( "0" => bw_skv( null, "<i>URL</i>", "Google maps URL" )
								 );
	return( $syntax );
}

/**
 * Help for googleplus shortcode
 */
function googleplus__help() {
	return( "Embed Google+" );
}

/**
 * Syntax help for googleplus shortcode
 *
 * Example URL: https://plus.google.com/114986219448604314131/posts/LgHkesWCmJo
 * Alternate example: https://plus.google.com/u/0/100004581596612508203/posts/2UKwN67MBQs  (note the /u/0/)
 */
function googleplus__syntax() {
	$syntax = array( "url" => bw_skv( null, "https://plus/google.com/<i>id</i>/posts/<i>code</i>|https://plus/google.com/u/0/<i>id</i>/posts/<i>code</i>", "Google+ URL" )
								 );
	return( $syntax );
}

function googlevideo__help() {
	return( "Embed Google video- replaced by youtube" );
}

/** 
 * Help for houzz shortcode
 */ 									
function houzz__help() {
	return( "Embed content from Houzz" );
}

/**
 * Syntax help for houzz shortcode
 *
 * Post content:
 * 	- [houzz=http://www.houzz.com/pro/james-crisp]
 * 	- http://www.houzz.com/pro/james-crisp
 * Blog sidebar: [houzz=http://www.houzz.com/profile/alon w=200 h=300]
 */	 
function houzz__syntax() {
	$syntax = array( "0" => bw_skv( null, "=http://www.houzz.com/pro/<i>name</i>", "houzz URL" ) 
								 , 'w' => bw_skv( null, "<i>integer</i>", "Width" )
								 , 'h' => bw_skv( null, "<i>integer</i>", "Height" )
								 );
	return( $syntax );
}

/**
 * Help for instagram shortcode
 */
function instagram__help() {
	return( "Embed photo or video from Instagram" );
}

/**
 * Syntax help for instagram shortcode
 *
 * Examples
 * `
 * [instagram url="http://instagram.com/p/PSbF9sEIGP/"]
 * [instagram url="http://instagram.com/p/PSbF9sEIGP/" width="320"]
 * `
 */
function instagram__syntax() {
	$syntax = array( "url" => bw_skv( null, "<i>URL</i>", "Instagram URL" )
								 , "width" => bw_skv( 698, "<i>integer</i>", "Content width. Minimum 320." )
								 , "hidecaption" => bw_skv( null, "<i>any</i>", "Hide caption" )
								 );
	return( $syntax );
}	

/**
 * Help for medium shortcode
 */
function medium__help() {
	return( "Embed a profile or collection from Medium.com" );
}

/**
 * Syntax help for medium shortcode
 * 
 * This example produces lots of JavaScript errors
 * [medium url="https://medium.com/help-center" width="100%" border="false" collapsed="true"]
 *
 * This, randomly picked profile works
 * [medium url=https://medium.com/@robtschwartz]
 */
function medium__syntax() {
	$syntax = array( "url" => bw_skv( null, "<i>URL</i>", "Medium URL. Always starts with https://medium.com" )
								 , "width" => bw_skv( 400, "<i>integer</i>", "Width" )
								 , "hidecaption" => bw_skv( null, "<i>any</i>", "Hide caption" )
								 , "border" => bw_skv( "true", "false", "Display border" )
								 , 'collapsed' => bw_skv( "false", "true", "Collapsed?" )
								 );
	return( $syntax );
}								 

/**
 * Help for mixcloud shortcode
 */
function mixcloud__help() {
	return( "Embed content from Mixcloud" );
}

/**
 * Syntax help for mixcloud shortcode
 * http://www.mixcloud.com/MalibuRum/play-6-kissy-sellouts-winter-sun-house-party-mix/
 */
function mixcloud__syntax() {
	$syntax = array( "0" => bw_skv( null, "<i>URL</i>", "Mixcloud resource" )
								 , "width" => bw_skv( 300, "<i>integer</i>", "Width" )
								 , "height" => bw_skv( 300, "<i>integer</i>", "Height" )
								 );
	return( $syntax );
}	 
 						 
/**
 * Help for polldaddy shortcode
 */
function polldaddy__help() {
	return( "Embed Polldaddy poll, survey or rating" );
}

/**
 * Syntax help for polldaddy shortcode
 *
 * [polldaddy poll|survey|rating="123456"]
 * 
 * @TODO Revisit the parameters to check what they really are!
 */
function polldaddy__syntax() {
	global $content_width;
	bw_trace2( $content_width, "content_width", false );
	
	$syntax = array( 'survey' => bw_skv(  null,	"<i>id</i>", "Survey ID" )
								 , 'link_text' => bw_skv( 'Take Our Survey', "<i>text</i>", "Link text" )
								 , 'poll' => bw_skv( 'empty', "<i>id</i>", "Poll ID" )
								 , 'rating' => bw_skv( 'empty', "<i>id</i>", "Rating ID" )
								 , 'unique_id' => bw_skv(  null, "<i>integer</i>", "Unique ID" )
								 , 'item_id' => bw_skv( null, "<i>integer</i>", "Unique ID" )
								 , 'title' => bw_skv( null, "<i>text</i>", "Title" )
								 , 'permalink' => bw_skv(  null, "<i>URL</i>", "Permalink" )
								 , 'cb' => bw_skv(  0, "<i>callback</i>", "Callback" )
								 , 'type' => bw_skv( 'button', 'slider', "Type" )
								 , 'body' => bw_skv( '', "<i>text</i>", "Body" )
								 , 'button' => bw_skv(  '', "<i>button</i>", "Button" )
								 , 'text_color' => bw_skv( '000000', "<i>hex</i>", "Text color" )
								 , 'back_color' => bw_skv(  'FFFFFF', "<i>hex</i>", "Background color" )
								 , 'align' => bw_skv( '', "left|right", "Alignment " )
								 , 'style' => bw_skv( '', "<i>text</i>", "Style" )
								 , 'width' => bw_skv( $content_width, "<i>integer</i>", "Width" )
								 , 'height' => bw_skv( floor( $content_width * 3 / 4 ), "<i>integer</i>", "Height" )
								 , 'delay' => bw_skv( 100, "<i>microseconds</i>", "Delay in microseconds" )
								 , 'visit' => bw_skv( 'single', 'multiple', "Number of visits" )
								 , 'domain' => bw_skv(  '', "<i>domain</i>", "Domain name" )
								 , 'id' => bw_skv( '', "<i>ID</i>", "ID )
                 );
	return( $syntax );
}
