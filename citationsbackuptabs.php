<?php
include ("head.html");
?>
<title>ParalogyDB | Citation</title>

<link rel="stylesheet" type="text/css" href="css/_tabs.css" />
<link rel="stylesheet" type="text/css" href="css/_tabstyles.css" />

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>
<div id="content">
<br> 
	<div class="tabs tabs-style-tzoid">
		<nav>
			<ul>
				<li><a href="#section-tzoid-1" class="icon"><span>Cited by our paper</span></a></li>
				<li><a href="#section-tzoid-2" class="icon"><span>Cited our paper</span></a></li>
				<li><a href="#section-tzoid-3" class="icon"><span>Other useful links</span></a></li>
			</ul>
		</nav>
		<div class="content-wrap">
			<section id="section-tzoid-1">
				<div>
				<hr>
				<p> Ritter O, Kocab P, Senger M, Wolf D, Suhai S: Prototype implementation of the integrated genomic database. Computers and Biomedical Research 1994, 27: 97–115. 10.1006/cbmr.1994.1011 </p>
				</div>
			</section>
			<section id="section-tzoid-2">
				<div>
				<hr>
				<p> Ritter O, Kocab P, Senger M, Wolf D, Suhai S: Prototype implementation of the integrated genomic database. Computers and Biomedical Research 1994, 27: 97–115. 10.1006/cbmr.1994.1011 </p>
				</div>
			</section>
			<section id="section-tzoid-3">
				<div>
				<hr>
				<p> Ritter O, Kocab P, Senger M, Wolf D, Suhai S: Prototype implementation of the integrated genomic database. Computers and Biomedical Research 1994, 27: 97–115. 10.1006/cbmr.1994.1011 </p>
				</div>
			</section>
		</div><!-- /content -->
	</div><!-- /tabs -->

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
