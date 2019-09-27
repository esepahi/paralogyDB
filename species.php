<?php
include ("sqlcnct.php");
include ("head.html");
$spcName = $_GET['species']; 
if ($spcName=='arta'){$speciesName= 'Arabidopsis thaliana';}
elseif ($spcName=='arly'){$speciesName= 'Arabidopsis lyrata';}
elseif ($spcName=='bevu'){$speciesName= 'beta vulgaris (Beet)';}
elseif ($spcName=='bota'){$speciesName= 'bos taurus (Cow)';}
elseif ($spcName=='brna'){$speciesName= 'brassica napus (Rapeseed)';}
else {$speciesName= 'Not found!';}
?>

<title>ParalogyDB | <?php echo $speciesName; ?></title>

<style type="text/css">
.pchart40{float:left; width: 40%; height: 200px;}
.pchart20{float:left; width: 20%; height: 200px;}

table.table-style-two {
	width: 100%;
	font-family: verdana, arial, sans-serif;
	font-size: 13px;
	color: #333333;
	border-width: 1px;
	border-color: #3A3A3A;
	border-collapse: collapse;
}

table.table-style-two th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #517994;
	background-color: #B2CFD8;
}

table.table-style-two tr:hover td {
	background-color: #DFEBF1;
}

table.table-style-two td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #517994;
	background-color: #ffffff;
}

</style>


<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>


<div id="contentSearch">
	<div class="bolder formField">	
	<?php
	echo '<p style='.'"text-align:center;"'.' >Results for <i>"'.$speciesName.'"</i></p><hr>';
	$gall = $pcall = $mirnaall = $ncrnaall = $snornaall = $otherall = $cpcsc = $cpchpg = $cpchpd = $mcpcsc = $mcpchpg = $mcpchpd = $pmpcsc = $pmpchpg = $pmpchpd = 0;		

	$genetypecount = "SELECT genetype,COUNT(*) FROM genes where `species` = '$spcName' GROUP BY genetype;";
	$genetypecount_raw_results = mysqli_query($con, $genetypecount) or die(mysql_error());
	if(mysqli_num_rows($genetypecount_raw_results) > 0){
		while($results = mysqli_fetch_assoc($genetypecount_raw_results)){
			$gall = $gall + $results['COUNT(*)'];
			if ($results['genetype']=="protein_coding"){$pcall = $results['COUNT(*)'];}
			if ($results['genetype']=="miRNA" or $results['genetype']=="pre_miRNA"){$mirnaall = $mirnaall + $results['COUNT(*)'];}
			if ($results['genetype']=="ncRNA" or $results['genetype']=="lncRNA"){$ncrnaall = $ncrnaall + $results['COUNT(*)'];}
			if ($results['genetype']=="snoRNA"){$snornaall = $results['COUNT(*)'];}
			if ( !in_array($results['genetype'], ['protein_coding','miRNA','pre_miRNA','lncRNA','ncRNA','snoRNA'], true ) ) {$otherall = $otherall + $results['COUNT(*)'];}
		}	
	}

	$genetypecount = "SELECT genetype,cpc,mcpc,mpc,COUNT(*) FROM genes where `species` = '".$spcName."' GROUP BY genetype,cpc,mcpc,mpc;";
	$genetypecount_raw_results = mysqli_query($con, $genetypecount) or die(mysql_error());
	if(mysqli_num_rows($genetypecount_raw_results) > 0){
		while($results = mysqli_fetch_assoc($genetypecount_raw_results)){
			if ($results['genetype']=="protein_coding" and $results['cpc']=="SC"){$cpcsc = $cpcsc + $results['COUNT(*)'];}
			if ($results['genetype']=="protein_coding" and $results['cpc']=="HPG"){$cpchpg = $cpchpg + $results['COUNT(*)'];}
			if ($results['genetype']=="protein_coding" and $results['cpc']=="HPD"){$cpchpd = $cpchpd + $results['COUNT(*)'];}
			if ($results['genetype']=="protein_coding" and $results['mcpc']=="SC"){$mcpcsc = $mcpcsc + $results['COUNT(*)'];}
			if ($results['genetype']=="protein_coding" and $results['mcpc']=="HPG"){$mcpchpg = $mcpchpg + $results['COUNT(*)'];}
			if ($results['genetype']=="protein_coding" and $results['mcpc']=="HPD"){$mcpchpd = $mcpchpd + $results['COUNT(*)'];}
			if ($results['genetype']=="protein_coding" and $results['mpc']=="SC"){$pmpcsc = $pmpcsc + $results['COUNT(*)'];}
			if ($results['genetype']=="protein_coding" and $results['mpc']=="HPG"){$pmpchpg = $pmpchpg + $results['COUNT(*)'];}
			if ($results['genetype']=="protein_coding" and $results['mpc']=="HPD"){$pmpchpd = $pmpchpd + $results['COUNT(*)'];}
		}	
	}


	?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
	  google.charts.setOnLoadCallback(drawChart);

	  function drawChart() {

		var data = google.visualization.arrayToDataTable([
		  ['Paralogy class1', '# of Genes in this class'],
		  ['Single-copy',     <?php echo $mcpcsc; ?>],
		  ['HPG',      <?php echo $mcpchpg; ?>],
		  ['HPD',      <?php echo $mcpchpd; ?>]
		]);

		var options = {
		  'title': '<?php echo $speciesName." MCPC"; ?>',
		  'chartArea': {'width': '90%', 'height': '80%'},
		  'legend': {'position': 'bottom'}
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

		chart.draw(data, options);
	  }
	</script>	
	<script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
	  google.charts.setOnLoadCallback(drawChart);

	  function drawChart() {

		var data = google.visualization.arrayToDataTable([
		  ['Paralogy class2', '# of Genes in this class'],
		  ['Single-copy',     <?php echo $cpcsc; ?>],
		  ['HPG',      <?php echo $cpchpg; ?>],
		  ['HPD',      <?php echo $cpchpd; ?>]
		]);

		var options = {
		  'title': '<?php echo $speciesName." CPC"; ?>',
		  'chartArea': {'width': '90%', 'height': '80%'},
		  'legend': {'position': 'bottom'}
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
		
		  google.visualization.events.addListener(chart, 'ready', function () {
			piechart2.innerHTML = '<img src="' + chart.getImageURI() + '">';
			console.log(piechart2.innerHTML);
		  });


		chart.draw(data, options);
	  }
	</script>
	<script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
	  google.charts.setOnLoadCallback(drawChart);

	  function drawChart() {

		var data = google.visualization.arrayToDataTable([
		  ['Genetype', '# of genes'],
		  ['protein coding',     <?php echo $pcall; ?>],
		  ['(pre)miRNA',      <?php echo $mirnaall; ?>],
		  ['ncRNA',      <?php echo $ncrnaall; ?>],
		  ['snoRNA',      <?php echo $snornaall; ?>],
		  ['other genetypes',    <?php echo $otherall; ?>]
		]);

		var options = {
		  'title': '<?php echo $speciesName." genetypes"; ?>',
		  'chartArea': {'width': '90%', 'height': '80%'},
		  'legend': {'position': 'bottom'}
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
		
		  google.visualization.events.addListener(chart, 'ready', function () {
			piechart3.innerHTML = '<img src="' + chart.getImageURI() + '">';
			console.log(piechart3.innerHTML);
		  });


		chart.draw(data, options);
	  }
	</script>
	<script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
	  google.charts.setOnLoadCallback(drawChart);

	  function drawChart() {

		var data = google.visualization.arrayToDataTable([
		  ['Paralogy class', '# of Genes in this class'],
		  ['Single-copy',     <?php echo $pmpcsc; ?>],
		  ['HPG',      <?php echo $pmpchpg; ?>],
		  ['HPD',      <?php echo $pmpchpd; ?>]
		]);

		var options = {
		  'title': '<?php echo $speciesName." PMPC"; ?>',
		  'chartArea': {'width': '90%', 'height': '80%'},
		  'legend': {'position': 'bottom'}
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart4'));

		chart.draw(data, options);
	  }
	</script>
	<div id="piechart3" style="float:left; width:40%;"></div>
	<div id="piechart2" style="float:left; width:20%"></div>
	<div id="piechart1" style="float:left; width:20%"></div>
	<div id="piechart4" style="float:left; width:20%"></div>
	<div style="clear : both;"><br></div>
	<div style="clear : both;"><hr></div>
	
	<?php echo $speciesName." genetypes"; ?>
	<table class="table-style-two">
		<thead>
			<tr style = "text-align: left;">
				<th>Species</th>
				<th>All genes</th>
				<th>protein coding</th>
				<th>miRNA or pre_miRNA</th>
				<th>ncRNA</th>
				<th>snoRNA</th>
				<th>Other genetypes</th>
			</tr>
		</thead>
		<tbody>
			<tr style = "text-align: left;">
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $speciesName; ?></td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $gall; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $pcall; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $mirnaall; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $ncrnaall; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $snornaall; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $otherall; ?> </td>
			</tr>
		</tbody>
	</table>
	<hr>
	<?php 
	$species_genes_mcpc = '<a href="species-genes.php?species='.$spcName.'&pdb=mcpc&pclass=';
	echo "Modified COMPARA paralogy class (MCPC) for protein coding genes in ".$speciesName; ?>
	<table class="table-style-two">
		<thead>
			<tr style = "text-align: left;">
				<th>Species</th>
				<th>All protein coding (PC) genes</th>
				<th>Single-copy PC genes</th>
				<th>HPG PC genes</th>
				<th>HPD PC genes</th>
			</tr>
		</thead>
		<tbody>
			<tr style = "text-align: left;">
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $speciesName; ?></td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $pcall; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_mcpc.'SC">'.$mcpcsc.'</a>'; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_mcpc.'HPG">'.$mcpchpg.'</a>'; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_mcpc.'HPD">'.$mcpchpd.'</a>'; ?> </td>
			</tr>
		</tbody>
	</table>
	<hr>
	<?php 
	$species_genes_pmpc = '<a href="species-genes.php?species='.$spcName.'&pdb=mpc&pclass=';
	echo "ParalogyDB model paralogy class (PMPC) for protein coding genes in ".$speciesName; ?>
	<table class="table-style-two">
		<thead>
			<tr style = "text-align: left;">
				<th>Species</th>
				<th>All protein coding (PC) genes</th>
				<th>Single-copy PC genes</th>
				<th>HPG PC genes</th>
				<th>HPD PC genes</th>
			</tr>
		</thead>
		<tbody>
			<tr style = "text-align: left;">
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $speciesName; ?></td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $pcall; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_pmpc.'SC">'.$pmpcsc.'</a>'; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_pmpc.'HPG">'.$pmpchpg.'</a>'; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_pmpc.'HPD">'.$pmpchpd.'</a>'; ?> </td>
			</tr>
		</tbody>
	</table>
	<hr>
	<?php
	$species_genes_cpc = '<a href="species-genes.php?species='.$spcName.'&pdb=cpc&pclass=';
	echo "COMPARA paralogy class (CPC) for protein coding genes in ".$speciesName; ?>
	<table class="table-style-two">
		<thead>
			<tr style = "text-align: left;">
				<th>Species</th>
				<th>All protein coding (PC) genes</th>
				<th>Single-copy PC genes</th>
				<th>HPG PC genes</th>
				<th>HPD PC genes</th>
			</tr>
		</thead>
		<tbody>
			<tr style = "text-align: left;">
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $speciesName; ?></td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $pcall; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_cpc.'SC">'.$cpcsc.'</a>'; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_cpc.'HPG">'.$cpchpg.'</a>'; ?> </td>
				<td style = "border-bottom: 1px solid #ddd;"><?php echo $species_genes_cpc.'HPD">'.$cpchpd.'</a>'; ?> </td>
			</tr>
		</tbody>
	</table>
	<hr>
	</div>
	</div>				
<?php
include ("footer.html");
?>
