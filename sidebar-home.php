<?php require_once(ABSPATH . WPINC . '/feed.php'); ?>

<div class="secondary">

  <aside class="widget widget-home widget-fb">
    <h3 class="widget-title">VCP Niedersachsen auf Facebook</h3>
    <div class="fb-like-box" data-href="<?php echo get_option('home'); ?>"></div>
  </aside>

  <aside class="widget widget-home widget-events">
    <h3 class="widget-title">Aktuelle Veranstaltungen</h3>
    <ul>
      <?php
        $latestEventsArgs = array(
          'numberposts' => 5,
          'post_type' => 'event',
          'post_status' => 'publish',
          'meta_query' => array(
            array(
              'key' => '_event_start_date',
              'value' => date('Y-m-d'),
              'compare' => '>'
            )
          )
        );
        $latestEvents = wp_get_recent_posts($latestEventsArgs, OBJECT);

        foreach ( $latestEvents as $latestEvent ) :
      ?>
        <?php $eventStartDate = get_post_meta($latestEvent->ID, '_event_start_date', true); ?>
        <?php $eventEndDate = get_post_meta($latestEvent->ID, '_event_end_date', true); ?>
        <?php $eventLocationId = get_post_meta($latestEvent->ID, '_location_id', true); ?>
        <?php $eventLocation = getEventLocation($eventLocationId); ?>
        <li>
          <a href="<?php echo get_permalink($latestEvent->ID); ?>" class="event-<?php echo $latestEvent->ID; ?>">
            <?php echo $latestEvent->post_title; ?>
          </a><?php if ( !is_null($eventLocation) ) : ?> in <?php echo $eventLocation; ?><?php endif; ?>
          <small class="widget-meta">
            <?php echo date_i18n(get_option('date_format'), strtotime($eventStartDate)); ?>
            <?php if ( $eventEndDate && $eventEndDate > $eventStartDate ) : ?>
              &mdash; <?php echo date_i18n(get_option('date_format'), strtotime($eventEndDate)); ?>
            <?php endif; ?>
          </small>
        </li>
      <?php endforeach; ?>
      <?php unset($latestEventsArgs); ?>
      <?php unset($latestEvents); ?>
      <?php unset($eventStartDate); ?>
      <?php unset($eventEndDate); ?>
      <?php unset($eventLocationId); ?>
      <?php unset($eventLocation); ?>
    </ul>
  </aside>

  <aside class="widget widget-home widget-news">
    <h3 class="widget-title">A bisl nay</h3>
    <ul>
      <?php
        $latestNewsArgs = array(
          'numberposts' => 5,
          'post_status' => 'publish',
          'category' => 1
        );
        $latestNews = wp_get_recent_posts($latestNewsArgs, OBJECT);

        foreach ( $latestNews as $latestNewsItem ) :
      ?>
        <li>
          <a href="<?php echo get_permalink($latestNewsItem->ID); ?>">
            <?php echo $latestNewsItem->post_title; ?>
          </a>
          <small class="widget-meta">
            Geschrieben am <?php echo date_i18n(get_option('date_format'), strtotime($latestNewsItem->post_date)); ?>
          </small>
        </li>
      <?php endforeach; ?>
      <?php unset($latestNewsArgs); ?>
      <?php unset($latestNews); ?>
    </ul>
  </aside>

  <?php $rss = vcp_fetch_rss('http://www.cemp-online.de/feed/'); ?>
  <aside class="widget widget-home widget-cemp">
    <h3 class="widget-title">Cemp Online</h3>
    <?php if ( !count($rss) ) : ?>
      <p>Zurzeit gibt es nichts neues auf Cemp.</p>
    <?php else : ?>
      <ul>
        <?php foreach ( $rss as $cempNewsItem ) : ?>
          <li class="clearfix">
            <a href="<?php echo $cempNewsItem->url; ?>">
              <img src="<?php echo $cempNewsItem->thumb; ?>" alt="">
            <a href="<?php echo $cempNewsItem->url; ?>">
            <a href="<?php echo $cempNewsItem->url; ?>">
              <?php echo $cempNewsItem->title; ?>
            </a>
            <small class="widget-meta">
              Geschrieben am <?php echo $cempNewsItem->created_at; ?>
            </small>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <?php unset($rss); ?>
  </aside>

</div>