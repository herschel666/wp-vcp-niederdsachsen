<?php
/**
 * Template Name: Kontakt
 * Description: Darstellung von Uebersicht & Einzel-Formularen
 *
 * @package WordPress
 * @subpackage Yoko
 */

$formId = isset($_GET['form']) && !empty($_GET['form'])
  ? $_GET['form']
  : null;
$formObj = getContactForm($formId);

get_header(); ?>

<div class="wrap">
  <div class="main">
    <div class="content">

      <?php if ( $formObj['title'] ) : ?>
        <article class="page">
          <header class="entry-header">
            <h2 class="entry-title">
              <?php echo $formObj['title']; ?>
            </h2>
          </header><!-- end entry-header -->
          <div class="single-entry-content">
            <?php echo do_shortcode($formObj['shortcode']); ?>
            <p>
              <a href="javascript:history.back();">&larr; zurück</a>
            </p>
          </div>
        </article>
      <?php else : ?>
        <?php the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>
      <?php endif; ?>

      <?php comments_template('', true); ?>

    </div><!-- end content -->

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
