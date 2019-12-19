<?php
include('common.php');

$subjectID = $subjectRow["SubjectID"];
foreach($_POST as $questionID => $optionID)
{
  mysql_query("INSERT INTO `nrt_questionresults` (SubjectID, QuestionID, OptionID) VALUES (" . $subjectID . "," . $questionID . "," . $optionID . ")");
}

header('Location: questionnaire.php?uuid=' . $uuid);
?>
