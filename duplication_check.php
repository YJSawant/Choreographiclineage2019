 <?php  
 #$connect = mysqli_connect("localhost", "root", "", "Choreographiclineage2019");  
 include 'connection_open.php';

 if(isset($_POST["first"]) && isset($_POST["last"]))  
 {  
      $output = '';  
      $first=$_POST["first"];
      $last=$_POST["last"];
      $query = "SELECT * FROM artist_profile WHERE artist_first_name = '$first' and artist_last_name='$last' ";  
      $result = mysqli_query($dbc, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           $output="!! User already exists. Please change artist name";
      }  
       else  
       {  
          $output = " ";  
       }  
      
      echo $output;  
 }  
 ?>  