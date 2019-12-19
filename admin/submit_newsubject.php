<?php
include('../connect.php');

$subjectID = $_POST["SubjectID"];
$uuid = $_POST["UUID"];

if($subjectID == null || $uuid == null)
{
  die("Error: Navigating directly to this page is prohibited.");
}

mysql_query("INSERT INTO `nrt_subjects` (SubjectID, UUID) VALUES (" . $subjectID . ",'" . $uuid . "')");

header('Location: index.php');
?>
