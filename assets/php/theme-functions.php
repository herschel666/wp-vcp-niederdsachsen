<?php

/**
 * HTML-Head von unnoetigen Meta-Tags befreien.
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Zusaetzlicher Kram.
 */
require_once(dirname(__FILE__) . '/embed-rss.php');

/**
 * X-Pingback-header entfernen
 */
function remove_x_pingback($headers) {
  unset($headers['X-Pingback']);
  return $headers;
}

add_filter('wp_headers', 'remove_x_pingback');


/**
 * Tablepress-Styles entfernen. Sind in
 * die Theme-Styles integriert.
 */
function remove_plugin_styles() {
  wp_dequeue_style('tablepress-default');
}

add_action('wp_print_styles', 'remove_plugin_styles', 100);

/**
 * Wird ein User per WP-Members aktiviert, wird dessen
 * Passwort automatisch auf 'Willkommen#1' gesetzt. Anders
 * laesst sich eine Default-Passwort-Loesung nicht integrieren.
 */
function setUserDefaultPassword($user_id) {
  wp_set_password('Willkommen#1', $user_id);
}

add_action('wpmem_user_activated', 'setUserDefaultPassword');

/**
 * Setzt den "Registrieren"-Link im Meta-Block
 * der Sidebar auf die Custom-Page.
 */
function resetRegisterLink() {
  $link = '<li><a href="' . get_permalink(589) . '">Registrieren</a></li>';
  return $link;
}
add_filter('register', 'resetRegisterLink');


/**
 * Nimmt eine Contact-Form-7-ID, ermittelt den Titel und
 * gibt diesen den Shortcode zurueck.
 */
function getContactForm($id = null) {

  $result = array(
    'title' => null,
    'shortcode' => null
  );

  if ( is_null($id) ) {
    return $result;
  }

  $form = get_post((int) $id);

  if ( !$form ) {
    return $result;
  }

  $result['title'] = $form->post_title;
  $result['shortcode'] = '[contact-form-7 id="' . (int) $id . '" title="' . $form->post_title . '"]';

  return $result;

}

/**
 * Gibt eine Event-Location anhand der Location-ID zurueck.
 *
 * @param  Number $locationId
 * @return String|null
 */
function getEventLocation($locationId = null) {

  if ( is_null($locationId) ) {
    return null;
  }

  global $wpdb;
  $query = 'SELECT ' . $wpdb->prefix . 'em_locations.location_town ' .
          'FROM ' . $wpdb->prefix . 'em_locations ' .
          'WHERE ' . $wpdb->prefix . 'em_locations.location_id = ' . (int) $locationId;
  return $wpdb->get_var($query);

}

/**
 * Holt die zehn neuesten Bilder aus den Next-Gen-Galerien.
 *
 * @return Array
 */
function getRandomNextGenPics() {

  global $wpdb;
  $query = 'SELECT ' . $wpdb->prefix . 'ngg_pictures.filename, ' . $wpdb->prefix . 'ngg_gallery.path' .
          ' FROM ' . $wpdb->prefix . 'ngg_pictures, ' . $wpdb->prefix . 'ngg_gallery' .
          ' WHERE ' . $wpdb->prefix . 'ngg_pictures.galleryid = ' . $wpdb->prefix . 'ngg_gallery.gid' .
          ' ORDER BY ' . $wpdb->prefix . 'ngg_pictures.imagedate DESC' .
          ' LIMIT 10';
  return  $wpdb->get_results($query);

}
