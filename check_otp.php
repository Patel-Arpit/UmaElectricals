<?php
require('connection.inc.php');
require('functions.inc.php');


$type =  get_safe_value($con, $_POST['type']);
$otp =  get_safe_value($con, $_POST['otp']);

// $res = mysqli_query($con, "select * from `users` where email='$email'");
// $count = mysqli_num_rows($res);

if ($type == 'email') {
    if($otp == $_SESSION['EMAIL_OTP']){
        echo "done";
    }
    else{
        echo "no";
    }

	
} 











// if ($type == 'email') {
//     $email = get_safe_value($con, $_POST['email']);
//     $otp = rand(1111, 9999);
//     $_SESSION['EMAIL_OTP'] = $otp;
//     $html = "$otp is your otp";

    
// }
