<?php
include('connect.php');
$uuid = mysql_real_escape_string($_GET["uuid"]);
$result = mysql_query("SELECT * FROM `nrt_subjects` WHERE UUID=\"" . $uuid . "\"", $connection) or die("Couldn't execute query.");
$subjectRow = mysql_fetch_array($result);
if($subjectRow == null) die("Error: No subject found with UUID " . $uuid . ".");
?>
