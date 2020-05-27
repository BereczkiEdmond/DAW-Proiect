$(document).ready(function(){
    
    $("#login_btn").click(function(){
        window.location.replace("../Views/Login.html");
    });

    $("#b1").click(function(){
        localStorage.setItem('option','Car');
        window.location.replace("../Views/ItemManager.php");
    });

    $("#b2").click(function(){
        localStorage.setItem('option','Opinion');
        window.location.replace("../Views/ItemManager.php");
    });

    $("#UpSide").owlCarousel(
        {
            items: 1,
            loop: true,
            mouseDrag: false,
            dotsContainer: "#d1",
        }
    );

    $("#screens").owlCarousel(
        {
            items: 2,
            margin: 4,
            loop: true,
            mouseDrag: false,
            dots: true,
            dotsEach: 2,
            dotsContainer: "#d1",
        }
    );

    $("#quoteArea").owlCarousel(
        {
            items: 1,
            loop: true,
            mouseDrag: false,
            dots: true,
            autoHeight: true,
            dotsContainer: "#d2",
        }
    );
});