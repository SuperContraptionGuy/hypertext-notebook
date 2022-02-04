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
// function for letters to number pasted from comment on https://www.php.net/manual/en/function.base-convert.php
function convBase($numberInput, $fromBaseInput, $toBaseInput)
{
    if ($fromBaseInput==$toBaseInput) return $numberInput;
    $fromBase = str_split($fromBaseInput,1);
    $toBase = str_split($toBaseInput,1);
    $number = str_split($numberInput,1);
    $fromLen=strlen($fromBaseInput);
    $toLen=strlen($toBaseInput);
    $numberLen=strlen($numberInput);
    $retval='';
    if ($toBaseInput == '0123456789')
    {
        $retval=0;
        for ($i = 1;$i <= $numberLen; $i++)
            //$retval = bcadd($retval, bcmul(array_search($number[$i-1], $fromBase),bcpow($fromLen,$numberLen-$i)));
	bcadd("0", "1");
        return $retval;
    }
    if ($fromBaseInput != '0123456789')
        $base10=convBase($numberInput, $fromBaseInput, '0123456789');
    else
        $base10 = $numberInput;
    if ($base10<strlen($toBaseInput))
        return $toBase[$base10];
    while($base10 != '0')
    {
        $retval = $toBase[bcmod($base10,$toLen)].$retval;
        $base10 = bcdiv($base10,$toLen,0);
    }
    return $retval;
}
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

$option = $_GET["option"];	// should be either "child" or "sibling", or maybe "next" or "fork". Default to "next"
$referenceFilename = $_GET["file"];
if (empty($referenceFilename)) {
// empty string, default to root
$referenceFilename = "0";

} else {
// was not empty. probably should clean the input here.

}
// parse the reference filename.  chop out all the number and letter sections.  convert letters to numbers? Then in the next function, either increment the final field, or add a new field and regenerate an alphanumeric field.

// parse into array, get dimensions.
// cut off file name if it exists
$referenceFilename = explode(".html", $referenceFilename)[0];
// split string into array at alphanumberic boundaries.  Tested with awesome tool https://regex101.com/
$refSplit = preg_split("/(?<=[a-z])(?=\d)|(?<=\d)(?=[a-z])/", $referenceFilename);
// get the number of fields by counting the size of the array
$refNumFields = count($refSplit);


// TODO:

// next step is to choose use the if statements below to follow an option, then do some math on the last field by converting alphabetic characters from base 26 to base 10 using convBase() function, converting that to an integer, increment by one, then convert back to string, from base10 to base26, and append all the fields together.  Add a .html file extension, and there's the file name.  If it's an add child option, then just add a new field with the lowest value (1 or a) depending on if it's an even or odd field (odd fields are numbers, even fields are letters), append all fields (including new one), append .html, and there ya go.

echo "URL GET string was ";
var_dump($_GET);
echo "Extracted \n";
var_dump($referenceFilename);
var_dump($option);
echo "reference Filename split array: \n";
var_dump($refSplit);
echo "refarray size: \n";
var_dump($refNumFields);


//convBase(); for converting letter codes from base26 to base10, then use
//intval();   to type cast the decimal string to an int for math.
//strval();	to go the other way.

//implode();  to recombine array into a string after modifying the array by changing an element or adding an element


// $option should be either "child" or "sibling", or maybe "next" or "fork". Default to "next"

$branchValue = 0;
// determine numeric value of last array element
if ($refNumFields % 2 == 0) {	// if is even -> is alphabet

	$branchValue = intval(convBase($refSplit[$refNumFields - 1], "abcdefghijklmnopqrstuvwxyz", "0123456789"));

} else {	// is odd -> is decimal number

	$branchValue = intval($refSplit[$refNumFields - 1]);
}

if (strcmp($option, "child") == 0 || strcmp($option, "fork") == 0) {
	// was "child" or "fork"
	
	
	$refSplit[] = "";	// add a new element to array, odd or even, then find the last file on the system.
	$refNumFields += 1;	// increase length by one.


//} elseif (strcmp($option, "sibling") == 0 || strcmp($option, "next") {
} else {
// was "sibling" or "next"
// was something else. Default to "next"
// do nothing.

}
$newFileSplit = $refSplit;
echo "original value: ";
echo var_dump($branchValue);
do {
	$branchValue += 1;
	echo "branch new value";
	echo var_dump($branchValue);
	if ($refNumFields % 2 == 0) {
		// even -> alphabet
		$newFileSplit[$refNumFields - 1] = convBase(strval($branchValue), "0123456789", "abcdefghijklmnopqrstuvwxyz");
	} else {
		// odd -> numeric decimal
		$newFileSplit[$refNumFields - 1] = strval($branchValue);
	}
	$newFileName = implode($newFileSplit) . ".html";

	echo "test this name: ";

	echo var_dump($newFileName);

}
while(file_exists($newFileName));

echo "Decided on this filename:";
echo var_dump($newFileName);

//$name = ;

?>
ID number: <input type="text" name="id_number" value="<?php echo explode(".html", $newFileName)[0]; ?>"><br>
Short title: <input type="text" name="short_title"> (This can't be changed)<br>
Long title: <input type="text" name="long_title"> (This can be adjusted later)<br>


<p><input type="submit" value="Create" /> (Go back to cancel)</p>
</form>



</body>
</html>
