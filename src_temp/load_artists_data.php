<?php

	include 'connection_open.php';
	//echo ($_POST['mode']);
	$artist = 'artist';
	$query = "SELECT * FROM artist_profile WHERE is_user_artist='$artist'";
	//echo ($query);
	$result = mysql_query($query)
    or die('Error querying database.: '  .mysql_error());

    //$result = mysql_fetch_assoc($result);
    $arr = Array();
    while ($row = mysql_fetch_assoc($result)){
		$arr[] = $row;
	}
    
    echo json_encode($arr);
    
    include 'connection_close.php';

?>