<?php
include ("head.html");
?>
<title>ParalogyDB | Download</title>
<link rel="stylesheet" href="css/collapsable.css"> <!-- CSS reset -->

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th {
    border: 1px solid black;
    text-align: left;
    padding: 8px;
	font-weight: bold;
}
td {
    border: 1px solid black;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

<?php
include ("header.php");
?>

<div id="content" >
	<div class="column" onclick="openTab('b1');" style="border:1px solid green; background:#f7f8f9;">
		<span style="color:green; font-weight:700" >Intra-genome paralogy class</span>
	</div>
	<div class="column" onclick="openTab('b2');" style="border:1px solid blue; background:#f7f8f9;">
		<span style="color:blue; font-weight:700" >Intra-genome paralogy relation</span>
	</div>
	<div class="column" onclick="openTab('b3');" style="border:1px solid green; background:#f7f8f9;">
		<span style="color:green; font-weight:700" >Some other data</span>
	</div>
	<div class="column" onclick="openTab('b4');" style="border:1px solid blue; background:#f7f8f9;">
		<span style="color:blue; font-weight:700" >Some other data</span>
	</div>

<div id="b1" class="containerTab" style="display:none;  border: 5px solid green;">
	<span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
	<h3>Intra-genome paralogy class</h3>
	<table>
	<tr>
	<th>Title</th>
	<th>Author</th>
	<th>Download link</th>
	</tr>
	<tr>
	<td><i>Arabidopsis thaliana</i> protein-coding genes paralogy class | CSV file </td>
	<td>ParalogyDB</td>
	<td><a href="downloads/Atal-tair10-pblast-allvsall.tab">Download</a></td>
	</tr>
	<tr>
	<td><i>Arabidopsis thaliana</i> protein-coding genes paralogy class | CSV file </td>
	<td>ParalogyDB</td>
	<td><a href="downloads/Atal-tair10-pblast-allvsall.tab">Download</a></td>
	</tr>
	</table>
</div>

<div id="b2" class="containerTab" style="display:none;border: 5px solid blue">
  <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
	<h3>Intra-genome paralogy relation</h3>
	<table>
	<tr>
	<th>Title</th>
	<th>Author</th>
	<th>Download link</th>
	</tr>
	<tr>
	<td><i>Arabidopsis thaliana</i> protein-coding genes paralogy relation | CSV file </td>
	<td>ParalogyDB</td>
	<td><a href="downloads/Atal-tair10-pblast-allvsall.tab">Download</a></td>
	</tr>
	<tr>
	<td><i>Arabidopsis thaliana</i> protein-coding genes paralogy relation | CSV file </td>
	<td>ParalogyDB</td>
	<td><a href="downloads/Atal-tair10-pblast-allvsall.tab">Download</a></td>
	</tr>
	</table>
</div>

<div id="b3" class="containerTab" style="display:none;  border: 5px solid green;">
	<span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
	<h3>Some other data</h3>
	<table>
	<tr>
	<th>Title</th>
	<th>Author</th>
	<th>Download link</th>
	</tr>
	<tr>
	<td><i>Arabidopsis thaliana</i> protein-coding genes paralogy class | CSV file </td>
	<td>ParalogyDB</td>
	<td><a href="downloads/Atal-tair10-pblast-allvsall.tab">Download</a></td>
	</tr>
	<tr>
	<td><i>Arabidopsis thaliana</i> protein-coding genes paralogy class | CSV file </td>
	<td>ParalogyDB</td>
	<td><a href="downloads/Atal-tair10-pblast-allvsall.tab">Download</a></td>
	</tr>
	</table>
</div>

<div id="b4" class="containerTab" style="display:none;border: 5px solid blue">
  <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
	<h3>Some other data</h3>
	<table>
	<tr>
	<th>Title</th>
	<th>Author</th>
	<th>Download link</th>
	</tr>
	<tr>
	<td><i>Arabidopsis thaliana</i> protein-coding genes paralogy relation | CSV file </td>
	<td>ParalogyDB</td>
	<td><a href="downloads/Atal-tair10-pblast-allvsall.tab">Download</a></td>
	</tr>
	<tr>
	<td><i>Arabidopsis thaliana</i> protein-coding genes paralogy relation | CSV file </td>
	<td>ParalogyDB</td>
	<td><a href="downloads/Atal-tair10-pblast-allvsall.tab">Download</a></td>
	</tr>
	</table>
</div>



<script>
function openTab(tabName) {
  var i, x;
  x = document.getElementsByClassName("containerTab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(tabName).style.display = "block";
}
</script>



<?php
include ("footer.html");
?>
