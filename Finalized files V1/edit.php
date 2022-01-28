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


 <p><input type="submit" value="Save" /></p>


</form>
