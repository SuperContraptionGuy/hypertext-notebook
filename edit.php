<link rel="stylesheet" href="jodit-3.10.2/build/jodit.min.css">
<script src="jodit-3.10.2/build/jodit.min.js"></script>

<form action="save.php?file=<?php echo $_GET["file"]; ?>" method="post">
<textarea id="editor" name="editor">this is something to start with.</textarea>

<?php
//echo "<p>_GET returned:</p>";
//var_dump( $_GET);
//echo $_GET["file"];
//echo "<hr>";
?>

<script>
var editor = new Jodit("#editor", {
  "useSearch": false,
  "iframe": true,
  "iframeStyle": "",
  "spellcheck": false,
  "toolbarButtonSize": "xsmall",
  "showCharsCounter": false,
  "showWordsCounter": false,
  "showXPathInStatusbar": false,
  "minHeight": 300,
  "buttons": "bold,italic,underline,strikethrough,ul,ol,indent,outdent,fontsize,superscript,subscript,image,file,link,symbol,undo,redo,source"
});
editor.value = "<?php 


$filestring = file_get_contents($_GET["file"]);

// The following two lines trim off the header information, including <html><head></head><body> and </body></html> and only returns to the editor the main contents.  It does this by searching for the string "<!-- ===== -->" that I specifically built into the templates
$filestring = substr($filestring, strpos($filestring, "<!-- ===== -->")+14);
$filestring = substr($filestring, 0, strpos($filestring, "<!-- ===== -->"));

$filestring = str_replace("\n","",$filestring);
$filestring = str_replace("\r\n","",$filestring);
$filestring = str_replace("\\r\\n","",$filestring);
$filestring = str_replace("\\n","",$filestring);
$filestring = str_replace("\r","",$filestring);
$filestring =  addslashes($filestring);
echo $filestring;

// Not allowed to use script tags in the included files, or else it breaks.



 ?>";
</script>


 <p>
<input type="submit" value="Save" />
</p>
</form>

<input type="file" name="file_to_upload" id="file_to_upload">
<br>
<input type="button" value="Upload File" id="upload_file_button">
<span id="response"></span>

<script>

function gotResponse(response) {

	document.getElementById("response").innerHTML = response;
}

function uploadFile(file) {

	var formData = new FormData();
	formData.append('file_to_upload', file);
	formData.append('note_name', "<?php echo $_GET['file']; ?>");
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if(ajax.readyState === 4) {
			gotResponse(ajax.response);
		}
	};
	ajax.open('POST', 'uploader.php');
	ajax.send(formData);
}

document.getElementById('file_to_upload').addEventListener('change', (event) => {

	window.selectedFile = event.target.files[0];
	});

document.getElementById('upload_file_button').addEventListener('click', (event) => {

	uploadFile(window.selectedFile);
	});


</script>
