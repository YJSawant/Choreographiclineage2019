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
					<div class="large-13 columns">
						<label><b>Search</b></label>
       					<input id="searchbox" type="text" placeholder="Enter Name" />
						<input style="margin-bottom: 10px;" id="university-search-box" type="text" placeholder="Enter University" />
						<label><b>Living Status</b></label>
						<label style="display:inline-block;"><input id="chk" type="checkbox" class="checkbox_living" value="living">Living</label>
						<label style="display:inline-block;"><input id="chk" type="checkbox" class="checkbox_living" value="deceased"></span>Deceased</label>
						<label><b>Gender</b></label>
						<label style="display:inline-block;"><input id="chk" type="checkbox" class="checkbox_gender" value="male"></span>Male</label>
						<label style="display:inline-block;"><input id="chk" type="checkbox" class="checkbox_gender" value="female"></span>Female</label>
						<input style="margin-bottom: 10px;" id="state-search-box" type="text" placeholder="Enter State Code" />
						<input style="margin-bottom: 10px;" id="country-search-box" type="text" placeholder="Enter Country" />
						<input style="margin-bottom: 10px;" id="major-search-box" type="text" placeholder="Enter Major" />
						<input style="margin-bottom: 10px;" id="degree-search-box" type="text" placeholder="Enter Degree" />
						<input style="margin-bottom: 10px;" id="ethnicity-search-box" type="text" placeholder="Enter Ethnicity" />
						<input style="margin-bottom: 10px;" id="submit" type="button" value="Submit"/>
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
				<div hidden id="uniTextValue">
				</div>
				<div hidden id="stateTextValue">
				</div>
				<div hidden id="countryTextValue">
				</div>
				<div hidden id="majorTextValue">
				</div>
				<div hidden id="degreeTextValue">
				</div>
				<div hidden id="ethnicityTextValue">
				</div>
				<div id="search_text">
				</div>
				<div id="my_network" class="small-12 medium-12 large-14 columns">
				</div>
				<div hidden id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<img class="pic" id="artist_pic" src = "">
					<div id="artist_name" class="name"> </div>
					<div id="artist_gender" class="gender"> </div>
					<div id="artist_status" class="status"> </div>
					<!-- <a href="http://www.google.com" id="artist_biography" class="biography">Click here for biography</a> -->
				</div>
			</div>
		</div>
	</div>
	<style type='text/css'>
	.pic{
		height: 240px;
		margin-bottom: 12px;
		overflow:hidden;	
		width: 100%;			
	}

	.name{
		text-align : center;
		font-weight: bold;
		margin-bottom: 12px;
	}

	.gender{
		text-align : center;
		margin-bottom: 12px;
	}
	.status{
		text-align : center;
		margin-bottom: 12px;
	}

	.biography{
		text-align : center;
		margin-bottom: 12px;
	}
	.bluenode:before {
		content: '\26AC';
		font-size: 20px;
		color:#da0067;
		}
	.rednode:before{
		content:'\26AC';
		font-size:20px;
		color:#025457;
	}
	.redarrow:before{
		content:'\279B';
		font-size:20px;
		color:red;
	}
	.yellowarrow:before{
		content:'\279B';
		font-size:20px;
		color:#FFC300;
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

body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  width: 0%;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: #DCDCDC;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
	<script>
		function closeNav() {
		document.getElementById("mySidenav").style.display = "none"; 
		document.getElementById("mySidenav").style.width = "0";	
		}
	</script>
	<script type="text/javascript" src="dist/vis.js"></script>
	<script src="https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="js/lineage_network.js"></script>
</body>
</html>
