(function ($) {
  // Whole-script strict mode syntax
  "use strict";
  var WindowHeight = $(window).height(),
    WindowWidth = $(window).width(),
    __this = $(this);

  $(window).on("scroll", function (e) {});

  // Window Load Function
  $(window).on("scroll", function () {
    var documentHeight = $(document).height();
    var scrollableHeight = documentHeight / 1.7;
    var Content = $(".tecxoo-to-top");
    if (Content.length > 0) {
      $(".tecxoo-to-top").hide();
      if ($(this).scrollTop() > scrollableHeight) {
        $(".tecxoo-to-top").show();
      } else {
        $(".tecxoo-to-top").hide();
      }
    }
    if ($(".tecxoo-sticky-element").length > 0) {
      if (
        $(this).scrollTop() > WindowHeight &&
        $(this).scrollTop() < documentHeight - WindowHeight
      ) {
        $(".tecxoo-sticky-element").fadeIn();
      } else {
        $(".tecxoo-sticky-element").fadeOut();
      }
    }
  });

  var mobileButton = $("#mobileButton");
  if (mobileButton.length) {
    document.getElementById("mobileButton").onclick = function () {
      if (navbarSupportedContent.classList.contains("active")) {
        document
          .getElementById("navbarSupportedContent")
          .classList.remove("active");
      } else {
        document
          .getElementById("navbarSupportedContent")
          .classList.add("active");
      }
    };
  }

  (function ($) {
    $("ul li").hover(
      function () {
        $(this).addClass("wpacc-hover");
      },
      function () {
        $(this).delay("250").removeClass("wpacc-hover");
      }
    );

    $("ul li a").on("focus blur", function () {
      $(this).parents("li").toggleClass("wpacc-hover");
    });
  })(jQuery);

  $(window).load(function () {
    $(".preloader").fadeOut(500);
    $(".preloader-bg").delay("500").fadeOut(1000);


  });
  $(".sidebar").stick_in_parent({
        offset_top: 10
    });

 

  $(".tecxoo-to-top").on("click", function (e) {
    $("html, body").animate({ scrollTop: 0 }, 1000);
    return false;
  });
})(jQuery);
