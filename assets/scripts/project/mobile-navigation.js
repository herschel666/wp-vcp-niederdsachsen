
jQuery(function ($, undefined) {

  var navIsHidden = true;

  var $win = $(window),
      $mainnav = $('#mainnav'),
      $parents = $mainnav.find('.menu-item-has-children');

  function getSubToggle(_open) {
    var open = _open == undefined ? false : _open,
        iconClass = open ? 'icon icon-caret_up' : 'icon icon-caret_down';
    return '<button type="button" class="sub-menu-toggle">\
      <i class="' + iconClass + '" aria-hidden="true"></i>\
    </button>';
  }

  function toggleNav() {
    var val = navIsHidden ? '0' : '-100%';
    $mainnav.css('transform', 'translateY(' + val + ') translateZ(0)');
    navIsHidden = !navIsHidden;
  }

  function insertSubToggle() {
    $(getSubToggle(/current-menu-ancestor/.test(this.className)))
      .on('click', toggleSubNav)
      .appendTo(this);
  }

  function toggleSubNav() {
    var $parent = $(this).parent(),
        $subNav = $parent.find('.sub-menu'),
        isVisible = $subNav.is(':visible'),
        method = isVisible ? 'hide' : 'show',
        currentCaretClass = isVisible ? 'icon-caret_up' : 'icon-caret_down',
        newCaretClass = isVisible ? 'icon-caret_down' : 'icon-caret_up',
        icon = this.getElementsByTagName('i')[0];
    icon.className = icon.className.replace(currentCaretClass, newCaretClass);
    $subNav[method]();
  }

  function clearNavigation() {
    if ( $win.width() < 880 ) {
      return;
    }
    $mainnav.removeAttr('style');
  }

  $mainnav.on('click', '.js-mainnav-toggle-btn', toggleNav);
  $win.on('resize', clearNavigation);
  $parents.each(insertSubToggle);

});