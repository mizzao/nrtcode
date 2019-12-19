<?php
include('../connect.php');

function print_subjects()
{
  $result = mysql_query("SELECT SubjectID FROM `nrt_subjects` ORDER BY SubjectID ASC");
  while($row = mysql_fetch_array($result))
  {
    $subjectID = $row[0];
    echo "
            <option value=\"" . $subjectID . "\">" . $subjectID . "</option>";
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Number Reduction Task - Administration</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="index.css" rel="stylesheet" type="text/css"/>
</head>

<script>
function delete_subject()
{
  if(confirm("Are you sure you want to delete this subject?"))
  {
    var deleteElt = document.getElementById("delete");
    window.location = 'deletesubject.php?subjectid=' + deleteElt.value;
  }
}

function download_table()
{
  var downloadElt = document.getElementById("download");
  window.location = 'download.php?table=' + downloadElt.value;
}

function goto_subject()
{
  var gotoElt = document.getElementById("goto");
  window.location = 'gotosubject.php?subjectid=' + gotoElt.value;
}

function new_subject()
{
  window.location = 'newsubject.php';
}
</script>

<body>

<div id="title">Number Reduction Task - Administration</div>

<div id="tasks">
  <form>
    <table>
      <tr>
        <td>New Subject</td>
        <td></td>
        <td><input type="button" class="go" value="Go" onclick="new_subject();"/></td>
      </tr>
      <tr>
        <td>Delete Subject:</td>
        <td>
          <select id="delete">
<?php
print_subjects();
?>
          </select>
        </td>
        <td><input type="button" class="go" value="Go" onclick="delete_subject();"/></td>
      </tr>
      <tr>
        <td>Go To Subject:</td>
        <td>
          <select id="goto">
<?php
print_subjects();
?>
          </select>
        </td>
        <td><input type="button" class="go" value="Go" onclick="goto_subject();"/></td>
      </tr>
      <tr>
        <td>Download Table:</td>
        <td>
          <select id="download">
<?php
$result = mysql_query("SELECT TABLE_NAME FROM `INFORMATION_SCHEMA`.TABLES WHERE TABLE_SCHEMA='gxstudio_Jan'");
while($row = mysql_fetch_array($result))
{
  $table = $row[0];
  echo "
            <option value=\"" . $table . "\">" . $table . "</option>";
}
?>
          </select>
        </td>
        <td><input type="button" class="go" value="Go" onclick="download_table();"/></td>
      </tr>
    </table>
  </form>
</div>

</body>

</html>
