<?php
/**
 * @package WordPress
 * @subpackage Yoko
 */
?>

  <div class="secondary widget-area" role="complementary">
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

    <?php endif; // end sidebar 1 widget area ?>
  </div><!-- #secondary .widget-area -->
</div><!-- end main -->

<div class="tertiary widget-area" role="complementary">
  <?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
  <?php endif; // end sidebar 2 widget area ?>
</div><!-- end tertiary .widget-area -->
