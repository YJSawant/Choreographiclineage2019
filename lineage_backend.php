<?php
include 'connection_open.php';

if(isset($_REQUEST['mode']))	{
	$mode = $_REQUEST['mode'];

	switch($mode)	{
		case "FULL_NETWORK":
			$result = fetch_full_network($dbc);
			echo json_encode($result);
			break;
	}
}

//fetch full network which includes artist ids, relations and names used for nodes and edges
function fetch_full_network($dbc)	{

	//fetch nodes
	//$artist_id_name_query = "SELECT `artist_profile_id`, `artist_first_name`, `artist_last_name`, `is_user_artist`, `artist_photo_path` FROM `artist_profile` WHERE `artist_profile_id` IN (SELECT DISTINCT `artist_profile_id_1` FROM `artist_relation` UNION SELECT DISTINCT `artist_profile_id_2` FROM `artist_relation`)";
$artist_id_name_query = "SELECT `artist_profile_id`, `artist_first_name`, `artist_last_name`, `is_user_artist`, `artist_photo_path`, `artist_living_status`, `artist_dob`, `artist_dod`,`artist_genre`,`artist_ethnicity`,`artist_gender`,`artist_residence_country` FROM `artist_profile` WHERE `artist_profile_id` IN (SELECT DISTINCT `artist_profile_id_1` FROM `artist_relation` UNION SELECT DISTINCT `artist_profile_id_2` FROM `artist_relation`)";
	$artist_id_name_result = mysqli_query($dbc,$artist_id_name_query)
	or die('Error querying database.: '  .mysqli_error($dbc));

	$count = mysqli_num_rows($artist_id_name_result);

	if($count>0){
		$nodes = Array();
		$node_border_array = Array();
		while($row = mysqli_fetch_array($artist_id_name_result)){
			$image = $row['artist_photo_path'];
			if($row['artist_photo_path'] == "") {
				$image = "missing_image.jpg";
			}
			$nodes[] = array('id' => $row['artist_profile_id'], 'title' => $row['artist_first_name']." ".$row['artist_last_name'], 'label' => $row['artist_first_name']." ".$row['artist_last_name'], 'shape'=>"circularImage", 'image' => $image, 'size' => 20,'isLiving' => $row['artist_living_status'],'dob' => $row['artist_dob'],'dod' => $row['artist_dod'],'genre' => $row['artist_genre'],'ethnicity' => $row['artist_ethnicity'],'gender' => $row['artist_gender'],'country' => $row['artist_residence_country']);
			if($row['is_user_artist'] == "artist") {
				$node_border_array[] = array('id' => $row['artist_profile_id'], 'border_color' => '#2F7D82');
			}
			else {
				$node_border_array[] = array('id' => $row['artist_profile_id'], 'border_color' => '#B2497D');
			}
		}
	}


	//fetch edges
	$artist_id_relation_query = "SELECT `artist_profile_id_1`, `artist_profile_id_2`, `artist_relation`, `duration_years`, `duration_months` FROM `artist_relation`";
	$artist_id_relation_result = mysqli_query($dbc,$artist_id_relation_query)
	or die('Error querying database.: '  .mysqli_error($dbc));

	$count = mysqli_num_rows($artist_id_relation_result);

	if($count>0){
		$edges = Array();
		$edge_id = 0;
		while($row = mysqli_fetch_array($artist_id_relation_result)){
			if($row['artist_relation'] == "Influenced By"){
                $duration = 1;
                $edges[] = array('id' => $edge_id, 'from' => $row['artist_profile_id_1'], 'to' => $row['artist_profile_id_2'], 'width' => $duration, 'label' => $row['artist_relation']);
                $edge_id++;
			}else{
                $duration = ($row['duration_years'] * 12 + $row['duration_months'])/3;
                if($row['duration_years'] == 0){
                	if($row['duration_months'] == 1){
                        $title = $row['duration_months']." month";
					}else {
                        $title = $row['duration_months'] . " months";
                    }
				}else if($row['duration_years'] == 1){
                    if($row['duration_months'] == 0){
                        $title = $row['duration_years']." year ";
                    }else if($row['duration_months'] == 1){
                        $title = $row['duration_years']." year ".$row['duration_months']." month";
                    }else {
                        $title = $row['duration_years']." year ".$row['duration_months']." months";
                    }
                }else{
                    if($row['duration_months'] == 0){
                        $title = $row['duration_years']." years ";
                    }else if($row['duration_months'] == 1){
                        $title = $row['duration_years']." years ".$row['duration_months']." month";
                    }else {
                        $title = $row['duration_years']." years  ".$row['duration_months']." months";
                    }
				}

                $edges[] = array('id' => $edge_id, 'from' => $row['artist_profile_id_1'], 'to' => $row['artist_profile_id_2'], 'width' => $duration, 'label' => $row['artist_relation'], 'title' => $title);
                $edge_id++;
			}

		}
	}

//fetch education nodes
	$artist_education_query = "SELECT `artist_profile_id`, `education_type`, `institution_name`, `major`, `degree` FROM `artist_education` WHERE `artist_profile_id` IN (SELECT DISTINCT `artist_profile_id_1` FROM `artist_relation` UNION SELECT DISTINCT `artist_profile_id_2` FROM `artist_relation`)";

	$artist_education_result = mysqli_query($dbc,$artist_education_query)
	or die('Error querying database.: '  .mysqli_error($dbc));

	$count = mysqli_num_rows($artist_education_result);

	if($count>0){
		$education_nodes = Array();

		while($row = mysqli_fetch_array($artist_education_result)){

			$education_nodes[] = array('id' => $row['artist_profile_id'], 'education_type' => $row['education_type'], 'institution_name' => $row['institution_name'], 'major' => $row['major'],'degree' => $row['degree']);

		}
	}

	//fetch number of connections for each node
	$updated_nodes = Array();
	foreach($nodes as $node) {
		$id = $node['id'];
		$artist_id_connections_query = "SELECT COUNT(`artist_profile_id_1`) AS `num_connections` FROM artist_relation WHERE artist_profile_id_1 = $id OR artist_profile_id_2 = $id";
		// echo $artist_id_connections_query;
		$artist_id_connections_result = mysqli_query($dbc,$artist_id_connections_query)
		or die('Error querying database.: '  .mysqli_error($dbc));
		$row = mysqli_fetch_array($artist_id_connections_result);
		$node['size'] = $node['size'] + ($row['num_connections'] * 10);
		$updated_nodes[] = $node;
	}
	$nodes = $updated_nodes;
	return array("nodes" => $nodes, "edges" => $edges, "node_borders" => $node_border_array, "education_nodes" => $education_nodes);
}

//fetches artist name for given artist profile id
function fetch_artist_name($artist_id, $dbc)	{
	$artist_name_query = "SELECT `artist_first_name`, `artist_last_name` FROM `artist_profile` WHERE `artist_profile_id` = $artist_id";
	$artist_name_result = mysqli_query($dbc,$artist_name_query)
	or die('Error querying database.: '  .mysqli_error($dbc));

	$artist_first_name = "";
	$artist_last_name = "";

	while($row = mysqli_fetch_array($artist_name_result)) {
		$artist_first_name = $row['artist_first_name'];
		$artist_last_name = $row['artist_last_name'];
	}

	return $artist_first_name." ".$artist_last_name;
}

include 'connection_close.php';
?>
