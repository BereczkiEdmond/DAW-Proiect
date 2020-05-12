<?php
    require_once('../Model/Utils.php');

    $message = 'Success!';
    $type = 'success';

    define("DB_SERVER", "localhost");
    define("DB_USER", "work");
    define("DB_PASSWORD", "secret8");
    define("DB_DATABASE", "daw");
    define("DB_PORT", 3308);

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);
    
    if ($conn->connect_errno)
    { 
        $message = "Connection failed: " . $conn->connect_error;
        $type = 'problem';
    }

    $r = true;

    if (isset($_POST['add']))
    {
        if(isset($_POST['brand']))
        {
            $items = array($_POST['brand'], $_POST['model'], $_POST['engine'],
            $_POST['distance'], $_POST['drivetype'], $_POST['fueltype'],
            $_POST['exterior'], $_POST['interior'], $_POST['price'],
            $_POST['image1'], $_POST['image2']);
            
            $r = DBHandler::Add('car', $items, $conn);
        }
        else if(isset($_POST['opinion']))
        {   
            $items = array($_POST['opinion'], $_POST['author']);
            $r = DBHandler::Add('opinion', $items, $conn);
        }

        if($r == false)
        {
            $message = "Add operation failure!";
            $type = 'problem';
        }
    }

    else  if(isset($_POST['modify']))
    {
        // available only for car option
        $items = array($_POST['brand'], $_POST['model'], $_POST['engine'],
        $_POST['distance'], $_POST['drivetype'], $_POST['fueltype'],
        $_POST['exterior'], $_POST['interior'], $_POST['price'],
        $_POST['image1'], $_POST['image2']);

        $r = DBHAndler::Modify('car', $items, $conn);

        if($r == false)
        {
            $message = "Modify operation failure!";
            $type = 'problem';
        }
    }

    else  if(isset($_POST['remove']))
    {
        if(isset($_POST['brand']))
        {
            $items = array($_POST['brand'], $_POST['model'], $_POST['engine'],
            $_POST['distance'], $_POST['drivetype'], $_POST['fueltype'],
            $_POST['exterior'], $_POST['interior'], $_POST['price'],
            $_POST['image1'], $_POST['image2']);
            
            $r = DBHandler::Remove('car', $items, $conn);
        }
        else if(isset($_POST['opinion']))
        {   
            $items = array($_POST['opinion'], $_POST['author']);
            $r = DBHandler::Remove('opinion', $items, $conn);
        }

        if($r == false)
        {
            $message = "Remove operation failure!";
            $type = 'problem';
        }
    }
?>

<html>
    <head>
        <title>Response</title>
        <link rel="stylesheet" type="text/css" href="../Assets/ResponseStyle.css">
    </head>
    <body class="<?php echo $type; ?>">
        <div class="response_panel">
            <p class="t m"><?php echo $message; ?></p>
            <button class="back_btn">Back to homepage</button>
        </div>
    </body>
    <script src="../Assets/jquery-3.4.1.min.js"></script>
    <script src="../Assets/ResponseScript.js"></script>
</html>