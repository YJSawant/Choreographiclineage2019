<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();

include 'connection_open.php';

$first_name =  mysqli_real_escape_string($dbc,$_POST['first_name']);
$last_name =  mysqli_real_escape_string($dbc,$_POST['last_name']);
$user_email_address =  mysqli_real_escape_string($dbc,$_POST['user_email_address']);
$query = "SELECT * FROM user_profile 
WHERE user_email_address='$user_email_address'";

$result = mysqli_query($dbc,$query)
or die('Error querying database.: '  .mysqli_error($dbc));

$count=mysqli_num_rows($result);
if($count==0){
	
	$user_password = "PGlYFveq56MdwCoEiCaC";
	$user_one_time_password = rand(100000, 999999);
	
/*	include 'mail_template.php';
	$message = $message."".$user_one_time_password;
	mail($user_email_address, $subject, $message, $headers);*/
	
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
    $mail->Subject = 'Welcome to Choreographic Lineage';

	$message = "Hello $first_name $last_name,<br/>Welcome to Choreographic Lineage. Before you can proceed with the website, you will need to set up your password. Please use the one time password mentioned below to login into your account and change the password.<br/><br/>One Time Password: $user_one_time_password<br/><br/>Thanks,<br/>Choreographic Lineage Team";
    $mail->addAddress($user_email_address);
    $mail->Body    = $message;
    $mail->send();
	
	$query = "INSERT INTO user_profile 
	(
	user_first_name,
	user_last_name,
	user_email_address,
	user_password,
	user_one_time_password)  
	VALUES 
	(
	'$first_name',
	'$last_name',
	'$user_email_address',
	'$user_password',
	'$user_one_time_password'
	)";
	
	$result = mysqli_query($dbc,$query)
	or die('Error querying database.: '  .mysqli_error($dbc));
	
	$_SESSION["set_user_password"] = "Check your email for a one-time password";
	$_SESSION["email"] = $user_email_address;
	$location = "set_user_password.php";
}
else{
	$_SESSION["add_user_profile"] = "User with email already exists!";
	$location = "add_user_profile.php";
}

include 'connection_close.php';
header("Location: ".$location."");
?>
