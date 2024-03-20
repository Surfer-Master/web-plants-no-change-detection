import "./bootstrap";
import "flowbite";

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function () {
    $(document).on("click", "a.page-scroll", function (event) {
        var $anchor = $(this);
        $("html, body")
            .stop()
            .animate(
                {
                    scrollTop: $($anchor.attr("href")).offset().top,
                },
                600,
                "easeInOutExpo",
            );
        event.preventDefault();
    });
});

// Back To Top Button
var amountScrolled = 100;
$(window).scroll(function () {
    if ($(window).scrollTop() > amountScrolled) {
        $("a.back-to-top").removeClass("hidden");
        $("a.back-to-top").addClass("flex");
        $("a.back-to-top").fadeIn("500");
    } else {
        $("a.back-to-top").fadeOut("500");
    }
});
