<?php

/**
 * Funktion zum Embedden eines RSS-Feeds
 * inklusive Thumbnails und Cache.
 *
 * Nutzung:
 *
 * <?php $feed = vcp_fetch_rss('http://site.tld/feed.xml', 6); ?>
 * <ul>
 *   <?php foreach ( $feed as $item ) : ?>
 *     <li>
 *       <a href="<?php echo $item->url; ?>">
 *         <?php echo $item->title; ?>
 *       </a>
 *       <img src="<?php echo $item->thumb; ?>" alt="">
 *       <date><?php echo $item->created_at; ?></date>
 *   <?php endforeach; ?>
 * </ul>
 */

define('VCP_CACHE_FOLDER', TEMPLATEPATH . DIRECTORY_SEPARATOR . '.cache' . DIRECTORY_SEPARATOR);

/**
 * Creation-Date vom Cache-Folder auslesen & diesen loeschen,
 * wenn er aelter als 24 Stunden ist.
 */
if ( ($then = file_get_contents(VCP_CACHE_FOLDER . '.last') * 1) ) {
  $now = time();
  $day = 60 * 60 * 24;
  $duration = $now - $then;
  if ( $duration > $day ) {
    // Vlt doch lieber mit PHP …??!??
    system('/bin/rm -rf ' . escapeshellarg(VCP_CACHE_FOLDER));
  }
}

/** Cache-Folder erstellen und Creation-Date speichern. */
if ( !file_exists(VCP_CACHE_FOLDER) ) {
  mkdir(VCP_CACHE_FOLDER);
  $fp = fopen(VCP_CACHE_FOLDER . '.last', 'wb');
  fwrite($fp, time());
  fclose($fp);
}

class Embedder {

  /**
   * Size of the thumbnail
   *
   * @var  number
   */
  const SIZE = 100;

  protected $fallback = null;
  protected $url = null;
  protected $maxitems = null;
  protected $rss = null;
  protected $content = '';
  protected $noContent = false;

  protected $posts = array();

  public function __construct($url, $maxitems) {
    $this->fallback = TEMPLATEPATH . '/assets/images/cemp-logo.png';
    $this->url = $url;
    $this->maxitems = $maxitems;
    if ( !is_null($this->url) ) {
      $this->rss = fetch_feed('' . $this->url);
    }
    $this->__fetchContent();
  }

  public function getPosts() {
    return $this->posts;
  }

  protected function __fetchContent() {
    if ( is_wp_error($this->rss) ) {
      return;
    }
    $quantity = $this->rss->get_item_quantity($this->maxitems);
    $items = $this->rss->get_items(0, $quantity);
    if ( $quantity == 0 ) {
      $this->noContent = true;
      return;
    }
    $this->__extractPosts($items);
  }

  protected function __extractPosts($items) {
    foreach ( $items as $item ) {
      $tmp = new stdClass();
      $tmp->url = esc_url($item->get_permalink());
      $tmp->title = esc_html($item->get_title());
      $tmp->created_at = $item->get_date(get_option('date_format'));
      $thumb = $this->__getThumbnail($item->get_content());
      $tmp->thumb = $this->__pathToUrl($thumb);
      $this->posts[] = $tmp;
    }
  }

  protected function __getThumbnail($htmlContent = '') {
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $htmlContent, $matches);
    $image = $matches[1][0];
    if ( !$image ) {
      return $this->fallback;
    }
    $pathinfo = pathinfo($image);
    $hash = md5($pathinfo['basename']);
    $path = VCP_CACHE_FOLDER . $hash . '.' . $pathinfo['extension'];
    if ( $path && file_exists($path) ) {
      return $path;
    }
    if ( $path && ($imageRes = file_get_contents($image)) ) {
      file_put_contents($path, $imageRes);
      if ( $this->__cropImage($path) ) {
        return $path;
      }
    }
    return $this->fallback;
  }

  protected function __cropImage($destination) {
    if ( !$destination ) {
      return false;
    }
    $type = strtolower(strrchr($destination, '.'));
    $newName = str_replace($type, '', $destination) . '-1' . $type;
    $success = @image_resize($destination, self::SIZE . 'x' . self::SIZE . $type, self::SIZE, self::SIZE, 1) == true;
    $success = rename($newName, $destination);
    return $success;
  }

  protected function __pathToUrl($path) {
    $pos = strpos($path, '.cache');
    $sub = substr($path, 0, $pos);
    return str_replace($sub, trim(get_template_directory_uri(), '/') . '/', $path);
  }

}

/** Eigentliche Funktion zur Nutzung im Template. */
function vcp_fetch_rss($url = null, $maxitems = 5) {
  $embedder = new Embedder($url, $maxitems);
  return $embedder->getPosts();
}
