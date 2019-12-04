"use strict";

//svg
(function ($) {
  $.fn.toSVG = function (options) {
    var params = $.extend({
      svgClass: "replaced-svg",
      onComplete: function onComplete() {}
    }, options);
    this.each(function () {
      var $img = jQuery(this);
      var imgID = $img.attr('id');
      var imgClass = $img.attr('class');
      var imgURL = $img.attr('src');

      if (!/\.(svg)$/i.test(imgURL)) {
        return;
      }

      $.get(imgURL, function (data) {
        var $svg = jQuery(data).find('svg');

        if (typeof imgID !== 'undefined') {
          $svg = $svg.attr('id', imgID);
        }

        if (typeof imgClass !== 'undefined') {
          $svg = $svg.attr('class', imgClass + params.svgClass);
        }

        $svg = $svg.removeAttr('xmlns:a');

        if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
          $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
        }

        $img.replaceWith($svg);
        typeof params.onComplete == "function" ? params.onComplete.call(this, $svg) : '';
      });
    });
  };
})(jQuery);

function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
    textbox.bind(event, function () {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}

$('img.svg').toSVG({
  svgClass: " svg_converted",
  onComplete: function onComplete(data) {}
});
$(document).ready(function () {
  var bw = window.innerWidth;
  var bh = window.innerHeight; //E-mail Ajax Send

  $(".form_send").each(function () {
    var it = $(this);
    it.validate({
      rules: {
        phone: {
          required: true
        }
      },
      messages: {},
      errorPlacement: function errorPlacement(error, element) {},
      submitHandler: function submitHandler(form) {
        var thisForm = $(form);

        if (thisForm.find('.mfv_checker input').is(':checked')) {
          $.ajax({
            type: "POST",
            url: thisForm.attr("action"),
            data: thisForm.serialize()
          }).done(function () {
            $.fancybox.close();
            $.fancybox.open({
              src: '#myThanks',
              touch: false,
              baseClass: 'thanks_msg',
              openEffect: "elastic",
              openMethod: "zoomIn",
              closeEffect: "elastic",
              closeMethod: "zoomOut"
            });
            setTimeout(function () {
              $.fancybox.close();
            }, 3000);
            $('.mfv_checker').removeClass('error');
            $(".focus_field__element").removeClass('focused'); // $(".select_wrapper").removeClass('changed');

            it.trigger("reset");
          });
          return false;
        } else {
          thisForm.find('.mfv_checker').addClass('error');
        }
      },
      success: function success() {},
      highlight: function highlight(element, errorClass) {
        $(element).addClass('error');
      },
      unhighlight: function unhighlight(element, errorClass, validClass) {
        $(element).removeClass('error');
      }
    });
  }); // scroll to element

  function scrollToElement(target) {
    var targetTop = target.offset().top;
    $('body,html').animate({
      scrollTop: targetTop - $(".header").outerHeight()
    }, 700);
    event.preventDefault();
  }

  $(".scroll_btn").on('click', function (event) {
    event.preventDefault();
    var th = $(this);
    scrollToElement($(th.attr('href')));
  }); //masked
  // $('input[type=tel]').mask("+9(999) 999-99-99");

  setInputFilter($("input[type='tel']"), function (value) {
    return /^-?\d*$/.test(value);
  }); // fancybox

  $(".fancybox").fancybox({
    touch: false,
    // closeBtn: false,
    // fullScreen: false,
    // smallBtn: false,
    // buttons: [],
    // touch: false,
    // afterShow: function() {},
    buttons: ["close"],
    baseClass: "gal_frame" // afterLoad: function() {
    //   $($(this)[0].src).find('.slick-slider').slick('setPosition')
    // }

  });
  $(".modal_close, .mdl_close").click(function (event) {
    $.fancybox.close();
  }); // slick

  $('.slider_item').slick();
  $('.heading_slider').slick({
    dots: false,
    arrows: true,
    slidesToShow: 4,
    autoplay: false,
    slidesToScroll: 1,
    vertical: true,
    responsive: [{
      breakpoint: 1699,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 460,
      settings: {
        slidesToShow: 1,
        vertical: false
      }
    }]
  });
  var previousArrow = "<button type='button' class='slick-prev pull-left'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 334.2 190.7'><path opacity='.9' fill='#FFF' d='M3.3 100.6c1.8 1.7 10.7 7.5 19.6 12.7 55.9 33.1 83.2 49.6 102.4 62.3 12 7.9 22.9 14.6 24.3 15 3.4.9 7.2-.3 8.4-2.5.6-1.1 1.7-8.1 2.6-15.6 2.3-19.4 1.4-17.7 9.4-19.4 5.4-1.1 7.2-2 7.9-3.7.9-2 1.5-2.2 5.1-1.7 2.3.3 15.5 1 29.6 1.6s32.1 1.5 40.3 2c20.8 1.3 69.1 1.2 71.5-.1 4.7-2.5 1.6-4.6-9.5-6.6l-3.9-.7 3.3-1.7c2.7-1.3 3.3-2.2 3.1-4.4l-.2-2.8 6.9.5c7.6.5 10.6-.6 8.8-3.4-.6-1-2.9-2.2-5.1-2.9l-4-1.1 4.5-.7c9.2-1.3 7.4-5.3-4-8.8-6.1-1.8-6.4-2.1-3.6-2.7 6.7-1.2 8.2-2 8.2-4s-5.5-5.5-10.6-6.9c-3-.8-1.6-3.4 2-4.2 6.6-1.3 4.2-6.4-4.6-9.7-3.9-1.5-4.5-2-2.6-2.1 1.4 0 3.6-.8 4.8-1.6 1.9-1.3 2-1.9 1.1-4-.6-1.3-2-2.9-3.2-3.4-2.2-1-2.2-1 .4-2 4.5-1.8 5.4-3.6 3.2-6.6-2.6-3.4-7.9-5.4-19.1-7.5-5-.9-10-2-11.1-2.6-1.1-.5-6.8-1.1-12.8-1.4-5.9-.3-18.4-1.2-28.1-2-9.5-.9-30-2.1-45.4-2.8-15.4-.7-28.2-1.3-28.4-1.5-.2-.2-.7-9.1-1.2-20.1C172.1 6.3 170.4 0 164.4 0c-2.6 0-71.7 34.7-88.5 44.4-5.1 2.9-16.8 10.3-26.1 16.4-9.3 6.1-23 14.6-30.6 18.8-20.3 11.7-22.6 14.7-15.9 21zm12.3-8.9c2.6-1.5 5.2-2.7 5.9-2.7.7 0-.3.8-2.2 1.8-2.6 1.3-3.7 2.6-3.9 4.6-.3 2.5-.6 2.7-2.4 1.7-2.8-1.6-2.4-2.6 2.6-5.4zm7.8 10.5c1.1.6 2 1.3 2 1.6 0 .3-.9 0-2-.6s-2-1.3-2-1.6c-.1-.3.9 0 2 .6zm13.5-22.5c1.3-.8 1.5-.6 1.1 1.1-.4 1.4-1.3 2-3.2 2-2.8.1-2.4-.4 2.1-3.1zm2.6 26.1l2.8 2.9-3.3-2.4c-1.8-1.3-3.1-2.6-2.8-2.9.3-.3 1.8.7 3.3 2.4zm8.1-31.7c.8.8.3 1.2-2.8 2.1l-2.6.8 2.4-1.7c1.3-1.1 2.6-1.6 3-1.2zm12.5 45c1.7.9 3.1 1.8 3.1 2.1 0 .3-1.3-.2-3.1-1.1S57 118.3 57 118s1.4.1 3.1 1.1zm32.9-39c4.6.2.9.4-8.4.4s-13.1-.2-8.4-.4c4.6-.2 12.2-.2 16.8 0zm-3 13.3c.7.3.2.5-1.3.5-1.4 0-2-.2-1.3-.5s1.9-.3 2.6 0zm17.2 1.8c8.4.8 12.4 1.5 10.6 1.9-3.1.6-25.4-2-24.6-2.8.2-.2 6.6.2 14 .9zm-11.4 48.9c.5 0 2.2 1.2 3.8 2.6l2.9 2.6-3.8-2.2c-3.9-2.2-4.7-3-2.9-3zm11-99.7c2.1.2.4.4-3.8.4s-5.9-.2-3.8-.4c2.1-.2 5.4-.2 7.6 0zm21.7 64c7.5.4 12.8.8 11.7.9-1.1.1-2.5.6-3.1 1-.6.5-5.5.3-11.7-.4-12.4-1.5-11.7-1.3-11.2-1.8.3-.3 6.7-.1 14.3.3zm-4.4-53.8c2.1.2.7.4-3.3.4s-5.7-.2-3.8-.4c1.9-.2 5-.2 7.1 0zm3.1 34.7c1 .3.2.5-1.8.5-1.9 0-2.8-.2-1.8-.5 1-.2 2.6-.2 3.6 0zm5-61.5c4.5 0 4.1.6-1 1.3-2.2.4-3.5.2-3.2-.4.3-.5 2.2-.9 4.2-.9zm6.7 108.8c5 .5 6.3 1.1 9.6 4.5 3.6 3.7 3.7 3.9 1.5 3.9-1.3 0-5.3-1.8-9.1-4.1s-7.2-4.1-7.7-4.1c-.6 0-.8-.2-.5-.5.2-.1 3.1 0 6.2.3zm19.4-45.5c10 .1 10.8.2 6.4 1-4.6.8-17.9.3-17.9-.7 0-.2 5.2-.3 11.5-.3zm-8.1 73.4c1 0 1.2 1.1.8 3.8l-.5 3.8-.7-3.1c-1-4.5-1-4.5.4-4.5zm7.1-144.4c3-.5 3.9-.3 4.4 1 .9 2.3.5 2.5-5 1.9-5.4-.7-5.2-1.9.6-2.9zm3.6 30.9c1-.8 1.3-.6 1.3.6s-1 1.6-3.8 1.5c-2.9-.1-3.2-.3-1.3-.6 1.3-.3 3-.9 3.8-1.5zm12.3 83.9c2 0 35.4 3.2 37.3 3.5 3 .6-28.8-.4-34-1.1-2.4-.3-4.3-1-4.3-1.5.1-.5.5-.9 1-.9zm13.2-7.1c13.1 0 29.3 1 55.8 3.4 9.5.9 26.2 2.1 37 2.7 27.3 1.5 29.1 3 3.8 3-13.9 0-29-.7-47.4-2.4-14.9-1.4-34.9-3.1-44.6-3.8-9.7-.7-17.3-1.6-17-2.1.2-.5 5.9-.8 12.4-.8zm12.1-27.1c11.7.9 34.8 2 51.4 2.4 29.8.8 30 .8 16.8 1.6-19.3 1.3-76.6-.9-84.4-3.2-3.2-.9-5.6-1.9-5.4-2.1.1-.1 9.9.4 21.6 1.3zm-15.7-18.4c7.6 1.1 36.6 3.6 41.3 3.6 2.6 0 4.3.3 4 .6-.6.6-46.1-1.4-48.4-2.1-.7-.2-1.2-.9-1.2-1.6 0-.8 1.4-1 4.3-.5zm34.1 9.7c31.6 1.2 47.4 2.3 65.6 4.4l10.7 1.2-6.1.6c-3.4.3-8.9.3-12.2-.2-13.3-1.7-46-4-67.6-4.6-14.5-.4-22.4-1-21.8-1.6.5-.6 11.9-.6 31.4.2zM196 59.7c2.4.2.7.4-3.8.4s-6.5-.2-4.4-.4c2.1-.2 5.8-.2 8.2 0zm13.8 13.9c10 .7 18.4 1.5 18.6 1.8.5.6-10.9 0-29.3-1.4-4.7-.4-8.2-.9-7.9-1.1.2-.3 8.6 0 18.6.7zm71.1-7.6c15.5 1.9 27.5 4.3 31.1 6.1 4.4 2.3-12.4 3.1-23.9 1.1-11.9-2.1-47.2-6.4-60.2-7.5-8.9-.7-6.9-.9 14.8-1.1 18-.1 28.7.2 38.2 1.4zM246 109.7c1.2.2.5.4-1.8.5-2.2 0-3.3-.2-2.3-.4 1-.3 2.9-.3 4.1-.1zm17.5-.3c6.9 0 18.7-.5 26.1-1.1 10.5-.9 14.9-.9 19.6.2 3.4.7 6.2 1.6 6.5 2 .3.4-6.8 1.3-15.6 2-11.9 1-18.9 1-27.2.2-6.2-.6-13.6-1.1-16.6-1.1-3 0-5.3-.5-5.3-1-.1-.8 4.7-1.2 12.5-1.2zm24.1-27.2l6.6 1.5-6.1.1c-3.4.1-10-.5-14.8-1.2l-8.7-1.3 8.2-.3c4.5-.1 11.1.4 14.8 1.2zm8.7 37.4c4.1.4.5.7-10.7.7-15.7 0-16.1 0-6.1-.7 5.9-.3 13.4-.3 16.8 0zm7.3-26.9c11.4 2.5 17.1 4.8 10 4.1-2.3-.3-10.3-1.5-18.1-2.9-14-2.4-14-2.4-8.2-3 4.2-.3 8.9.2 16.3 1.8z'/></svg></button>";
  var nextArrow = "<button type='button' class='slick-next pull-right'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 334.2 190.7'><path opacity='.9' fill='#FFF' d='M330.8 90.3c-1.8-1.7-10.7-7.5-19.6-12.7C255.3 44.5 228 28 208.8 15.3c-12-7.9-22.9-14.6-24.3-15-3.4-.9-7.2.3-8.4 2.5-.6 1.1-1.7 8.1-2.6 15.6-2.3 19.4-1.4 17.7-9.4 19.4-5.4 1.1-7.2 2-7.9 3.7-.9 2-1.5 2.2-5.1 1.7-2.3-.3-15.5-1-29.6-1.6s-32.1-1.5-40.3-2c-20.8-1.3-69.1-1.2-71.5.1-4.7 2.5-1.6 4.6 9.5 6.6l3.9.7-3.3 1.7c-2.7 1.3-3.3 2.2-3.1 4.4l.2 2.8-6.9-.5c-7.6-.5-10.6.6-8.8 3.4.6 1 2.9 2.2 5.1 2.9l4 1.1-4.5.7c-9.2 1.3-7.4 5.3 4 8.8 6.1 1.8 6.4 2.1 3.6 2.7-6.7 1.2-8.2 2-8.2 4s5.5 5.5 10.6 6.9c3 .8 1.6 3.4-2 4.2-6.6 1.3-4.2 6.4 4.6 9.7 3.9 1.5 4.5 2 2.6 2.1-1.4 0-3.6.8-4.8 1.6-1.9 1.3-2 1.9-1.1 4 .6 1.3 2 2.9 3.2 3.4 2.2 1 2.2 1-.4 2-4.5 1.8-5.4 3.6-3.2 6.6 2.6 3.4 7.9 5.4 19.1 7.5 5 .9 10 2 11.1 2.6 1.1.5 6.8 1.1 12.8 1.4 5.9.3 18.4 1.2 28.1 2 9.5.9 30 2.1 45.4 2.8s28.2 1.3 28.4 1.5.7 9.1 1.2 20.1c1.2 27.2 2.9 33.5 8.9 33.5 2.6 0 71.7-34.7 88.5-44.4 5.1-2.9 16.8-10.3 26.1-16.4 9.3-6.1 23-14.6 30.6-18.8 20.3-11.7 22.6-14.7 15.9-21zm-12.3 8.9c-2.6 1.5-5.2 2.7-5.9 2.7-.7 0 .3-.8 2.2-1.8 2.6-1.3 3.7-2.6 3.9-4.6.3-2.5.6-2.7 2.4-1.7 2.8 1.6 2.4 2.6-2.6 5.4zm-7.8-10.5c-1.1-.6-2-1.3-2-1.6 0-.3.9 0 2 .6s2 1.3 2 1.6c.1.3-.9 0-2-.6zm-13.5 22.5c-1.3.8-1.5.6-1.1-1.1.4-1.4 1.3-2 3.2-2 2.8-.1 2.4.4-2.1 3.1zm-2.6-26.1l-2.8-2.9 3.3 2.4c1.8 1.3 3.1 2.6 2.8 2.9-.3.3-1.8-.7-3.3-2.4zm-8.1 31.7c-.8-.8-.3-1.2 2.8-2.1l2.6-.8-2.4 1.7c-1.3 1.1-2.6 1.6-3 1.2zm-12.5-45c-1.7-.9-3.1-1.8-3.1-2.1 0-.3 1.3.2 3.1 1.1s3.1 1.8 3.1 2.1-1.4-.1-3.1-1.1zm-32.9 39c-4.6-.2-.9-.4 8.4-.4s13.1.2 8.4.4c-4.6.2-12.2.2-16.8 0zm3-13.3c-.7-.3-.2-.5 1.3-.5 1.4 0 2 .2 1.3.5s-1.9.3-2.6 0zm-17.2-1.8c-8.4-.8-12.4-1.5-10.6-1.9 3.1-.6 25.4 2 24.6 2.8-.2.2-6.6-.2-14-.9zm11.4-48.9c-.5 0-2.2-1.2-3.8-2.6l-2.9-2.6 3.8 2.2c3.9 2.2 4.7 3 2.9 3zm-11 99.7c-2.1-.2-.4-.4 3.8-.4s5.9.2 3.8.4c-2.1.2-5.4.2-7.6 0zm-21.7-64c-7.5-.4-12.8-.8-11.7-.9 1.1-.1 2.5-.6 3.1-1 .6-.5 5.5-.3 11.7.4 12.4 1.5 11.7 1.3 11.2 1.8-.3.3-6.7.1-14.3-.3zm4.4 53.8c-2.1-.2-.7-.4 3.3-.4s5.7.2 3.8.4c-1.9.2-5 .2-7.1 0zm-3.1-34.7c-1-.3-.2-.5 1.8-.5 1.9 0 2.8.2 1.8.5-1 .2-2.6.2-3.6 0zm-5 61.5c-4.5 0-4.1-.6 1-1.3 2.2-.4 3.5-.2 3.2.4-.3.5-2.2.9-4.2.9zm-6.7-108.8c-5-.5-6.3-1.1-9.6-4.5-3.6-3.7-3.7-3.9-1.5-3.9 1.3 0 5.3 1.8 9.1 4.1s7.2 4.1 7.7 4.1c.6 0 .8.2.5.5-.2.1-3.1 0-6.2-.3zm-19.4 45.5c-10-.1-10.8-.2-6.4-1 4.6-.8 17.9-.3 17.9.7 0 .2-5.2.3-11.5.3zm8.1-73.4c-1 0-1.2-1.1-.8-3.8l.5-3.8.7 3.1c1 4.5 1 4.5-.4 4.5zm-7.1 144.4c-3 .5-3.9.3-4.4-1-.9-2.3-.5-2.5 5-1.9 5.4.7 5.2 1.9-.6 2.9zm-3.6-30.9c-1 .8-1.3.6-1.3-.6s1-1.6 3.8-1.5c2.9.1 3.2.3 1.3.6-1.3.3-3 .9-3.8 1.5zM160.9 56c-2 0-35.4-3.2-37.3-3.5-3-.6 28.8.4 34 1.1 2.4.3 4.3 1 4.3 1.5-.1.5-.5.9-1 .9zm-13.2 7.1c-13.1 0-29.3-1-55.8-3.4-9.5-.9-26.2-2.1-37-2.7-27.3-1.5-29.1-3-3.8-3 13.9 0 29 .7 47.4 2.4 14.9 1.4 34.9 3.1 44.6 3.8 9.7.7 17.3 1.6 17 2.1-.2.5-5.9.8-12.4.8zm-12.1 27.1c-11.7-.9-34.8-2-51.4-2.4-29.8-.8-30-.8-16.8-1.6 19.3-1.3 76.6.9 84.4 3.2 3.2.9 5.6 1.9 5.4 2.1-.1.1-9.9-.4-21.6-1.3zm15.7 18.4c-7.6-1.1-36.6-3.6-41.3-3.6-2.6 0-4.3-.3-4-.6.6-.6 46.1 1.4 48.4 2.1.7.2 1.2.9 1.2 1.6 0 .8-1.4 1-4.3.5zm-34.1-9.7c-31.6-1.2-47.4-2.3-65.6-4.4l-10.7-1.2 6.1-.6c3.4-.3 8.9-.3 12.2.2 13.3 1.7 46 4 67.6 4.6 14.5.4 22.4 1 21.8 1.6-.5.6-11.9.6-31.4-.2zm20.9 32.3c-2.4-.2-.7-.4 3.8-.4s6.5.2 4.4.4c-2.1.2-5.8.2-8.2 0zm-13.8-13.9c-10-.7-18.4-1.5-18.6-1.8-.5-.6 10.9 0 29.3 1.4 4.7.4 8.2.9 7.9 1.1-.2.3-8.6 0-18.6-.7zm-71.1 7.6c-15.5-1.9-27.5-4.3-31.1-6.1-4.4-2.3 12.4-3.1 23.9-1.1 11.9 2.1 47.2 6.4 60.2 7.5 8.9.7 6.9.9-14.8 1.1-18 .1-28.7-.2-38.2-1.4zm34.9-43.7c-1.2-.2-.5-.4 1.8-.5 2.2 0 3.3.2 2.3.4-1 .3-2.9.3-4.1.1zm-17.5.3c-6.9 0-18.7.5-26.1 1.1-10.5.9-14.9.9-19.6-.2-3.4-.7-6.2-1.6-6.5-2s6.8-1.3 15.6-2c11.9-1 18.9-1 27.2-.2 6.2.6 13.6 1.1 16.6 1.1 3 0 5.3.5 5.3 1 .1.8-4.7 1.2-12.5 1.2zm-24.1 27.2l-6.6-1.5 6.1-.1c3.4-.1 10 .5 14.8 1.2l8.7 1.3-8.2.3c-4.5.1-11.1-.4-14.8-1.2zm-8.7-37.4c-4.1-.4-.5-.7 10.7-.7 15.7 0 16.1 0 6.1.7-5.9.3-13.4.3-16.8 0zm-7.3 26.9c-11.4-2.5-17.1-4.8-10-4.1 2.3.3 10.3 1.5 18.1 2.9 14 2.4 14 2.4 8.2 3-4.2.3-8.9-.2-16.3-1.8z'/></svg></button>";
  $('.testimonials_slider').slick({
    dots: false,
    arrows: true,
    slidesToShow: 1,
    adaptiveHeight: true,
    autoplay: false,
    prevArrow: previousArrow,
    nextArrow: nextArrow,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 767,
      settings: {
        arrows: false,
        dots: true
      }
    }]
  });
  $('.event_slider').slick({
    dots: false,
    arrows: true,
    slidesToShow: 1,
    adaptiveHeight: true,
    autoplay: false,
    prevArrow: previousArrow,
    nextArrow: nextArrow,
    slidesToScroll: 1
  });
  $('.comments_slider').slick({
    dots: false,
    arrows: true,
    slidesToShow: 3,
    adaptiveHeight: true,
    autoplay: false,
    prevArrow: previousArrow,
    nextArrow: nextArrow,
    slidesToScroll: 1,
    infinite: false,
    responsive: [{
      breakpoint: 767,
      settings: {
        slidesToShow: 1
      }
    }]
  });
  $('.pic_slider').slick({
    dots: false,
    arrows: true,
    slidesToShow: 1,
    adaptiveHeight: true,
    autoplay: false,
    prevArrow: previousArrow,
    nextArrow: nextArrow,
    slidesToScroll: 1
  });
  $('.o_fit').objectFit({
    objectFit: 'cover',
    objectPosition: 'center',
    replaceElement: '<div />',
    replaceClass: 'o_fit_replaced'
  }); // scroll_block

  $(".scroll_block").mCustomScrollbar({
    theme: "my-theme"
  });
  $("body").on('click', 'a', function (event) {
    if ($(this).attr('href') == "#" || $(this).attr('href') == "") {
      event.preventDefault();
    }
  });
  $('.lang_select_label').on('click', function (event) {
    var th = $(this),
        trgt = $(th.attr('data-target'));
    trgt.toggleClass('opened');
  }); // textarea expand

  $("textarea").on('keyup', function (event) {
    autosize($(this));
  });
  $(".c_acc_block").on('click', '.c_acc_link', function (event) {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $(this).closest('.c_acc_block').removeClass('active');
      $(".c_acc_block_body").slideUp().removeClass('active'); //console.log("active");

      event.preventDefault();
    } else {
      $(".c_acc_block_body").slideUp();
      $(".c_acc_link").removeClass('active');
      $(this).addClass('active');
      $('.c_acc_block').removeClass('active');
      $(this).closest('.c_acc_block').addClass('active').find('.c_acc_block_body').slideDown(); //console.log("not active");

      event.preventDefault();
    }
  });
  $(".header_links_trigger__js").on('click', function (event) {
    event.preventDefault();
    var th = $(this),
        trgt = $(th.attr('href'));
    th.toggleClass('opened');
    trgt.slideToggle(300);
  }); //  fixed menu

  var header = $(".inner_page_header");
  var tempScrollTop = 0;
  var loadCurrentScrollTop = $(document).scrollTop();

  if (loadCurrentScrollTop > 1) {
    header.addClass("moved").removeClass('dark');
  }

  if (bw > 991) {
    $(window).scroll(function () {
      var currentScrollTop = $(document).scrollTop();

      if (currentScrollTop < 1) {
        header.removeClass("moved").addClass('dark');
      } else {
        header.addClass("moved").removeClass('dark');
      }
    });
  }

  $(".calendar_select select").on('selectric-init', function () {
    $(this).closest(".select_wrapper").addClass('changed').attr("data-value", $(this).val());
    filterCalendar($(this).val());
  }); // select 

  $('select').selectric({
    disableOnMobile: false,
    nativeOnMobile: false,
    maxHeight: 150,
    onOpen: function onOpen() {
      $(this).closest('.select_wrapper').addClass('opened');
      $(this).parent().next().next().find(".selectric-scroll").mCustomScrollbar({
        theme: "my-theme"
      });
    },
    onClose: function onClose() {
      $(this).closest('.select_wrapper').removeClass('opened');
    }
  }).on('change', function () {
    $(this).closest(".select_wrapper").addClass('changed').attr("data-value", $(this).val());
  });
  $(".calendar_select select").on('change', function () {
    filterCalendar($(this).val());
  });

  function filterCalendar(key) {
    var result = calendarData.filter(function (x) {
      return x.month === key;
    });
    $(".calendar__js").attr('data-from', 0);
    $(".acalendar_arrow_next").removeClass('disabled');
    $(".acalendar_arrow_prev").addClass('disabled');
    calendarBuilder(result);
  }

  function calendarBuilder(data) {
    var calendarWrapper = $(".calendar__js"),
        calendarFrom = parseInt(calendarWrapper.attr('data-from')),
        calendarStep = parseInt(calendarWrapper.attr('data-step'));

    if (calendarFrom < 0) {
      calendarFrom = 0;
    }

    if (parseInt(calendarWrapper.attr('data-from')) > 0) {
      $(".acalendar_arrow_prev").removeClass('disabled');
    } else {
      $(".acalendar_arrow_prev").addClass('disabled');
    }

    if (data.length > calendarStep) {
      $(".acalendar_arrows").addClass('showed');
    } else {
      $(".acalendar_arrows").removeClass('showed');
    }

    var loadArr = data.slice(calendarFrom, calendarFrom + calendarStep);
    calendarWrapper.attr('data-from', calendarFrom + calendarStep);

    if (data.length <= parseInt(calendarWrapper.attr('data-from'))) {
      $(".acalendar_arrow_next").addClass('disabled');
    }

    if (calendarWrapper.hasClass('slick-initialized')) {
      calendarWrapper.slick('destroy');
    }

    calendarWrapper.empty();

    for (var i = 0; i < loadArr.length; i++) {
      var arrObj = loadArr[i],
          arrObjDay = arrObj.day,
          arrObjDate = arrObj.date,
          arrObjFullDate = arrObj.fullDate,
          arrObjMonth = arrObj.month,
          arrObjTimestamps = arrObj.timestamps,
          timeMarkup = '';

      for (var t = 0; t < arrObjTimestamps.length; t++) {
        var timeStamp = arrObjTimestamps[t],
            timeLine = timeStamp.time,
            isOrdered = timeStamp.ordered,
            orderedClass = ' ';

        if (isOrdered) {
          orderedClass = ' reserved';
        }

        timeMarkup += '<li class="td time"><a class="game_time' + orderedClass + '" href="#order_modal" data-date="' + arrObjFullDate + '" data-time="' + timeLine + '">' + timeLine + '</a></li>';
      }

      var calendarRow = '<div class="calendar__body_row"><div class="calendar_row_table"><ul class="tr"><li class="td date"><div class="td_date">' + arrObjDate + ' ' + arrObjMonth + '</div><div class="td_date_day">' + arrObjDay + '</div></li>  ' + timeMarkup + '</ul></div></div>  ';
      calendarWrapper.append(calendarRow);
    }

    if (window.innerWidth < 768 && !calendarWrapper.hasClass('slick-initialized') == true) {
      calendarWrapper.slick({
        mobileFirst: true,
        infinite: false,
        dots: false,
        arrows: true,
        slidesToShow: 1,
        autoplay: false,
        slidesToScroll: 1,
        responsive: [{
          breakpoint: 768 - 1,
          settings: 'unslick'
        }]
      });
    }
  }

  $(window).on('resize', function () {
    if (window.innerWidth < 768 && !$(".calendar__js").hasClass('slick-initialized') == true) {
      $(".calendar__js").slick({
        mobileFirst: true,
        infinite: false,
        dots: false,
        arrows: true,
        slidesToShow: 1,
        autoplay: false,
        slidesToScroll: 1,
        responsive: [{
          breakpoint: 768 - 1,
          settings: 'unslick'
        }]
      });
    }
  });
  $('.acalendar_arrows').on('click', '.acalendar_arrow', function (event) {
    event.preventDefault();
    var th = $(this),
        data = calendarData,
        month = $('.calendar_select').attr('data-value');

    if (th.hasClass('acalendar_arrow_next')) {
      var result = calendarData.filter(function (x) {
        return x.month === month;
      });
      $(".acalendar_arrow_prev").removeClass('disabled');
      calendarBuilder(result);
    } else {
      var _result = calendarData.filter(function (x) {
        return x.month === month;
      });

      var calendarWrapper = $(".calendar__js"),
          calendarFrom = parseInt(calendarWrapper.attr('data-from')),
          calendarStep = parseInt(calendarWrapper.attr('data-step'));
      $(".acalendar_arrow_next").removeClass('disabled');
      $(".calendar__js").attr('data-from', calendarFrom - calendarStep - calendarStep);
      calendarBuilder(_result);
    }
  });
  $(".calendar__js").on('click', 'a.game_time', function (event) {
    event.preventDefault();
    var th = $(this),
        trgt = th.attr('href'),
        time = th.attr('data-time'),
        date = th.attr('data-date');
    $(trgt).find('.order_time').val(time);
    $(trgt).find('.order_date').val(date);
    $(trgt).find('.cmh_el__time').text(time);
    $(trgt).find('.cmh_el__date').text(date);
    $.fancybox.open({
      src: trgt,
      touch: false,
      baseClass: 'order_popup',
      beforeShow: function beforeShow() {
        $('body').addClass('order_open');
        $('.header').addClass('non_transition');
      },
      afterClose: function afterClose() {
        $('body').removeClass('order_open');
        setTimeout(function () {
          $('.header').removeClass('non_transition');
        }, 300);
      }
    });
  });
});
/* -------------------------------------------------------- */

/*  END OF DOCUMENT READY
/* -------------------------------------------------------- */
// textarea

function autosize(ths) {
  var el = ths;
  setTimeout(function () {
    el.css('height', el.prop('scrollHeight') + 'px');
  }, 10);
}

var fullPageCreated = false;
var change = true;
$(window).on('load resize', function () {
  if ($('#fullpage').length) {
    var sectLen = $('#fullpage').find('>*').length;

    if (window.innerWidth > 991) {
      if (fullPageCreated == false) {
        $('#fullpage').fullpage({
          slidesNavigation: false,
          loopHorizontal: false,
          navigation: false,
          lockAnchors: true,
          controlArrows: false,
          dragAndMove: true,
          easingcss3: 'cubic-bezier(0.49, 0.01, 0.27, 1)',
          scrollingSpeed: 1000,
          afterLoad: function afterLoad(currentSection, anchorLink, sectionIndex) {
            setTimeout(function () {
              change = true;
            }, 300);
          },
          onLeave: function onLeave(origin, destination, direction) {
            console.log(destination);

            if (direction == 'up') {
              var th = $(this),
                  hFrame = $('.header_main_frame');

              if (!th.prev().hasClass('dark_bg')) {
                hFrame.addClass('invert');
              } else {
                hFrame.removeClass('invert');
              }
            } else {
              var _th = $(this),
                  _hFrame = $('.header_main_frame');

              if (!_th.next().hasClass('dark_bg')) {
                _hFrame.addClass('invert');
              } else {
                _hFrame.removeClass('invert');
              }
            }

            if (destination == 1) {
              if ($('#fullpage').find('.section').eq(destination - 1).hasClass('section-head')) {
                $(".header_main_frame").addClass('first_screen__js');
              }
            } else {
              $(".header_main_frame").removeClass('first_screen__js');
            }

            if (destination == sectLen) {
              $(".header_main_frame").addClass('on_footer__js');
            } else {
              $(".header_main_frame").removeClass('on_footer__js');
            }
          },
          afterRender: function afterRender() {
            var firstScreen = $(this).find('>*:first-child');

            if (firstScreen.hasClass('section-head')) {
              $(".header_main_frame").addClass('first_screen__js');
            }

            $('body').addClass('fp_inited');
          }
        });
        fullPageCreated = true;
      }
    } else {
      if (fullPageCreated == true) {
        $.fn.fullpage.destroy('all');
        fullPageCreated = false;
      }
    }
  }
});

function mapBuilder() {
  if ($("#map").length > 0) {
    var mapElement = document.getElementById('map'),
        map1Latitude = mapElement.getAttribute('data-latitude'),
        map1Longtitude = mapElement.getAttribute('data-longitude');
    var mapOptions = {
      center: new google.maps.LatLng(map1Latitude, map1Longtitude),
      zoom: 16,
      zoomControl: true,
      zoomControlOptions: {
        style: google.maps.ZoomControlStyle.DEFAULT
      },
      disableDoubleClickZoom: true,
      mapTypeControl: false,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
      },
      scaleControl: false,
      scrollwheel: false,
      panControl: false,
      streetViewControl: false,
      draggable: true,
      overviewMapControl: false,
      fullscreenControl: false,
      overviewMapControlOptions: {
        opened: false
      },
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var sb_map = new google.maps.Map(mapElement, mapOptions);
    var locations = [['', 'undefined', 'undefined', 'undefined', 'undefined', map1Latitude, map1Longtitude, '']];
    var description, telephone, email, web, markericon;

    for (var i = 0; i < locations.length; i++) {
      if (locations[i][1] == 'undefined') {
        description = '';
      } else {
        description = locations[i][1];
      }

      if (locations[i][2] == 'undefined') {
        telephone = '';
      } else {
        telephone = locations[i][2];
      }

      if (locations[i][3] == 'undefined') {
        email = '';
      } else {
        email = locations[i][3];
      }

      if (locations[i][4] == 'undefined') {
        web = '';
      } else {
        web = locations[i][4];
      }

      if (locations[i][7] == 'undefined') {
        markericon = '';
      } else {
        markericon = locations[i][7];
      }

      var marker = new google.maps.Marker({
        icon: markericon,
        position: new google.maps.LatLng(locations[i][5], locations[i][6]),
        map: sb_map,
        title: locations[i][0],
        desc: description,
        tel: telephone,
        email: email,
        web: web
      });
      var link = '';
    }
  }
}

$(window).on('load', function () {
  if ($(".map").length) {
    mapBuilder();
  }
});