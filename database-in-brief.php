<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>ParalogyDB | Database in brief</title>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("datatable_include.html");
include ("header.php");
?>


<div id="contentSearch">
	<div class="bolder formField">
	<b>Notice:</b> ParalogyDB.org currently just serves paralogy relation data for protein-coding genes of the following species. The database is continuously growing. To be informed of latest updates in the database check our <a href= 'updates.php'>updates</a> page. 
	<hr>
			<table id="myTable" class="stripe">
			  <thead>
				<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
				<th>Species</th>
				<th>All genes</th>
				<th>protein coding genes</th>
				<th>Single-Copy protein coding genes</th>
				<th>HPG protein coding genes</th>
				<th>HPD protein coding genes</th>
				<th>All other genes (ncRNAs, tRNAs, etc...)</th>
				</tr>
			  </thead>
			<?php
			$spArray = array('arta', 'arly', 'bevu', 'bota', 'brna');
			$tall = $tpc = $tnonpc = $tsc = $thpg = $thpd = 0;
			foreach ($spArray as $spcName){
				if ($spcName=='arta'){$speciesName= 'Arabidopsis thaliana';}
				elseif ($spcName=='arly'){$speciesName= 'Arabidopsis lyrata';}
				elseif ($spcName=='bevu'){$speciesName= 'beta vulgaris (Beet)';}
				elseif ($spcName=='bota'){$speciesName= 'bos taurus (Cow)';}
				elseif ($spcName=='brna'){$speciesName= 'brassica napus (Rapeseed)';}
				
				$g_all = "SELECT * FROM genes USE INDEX (cindex_sp_gt_mcpc) WHERE (`species` LIKE '%".$spcName."%')";
				$g_all_results = mysqli_query($con, $g_all) or die(mysql_error());
				$gall = mysqli_num_rows($g_all_results);
				$tall = $tall + $gall;

				$proteinCoding_all = "SELECT * FROM genes USE INDEX (cindex_sp_gt_mcpc) WHERE (`species` LIKE '%".$spcName."%') and (`genetype` = 'protein_coding')";
				$pc_all_results = mysqli_query($con, $proteinCoding_all) or die(mysql_error());
				$pcall = mysqli_num_rows($pc_all_results);
				$tpc = $tpc + $pcall;

				$proteinCoding_sc_all = "SELECT * FROM genes USE INDEX (cindex_sp_gt_mcpc) WHERE (`species` LIKE '%".$spcName."%') and (`genetype` LIKE 'protein_coding' and `mcpc` LIKE 'SC')";
				$pc_sc_all_results = mysqli_query($con, $proteinCoding_sc_all) or die(mysql_error());
				$pc_scall = mysqli_num_rows($pc_sc_all_results);
				$tsc = $tsc + $pc_scall;

				$proteinCoding_hpg_all = "SELECT * FROM genes USE INDEX (cindex_sp_gt_mcpc) WHERE (`species` LIKE '%".$spcName."%') and (`genetype` LIKE 'protein_coding' and `mcpc` LIKE 'HPG')";
				$pc_hpg_all_results = mysqli_query($con, $proteinCoding_hpg_all) or die(mysql_error());
				$pc_hpgall = mysqli_num_rows($pc_hpg_all_results);
				$thpg = $thpg + $pc_hpgall;

				$proteinCoding_hpd_all = "SELECT * FROM genes USE INDEX (cindex_sp_gt_mcpc) WHERE (`species` LIKE '%".$spcName."%') and (`genetype` LIKE 'protein_coding' and `mcpc` LIKE 'HPD')";
				$pc_hpd_all_results = mysqli_query($con, $proteinCoding_hpd_all) or die(mysql_error());
				$pc_hpdall = mysqli_num_rows($pc_hpd_all_results);
				$thpd = $thpd + $pc_hpdall;

				$nonproteinCoding_all = "SELECT * FROM genes USE INDEX (cindex_sp_gt_mcpc) WHERE (`species` LIKE '%".$spcName."%') and (`genetype` != 'protein_coding')";
				$nonpc_all_results = mysqli_query($con, $nonproteinCoding_all) or die(mysql_error());
				$nonpcall = mysqli_num_rows($nonpc_all_results);
				$tnonpc = $tnonpc + $nonpcall;

				?>
					<tr style = "text-align: left; border-bottom: 1px solid #ddd">
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="species.php?species='.$spcName.'">'.$speciesName.'</a>'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $gall; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $pcall; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $pc_scall; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $pc_hpgall; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $pc_hpdall; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $nonpcall; ?> </td>
					</tr>
				<?php             

			}
			?>
					<tr style = "background-color:yellow;  text-align: left; border-bottom: 1px solid #ddd">
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo 'Total'; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $tall; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $tpc; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $tsc; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $thpg; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $thpd; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $tnonpc; ?> </td>
					</tr>


	</div>
	</div>
