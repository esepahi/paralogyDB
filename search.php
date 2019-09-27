<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>ParalogyDB | Search</title>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("datatable_include.html");
include ("header.php");
?>


<div id="contentSearch">
	<div class="bolder formField">
<?php
$query = $_GET['query']; 
 
$min_length = 3;
 
if(strlen($query) >= $min_length){
	
	echo 'Search results for: '.$query.'<hr>';
			
	$query = htmlspecialchars($query); 
	 
	$query = mysqli_real_escape_string($con, $query);

		$snsql = "SELECT * FROM species WHERE (`spName` LIKE '%".$query."%')";
		$raw_results = mysqli_query($con, $snsql) or die(mysql_error());
		$rawresultsnumber = mysqli_num_rows($raw_results);

		if(mysqli_num_rows($raw_results) > 0){
			if($rawresultsnumber == 1){
				while($results = mysqli_fetch_assoc($raw_results)){
					$shortname = $results['shortname'];
				}			
				?>
<script type="text/javascript">
    <!--
        window.location = "species.php?species=<?php echo $shortname; ?>"
    //-->
</script><?php
			}
			else{
				echo "Search have found more than one species. Select on of them:<br>";
				while($results = mysqli_fetch_assoc($raw_results)){
					$speciesmore = '<a href="species.php?species=';
					echo $speciesmore.$results['shortname'].'">'.$results['spName'].'</a><br>';
				}
				}
		}
			else{
			$snsql = "SELECT * FROM geneparalogyclass_fromgenes WHERE (`geneid` LIKE '%".$query."%' or `genename` LIKE '%".$query."%')";
			$raw_results = mysqli_query($con, $snsql) or die(mysql_error());

			if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

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
				$gene_in_detail = '<a href="gene.php?geneid=';
				$cnet = '<a href="networks-results.php?formname=gene-gene&datasource=mpr&query=';
				$dnet = '<a href="gene-domain-network-results.php?label=gene&layout=circle&species=any&query=';
				$links = '<a href="http://plants.ensembl.org/Arabidopsis_thaliana/Gene/Summary?g=';
				while($results = mysqli_fetch_assoc($raw_results)){
					include ("species_shortname_to_fullname.php");
					if ($results['genetype']=="protein_coding"){
					?>
					<tr style = "text-align: left; border-bottom: 1px solid #ddd">
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $species; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $gene_in_detail.$results['geneid'].'">'.$results['geneid'].'</a>'; ?> </td>
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
					else {
					?>
					<tr style = "text-align: left; border-bottom: 1px solid #ddd">
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $species; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['geneid']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['genename']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['genetype']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo "No data"; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo "No data"; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo "No data"; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo "No data"; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo "No data"; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo "No data"; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $cnet.$results['geneid'].'">GPN</a>'.", ".
					  $dnet.$results['geneid'].'">GDN</a>'; ?></td>
					</tr>
					<?php             
					}
				}
				}
			else{
			$snsql = "SELECT * FROM pids WHERE (`PANTHERID` LIKE '%".$query."%') or (`PfamID` LIKE '%".$query."%')
			or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%')";
			$raw_results = mysqli_query($con, $snsql) or die(mysql_error());
			if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following

			?>
			<table id="myTable" class="stripe">
			  <thead>
				<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
				<th>Species</th>
				<th>Searched query</th>
				<th>All genes</th>
				<th>Single-Copy genes</th>
				<th>HPG genes</th>
				<!--<th>Blast against database</th>-->
				<th>HPD genes</th>
				</tr>
			  </thead>
			<?php
			$spArray = array('arta', 'arly');
			$tall = $tSC = $tP = $tPP = 0;
			foreach ($spArray as $spcName){
				if ($spcName=='arta'){$speciesName= 'Arabidopsis thaliana';}
				elseif ($spcName=='arly'){$speciesName= 'Arabidopsis lyrata';}
				
				$c_all = "SELECT * FROM pids WHERE (`species` LIKE '%".$spcName."%') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";
				$c_SC = "SELECT * FROM pids WHERE (`species` LIKE '%".$spcName."%') and (`pclass` LIKE 'SC') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";
				$c_P = "SELECT * FROM pids WHERE (`species` LIKE '%".$spcName."%') and (`pclass` LIKE 'HPG') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";
				$c_PP = "SELECT * FROM pids WHERE (`species` LIKE '%".$spcName."%') and (`pclass` LIKE 'HPD') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";
				$c_all_results = mysqli_query($con, $c_all) or die(mysql_error());
				$c_SC_results = mysqli_query($con, $c_SC) or die(mysql_error());
				$c_P_results = mysqli_query($con, $c_P) or die(mysql_error());
				$c_PP_results = mysqli_query($con, $c_PP) or die(mysql_error());
				$call = mysqli_num_rows($c_all_results);
				$tall = $tall + $call;
				$cSC = mysqli_num_rows($c_SC_results);
				$tSC = $tSC + $cSC; 
				$cP = mysqli_num_rows($c_P_results);
				$tP = $tP + $cP;
				$cPP = mysqli_num_rows($c_PP_results);
				$tPP = $tPP + $cPP;
				?>
					<tr style = "text-align: left; border-bottom: 1px solid #ddd">
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $speciesName; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $query; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="domain_search.php?pclass=call&species='.$spcName.'&query='.$query.'">'.$call.'</a>'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="domain_search.php?pclass=SC&species='.$spcName.'&query='.$query.'">'.$cSC.'</a>'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="domain_search.php?pclass=HPG&species='.$spcName.'&query='.$query.'">'.$cP.'</a>'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="domain_search.php?pclass=HPD&species='.$spcName.'&query='.$query.'">'.$cPP.'</a>'; ?></td>
					</tr>
				<?php             

			}
				?>
					<tr style = "background-color:yellow;  text-align: left; border-bottom: 1px solid #ddd">
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo 'Total'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $query; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="domain_search.php?pclass=tall&species=all&query='.$query.'">'.$tall.'</a>'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="domain_search.php?pclass=tSC&species=all&query='.$query.'">'.$tSC.'</a>'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="domain_search.php?pclass=tP&species=all&query='.$query.'">'.$tP.'</a>'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="domain_search.php?pclass=tPP&species=all&query='.$query.'">'.$tPP.'</a>'; ?></td>
					</tr>
					
					<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
					<script type="text/javascript">
					  google.charts.load('current', {'packages':['corechart']});
					  google.charts.setOnLoadCallback(drawChart);

					  function drawChart() {

						var data = google.visualization.arrayToDataTable([
						  ['Paralogy class', 'Genes in this class'],
						  ['Single-Copy',     <?php echo $tSC; ?>],
						  ['Have Paralog Gene',      <?php echo $tP; ?>],
						  ['Have Paralog Domain',    <?php echo $tPP; ?>]
						]);

						var options = {
						  title: 'Gene paralogy class number (Total)'
						};

						var chart = new google.visualization.PieChart(document.getElementById('piechart'));

						chart.draw(data, options);
					  }
					</script>
					<div id="piechart" style="width: 420px; height: 150px;"></div><hr>

				<?php             			
				
				}
			else{
				// if there is no matching rows do following
				echo '<div class = "notfound"> Search found nothing for '.$query.' in our database!</div>';
				echo '</div>';
				include ("footer.html");
				}       
				}       
			}       
		}
    else{ // if query length is less than minimum
		echo '<div class = "notfound">  Minimum search term length is '.$min_length.'</div>';
		echo '</div>';
		include ("footer.html");
    }
?>

	</div>
	</div>
	</div>
