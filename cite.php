<?php
include ("head.html");
?>
	<link rel="stylesheet" type="text/css" href="css/_normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/_demo.css" />
	<link rel="stylesheet" type="text/css" href="css/_tabs.css" />
	<link rel="stylesheet" type="text/css" href="css/_tabstyles.css" />
	<script src="js/_modernizr.custom.js"></script>



<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>
	<svg class="hidden">
		<defs>
			<path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"/>
		</defs>
	</svg>

	<div id="content">
		<!-- <p class="intro"> Nobody cited us so far</p> -->
		<br> 
		<section>
			<div class="tabs intro tabs-style-tzoid">
				<nav>
					<ul>
						<li><a href="#section-tzoid-1" class="icon"><span>Cited by our paper</span></a></li>
						<li><a href="#section-tzoid-2" class="icon"><span>Cited our paper</span></a></li>
						<li><a href="#section-tzoid-3" class="icon"><span>Other useful links</span></a></li>
						<li><a href="#section-tzoid-4" class="icon"><span>Some basic knowledge</span></a></li>
					</ul>
				</nav>
				<div class="content-wrap">
					<section id="section-tzoid-1">
						<div class="intro">
							<p> This is an step by step tutorial on how to classify your sequences based on in-genome homoly, using SCGDB method. </p><br>
							<p> <b>Requirments:</b> </p>
							<ul>
							<li><b>Python 2.7 or later</b></li>
							</ul>
						</div>

					</section>
					<section id="section-tzoid-2">
						<div class="intro">
							<p> This is an step by step tutorial on how to classify your sequences based on in-genome homoly, using SCGDB method. </p><br>
							<p> <b>Requirments:</b> </p>
							<ul>
							<li><b>Python 2.7 or later</b></li>
							</ul>
						</div>

					</section>
					<section id="section-tzoid-3"><p>3</p></section>
					<section id="section-tzoid-4"><p>4</p></section>
				</div><!-- /content -->
			</div><!-- /tabs -->
		</section>

		<script src="js/_cbpFWTabs.js"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>

<?php
include ("footer.html");
?>
