<?php 
defined( 'ABSPATH' ) || exit;

/*Remove Archive Woocommerce Hooks & Filters are below*/

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
function woo_hide_page_title() {
	
	return false;
	
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


/**
 * Add wc custom content wrapper
 */
add_action('woocommerce_before_main_content', 'get_custom_wc_output_content_wrapper', 10);
add_action('woocommerce_after_main_content', 'get_custom_wc_output_content_wrapper_end', 10, 1);

function get_custom_wc_output_content_wrapper(){

	if(is_shop() OR is_product_category()){ $customClass = ' product-cat-sec'; $controlClass = ' cat-controller product-des-controller';}elseif(is_product()){$customClass = ' product-des-sec';$controlClass = ' product-des-controller'; }else{ $customClass = ''; $controlClass = '';}
	echo '<section class="main-content-sec-wrp'.$customClass.'"><div class="container"><div class="row"><div class="col-12"><div class="main-content-wrp'.$controlClass.' clearfix">';
    echo '<div class="main-content-lft hide-sm">
              <div class="main-content-lft-dsc">
                <span>Assortiment:</span>
                <ul class="clearfix">
                  <li><a href="#">Feestverf</a></li>
                  <li><a href="#">Category 2</a></li>
                </ul>
              </div>
              <div class="main-content-lft-list">
                <ul>
                  <li><a href="#">custom html under</a></li>
                  <li><a href="#">category list</a></li>
                </ul>
              </div>
            </div>';
        echo '<div class="main-content-rgt">';
}

function get_custom_wc_output_content_wrapper_end(){
	echo '</div></div></div></div></div></section>';
}


/*Loop Hooks*/


/**
 * Add loop inner details are below
 */
 
 remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}


add_action('woocommerce_shop_loop_item_title', 'add_shorttext_below_title_loop', 5);
if (!function_exists('add_shorttext_below_title_loop')) {
	function add_shorttext_below_title_loop() {
		global $product, $woocommerce, $post;
        $product_thumb = '';
        $thumb_id = get_post_thumbnail_id($product->get_id());
        if(!empty($thumb_id)){
            $product_thumb = cbv_get_image_tag($thumb_id, 'prodgrid');
        }
		echo '<div class="product-grid-inr">
        <div class="product-grid-img"><a href="'.get_permalink( $product->get_id() ).'" class="overlay-link"></a>';
        echo $product_thumb;
        woocommerce_template_loop_add_to_cart( );
        echo '</div>
        <div class="product-grid-title">
        <h5><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h5>
        </div>
        </div>';
	}
}

add_action('woocommerce_before_shop_loop', 'shop_loop_custom_wrapper_start', 30, 2);
add_action('woocommerce_after_shop_loop', 'shop_loop_custom_wrapper_end', 10, 2);
function shop_loop_custom_wrapper_start(){
    echo '<div class="product-grid-wrp">';
}

function shop_loop_custom_wrapper_end(){
    echo '</div>';
}

add_action('woocommerce_before_single_product_summary', 'open_add_custom_div_inside_loop', 10);
add_action('woocommerce_after_single_product_summary', 'close_add_custom_div_inside_loop', 20);

function open_add_custom_div_inside_loop(){
    echo '<div class="home-top-content clearfix"><div class="fl-product clearfix">';
}

function close_add_custom_div_inside_loop(){
    echo '</div></div>';
}


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action('woocommerce_single_product_summary', 'add_custom_short_text', 5, 2);
function add_custom_short_text(){
    global $product;
    $sh_desc = $product->get_short_description();
    if(empty($sh_desc)) return;
    echo '<div class="wcshort-desc">';
    echo $sh_desc;
    echo '</div>';
}

add_action('woocommerce_after_single_product_summary', 'add_custom_long_text', 20);
function add_custom_long_text(){
    global $product;
    $sh_desc = $product->get_description();
    if(empty($sh_desc)) return;
    echo '<div class="wclong-desc botm-con-row-1 clearfix"><div class="border-1px"><div class="border-5px btm-con">';
    echo $sh_desc;
    echo '</div></div></div>';
}
