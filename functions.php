<?php

/**
 * Custom amendments for the theme.
 *
 * @category   CoreCommercial
 * @package    Functions
 * @subpackage Functions
 * @author     Lloyd Johnson
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://surefirewebservices.com/
 * @since      0.1.0
 */

// Initialize Sandbox ** DON'T REMOVE **
require_once( get_stylesheet_directory() . '/lib/init.php');
//Plugin that enables the Metafield for Tagline
require_once( get_stylesheet_directory() . '/lib/plugins/corecomtagline.php');

add_action( 'wp_enqueue_scripts', 'corecom_add_scripts' );
function corecom_add_scripts() {

	wp_register_script( 'scripts', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ) );
	wp_enqueue_script('scripts');
}
add_action( 'genesis_meta', 'corecom_typekit_default_embed' );
function corecom_typekit_default_embed() {
	echo '<script src="https://use.typekit.net/hrb7zbn.js"></script>';
	echo '<script>try{Typekit.load({ async: true });}catch(e){}</script>';
}

add_action( 'genesis_setup', 'gs_theme_setup', 15 );

//Theme Set Up Function
function gs_theme_setup() {
	
	//Enable HTML5 Support
	add_theme_support( 'html5' );

	//Enable Post Navigation
	add_action( 'genesis_after_entry_content', 'genesis_prev_next_post_nav', 5 );

	/** 
	 * 01 Set width of oEmbed
	 * genesis_content_width() will be applied; Filters the content width based on the user selected layout.
	 *
	 * @see genesis_content_width()
	 * @param integer $default Default width
	 * @param integer $small Small width
	 * @param integer $large Large width
	 */
	$content_width = apply_filters( 'content_width', 600, 430, 920 );
	
	//Custom Image Sizes
	add_image_size( 'featured-image', 225, 160, 480, TRUE );
	add_image_size( 'team-member-image', 137, 188, FALSE );

	// Enable Custom Header
	add_theme_support( 'genesis-custom-header', array(
		'width' => 318,
		'height' => 123
	));
	// Add support for structural wraps
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		'inner'
	) );
	/**
	 * 08 Genesis Menus
	 * Genesis Sandbox comes with 4 navigation systems built-in ready.
	 * Delete any menu systems that you do not wish to use.
	 */
	add_theme_support(
		'genesis-menus', 
		array(
			'primary'   => __( 'Primary Navigation Menu', 'corecom' ), 
			'secondary' => __( 'Secondary Navigation Menu, in footer', 'corecom' ),
			'mobile'    => __( 'Mobile Navigation Menu', 'corecom' ),
		)
	);

	//Removes Secondary Menu from Defualt location, we are using it for Footer now
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	// Add Mobile Navigation
	add_action( 'genesis_before', 'gs_mobile_navigation', 5 );
	//Enqueue Sandbox Scripts
	add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );	
	// Register Sidebars
	gs_register_sidebars();

} // End of Set Up Function

// Register Sidebars
function gs_register_sidebars() {
	$sidebars = array(
		array(
			'id'			=> 'home-top-1',
			'name'			=> __( 'Home Top 1', 'corecom' ),
			'description'	=> __( 'This is the 1st homepage widget section. 3 text widgets displaying linked icon and text', 'corecom' ),
		),
		array(
			'id'			=> 'home-top-2',
			'name'			=> __( 'Home Top 2', 'corecom' ),
			'description'	=> __( 'This is the 2nd homepage widget section. 3 text widgets displaying linked icon and text', 'corecom' ),
		),
		array(
			'id'			=> 'home-top-3',
			'name'			=> __( 'Home Top 3', 'corecom' ),
			'description'	=> __( 'This is the 3rd homepage widget section. 3 text widgets displaying linked icon and text', 'corecom' ),
		),				
		array(
			'id'			=> 'home-middle-01',
			'name'			=> __( 'Home Middle', 'corecom' ),
			'description'	=> __( 'This is the middle area. We will be putting the featured Posts, about content, ', 'corecom' ),
		),
		array(
			'id'			=> 'testimonials',
			'name'			=> __( 'Testimonia l Slider', 'corecom' ),
			'description'	=> __( 'This is the footer testimonials slidder section.', 'corecom' ),
		),
		array(
			'id'			=> 'contact',
			'name'			=> __( 'Contact Us', 'corecom' ),
			'description'	=> __( 'This is the footer section we are going to have a contact page in.', 'corecom' ),
		),
		array(
			'id'			=> 'footer-bottom-01',
			'name'			=> __( 'Footer Left', 'corecom' ),
			'description'	=> __( 'Last Footer on left, monochrome logo', 'corecom' ),
		),
		array(
			'id'			=> 'footer-bottom-02',
			'name'			=> __( 'Footer Right', 'corecom' ),
			'description'	=> __( 'Last Footer on the right, 2nd Menu, then address, ', 'corecom' ),
		),
		array(
			'id'			=> 'our-clients',
			'name'			=> __( 'Our Clients', 'corecom' ),
			'description'	=> __( 'Last Footer on the right, 2nd Menu, then address, ', 'corecom' ),
		),		
		array(
			'id'			=> 'about-featured',
			'name'			=> __( 'About Page Featured Content', 'corecom' ),
			'description'	=> __( 'Area Under the Title on About Page, ', 'corecom' ),
		),
		array(
			'id'			=> 'team-members',
			'name'			=> __( 'Team Members About Page', 'corecom' ),
			'description'	=> __( 'Area Under the About Page , ', 'corecom' ),
		),		
	);
	
	foreach ( $sidebars as $sidebar )
		genesis_register_sidebar( $sidebar );
}

/** 
 * Enqueue and Register Scripts - Twitter Bootstrap, Font-Awesome, and Common.
 */
require_once('lib/scripts.php');

/**
 * Add navigation menu 
 * Required for each registered menu.
 * 
 * @uses gs_navigation() Sandbox Navigation Helper Function in gs-functions.php.
 */

//Add Mobile Menu
function gs_mobile_navigation() {
	
	$mobile_menu_args = array(
		'echo' => true,
	);
	
	gs_navigation( 'mobile', $mobile_menu_args );



}
function cores_blank_tagline_output() {
	
	// Retrieves the stored value from the database
    $meta_value = get_post_meta( get_the_ID(), 'tagline-text', true );//targets our meta based on key
 
    // Checks and displays the retrieved value
    if( empty( $meta_value ) ) {
        echo '<div id="the-tagline">&nbsp;</div>';
    }
 
}
function before_output() {
	echo '<div class="globe-bk clearfix"><aside  class="about-middle-01 clearfix"><div id="about-middle-01"><section id="widget-wrangler-sidebar-6" class="widget ww_widget-contact-us-header ww_widget-60"><div class="widget-wrap"><h4 class="widget-title widgettitle">About Core Commercial Brokerage</h4></div></section><div id="about-middle-001" class="about-middle-01 widget-area">';
}
function after_output() {
	echo '</div></div></aside>';
}
//Adds slider to all pages using slug
add_action( 'genesis_before_content', 'cores_header_sliders' );
function cores_header_sliders() {
	if ( function_exists( 'soliloquy' ) ) { 
			soliloquy( 'home', 'slug' );
		}
}
function widget_about_featured() {
genesis_widget_area( 
                'about-featured',//Featured Content on About
                array(
                        'before' => '<aside class="about-featured clearfix"><div id="about-featured"><div class="about-featured widget-area">', 
                        'after' => '</div></div></aside>',
                ) 
        );
}

// Add Widget Area
add_action('genesis_after_content', 'widget_top',1);
function widget_top() {

  		genesis_widget_area( 
                'home-top-1',//Icon Space 1 
                array(
                        'before' => '<aside class="home-top"><div id="home-top"><div class="one-third first home-widget widget-area">', 
                        'after' => '</div>',
                ) 
        );
  		genesis_widget_area( 
                'home-top-2',//Icon Space 2
                array(	
                        'before' => '<div class="one-third home-widget widget-area">', 
                        'after' => '</div>',
                ) 
        );
  		genesis_widget_area( 
                'home-top-3',//Icon Space 3 
                array(
                        'before' => '<div class="one-third home-widget widget-area">', 
                        'after' => '</div><div class="clearfix"></div></div></aside>',
                ) 
        );
  		genesis_widget_area( 
                'home-middle-01',////////////featured posts
                array(
                        'before' => '<aside  class="home-middle-01 clearfix"><div id="home-middle-01"><div id="home-middle-001" class="home-middle-01 widget-area">', 
                        'after' => '</div></div></aside>',
                ) 
        );
}
// Add Widget Area After Post, and homem page
add_action('genesis_after_content', 'widget_bottom',8);
function widget_bottom() {
  		genesis_widget_area( 
          	 'team-members',////////////Team-members
            	    array(
                        'before' => '<aside  class="team-members clearfix"><div id="team-members"><div class="team-members widget-area clearfix">', 
                        'after' => '</div></div></aside></div>',
                ) 
        );
  		genesis_widget_area( 
                'our-clients',////////////our-clients
                array(
                        'before' => '<aside  class="our-clients-slider clearfix"><div id="our-clients-slider"><div class="our-clients-slider widget-area">', 
                        'after' => '</div></div></aside>',
                ) 
        );     
  		genesis_widget_area( 
                'testimonials',////////////testimonials
                array(
                        'before' => '<aside  class="testimonial-slider clearfix"><div id="testimonial-slider"><div class="testimonial-slider widget-area">', 
                        'after' => '</div></div></aside>',
                ) 
        );
  		genesis_widget_area( 
                'contact',////////////mapt anc contact area 
                array(
                        'before' => '<aside  class="contact-slider clearfix"><div id="contact-slider"><div class="contact-slider widget-area">', 
                        'after' => '</div></div></aside>',
                ) 
        );                              
                              

 }

//Adds Tagline for title as long as its not empty
add_action( 'genesis_entry_content', 'cores_tagline_output',1);
function cores_tagline_output() {
	
	// Retrieves the stored value from the database
    $meta_value = get_post_meta( get_the_ID(), 'tagline-text', true );//targets our meta based on key
 
    // Checks and displays the retrieved value
    if( !empty( $meta_value ) ) {
        echo '<div id="the-tagline">'.$meta_value.'</div>';
    } 
}
//* Remove the site footer
 remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
 remove_action( 'genesis_footer', 'genesis_do_footer' );
 remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
//* Customize the site footer
add_action( 'genesis_footer', 'corecom_custom_footer' );
function corecom_custom_footer() { ?>
	<div class="site-footer">
			<div class="wrap">
				<div id="left-footer" class="one-half first"><img src="<?php echo get_stylesheet_directory_uri();?>/images/logo-white.png" id="footer-logo" class=""></div>
				<div id="right-footer" class="one-half">
					<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container_class' => 'genesis-nav-menu' ) );?>
					<p>8570 Criterion Drive, Ste 148 Colorado Springs, Co | 719.822.1880 <br />Copyright &copy; <?php date('Y'); ?> Core Commerical Brokerage <a href="#">Privacy Policy</a></p>
				</div>
				<div class="clearfix"></div>				
			</div>
	</div>

<?php
}

function wpb_footer_creds_text () {
	$copyright = '';
        return $copyright;
}
add_filter( 'genesis_footer_creds_text', 'wpb_footer_creds_text' );

