<?php
/**
 * Genesis Framework.
 * 
 * Template Name: No Content
 *
 * @package CoreCommerical
 * @author  Lloyd
 * @license GPL-2.0+
 * @link    
 */

remove_action( 'genesis_entry_header', 'genesis_do_post_title');//removes title
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );//removes post
//leaves all other areas site default



genesis();
