(function ($) {
  "use strict";

  $(window).on("load", function () {
    $("#pageLoader").fadeOut(250);
  });

  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 20) {
      $("#siteNav").addClass("scrolled");
    } else {
      $("#siteNav").removeClass("scrolled");
    }
  }).trigger("scroll");

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        $(entry.target).addClass("visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  $(".reveal").each(function () {
    observer.observe(this);
  });

  $(".filter-btn").on("click", function () {
    const filter = $(this).data("filter");
    $(".filter-btn").removeClass("active");
    $(this).addClass("active");

    if (filter === "all") {
      $(".project-item").fadeIn(220);
      return;
    }

    $(".project-item").each(function () {
      const categories = $(this).data("category").toString();
      categories.includes(filter) ? $(this).fadeIn(220) : $(this).fadeOut(160);
    });
  });

  $(".back-to-top").on("click", function (e) {
    const href = $(this).attr("href");
    if (href === "#top") {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, 500);
    }
  });
})(jQuery);
