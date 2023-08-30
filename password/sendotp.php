<?php
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$r=0;
function send($email){
    require ('PHPMailer.php');
    require ('Exception.php');
    require ('SMTP.php');
 global $r;
 $r=rand(10000,99999);
 //echo $r;
    $mail = new PHPMailer(true);


    try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '@gmail.com';                     //SMTP username
        $mail->Password   = '';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('sachinsingh52777@gmail.com', 'Aniket');
        $mail->addAddress($email);     //Add a recipient
    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email verification';
        $mail->Body    = 'Your OTP: <h2><B>'.$r.'</B></h2>';
        if($mail->send()){
        //echo 'Message has been sent';
        header('location:otp.php');
    }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}
?>