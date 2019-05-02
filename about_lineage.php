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
include 'connection_open.php';
                    $fname=$_SESSION["artist_first_name"];
                    $query = "UPDATE artist_profile
                    SET status=75 WHERE artist_first_name= '$fname'";

                    $result = mysqli_query($dbc,$query);

if(isset($_SESSION["artist_profile_id"]) && isset($_SESSION["user_email_address"])){
	$artist_profile_id = $_SESSION["artist_profile_id"];
		// echo $artist_profile_id;
	$user_email_address = $_SESSION["user_email_address"];
		// echo $user_email_address;
}
else{
		// header("Location: add_user_profile.php");
}

foreach ($_SESSION as $key=>$val)
	echo $key." ".$val."<br/>";
?>

<html>
<head>
	<title>About Lineage</title>

</head>

<body>
	<?php
		include 'form_links_header.php'
	?>
	<form id="biography" class="biography">
		<div class="row">

			<ul class="progressbar">
           <li class="active" id="first"><a href="add_artist_profile.php">Add Artist Profile</a></li>
          <li class="active" id="second"><a href="add_artist_personal_information.php">Add Artist Personal Info</a></li>
          <li id="third"><a href="add_artist_biography.php">Add Artist Biography</a></li>
          <li id="fourth"><a href="add_lineage.php">Add Lineage</a></li>
          
  </ul>
		</div>
		<div class="row">
			<div style="clear: both">
                            <h2  style="display:inline;"><strong>ABOUT LINEAGE</strong></h2>
                            <h5  style="display:inline; float: right; color: #006400;"><?php echo "<strong>(You are in ".$_SESSION['timeline_flow']." mode)</strong>";?></h5>
                        </div>
		</div>
		<div class="row">
			<p>There are four types of lineal lines or <strong>Relationships:</strong></p>
			<p>1. <strong>DANCED IN THE WORK OF </strong> - Choreographers for whom you have danced.<br>
			2. <strong>STUDIED UNDER</strong> - Teachers under whom you have studied.<br>
			3. <strong>COLLABORATED WITH</strong> - Artists with whom you have collaborated.<br>
			4. <strong>INFLUENCED BY </strong> - People who have significantly influenced your work, such as artists, authors, philosophers, etc. You do not need to have a <br> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;relationship with this person in order to list them as having an impact on your work.<br><br>
			<br><br>
			<strong>Please click the "Next" button to contribute artist's lineage.</strong>
			</p>


		</div>






        <br/>
		<div class="row">
			<div class="large-2 small-8 columns">
				<button class="primary button" type="button" name="user_profile_submit" id="previous">
					<span>Previous</span>
				</button>
			</div>
			<div class="large-2 small-8 columns">
				<button class="primary button" type="button" name="user_profile_submit" id="next">
					<span>Next</span>
				</button>
			</div>
			<div class="large-2 small-8 columns">
            <button class="primary button" id="next1" type="button">
                <span>Continue Later</span>
            </button>
        </div>
			<div class="column">
			</div>
		</div>
	</form>

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
            window.open("add_artist_biography.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });
   $("#fourth").click(function() {
            // onclick event is assigned to the #button element.
            window.open("add_lineage.php","_self");
            //document.location.href = "add_artist_personal_information.php",true;
        });


		$(function() {
			// this will get the full URL at the address bar
			var url = window.location.href;
			if(url.search("about_lineage.php"))
			{
				var lineage_contri = document.getElementById("contri_lineage");
				$(lineage_contri).addClass('active');
			}
		}); 

		$("#previous").click(function() {
		// onclick event is assigned to the #button element.
			window.open("add_artist_biography.php","_self");

		  //document.location.href = "add_artist_personal_information.php",true;
		});
		// onclick event is assigned to the #button element.
		$("#next").click(function() {
			<?php unset($_SESSION['lineage_artist_first_name']);?>
			window.open("add_lineage.php","_self");
		});

		      $("#next1").click(function() {
        window.open("profiles.php","_self");
    });

	</script>

</body>

<?php
include 'form_links_footer.php';
include 'footer.php';
?>

</html>
