<?php

/**
 * HTML-Head von unnoetigen Meta-Tags befreien.
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');


/**
 * X-Pingback-header entfernen
 */
function remove_x_pingback($headers) {
  unset($headers['X-Pingback']);
  return $headers;
}

add_filter('wp_headers', 'remove_x_pingback');


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