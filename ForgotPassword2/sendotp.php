<?php
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to generate a random OTP
function generateOTP() {
    return strval(rand(1000, 9999));
}

// Function to send OTP via email (replace with your email sending code)
function sendOTPByEmail($email, $otp) {
    require ('PHPMailer.php');
    require ('Exception.php');
    require ('SMTP.php');
    $mail = new PHPMailer(true);

    try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'aryankvlogs@gmail.com';                     //SMTP username
        $mail->Password   = 'kscj rvrt eggb fiqd';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('aryankvlogs@gmail.com', 'examcomitee vaze');
        $mail->addAddress($email);     //Add a recipient
    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email verification';
        $mail->Body    = 'Your OTP: <h2><B>'.$otp.'</B></h2>';
        if($mail->send()){
        //echo 'Message has been sent';
        return true;
    }
    else{

    return false;
    }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
  
}
