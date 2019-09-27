<?php
include ("sqlcnct.php");
include ("head.html");
?>
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
	$pclass = $_GET['pclass']; 
	$spcName = $_GET['species']; 
	$query = $_GET['query']; 

	echo 'Search results for: '.$query.'<hr>';       

	
	$pclass = htmlspecialchars($pclass);       
	$pclass = mysqli_real_escape_string($con, $pclass);
	$spcName = htmlspecialchars($spcName);       
	$spcName = mysqli_real_escape_string($con, $spcName);
	$query = htmlspecialchars($query);       
	$query = mysqli_real_escape_string($con, $query);
	
	if ($pclass == 'SC' or $pclass == 'HPG' or $pclass == 'HPD'){
		$snsql = "SELECT * FROM pids WHERE (`species` LIKE '%".$spcName."%') and (`pclass` LIKE '%".$pclass."%') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";		
	}
	elseif($pclass == 'call'){
		$snsql = "SELECT * FROM pids WHERE (`species` LIKE '%".$spcName."%') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";				
	}
	elseif($pclass == 'tSC'){
		$snsql = "SELECT * FROM pids WHERE (`pclass` LIKE 'SC') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";		
	}
	elseif($pclass == 'tP'){
		$snsql = "SELECT * FROM pids WHERE (`pclass` LIKE 'HPG') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";		
	}
	elseif($pclass == 'tPP'){
		$snsql = "SELECT * FROM pids WHERE (`pclass` LIKE 'HPD') and ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";		
	}
	elseif($pclass == 'tall'){
		$snsql = "SELECT * FROM pids WHERE ((`PANTHERID` LIKE '%".$query."%')	or (`PfamID` LIKE '%".$query."%')
				or (`InterproID` LIKE '%".$query."%') or (`InterproShortDescription` LIKE '%".$query."%'))";				
	}
	$raw_results = mysqli_query($con, $snsql) or die(mysql_error());
	if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
		?>
		<table id="myTable" class="stripe">
		  <thead>
			<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
			<th>Searched term</th>
			<th>Species</th>
			<th>Gene name</th>
			<th>Paralogy class</th>
			<th>Panther ID</th>
			<th>Pfam ID</th>
			<th>Interpro ID</th>
			<th>Domain short description</th>
			</tr>
		  </thead>
		<?php
		$slink = '<a href="search.php?query=';		
		while($results = mysqli_fetch_assoc($raw_results)){

		if ($results['species']=='arta'){$speciesName= 'Arabidopsis thaliana';}
		elseif ($results['species']=='arly'){$speciesName= 'Arabidopsis lyrata';}

		?>
			<tr style = "text-align: left; border-bottom: 1px solid #ddd">
			  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$query.'">'.$query.'</a>'; ?> </td>
			  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$speciesName.'">'.$speciesName.'</a>'; ?> </td>
			  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$results['geneID'].'">'.$results['geneID'].'</a>'; ?></td>
			  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['pclass']; ?> </td>
			  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$results['PANTHERID'].'">'.$results['PANTHERID'].'</a>'; ?></td>
			  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$results['PfamID'].'">'.$results['PfamID'].'</a>'; ?></td>
			  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$results['InterproID'].'">'.$results['InterproID'].'</a>'; ?></td>
			  <td style = "border-bottom: 1px solid #ddd;"><?php echo $slink.$results['InterproShortDescription'].'">'.$results['InterproShortDescription'].'</a>'; ?></td>
			</tr>
		<?php             
		}
		}
	else{
		// if there is no matching rows do following
		echo '<div class = "notfound"> Search found nothing for '.$query.' in our database!</div>';
		echo '</div>';
		include ("footer.html");
		}       
?>

	</div>
	</div>
	</div>
