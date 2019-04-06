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
						<input style="margin: auto;" id="university-search-box" type="text" placeholder="Enter University" />
						<label style="margin: auto;"><b>Living Status</b></label>
						<label><input id="living" type="checkbox" name="checkbox">Living</label>
						<label><input id="dead" type="checkbox" name="checkbox"></span>Deceased</label>
						<label style="margin: auto;"><b>Gender</b></label>
						<label><input id="male" type="radio" name="radio"></span>Male</label>
						<label><input id="female" type="radio" name="radio"></span>Female</label>
						<input style="margin-bottom: 16px;" id="state-search-box" type="text" placeholder="Enter State Code" />
						<input style="margin-bottom: 16px;" id="country-search-box" type="text" placeholder="Enter Country" />
						<input style="margin-bottom: 16px;" id="submit" type="button" value="Submit"/>
					</div>
				</div>
				<div class='my-legend'style="margin: auto;">
						<div class='legend-title'>Network Guide</div>
						<div class='legend-scale'>
  					<ul class='legend-labels'>
    					<li><span class="bluenode"></span>Own Contribution</li>
    					<li><span class="rednode"></span>Other's Contribution</li>
    					<li><span class="redarrow"></span>Studied Under</li>
    					<li><span class="yellowarrow"></span>Collaborated With</li>
    					<li><span class="greenarrow"></span>Danced For</li>
						<li><span class="bluearrow"></span>Influenced By</li>
   				</ul>
				</div>
			</div>

<style type='text/css'>
	.bluenode:before {
		content: '\26AC';
		font-size: 20px;
		color:blue;
		}
	.rednode:before{
		content:'\26AC';
		font-size:20px;
		color:red;
	}
	.redarrow:before{
		content:'\279B';
		font-size:20px;
		color:red;
	}
	.yellowarrow:before{
		content:'\279B';
		font-size:20px;
		color:yellow;
	}
	.greenarrow:before{
		content:'\279B';
		font-size:20px;
		color:green;
	}
	.bluearrow:before{
		content:'\279B';
		font-size:20px;
		color:blue;
	}

  .my-legend .legend-title {
    text-align: left;
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 90%;
    }
  .my-legend .legend-scale ul {
    margin: 0;
    margin-bottom: 5px;
    padding: 0;
    float: left;
    list-style: none;
    }
  .my-legend .legend-scale ul li {
    font-size: 80%;
    list-style: none;
    margin-left: 0;
    line-height: 18px;
    margin-bottom: 2px;
    }
  .my-legend ul.legend-labels li span {
    display: block;
    float: left;
    height: 16px;
    width: 30px;
    margin-right: 5px;
    margin-left: 0;
    border: 1px solid #999;
    }
  .my-legend .legend-source {
    font-size: 70%;
    color: #999;
    clear: both;
    }
  .my-legend a {
    color: #777;
    }
</style>
				<div hidden id="searchbox_node_id">
				</div>
				<!-- <div hidden id="uni_searchbox_node_id">
				</div> -->
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
				<div hidden id="uniTextValue">
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
