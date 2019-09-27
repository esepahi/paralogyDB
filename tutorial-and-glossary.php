<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>ParalogyDB | Tutorial and glossary</title>
<link rel="stylesheet" href="css/collapsable.css"> <!-- CSS reset -->

<!-- Head tag ends in header.php so insert head content related to this page here -->	

<?php
include ("datatable_include.html");
include ("header.php");
?>

<div id="content" >
<p style="margin-bottom:-10px; padding:10px; background-color:goldenrod; color:white; font-weight:700" >Glossary of abbreviations and acronyms</p><hr>	
	<table id="myTable" class="stripe">
	  <thead>
		<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
		<th>Term</th>
		<th>Definition</th>
		</tr>
	  </thead>
	<?php
	$snsql = "SELECT * FROM glossary WHERE 1";
	$raw_results = mysqli_query($con, $snsql) or die(mysql_error());
	while($results = mysqli_fetch_assoc($raw_results)){
	?>
		<tr>
		  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['term']; ?> </td>
		  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['definition']; ?></td>
		</tr>
	<?php
	}
	?>
	</table>
	<br><br>
<p style="margin-bottom:-10px; padding:10px; background-color:goldenrod; color:white; font-weight:700" >Tutorial</p><hr>	

<div class="column" onclick="openTab('basicknowledge');" style="border:1px solid green; background:#f7f8f9;">
	<span style="color:green; font-weight:400" >Some basic knowledge</span>
</div>
<div class="containerTab" id="basicknowledge" style="display:none;  border: 1px solid green;">
  <p>
	<b>Homologs, Orthologs and Paralogs</b><br> Two or more genes with a common ancestor gene are called homologs.
	If the shared ancestory is caused by a speciation event then this homology relation is called orthology and those genes are orthologs,
	but if the shared ancestory is because of a duplication event then the relation is paralogy and those genes are paralogs.<br>
	Considering alpha and beta globin genes in dog and mouse, all these 4 genes are homologs, alpha globins are orthologs of each other, beta globins are orthologs of each other, alpha globins are paralogs of beta globins and beta globins are paralogs of alpha globins.<br> 
	<b>Intra-genome paralogy and inter-genome paralogy</b><br> Duplications lead to paralogy, but depending on the sequence of duplication and speciation events in the evolutionary tree of a gene, if...<br>  
	Again, considering alpha and beta globin genes in dog and mouse, alpha and beta globin genes are created after a duplication event in the common ancestor of dog and mouse (which is also common ancestor of all species which have alpha and beta glibins!). later speciation events lead to two species dog and mouse. Now in this two species, alpha globin of dog is inter-genome paralog of beta globin of mouse (and vice-versa) while alpha glibin of dog is intra-genome paralog of its beta globin (and for the mouse is the same).  
  </p>
</div>

<div class="column" onclick="openTab('paralogyDBcontent');" style="border:1px solid green; background:#f7f8f9;">
	<span style="color:green; font-weight:400" >An overview of the content of paralogyDB</span>
</div>
<div class="containerTab" id="paralogyDBcontent" style="display:none;  border: 1px solid green;">
  <p>
  ParalogyDB is a  

  </p>
</div>

<div class="column" onclick="openTab('homesearch');" style="border:1px solid darkblue; background:#f7f8f9;">
	<span style="color:darkblue; font-weight:400" >Home search bar & available queries</span>
</div>
<div class="containerTab" id="homesearch" style="display:none;  border: 1px solid darkblue;">
  <p>
  ParalogyDB is a  

  </p>
</div>

<div class="column" onclick="openTab('enrich');" style="border:1px solid darkblue; background:#f7f8f9;">
	<span style="color:darkblue; font-weight:400" >Enrichment & available species and gene IDs</span>
</div>
<div class="containerTab" id="enrich" style="display:none;  border: 1px solid darkblue;">
  <p>
  ParalogyDB is a  

  </p>
</div>

<div class="column" onclick="openTab('networks');" style="border:1px solid darkblue; background:#f7f8f9;">
	<span style="color:darkblue; font-weight:400" >Draw and download networks</span>
</div>
<div class="containerTab" id="networks" style="display:none;  border: 1px solid darkblue;">
  <p>
  ParalogyDB is a  

  </p>
</div>

<div class="column" onclick="openTab('classify');" style="border:1px solid darkblue; background:#f7f8f9;">
	<span style="color:darkblue; font-weight:400" >Classify one or many sequences</span>
</div>
<div class="containerTab" id="classify" style="display:none;  border: 1px solid darkblue;">
  <p>
  ParalogyDB is a  

  </p>
</div>

<div class="column" onclick="openTab('download');" style="border:1px solid darkblue; background:#f7f8f9;">
	<span style="color:darkblue; font-weight:400" >Download data from paralogyDB</span>
</div>
<div class="containerTab" id="download" style="display:none;  border: 1px solid darkblue;">
  <p>
  ParalogyDB is a  

  </p>
</div>

<div class="column" onclick="openTab('cite');" style="border:1px solid darkblue; background:#f7f8f9;">
	<span style="color:darkblue; font-weight:400" >Cite our paper</span>
</div>
<div class="containerTab" id="cite" style="display:none;  border: 1px solid darkblue; border-top: 0px;">
  <p>
  ParalogyDB is a  

  </p>
</div>

<script>
function openTab(tabName) {
    var y = document.getElementById(tabName);
  if (y.style.display === 'none') {
    y.style.display = 'block';
  } else {
    y.style.display = 'none';
  }
}
</script>

<?php
include ("footer.html");
?>
