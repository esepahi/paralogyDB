<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>ParalogyDB | Enrich</title>

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<!-- Plugins JS -->
<script src="js/owl.carousel.min.js"></script>
<!-- Custom JS -->
<script src="js/script.js"></script>

<style type="text/css">
	.stripe {
		font-family: verdana, arial, sans-serif;
		font-size: 13px;
		color: #333333;
	}
	.copyButton {background-color: green;}

</style>

<script>
	$(document).ready( function () {
		$('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [ 
		{
                extend: 'copy', className: 'copyButton',
                exportOptions: {
                    columns: ':visible'
                }
            },
{
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            },
{
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
{
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
                }
            },
{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
		fixedColumns: {
		leftColumns: 2
		}
    } );
	} );
</script>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>


<div id="contentSearch">
	<div class="bolder formField">
<?php
	$nothingarray = array();
	$discrimnator = $_POST['discrimnator'];
	$comment = $_POST['comment'];
	if ($discrimnator == 'line'){
	$cArray = explode("\r\n", $comment);}
	else{$cArray = explode($discrimnator, $comment);}
	//print_r($cArray);
	//echo $comment;
    // gets value sent over search form

	?>

	<table id="myTable" class="stripe">
	  <thead>
		<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
		<th>Searched query</th>
		<th>Gene ID</th>
		<th>Gene Name</th>
		<th>Paralogy class</th>
		<th>GO term accession</th>
		<th>GO term Name</th>
		<th>GO Domain</th>
		<th>GO term Definition</th>
		</tr>
	  </thead>

<?php
foreach ($cArray as $query){
	$query = preg_replace('/\s+/', '', $query);
	if ($query== '' or $query== ''){continue;} else{

    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
		
        		
		$query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection
			$snsql = "SELECT * FROM goTable WHERE (`GeneID` LIKE '%".$query."%')";
			$raw_results = mysqli_query($con, $snsql) or die(mysql_error());

			if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
			$slink = '<a href="gene-onthology-search.php?query=';						
			while($results = mysqli_fetch_assoc($raw_results)){
					
				?>
					<tr style = "text-align: left; border-bottom: 1px solid #ddd">
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $query; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['GeneID']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Genename']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['pclass']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$results['GO_term_accession'].'">'.$results['GO_term_accession'].'</a>'; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$results['GO_term_name'].'">'.$results['GO_term_name'].'</a>'; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['GO_domain']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['GO_term_definition']; ?> </td>
					</tr>
				<?php             
				}
				}
				else {array_push($nothingarray, $query);}
}
}
}
?>
</table>
<?php
if (!empty($nothingarray)) {
     // list is empty.

?>
<hr>
<div style = "background-color:#f7716a; padding:10px;">
Our search found nothing for:<br>

<?php

foreach ($nothingarray as $nquery){
	echo $nquery.", ";
}
?>
</div>
<?php
}
?>
	</div>
	</div>
<?php
include ("footer.html");
?>

