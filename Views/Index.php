<!DOCTYPE html>
<html>

<?php
    require_once('../Model/Utils.php');

    $conn = DBHandler::connectDB(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);

    session_start();
    if(!isset($_SESSION['u']) || !isset($_SESSION['pw']))
        $login_text = 'Not logged in.';
    else
        $login_text = 'Logged in as:<br>' . $_SESSION['u'];
?>


<head>
    <title>DAW Proiect</title>
    <link rel="stylesheet" type="text/css" href="../Assets/Style_css/IndexStyle.css">
    <link rel="stylesheet" href="../Assets/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../Assets/owlcarousel/owl.theme.default.min.css">
</head>

<body>
    <div id="main">

        <div id="header">
            <div class="container">
                <div id="LSide1">
                    <div class="logo"></div>
                    <div class="mid_panel">
                        <p class="t dark"><?php echo $login_text; ?></p>
                        <button id="login_btn">Log in</button>
                    </div>
                    <div class="phone"></div>
                </div>

                <div id="RSide1">
                    <div id="headerInfo">
                        <div id="buttons">
                            <button id="b1">manage cars</button>
                            <button id="b2">manage opinions</button>
                        </div>

                        <h1 class="h dark">About the company</h1>

                        <p class="t bright"> The Nord Company is Europe's leading
                            second-hand car shop, because of it's trusted partners
                            who provide us a wide variety of car models with good quality of course.
                        </p>
                    </div>
                    <div id="playBtn"></div>
                </div>
            </div>
        </div>

        <div id="about">
            <div class="container">
                <div id="UpSide" class="owl-carousel owl-theme">
                <div class="owl-stage-outer">
                <div class="owl-stage">
                    <?php
                        $res = DBHandler::getElements('car', $conn);

                        if ($res->num_rows > 0) {
                            while($row = $res->fetch_assoc())
                            {
                    ?>
                    <div class="owl-item">
                        <h1 class="h bright"><?php echo $row["brand"].' '.$row["model"]; ?></h1>
                        <p class="t bright">
                            <?php
                                echo "Engine: ".$row["engine"]."<br>";
                                echo "Distance: ".$row["distance"]." km<br>";
                                echo "Drive type: ".$row["drive_type"]."<br>";
                                echo "Fuel type: ".$row["fuel_type"]."<br>";
                                echo "Exterior: ".$row["exterior"]."<br>";
                                echo "Interior: ".$row["interior"]."<br>";
                                echo "Price: ".$row["price"]." Eur<br>";
                            ?>
                        </p>
                    </div>
                    <?php 
                            }   
                        }
                    ?>
                    </div>
                    </div>
                </div>

                <div id="DownSide">
                    <div id="screens" class="owl-carousel owl-theme">
                        <?php
                            $res = DBHandler::getElements('car', $conn);

                            if ($res->num_rows > 0) {
                                while($row = $res->fetch_assoc())
                                {
                        ?>
                                    <div class="scr">
                                        <img class="car_image" src="<?php echo $row["image1"]; ?>" alt="Car image"/>
                                    </div>

                                    <div class="scr">
                                        <img class="car_image" src="<?php echo $row["image2"]; ?>" alt="Car image"/>
                                    </div>
                        <?php 
                                }   
                            }
                        ?>
                    </div>
                </div>
                <div id="d1" class="super-dots"></div>
            </div>
        </div>

        <div id="quote1">
            <div class="container">

                <div class="titleBox">
                    <h1 class="h bright">Opinions</h1>
                    <p class="t dark">For us it's important what
                        our customers think about us, se here you can see
                        some of them.
                    </p>
                </div>

                <div id="bottomBox">
                    <div class="phone"></div>
                    <div id="triangle"></div>
                    <div id="coating">
                        <div id="quoteArea" class="owl-carousel owl-theme">
                            <div class="quote">
                                <div class="QMU"></div>
                                <div class="owl-stage-outer">
                                    <div class="owl-stage">
                                    <?php
                                        $res = DBHandler::getElements('opinion', $conn);

                                        if ($res->num_rows > 0) {
                                            while($row = $res->fetch_assoc())
                                            {
                                    ?>
                                                <div class="QText owl-item">
                                                    <p class="t dark"><?php echo $row["optext"]; ?></p>
                                                    <p class="t blue"><?php echo $row["author"]; ?></p>
                                                </div>
                                    <?php 
                                            }      
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="QMD"></div>
                            </div>     
                        </div>
                        <div id="d2" class="super-dots"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="joinUs">
        <div class="container">
            <div class="titleBox">
                <h1 class="h bright">Join us</h1>
                <p class="t bright">We will send you from time to time
                    mail about our new and offers
                </p>
            </div>
            <form id="mailBox" method="POST" action="../Model/Response.php">
                <input class="t mar" name="email_address" type="email" pattern="^[a-z|A-Z|0-9]+[@][a-z]+[.]([a-z]{2,3})$" placeholder="Your Mail">
                <button id="b4" class="mar">send</button>
            </form>

        </div>
    </div>

    <div id="footer">
        <div class="container">
            <div id="items">
                <div class="logo"></div>
                <div id="AllRightsText"></div>
            </div>
        </div>
    </div>

    </div>
</body>

<script src="../Assets/Script/jquery-3.4.1.min.js"></script>
<script src="../Assets/owlcarousel/owl.carousel.min.js"></script>
<script src="../Assets/Script/Script.js"></script>
</html>