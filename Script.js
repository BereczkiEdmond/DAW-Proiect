$(document).ready(function(){
    $("#screens").owlCarousel(
        {
            items: 2,
            margin: 4,
            loop: true,
            mouseDrag: false,
            dots: true,
            dotsEach: 2,
        }
    );

    $("#quoteArea").owlCarousel(
        {
            items: 1,
            mouseDrag: false,
            dots: true,
            autoHeight: true,
        }
    );
  });