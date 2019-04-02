<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';

	my_session_start();


	if(isset($_POST['artist_profile_delete'])){

		$artist_profile_id = $_POST['artist_profile_delete'];
		include 'connection_open.php';
		$query = "DELETE FROM artist_profile WHERE artist_profile_id='$artist_profile_id'";
		$result = mysqli_query($dbc,$query)
		or die('Error querying database.: '  .mysqli_error($dbc));
		include 'connection_close.php';
		$location = "profiles.php";
		//header("Location: ".$location."");
	}
	else if(isset($_POST['artist_profile_add'])){

		$_SESSION["user_email_address"] = $_POST['artist_profile_add'];
		$_SESSION["artist_profile_add"] = "add";
        $_SESSION["timeline_flow"] = "artist_add";
		$location = "contribution_introduction.php";
        $_SESSION["artist_profile_id"] = "";

        unset($_SESSION["artist_first_name"]);
        unset($_SESSION["artist_last_name"]);
        unset($_SESSION["artist_email_address"]);
        unset($_SESSION["artist_status"]);
        unset($_SESSION["date_of_birth"]);
        unset($_SESSION["date_of_death"]);
        unset($_SESSION["artist_genre"]);
        unset($_SESSION["other_artist_text_input"]);
        unset($_SESSION["gender"]);
        unset($_SESSION["gender_other"]);
        unset($_SESSION["ethnicity"]);
        unset($_SESSION["ethnicity_other"]);
        unset($_SESSION["city_residence"]);
        unset($_SESSION["country_residence"]);
        unset($_SESSION["state_residence"]);
        unset($_SESSION["state_province"]);
        unset($_SESSION["country_birth"]);
        unset($_SESSION["photo_file_path"]);
        unset($_SESSION["biography_file_path"]);
        unset($_SESSION["biography_text"]);

        unset($_SESSION["university"]);
        unset($_SESSION["major"]);
        unset($_SESSION["degree"]);
        unset($_SESSION["institution_name"]);
        unset($_SESSION["other_degree"]);

        unset($_SESSION["lineage_artist_first_name"]);
        unset($_SESSION["lineage_artist_last_name"]);
        unset($_SESSION["lineage_artist_email_address"]);
        unset($_SESSION["lineage_artist_website"]);
        unset($_SESSION["studied_start_date"]);
        unset($_SESSION["studied_end_date"]);
        unset($_SESSION["studied_duration_years"]);
        unset($_SESSION["studied_duration_months"]);
        unset($_SESSION["danced_start_date"]);
        unset($_SESSION["danced_end_date"]);
        unset($_SESSION["danced_duration_years"]);
        unset($_SESSION["danced_duration_months"]);
        unset($_SESSION["collaborated_start_date"]);
        unset($_SESSION["collaborated_end_date"]);
        unset($_SESSION["collaborated_duration_years"]);
        unset($_SESSION["collaborated_end_date"]);
        unset($_SESSION["influenced_by"]);

	}
	else if(isset($_POST['artist_profile_edit'])){

		$_SESSION["artist_profile_id"] = $_POST['artist_profile_edit'];
		$_SESSION["artist_profile_edit"] = "edit";
		$location = "artist_database_retrieval.php";
        $_SESSION["timeline_flow"] = "edit";
		//header("Location: ".$location."");
	}
	else if(isset($_POST['artist_profile_view'])){

		$_SESSION["artist_profile_id"] = $_POST['artist_profile_view'];
		$_SESSION["artist_profile_view"] = "view";
		$location = "artist_database_retrieval.php";
        $_SESSION["timeline_flow"] = "view";
		//header("Location: ".$location."");
	}
	else if(isset($_POST['artist_relation_add'])){

		$_SESSION["artist_profile_id"] = $_POST['artist_relation_add'];
		$_SESSION["artist_relation_add"] = "relation";
		$location = "add_artist_relation_mediator.php";
        $_SESSION["timeline_flow"] = "relation_add";
		//header("Location: ".$location."");

        unset($_SESSION["artist_first_name"]);
        unset($_SESSION["artist_last_name"]);
        unset($_SESSION["artist_email_address"]);
        unset($_SESSION["artist_status"]);
        unset($_SESSION["date_of_birth"]);
        unset($_SESSION["date_of_death"]);
        unset($_SESSION["artist_genre"]);
        unset($_SESSION["other_artist_text_input"]);
        unset($_SESSION["gender"]);
        unset($_SESSION["gender_other"]);
        unset($_SESSION["ethnicity"]);
        unset($_SESSION["ethnicity_other"]);
        unset($_SESSION["city_residence"]);
        unset($_SESSION["country_residence"]);
        unset($_SESSION["state_residence"]);
        unset($_SESSION["state_province"]);
        unset($_SESSION["country_birth"]);
        unset($_SESSION["photo_file_path"]);
        unset($_SESSION["biography_file_path"]);
        unset($_SESSION["biography_text"]);

        unset($_SESSION["university"]);
        unset($_SESSION["major"]);
        unset($_SESSION["degree"]);
        unset($_SESSION["institution_name"]);
        unset($_SESSION["other_degree"]);

        unset($_SESSION["lineage_artist_first_name"]);
        unset($_SESSION["lineage_artist_last_name"]);
        unset($_SESSION["lineage_artist_email_address"]);
        unset($_SESSION["lineage_artist_website"]);
        unset($_SESSION["studied_start_date"]);
        unset($_SESSION["studied_end_date"]);
        unset($_SESSION["studied_duration_years"]);
        unset($_SESSION["studied_duration_months"]);
        unset($_SESSION["danced_start_date"]);
        unset($_SESSION["danced_end_date"]);
        unset($_SESSION["danced_duration_years"]);
        unset($_SESSION["danced_duration_months"]);
        unset($_SESSION["collaborated_start_date"]);
        unset($_SESSION["collaborated_end_date"]);
        unset($_SESSION["collaborated_duration_years"]);
        unset($_SESSION["collaborated_end_date"]);
        unset($_SESSION["influenced_by"]);

	}
	echo ("<script>location.href='$location'</script>");?>
?>
