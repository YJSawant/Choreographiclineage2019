<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();

if(!isset($_POST['submit'])){
  echo"error, you need to submit form";
}
$name=$_POST['name'];
$visitor_email=$_POST['mail'];
$content=$_POST['content'];

if(empty($name)||empty($visitor_email)){
  echo "Name and email are mandatory!";
}else{
    include 'php/lib/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'hobbes.cse.buffalo.edu';  // Specify main and backup SMTP servers
    //$mail->SMTPDebug = 4;
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('no-reply@buffalo.edu', 'Choreographic Lineage');

    $mail->isHTML(true);
    //$mail->addReplyTo('choreographiclineage@gmail.com', 'Choreographic Lineage');
    //$mail->addReplyTo('miki.nitdgp@gmail.com', 'Melanie Aceto');
    $mail->addCustomHeader('MIME-Version: 1.0');
    $mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');
    $mail->Subject = "Choreographic Lineage Help";
    $message = "Thank you for your email. A member will contact you soon. <br><br><br/>Thank You,<br/>The Choreographic Lineage Team";
    $mail->addAddress($visitor_email);
    $mail->Body = $message;
    $mail->send();
    
    //Sending email to admin
    $admin_mail = new PHPMailer;
    $admin_mail->isSMTP();                                      // Set mailer to use SMTP
    $admin_mail->Host = 'hobbes.cse.buffalo.edu';  // Specify main and backup SMTP servers
    $admin_mail->SMTPAuth = false;                               // Enable SMTP authentication
    $admin_mail->Port = 587;                                    // TCP port to connect to
    $admin_mail->setFrom('no-reply@buffalo.edu', 'Choreographic Lineage');
    $admin_mail->isHTML(true);
    //$admin_mail->addReplyTo('miki.nitdgp@gmail.com', 'Melanie Aceto');
    $admin_mail->addCustomHeader('MIME-Version: 1.0');
    $admin_mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');
    $admin_mail->Subject = "Choreographic Lineage Help";
    $admin_mail->addAddress("aceto@buffalo.edu");
    $admin_mail->Body = $content;
    if($admin_mail->send())
    {
      header("Location: index.php");
    }
    }

// include 'php/lib/PHPMailer/PHPMailerAutoload.php';
//     $mail = new PHPMailer;
//     $mail->isSMTP();
//     $mail->SMTPDebug=1;
//     $mail->SMTPAuth=false;
//     $mail->Host = 'hobbes.cse.buffalo.edu';//no-reply@buffalo.edu
//     //$mail->Port=587;//587
//     $mail->IsHTML(true);
//     $mail->Username="rosicky210@gmail.com";
//     $mail->Password="4Y2ywTfiXjVaAvp";
//     $mail->setFrom("rosicky210@gmail.com");
//     $mail->Subject="Choreographic Lineage Help Query";
//     $mail->Body=$content;
//     $mail->AddAddress($visitor_email);

//     if(!$mail->send()){
//       echo"mail not sent";
//     }
//     else{
//       echo"mail sent";
//     }
include 'footer.php';

?>

