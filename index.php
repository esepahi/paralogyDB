<?php
include ("head.html");
?>
<title>ParalogyDB | Home</title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/searchBox.css" />
<link rel="stylesheet" type="text/css" href="css/blastform.css" />
<style>
</style>
<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>


<div id="content">
	<div class="index_titlebox">
	<p align= "center" style = "font-size: 22px; font-weight: 400;">Database of intra-genome paralogy in eukaryote protein-coding genes.
	</p>
	<p align= "center" style = "font-size: 16px; font-weight: 200;">
	Currently you can search, browse and download intra-genome paralogy data 
	about protein-coding genes in these <a href="database-in-brief.php">eukaryote species</a>. We are working fast to include information for more species. 
	Visit our <a href="tutorial-and-glossary.php">tutorial and glossary</a> to know more about paralogyDB and how to better use it.</p>
	<!-- <h2 style="color:green; font-weight:500; font-size:30px; text-transform:uppercase;" align="left">Paralog and Single copy genes database</h2>-->
	</div>
	<div class="index_searchbox">
		<b style="color:#ec5525;" class= "underline" >Search for some thing...</b><hr>
			<div class="bolder formField" align= "center" >
			<form  action="search.php" method="GET" class="">
				<div class="autocomplete" style="width:70%;">
					<input class="border-radius" id="myInput" type="text" name="query" placeholder="species, gene, domain, etc...">
				</div>
				<input class="border-radius" type="submit">
			</form>
			Examples: <a href="search.php?query=Arabidopsis thaliana">  <i>Arabidopsis thaliana</i>  </a>, <a href="search.php?query=AT1G09310"> AT1G09310 </a>, <a href="search.php?query=Protein_kinase"> Protein_kinase	</a>
			<br><br><a href="tutorial-and-glossary.php">
			<b style="font-size:14;">Click here to see what can you search in this search form!</b></a>
			</div>
	</div>
	<div class="index_enrichbox">
		<b style="color:#ec5525;" >Gene ID Enrichment</b> <hr>
			<form  autocomplete="off" action="enrich-results.php" method="post" id="enrsearch" class="">
			<textarea style = "width:90%" name="comment" id="sequence" form="enrsearch" rows=5>Enter Gene IDs here...</textarea>
			<br><br>
			IDs are discriminated by:<br>
			<input type="radio" name="discrimnator" id="discrimnator" value=";"> Semicolon
			<input type="radio" name="discrimnator" id="discrimnator" value="," checked> Comma
			<input type="radio" name="discrimnator" id="discrimnator" value="\t"> Tab
			<input type="radio" name="discrimnator" id="discrimnator" value="line"> Line
			<input type="radio" name="discrimnator" id="discrimnator" value=" "> Space
			<!-- <input type="radio" name="discrimnator" value='\r\n'> Line --><br>

			<input style="font-size:1.0em; background:#ec5525; color:white; border-radius:.25rem; margin-top:10px; padding: 5px 35px; padding-right:45px;" type="submit">
	<input type="button" style="font-size:1.0em; background:#d4ab3b; color:white; border-radius:.25rem; margin-top:10px; padding: 5px 35px; padding-right:45px;" value="example gene IDs" onclick="javascript: document.getElementById('discrimnator').value=',';
			document.getElementById('sequence').value='AT1G02100, AT1G21100, AT1G21110, AT1G21120, AT1G26850, AT1G63140, AT1G76790, AT1G77260, AT1G77520, AT1G78240';" href="javascript:void()">
			
			</form>
			Available species? 
			<a href="tutorial-and-glossary.php" style="font-size:14;">Click here!</a><br>
			Available gene IDs?
			<a href="tutorial-and-glossary.php" style="font-size:14;">Click here!</a><br>			
					
	</div>
	<div class="index_classifybox">
		<b style="color:darkgreen;" class= "underline" >Classify your genes and sequences</b><hr>
			<p style = "text-align: justify;"> Classify one or all of genes and sequences retrived from any desired species using one of paralogy classifiers methods of paralogyDB.
			</p>
		<a href="classify.php"><b style="font-size:0.8em; background:darkgreen; color:white; border-radius:.25rem; padding: 5px 15px; padding-right:45px;">Click here for classifiers</b></a>
	</div>
	<div class="index_networkbox">
		<b style="color:darkgreen;" class= "underline" >Draw networks</b><hr>
		<p style = "text-align: justify;"> Search for a gene ID or Domain ID and draw a network of gene-gene paralogy relation or a network of gene-domain relation and download your network. 
		</p>
		<a href="networks.php"><b style="font-size:0.8em; background:darkgreen; color:white; border-radius:.25rem; padding: 5px 15px; padding-right:45px;">Click here for networks</b></a>
	</div>

<?php
include ("footer.html");
?>
