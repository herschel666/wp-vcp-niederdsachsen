<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/html5shiv/dist/html5shiv-printshiv.min.js.js"></script>
  <![endif]-->
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="page-frame clearfix">
    <header class="branding">
      <nav class="mainnav clearfix" id="mainnav">
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        <div class="mainnav-toggle">
          <button class="mainnav-toggle-btn js-mainnav-toggle-btn" type="button">
            <i class="icon icon-menu" aria-hidden="true"></i>
          </button>
        </div>
      </nav><!-- end mainnav -->

      <?php global $yoko_options;
      $yoko_settings = get_option( 'yoko_options', $yoko_options ); ?>

      <hgroup class="site-title">
        <?php if( $yoko_settings['custom_logo'] ) : ?>
          <a href="<?php echo home_url( '/' ); ?>" class="logo"><img src="<?php echo $yoko_settings['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" /></a>
        <?php else : ?>
          <h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
          <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
        <?php endif; ?>
      </hgroup><!-- end site-title -->
      <div class="clear"></div>

    </header><!-- end header -->
