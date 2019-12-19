<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Number Reduction Task</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="header.css" rel="stylesheet" type="text/css"/>
  <link href="questions.css" rel="stylesheet" type="text/css"/>
</head>

<?php
include('common.php');

$groupID = $_POST["groupID"];

if($groupID == null)
{
  die("Error: Navigating directly to this page is prohibited.");
}
?>

<script>
function submit_answers()
{
  var questions = document.getElementsByClassName("question");
  for(var i = 0; i < questions.length; ++i)
  {
    if(questions[i].value == -1)
    {
      alert("Please make sure you have selected an answer for every question.");
      return;
    }
  }

  var questionsForm = document.getElementById("questionsform");
  questionsForm.submit();
}
</script>

<body>

<?php
include('header.php');

$result = mysql_query("SELECT * FROM `nrt_questiongroups` WHERE GroupID=" . $groupID);
$row = mysql_fetch_array($result);

echo "<div id=\"grouptext\">" . $row["GroupText"] . "</div>";

echo "<div id=\"instructions\">Please select the most appropriate answer for each question.</div>";

$result = mysql_query("SELECT * FROM `nrt_questions`, `nrt_questionoptions` WHERE GroupID=" . $groupID . " AND `nrt_questions`.QuestionID = `nrt_questionoptions`.QuestionID ORDER BY `nrt_questions`.QuestionID ASC, OptionID ASC" );

echo "
<form id=\"questionsform\" action=\"submit_questions.php?uuid=" . $uuid . "\" method=\"post\">
  <div id=\"questions\">
    <table id=\"questionstable\">";

$lastQuestionID = -1;
while($row = mysql_fetch_array($result))
{
  $questionID = $row["QuestionID"];
  $questionText = $row["QuestionText"];
  if($lastQuestionID == -1)
  {
    $questionIDOffset = 1 - $questionID;
    echo "
      <tr>
        <td>1. " . $questionText . "</td>";
    echo "
        <td>
          <select class=\"question\" name=\"" . $questionID . "\">
            <option value=\"-1\"></option>";
    $lastQuestionID = $questionID;
  }
  else if($questionID != $lastQuestionID)
  {
    echo "
          </select>
        </td>
      </tr>";
    echo "
      <tr>
        <td>" . ($questionID + $questionIDOffset) . ". " . $questionText . "</td>";
    echo "
        <td>
          <select class=\"question\" name=\"" . $questionID . "\">
            <option value=\"-1\"></option>";
    $lastQuestionID = $questionID;
  }

  $optionID = $row["OptionID"];
  $optionText = $row["OptionText"];
  echo "
            <option value=\"" . $optionID  . "\">" . $optionText . "</option>";
}

echo "
          </select>
        </td>
      </tr>
    </table>
  </div>
</form>

<div id=\"submitanswersdiv\">
  <input type=\"submit\" class=\"submitanswers\" value=\"Submit Answers\" onclick=\"submit_answers();\"/>
</div>";
?>

</body>

</html>
