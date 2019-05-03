<?php
include 'util.php';
my_session_start();
if($_SESSION["user_type"] == "Admin")
{
	include 'admin_menu.php';
}else{
	include 'menu.php';
}
my_session_destroy();
$location = "index.php";
//header("Location: index.php");
echo ("<script>location.href='$location'</script>");?>
