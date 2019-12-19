<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Number Reduction Task</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="header.css" rel="stylesheet" type="text/css"/>
  <link href="practiceintro.css" rel="stylesheet" type="text/css"/>
</head>

<?php
include('common.php');
?>

<script>
function to_index()
{
<?php
echo "location=\"index.php?uuid=" . $uuid . "\";";
?>
}
</script>

<body>

<?php
include('header.php');

echo "
<div id=\"explanation\">

<p>
Dear participant,
</p>

<p>
Thank you for attempting the Practice Tests. Unfortunately, a score of 8 or more is needed in order to progress on to the next stage of testing, and your score on this attempt was not yet high enough.
</p>

<p>
Please re-attempt the Practice Tests in order to proceed. If you are having trouble with the tests, please take a look at the worked examples on the testing screen: these show how the final result should be determined for each test.
</p>

</div>

<div id=\"rundiv\">
  <input type=\"button\" class=\"run\" value=\"Return\" onclick=\"to_index();\"/>
</div>";
?>

</body>

</html>
