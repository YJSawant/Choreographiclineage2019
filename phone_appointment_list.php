<?php
	include 'path.php';
	include 'AdminMenu.php';
	include 'util.php';

	my_session_start();
	if(isset($_SESSION["user_email_address"])) {

        $user_email_address = $_SESSION["user_email_address"];

        include 'connection_open.php';

        $query = "SELECT * FROM phone_appointments";


        $result = mysqli_query($dbc,$query)
        or die('Error querying database.: ' . mysqli_error());

        $count = mysqli_num_rows($result);
        echo "<table>";
		echo "<tr><th>id</th><th>first_name</th><th>last_name</th><th>contact</th><th>note</th></tr>";

		while($row = mysqli_fetch_array($result)) {
    		$id = $row['id'];
    		$first_name = $row['first_name'];
    		$last_name = $row['last_name'];
    		$contact = $row['contact'];
    		$note = $row['note'];
    		echo "<tr><td style='width: 200px;'>".$id."</td><td style='width: 600px;'>".$first_name."</td><td>".$last_name."</td><td style='width: 200px;'>".$contact."</td><td style='width: 200px;'>".$note."</td></tr>";
              } 

echo "</table>";

        
    }

    else {
        $location = "add_user_profile.php";
        echo("<script>location.href='$location'</script>");
    }

?>