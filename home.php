<?php
/**
 * Template Name: Home
 * Description: Startseiten-Template
 */

require_once(ABSPATH . WPINC . '/feed.php');

$rss = fetch_feed('http://www.cemp-online.de/feed/');

if ( !is_wp_error($rss) ) {
  $maxitems = $rss->get_item_quantity(5);
  $cempNews = $rss->get_items(0, $maxitems);
}

get_header(); ?>

<div class="wrap">
  <div class="main main-home">

    <div class="content content-home">

      <?php the_post(); ?>

      <?php get_template_part('content', 'post'); ?>

      <div class="latest-posts clearfix">
        <h2 class="latest-posts-caption">Neueste Beiträge</h2>
        <?php
        /**
         * Neueste Beitraege (ausser Ankuendigungen)
         */
        $latestPostsArgs = array(
          'numberposts' => 4,
          'category' => -1
        );
        $latestPosts = wp_get_recent_posts($latestPostsArgs, OBJECT);
        $counter = 0;

        foreach ( $latestPosts as $latestPost ) :
        ?>
          <?php
            $className = !$counter ? 'left' : 'right';
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
                <?php echo date('j.n.Y', strtotime($latestPost->post_date)); ?>
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

    </div><!-- end content -->

    <?php include dirname(__FILE__) . '/sidebar-home.php'; ?>

  </div>

<?php get_footer(); ?>
