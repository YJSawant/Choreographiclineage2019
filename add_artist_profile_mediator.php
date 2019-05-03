<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}

print_r($_POST["artist_first_name"]);
print_r($_POST["relationship_studied"]);
print_r($_POST["studied_start_date"]);

 ?>
