<?php
include ("head.html");
?>
<title>SinCoGenesDB</title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/blastform.css" />
<style>
.download_button
{background-color: #00b33c; color: white;  padding: 14px 25px;  text-align: center;  text-decoration: none;	display: inline-block;}
</style>

<script>
var _validFileExtensions = [".txt", ".tab", ".csv", ".tabular"];    
function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Sorry, allowed file extensions are: csv, tab, tabular, txt");
                    return false;
                }
            }
        }
    }
  
    return true;
}
</script>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.php");
?>


<div id="content">
	<br> 
	<div class="blastnav-e11">
	<div class="blastform">
	<b style="color:orange;" >Run on our server (not recommended):</b><hr>
	<form onsubmit="return Validate(this);" action="mlc_result.php" method="post" name="blastform" enctype= "multipart/form-data">
	<b style= "font-size:16; color:darkgreen;" >Load blast results</b> (only in tabular or csv format): 
	<input class="effect" type="file" name="inpfile">
<div class="subblastform1">
	<b style= "font-size:16; color:darkgreen;" >File format:</b><br>
	<input type="radio" class="effect" id="inputfileformat" name="inputfileformat" checked="checked" value="tab"> Tabular (tab) 
	<input type="radio" class="effect" id="inputfileformat" name="inputfileformat" value="csv" > csv
</div>
<div class="subblastform2">
	Sequence type:<br>
	<input type="radio" class="effect" id="sequencetype" name="sequencetype" value="AA" > Protein
	<input type="radio" class="effect" id="sequencetype" name="sequencetype" checked="checked" value="NA"> RNA or DNA 
	<br>
</div>
	My file has a title line:<br>
	<input type="radio" class="effect" id="datahead" name="datahead" value="yes"> Yes <input type="radio" class="effect" id="datahead" name="datahead" checked="checked" value="no" > No<br>
	<br>
	<p >
	<input class="effect" type="submit" style="background-color: #4be341;min-width: 20%;" name="submit" value="Classify my genes">
	</p>
	</form><hr>
	Sample blast results file: <a href="sample_blast_result.tab" download>csv format</a> , 
	<a href="sample_blast_result.tab" download>tabular format</a> <br>
	</div>
	</div>
	<div class="blastnav-e22">
		<div class="blastformRight">
		<b style="color:orange;" >Download and run on your server:</b><hr>
		For a better experience with huge blast result files, download our Model-Classifier and classify your genes on your local computer. This needs much lower upload and download and is faster!
		<br><br>
		<a class="download_button" href="SCiPDB15Tir2CBB.zip" style=""> Download Model-Classifier (14 MB) </a>
		<br><br>
		<p style="font-size: 14px; color: gray;">This zip file also contains a brief tutorial on how 
		to start classify by blast on your computer in less than 5 minutes.</p>
		Click here to see a brief tutorial on how to easily work with mlClassify on your computer.
		<br><br>
		</div>	
	</div>
	</div>

<?php
include ("footer.html");
?>
