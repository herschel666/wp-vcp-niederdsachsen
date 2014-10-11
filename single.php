<?php get_header(); ?>

<div class="wrap">
  <div class="main">

    <div class="content">

      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <?php get_template_part('content', 'single'); ?>

        <?php comments_template('', true); ?>

      <?php endwhile; // end of the loop. ?>

      <nav class="nav-below">
        <div class="nav-previous">
          <?php next_post_link('%link', __( '&larr; Previous Post', 'yoko')); ?>
        </div>
        <div class="nav-next">
          <?php previous_post_link('%link', __( 'Next Post  &rarr;', 'yoko')); ?>
        </div>
      </nav><!-- end #nav-below -->

    </div><!-- end content -->

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
