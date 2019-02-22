<?php
	include 'path.php';
	include 'menu.php';
	include 'util.php';

	my_session_start();

	my_session_destroy();
	$location = "add_user_profile.php";
	//header("Location: index.php");
	echo ("<script>location.href='$location'</script>");?>
