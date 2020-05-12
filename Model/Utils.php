<?php
    class DBHandler{  
        public static function connectDB($host, $username, $password, $database)
        {
            $conn = new mysqli($host, $username, $password, $database);
            return $conn;
        }

        public static function Add($option, $items, $conn)
        {
            switch($option)
            {
                case 'car':
                    $res = $conn->query(
                        "INSERT INTO car(brand, model, engine, distance, drive_type, fuel_type, exterior, interior, price, image1, image2)
                         VALUES ('$items[0]', '$items[1]', '$items[2]', '$items[3]', '$items[4]', '$items[5]', '$items[6]', '$items[7]', '$items[8]', '$items[9]', '$items[10]')");
                break;
                case 'opinion':
                    $res = $conn->query("INSERT INTO opinion(optext, author) VALUES ('$items[0]', '$items[1]')");
                break;
            }

            return $res;
        }

        public static function Modify($option, $items, $conn)
        {
            // car change with given brand and model
            switch($option)
            {
                case 'car':
                    $res = $conn->query("UPDATE $option SET
                    engine = '$items[2]', distance = '$items[3]',
                    drive_type = '$items[4]', fuel_type = '$items[5]',
                    exterior = '$items[6]', interior = '$items[7]',
                    price = '$items[8]', image1 = '$items[9]',
                    image2 = '$items[10]'
                     WHERE brand = '$items[0]' AND brand = '$items[1]'");
                break;
            }

            return $res;
        }

        public static function Remove($option, $items, $conn)
        {
            switch($option)
            {
                case 'car':
                    $res = $conn->query("DELETE FROM $option WHERE brand = '$items[0]' AND model = '$items[1]'");
                break;
                case 'opinion':
                    $res = $conn->query("DELETE FROM $option WHERE optext = '$items[0]' AND author = '$items[1]'");
                break;
            }

            return $res;
        }

        public static function getElements($option, $conn)
        {
            $res = $conn->query("SELECT * FROM $option");
            return $res;
        }
    }
?>