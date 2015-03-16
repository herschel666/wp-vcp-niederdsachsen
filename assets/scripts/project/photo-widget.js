
/**
 * Photo-widget
 */
(function ($) {
  $('a[rel^="lightbox"], .gallery-item a').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    mainClass: 'image-popup',
    image: {
      verticalFit: true
    },
    gallery: {
      enabled: true
    },
    zoom: {
      opener: function(elem) {
        return elem.find('img');
      }
    }
  });
})(jQuery);