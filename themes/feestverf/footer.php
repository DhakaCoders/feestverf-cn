<?php $copyright_text = get_field('copyright_text', 'options'); ?>
<footer class="footer-wrp">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
          <div class="ftr-col-inr clearfix">
            <div class="ftr-col-lft hide-sm">
              <?php if( !empty( $copyright_text ) ) printf( '%s', $copyright_text); ?>
            </div>
            <div class="ftr-col-rgt">
              <?php 
                $copymenuOptions = array( 
                    'theme_location' => 'cbv_copyright_menu', 
                    'menu_class' => 'clearfix',
                    'container' => 'copymnav',
                    'container_class' => 'copymainnav'
                  );
                wp_nav_menu( $copymenuOptions ); 
              ?> 
            </div>
          </div>
      </div>
    </div>
  </div> 
</footer>
<?php wp_footer(); ?>
</body>
</html>