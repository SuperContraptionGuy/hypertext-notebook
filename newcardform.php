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

ID number: <input type="text" name="id_number" value="<?php $date = new DateTime(); echo $date->format('Y.m.d.H.i'); ?>">(Format: yyyy.mm.dd.hh.mm Can't be changed, use unique number.)<br>
Short title: <input type="text" name="short_title"> (This can't be changed)<br>
Long title: <input type="text" name="long_title"> (This can be adjusted later)<br>


<p><input type="submit" value="Create" /> (Go back to cancel)</p>
</form>



</body>
</html>
