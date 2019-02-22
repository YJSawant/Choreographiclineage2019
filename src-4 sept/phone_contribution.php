<?php
include 'path.php';
include 'menu.php';
include 'util.php';
?>


<html>
<head>
	<title>Personal Information</title>
	<style type="text/css">

	</style>

</head>

<body>

	<form id="biography" class="biography" action="appointment_confirmation.php" method="post">
		<div class="row">
			<p><h3><strong>CONTRIBUTE YOUR LINEAGE BY PHONE</strong></h3></p>
		</div>
		<div class="row">
			<h5>Please fill out the form below to set a suitable time for you, when we can call you.</h5>
		</div>

		<div class = "row">
			<div class="medium-4 column">
				<label for="artist_first_name">First Name <small>Required</small>
					<input autocomplete="off" type="text" id="first_name" name="first_name" placeholder="First Name" required>
				</label>
			</div>
			<div class="medium-4 column">
				<label for="artist_last_name">Last Name <small>Required</small>
					<input autocomplete="off" type="text" id="last_name" name="last_name" placeholder="Last Name" required>
				</label>
			</div>
			<div class="medium-4 column">
				
			</div>
			<!-- FIRST NAME AND LAST NAME -->
		</div>
		<div class="row">
			<div class="medium-4 column">
				<label for="artist_email_address">Email Address <small>Required</small>
					<input autocomplete="off" type="email" id="email_address" name="email_address" placeholder="Email Address">
				</label>
			</div>
		</div>
		
		<div class="row">
			<div class="medium-4 column">
				<label for="appointment_date">Date and Time
					<input type="text" name="appointment_date" class="appointment_date" id="appointment_date" placeholder="yyyy-mm-dd" required>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="medium-4 column">
				<label for="appointment_date">Contact Number
					<input type="tel" name="contact_number" class="contact_number" id="contact_number" placeholder="" pattern="^\+(?:[0-9]●?){6,14}[0-9]$" required>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="medium-4 column">
				<label for="artist_email_address">Notes
					<textarea placeholder="Feel free to add a note to your appointment." rows="4" name="note" class="note" id="note"></textarea>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="small-1 columns">
				<button class="primary button" id="submit" type="submit">
					<span>Submit</span>
				</button>
			</div>
			<div class="column">
			</div>
		</div>
	</form>
</body>

<script type="text/javascript">
	$(function(){
		$('#appointment_date').fdatepicker({
			format: 'mm-dd-yyyy hh:ii',
			disableDblClickSelection: true,
			language: 'en',
			pickTime: true
		});
	});
</script>
<?php
include 'footer.php';
?>