/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        
        $(document).foundation(); // Foundation JavaScript

        
      
      },
      finalize: function() {
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {

        

        // Content Slides Navigation
        var $homeHeroSlides = $('.home-hero-slides');

        $homeHeroSlides.slick({
          dots: false,
          fade: true,
          arrows: false,
          infinite: true,
          speed: 300,
          autoplay: true,
          //slidesToShow: 1,
          //slidesToScroll: 1,
        });

      }
    },
    // About us page, note the change from about-us to about_us.
    'page': {
      init: function() {
        
        //
        // Accordion
        $('.accordion-topic').click(function(){
          $(this).next('.accordion-response').slideToggle(500).toggleClass('current');
          $(this).toggleClass('current');
          $(this).parents('.accordion').siblings().find('.accordion-topic').slideUp(500);
          $(this).parents('.accordion').siblings().find('.accordion-response').removeClass('current');
        });

        //
        // Akro in Action Slider
        
        var $akroSlides = $('.akro-in-action-slider');

        $akroSlides.on('init reInit afterChange', function (event, slick, currentSlide) {
          var i = (currentSlide ? currentSlide : 0) + 1; // Convert to 1-based index
          //$('.slide-index').text(i + '  /  ' + slick.slideCount);
        });

        $('.akro-in-action-slider-navigation .slider-prev').click(function(){
          $akroSlides.slick('slickPrev');
        })
        
        $('.akro-in-action-slider-navigation .slider-next').click(function(){
          $akroSlides.slick('slickNext');
        })

        $akroSlides.slick({
          dots: false,
          arrows: true,
          infinite: true,
          speed: 300,
          autoplay: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          prevArrow: $('.akro-in-action-slider-navigation .slider-prev'),
          nextArrow: $('.akro-in-action-slider-navigation .slider-next'),
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: true,
                //dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });

        //
        // Akro in Action Slider
        
        var $wcSlides = $('.wc-slider');

        $wcSlides.on('init reInit afterChange', function (event, slick, currentSlide) {
          var i = (currentSlide ? currentSlide : 0) + 1; // Convert to 1-based index
          $('.slide-index').text(i + '  /  ' + slick.slideCount);
        });

        $wcSlides.slick({
          dots: false,
          arrows: true,
          infinite: true,
          speed: 300,
          autoplay: true,
          slidesToShow: 2,
          slidesToScroll: 1,
          prevArrow: $('.slider-prev'),
          nextArrow: $('.slider-next'),
        });

        

      }
    },
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.