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
//require_once( get_stylesheet_directory() . '/lib/plugins/corecomemap.php');

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
	add_image_size( 'featured-image', 225, 160, TRUE );

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
		'inner',
		'footer-widgets',
		'footer'
	) );

	/**
	 * 07 Footer Widgets
	 * Add support for 3-column footer widgets
	 * Change 3 for support of up to 6 footer widgets (automatically styled for layout)
	 */
	add_theme_support( 'genesis-footer-widgets', 3 );

	/**
	 * 08 Genesis Menus
	 * Genesis Sandbox comes with 4 navigation systems built-in ready.
	 * Delete any menu systems that you do not wish to use.
	 */
	add_theme_support(
		'genesis-menus', 
		array(
			'primary'   => __( 'Primary Navigation Menu', 'corecom' ), 
			'secondary' => __( 'Secondary Navigation Menu', 'corecom' ),
			'footer'    => __( 'Footer Navigation Menu', 'corecom' ),
			'mobile'    => __( 'Mobile Navigation Menu', 'corecom' ),
		)
	);
	
	// Add Mobile Navigation
	add_action( 'genesis_before', 'gs_mobile_navigation', 5 );
	
	//Enqueue Sandbox Scripts
	add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );
	
	/**
	 * 13 Editor Styles
	 * Takes a stylesheet string or an array of stylesheets.
	 * Default: editor-style.css 
	 */
	//add_editor_style();
	
	
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
			'description'	=> __( 'This is the middle homepage area. We will be putting the featured Posts widget for 3 posts with featured image', 'corecom' ),
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
			'name'			=> __( 'Last Footer Left', 'corecom' ),
			'description'	=> __( 'Last Footer on left, monochrome logo', 'corecom' ),
		),
		array(
			'id'			=> 'footer-bottom-02',
			'name'			=> __( 'Last Footer Right', 'corecom' ),
			'description'	=> __( 'Last Footer on the right, 2nd Menu, then address, ', 'corecom' ),
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

// Add Widget Area After Post, and homem page
add_action('genesis_after_content', 'gs_do_after_entry');
function gs_do_after_entry() {

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
  		genesis_widget_area( 
                'testimonials',////////////testimonials
                array(
                        'before' => '<aside  class="testimonial-slider clearfix"><div id="testimonial-slider"><div class="testimonial-slider widget-area">', 
                        'after' => '</div></div></aside>',
                ) 
        );
  		genesis_widget_area( 
                'contact',////////////testimonials
                array(
                        'before' => '<aside  class="contact-slider clearfix"><div id="contact-slider"><div class="contact-slider widget-area">', 
                        'after' => '</div></div></aside>',
                ) 
        );                              
                              

 }

//Adds slider to all pages using slug
add_action( 'genesis_before_content', 'cores_header_sliders' );
function cores_header_sliders() {
	if ( function_exists( 'soliloquy' ) ) { 
		soliloquy( 'home', 'slug' ); 
	}
}
//Adds Tagline for title as long as its not empty
add_action( 'genesis_before_entry_content', 'cores_tagline_output');
function cores_tagline_output() {
	
	if(the_meta()){
		echo the_meta();
	}
}