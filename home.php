<?php
/**
 * Template Name: Home
 * Description: Startseiten-Template
 */

get_header(); ?>

<div class="wrap">
  <div class="main">

    <div class="content">

      <?php the_post(); ?>

      <?php get_template_part('content', 'page'); ?>

      <div class="latest-posts">
        <h2 class="latest-posts-caption">Neueste Beiträge</h2>
        <?php
        /**
         * Neueste Beitraege (ausser Ankuendigungen)
         */
        $latestPostsArgs = array(
          'numberposts' => 6,
          'category' => -1
        );
        $latestPosts = wp_get_recent_posts($latestPostsArgs, OBJECT);
        $counter = 0;

        foreach ( $latestPosts as $latestPost ) :
        ?>
          <?php
            $className = !$counter ? 'latest-post-left' : 'latest-post-right';
            $excerpt = wp_trim_words($latestPost->post_content, 10, '');
            // Shortcode rausfiltern
            $excerpt = preg_replace('/(\[[^]]+\])?/', '', $excerpt);
           ?>
          <div class="latest-post <?php echo $className; ?>">
            <h3 class="latest-post-title">
              <a href="<?php echo get_permalink($latestPost->ID); ?>">
                <?php echo $latestPost->post_title; ?>
              </a>
            </h3>
            <div class="latest-post-date">
              Veröffentlicht am
              <time datetime="<?php echo date('Y-m-d', strtotime($latestPost->post_date)); ?>">
                <?php echo date_i18n(get_option('date_format'), strtotime($latestPost->post_date)); ?>
              </time>
            </div>
            <p class="latest-post-content">
              <?php echo $excerpt; ?>
              <a href="<?php echo get_permalink($latestPost->ID); ?>">[&hellip;]</a>
            </p>
          </div>
          <?php if ( $counter ) : ?>
            <div class="clear"></div>
          <?php endif; ?>
          <?php $counter = !$counter ? 1 : 0; ?>
        <?php endforeach; ?>
        <?php unset($latestPostsArgs); ?>
        <?php unset($latestPosts); ?>
        <?php unset($counter); ?>
        <?php unset($excerpt); ?>
      </div><!-- end latest-posts -->

      <?php
        $thumbs = getRandomNextGenPics();
        if ( count($thumbs) ) :
      ?>
        <?php $count = 0; ?>
        <div class="photo-widget clearfix" id="photo-widget">
          <h2 class="photo-widget-caption">Aktuelle Fotos</h2>
          <?php foreach ( $thumbs as $thumb ) : ?>
            <?php $path = get_option('home') . '/' . $thumb->path . '/'; ?>
            <?php $count++; ?>
            <div class="photo-widget-thumb photo-widget-thumb-<?php echo $count; ?>" id="photo-widget-thumb-<?php echo $count; ?>">
              <a href="<?php echo $path . $thumb->filename; ?>" rel="lightbox[photo-widget-thumb-<?php echo $count; ?>]">
                <img src="<?php echo $path . 'thumbs/thumbs_' . $thumb->filename; ?>" alt="">
              </a>
            </div>
          <?php endforeach; ?>
          <?php unset($count); ?>
        </div>
      <?php endif; ?>
      <?php unset($thumbs); ?>

    </div><!-- end content -->

    <?php include dirname(__FILE__) . '/sidebar-home.php'; ?>

  </div>

<?php get_footer(); ?>
