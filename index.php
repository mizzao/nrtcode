<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Number Reduction Task</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="header.css" rel="stylesheet" type="text/css"/>
  <link href="index.css" rel="stylesheet" type="text/css"/>
</head>

<?php
include('common.php');
?>

<script>
function run_practice_tests()
{
<?php
  echo "location = \"practiceintro.php?uuid=" . $uuid . "\";";
?>
}

function run_questionnaire()
{
<?php
  echo "location = \"questionnaire.php?uuid=" . $uuid . "\";";
?>
}

function run_tests(startTest, endTest)
{
  var startTestElt = document.getElementById("startTest");
  var endTestElt = document.getElementById("endTest");
  startTestElt.value = startTest;
  endTestElt.value = endTest;
  startTestElt.form.submit();
}
</script>

<body>

<?php
include('header.php');

echo "
<div id=\"options\">
  <table>";

echo "
    <tr>
      <td>Questionnaire</td>
      <td>" . ($subjectRow["CompletionQ"] == null ? "<input type=\"button\" class=\"run\" value=\"View\" onclick=\"run_questionnaire();\"/>" : "Completed") . "</td>
    </tr>";

echo "
    <tr>
      <td>Practice Tests</td>
      <td>" . ($subjectRow["CompletedP"] <= 7 ? "<input type=\"button\" class=\"run\" value=\"Start\" onclick=\"run_practice_tests();\"/>" : "Completed") . "</td>
    </tr>";

echo "
    <tr>
      <td>Round 1 Tests</td>
      <td>";

if($subjectRow["CompletedP"] <= 7)
  echo "Please complete the Practice Tests";
else if($subjectRow["Completion1"] == null)
  echo "<input type=\"button\" class=\"run\" value=\"Start\" onclick=\"run_tests(15,60);\"/>";
else
  echo "Completed";

echo "
      </td>
    </tr>";

echo "
    <tr>
      <td>Round 2 Tests</td>
      <td>";

$result = mysql_query("SELECT TIMESTAMPDIFF(HOUR,Completion1,CURRENT_TIMESTAMP()) FROM `nrt_subjects` WHERE SubjectID=" . $subjectRow["SubjectID"]);
$row = mysql_fetch_array($result);
$hours = $row[0];

if($subjectRow["CompletedP"] <= 7)
  echo "Please complete the Practice Tests";
else if($subjectRow["Completion1"] == null)
  echo "Please complete the Round 1 Tests";
else if($subjectRow["Completion2"] != null)
  echo "Completed";
else if($hours < 11)
  echo "Please wait " . (11 - $hours) . " hour(s)";
else if($hours > 14)
  echo "No longer available (sorry)";
else
  echo "<input type=\"button\" class=\"run\" value=\"Start\" onclick=\"run_tests(105,255);\"/>";

echo "
      </td>
    </tr>";

echo "
  </table>
</div>";

?>

<?php
echo "<form action=\"test.php?uuid=" . $uuid . "\" method=\"post\"/>";
?>
  <input type="hidden" id="startTest" name="startTest"/>
  <input type="hidden" id="endTest" name="endTest"/>
</form>

</body>

</html>
