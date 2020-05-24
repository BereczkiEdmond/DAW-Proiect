<?php
    require_once('../Composer/vendor/autoload.php');
    use PHPMailer\PHPMailer\PHPMailer;

    define("DB_SERVER", "localhost");
    define("DB_USER", "work");
    define("DB_PASSWORD", "secret8");
    define("DB_DATABASE", "daw");
    define("DB_PORT", 3308);


    class DBHandler{  
        public static function connectDB($host, $username, $password, $database, $dbport)
        {
            $conn = new mysqli($host, $username, $password, $database, $dbport);
            return $conn;
        }

        public static function Add($option, $items, $conn)
        {
            switch($option)
            {
                case 'car':
                    $q = $conn->prepare("INSERT INTO car(brand, model, engine, distance, drive_type, fuel_type, exterior, interior, price, image1, image2) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                    $q->bind_param("sssissssiss", $items[0], $items[1], $items[2], $items[3], $items[4], $items[5], $items[6], $items[7], $items[8], $items[9], $items[10]);
                    $res = $q->execute();
                break;
                case 'opinion':
                    $q = $conn->prepare("INSERT INTO opinion(optext, author) VALUES (?,?)");
                    $q->bind_param("ss", $items[0], $items[1]);
                    $res = $q->execute();
                break;
                case 'mail':
                    $q = $conn->prepare("INSERT INTO subscriber(mail_address) VALUES (?)");
                    $q->bind_param("s", $items[0]);
                    $res = $q->execute();
                break;
            }

            return $res;
        }

        public static function Remove($option, $items, $conn)
        {
            switch($option)
            {
                case 'car':
                    $res = $conn->query("DELETE FROM $option WHERE car_id = '$items[0]'");
                break;
                case 'opinion':
                    $res = $conn->query("DELETE FROM $option WHERE op_id = '$items[0]'");
                break;
            }

            return $res;
        }

        public static function Check($user, $pw, $conn)
        {
            $res = $conn->query("SELECT people_passw FROM user_data WHERE people_user = '$user'");
            
            if ($res->num_rows > 0) {
                while($row = $res->fetch_assoc())
                {
                    $hash = $row['people_passw'];
                    if(password_verify($pw, $hash))
                        return $hash;
                }
           }
             
            return false;
        }

        public static function getElements($option, $conn)
        {
            $res = $conn->query("SELECT * FROM $option");
            return $res;
        }
    }

    class MailHandler{
        public static function Send_Welcome($destination_address)
        {
            $m = new PHPMailer();
            $m->From = "nord-daw-proiect@test.com";
            $m->FromName = "Nord Team";

            $m->isSMTP();
            $m->Host = 'smtp.mailtrap.io';
            $m->SMTPAuth = true;
            $m->Username = '6d1b09506dd382';
            $m->Password = 'b756369093cc63';
            $m->SMTPSecure = 'tls';
            $m->Port = 2525;
            
            $m->addAddress($destination_address);
            $m->Subject = "Welcome";
            $m->Body = "<p>You have successfully subscribed to our newsletter.</p>";

            if($m->send()){
                return true;
            }

            return false;
        }

        public static function Send_News($destination_address)
        {
            $m = new PHPMailer();
            $m->From = "nord-daw-proiect@test.com";
            $m->FromName = "Nord Team";

            $m->isSMTP();
            $m->Host = 'smtp.mailtrap.io';
            $m->SMTPAuth = true;
            $m->Username = '6d1b09506dd382';
            $m->Password = 'b756369093cc63';
            $m->SMTPSecure = 'tls';
            $m->Port = 2525;
            
            $m->addAddress($destination_address);
            $m->Subject = "New nord car";
            $m->Body = "<p>New model arrived to our shop.</p>";

            $m->send();
        }
    }

    class Other
    {
        public static function Verify()
        {
            session_start();
            if(!isset($_SESSION['u']) || !isset($_SESSION['pw']))
            {
                header("Location: http://localhost/DAW-Proiect/Views/Login");
            }
        }

        public static function FileUpload($file_input_name)
        {
            $path = "D:/WampServer/www/DAW-Proiect/Assets/Images/CarImg/";
            move_uploaded_file($_FILES[$file_input_name]['tmp_name'], $path . $_FILES[$file_input_name]['name']);
        }
    }
?>