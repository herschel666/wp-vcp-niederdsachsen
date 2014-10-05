<?php
/**
 * @package WordPress
 * @subpackage Yoko
 */

get_header(); ?>

<div class="wrap">
  <div class="main">

    <div class="content">

      <?php the_post(); ?>

      <?php get_template_part( 'content', 'page' ); ?>

      <?php comments_template( '', true ); ?>

    </div><!-- end content -->

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
