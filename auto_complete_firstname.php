 <?php  
 include 'connection_open.php'; 
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM artist_profile WHERE artist_first_name LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($dbc, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["artist_first_name"].'</li>';  
           }  
      }   
      $output .= '</ul>';  
      echo $output;  
 }
 ?>  