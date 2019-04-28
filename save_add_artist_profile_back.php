<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';

	my_session_start();
	if(isset($_GET["profile_selection"]) && !empty($_GET["profile_selection"])){
		$_SESSION["profile_selection"] = $_GET["profile_selection"];
	}

	if(isset($_GET["artist_first_name"]) && !empty($_GET["artist_first_name"])){
	  $_SESSION['artist_first_name'] = $_GET["artist_first_name"];
	}
	echo($_SESSION['artist_first_name']);
	
	if(isset($_GET["artist_last_name"]) && !empty($_GET["artist_last_name"])){
	  $_SESSION["artist_last_name"] = $_GET["artist_last_name"];
	}

	if(isset($_GET["artist_email_address"]) && !empty($_GET["artist_email_address"])){
	  $_SESSION["artist_email_address"] = $_GET["artist_email_address"];
	}

	if(isset($_GET["artist_status"]) && !empty($_GET["artist_status"])){
	  $_SESSION["artist_status"] = $_GET["artist_status"];
	}

	if(isset($_GET["date_of_birth"]) && !empty($_GET["date_of_birth"])){
	  $_SESSION["date_of_birth"] = $_GET["date_of_birth"];
	}

	if(isset($_GET["date_of_death"]) && !empty($_GET["date_of_death"])){
	  $_SESSION["date_of_death"] = $_GET["date_of_death"];
	}

	if(isset($_GET["artist_genre"]) && !empty($_GET["artist_genre"])){
		if(count($_GET["artist_genre"]) != 0){
			$_SESSION["artist_genre"] = "";
			foreach ($_GET["artist_genre"] as $genrevar) {
				$_SESSION["artist_genre"] = $_SESSION["artist_genre"] . "," . $genrevar;
			}
		}
	}

	if(isset($_GET["other_artist_text_input"]) && !empty($_GET["other_artist_text_input"])){
	  $_SESSION["other_artist_text_input"] = $_GET["other_artist_text_input"];
	}
	exit();
?>