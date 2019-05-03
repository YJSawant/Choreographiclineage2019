<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}

	if(isset($_SESSION["user_email_address"])) {

        $user_email_address = $_SESSION["user_email_address"];

        include 'connection_open.php';

        $query = "SELECT * FROM artist_profile
		WHERE profile_name='$user_email_address'";

        $result = mysqli_query($dbc,$query)
        or die('Error querying database.: ' . mysqli_error());

        $count = mysqli_num_rows($result);

        if ($count == 0) {

            //echo "<legend><strong>Create a new one!</legend></strong>";
            $location = "contribution_introduction.php";
            echo("<script>location.href='$location'</script>");
        }
    }else {
        $location = "add_user_profile.php";
        echo("<script>location.href='$location'</script>");
    }

	// foreach ($_SESSION as $key=>$val)
    // echo $key." ".$val."<br/>";

?>

<html>
	<head>
		<title>Artist Profiles</title>
	</head>

	<body>
	<div class="row">
			<div class="medium-12">
				<section>
					<form id="profiles_form" name="profiles_form" method="post" action="profiles_mediator.php" enctype="multipart/form-data">
					<fieldset>
					<legend><strong><h3>Artist Profiles</h3></legend></strong>
						<div class="row">
							<div class="small-12 column">

                                <table>
                                    <thead>
                                    <tr>
                                        <th width="200">Artist Name</th>
                                        <th width="200">Artist Email Address</th>
                                        <th width="200">Progress</th>
                                        <th width="300"></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    echo "<tbody>";
                                    while ($resultant = mysqli_fetch_array($result)) {
                                        // echo "<tr style='background-color: transparent !important;'>";

                                        echo "<tr>";
                                        echo "<td>" . $resultant['artist_first_name'] . " " . $resultant['artist_last_name'] . "</td>";
                                        echo "<td>" . $resultant['artist_email_address'] . "</td>";
                                        echo "<td>".$resultant['STATUS']."%</td>";
                                        echo "<td>";
                                        echo "<button class='secondary  hollow button' type='submit' name='artist_relation_add' value=" . $resultant['artist_profile_id'] . ">";
                                        echo "<span>Add Lineal Relationships</span>";
                                        echo "</button>";

                                        echo "<button class='primary hollow button' type='submit' name='artist_profile_edit' value=" . $resultant['artist_profile_id'] . ">";
                                        echo "<span>Edit</span>";
                                        echo "</button>";

                                        echo "<button class='success  hollow button' type='submit' name='artist_profile_view' value=" . $resultant['artist_profile_id'] . ">";
                                        echo "<span>View</span>";
                                        echo "</button>";

                                        echo "<button class='alert  hollow button' type='submit' name='artist_profile_delete' value=" . $resultant['artist_profile_id'] . " onclick='confirmDelete();'>";
                                        echo "<span>Delete</span>";
                                        echo "</button>";

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
					?>
							</div>
						</div>
						<div class = "row">
							<div class="small-3 column">
								<button class="secondary hollow button" style="display: none;" type="submit" name="artist_profile_add" value="<?php echo $user_email_address; ?>">
									<span>Add Artist</span>
								</button>
							</div>

				<?php
					if($count!=0){
				?>
				<!--
							<div class="small-3 column">
								<button class="secondary hollow button" type="submit" name="artist_relation_add" value="<?php echo $user_email_address; ?>">
									<span>Add Relation</span>
								</button>
							</div>
						-->
				<?php
					}
				?>
							<div class="small-3 column">
								&nbsp;
							</div>
							<div class="small-3 column">
								&nbsp;
							</div>
						</div>
					</fieldset>
					</form>
				</section>
			</div>
		</div>
	</body>
<div class="footer" style="margin-top:4.5%">
<?php
	include 'footer.php';
?>
</div>
	<script>
	function confirmDelete(){
		var c = confirm("Warning: You are about to delete this entire profile! Click 'OK' to cancel.");
		if(c==true){
		$.ajax({
    		type: 'GET',
    		url: 'logoutdelete.php',
    		
});

	}
	else{
		event.preventDefault();
	}
		
	}
	
	</script>

	<script>
    $(function() {
        // this will get the full URL at the address bar
        var url = window.location.href;
        if(url.search("profiles.php"))
        {
            var lineage_contri = document.getElementById("contri_lineage");
            $(lineage_contri).addClass('active');
        }
    });
</script>

</html>
