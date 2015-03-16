  </div><!-- end wrap -->

  <?php include dirname(__FILE__) . '/sidebar-bottom.php'; ?>

  <footer class="colophon clearfix">
    <p>Proudly powered by <a href="http://wordpress.org/">WordPress</a><span class="sep"> | </span><?php printf( __( 'Theme: %1$s by %2$s', 'yoko' ), 'Yoko', '<a href="http://www.elmastudio.de/en/themes/">Elmastudio</a>' ); ?></p>
    <a href="#page" class="top"><?php _e( 'Top', 'yoko' ); ?></a>
  </footer><!-- end colophon -->

</div><!-- end page -->
<?php wp_footer(); ?>

<?php
$mainJs = $_SERVER['HTTP_HOST'] == 'www.vcp-niedersachsen.xy' ? 'main.js' : 'main.min.js';
?>
<script>
  (function (v, c, p) {
    var l = v.getElementsByTagName(c)[0],
        e = v.createElement(c);
    e.type = 'text/javascript'; e.src = p; e.async = true;
    l.parentNode.insertBefore(e, l);
  })(document, 'script', '<?php bloginfo("template_url"); ?>/assets/scripts/<?php echo $mainJs; ?>?1');
</script>

</body>
</html>
