<?
 /* Genesis Framework.
 * 
 * Template Name: About
 *
 * @package CoreCommerical
 * @author  Lloyd
 * @license GPL-2.0+
 * @link    
 
add_action( 'genesis_entry_content', 'cores_blank_tagline_output',1);//if no tagline is there it draws a blank line anyway
remove_action( 'genesis_entry_content', 'genesis_do_post_content');//removes content
//remove_action('genesis_do_post_content','widget_top');//removes top widgets
add_action('genesis_after_content','widget_about_featured',3);//putting this in place of top widgets to apear as if its part of content
add_action('genesis_after_content','before_output',4);//tags and stuff
add_action('genesis_after_content','genesis_do_post_content',5);//Re palces the content removed earlier
add_action('genesis_after_content','after_output',6);//tags and stuff
//output new widget area here just for about page
//normal loop takes place now with the our-clients widget area and then the bottom widgets
*/
//leaves all other areas site default



genesis();
