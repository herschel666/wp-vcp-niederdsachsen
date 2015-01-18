  </div><!-- end wrap -->

  <?php include dirname(__FILE__) . '/sidebar-bottom.php'; ?>

  <footer class="colophon clearfix">
    <p>Proudly powered by <a href="http://wordpress.org/">WordPress</a><span class="sep"> | </span><?php printf( __( 'Theme: %1$s by %2$s', 'yoko' ), 'Yoko', '<a href="http://www.elmastudio.de/en/themes/">Elmastudio</a>' ); ?></p>
    <a href="#page" class="top"><?php _e( 'Top', 'yoko' ); ?></a>
  </footer><!-- end colophon -->

</div><!-- end page -->
<?php wp_footer(); ?>

<?php if ( is_home() ) : ?>
  <?php
  /**
   * Facebook-Widget der VCP-Nds-Seite
   */
  ?>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&appId=1502549699992417&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<?php endif; ?>

<script>
  (function (v, c, p) {
    var l = v.getElementsByTagName(c)[0],
        e = v.createElement(c);
    e.type = 'text/javascript'; e.src = p; e.async = true;
    l.parentNode.insertBefore(e, l);
  })(document, 'script', '<?php bloginfo("template_url"); ?>/assets/scripts/main.js');
</script>

</body>
</html>
