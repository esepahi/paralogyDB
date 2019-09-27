<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>ParalogyDB | Gene detail</title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/blastform.css" />
<style>
.button
{margin-left:50px; background-color: #00b33c; color: white;  padding: 14px 25px; min-width:70%;  text-align: center;  text-decoration: none;	display: inline-block;}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
}

.newraw{  border-bottom: 3px solid green;
  font-size:16px;
  color:green;
  margin-bottom: 8px;
  padding-top: 8px;
  font-weight: 400;

}

.firstraw{ padding-top: 8px;}

th, td {
  <!--border: 1px solid #dddddd;-->
  text-align: left;
  vertical-align: top;
  padding-left: 8px;
  padding-bottom: 5px;
}
th {
  font-size:14px;
  font-weight: 200;
  color:gray;	
  width: 200px;
}
td {
}

</style>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>


<div id="content">
<?php
$query = $_GET['geneid']; 

$query = htmlspecialchars($query); 
// changes characters used in html to their equivalents, for example: < to &gt;
 
$query = mysqli_real_escape_string($con, $query);
// makes sure nobody uses SQL injection

	$snsql = "SELECT * FROM genes WHERE (`geneid` LIKE '%".$query."%' or `genename` LIKE '%".$query."%')";
	$raw_results = mysqli_query($con, $snsql) or die(mysql_error());

	if(mysqli_num_rows($raw_results) > 0){
		$results = mysqli_fetch_assoc($raw_results);
		$gene_in_detail = '<a href="gene.php?geneid=';
		$mcgene_gene_network = '<a href="networks-results.php?formname=gene-gene&ipop=no&datasource=mpr&query=';
		$mcgene_domain_network = '<a href="networks-results.php?formname=gene-domain&label=gene&ipop=no&datasource=mpc&query=';

		$mprp = "SELECT * FROM genegenerel WHERE (`Source` = '".$query."' and `mpr` = 'P')";
		$mprpraw = mysqli_query($con, $mprp) or die(mysql_error());
		$mprpp = "SELECT * FROM genegenerel WHERE (`Source` = '".$query."' and `mpr` = 'PP')";
		$mprppraw = mysqli_query($con, $mprpp) or die(mysql_error());
		$cprp = "SELECT * FROM genegenerel WHERE (`Source` = '".$query."' and `cpr` = 'P')";
		$cprpraw = mysqli_query($con, $cprp) or die(mysql_error());
		$cprpp = "SELECT * FROM genegenerel WHERE (`Source` = '".$query."' and `cpr` = 'PP')";
		$cprppraw = mysqli_query($con, $cprpp) or die(mysql_error());
		$mcprp = "SELECT * FROM genegenerel WHERE (`Source` = '".$query."' and `mcpr` = 'P')";
		$mcprpraw = mysqli_query($con, $mcprp) or die(mysql_error());
		$mcprpp = "SELECT * FROM genegenerel WHERE (`Source` = '".$query."' and `mcpr` = 'PP')";
		$mcprppraw = mysqli_query($con, $mcprpp) or die(mysql_error());

		include ("species_shortname_to_fullname.php");
		?>
		

		<table>
		  <tr>
			<th class="newraw">Gene information:</th>
			<td></td>
		  </tr>
		  <tr>
			<th class="firstraw">Species:</th>
			<td class="firstraw"><?php echo "<i>".$species."</i>"; ?></td>
		  </tr>
		  <tr>
			<th>Gene ID:</th>
			<td><?php echo $results['geneid']; ?></td>
		  </tr>
		  <tr>
			<th>Gene name:</th>
			<td><?php echo $results['genename']; ?></td>			
		  </tr>
		  <tr>
			<th>Gene description:</th>
			<td><?php echo $results['genedesc']; ?></td>
		  </tr>
		  <tr>
			<th>Gene type:</th>
			<td><?php echo $results['genetype']; ?></td>
		  </tr>
		  <tr>
			<th class="newraw">Modified COMPARA </th>
			<td></td>
		  </tr>
		  <tr>
			<th class="firstraw">Modified COMPARA paralogy Class (MCPC):</th>
			<td class="firstraw"><?php echo "<b>".$results['mcpc']."</b> 
			<br> This gene has ".$results['mcpr_p']." paralog genes & ".$results['mcpr_pp']." partial paralog genes. <br>".
			$mcgene_gene_network.$results['geneid'].'">'."<span style='color:orange;'>Browse paralogy network</span>".'</a>'. " | ".
			$mcgene_domain_network.$results['geneid'].'">'."<span style='color:orange;'>Browse gene-domain network</span>".'</a>'; ?></td>
		  </tr>
		  <tr>
			<th>Modified COMPARA Paralog genes:</th>
			<td><?php while($mcprpresults = mysqli_fetch_assoc($mcprpraw)){
				echo $gene_in_detail.$mcprpresults['Target'].'">'.$mcprpresults['Target'].'</a>'.", ";} ?></td>
		  </tr>
		  <tr>
			<th>Modified COMPARA partial paralog genes:</th>
			<td><?php while($mcprppresults = mysqli_fetch_assoc($mcprppraw)){
				echo $gene_in_detail.$mcprppresults['Target'].'">'.$mcprppresults['Target'].'</a>'.", ";} ?></td>
		  </tr>
		  <tr>
			<th class="newraw">ParalogyDB Model </th>
			<td></td>
		  </tr>
		  <tr>
			<th class="firstraw">ParalogyDB Model paralogy Class (PMPC):</th>
			<td class="firstraw"><?php echo "<b>".$results['mpc']."</b> 
			<br> This gene has ".$results['mpr_p']." paralog genes & ".$results['mpr_pp']." partial paralog genes."; ?></td>
		  </tr>
		  <tr>
			<th>ParalogyDB Model Paralog genes:</th>
			<td><?php while($mprpresults = mysqli_fetch_assoc($mprpraw)){
				echo $gene_in_detail.$mprpresults['Target'].'">'.$mprpresults['Target'].'</a>'.", ";} ?></td>
		  </tr>
		  <tr>
			<th>ParalogyDB Model partial paralog genes:</th>
			<td><?php while($mprppresults = mysqli_fetch_assoc($mprppraw)){
				echo $gene_in_detail.$mprppresults['Target'].'">'.$mprppresults['Target'].'</a>'.", ";} ?></td>
		  </tr>
		  <tr>
			<th class="newraw">COMPARA </th>
			<td></td>
		  </tr>
		  <tr>
			<th class="firstraw">COMPARA paralogy Class (CPC):</th>
			<td class="firstraw"><?php echo "<b>".$results['cpc']."</b> 
			<br> This gene has ".$results['cpr_p']." paralog genes & ".$results['cpr_pp']." partial paralog genes."; ?></td>
		  </tr>
		  <tr>
			<th>COMPARA Paralog genes:</th>
			<td><?php while($cprpresults = mysqli_fetch_assoc($cprpraw)){
				echo $gene_in_detail.$cprpresults['Target'].'">'.$cprpresults['Target'].'</a>'.", ";} ?></td>
		  </tr>
		  <tr>
			<th>COMPARA partial paralog genes:</th>
			<td><?php while($cprppresults = mysqli_fetch_assoc($cprppraw)){
				echo $gene_in_detail.$cprppresults['Target'].'">'.$cprppresults['Target'].'</a>'.", ";} ?></td>
		  </tr>
		</table>

	<?php	
	} // if one or more rows are returned do following

?>




<?php
include ("footer.html");
?>
