<?php
include ("head.html");
?>
<title>ParalogyDB | Enrich</title>
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
	<div class="enrich_enrichbox">
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

			<input style="font-size:1.0em; background:green; color:white; border-radius:.25rem; margin-top:10px; padding: 5px 85px; " type="submit">
	<input type="button" style="font-size:1.0em; background:#d4ab3b; color:white; border-radius:.25rem; margin-top:10px; padding: 5px 35px; padding-right:45px;" value="example gene IDs" onclick="javascript: document.getElementById('discrimnator').value=',';
			document.getElementById('sequence').value='AT1G02100, AT1G21100, AT1G21110, AT1G21120, AT1G26850, AT1G63140, AT1G76790, AT1G77260, AT1G77520, AT1G78240';" href="javascript:void()">
			
			</form>
			Available species? 
			<a href="tutorial-and-glossary.php" style="font-size:14;">Click here!</a><br>
			Available gene IDs?
			<a href="tutorial-and-glossary.php" style="font-size:14;">Click here!</a><br>			
					
	</div>

	<div class="enrich_morebox">
	<b style="color:#ec5525;" >More about gene ID enrichment tool</b><hr>
	<p class="moredescription" style="font-size: 16px; color: gray; text-align: justify;">In the gene ID enrichment, you can enter a list of gene IDs and retrive thier related gene onthology (GO) data,
	in the form of a table of data and diagrams of data. 
	To test this tool click on example gene IDs button to fill the form with a list of example gene IDs from <i>Arabidopsis thaliana </i> and
	then click on submit query button to go to enrichment results page and see GO data of these gene IDs. </p>
	</div>
	

<?php
include ("footer.html");
?>
