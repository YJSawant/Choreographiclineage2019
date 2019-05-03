<!--
<div class="row">
	<div class="medium-12">
-->
<div class="row">
	<div class="medium-12">
		<section>
<?php
if(isset($_SESSION["user_email_address"])){
	echo "<div class='text-right'>";
	echo "Logged in as: ".$_SESSION["user_email_address"]."&nbsp;<a href='logout.php'>Logout</a>";
	echo "</div>";
}
?>
		</section>
	</div>
</div>
<footer class="row" style="position:relative;height: auto;bottom:0;">
		<div class="small-6 column">
			<ul class="vertical medium-horizontal menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="faq.php">FAQ</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="contact.php">Contact</a></li>
				<li><a href="help.php">Help</a></li>
			</ul>
		</div>
		<div class="small-6 column" >
			<ul class="menu align-right">
				<li class="menu-text"><small>Choreographic Lineage © 2019</small></li>
			</ul>
		</div>
</footer>

<script>
$(document).ready(function(){
    $(function() {
			var url = window.location.href;
			if(url.search("admin_index.php"))
			{
				var home = document.getElementById("admin_home");
				$(home).addClass('active');
			}else if(url.search("index.php"))
			{
				var home = document.getElementById("home");
				$(home).addClass('active');
			}
		});  
});
</script>
