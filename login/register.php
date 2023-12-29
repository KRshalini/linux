<?php
ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "details";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "SELECT * FROM `person_details` ORDER BY Id DESC LIMIT 1";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);

    if ($total == 0) {
        $id = 1;
    } else {
        $result = mysqli_fetch_assoc($data);
        $id = $result['id'] + 1;
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = trim($_POST["password"]);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $gender = $_POST['gender'];
    $native = $_POST['native'];
    $skills = $_POST['skills'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $location = implode(',', $_POST['location']);
    $skills1 = implode(",", $skills);

    $sql = "INSERT INTO person_details(id, firstname, lastname, email, password, gender, native, skills, country, state, city, location) VALUES ('$id','$firstname','$lastname','$email','$hashedPassword','$gender','$native','$skills1','$country','$state','$city','$location')";
    $query = mysqli_query($conn, $sql);
    

    if ($query) {
        
        //echo "Failed";
        // include PHPMailer\PHPMailer\PHPMailer;
        // include PHPMailer\PHPMailer\Exception;

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'vendor/autoload.php';

       
        $mail = new PHPMailer(true);
        $mail->SMTPDebug =2;
          
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  
            $mail->SMTPAuth   = true;
            $mail->Username   = 'krshalini27@gmail.com'; 
            $mail->Password   = 'thbirkudinrewaoo'; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Port       = 587; 
           
           
            $mail->setFrom('krshalini27@gmail.com', 'Shalini');
            $mail->addAddress($_POST['email']); 

           
            $mail->isHTML(true); 
            $mail->Subject = 'Welcome';
            $mail->Body    = 'Thank you ';

            
           if(!$mail->send()){
            echo "Message not sent";
            echo "mail error:" . $mail->ErrorInfo;
           }else{
            echo "msg send";
           }
        

       
    } else {
        echo "Registered";
    }
}


ob_end_flush();
?>
