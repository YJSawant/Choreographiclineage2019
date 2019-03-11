<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();

if(isset($_SESSION["user_email_address"])){
	//echo "Logged in as: ".$user_email_address;
	$location = "profiles.php";
	echo ("<script>location.href='$location'</script>");
}

?>

<html>
<head>
	<title>Contribute Your Lineage</title>
</head>

<body>

	<div class="row">
		<div class="medium-6 column float-right">

		</div>
	</div>
	<!---<div class="row">
		<div class="column text-justify">
			<section>
				<h2>Welcome</h2>
				<p>Thank you in advance for contributing your lineage. Your contribution is vital to building a global resource for dance. The amount of time it will take to fill out this form will vary depending on how many artists you include in your lineage. We encourage you to take time to include all of the people you have studied with, danced in the work of, collaborated with and been influenced by so that this resource can most accurately represent the rich network of our field. You can work on the form over time by saving it and coming back to finish it when you are ready.</p>
			</section>
		</div>
	</div> --->
	<div class="row">
		<div class="large-4 small-12 column ">
			<section>
				<form id="login_form" name="login_form" method="post" action="login_mediator.php" enctype="multipart/form-data">
					<div class="login_section">
						<fieldset>
							<h5><strong>Login to your existing account</strong></h5>
							<?php
								if(isset($_SESSION["login_message"])){
									echo "<font color=red>".$_SESSION["login_message"]."</font>";
									my_session_unset();
								}
							?>
							<div class="row">
								<div class="large-12 column">
									<label for="user_name">Email Address<large style="color:red;font-weight: bold;"> *</large>
										<input  type="email" autocomplete="off" type="text" id="user_email_address" name="user_email_address" placeholder="Email Address" required>
									</label>
								</div>
								<div class="large-12 column">
									<label for="user_password">Password <large style="color:red;font-weight: bold;"> *</large>
										<input  autocomplete="off" type="password" id="user_password" name="user_password" placeholder="Password" required>
									</label>
								</div>
								<div class="large-12 column">
									<button class="primary button" type="submit" name="login_submit">
										<span>Login</span>
									</button>
								<a href="forgot_user_password.php" style="float:right;margin-top: 9px"><u>Forgot Password?</u></a>
								</div>
							</div>
						</fieldset>
					</div>
				</form>
			</section>
		</div>
		<div class="large-8 small-12 column ">
			<section>
				<form id="add_user_profile_form" name="add_user_profile_form" method="post" action="add_user_profile_mediator.php" enctype="multipart/form-data">
					<div class="signin_section">
						<fieldset>
							<h5><strong>Create your new account</strong></h5>
							<?php
								if(isset($_SESSION["add_user_profile"])){
									echo "<font color=red>".$_SESSION["add_user_profile"]."</font>";
									my_session_unset();
								}
							?>
							<div class="row">
								<div class="large-6 small-12 column">
									<label for="user_name">First Name <large style="color:red;font-weight: bold;"> *</large>
										<input  autocomplete="off" type="text" id="first_name" name="first_name" placeholder="First Name" required>
									</label>
								</div>
								<div class="large-6 small-12 column">
									<label for="user_name">Last Name <large style="color:red;font-weight: bold;"> *</large>
										<input  autocomplete="off" type="text" id="last_name" name="last_name" placeholder="Last Name" required>
									</label>
								</div>
								<div class="large-12 small-12 column">
									<label for="user_name">Email Address <large style="color:red;font-weight: bold;"> *</large>
										<input  autocomplete="off" type="text" id="user_email_address" name="user_email_address" placeholder="Email Address" required>
									</label>
								</div>
								<div class="small-12 column">
									<button class="secondary button add_user_button" type="submit" name="user_profile_submit">
										<span>Sign Me Up</span>
									</button>
                                    <a href="phone_contribution.php" style="float: right;margin-top: 5px;padding-top: 5px;"><u>Don't want to register- Contribute Lineage via Phone</u></a>
								</div>
							</div>
						</fieldset>
					</div>
				</form>
			</section>
		</div>
	</div>
</body>

<style>
	.login_section{
		border: 2px solid forestgreen;
		padding: 10%;
		margin: 10%;
	}

	.signin_section{
		border: 2px solid forestgreen;
		padding: 5%;
		margin: 5%;
	}

	.add_user_button{
		background-color: darkgreen !important;
	}

	.add_user_button:hover{
		background-color: #004d26 !important;
	}

</style>
<?php
include 'footer.php';?>

<script>
	$(document).ready(function(){
		$(function() {
            // this will get the full URL at the address bar
            var url = window.location.href;
            if(url.search("add_user_profile.php"))
            {
                var lineage_contri = document.getElementById("contri_lineage");
                $(lineage_contri).addClass('active');
            }
        }); 
});
</script>

</html>
