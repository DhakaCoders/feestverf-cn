<?php get_header(); 
$get_title = get_field('custom_title', HOMEID);
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
              <div class="main-content-lft-list">
                <ul>
                  <li><a href="#">custom html under</a></li>
                  <li><a href="#">category list</a></li>
                </ul>
              </div>
            </div>
            <div class="main-content-rgt">
              <div class="main-content-top">
                <?php 
                  if(!empty($get_title)) printf('<h1 class="hide-sm">%s</h1>', $get_title); 
                  if(!empty($get_title)) printf('<h2 class="show-sm">%s</h2>', $get_title); 
                  if(!empty($gettop_content)) printf('<div class="hide-sm">%s</div>', wpautop( $gettop_content ));
                  if(!empty($gettop_content)) printf('<div class="show-sm">%s</div>', wpautop( $gettop_content ));
                ?>
              </div>
              <div class="product-select show-sm"><div class="news-grid-select-3">
                  <?php pcategory_dropdown(); ?>
                </div>
              </div>

              <div class="product-grid-wrp">
                <?php if(!empty($pshortcode)) echo do_shortcode($pshortcode); ?>
              </div>
              <div class="main-content-btm">
                <?php 
                  if(!empty($getbtm_content)) printf('<div class="hide-sm">%s</div>', wpautop( $getbtm_content ));
                  if(!empty($getbtm_content)) printf('<div class="show-sm">%s</div>', wpautop( $getbtm_content ));
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>    
</section><!-- end of main-content-sec-wrp -->
<?php get_footer(); ?>