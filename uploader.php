<?php

$file_name = basename($_FILES["file_to_upload"]["name"]);
$file_temp_location = $_FILES["file_to_upload"]["tmp_name"];

file_put_contents('php://stderr', print_r($_FILES, TRUE));
file_put_contents('php://stderr', print_r($_POST, TRUE));

if (!$file_temp_location) {
	echo "No file selected.";
	exit();
}


$cleanFileName = str_replace(' ', '-', $file_name); // Replaces all spaces with hyphens.
$cleanFileName = preg_replace('/[^A-Za-z0-9\-.]/', '', $cleanFileName); // Removes special chars.
$cleanFileName = preg_replace('/-+/', '-', $cleanFileName); // Replaces multiple hyphens with single one.


$newFile = "res/" . $_POST["note_name"] . "_" . $cleanFileName;
if (move_uploaded_file($file_temp_location, $newFile)) {
	echo "\"" . $newFile . "\" uploaded.";
} else {
	echo "Unable to move the file";
}
?>
