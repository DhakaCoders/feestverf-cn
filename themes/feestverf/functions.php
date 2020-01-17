<?php
/**
Constants->>
*/
defined('THEME_NAME') or define('THEME_NAME', 'feestverf');
defined( 'THEME_DIR' ) or define( 'THEME_DIR', get_template_directory() );
defined( 'THEME_URI' ) or define( 'THEME_URI', get_template_directory_uri() );

defined( 'HOMEID' ) or define( 'HOMEID', get_option('page_on_front') );

/**
Theme Setup->>
*/
if( !function_exists('cbv_theme_setup') ){
	
	function cbv_theme_setup(){
	    
	  load_theme_textdomain( 'feestverf', get_template_directory() . '/languages' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'woocommerce' );
		add_theme_support('post-thumbnails');
		if(function_exists('add_theme_support')) {
			add_theme_support('category-thumbnails');
		}
 
        //add_image_size( 'hcatgrid', 294, 234, true );

		
		// add size to media uploader
		add_filter( 'image_size_names_choose', 'cbv_custom_image_sizes' );
		function cbv_custom_image_sizes( $sizes ) {
		    return array_merge( $sizes, array(
		        'vgrid2' => __( 'Gallery Grid' ),
		    ) );
		}

		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		register_nav_menus( array(
          'cbv_main_menu' => __( 'Main Menu', THEME_NAME ),
          'cbv_copyright_menu' => __( 'Copyright Menu', THEME_NAME ),
		) );

	}

}
add_action( 'after_setup_theme', 'cbv_theme_setup' );

/**
Enqueue Scripts->>
*/
function cbv_theme_scripts(){
	include_once( THEME_DIR . '/enq-scripts/bootstrap.php' );
	include_once( THEME_DIR . '/enq-scripts/fonts.php' );
	include_once( THEME_DIR . '/enq-scripts/matchheight.php' );
	include_once( THEME_DIR . '/enq-scripts/theme.default.php' );
}

add_action( 'wp_enqueue_scripts', 'cbv_theme_scripts');

/**
Includes->>
*/
include_once(THEME_DIR .'/inc/widgets-area.php');
include_once(THEME_DIR .'/inc/cbv-functions.php');
include_once(THEME_DIR .'/inc/breadcrumbs.php');
include_once(THEME_DIR .'/inc/wc-functions.php');

/**
ACF Option pages->>
*/
if( function_exists('acf_add_options_page') ) {	
	
	//parent tab
	//acf_add_options_page( 'Opties' );
    acf_add_options_page(array(
        'page_title' 	=> __('Options', THEME_NAME),
        'menu_title' 	=> __('Options', THEME_NAME),
        'menu_slug' 	=> 'cbv_options',
        'capability' 	=> 'edit_posts',
        //'redirect' 	    => false
    ));

}
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyBo2-QJ7RdCkLw3NFZEu71mEKJ_8LczG-c';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

add_post_type_support( 'page', 'excerpt' );

add_filter('use_block_editor_for_post', '__return_false');

function searchfilter($query) {
    if (is_search() && $query->is_main_query() && !is_admin() ) {
        //$query->set('post_type',array('post'));
        $query->set( 'posts_per_page', 2 );
        $query->set( 'orderby', 'modified' );
    }
return $query;
}
 
add_filter('pre_get_posts','searchfilter');

function wpb_change_search_url() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }   
}
//add_action( 'template_redirect', 'wpb_change_search_url' );


function defer_parsing_of_js ( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) || strpos( $url, 'jquery-migrate.min.js' ) ) return $url;
    return "$url' defer ";
    
}
if ( ! is_admin() ) {
    add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
}

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
	// loop
	foreach( $items as &$item ) {
		// vars
		$icon = get_field('icon', $item);	
		// append icon
		if( $icon ) {	
			$item->title .= ' <img src="'.$icon.'"/>';	
		}
		
	}
	// return
	return $items;
}

function custom_body_classes($classes){
    // the list of WordPress global browser checks
    // https://codex.wordpress.org/Global_Variables#Browser_Detection_Booleans
    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    // check the globals to see if the browser is in there and return a string with the match
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));
    return $classes;
}
// call the filter for the body class
add_filter('body_class', 'custom_body_classes');


/**
ACF - Custom rule for WOO attribues
*/
// Adds a custom rule type.
add_filter( 'acf/location/rule_types', function( $choices ){
    $choices[ __("Other",'acf') ]['wc_prod_attr'] = 'WC Product Attribute';
    return $choices;
} );

// Adds custom rule values.
add_filter( 'acf/location/rule_values/wc_prod_attr', function( $choices ){
    foreach ( wc_get_attribute_taxonomies() as $attr ) {
        $pa_name = wc_attribute_taxonomy_name( $attr->attribute_name );
        $choices[ $pa_name ] = $attr->attribute_label;
    }
    return $choices;
} );

// Matching the custom rule.
add_filter( 'acf/location/rule_match/wc_prod_attr', function( $match, $rule, $options ){
    if ( isset( $options['taxonomy'] ) ) {
        if ( '==' === $rule['operator'] ) {
            $match = $rule['value'] === $options['taxonomy'];
        } elseif ( '!=' === $rule['operator'] ) {
            $match = $rule['value'] !== $options['taxonomy'];
        }
    }
    return $match;
}, 10, 3 );

add_filter( 'wpcf7_autop_or_not', '__return_false' );

if( !function_exists('cbv_custom_both_breadcrump')){
  function cbv_custom_both_breadcrump(){
    if ( is_product_category() || is_product() || is_shop() || is_cart() || is_checkout()
       || is_woocommerce() || is_product_tag() || is_account_page() || is_wc_endpoint_url()
       || is_ajax()) {
               woocommerce_breadcrumb();
            }else{
                cbv_breadcrumbs();
            }
    }
}
/**
Debug->>
*/
function printr($args){
	echo '<pre>';
	print_r ($args);
	echo '</pre>';
}