<?php
//    ini_set( 'display_errors', 1 );
//    error_reporting( E_ALL );
    /*$from = "programmerspoint8@gmail.com";
    $to = "jay.shah144@gmail.com";
    $subject = "Choreographic Lineage One Time Password";
    $message = "Use this one time password:\n";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From:" . $from;*/

    include 'php/lib/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $message = "Use this one time password:\n";

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'hobbes.cse.buffalo.edu';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('dcl@buffalo.edu', 'Choreographic Lineage');

    $mail->isHTML(true); 
    $mail->Subject = 'Choreographic Lineage One Time Password';

    // echo "Test email sent";
?>
