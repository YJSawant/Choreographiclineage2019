<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();


error_reporting(0);

if(isset($_SESSION["user_email_address"])){
	$user_email_address = $_SESSION["user_email_address"];
	$firstName = mysql_real_escape_string($_POST['first_name']);
	$lastName =  mysql_real_escape_string($_POST['last_name']);
	$email =  mysql_real_escape_string($_POST['email_address']);
	$date =  mysql_real_escape_string($_POST['appointment_date']);
	$contact = mysql_real_escape_string($_POST['contact_number']);
	$note = mysql_real_escape_string($_POST['note']);




	/*include 'appointment_mail_template.php';
	$message = $message."".$date;
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
    $mail->Subject = 'Choreographic Lineage Appointment Confirmation';

	$message = "Hello $firstName $lastName,<br/>Your appointment has been confirmed for $date. Someone from our team will call you on $contact. <br/><br/>Thanks,<br/>Choreographic Lineage Team";
    $mail->addAddress($user_email_address);
    $mail->Body    = $message;
    $mail->send();

	$mail = new PHPMailer;
	$mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'hobbes.cse.buffalo.edu';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('no-reply@buffalo.edu', 'Choreographic Lineage');

    $mail->isHTML(true); 
    $mail->addReplyTo($email, $firstName. ' '.$lastName);
	$mail->addCustomHeader('MIME-Version: 1.0');
    $mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');
    $mail->Subject = 'Choreographic Lineage Appointment Created';
    $message = "Hello Melanie,<br/>An Appointment has been created by $firstName $lastName for $date. Here are the other details as provided to us.<br/>Name: $firstName $lastName<br/>Email: $email<br/>Date: $date<br/>Contact: $contact<br/>Note: $note<br/><br/>Thanks,<br/>Choreographic Lineage Team";
    $mail->addAddress('aceto@buffalo.edu');
    $mail->Body    = $message;
    $mail->send();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Appointment Confirmation</title>
</head>
<style type="text/css">
	.confirmation_container{
		margin-top: 6%;
	}
	.p{
		word-wrap: normal;
	}
	.button_container{
		margin: auto;
	}
</style>
<body>
	<div class="confirmation_container">
		<div class="row">
			<div class="small-12 medium-8 large-5 small-centered columns"> 
				<h1 class="text-center">Appointment Confirmed!!</h1> 
			</div>
		</div>
		<div class="row">
			<div class="small-12 small-centered columns"> 
				<p class="text-center">Please check your inbox at <br>
					<strong><?php echo $user_email_address?></strong></p>
				</div>
			</div>
		<!-- <div class="row">
			<div class="small-6 small-centered columns"> 
				<p class="text-center"><em>Looking forward to talk to you...</em></p>
			</div>
		</div> -->
		<hr width="30%">

		<div class="row">
			<div class="small-12 medium-8 large-5 small-centered columns"> 
				<h4 class="text-center">Having trouble or need to reschedule?</h4> 
				<p class="text-center"> Contact us at:  <strong><a>+1(716) 645-0605</a></strong><br></p>
			</div>
		</div>
		<div class="row">
			<div class="button_container small-12 medium-8 large-2 small-centered columns  "> 
				<a href="profiles.php" class="button large radius text-center">BACK TO PROFILE</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>

