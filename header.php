<?php
/**
 * @package WordPress
 * @subpackage Yoko
 */
?><!DOCTYPE html>
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
      <nav class="mainnav clearfix">
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
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

      <?php
      // The header image
      // Check if this is a post or page, if it has a thumbnail, and if it's a big one
      if ( is_singular() &&
        current_theme_supports( 'post-thumbnails' ) &&
        has_post_thumbnail( $post->ID ) &&
        ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
        $image[1] >= HEADER_IMAGE_WIDTH ) :
        // Houston, we have a new header image!
        echo get_the_post_thumbnail( $post->ID , array(1102,350), array('class' => 'headerimage'));
        elseif ( get_header_image() ) : ?>
        <img src="<?php header_image(); ?>" class="headerimage" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" /><!-- end headerimage -->
      <?php endif; ?>
      <div class="clear"></div>

    </header><!-- end header -->
