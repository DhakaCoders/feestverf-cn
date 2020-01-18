<?php get_header(); 
$gettop_content = get_field('tcontent', HOMEID);
$getbtm_content = get_field('bottom_content', HOMEID);
$pshortcode = get_field('pshortcode', HOMEID);
?>
<section class="main-content-sec-wrp">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="main-content-wrp clearfix">
            <div class="main-content-lft hide-sm">
              <div class="main-content-lft-dsc clearfix">
                <?php if ( is_active_sidebar( 'dshop-widget' ) ) dynamic_sidebar( 'dshop-widget' ); ?>
              </div>
            </div>
            <div class="main-content-rgt">
              <div class="main-content-top">
                <?php if(!empty($gettop_content)) echo wpautop( $gettop_content ); ?>
              </div>
              <div class="product-select show-sm"><div class="news-grid-select-3">
                  <?php pcategory_dropdown(); ?>
                </div>
              </div>

              <div class="product-grid-wrp">
                <?php if(!empty($pshortcode)) echo do_shortcode($pshortcode); ?>
              </div>
              <div class="main-content-btm">
                <?php if(!empty($getbtm_content)) echo wpautop( $getbtm_content ); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>    
</section><!-- end of main-content-sec-wrp -->
<?php get_footer(); ?>