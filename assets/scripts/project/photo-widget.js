
/**
 * Photo-widget
 */
(function ($) {
  $('#photo-widget').magnificPopup({
    delegate: 'a',
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