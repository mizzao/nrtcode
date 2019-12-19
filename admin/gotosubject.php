<?
include('../connect.php');

$subjectID = $_GET["subjectid"];

if($subjectID == null)
{
  die("Error: Navigating directly to this page is prohibited.");
}

$result = mysql_query("SELECT UUID FROM `nrt_subjects` WHERE SubjectID=" . $subjectID);
if(mysql_num_rows($result) == 0)
{
  die("Error: Unknown subject ID " . $subjectID);
}

$row = mysql_fetch_array($result);
$uuid = $row[0];
header('Location: ../index.php?uuid=' . $uuid);
?>
