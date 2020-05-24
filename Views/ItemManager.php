<?php
    require_once('../Model/Utils.php');

    Other::Verify();

    $conn = DBHAndler::connectDB(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Item Manager</title>
    <link rel="stylesheet" type="text/css" href="../Assets/ManagerStyle.css">
</head>

<body>
    <div id="workSpace">
        <div class="form_header">
            <div class="logo"></div>
            <div class="aux">
                <p class="h bright" id="form_title"></p>
                <button class="home_btn">home</button>
            </div>
        </div>

        <form action="../Model/Response.php" method="POST" enctype="multipart/form-data">
            <div class="menu">
                <label for="add">Add</label>
                <input type="radio" id="add" name="operation" value="add" checked="checked">
                
                <label for="remove">Remove</label>
                <input type="radio" id="remove" name="operation" value="remove"> 
            </div>
        
            <div class="selection_table" id="st_car">
                    <?php
                        $res = DBHandler::getElements('car', $conn);

                        if ($res->num_rows > 0) {
                            while($row = $res->fetch_assoc())
                            {
                    ?>

                    <div class="record">
                        <div class="record_item">
                            <p class="blue">ID</p>
                            <p class="bright nr"><?php echo $row["car_id"]; ?></p>
                        </div>
                        <div class="record_item">
                            <p class="blue">Brand</p>
                            <p class="bright"><?php echo $row["brand"]; ?></p>
                        </div>
                        <div class="record_item">
                            <p class="blue">Model</p>
                            <p class="bright"><?php echo $row["model"]; ?></p>
                        </div>
                        <div class="record_item">
                            <p class="blue">Distance</p>
                            <p class="bright"><?php echo $row["distance"]; ?></p>
                        </div>
                    </div>

                    <?php 
                        }   
                    }
                    ?> 
            </div>

            <div class="fillArea_car">
                <div class="FormItem">
                    <label for="brand">Brand:</label>
                    <input type="text" id="brand" name="brand">
                </div>
                <div class="FormItem">
                    <label for="model">Model:</label>
                    <input type="text" id="model" name="model">
                </div>
                <div class="FormItem">
                    <label for="engine">Engine:</label>
                    <input type="text" id="engine" name="engine">
                </div>
                <div class="FormItem">
                    <label for="distance">Distance:</label>
                    <input type="number" id="distance" name="distance" placeholder="km" min=0>
                </div>
                <div class="FormItem">
                    <label for="drivetype">Drive type:</label>
                    <input type="text" id="drivetype" name="drivetype">
                </div>
                <div class="FormItem">
                    <label for="fueltype">Fuel type:</label>
                    <input type="text" id="fueltype" name="fueltype">
                </div>
                <div class="FormItem">
                    <label for="exterior">Exterior:</label>
                    <input type="text" id="exterior" name="exterior" placeholder="color">
                </div>
                <div class="FormItem">
                    <label for="interior">Interior:</label>
                    <input type="text" id="interior" name="interior" placeholder="color">
                </div>
                <div class="FormItem">
                    <label for="price">Price:</label>
                    <input type="number" id="price"  name="price" placeholder="eur" min=0>
                </div>
                <div class="FormItem">
                    <label for="image1">Image1:</label>
                    <input type="file" class="images_in" name="image1" accept="image/png, image/jpg, image/jpeg">
                </div>
                <div class="FormItem">
                    <label for="image2">Image2:</label>
                    <input type="file" class="images_in" name="image2" accept="image/png, image/jpg, image/jpeg">
                </div>
            </div>

            <div class="selection_table" id="st_opinion">
                    <?php
                        $res = DBHandler::getElements('opinion', $conn);

                        if ($res->num_rows > 0) {
                            while($row = $res->fetch_assoc())
                            {
                    ?>

                    <div class="record" id="op">
                        <div class="record_item">
                            <p class="blue">ID</p>
                            <p class="bright"><?php echo $row["op_id"]; ?></p>
                        </div>
                        <div class="record_item">
                            <p class="blue">Text</p>
                            <p class="bright"><?php echo $row["optext"]; ?></p>
                        </div>
                        <div class="record_item">
                            <p class="blue">Author</p>
                            <p class="bright"><?php echo $row["author"]; ?></p>
                        </div>
                    </div>

                    <?php 
                        }   
                    }
                    ?>
                </div>


            <div class="fillArea_opinion">
                <div class="FormItem">
                    <label for="opinion">Opinion:</label>
                    <input type="text" id="opinion" name="opinion" placeholder="Opinion text">
                </div>
                <div class="FormItem">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" placeholder="Name of the author">
                </div>
            </div>

            <label for="remove_id">ID:</label>
            <input type="number" id="remove_id" name="remove_id" min=0>
            
            <div class="FormItem" id="form_buttons">
                <input type=submit name="do_op" value="Do operation">
            </div>
        </form>
    </div>
</body>

<script src="../Assets/jquery-3.4.1.min.js"></script>
<script src="../Assets/ManagerScript.js"></script>
<script src="../Assets/Controller.js"></script>

</html>