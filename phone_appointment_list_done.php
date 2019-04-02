<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php
	include 'path.php';
	include 'AdminMenu.php';
	include 'util.php';

	my_session_start();
	if(isset($_SESSION["user_email_address"])) {

        $user_email_address = $_SESSION["user_email_address"];

        include 'connection_open.php';

        $query = "SELECT * FROM phone_appointments where status='Done'";


        $result = mysqli_query($dbc,$query)
        or die('Error querying database.: ' . mysqli_error());

        $count = mysqli_num_rows($result);
        echo "<div align='center'><a href='phone_appointment_list.php'><button style='background-color: green;  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;' >View pending Phone Appointments</button></div>";

        echo "<div class='table-responsive'><table style='width: 60%; height: auto;' align='center'>";
		echo "<tr><th>id</th><th>First Name</th><th>Last Name</th><th>Contact</th><th>Notes</th></tr>";

		while($row = mysqli_fetch_array($result)) {
    		$id = $row['id'];
    		$first_name = $row['first_name'];
    		$last_name = $row['last_name'];
    		$contact = $row['contact'];
    		$note = $row['note'];
    		echo "<tr><td style='width: 100px;'>".$id."</td><td style='width: 200px;'>".$first_name."</td><td>".$last_name."</td><td style='width: 200px;'>".$contact."</td><td style='width: 200px;'>".$note."</td></tr>";
              }

echo "</table></div>";

    }

    else {
        $location = "add_user_profile.php";
        echo("<script>location.href='$location'</script>");
    }

?>
    <script>
    function confirmDone(){

        //var c = confirm("Warning: You are about to confirm this appointment schedule profile!");
        //return c;
        location.reload();
    }
    </script>
</html>
<?php
  include 'footer.php';
?>
