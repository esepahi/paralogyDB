<?php
include ("head.html");
?>
<title>ParalogyDB | Networks</title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/blastform.css" />
<link rel="stylesheet" type="text/css" href="css/searchBox.css" />
<style>
.download_button
{margin-left:50px; background-color: #00b33c; color: white;  padding: 14px 25px; min-width:70%;  text-align: center;  text-decoration: none;	display: inline-block;}
</style>


<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>

<script>

</script>

<div id="content">

<script>
function myFunction1() {
  var x = document.getElementById("gene").value;
  document.getElementById("showspecies").style.display ='none';
  document.getElementById("showparalogs").style.display ='block';  
}
function myFunction2() {
  var x = document.getElementById("domain").value;
  document.getElementById("showparalogs").style.display ='none';
  document.getElementById("showspecies").style.display ='block';
}

</script>

	<div class="blastnav-e11">
	<div class="blastform">
		<b style="color:orange;" >Genes-domain network</b>
		<p style="font-size:14; color: gray; text-align: justify;" > Enter a gene ID to retrive a bipartite network (graph) of that gene and its domains. 
		You can also include paralog genes of your gene and their domains.
		Or enter a panther ID or PFam ID or domain short description to retrive all genes containing that domain. 
		</p>
		<hr>
		Examples: <a href="networks-results.php?formname=gene-domain&label=gene&ipop=no&datasource=mpc&query=AT3G54080"> AT3G54080 </a>, <a href="paralogy-network-results.php?datasource=mpr&query=AT2G01050">AT2G01050</a>
		<hr>

		<div class="formField" align= "left" >
		<form action="networks-results.php" method="GET" class="">
		    <input type="hidden" name="formname" value="gene-domain"/>
			<input id="myInput" style="width:80%;" type="text" name="query" placeholder="Gene ID or domain ID...">
			<br><br>
			<b>Input type:</b><br>
				<input type="radio" style="margin-left:40px;" name="label" value="gene" id="gene" checked="checked" onchange="myFunction1()"> <abbr title="See our tutorial for available species and gene IDs "> gene ID </abbr>
				<input type="radio" style="margin-left:20px;" name="label" value="domain" id="domain" onchange="myFunction2()"> <abbr title="Only search for PANTHER IDs or Pfam IDs"> domain ID </abbr>
			<br><br>
			<div id="showparalogs" style="display:block">
			<abbr title="Don't include paralogs of paralogs if your gene has more than 20 paralog genes. This may cause a network creation failure."><b>Include paralog genes:</b></abbr><br>
				<input type="radio" style="margin-left:40px;" id="pop" name="ipop" value="yes" checked="checked"> Yes
				<input type="radio" style="margin-left:20px;" id="pop" name="ipop" value="no" > No
			<br><br>
			</div>
			<div id="showspecies" style="display:none">
			<b>species:</b><br>
			  <select style="margin-left:20px;" name="species">
				<option value="arly">Arabidopsis lyrata</option>
				<option value="arta">Arabidopsis thaliana</option>
				<option value="hosa">Homo sapiens</option>
				<option value="any" selected>Any species (fails when results are many)</option>
			  </select>
			  <br><br>
			</div>
			<abbr title="See our tutorial to learn about paralogy class data sources..."><b>Paralogy class data source:</b></abbr><br>
				<input type="radio" style="margin-left:40px;" id="pdb" name="datasource" value="cpc"> <abbr title="COMPARA Paralogy Class">CPC</abbr>
				<input type="radio" style="margin-left:20px;" id="pdb" name="datasource" value="mcpc" > <abbr title="Modified COMPARA Paralogy Class (see tutorial for more information)">MCPC</abbr> 
				<input type="radio" style="margin-left:20px;" id="pdb" name="datasource" value="mpc" checked="checked"> <abbr title="Paralogydb machine-learning Model Paralogy Class">PMPC</abbr>			
			<br><br>
			<input style="background-color:green; width:60%;" type="submit">
		</form>
		</div>
	</div>
	</div>
	
	<div class="blastnav-e22">
		<div class="blastformRight">
		<b style="color:orange;" >Genes-gene paralogy network</b>
		<p style="font-size:14; color: gray; text-align: justify;" > Enter a gene ID to retrive a network of that gene and its paralog genes. 
		You can also include paralogs of paralog genes. 
		</p>
		<hr>
		Examples: <a href="networks-results.php?formname=gene-gene&ipop=no&query=AT3G54080&datasource=mpr"> AT3G54080 </a>, <a href="networks-results.php?formname=gene-gene&ipop=yes&query=AT2G01050&datasource=mpr">AT2G01050</a>
		<hr>
		<div class="formField" align= "left" >
		<form action="networks-results.php" name="table" value="gene-gene" method="GET" class="">
		    <input type="hidden" name="formname" value="gene-gene"/>
			<input id="myInput" style="width:80%;" type="text" name="query" placeholder="Gene ID... ">
			<br><br>
			<abbr title="The paralogy dataset that the paralogy network will be generated based on it."><b>Paralogy relation data source:</b></abbr><br>
				<input type="radio" style="margin-left:40px;" id="pdb" name="datasource" value="cpr"> CPR
				<input type="radio" style="margin-left:20px;" id="pdb" name="datasource" value="mcpr" > MCPR
				<input type="radio" style="margin-left:20px;" id="pdb" name="datasource" value="mpr" checked="checked"> PMPR			
			<br><br>
			<abbr title="Don't include paralogs of paralogs if your gene has more than 20 paralog genes. This may cause a network creation failure."><b>Include paralogs of paralogs:</b></abbr><br>
				<input type="radio" style="margin-left:40px;" id="pop" name="ipop" value="yes" checked="checked"> Yes
				<input type="radio" style="margin-left:20px;" id="pop" name="ipop" value="no" > No
			<br><br>
			<br>
			<input style="background-color:green; width:60%;" type="submit">
		</form>
		</div>
		</div>	
	</div>

<?php
include ("footer.html");
?>
