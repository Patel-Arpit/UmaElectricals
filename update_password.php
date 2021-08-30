<?php
require('connection.inc.php');
require('functions.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$type =  get_safe_value($con, $_POST['type']);
$email = $_POST['email'];
$res = mysqli_query($con, "select * from `users` where email='$email'");
$count = mysqli_num_rows($res);

if ($count > 0) {
    if ($type == 'email') {
        $email =  get_safe_value($con, $_POST['email']);
        $otp = rand(11111, 99999);
        $_SESSION['UPDATE_EMAIL_OTP'] = $otp;
        sendMail($email, $otp);
        echo "yes";
    } 
}else {
    echo "not_register";
}

function sendMail($email, $otp)
{
    require('phpMail/PHPMailer.php');
    require('phpMail/SMTP.php');
    require('phpMail/Exception.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'websitehostphp@gmail.com';                     //SMTP username
        $mail->Password   = '@rpit2341';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('websitehostphp@gmail.com', 'UMA');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email verification from UMA Electricals & Services';
        $mail->Body    = "OTP for reset your password!
		Your OTP verification code is : <b>'$otp'</b>";

        $mail->send();
        return 1;
    } catch (Exception $e) {
        return 0;
    }
}








// if ($type == 'email') {
//     $email = get_safe_value($con, $_POST['email']);
//     $otp = rand(1111, 9999);
//     $_SESSION['EMAIL_OTP'] = $otp;
//     $html = "$otp is your otp";

    
// }
