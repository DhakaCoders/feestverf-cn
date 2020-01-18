<?php get_header(); 
while(have_posts()): the_post();
?>
<section class="main-content-sec-wrp">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="main-content-wrp pagewrap clearfix">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
  </div>    
</section><!-- end of main-content-sec-wrp -->
<?php endwhile; get_footer(); ?>