<?php
include('common.php');

$choices = $_POST["choices"];
$score = $_POST["score"];

if($choices == null)
{
  die("Error: Navigating directly to this page is prohibited.");
}

$subjectID = $subjectRow["SubjectID"];

$arr = split(",", $choices);
$len = count($arr);
for($i = 0, $len = count($arr); $i < $len; $i += 3)
{
  mysql_query("INSERT INTO `nrt_testresults` (SubjectID, TestID, Choice, TimeTaken) VALUES (" . $subjectID . "," .  $arr[$i] . "," . $arr[$i+1] . "," . $arr[$i+2] . ")");
}

// Set the completion time for the relevant test set (the way in which we determine the test set is ridiculously hacky :)).
if($len == 15 * 3)
{
  mysql_query("UPDATE `nrt_subjects` SET CompletedP=" . $score . " WHERE SubjectID='" . $subjectID . "'");
  if($score <= 7)
  {
    mysql_query("DELETE FROM `nrt_testresults` WHERE SubjectID=" . $subjectID . " AND TestID < 15");
    header('Location: badpractice.php?uuid=' . $uuid);
    exit();
  }
}
else if($len == 45 * 3)
{
  mysql_query("UPDATE `nrt_subjects` SET Completion1=NOW() WHERE SubjectID='" . $subjectID . "'");
}
else
{
  mysql_query("UPDATE `nrt_subjects` SET Completion2=NOW() WHERE SUBJECTID='" . $subjectID . "'");
}

header('Location: index.php?uuid=' . $uuid);
?>
