<?php
include('../connect.php');

function uuidv4()
{
  //return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
  return sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',

    // 32 bits for "time_low"
    mt_rand(0, 0xffff), mt_rand(0, 0xffff),

    // 16 bits for "time_mid"
    mt_rand(0, 0xffff),

    // 16 bits for "time_hi_and_version",
    // four most significant bits holds version number 4
    mt_rand(0, 0x0fff) | 0x4000,

    // 16 bits, 8 bits for "clk_seq_hi_res",
    // 8 bits for "clk_seq_low",
    // two most significant bits holds zero and one for variant DCE1.1
    mt_rand(0, 0x3fff) | 0x8000,

    // 48 bits for "node"
    mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
  );
}

$result = mysql_query("SELECT MAX(SubjectID) FROM `nrt_subjects`");
$row = mysql_fetch_array($result);
$subjectID = $row[0] + 1;

$uuid = uuidv4();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Number Reduction Task - Administration</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="newsubject.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div id="title">Number Reduction Task - New Subject</div>

<div id="fields">
  <form action="submit_newsubject.php" method="post">
    <table>
      <tr>
        <td>Subject ID:</td>
        <td>
<?php
echo $subjectID;
?>
        </td>
      </tr>
      <tr>
        <td>UUID:</td>
        <td>
<?php
echo $uuid;
?>
        </td>
      </tr>
      <tr>
      <td>Link:</td>
<?php
echo "
      <td><a href=\"http://www.gxstudios.net/nrt/index.php?uuid=" . $uuid . "\">http://www.gxstudios.net/nrt/index.php?uuid=" . $uuid . "</a></td>";
?>
      </tr>
      <tr>
        <td><input type="submit" value="Submit" class="go"/></td>
      </tr>
    </table>
<?php
echo "
    <input type=\"hidden\" name=\"SubjectID\" value=\"" . $subjectID . "\"/>
    <input type=\"hidden\" name=\"UUID\" value=\"" . $uuid . "\"/>";
?>
  </form>
</div>

</body>

</html>
