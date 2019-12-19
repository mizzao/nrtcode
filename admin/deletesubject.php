<?
include('../connect.php');

$subjectID = $_GET["subjectid"];

if($subjectID == null)
{
  die("Error: Navigating directly to this page is prohibited.");
}

mysql_query("DELETE FROM `nrt_subjects` WHERE SubjectID=" . $subjectID);
mysql_query("DELETE FROM `nrt_questionresults` WHERE SubjectID=" . $subjectID);
mysql_query("DELETE FROM `nrt_testresults` WHERE SubjectID=" . $subjectID);

header('Location: index.php');
?>
