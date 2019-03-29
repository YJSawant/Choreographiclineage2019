<?php 
        
        require_once 'connection_open.php';
 
     
         #$id = $_GET['id'];
 		$id = $_GET['id'];
        $sql = "UPDATE phone_appointments SET status='Done' WHERE id = {$id}";
        $result = mysqli_query($dbc,$sql);
      
    
echo ("<script>location.href='phone_appointment_list.php'</script>");

   
?>