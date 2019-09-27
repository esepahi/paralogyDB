<!-- Head tag ends here and body tag starts. in php file insert nav and content div. then include footer. body tag ends in footer file -->
</head>
<body>
<div id="wrapper">
	<div id="cbb">
	<a href= "https://ut.ac.ir/en" target="_blank"><img src="images/ut-en.png" height="35px" alt="University of Tehran"></a>    |    
	<a href= "http://cbb.ut.ac.ir/" target="_blank"><img src="images/cbb-logo.jpg" height="40px" alt="Lab of complex biological systems and bioinformatics (CBB)"></a>
	</div>
	<div id="siteheader">
	<br>
		<div id="header-e1">
			<?php $pgnm=basename($_SERVER['PHP_SELF']);?>
			<div id=<?php if ($pgnm=="index.php") {echo "hplogo";} else {echo "none";}?>>
				<a href= "index.php"><img src="images/ParalogyDB.png" height="120px" alt="ParalogyDB"> </a>
			</div>
		</div>
		<div id="header-e2"  align= "center">
			<div id="headernav">
			<div class="topheadernav">
			<?php $pgnm=basename($_SERVER['PHP_SELF']);?>
			  <a class=<?php if ($pgnm=="index.php") {echo "active";} else {echo "none";}?> href="index.php">Home</a>
			  <a class=<?php if ($pgnm=="networks.php" or $pgnm=="networks-results.php") {echo "active";} else {echo "none";}?> href="networks.php">Networks</a>
			  <a class=<?php if ($pgnm=="classify.php") {echo "active";} else {echo "none";}?> href="classify.php">Classify</a>
			  <a class=<?php if ($pgnm=="enrich.php" or $pgnm=="enrich-results.php") {echo "active";} else {echo "none";}?> href="enrich.php">Enrich</a>
			  <a class=<?php if ($pgnm=="database-in-brief.php") {echo "active";} else {echo "none";}?> href="database-in-brief.php">Database in brief</a>
			  <a class=<?php if ($pgnm=="download.php") {echo "active";} else {echo "none";}?> href="download.php">Download</a>
			  <a class=<?php if ($pgnm=="updates.php") {echo "active";} else {echo "none";}?> href="updates.php">Updates</a>
			  <a class=<?php if ($pgnm=="tutorial-and-glossary.php") {echo "active";} else {echo "none";}?> href="tutorial-and-glossary.php">Tutorial and glossary</a>
			  <a class=<?php if ($pgnm=="about.php") {echo "active";} else {echo "none";}?> href="about.php">About</a>
			  <!--<a class=<?php if ($pgnm=="citations.php") {echo "active";} else {echo "none";}?> href="citations.php">Citations</a>  -->
			</div>
			</div>
		</div>
	</div>

