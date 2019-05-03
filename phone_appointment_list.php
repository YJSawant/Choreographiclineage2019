<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php
	include 'admin_menu.php';
	include 'util.php';
	my_session_start();
	if(isset($_SESSION["user_email_address"])) {

        $user_email_address = $_SESSION["user_email_address"];

        include 'connection_open.php';

        $query = "SELECT * FROM phone_appointments where status='Undone' order by submitted_date ASC";


        $result = mysqli_query($dbc,$query)
        or die('Error querying database.: ' . mysqli_error());

        $count = mysqli_num_rows($result);
        echo "<table style='width:auto;'align='center'><tr><td>";
        echo "<div align='center'><a href='phone_appointment_list_done.php'><button style='background-color: green;  border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;'>View Completed Phone Appointments</button></div>";
        echo"</td><td>";
        echo "<div align='center'><a href='phone_appointment_list.php'><button style='background-color: green;  border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;'>View Pending Phone Appointments</button></div>";
        echo "</td></tr></table>";

        echo "<div class='table-responsive'><table style='width: 60%; height: auto;' align='center'>";
		echo "<tr><th>id</th><th>First Name</th><th>Last Name</th><th>Contact</th><th>Notes</th><th>Submission Date</th></tr>";

		while($row = mysqli_fetch_array($result)) {
    		$ID = $row['id'];
    		$Firstname = $row['first_name'];
    		$Lastname = $row['last_name'];
    		$Contact = $row['contact'];
    		$Note = $row['note'];
            $SubmissionDate=$row['submitted_date'];
    		echo "<tr>
            <td style='width: 100px;'>".$ID."</td>
            <td style='width: 200px;'>".$Firstname."</td>
            <td>".$Lastname."</td>
            <td style='width: 200px;'>".$Contact."</td>
            <td style='width: 200px;'>".$Note."</td>
            <td style='width: 200px;'>".$SubmissionDate."</td>
            <td style='width: 200px;'>
            <button style='color:green;background-color:#99ff99;border-radius:.5px' type='button'><a href='done.php?id=".$ID."'>Mark as Done</button></td>
            </tr>";
        }
    echo "</table></div>";
    }
    else {
        $location = "add_user_profile.php";
        echo("<script>location.href='$location'</script>");
    }

?>
<script>
    $(document).ready(function(){
    //     $(function() {
    //     var url = window.location.href;
    //     if(url.search("phone_appointment_list.php"))
    //     {
    //         var phone_appointment = document.getElementById("phone_appointment");
	// 		$(phone_appointment).addClass('active');
    //     }else{
    //         var home2 = document.getElementById("admin_home");
	// 		home2.classList.remove('active');
    //     }
	// });
    $(function(){
        var url = window.location.href;
        if(url.search("phone_appointment_list.php"))
        {
            var phone_appointment = document.getElementById("phone_appointment");
            $(phone_appointment).addClass('active');
            var adminHome = document.getElementById("admin_home");
            adminHome.classList.remove('active');
        }
        // $('a').each(function(){
        //     if ($(this).prop('href') == window.location.href) {
        //         $(this).addClass('active');
        //     }
        //     else{
        //         var adminHome = document.getElementById("admin_home");
        //         adminHome.classList.remove('active');
        //     }
        // });
    });
});
    function confirmDone(){
        location.reload();
    }
</script>
</html>
<?php
  include 'footer.php';
?>
