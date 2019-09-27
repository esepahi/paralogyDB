<style>

.button {
    text-align: center;
	width:33%;
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
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($gquery) >= $min_length){ // if query length is more or equal minimum length then
        $resultNumber = 0; 
        $query = htmlspecialchars($gquery); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection
		
        $raw_results = mysqli_query($con, "SELECT * FROM genegenerel
            WHERE (`Source` = '".$query."') ") or die(mysql_error());
		$nnodes = array(); 
        if(mysqli_num_rows($raw_results) > 0){
		echo 'Table & network results for: '.$gquery.' <br>Paralogs and paralogs of paralogs are shown in the following table<hr>';			
			?>
		
			<table id="myTable" class="stripe">
			  <thead>
				<tr style = "text-align: left; border-bottom: 1px solid #ddd;">
				<th>Gene</th>
				<th>Paralog gene</th>
				<th>CPR</th>
				<th>MCPR</th>
				<th>PMPR</th>
				</tr>
			  </thead>
				<?php	
				while($results = mysqli_fetch_assoc($raw_results)){
				?>
					<tr>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo "<b>".$results['Source']."</b>"; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Target']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['cpr']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mcpr']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mpr']; ?></td>
					</tr>
				<?php             
			
				array_push($nnodes, $results['Target']);
				}
				foreach ($nnodes as $myitem){
				$query1 = $myitem;
					$raw_results = mysqli_query($con,"SELECT * FROM genegenerel
				WHERE (`Source` = '".$query1."') ") or die(mysql_error());						
					if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
					while($results = mysqli_fetch_assoc($raw_results)){
				?>
					<tr>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Source']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Target']; ?> </td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['cpr']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mcpr']; ?></td>
					  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['mpr']; ?></td>
					</tr>
				<?php             
							
					}
				}}
				?>			  
			</table><br>  
<?php
		}
        $query = htmlspecialchars($gquery); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($con, $query);
        // makes sure nobody uses SQL injection
		
        $raw_results = mysqli_query($con, "SELECT * FROM genegenerel
            WHERE (`Source` = '".$query."') ") or die(mysql_error());
		$nnodes = array(); 
        if(mysqli_num_rows($raw_results) > 0){
				
?>

			<div class="intronet">
			<p> <font color="darkgreen" size="12px">&#x25cf; </font> >> root (your search term) node. <font color="palegreen" size="12px">&#x25cf; </font>>> homolog of root node. 
			<font color="yellow" size="12px">&#x25cf; </font> >> homolog of homolog of root node. <font color="Blue">Blue</font> edge(s): paralogy relation. 
			<font color="red">Red</font> edge(s): Partial paralogy relation. Reshape network by dragging nodes.
			</p>
			<nav >
			   <!--<a href="index.php"><button class="button" >Browse paralogy table</button></a>-->
			   <a  class="button" id= "netlink" href = "#" onclick ="myFunction();" download= "paralogydb_network_image.png">Download network as png</a>
			   <a href = "gene-domain-network-results.php?label=gene&layout=circle&species=any&query=<?php echo $_GET['query'];?>"><button class="button" >Browse root node domains</button></a>
			   <a href = "search.php?query=<?php echo $_GET['query'];?>"><button class="button" >Search results for root node</button></a>
			   <a href = "search.php?query=<?php echo $_GET['query'];?>"><button class="button" >cytoscape file</button></a>			   
			</nav>
			<script>
			function myFunction() {
			var url = cy.png({full:'true', minWidth:'1000px'});
			document.getElementById("netlink").setAttribute("href",url);
			}
			</script>
			</div>
				<div class="net bolder formField">
			<?php


			// if one or more rows are returned do following
		$flnodes = array();
		$nnodes = array();
		$fledges = array();
		$SourceNode = "{ data: {id: '".$query."', href: 'paralogy-network-search.php?datasource=".$datasource."&query=".$query."' }, classes: 'root'},";
		array_push($flnodes, $SourceNode);

		while($results = mysqli_fetch_assoc($raw_results)){
			$TargetNode = "{ data: {id: '".$results['Target']."', href: 'paralogy-network-results.php?datasource=".$datasource."&query=".$results['Target']."' }, classes: 'neighbour'},";
			$FLEdge = "{data: {id: '".$results['Source']." to ".$results['Target']."',source: '".$results['Source']."',target: '".$results['Target']."'},classes:'".$results[$datasource]."'},";
			array_push($flnodes, $TargetNode);
			array_push($fledges, $FLEdge);
			array_push($nnodes, $results['Target']);
			$resultNumber++;
			}
$slnodes = array();
$sledges = array();
foreach ($nnodes as $myitem){
	$query1 = $myitem;
        $raw_results = mysqli_query($con,"SELECT * FROM genegenerel
            WHERE (`Source` LIKE '%".$query1."%') ") or die(mysql_error());
             
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
		while($results = mysqli_fetch_assoc($raw_results)){
			$SLNode= "{ data: {id: '".$results['Target']."' , href: 'paralogy-network-search.php?datasource=".$datasource."&query=".$results['Target']."' }, classes: 'neighbourofneighbour'},";
			$SLEdge = "{data: {id: '".$results['Source']." to ".$results['Target']."',source: '".$results['Source']."',target: '".$results['Target']."'},classes:'".$results[$datasource]."'},";
		array_push($slnodes, $SLNode);
		array_push($sledges, $SLEdge);
		}
}}
}
else{ // if there is no matching rows do following?>
  	<div class="net bolder formField">
	<div class="intro">
	<p>	<b>Search found nothing for <?php echo $query?> </b>. Click here to go back to <a href="networks.php">networks search form.</a>. </p>
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
<?php

}         
    }
    else{ // if query length is less than minimum
        echo "<div class="."intro"."><p><b>Minimum term length is ".$min_length.' </b>. Click here to come back <a href="index.php">Home & search</a>. </p></div>';
    }

?>
		    <div id="cy"></div>

			<script>
      var cy = cytoscape({
        container: document.getElementById('cy'),
elements: [
  // nodes
<?php foreach ($flnodes as $nodeitem){echo $nodeitem;}?> 
<?php foreach ($slnodes as $nodeitem){echo $nodeitem;}?> 
// edges
<?php foreach ($fledges as $nodeitem){echo $nodeitem;}?> 
<?php foreach ($sledges as $nodeitem){echo $nodeitem;}?> 
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
            selector: '.neighbour',
            style: {
                'background-color': 'palegreen'
            }
        },
        {
            selector: '.root',
            style: {
                'background-color': 'darkgreen'
            }
        },
        {
            selector: '.PP',
            style: {
			'line-color': 'red'
            }
        },

		{
            selector: '.P',
            style: {
			'line-color': 'blue'
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
