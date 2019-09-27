<?php
include ("head.html");
?>
<title>ParalogyDB | Classify</title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/blastform.css" />
<style>
.download_button
{margin-left:50px; background-color: #00b33c; color: white;  padding: 14px 25px; min-width:70%;  text-align: center;  text-decoration: none;	display: inline-block;}
</style>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>


<div id="content">

	<div class="blastnav-e11">
	<div class="blastform">
		<b style="color:orange;" >Classify by learned model</b><hr>
		If you <b style="color:green;" >have an all-agains-all blast results file</b> of DNA, RNA or protein sequences of your desired species and want to find paralogy relation between these sequences 
		and finally classify them for being single-copy, HPD or HPG, use this method. it is faster and more acurate than our Classify by Blast method but <b style="color:red;">only works with all-against-all datasets</b>.
		<br><br><br>Click here and find more about this classification method.
		<br><br><br>
		<a class="download_button" href="model-classifier.php" style=""> Lets classify by model! </a>
		<br><br><br>

	</div>
	</div>
	<div class="blastnav-e22">
		<div class="blastformRight">
		<b style="color:orange;" >Classify by Blast</b><hr>
		If you want to know <b style="color:green;" >the paralogy class of one or a few sequences</b>, use this method. This method accepts up to 50 sequences as 
		input (query sequences), blasts your sequences agains our database of sequences (subject sequences), and outputs probable paralogy class of each 
		of your sequences. you can also see (up to) 10 best subject sequences matched to each of your query sequences.   	
		<br><br>Click here and find more about this classification method.
		<br><br><br>
		<a class="download_button" href="blast-classifier.php" style=""> Lets classify by blast! </a>
		<br><br><br>
		</div>	
	</div>

<?php
include ("footer.html");
?>
