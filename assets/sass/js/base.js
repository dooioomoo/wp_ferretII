/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

(function ($) {

    $(function () {
        setTimeout(pageLoader, 2000);
        var header = $('.site-branding');
        var sticky = header.offset().top;

        $(window).on('scroll', function () {
            backToTop();
            stickyNavigation(header, sticky);
        });
        if ($('#back-to-top').length) {
            backToTop();
            $('#back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            });
        }

    });
    var backToTop = function () {
        var scrollTrigger = 100, // px
            scrollTop = $(window).scrollTop();
        if (scrollTop > scrollTrigger) {
            $('#back-to-top').addClass('show');
        } else {
            $('#back-to-top').removeClass('show');
        }
    };
    var stickyNavigation = function (header, sticky) {

        if (window.pageYOffset > sticky) {
            header.addClass("sticky");
        } else {
            header.removeClass("sticky");
        }
    };

    var pageLoader = function () {
        if ($(".page-loader-wrap").length < 0) return;
        var target = $(".page-loader-wrap"),
            mode = $(".page-loader-wrap").attr("data-movestyle"),
            moveStyle = mode;
        switch (mode) {
            case 'fadeOut':
                mode = {opacity: 0};
                break;
            case 'flash_right':
                mode = {left: '100%'};
                break;
            case 'flash_left':
                mode = {right: '100%'};
                break;
            case 'flash_top':
                mode = {bottom: '100%'};
                break;
            case 'flash_bottom':
                mode = {top: '100%'};
                break;
            default:
                var items = [
                    {bottom: '100%'},
                    {top: '100%'},
                    {left: '100%'},
                    {right: '100%'},
                ];
                var item = items[Math.floor(Math.random() * items.length)];
                mode = item;
                break;
        }
        if (
            moveStyle == 'fadeOut'
        ) {
            target.find(".page-loader-container").animate(
                mode,
                300,
                'easeOutQuart',
                function () {
                    target.animate(
                        mode,
                        600,
                        'easeOutQuart',
                        function () {
                            target.remove();
                        }
                    )
                }
            );

        } else {


            target.find(".page-loader-mask").animate(
                {
                    bottom: 0,
                },
                500,
                'easeOutCirc',
                function () {
                    target.find(".page-loader-container").hide();
                    target.animate(
                        mode,
                        600,
                        'easeOutQuart',
                        function () {
                            target.remove();
                        }
                    )
                }
            );
        }

    }
})(jQuery);


(function () {
    var container, button, menu, links, i, len;

    container = document.getElementById('site-navigation');
    if (!container) {
        return;
    }
    button = document.getElementById('primary-navi-mobile-button');

    if ('undefined' === typeof button) {
        return;
    }
    menu = container.getElementsByTagName('ul')[0];


    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute('aria-expanded', 'false');
    if (-1 === menu.className.indexOf('nav-menu')) {
        menu.className += ' nav-menu';
    }

    button.onclick = function () {
        if (-1 !== container.className.indexOf('toggled')) {
            container.className = container.className.replace(' toggled', '');
            button.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-expanded', 'false');
        } else {
            container.className += ' toggled';
            button.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-expanded', 'true');
        }
    };

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName('a');

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while (-1 === self.className.indexOf('nav-menu')) {

            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    (function (container) {
        var touchStartFn, i,
            parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

        if ('ontouchstart' in window) {
            touchStartFn = function (e) {
                var menuItem = this.parentNode, i;

                if (!menuItem.classList.contains('focus')) {
                    e.preventDefault();
                    for (i = 0; i < menuItem.parentNode.children.length; ++i) {
                        if (menuItem === menuItem.parentNode.children[i]) {
                            continue;
                        }
                        menuItem.parentNode.children[i].classList.remove('focus');
                    }
                    menuItem.classList.add('focus');
                } else {
                    menuItem.classList.remove('focus');
                }
            };

            for (i = 0; i < parentLink.length; ++i) {
                parentLink[i].addEventListener('touchstart', touchStartFn, false);
            }
        }
    }(container));
})();
