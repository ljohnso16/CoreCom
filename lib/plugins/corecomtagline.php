<?php
/* Plugin Name: CoreCom Tagline
Plugin URI: N/A
Description: Displays and uses taglines for Pages, this was created becasue the default meta fields were beings used by other plugins.
Version: 1.0
Author: Lloyd Johnson
Author URI: github.com/ljohnso16
*/ 

/**
 * Adds a meta box to the post editing screen
 */
function corecom_custom_meta() {
    add_meta_box( 'corecom_meta', __( 'CoreCom Tagline', 'corecom' ), 'corecom_meta_callback', 'page', 'advanced', 'high' );
}
add_action( 'add_meta_boxes', 'corecom_custom_meta' );
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});
/**
 * Outputs the content of the meta box
 */
function corecom_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'corecom_nonce' );
    $corecom_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="meta-text" class="corecom-row-title"><?php _e( 'Tagline: ', 'corecom' )?></label>
        <input type="text" name="meta-text" id="meta-text" value="<?php if ( isset ( $corecom_stored_meta['meta-text'] ) ) echo $corecom_stored_meta['meta-text'][0]; ?>" />
    </p>
 
    <?php
}
/**
 * Saves the custom meta input
 */
function corecom_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'corecom_nonce' ] ) && wp_verify_nonce( $_POST[ 'corecom_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }
 
}
add_action( 'save_post', 'corecom_meta_save' );

//add_action('widgets_init', create_function('','return register_widget("corecomtagline");'));
?>