<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php $favicon = get_theme_mod('favicon'); if(!empty($favicon)) { ?> 
  <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
  <?php } ?>

  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->	
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
  $logoObj = get_field('dlogo', 'options');
  if( is_array($logoObj) ){
    $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
  }else{
    $logo_tag = '';
  }
  $mlogoObj = get_field('mlogo', 'options');
  if( is_array($mlogoObj) ){
    $mlogo_tag = '<img src="'.$mlogoObj['url'].'" alt="'.$mlogoObj['alt'].'" title="'.$mlogoObj['title'].'">';
  }else{
    $mlogo_tag = '';
  }
  $spacialArry = array(".", "/", "+", "-", " ", ")", "(");$replaceArray = '';
  $email = get_field('email_address', 'options');
  $telefoon = get_field('telephone', 'options');
  $trimphone = trim(str_replace($spacialArry, $replaceArray, $telefoon));
?>
<header class="header hide-sm">
  <div class="container-lg">
    <div class="row">
      <div class="col-sm-12">
        <div class="logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
              <?php echo $logo_tag; ?>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="header-inr clearfix">
            <div class="hdr-lft">
              <?php if(!empty($telefoon)) printf('<a class="hdr-lft-tel" href="tel:%s">%s</a>', $trimphone, $telefoon); ?>
            </div>
            <div class="hdr-middel">
              <ul class="clearfix">
                <?php if(!empty($email)): ?>
                <li class="hdr-mid-email-icon">
                  <a href="mailto:<?php echo $email; ?>">e-mail ons</a>
                </li>
                <?php endif;  ?>
                <li class="hdr-mid-cart-icon"><a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>">winkelwagen</a></li>
                <li class="hdr-mid-profile-icon"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">mijn account</a></li>
              </ul>
            </div>
            <div class="hdr-rgt">
              <nav class="main-nav">
                <div class="nav-opener-inr">
                  <div class="nav-opener">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                  <strong>menu openen</strong>
                </div>
                <?php 
                  $cmenuOptions = array( 
                      'theme_location' => 'cbv_main_menu', 
                      'menu_class' => 'clearfix',
                      'container' => 'cmnav',
                      'container_class' => 'cmainnav'
                    );
                  wp_nav_menu( $cmenuOptions ); 
                ?>
              </nav>
            </div>
          </div>
        </div>
      </div>
  </div>
</header>

<header class="header-xs show-sm">
  <div class="container-lg">
    <div class="row">
      <div class="col-sm-12">
        <div class="logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php 
              echo $logo_tag;
              echo $mlogo_tag;
            ?>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="header-inr clearfix">
            <div class="hdr-lft hide-sm">
              <?php if(!empty($telefoon)) printf('<a class="hdr-lft-tel" href="tel:%s">%s</a>', $trimphone, $telefoon); ?>
            </div>
            <div class="hdr-lft-xs">
              <ul class="clearfix">
                <?php if(!empty($email)): ?>
                <li><a href="mailto:<?php echo $email; ?>"><img src="<?php echo THEME_URI; ?>/assets/images/email-icon-xs.png"></a></li>
                <?php endif; if(!empty($telefoon)): ?>
                <li><a href="tel:<?php echo $trimphone; ?>"><img src="<?php echo THEME_URI; ?>/assets/images/phone-icon-xs.png"></a></li>
                <?php endif; ?>
                <li><a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>"><img src="<?php echo THEME_URI; ?>/assets/images/cart-icon-xs.png"></a></li>
                <li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><img src="<?php echo THEME_URI; ?>/assets/images/profile-icon-xs.png"></a></li>
              </ul>
            </div>
            <div class="hdr-rgt">
              <nav class="main-nav-xs">
                <div class="nav-opener-xs-inr">
                  <div class="nav-opener-xs">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                  <strong>menu openen</strong>
                </div>
              </nav>
            </div>
            <div class="nav-menu-xs">
              <?php 
                $cmenuOptions = array( 
                    'theme_location' => 'cbv_main_menu', 
                    'menu_class' => 'clearfix',
                    'container' => 'cmnav',
                    'container_class' => 'cmainnav'
                  );
                wp_nav_menu( $cmenuOptions ); 
              ?>
              <span class="close-btn"><img src="<?php echo THEME_URI; ?>/assets/images/close-btn.png"></span>
            </div>
          </div>
        </div>
      </div>
  </div>
</header>