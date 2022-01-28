<html>
<?php
$filename = $_GET["file"];
$filenew  = $_POST["editor"];
?>

 <head>
  <title>Saving Card</title>

<!-- redirects to saved file. -->
<!--
<meta http-equiv="refresh" content="0; url=<?php echo $filename; ?>">
-->

 </head>
 <body>

<?php 

//echo var_dump($_GET);
//echo var_dump($_POST);

$fileold = file_get_contents($filename);
$filefooter = substr($fileold, strpos($fileold, "<!-- ===== -->")+14);
$filefooter = substr($filefooter, strpos($filefooter, "<!-- ===== -->"));
$fileheader = substr($fileold, 0, strpos($fileold, "<!-- ===== -->")+14);

$filenew = $fileheader.$filenew.$filefooter;

//echo "<hr>";
//echo $filename;
//echo $filenew;

file_put_contents($filename, $filenew);

echo "<p>Saved!</p>";
echo '<meta http-equiv="refresh" content="0; url='.$filename.'">';


?>



 </body>
</html>
