<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connecting to the Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "safekids";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `contact` (`name`, `email`, `phone`, `message`) VALUES ( '$name', '$email', '$phone', '$message')";
    $result = mysqli_query($conn, $sql);
    try {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        //Server settings
        //$mail->SMTPDebug = 2;                                     //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'shivamsaxena8200@gmail.com';           //SMTP username
        $mail->Password   = 'ftdn hbnv lsrf jfva';                  //SMTP password
        $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('shivamsaxena8200@gmail.com', 'Shivam Saxena');
        $mail->addAddress('shivamsaxena8200@gmail.com', 'Shivam Saxena');     //Add a recipient
        $mail->addAddress($email);                                            //Name is optional
        //$mail->addAddress('ellen@example.com');                             //Name is optional
        //$mail->addReplyTo('connectkcoverseas@gmail.com', 'kcoverseas');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                    //Set email format to HTML
        $mail->Subject = "SafeKids Team";
        $mail->Body    = "Hello " . $name . "<br>" . "Thank you for your query. I have received your details." . "<br>" . "<br>" . "Name :" . $name . "<br>" .  "E-mail :" . $email . "<br>" .  "Phone :" . $phone . "<br>" .  "Message :" . $message . "<br>" . "<br>" . "<br>" . "Regards" . "<br>" . "Safekids Team";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "<script>alert('Message sent successfully...');
        window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "Message could not be sent... Mailer Error: {$mail->ErrorInfo}";
        "<script>window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Something Went Wrong, Please Try Again');
    window.location.href='contact.html';</script>";
}
