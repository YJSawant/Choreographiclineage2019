<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';

	my_session_start();
	echo("IN BACK BTN ");
	echo (($_POST["gender"]));
	if(isset($_POST["gender"]) && !empty($_POST["gender"])){
			$_SESSION["gender"] = $_POST["gender"];
			echo($_SESSION["gender"]);
		}

		if(isset($_POST["gender_other"]) && !empty($_POST["gender_other"])){
			$_SESSION["gender_other"] = $_POST["gender_other"];
		}

		if (isset($_POST["date_of_birth"]) && !empty($_POST["date_of_birth"])){
			$_SESSION["date_of_birth"] = $_POST["date_of_birth"];	
		}

		if(isset($_POST["ethnicity"]) && !empty($_POST["ethnicity"])){
			$_SESSION["ethnicity"] = $_POST["ethnicity"];
			echo($_SESSION["ethnicity"]);
		}

		if(isset($_POST["ethnicity_other"]) && !empty($_POST["ethnicity_other"])){
			$_SESSION["ethnicity_other"] = $_POST["ethnicity_other"];

			
		}

		if(isset($_POST["city_residence"]) && !empty($_POST["city_residence"])){
			$_SESSION["city_residence"] = $_POST["city_residence"];
			echo($_SESSION["city_residence"]);
			
		}

		if(isset($_POST["country_residence"]) && !empty($_POST["country_residence"])){
			$_SESSION["country_residence"] = $_POST["country_residence"];
		
		}

		if(isset($_POST["state_residence"]) && !empty($_POST["state_residence"])){
			$_SESSION["state_residence"] = $_POST["state_residence"];
			
		}

		if(isset($_POST["state_province"]) && !empty($_POST["state_province"])){
			$_SESSION["state_province"] = $_POST["state_province"];
			
		}

		if(isset($_POST["country_birth"]) && !empty($_POST["country_birth"])){
			$_SESSION["country_birth"] = $_POST["country_birth"];
			
		}

		if(isset($_POST["university"]) && !empty($_POST["university"])){
			$_SESSION["university"] = $_POST["university"];
			
		}

		if(isset($_POST["major"]) && !empty($_POST["major"])){
			$_SESSION["major"] = $_POST["major"];
			
		}

		if(isset($_POST["degree"]) && !empty($_POST["degree"])){
			$_SESSION["degree"] = $_POST["degree"];
			
		}

		if(isset($_POST["institution_name"]) && !empty($_POST["institution_name"])){
			$_SESSION["institution_name"] = $_POST["institution_name"];
			
		}

		if(isset($_POST["other_degree"]) && !empty($_POST["other_degree"])){
			$_SESSION["other_degree"] = $_POST["other_degree"];
		
		}
		if(isset($_POST["biography_text"])) {
			echo ("INN IFFFF ");
			$_SESSION["biography_text"] = $_POST["biography_text"];
			echo ($_SESSION["biography_text"]);
		}
		




	if(isset($_POST["lineage_artist_first_name"]) && !empty($_POST["lineage_artist_first_name"])){
      $_SESSION["lineage_artist_first_name"] = $_POST["lineage_artist_first_name"];
	}

	if(isset($_POST["lineage_artist_last_name"]) && !empty($_POST["lineage_artist_last_name"])){
	  $_SESSION["lineage_artist_last_name"] = $_POST["lineage_artist_last_name"];
	}

	if(isset($_POST["lineage_artist_email_address"]) && !empty($_POST["lineage_artist_email_address"])){
	  $_SESSION["lineage_artist_email_address"] = $_POST["lineage_artist_email_address"];
	}

	if(isset($_POST["lineage_artist_website"]) && !empty($_POST["lineage_artist_website"])){
	  $_SESSION["lineage_artist_website"] = $_POST["lineage_artist_website"];
	}

	if(isset($_POST["studied_start_date"]) && !empty($_POST["studied_start_date"])){
	  $_SESSION["studied_start_date"] = $_POST["studied_start_date"];
	}

	if(isset($_POST["studied_end_date"]) && !empty($_POST["studied_end_date"])){
	  $_SESSION["studied_end_date"] = $_POST["studied_end_date"];
	}

	if(isset($_POST["studied_duration_years"]) && !empty($_POST["studied_duration_years"])){
	  $_SESSION["studied_duration_years"] = $_POST["studied_duration_years"];
	}

	if(isset($_POST["studied_duration_months"]) && !empty($_POST["studied_duration_months"])){
	  $_SESSION["studied_duration_months"] = $_POST["studied_duration_months"];
	}

	if(isset($_POST["danced_start_date"]) && !empty($_POST["danced_start_date"])){
	  $_SESSION["danced_start_date"] = $_POST["danced_start_date"];
	}

	if(isset($_POST["danced_end_date"]) && !empty($_POST["danced_end_date"])){
	  $_SESSION["danced_end_date"] = $_POST["danced_end_date"];
	}

	if(isset($_POST["danced_duration_years"]) && !empty($_POST["danced_duration_years"])){
	  $_SESSION["danced_duration_years"] = $_POST["danced_duration_years"];
	}

	if(isset($_POST["danced_duration_months"]) && !empty($_POST["danced_duration_months"])){
	  $_SESSION["danced_duration_months"] = $_POST["danced_duration_months"];
	}

	if(isset($_POST["collaborated_start_date"]) && !empty($_POST["collaborated_start_date"])){
	  $_SESSION["collaborated_start_date"] = $_POST["collaborated_start_date"];
	}

	if(isset($_POST["collaborated_end_date"]) && !empty($_POST["collaborated_end_date"])){
	  $_SESSION["collaborated_end_date"] = $_POST["collaborated_end_date"];
	}

	if(isset($_POST["collaborated_duration_years"]) && !empty($_POST["collaborated_duration_years"])){
	  $_SESSION["collaborated_duration_years"] = $_POST["collaborated_duration_years"];
	}

	if(isset($_POST["collaborated_duration_months"]) && !empty($_POST["collaborated_duration_months"])){
	  $_SESSION["collaborated_duration_months"] = $_POST["collaborated_duration_months"];
	}

	if(isset($_POST["relationship_influenced"])){
	  foreach ($_POST["relationship_influenced"] as $influenced) {
	    $influenced_by[$influenced] = $influenced;
	  }
	  $_SESSION["influenced_by"] = $influenced_by;
	}


?>