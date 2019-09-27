<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>ParalogyDB | Networks results</title>
<!-- cytoscapejs CSS and JS -->
    <script src='js/cytoscape.min.js'></script>

<!-- Head tag ends in header.php so insert head content related to this page here -->	


<?php
$formname = $_GET['formname'];
include ("datatable_include.html");
include ("header.php");
if ($formname == "gene-gene"){
	$includeparalogofparalog = $_GET['ipop'];
	if ($includeparalogofparalog == "yes"){include ("gene-gene-network.php");}
	else if ($includeparalogofparalog == "no"){include ("gene-gene-network.php");}
	}
else if ($formname == "gene-domain"){$label = $_GET['label']; if ($label == "gene"){
	$includeparalogofparalog = $_GET['ipop'];
	if ($includeparalogofparalog == "yes"){include ("gene-domain-labelgene-network.php");}
	else if ($includeparalogofparalog == "no"){include ("gene-domain-labelgene-network.php");}
	}
	else if ($label == "domain"){include ("gene-domain-labeldomain-network.php");}		
}
?>


<?php
include ("footer.html");
?>
