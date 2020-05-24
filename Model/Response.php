<?php
    require_once('../Model/Utils.php');

    $message = 'Success!';
    $type = 'success';

    $conn = DBHandler::connectDB(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);
    
    if ($conn->connect_errno)
    { 
        $message = "Connection failed: " . $conn->connect_error;
        $type = 'problem';
    }

    $r = true;

    if(isset($_POST['operation']))
    {
    if ($_POST['operation'] == "add")
    {
        if(isset($_POST['brand']))
        {
            $img1 = "../Assets/Images/CarImg/Unknown.png";
            $img2 = "../Assets/Images/CarImg/Unknown.png";

            if($_FILES['image1']['name'] != '')
            {
                $img1 = "../Assets/Images/CarImg/" . $_FILES['image1']['name'];
                Other::FileUpload('image1');
            }

            if($_FILES['image2']['name'] != '')
            {
                $img2 = "../Assets/Images/CarImg/" . $_FILES['image2']['name'];
                Other::FileUpload('image2');
            }
                

            $items = array($_POST['brand'], $_POST['model'], $_POST['engine'],
            $_POST['distance'], $_POST['drivetype'], $_POST['fueltype'],
            $_POST['exterior'], $_POST['interior'], $_POST['price'],
            $img1, $img2);
            
            $r = DBHandler::Add('car', $items, $conn);

            $res = DBHandler::getElements('subscriber', $conn);

            if ($res->num_rows > 0) {
                while($row = $res->fetch_assoc())
                {
                    MailHandler::Send_News($row['mail_address']);
                }
            }

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

    else  if($_POST['operation'] == "remove")
    {
        $items = array($_POST['remove_id']);

        if(isset($_POST['brand']))
        {  
            $r = DBHandler::Remove('car', $items, $conn);
        }
        else if(isset($_POST['opinion']))
        {   
            $r = DBHandler::Remove('opinion', $items, $conn);
        }

        if($r == false)
        {
            $message = "Remove operation failure!";
            $type = 'problem';
        }
    }
    }

    else if (isset($_POST['password']))
    {
        $r = DBHandler::Check($_POST['username'], $_POST['password'], $conn);

        if($r == false)
        {
            $message = "Username or password incorrect!";
            $type = 'problem';
        }
        else
        {
            session_start();
            $_SESSION['u'] = $_POST['username'];
            $_SESSION['pw'] = $r; // hash code for password in database
        }
    }

    else if(isset($_POST['email_address']))
    {
        $items = array($_POST['email_address']);
        $r = DBHandler::Add('mail', $items, $conn);

        if($r == false)
        {
            $message = "Failed to subscribe!";
            $type = 'problem';
        }
        else
        {
            $r = MailHandler::Send_Welcome($_POST['email_address']);
            if($r == false)
            {
                $message = "Failed to send message!";
                $type = 'problem';
            }
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
            <button class="home_btn">home</button>
        </div>
    </body>
    <script src="../Assets/jquery-3.4.1.min.js"></script>
    <script src="../Assets/Controller.js"></script>
</html>