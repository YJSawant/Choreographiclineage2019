<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}

if(isset($_SESSION["artist_profile_id"]) and isset($_SESSION["user_email_address"])){
	$artist_profile_id = $_SESSION["artist_profile_id"];
	$user_email_address = $_SESSION["user_email_address"];
}
else{
}

?>

<html>
<head>
	<title>Personal Information</title>
</head>

<body>
	<?php
		include 'form_links_header.php'
	?>
	<form id="personal_information" class="personal_information">
		<div class="row"></div>


		<div class="row">
			<div class="small-1 columns">
				<button class="primary button" type="submit" name="user_profile_submit" id="previous_bio">
					<span>Previous</span>
				</button>
			</div>
			<div class="small-1 columns">
				<button class="primary button" type="submit" name="user_profile_submit" id="next_bio">
					<span>Next</span>
				</button>
			</div>
			<div class="column">
			</div>
		</div>
	</form>


</body>

<script type="text/javascript">
	$(document).ready(function(){

		$("#addUniversity").click(function(){
			$("#education_entries").clone().insertAfter("#education_entries");
		});
	});
</script>

<script type="text/javascript">


	$(document).ready(function(){

		$("#addInstitution").click(function(){
			$("#other_education_entries").clone().insertAfter("#other_education_entries");
		});
	});
	$("#previous").click(function(){
		window.location.href = "about_lineage.php";
	});

	$("#next").click(function(){
		window.location.href = "add_lineage.php";
	});
</script>
<?php
include 'form_links_footer.php';
include 'footer.php';
?>

</html>
