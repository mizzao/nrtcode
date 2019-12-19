<?php
include('common.php');

$result = mysql_query("SELECT * FROM `nrt_questiongroups` ORDER BY GroupOrder ASC");
$groupCount = 0;
while($row = mysql_fetch_array($result))
{
  $groupIDs[$groupCount] = $row["GroupID"];
  $groupText[$groupCount] = $row["GroupText"];
  $groupComplete[$groupCount] = false;
  ++$groupCount;
}

$subjectID = $subjectRow["SubjectID"];
$result = mysql_query("SELECT DISTINCT `nrt_questiongroups`.GroupID FROM `nrt_questiongroups`, `nrt_questionresults`, `nrt_questions` WHERE SubjectID=" . $subjectID . " AND `nrt_questiongroups`.GroupID = `nrt_questions`.GroupID AND `nrt_questions`.QuestionID = `nrt_questionresults`.QuestionID");

if(mysql_num_rows($result) == $groupCount)
{
  mysql_query("UPDATE `nrt_subjects` SET CompletionQ=NOW() WHERE SubjectID='" . $subjectID . "'");
  header('Location: index.php?uuid=' . $uuid);
  exit();
}

while($row = mysql_fetch_array($result))
{
  $groupComplete[$row["GroupID"]] = true;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Number Reduction Task</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="header.css" rel="stylesheet" type="text/css"/>
  <link href="index.css" rel="stylesheet" type="text/css"/>
</head>

<script>
function run_questions(groupID)
{
  var groupIDElt = document.getElementById("groupID");
  groupIDElt.value = groupID;
  groupIDElt.form.submit();
}
</script>

<body>

<?php
include('header.php');

echo "
<div id=\"options\">
  <table>";

for($i = 0; $i < $groupCount; ++$i)
{
  echo "
    <tr>
      <td>" . $groupText[$i] . "</td>
      <td>" . ($groupComplete[$groupIDs[$i]] ? "Completed" : "<input type=\"button\" class=\"run\" value=\"Start\" onclick=\"run_questions(" . $groupIDs[$i] . ");\"/>") . "</td>
    </tr>";
}

echo "
  </table>
</div>";

?>

<?php
echo "<form action=\"questions.php?uuid=" . $uuid . "\" method=\"post\"/>";
?>
  <input type="hidden" id="groupID" name="groupID"/>
</form>

</body>

</html>
