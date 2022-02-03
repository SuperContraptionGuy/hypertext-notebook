<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>New Card</title>
<meta name="description" content="Roughtly 155 characters">
<link rel="stylesheet" type="text/css" href="userinterface.css">
</head>
<body>

<!--

Template needs

Short title
URL to self
identifier number
Long title
URL to self


-->

<form action="new.php" method="post">

<!-- ID number: <input type="text" name="id_number" value="<?php $date = new DateTime(); echo $date->format('Y.m.d.H.i'); ?>">(Format: yyyy.mm.dd.hh.mm Can't be changed, use unique number.)<br>
-->
<?php
//	Format is 1a1b2c3.html
//	first file is
//	1.html
//
//	letter order goes
//
//	a b c d .... x y z aa ab ac ad .... ax ay az ba bb bc bd ... bx by bz ca cb cc cd .... yx yy yz za zb zc zd .. zx zy zz aaa aab aac aad ... aay aaz aba abb abc abd ... aby abz aca acb acc acd ...
//
//	and numbers progress like this
//
//	1 2 3 4 ... 8 9 10 11 12 13 .. 18 19 20 21 21 23 ... 98 99 100 101 102 103 ...
//
//	input to the function should be a filename and an option determining if to return a sibling or child filename.  The output will be a filename

$referenceFilename = $_GET["file"];
if (empty($referenceFilename)) {
// empty string, default to root
$referenceFilename = "0";

} else {
// was not empty. probably should clean the input here.

}

$option = $_GET["option"];	// should be either "child" or "sibling", or maybe "next" or "fork". Default to "next"

if (strcmp($option, "child") == 0 || strcmp($option, "fork") == 0) {
// was "child" or "fork"


//} elseif (strcmp($option, "sibling") == 0 || strcmp($option, "next") {
} else {
// was "sibling" or "next"
// was something else. Default to "next"

}

$name = ;

?>
ID number: <input type="text" name="id_number" value="<?php echo $name; ?>"><br>
Short title: <input type="text" name="short_title"> (This can't be changed)<br>
Long title: <input type="text" name="long_title"> (This can be adjusted later)<br>


<p><input type="submit" value="Create" /> (Go back to cancel)</p>
</form>



</body>
</html>
