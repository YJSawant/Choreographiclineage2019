<?php
	include 'admin_menu.php';
	include 'util.php';
	my_session_start();
?>
		<div class="row">
			<div class="medium-8 column text-justify">
				<section>
					<h4>Welcome to the Choreographic Lineage!</h4>
					<p>Thank you for visiting our site. We hope you will spend time browsing through artists and their lineal connections on the network. We also hope that you will contribute your own lineage to this expanding global resource.</p>
				</section>
				<section>
					<h4>What is Choreographic Lineage?</h4>
					<p>Choreographic Lineage is an interactive, web-based genealogical network illustrating connections between <font color=#0820aa> dance artists,</font> their  <font color=#016400> teachers, </font> their <font color=#016400> students,</font> their <font color=#969101> collaborators</font> and people who they were influenced by. The main goal is to establish a knowledge base documenting 20th and 21st century dance that is searchable and minable and that will continue to grow as new generations of artists are added. Choreographic Lineage is intended as a global resource for investigating artistic influences, career paths, choreographic connections, and complex and obscure relationships.</p>
				</section>
				<section>
					<h4>Contribute your Lineage</h4>
					<p>Your thoughtful completion of the lineage survey regarding your dance background and major influences will be invaluable to the creation of this resource.
						The completion of the Choreographic Lineage survey is voluntary and can be accessed by clicking <a href="add_user_profile.php">here.</a></p>
				</section>
				<section>
					<p>For assistance using this website resource please write to <a href="mailto:choreographiclineage@gmail.com">choreographiclineage@gmail.com</a></p>
				</section>
			</div>

			<aside class="medium-4 column">
				<div class="callout primary">
					<div class="row text-center">
						<div class="small-6 column">
							<a target="_blank" href="https://www.facebook.com/chlineage"><i class="fi-social-facebook"></i></a>
						</div>
						<div class="small-6 column">
							<a target="_blank" href="https://twitter.com/ChLineage"><i class="fi-social-twitter"></i></a>
						</div>
					</div>
				</div>
				<div class="callout primary">
				<button class="accordion"><h5>The Choreographic Lineage Team</h5></button>
					<div class="panel" style="display: block;">
					  	<small>
							<b>Melanie Aceto</b>, Director<br>
							<b>Alan Hunt</b>, Project Manager <br>
                            <b>Dr Bina Ramamurthy</b>, Data Scientist<br>
                            <b>Renee Ruffino</b>, Graphic Designer<br>
                            <b>Domenic Licata</b>, User Experience Designer<br>
							<b>Miki Padhiary</b>, Master's Student <br>
							<b>Shreyas Rajguru</b>, Master's Student<br>
							<b>Amit Banerjee</b>, Master's Student <br>
							<b>Yogesh Sawant</b>, Master's Student <br>
						</small>
					</div>
				</div>
			</aside>
		</div>

		<div class="row">
			<img src="" style="width: 33%;">
			<img src="data/images/logo_ub.jpg" alt="UB logo" style="width: 33%;">		
			<img src="data/images/logo_techne.png" alt="Techne logo" style="width: 33%;">
		</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    }
}
</script>
<?php
	include 'footer.php';
?>
