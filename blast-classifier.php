<?php
include ("head.html");
?>
<title>ParalogyDB | Classify by Blast </title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/blastform.css" />
<style>
.download_button
{background-color: #00b33c; color: white;  padding: 14px 25px;  text-align: center;  text-decoration: none;	display: inline-block;}
</style>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>


<div id="content">
	<div class="blastform1">
	<b style="color:orange;" >Classify by blast</b><hr>	
	<form action="blast/blast-results.php" method="post" name="blastform" enctype= "multipart/form-data">
	<p>
	<b>Enter (up to 50) sequences below in 
	<abbr title="This is a sample sequence in fasta format:
&gt;At1g03650&#13;MDKGVVVELIRGSTSWAKVVEDIVKLEKKTFPKHESLAQTFDAELRKKNAGLLYV&#13;DAEGDTVGYAMYSWPSSLSASITKLAVKENCRRQGHGEALLRAAIDKCRSRKVQ&#13;RVSLHVDPTRTSAVNLYKKLGFQVDCLVKSYYSADRDAYRMYLDFDDSI">FASTA</abbr>  
format</b> (<a style="font-size:small" onclick="javascript:document.getElementById('program').value='blastp';
	document.getElementById('sequence').value='>At1g03650 GCN5-related N-acetyltransferase\nMDKGVVVELIRGSTSWAKVVEDIVKLEKKTFPKHESLAQTFDAELRKKNAGLLYVDAEGDTVGYAMYSWPSSLSASITKLAVKENCRRQGHGEALLRAAIDKCRSRKVQRVSLHVDPTRTSAVNLYKKLGFQVDCLVKSYYSADRDAYRMYLDFDDSI';" href="javascript:void()">Demo Sequence</a>)
	<br />
	<textarea class="effect" style="width: 100%;" name="sequence" id="sequence" rows=6 cols=60></textarea>
	<br />
	<div class='blabel'>
	<b>Or, upload fasta file:</b> 
	</div>
	<input type="file" name="seqfile">
	</p>

	<p>
	<div class='blabel'>
	<b>Sequence type:</b>
	</div>
	<input type="radio" class="effect" id="program" name="program" checked="checked" value="blastp"> Protein (Amino acid)
	<input type="radio" class="effect" id="program" name="program" value="blastx" > DNA or RNA (Nucleic acid)
	<br>
	<br>
	<div class='blabel'>
	<abbr title="The paralogy dataset that will be used as the reference for paralogy classification of your sequence(s)."><b>Paralogy data:</b></abbr>
	</div>
	<input type="radio" class="effect" id="pdb" name="pdb" value="cpc"> COMPARA
	<input type="radio" class="effect" id="pdb" name="pdb" value="mcpc" > modified COMPARA
	<input type="radio" class="effect" id="pdb" name="pdb" value="mpc" checked="checked"> SCiPDB model
	<br>
	<br>
	<div class='blabel'>
	<abbr title="The number of best hits of each of your sequences that will be used for classification of that sequence."><b>Classifier hits:</b></abbr>
	</div>
	<input type="radio" class="effect pm" id="parhitnumber" name="parhitnumber" value="3"> 3
	<input type="radio" class="effect" id="parhitnumber" name="parhitnumber" value="5" > 5
	<input type="radio" class="effect" id="parhitnumber" name="parhitnumber" checked="checked" value="7"> 7
	<input type="radio" class="effect" id="parhitnumber" name="parhitnumber" value="9"> 9
	<br>
	<br>
	</p>

	<p >
	<input class="effect" type="button" style="color:white; background-color: #f44336; min-width: 30%; min-height: 35px;" name="clear" value="Clear Sequence" onClick="document.getElementById('sequence').value=''; document.getElementById('sequence').focus();">
	<input class="effect" type="submit" style="color:white; background-color: #4be341; min-width: 40%; min-height: 35px;" name="submit" value="Classify">
	</p>
	</form>
	</div>
		<div class="blastform2">
		<b style="color:orange;" >Download classify by blast</b><hr>
		<p class="moredescription" style="font-size: 14px; color: gray;">Simply download and run by blast 
		classifications on your local computer.</p>
		<a class="download_button" href="SCiPDB15Tir2CBB.zip" style=""> Download Blast Classifier (124 MB) </a>
		<br><br>
		<p style="font-size: 14px; color: gray;">This zip file also contains a brief tutorial on how 
		to start classify by blast on your computer in less than 5 minutes.</p>
		<br><br>
		</div>

<?php
include ("footer.html");
?>
