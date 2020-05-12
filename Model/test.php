<?php
    require_once('Utils.php');
    
    define("DB_SERVER", "localhost");
    define("DB_USER", "work");
    define("DB_PASSWORD", "secret8");
    define("DB_DATABASE", "daw");
    define("DB_PORT", 3308);

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE, DB_PORT);
    if ($conn->connect_errno)
        echo "Connection failed: " . $conn->connect_error;
    
    $res = DBHandler::getElements('opinion', $conn);

    var_dump($res);
    if ($res->num_rows > 0) {
        // output data of each row
        while($row = $res->fetch_assoc())
            echo $row["Author"];
    }
?>