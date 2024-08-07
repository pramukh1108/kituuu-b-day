<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['SUBMIT YOUR DETAILS']))
{
    $firstname = $_POST['First Name'];
    $lastname = $_POST['Last Name'];
    $mobileno = $_POST['Mobile No.'];
    $email = $_POST['E-mail'];
    $query = $_POST['Query'];
    $state = $_POST['State'];
    $country = $_POST['country'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'pramukhjikadara1108@gmail.com';                     //SMTP username
        $mail->Password   = 'qponxqtdbxjpovei';                               //SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 - Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('pramukhjikadara1108@gmail.com', 'JPN Webdesigning');
        $mail->addAddress('pramukhjikadara1108@gmail.com', 'JPN Webdesigning');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New enquiry - JPN Webdesigning Contact Form';

        $bodyContent = '<div>Hello, you got a new enquiry</div>
        <div>Firstname: '.$firstname.'</div>
        <div>Lastname: '.$lastname.'</div>
        <div>Mobileno: '.$mobileno.'</div>
        <div>Email: '.$email.'</div>
        <div>Query: '.$query.'</div>
        <div>State: '.$state.'</div>
        <div>Country: '.$country.'</div>
        ';

        $mail->Body = $bodyContent; 
        
        if($mail->send())
        {
            $_SESSION['status'] = "Thank you for contact us - JPN Webdesigning";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
        
       
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else
{
    header('Location: index.php');
    exit(0);
}


?>
