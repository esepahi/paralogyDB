<style>

.button {
    text-align: center;
    vertical-align: middle;
    padding: 12px 37px;
    border: 0px solid #a12727;
    <!--border-radius: 16px;-->
    background: #ff4a4a;
    background: -webkit-gradient(linear, left top, left bottom, from(#ff4a4a), to(#992727));
    background: -moz-linear-gradient(top, #ff4a4a, #992727);
    background: linear-gradient(to bottom, #ff4a4a, #992727);
    font: normal normal bold 15px arial;
    color: #ffffff;
    text-decoration: none;
}
.button:hover,
.button:focus {
    background: #ff5959;
    background: -webkit-gradient(linear, left top, left bottom, from(#ff5959), to(#b62f2f));
    background: -moz-linear-gradient(top, #ff5959, #b62f2f);
    background: linear-gradient(to bottom, #ff5959, #b62f2f);
    color: #ffffff;
    text-decoration: none;
}
.button:active {
    background: #982727;
    background: -webkit-gradient(linear, left top, left bottom, from(#982727), to(#982727));
    background: -moz-linear-gradient(top, #982727, #982727);
    background: linear-gradient(to bottom, #982727, #982727);
}

#cy {
	width: 100%;
	height: 100%;
	position: relative;
	top: 0px;
	left: 0px;
}
</style>


<div id="content1">
<!--  --> 
            <?php
    $datasource = $_GET['datasource'];
    $gquery = $_GET['query'];

	$genenodes = array();
	$proteinnodes = array();
	$pfamnodes = array();
	$panthernodes = array();
	$gene_protein_edges = array();
	$protein_pfam_edges = array();
	$protein_panther_edges = array();
	
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($gquery) >= $min_length){ // if query length is more or equal minimum length then
        $resultNumber = 0; 
        $query = htmlspecialchars($gquery); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection
		
        $raw_results = mysqli_query($con, "SELECT * FROM gene_domain
            WHERE (`geneid` = '$query') ") or die(mysql_error());
		$nnodes = array(); 
        if(mysqli_num_rows($raw_results) > 0){
		echo '<b>Table & network results for: '.$gquery.'</b> <br>By your choise, paralog genes (and their domains) of '.$gquery.' are not included in the following table and network.<hr>';			
			?>
		
			<table id="myTable" class="stripe">
			  <thead>
				<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
				<th>Species</th>
				<th>Gene ID</th>
				<th>Protein ID</th>
				<th>CPC</th>
				<th>MCPC</th>
				<th>PMPC</th>
				<th>PfamID</th>
				<th>PantherID</th>
				</tr>
			  </thead>
				<?php	
				while($results = mysqli_fetch_assoc($raw_results)){
					$genenode = "{ data: {id: '".$results['geneid']."', href: 'networks-results.php?datasource=".$datasource."&query=".$query."' }, classes: 'rootgene'},";
					$proteinnode = "{ data: {id: '".$results['proteinid']."',}, classes: 'protein'},";
					$pfamnode = "{ data: {id: '".$results['pfamid']."', href: 'networks-results.php?datasource=".$datasource."&query=".$query."' }, classes: 'pfam'},";
					$panthernode = "{ data: {id: '".$results['pantherid']."', href: 'networks-results.php?datasource=".$datasource."&query=".$query."' }, classes: 'panther'},";
					array_push($genenodes, $genenode);
					array_push($proteinnodes, $proteinnode);
					array_push($pfamnodes, $pfamnode);
					array_push($panthernodes, $panthernode);


					$gene_protein_edge = "{data: {id: '".$results['geneid']." to ".$results['proteinid']."',source: '".$results['geneid']."',target: '".$results['proteinid']."'},classes:'gene_prot'},";
					$protein_pfam_edge = "{data: {id: '".$results['proteinid']." to ".$results['pfamid']."',source: '".$results['proteinid']."',target: '".$results['pfamid']."'},classes:'prot_pfam'},";
					$protein_panther_edge = "{data: {id: '".$results['proteinid']." to ".$results['pantherid']."',source: '".$results['proteinid']."',target: '".$results['pantherid']."'},classes:'prot_panther'},";
					array_push($gene_protein_edges, $gene_protein_edge);
					array_push($protein_pfam_edges, $protein_pfam_edge);
					array_push($protein_panther_edges, $protein_panther_edge);
					
					?>	
					<tr>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo "<b>".$results['species']."</b>"; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['geneid']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['proteinid']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['cpc']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mcpc']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mpc']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['pfamid']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['pantherid']; ?></td>
					</tr>
				<?php             
				}
				?>
				</table>
				<?php
		}
else{ // if there is no matching rows do following?>
  	<div class="net bolder formField">
	<div class="intro">
	<p>	<b>Search found nothing for  </b>. Click here to go back to <a href="networks.php">networks search form.</a>. </p>
	<ul>
		<li>Use this search only for gene IDs. See our <a href="tutorial.php">tutorial</a> for more information.</li>
		<li>Maybe you have searched for a single-copy gene. When a gene is single-copy it has no paralog or partial paralog, so it has no result in the gene-gene paralogy search (network).</li>
		<li>Maybe we have no data about your searched gene ID.</li>
		<li>Don't search multiple gene IDs together. </li>
		<li>Don't use this search for sequences. go to blast for working with sequences.</li>
		<li>Don't search for part of a gene ID. for example searching for AT1G093 instead of AT1G09370 returns nothing!</li>
		<li>To search using part of a gene ID, try our <a href="index.php">Homepage search form</a>. It accepts non-complete IDs and return results as a table of results. See <a href="tutorial.php">tutorial</a> for more information. </li>
		
	</ul>
	</div>
	</div>
<?php		
	}
	}
    else{ // if query length is less than minimum
        echo "<div class="."intro"."><p><b>Minimum term length is ".$min_length.' </b>. Click here to come back <a href="networks.php">Networks search</a>. </p></div>';
    }
?>

<hr>
<div class="intronet">
<p style="margin-top:-31px;"> <font color="darkgreen" size="10px">&#x25cf; </font>Green and darkgreen nodes are genes <font color="blue" size="10px">&#x25cf; </font>Blue nodes are protein(s) of a gene
<font color="red" size="10px">&#x25cf; </font>Red nodes are panther IDs <font color="orange" size="10px">&#x25cf; </font>Orange nodes are pfam IDs 
<br>
<font color="blue">Blue</font> edge(s): gene-protein relation |  
<font color="red">Red</font> edge(s): protein-panther ID relation |  
<font color="orange">Blue</font> edge(s): protein-pfam ID  relation | <b>Drag nodes to reshape the network!</b>
</p>
</div>
<div class="intronet" style="margin-top:10px;">
<nav >
   <!--<a href="index.php"><button class="button" >Browse paralogy table</button></a>-->
   <a  class="button" id= "netlink" href = "#" onclick ="myFunction();" download= "paralogydb_network_image.png">Download network as png</a>
   <a href = "gene.php?geneid=<?php echo $_GET['query'];?>"><button class="button" >More about <?php echo $_GET['query'];?></button></a>
   <a  class="button" onclick ="removepfam();"> Remove pfam nodes</a>
   <a  class="button" onclick ="removepanther();"> Remove panther nodes</a>
</nav>
</div>

<div class="net bolder formField">

<div id="cy"></div>

<script>
function myFunction() {
var url = cy.png({full:'true', minWidth:'1000px'});
document.getElementById("netlink").setAttribute("href",url);
}
function removepfam() {
var j = cy.$('.pfam');
cy.remove( j );
}

function removepanther() {
var j = cy.$('.panther');
cy.remove( j );
}

var cy = cytoscape({
container: document.getElementById('cy'),
elements: [
  // nodes
<?php foreach ($genenodes as $nodeitem){echo $nodeitem;}?> 
<?php foreach ($proteinnodes as $nodeitem){echo $nodeitem;}?> 
<?php foreach ($pfamnodes as $nodeitem){echo $nodeitem;}?> 
<?php foreach ($panthernodes as $nodeitem){echo $nodeitem;}?> 
// edges
<?php foreach ($gene_protein_edges as $edgeitem){echo $edgeitem;}?> 
<?php foreach ($protein_pfam_edges as $edgeitem){echo $edgeitem;}?> 
<?php foreach ($protein_panther_edges as $edgeitem){echo $edgeitem;}?> 
],
style: [
        {
            selector: 'node',
            style: {
                'background-color': 'yellow',
				'label': 'data(id)',
                'font-size': 14
            }
        },
        {
            selector: '.rootgene',
            style: {
                'background-color': 'darkgreen'
            }
        },
        {
            selector: '.paraloggene',
            style: {
                'background-color': 'green'
            }
        },
        {
            selector: '.protein',
            style: {
                'background-color': 'blue'
            }
        },
        {
            selector: '.pfam',
            style: {
                'background-color': 'orange'
            }
        },
        {
            selector: '.panther',
            style: {
                'background-color': 'red'
            }
        },
        {
            selector: '.gene_prot',
            style: {
			'line-color': 'blue'
            }
        },

        {
            selector: '.prot_pfam',
            style: {
			'line-color': 'orange'
            }
        },

		{
            selector: '.prot_panther',
            style: {
			'line-color': 'red'
            }
        }]
      });
	  

cy.on('tap', 'node', function(){
  try { // your browser may block popups
    window.open( this.data('href') );
  } catch(e){ // fall back on url change
    window.location.href = this.data('href');
  }
});		
	  
cy.layout({
    name: 'circle', fit : true, animate: true, circle : true
}).run();

</script>
</div>
