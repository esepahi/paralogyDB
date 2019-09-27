<?php
include ("sqlcnct.php");
include ("head.html");
$spcName = $pdb = $pclass = "nothing";
$spcName = $_GET['species']; 
$pdb = $_GET['pdb']; 
$pclass = $_GET['pclass'];
$sql3rdcondition = "(".$pdb." = '".$pclass."')";
if ($pclass == 'all') {$sql3rdcondition = "(".$pdb." = 'SC' or ".$pdb." = 'HPG' or ".$pdb." = 'HPD' )";}
if ($spcName=='arta'){$speciesName= 'Arabidopsis thaliana';}
elseif ($spcName=='arly'){$speciesName= 'Arabidopsis lyrata';}
elseif ($spcName=='bevu'){$speciesName= 'beta vulgaris (Beet)';}
elseif ($spcName=='bota'){$speciesName= 'bos taurus (Cow)';}
elseif ($spcName=='brna'){$speciesName= 'brassica napus (Rapeseed)';}
else {$speciesName= 'Not found!';}
?>
<title>ParalogyDB | Species genes</title>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("datatable_include.html");
include ("header.php");
?>


<div id="contentSearch">
	<div class="bolder formField">
	<?php echo "<b style='color:green'><i>".$speciesName."</i> results </b><br>Up to first 1000 results are shown below. click here to download all results as a csv file."; ?>	<hr>
	<?php
	$genetypecount = "SELECT * FROM genes where species = '".$spcName."' and genetype = 'protein_coding' and ".$sql3rdcondition." LIMIT 1000;";
	$genetypecount_raw_results = mysqli_query($con, $genetypecount) or die(mysql_error());
	if(mysqli_num_rows($genetypecount_raw_results) > 0){
			?>
			<p style="font-size:12;">
			<b style="color:green;" >CPRs:</b> Number of COMPARA paralogy results (paralog, partial paralog), 
			<b style="color:green;" >CPC:</b> COMPARA paralogy class, 
			<b style="color:green;" >MCPRs:</b> Number of modified COMPARA paralogy results (paralog, partial paralog), 
			<b style="color:green;" >MCPC:</b> Modified COMPARA paralogy class, 
			<b style="color:green;" >MPRs:</b> Number of SCiPDB model paralogy results (paralog, partial paralog), 
			<b style="color:green;" >MPC:</b> SCiPDB model paralogy class, 
			<b style="color:blue;" >GPN:</b> Gene paralogy network, 
			<b style="color:blue;" >GDN:</b> Gene-Domain (s) network 
			<p>
			<a href="tutorial.php">
			<b style="font-size:12;">Click here to see what is COMPARA, Modified COMPARA, SCiPDB Model, Single-Copy, HPG and HPD</b></a>			
			<hr>
			<table id="myTable" class="stripe">
			  <thead>
				<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
				<th>Species</th>
				<th>Gene ID</th>
				<th>Gene name</th>
				<th>Gene type</th>
				<th>CPRs</th>
				<th>CPC</th>
				<th>MCPRs</th>
				<th>MCPC</th>
				<th>MPRs</th>
				<th>MPC</th>
				<th>Useful links</th>
				</tr>
			  </thead>
			<?php
				$cnet = '<a href="networks-results.php?formname=gene-gene&datasource=mcpr&query=';
				$dnet = '<a href="gene-domain-network-results.php?label=gene&layout=circle&species=any&query=';
				$links = '<a href="http://plants.ensembl.org/Arabidopsis_thaliana/Gene/Summary?g=';
		while($results = mysqli_fetch_assoc($genetypecount_raw_results)){
					?>
					<tr style = "text-align: left; border-bottom: 1px solid #ddd">
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $speciesName; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['geneid']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['genename']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['genetype']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['cpr_p'].', '.$results['cpr_pp']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['cpc']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mcpr_p'].', '.$results['mcpr_pp']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mcpc']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mpr_p'].', '.$results['mpr_pp']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mpc']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $cnet.$results['geneid'].'">GPN</a>'.", ".
					  $dnet.$results['geneid'].'">GDN</a>'; ?></td>
					</tr>
					<?php             						

			}	
	}
	?>