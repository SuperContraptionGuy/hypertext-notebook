<html>
 <head>
  <title>New Card</title>
 </head>
 <body>
<?php 

$id_number = $_POST["id_number"];
$short_title = $_POST["short_title"];
$long_title = $_POST["long_title"];
$url_to_self = $id_number.".html";

$template = file_get_contents("template.html");
/*

Short title
URL to self
ID number
Long title
URL to self

*/


$part1 = 	substr($template, 0, strpos($template, "|"));
$nextpart = 	substr($template, strpos($template, "|")+1);
$part2 = 	substr($nextpart, 0, strpos($nextpart, "|"));
$nextpart = 	substr($nextpart, strpos($nextpart, "|")+1);
$part3 = 	substr($nextpart, 0, strpos($nextpart, "|"));
$nextpart = 	substr($nextpart, strpos($nextpart, "|")+1);
$part4 = 	substr($nextpart, 0, strpos($nextpart, "|"));
$nextpart = 	substr($nextpart, strpos($nextpart, "|")+1);
$part5 = 	substr($nextpart, 0, strpos($nextpart, "|"));
$nextpart = 	substr($nextpart, strpos($nextpart, "|")+1);
$part6 = 	substr($nextpart, 0, strpos($nextpart, "|"));
$nextpart = 	substr($nextpart, strpos($nextpart, "|")+1);
$part7 = 	substr($nextpart, 0, strpos($nextpart, "|"));

$nextpart = 	substr($nextpart, strpos($nextpart, "|")+1);
//$part8 = 	substr($nextpart, 0, strpos($nextpart, "|"));
$part8 = $nextpart;

//$filefooter = substr($filefooter, strpos($filefooter, "<!-- ===== -->"));
//$fileheader = substr($fileold, 0, strpos($fileold, "<!-- ===== -->")+14);

//$filenew = $fileheader.$filenew.$filefooter;

$filenew = $part1.$short_title.$part2.$url_to_self.$part3.$id_number.$part4.$long_title.$part5.$url_to_self.$part6.$url_to_self.$part7.$url_to_self.$part8;

//echo $filenew;

file_put_contents($url_to_self, $filenew);

echo "<br><p>Saved!</p>";
echo '<meta http-equiv="refresh" content="0; url=edit.php?file='.$url_to_self.'">';


?>



 </body>
</html>
