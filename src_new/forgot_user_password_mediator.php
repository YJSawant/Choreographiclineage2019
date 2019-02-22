<?php
include 'path.php';
include 'menu.php';
include 'util.php';
my_session_start();
include 'connection_open.php';
$user_email_address =  mysqli_real_escape_string($dbc,$_POST['user_email_address']);
$user_one_time_password = rand(100000, 999999);
$query = "SELECT * FROM user_profile
	WHERE user_email_address='$user_email_address'";
$result = mysqli_query($dbc,$query)
or die('Error querying database.: '  .mysqli_error($dbc));
$count=mysqli_num_rows($result);
if($count == 1){
    // include 'mail_template.php';
    // $message = $message."".$user_one_time_password;
    // mail($user_email_address,$subject,$message, $headers);
     include 'php/lib/PHPMailer/PHPMailerAutoload.php';
     $mail = new PHPMailer;

       $mail->isSMTP();                                      // Set mailer to use SMTP
       $mail->Host = 'hobbes.cse.buffalo.edu';  // Specify main and backup SMTP servers
       $mail->SMTPAuth = false;                               // Enable SMTP authentication
       $mail->Port = 587;                                    // TCP port to connect to

       $mail->setFrom('no-reply@buffalo.edu', 'Choreographic Lineage');

       $mail->isHTML(true);
       $mail->addReplyTo('aceto@buffalo.edu', 'Melanie Aceto');
       $mail->addCustomHeader('MIME-Version: 1.0');
       $mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');
       $mail->Subject = 'Choreographic Lineage Password Change Request';

     	$message = "We have received your password change request. This e-mail contains the information that you need to change your password. <br/><br/>One Time Password: $user_one_time_password<br/><br/>Thank you,<br/>Choreographic Lineage Team";
     	$mail->addAddress($user_email_address);
       $mail->Body = $message;
       $mail->send();
    $query = "UPDATE user_profile
		SET user_one_time_password='$user_one_time_password'
		WHERE user_email_address='$user_email_address'";
    $result = mysqli_query($dbc,$query)
    or die('Error querying database.: '  .mysqli_error($dbc));
    include 'connection_close.php';
    session_start();
    $_SESSION["set_user_password"] = "Check your email for a one-time password";
    $_SESSION["email"] = $user_email_address;
    $_SESSION["forgot_user_password"] = "Change Password";
    //header('Location: set_user_password.php');
    $location = "set_user_password.php";
}else{
    $_SESSION["email_doesn't_exist"] = "User with email does not exists!";
    $_SESSION["incorrect_email"] = $user_email_address;
    $location = "forgot_user_password.php";
}
echo ("<script>location.href='$location'</script>");
?>