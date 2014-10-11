<div class="secondary secondary-home">

  <aside class="widget widget-home widget-fb">
    <h3 class="widget-title">VCP Niedersachsen auf Facebook</h3>
    <div class="fb-like-box"></div>
  </aside>

  <aside class="widget widget-home widget-events">
    <h3 class="widget-title">Aktuelle Veranstaltungen</h3>
    <ul>
      <?php
        $latestEventsArgs = array(
          'numberposts' => 5,
          'post_type' => 'event',
          'post_status' => 'publish'
        );
        $latestEvents = wp_get_recent_posts($latestEventsArgs, OBJECT);

        foreach ( $latestEvents as $latestEvent ) :
      ?>
        <?php $eventStartDate = get_post_meta($latestEvent->ID, '_event_start_date', true); ?>
        <?php $eventEndDate = get_post_meta($latestEvent->ID, '_event_end_date', true); ?>
        <li>
          <a href="<?php echo get_permalink($latestEvent->ID); ?>">
            <?php echo $latestEvent->post_title; ?>
          </a>
          <small class="event-meta">
            <?php echo date('d.m.Y', strtotime($eventStartDate)); ?>
            <?php if ( $eventEndDate ) : ?>
              &mdash; <?php echo date('d.m.Y', strtotime($eventEndDate)); ?>
            <?php endif; ?>
          </small>
        </li>
      <?php endforeach; ?>
      <?php unset($latestEventsArgs); ?>
      <?php unset($latestEvents); ?>
      <?php unset($eventStartDate); ?>
      <?php unset($eventEndDate); ?>
    </ul>
  </aside>

</div>