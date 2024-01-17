

// profit chart start


// profit chart end

// administator start
$(".browser-used  li ").on("click", function (e) {
  $(".browser-used  li").removeClass("active");
  $(this).addClass("active");
});



// Items-Slider Slick Slider

$(document).ready(function () {
  $(".items-slider").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    infinite: true,
    autoplaySpeed: 1000,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 421,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
});
