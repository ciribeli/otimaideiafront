<html lang="pt_BR" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <!-- Style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/animate.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
  </head>

  <body>
    <header>
      <div class="container">
        <div class="row">
          <div class="logo-top">
            <a href="#" class="img-logo-top"></a>
          </div>
          <div class="menu-desk">
            <ul>
              <li>
                <a href="/#projects">Projects</a>
              </li>
              <li>
                <a href="#">Partners</a>
              </li>
              <li>
                <a href="/#faq">FAQ</a>
              </li>
              <li>
                <a href="/#masters">Masters</a>
              </li>
              <li>
                <a href="/#">Classes</a>
              </li>
              <li>
                <a href="/#experience">Course Experience</a>
              </li>
              <li>
                <a href="/#about-us">About us</a>
              </li>
            </ul>
          </div>
          <div class="register-header">
            <a href="#" class="btn-register-header">Register</a>
          </div>
          <div class="tooltip-menu-mobile">
            <button id="openmenu" class="">
              <span></span>
              <span></span>
              <span></span>
            </button>
          </div>

        </div>
      </div>
    </header>
