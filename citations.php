<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>ParalogyDB | Citation</title>


<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("datatable_include.html");
include ("header.php");
?>
<div id="content">

	<table id="myTable" class="stripe">
	  <thead>
		<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
		<th>Paper group</th>
		<th>Title</th>
		<th>Author(s)</th>
		<th>Journal</th>
		<th>Publication year</th>
		</tr>
	  </thead>
	<?php
	$snsql = "SELECT * FROM citations WHERE 1";
	$raw_results = mysqli_query($con, $snsql) or die(mysql_error());
	while($results = mysqli_fetch_assoc($raw_results)){
	?>
		<tr>
		  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['class']; ?> </td>
		  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['title']; ?></td>
		  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['authors']; ?></td>
		  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['journal']; ?></td>
		  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['pubyear']; ?></td>
		</tr>
	<?php
	}
	?>
	</table>



<?php
include ("footer.html");
?>
