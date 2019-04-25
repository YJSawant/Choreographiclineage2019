<?php

	include 'connection_open.php';
	//echo ($_POST['mode']);
	$query = "SELECT * FROM genres";
	//echo ($query);
	$result = mysqli_query($dbc,$query)
    or die('Error querying database.: '  .mysqli_error());

    //$result = mysqli_fetch_assoc($result);
    $arr = Array();
    while ($row = mysqli_fetch_assoc($result)){
		$arr[] = $row;
	}

    echo json_encode($arr);

    include 'connection_close.php';

?>
