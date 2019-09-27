<?php
include ("head.html");
?>
<title>SinCoGenesDB</title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/blastform.css" />
		<link rel="stylesheet" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
			<script>
		$(document).ready( function () {
			$('#myTable').DataTable();
		} );
	</script>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>




<div id="content">
	<p class="intro"> <b>qseqid:</b> 	Query Seq-id (ID of your sequence)
<b>sseqid:</b> 	Subject Seq-id (ID of the database hit)
<b>pident:</b> 	Percentage of identical matches
<b>length:</b> 	Alignment length
<b>mismatch:</b> 	Number of mismatches
<b>gapopen:</b> 	Number of gap openings
<b>qstart:</b> 	Start of alignment in query
<b>qend:</b> 	End of alignment in query
<b>sstart:</b> 	Start of alignment in subject (database hit)
<b>send:</b> 	End of alignment in subject (database hit)
<b>evalue:</b> 	Expectation value (E-value)
<b>bitscore:</b> 	Bit score</p><br> 



<?php
if(isset($_POST['submit'])) 
{
$inpfileformat = $_POST['inputfileformat'];
$seqtype = $_POST['sequencetype'];
$datahead = $_POST['datahead'];
$seqfile = $_FILES['inpfile']['name'];
$path = realpath($_FILES['inpfile']['name']);
$tpath = realpath($_FILES['inpfile']['tmp_name']);

$info = pathinfo($path);
echo $inpfileformat.'<br>';
echo $seqtype;
echo $datahead;
echo $seqfile;
}
else {
	echo "One of these errors happened:<br/>";
	echo "* input file or sequence is not in in appropriate format <br/>";
	echo '<a href="blastform.php">Click here to go back to Blast input form</a>';
	}

?>

<!--
<div class="introform">
			<?php
if(isset($_POST['submit'])) 
{
	function get_seq($x) {
		$fck = 0;
		$seq = "";
		$fl = explode("\n", $x);
		$sh = trim(array_shift($fl));
		if($sh == null) {
			$fck++;
		}
		$fl = array_filter($fl);
		foreach($fl as $str) {
			$seq .= trim($str);
		}
		$seq = strtoupper($seq);
		$seq = preg_replace("/[^ACDEFGHIKLMNPQRSTVWY]/i", "", $seq);
		if ((count($fl) < 1) || (strlen($seq) == 0)) {
			$fck++;
			return $fck;
		} else {
			return $fck;
		}
	}

	function fcheck($x) {
		$gt = substr($x, 0, 1);
		$flck = 0;
		if ($gt != ">") {
			$flck++;
			return $flck;
		} else {
			$gtr = substr($x, 1);
			$sqs = explode(">", $gtr);
			if (count($sqs) > 1) {
				foreach ($sqs as $sq) {
					$flck += get_seq($sq);
				}
				return $flck;
			} else {
				$flck += get_seq($gtr);
				return $flck;
			}
		}
	}

	$error = 0;
	ini_set('file_uploads', 1);
	ini_set('max_execution_time', 0);
	$program = $_POST['inputfileformat'];
	$datalib = $_POST['sequencetype'];
	$sequence = $_POST['datahead'];
	$seqfile = $_FILES['inpfile']['name'];
	$path = realpath($_FILES['inpfile']['name']);
	$tpath = realpath($_FILES['inpfile']['tmp_name']);
	$extn = strtolower(pathinfo($_FILES['seqfile']['name'], PATHINFO_EXTENSION));
	
	if (($sequence == "") && (empty($seqfile))) {
		print "
			<div class='error'>No input sequence provided!!</div>";
		$error++;
	}
	
	if (!empty($seqfile)) {
		if(!in_array($extn, array('fa', 'fas', 'fsa', 'fasta', 'seq'))) {
			print "
			<div class='error'>Invalid FASTA file input!</div>";
			$error++;
		}
	}
	
	if ($error == 0) {
		if (($sequence != "") && (!empty($seqfile))) {
			print "
			<div class='error'>Input either sequence or file!!</div>";
		} else if (!empty($seqfile)) {
			$input = pathinfo($_FILES['seqfile']['tmp_name'], PATHINFO_FILENAME) . ".fas";
			$output = pathinfo($_FILES['seqfile']['tmp_name'], PATHINFO_FILENAME) . ".htm";
			move_uploaded_file($_FILES['seqfile']['tmp_name'], $input);
			
			$fh = fopen($input, 'r');
			$f = fread($fh, filesize($input));
			fclose($fh);
			$status = fcheck($f);
			if ($status == 0) {
				$cmd = $program . " " . $datalib . " -query " . $input . " -outfmt 10 -out " . $output . " -html";
				exec($cmd);
				$foh = fopen($output, 'r');
				if (filesize($output) == 0) {
					print "
			<div class='error'>Not a valid Database!11!</div>";
					fclose($foh);
				} else {echo $input;echo $output;file_put_contents("blast_result_file_name.txt",$output);exec ("SitePythonTest.py");
 
?>
			<table id="myTable" class="stripe">
				<thead>
					<tr>
						<th>qseqid</th>
						<th>sseqid</th>
						<th>pident</th>
						<th>length</th>
					</tr>
				</thead>
				<?php $EhsanArray=array();

				foreach(file($output) as $line) {
					   $myArray = (explode(",",$line));
?>
				<tr>
					<td>
						<?php echo $myArray [0]; ?>
					</td>
					<td>
						<?php echo $myArray [1]; array_push($EhsanArray, $myArray [1]); ?>
					</td>
					<td>
						<?php echo $myArray [2]; ?>
					</td>
					<td>
						<?php echo $myArray [3]; ?>
					</td>
				</tr>
				<?php             
	}
?>
			</table>
			<?php
				$fo = fread($foh, filesize($output));
					print "
			<div class='output'>
				<h2 style='text-align: center; font-family: 'Times New Roman', Georgia, Serif;'>
					<i style='font-size: small;'>loc</i>
					<span style='color:blue'>BLAST</span> - Local NCBI BLAST+ Search
				</h2>
				<hr class='heffect' />
				<div class='space' style='font-family: monospace, 'Courier New', courier;'>" . $fo . "</div>
			</div>";
					fclose($foh);
				}
				unlink($input);
				unlink($output);
			} else {
				print "
			<div class='error'>Invalid FASTA file input!!</div>";
				unlink($input);
			}
		} else {
			$tmpif = 'blast' . '.fas';
			$tmpof = 'blast'  .'.htm';
			$fhsq = fopen($tmpif, 'w') or die("
			<div class='error'>File Creation Failed!!</div>");
			fwrite($fhsq, $sequence);
			fclose($fhsq);
			$sttus = fcheck($sequence);
			if ($sttus == 0) {
				$cmds = $program . " " . $datalib . " -query " . $tmpif . " -outfmt ".'"10 qseqid sseqid pident length mismatch gapopen qstart qend sstart send evalue bitscore qlen sseq"'." -out " . $tmpof . " -html";
				exec($cmds);
				$fsoh = fopen($tmpof, 'r');
				if (filesize($tmpof) == 0) {
					print "
			<div class='error'>Not a valid Database!1!</div>";
					fclose($fsoh);
				} else {echo $tmpif;echo $tmpof;file_put_contents("blast_result_file_name.txt",$tmpof);exec ("SitePythonTest.py");
?>
			<table id="myTable" class="stripe">
				<thead>
					<tr>
						<th>qseqid</th>
						<th>sseqid</th>
						<th>pident</th>
						<th>length</th>
						<th>mismatch</th>
						<th>gapopen</th>
						<th>qstart</th>
						<th>qend</th>
						<th>sstart</th>
						<th>send</th>
						<th>evalue</th>
						<th>bitscore</th>
						<th>qlen</th>
						<th>slen</th>
					</tr>
					</thead>
				<?php $EhsanArray=array();
				foreach(file($tmpof) as $line) {
					   $myArray = (explode(",",$line));
?>
				<tr>
					<td>
						<?php echo $myArray [0]; ?>
					</td>
					<td>
						<?php echo $myArray [1]; array_push($EhsanArray, $myArray [1]); ?>
					</td>
					<td>
						<?php echo $myArray [2]; ?>
					</td>
					<td>
						<?php echo $myArray [3]; ?>
					</td>
					<td>
						<?php echo $myArray [4]; ?>
					</td>					
					<td>
						<?php echo $myArray [5]; ?>
					</td>					
					<td>
						<?php echo $myArray [6]; ?>
					</td>					
					<td>
						<?php echo $myArray [7]; ?>
					</td>					
					<td>
						<?php echo $myArray [8]; ?>
					</td>					
					<td>
						<?php echo $myArray [9]; ?>
					</td>					
					<td>
						<?php echo $myArray [10]; ?>
					</td>					
					<td>
						<?php echo $myArray [11]; ?>
					</td>					
					<td>
						<?php echo $myArray [12]; ?>
					</td>					
					<td>
						<?php echo $myArray [13]; ?>
					</td>					
				</tr>
				<?php             
	}
?>
			</table>
			<?php

				}
			} else {
				print "
			<div class='error'>Invalid FASTA file input!!!</div>";
				unlink($tmpif);
			}
		}
	}
} else {
	echo "One of these errors happened:<br/>";
	echo "* input file or sequence is not in in appropriate format <br/>";
	echo '<a href="blastform.php">Click here to go back to Blast input form</a>';
	
	?>
			<?php 
}
?>
</div>
-->
	
<?php
include ("footer.html");
?>
