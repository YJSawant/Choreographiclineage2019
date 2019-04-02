<?php 
include 'util.php';

		include 'menu.php';	

?>
<html>
<head>
	<title>Lineage</title>
	<link rel="stylesheet" href="dist/vis-network.min.css" type="text/css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="css/lineage_styles.css" type="text/css" />
</head>
<body  onload="draw()">
	<div id="network_div">
		<div id="network_row" class="row">
			<div id="filter_div" class="small-12 medium-12 large-2 columns">
				<div id="searchbox_row" class="row">
					<div class="large-12 columns">
						<label><b>Search</b></label>
       					<input id="searchbox" type="text" placeholder="Enter Name" />
						<br/>  
						<input id="university-search-box" type="text" placeholder="Enter University" />

						<input id="submit" type="button" value="Submit"/>  
					</div>
				</div>
				<div hidden id="searchbox_node_id">
				</div>
			</div>
			<div id="load" class="loader-frame small-12 medium-12 large-10 columns">
				<div id="loader_circles_div">
					<div class="circle loader1"></div>
					<div class="circle1 loader2"></div>
				</div>
			</div>
			<div id="network_display_div" class="small-12 medium-12 large-10 columns">
				<div id="tab_bar_row" class="row tab">
					<button class="tablinks medium-offset-1 small-3 medium-2 columns active" id="full_network_tab">Full Network</button>
					<button class="tablinks small-2 columns" id="studied_with_tab">Studied under</button>
					<button class="tablinks small-3 medium-2 columns" id="collaborated_with_tab">Collaborated with</button>
					<button class="tablinks small-2 columns" id="danced_for_tab">Danced in the work of</button>
					<button class="tablinks end small-2 columns" id="influenced_by_tab">Influenced by</button>
				</div>
				<div hidden id="searchTextValue">
				</div>
				<div id="search_text">
				</div>
				<div id="my_network">
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="dist/vis.js"></script>
	<script src="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="js/lineage_network.js"></script>
</body>
</html>