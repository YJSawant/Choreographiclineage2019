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
    $mail->SMTPDebug = 3;  
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'hobbes.cse.buffalo.edu';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('no-reply@buffalo.edu', 'Choreographic Lineage');

    $mail->isHTML(true);
    //$mail->addReplyTo('choreographiclineage@gmail.com', 'Choreographic Lineage');
    $mail->addReplyTo('aceto@buffalo.edu', 'Melanie Aceto');
    $mail->addCustomHeader('MIME-Version: 1.0');
    $mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');
    $mail->Subject = "Choreographic Lineage Appointment";

    $message = "Thank you for your interest in Choreographic Lineage. A team member will contact you soon to arrange a lineage appointment.<br/><br/>Thank you,<br/>Choreographic Lineage Team";
    $mail->addAddress($visitor_email);
    $mail->Body = $content;
    $mail->send();
    if(!$mail->send()){
      echo"failed";
    }
    else{
      echo"passed";
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
  }
include 'footer.php';

?>

