<?
/* Plugin Name: Custom Meta Shortcodes
Plugin URI: N/A
Description:Returns what ever custom field you ask for, works for all post types with any custom field
Version: 1.0
Author: Lloyd Johnson
Author URI: github.com/ljohnso16
*/ 
/**

 
 * Usage [custommeta id="tagline-text" label="Tagline: "], or Square Footage etc"
 */
function custom_meta_shorcodes( $atts ) {
	$atts = extract( shortcode_atts( array(
		'id' => $id,
		'label'=>$label
	), $atts ) );
	if ( ! $id ){
		 return;//if ID is blank stop
	}
	if($id == 'debug'){ //debug to see all the available fields
		return '<pre>'.print_r(get_post_custom($post_id)).'</pre>';
	}
	$data = get_post_meta( get_the_ID(), $id, true );
	if ( $data ) {
		return '<span class="corecom-custom-field id-'. $id .'">'.$label.' '. $data .'</span>';
	}
	else{
		return;
	}
}
add_shortcode( 'custommeta', 'custom_meta_shorcodes' );