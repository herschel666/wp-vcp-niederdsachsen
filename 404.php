<?php get_header(); ?>

<div class="wrap">
  <div class="main">

    <div class="content">
      <article class="page">
        <header class="page-entry-header">
          <h1 class="entry-title"><?php _e( 'Not Found', 'yoko' ); ?></h1>
        </header><!-- end page-entry-header -->

        <div class="single-entry-content">
          <p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'yoko' ); ?></p>
          <?php get_search_form(); ?>
        </div>

      </article>
    </div><!-- end content -->

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
