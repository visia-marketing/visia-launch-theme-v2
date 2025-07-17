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
import $ from 'jquery';
import 'foundation-sites';
import 'slick-carousel';
//import 'simple-lightbox';
var SimpleLightbox = require('simple-lightbox');

// If you only need specific modules:
// import { Foundation, Accordion, Tabs } from 'foundation-sites';
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


        // Slick Carousel
        var $testimonialSlider = $('.content-testimonial-slider-slides');
        $testimonialSlider.slick({
          dots: false,
          arrows: true,
          infinite: true,
          speed: 400,
          fade: true,
          cssEase: 'linear',
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: false,
          prevArrow: $('.slider-prev'),
          nextArrow: $('.slider-next'),
        })
        .on("setPosition", function () {
          resizeSlider();
        });

        $(window).on("resize", function (e) {
          resizeSlider();
        });
        
        var slickHeight = $(".slick-track").outerHeight();
        var slideHeight = $(".slick-track").find(".slick-slide").outerHeight();
        
        function resizeSlider() {

          $(".slick-track")
            .find(".content-testimonial-slider-slide").css("height", "auto");
            slickHeight = $(".slick-track").outerHeight();
            slideHeight = $(".slick-track").find(".slick-slide").outerHeight();

          $(".slick-track")
            .find(".content-testimonial-slider-slide")
            .css("height", slickHeight + "px");
        }
        // END TESTIMONIAL SLIDER

        
        var galleries = document.querySelectorAll('.gallery');

        galleries.forEach(function(gallery) {
          var galleryId = gallery.id;
          new SimpleLightbox({
            elements: '#' + galleryId + ' .gallery-item a',
            /* Options can be added here */
          });
        }
        );


        







      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // All Other Pages.
    'page': {
      init: function() {
        
        // Accordion
        $('.accordion-topic').click(function(){
          $(this).next('.accordion-response').slideToggle(500).toggleClass('current');
          $(this).toggleClass('current');
          $(this).parents('.accordion').siblings().find('.accordion-topic').slideUp(500);
          $(this).parents('.accordion').siblings().find('.accordion-response').removeClass('current');
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