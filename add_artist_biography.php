<style>
.progressbar {
      counter-reset: step;
  }
  .progressbar li {
      list-style-type: none;
      width: 25%;
      float: left;
      font-size: 12px;
      position: relative;
      text-align: center;
      text-transform: uppercase;
      color: #7d7d7d;
  }
  .progressbar li:before {
      width: 30px;
      height: 30px;
      content: counter(step);
      counter-increment: step;
      line-height: 30px;
      border: 2px solid #7d7d7d;
      display: block;
      text-align: center;
      margin: 0 auto 10px auto;
      border-radius: 50%;
      background-color: white;
  }
  .progressbar li:after {
      width: 100%;
      height: 2px;
      content: '';
      position: absolute;
      background-color: #7d7d7d;
      top: 15px;
      left: -50%;
      z-index: -1;
  }
  .progressbar li:first-child:after {
      content: none;
  }
  .progressbar li.active {
      color: green;
  }
  .progressbar li.active:before {
      border-color: #55b776;
  }
  .progressbar li.active + li:after {
      background-color: #55b776;
  }

</style>
<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();
if(isset($_SESSION["user_email_address"]) && $_SESSION["timeline_flow"] != "view"){
	$gender = "";
	$gender_other = "";
	$ethnicity = "";
	$ethnicity_other = "";
	$dob = "";
	$city = "";
	$country_res = "";
	$country_birth = "";
	$state = "";
	$state_province = "";
	$university = "";
	$major = "";
	$degree = "";
	$institute = "";
	$other_degree = "";
	$update_record = false;
	//echo("PROF IS ".$_SESSION['artist_profile_id']);

	// foreach ($_SESSION as $key=>$val)
	// echo $key." ".$val."<br/>";
	
	if (isset($_SESSION['artist_profile_id'])) {
		$artist_id = $_SESSION['artist_profile_id'];
	}

	if(isset($_POST["gender"]) && !empty($_POST["gender"])){
		$_SESSION["gender"] = $_POST["gender"];
		$gender = $_POST["gender"];
		$update_record = true;
	}

	if(isset($_POST["gender_other"]) && !empty($_POST["gender_other"])){
		$_SESSION["gender_other"] = $_POST["gender_other"];
		$gender_other = $_POST["gender_other"];
		$update_record = true;
	}

	if(isset($_SESSION["date_of_birth"])){
		$dob = $_SESSION["date_of_birth"];
	} elseif (isset($_POST["date_of_birth"]) && !empty($_POST["date_of_birth"])){
		$_SESSION["date_of_birth"] = $_POST["date_of_birth"];
		$dob = $_POST["date_of_birth"];
		$update_record = true;
	}

	if(isset($_POST["ethnicity"]) && !empty($_POST["ethnicity"])){
		$_SESSION["ethnicity"] = $_POST["ethnicity"];
		$ethnicity = $_POST["ethnicity"];
	}

	if(isset($_POST["ethnicity_other"]) && !empty($_POST["ethnicity_other"])){
		$_SESSION["ethnicity_other"] = $_POST["ethnicity_other"];
		$ethnicity_other = $_POST["ethnicity_other"];
		$update_record = true;
	}

	if(isset($_POST["city_residence"]) && !empty($_POST["city_residence"])){
		$_SESSION["city_residence"] = $_POST["city_residence"];
		$city = $_POST["city_residence"];
		$update_record = true;
	}

	if(isset($_POST["country_residence"]) && !empty($_POST["country_residence"])){
		$_SESSION["country_residence"] = $_POST["country_residence"];
		$country_res = $_POST["country_residence"];
		$update_record = true;
	}

	if(isset($_POST["state_residence"]) && !empty($_POST["state_residence"])){
		$_SESSION["state_residence"] = $_POST["state_residence"];
		$state = $_POST["state_residence"];
		$update_record = true;
	}

	if(isset($_POST["state_province"]) && !empty($_POST["state_province"])){
		$_SESSION["state_province"] = $_POST["state_province"];
		$state_province = $_POST["state_province"];
		$update_record = true;
	}

	if(isset($_POST["country_birth"]) && !empty($_POST["country_birth"])){
		$_SESSION["country_birth"] = $_POST["country_birth"];
		$country_birth = $_POST["country_birth"];
		$update_record = true;
	}

	if(isset($_POST["university"]) && !empty($_POST["university"])){
		$_SESSION["university"] = $_POST["university"];
		$university = $_POST["university"];
		$update_record = true;
	}

	if(isset($_POST["major"]) && !empty($_POST["major"])){
		$_SESSION["major"] = $_POST["major"];
		$major = $_POST["major"];
		$update_record = true;
	}

	if(isset($_POST["degree"]) && !empty($_POST["degree"])){
		$_SESSION["degree"] = $_POST["degree"];
		$degree = $_POST["degree"];
		$update_record = true;
	}

	if(isset($_POST["institution_name"]) && !empty($_POST["institution_name"])){
		$_SESSION["institution_name"] = $_POST["institution_name"];
		$institute = $_POST["institution_name"];
		$update_record = true;
	}

	if(isset($_POST["other_degree"]) && !empty($_POST["other_degree"])){
		$_SESSION["other_degree"] = $_POST["other_degree"];
		$other_degree = $_POST["other_degree"];
		$update_record = true;
	}

	include 'connection_open.php';

	if($update_record){
		if(isset($_SESSION["artist_profile_id"])){
			include 'connection_open.php';

                    $fname=$_SESSION["artist_first_name"];
                     $fname=$_SESSION["artist_first_name"];
                    $query1 = "SELECT STATUS FROM artist_profile
                    WHERE artist_first_name= '$fname'";

                    $result1 = mysqli_query($dbc,$query1)
                    or die('Error querying database.: ' . mysqli_error());
                    $resultant = mysqli_fetch_array($result1);

                    $max=0;
                    if($resultant['STATUS']>50){
                        $max=$resultant['STATUS'];
                    }
                    else{
                        $max=50;
                    }
                   

			$query = "UPDATE artist_profile SET
			artist_gender='$gender',
			gender_other='$gender_other',
			artist_ethnicity='$ethnicity',
			ethnicity_other='$ethnicity_other',
			artist_dob='$dob',
			artist_residence_city='$city',
			artist_residence_state='$state',
			artist_residence_country='$country_res',
			artist_residence_province='$state_province',
			artist_birth_country='$country_birth',STATUS='$max' WHERE artist_profile_id = '".$_SESSION['artist_profile_id']."'";
			$result = mysqli_query($dbc,$query) or die('Error querying database.: '  .mysqli_error($dbc));
			if(!empty($university) || !empty($institute)){
				$education = array();
				foreach($university as $key => $value){
					$education[] = "('".$value."', '".$major[$key]."', '".$degree[$key]."', 'main', '".$artist_id."')";
				}

				foreach($institute as $key => $value){
					$education[] = "('".$value."', '', '".$other_degree[$key]."', 'other', '".$artist_id."')";
				}

				$query = "DELETE FROM artist_education WHERE artist_profile_id='".$artist_id."'";
				$result = mysqli_query($dbc,$query) or die('Error querying database.: '  .mysqli_error($dbc));

				$query = "INSERT INTO artist_education (institution_name, major, degree, education_type, artist_profile_id) VALUES ";
				$query .= implode(',', $education);
				$result = mysqli_query($dbc,$query) or die('Error querying database.: '  .mysqli_error($dbc));
			}
			$_SESSION["form_2"] = "completed";
		}
		include 'connection_close.php';
	}
}

if(isset($_SESSION['timeline_flow']) &&  $_SESSION['timeline_flow'] == "view") {
	echo "<script>var disabled_input=true;</script>";
}else{
	echo "<script>var disabled_input=false;</script>";
}
if(isset($_SESSION['timeline_flow']) &&  $_SESSION['timeline_flow'] == "artist_add" ) {
	echo "<script>var add_artist=true;</script>";
}else{
	echo "<script>var add_artist=false;</script>";
}
if(isset($_SESSION['timeline_flow']) &&  $_SESSION['timeline_flow'] == "edit" ) {
	echo "<script>var edit_artist=true;</script>";
}else{
	echo "<script>var edit_artist=false;</script>";
}

?>



<html>
<head>
	<title>Biography</title>
	<style type="text/css">
		.biography_container{
			padding-left: 4%;
		}
		.button_container{
			margin: auto;
		}
		.submit_text{
			width: 20%;
		}
	</style>

</head>

<body>
	<?php
	include 'form_links_header.php'
	?>

	<div class="row">
		<ul class="progressbar">
          <li class="active" id="first"><a href="add_artist_profile.php">Add Artist Profile</a></li>
          <li class="active" id="second"><a href="add_artist_personal_information.php">Add Artist Personal Info</a></li>
          <li class="active" id="third"><a href="add_artist_biography.php">Add Artist Biography</a></li>
          <li id="fourth"><a href="add_lineage.php">Add Lineage</a></li>
          
  </ul>
	</div>
	<div class="row">
		<div style="clear: both">
                            <h2  style="display:inline;"><strong>YOUR BIOGRAPHY</strong></h2>
                            <h5  style="display:inline; float: right; color: #006400;"><?php echo "<strong>(You are in ".$_SESSION['timeline_flow']." mode)</strong>";?></h5>
                        </div>
	</div>


	<div class="row">

        <fieldset >
            <legend style="font-size:20px"><strong>Choose a method</strong></legend>
            <div class="column small-6">
                <label style="font-size:18px">
                    <input type="radio"  id="upload_document" name="contribute_online_form" class="contribute_online_form" value="form" checked>
                    Upload a file
                </label>
            </div>
            <div class="column small-6">
                <label style="font-size:18px">
                    <input type="radio" id="type_biography" name="contribute_online_form" class="contribute_online_form" value="phone">
                    Type or paste
                </label>
            </div>
        </fieldset>


		<div class=" large-4 medium-4 small-4 columns" id="Upload_pdf_section"><!-- INSERT THE INPUT FIELDS HERE -->
			<form id="upload_biography" action="" method="post" enctype="multipart/form-data">
				<div class="row">
					<h6><em>Upload pdf/word file only (Max size : 4MB)<em></h6>
					<div class="row"><!-- INSERT THE "choose file" here FIELDS HERE -->
						<div class="small-8 columns">
							<label for="bio_file" class="button small expanded action_button">Choose File</label>
							<input type="file" id="bio_file" name="bio_file" class="show-for-sr" required/>
						</div>

					</div>
					<div class="row">
						<div class="small-8 columns">
							<div id="bio_file_name">
								<?php
								if(isset($_SESSION["biography_file_path"])){
									echo $_SESSION["biography_file_path"];
								}
								?>
							</div>

						</div>
					</div>
					<p><br></p>
					<div class="row"> <!-- INSERT THE submit here here FIELDS HERE -->
						<div class="small-8 columns">
							<input type="submit" value="Upload" class="button small expanded submit action_button"/>
						</div>
					</div>
					<div class="row small-8 columns">
							<div id="bio_message">
					</div>
					</div>
				</div>
			</form>
		</div>

		<div class=" large-7 medium-7 small-7 columns biography_container" id="type_section" style="display: none">
			<label>
				<h6><em>Type/Paste Biography (Text Only)<em></h6>
				<form form id="upload_bigraphy_text" name="bigraphy_text_form" method="post" action="" enctype="multipart/form-data">
					<div class="row">
						<textarea placeholder="None" id="biography_text" name="biography_text" rows="5"><?php
								if(isset($_SESSION["biography_text"])){
									echo $_SESSION["biography_text"];
								}
								?>
						</textarea>
					</div>
					<div class="row">

						<input type="submit" value="Save" class="button small submit_text action_button"/>
						<span id="biography_text_message"></span>
					</div>
				</form>
			</label>
		</div>


	</div>



	<div class="row">
		<p align="middle"><h2><strong>YOUR PHOTO</strong></h2></p>
		<h6><em>Upload only jpg/png/jpeg file. (Max size : 4MB)</em></h6>
	</div>


	<div class="row" >
		<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
			<div class="large-4 medium-4 small-4 columns"><!-- INSERT THE INPUT FIELDS HERE -->


				<div class="row"><!-- INSERT THE "choose file" here FIELDS HERE -->
					<div class="row">
						<div class="small-8 columns">
						<label for="file" class="button small expanded action_button">Choose File</label>
						<input type="file" id="file" name="file" class="show-for-sr" required/>
						</div>
					</div>
					<div class="row small-8 columns">
						<div id="image_name">
					</div>
				</div>

				<div class="row"><!-- INSERT THE submit here here FIELDS HERE -->
					<div class="small-8 columns">
						<div id="message"></div>
						<br/><br/>
						<input type="submit" value="Upload" class="button small expanded submit action_button" />
					</div>
				</div>
			</div>

			<div>
				<div class=" large-4 medium-6 small-6 columns">
					<!-- INSERT THE PREVIEW FIELDS HERE -->
					<div id="image_preview">
						<img id="previewing" src="<?php
								if(isset($_SESSION["photo_file_path"])){
									echo $_SESSION["photo_file_path"];
								}
								?>"/>
					</div>
				</div>
			</div>
		</form>
	</div>

	<hr>

	<div class="row">
		<div class="large-2 small-8 columns ">
			<button style="font-style: normal;" class="primary button" id="previous" type="button">
				<span>Previous</span>
			</button>
		</div>
		<div class="large-2 small-8 columns">
			<button style="font-style: normal;" class="primary button" id="next" type="submit">
				<span><?php echo(($_SESSION['timeline_flow'] == "view")?"":"Save & ") ?>Next</span>
			</button>
		</div>
		<div class="large-2 small-8 columns">
            <button style="font-style: normal;" class="primary button" id="next1" type="button">
                <span>Continue Later</span>
            </button>
        </div>
		 
		<div class="column">
		</div>
	</div>



	<!-- </form> -->


</body>

<script>
	 $("#first").click(function() {
            // onclick event is assigned to the #button element.
            window.open("add_artist_profile.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });

 $("#second").click(function() {
            // onclick event is assigned to the #button element.
            window.open("add_artist_personal_information.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });
  $("#third").click(function() {
            // onclick event is assigned to the #button element.
	    return false;
            window.open("add_artist_biography.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });
   $("#fourth").click(function() {
            // onclick event is assigned to the #button element.
            window.open("add_lineage.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });


    $("#upload_document").click(function() {
        //console.log("hello");
        $("#Upload_pdf_section").show();
        $("#type_section").hide();
    });
    $("#type_biography").click(function() {
        //console.log("hello1");
        $("#type_section").show();
        $("#Upload_pdf_section").hide();
    });


	$("#previous").click(function() {
	// onclick event is assigned to the #button element.
	//+$("#upload_bigraphy_text").serialize()
	$.ajax({
			     type: "POST",
			     url: "save_add_artist_pi_back.php",
			     data: $("#upload_bigraphy_text").serialize(),
			     success: function(response) {
			     	console.log(response);
			          //success message mybe...
			         // alert("SUCCESS");
			     }
			});

		window.open("add_artist_personal_information.php","_self");

	//   //document.location.href = "add_artist_personal_information.php",true;
	});
	//onclick event is assigned to the #button element.
	$("#next").click(function() {
		if(add_artist){
			window.open("about_lineage.php","_self");
		}
		else{
			window.open("add_lineage.php","_self");
		}
		if(edit_artist){
			window.open("about_lineage.php","_self");
		}
		else{
			window.open("add_lineage.php","_self");
		}
	});

	  $("#next1").click(function() {
        window.open("profiles.php","_self");
    });
	        $("#next1").click(function() {
        window.open("profiles.php","_self");
    });
</script>

<script type="text/javascript">
	$(document).ready(function (e) {
		$("#uploadimage").on('submit',(function(e) {
			e.preventDefault();
			$("#message").empty();
			$('#loading').show();
			$.ajax({
			url: "photo_upload.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				$('#loading').hide();
				$("#message").html(data);
			}
		});
		}));
		// Function to preview image after validation
		$(function() {
			$("#file").change(function() {
				$("#message").empty();
				var file = this.files[0];
				var fileName = file.name;
				$("#image_name").text(fileName);
				var imagefile = file.type;
				var match= ["image/jpeg","image/png","image/jpg"];
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
				{
					$("#image_name").text("");
					$("#message").text("Please upload a file with a valid format");
					$("#file").val("");
					return false;
				}
				else
				{
					var reader = new FileReader();
					reader.onload = imageIsLoaded;
					reader.readAsDataURL(this.files[0]);
				}
			});
		});

		function imageIsLoaded(e) {
			$("#file").css("color","green");
			$('#image_preview').css("display", "block");
			$('#previewing').attr('src', e.target.result);
			$('#previewing').attr('width', '250px');
			$('#previewing').attr('height', '230px');
		};
	});

</script>

<script type="text/javascript">

	$(document).ready(function (e) {
		$("#upload_biography").on('submit',(function(e) {
			e.preventDefault();
			$("#bio_message").empty();
			$('#loading').show();
			$.ajax({
			url: "biography_upload.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				$('#loading').hide();
				$("#bio_message").html(data);
			}
		});
		}));

		$(function() {
			$("#bio_file").change(function() {
				$("#bio_message").empty();
				var file = this.files[0];
				var fileName = file.name;
				$("#bio_file_name").text(fileName);
				var biofile = file.type;
				var match= ["application/pdf","application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
				if(!((biofile==match[0]) || (biofile==match[1]) || (biofile==match[2])))
				{
					$("#bio_file_name").text("Please upload a file with a valid format");
					$("#bio_file").val("");
					return false;
				}
				else
				{
					var reader = new FileReader();
					reader.readAsDataURL(this.files[0]);
				}
			});
		});
	});
</script>

<script type="text/javascript">

	$(document).ready(function (e) {

		$(function() {
			// this will get the full URL at the address bar
			var url = window.location.href;
			if(url.search("add_artist_biography.php"))
			{
				var lineage_contri = document.getElementById("contri_lineage");
				$(lineage_contri).addClass('active');
			}
		}); 


		$("#upload_bigraphy_text").on('submit',(function(e) {
			e.preventDefault();
			$("#biography_text_message").empty();
			//$('#loading').show();
			$.ajax({
				url: "biography_upload.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
					//$('#loading').hide();
					$("#biography_text_message").show();
					$("#biography_text_message").html(data);
				}
			});
			$('#biography_text').click(function() { $("#biography_text_message").hide(); });
		}));
		if(disabled_input){
			$('input').attr('disabled','true');
			$('textArea').attr('disabled','true');
			$(".action_button").hide();
		}
	});
</script>


<?php
include 'form_links_footer.php';
include 'footer.php';
?>

</html>
