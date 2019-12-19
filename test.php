<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Number Reduction Task</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="header.css" rel="stylesheet" type="text/css"/>
  <link href="test.css" rel="stylesheet" type="text/css"/>
</head>

<?php
include('common.php');

$startTest = $_POST["startTest"];
$endTest = $_POST["endTest"];

if($startTest == null || $endTest == null)
{
  die("Error: Navigating directly to this page is prohibited.");
}
?>

<script>

<?php

// Embed the test data so that it can be accessed locally.
$result = mysql_query("SELECT * FROM `nrt_tests` ORDER BY TestID ASC");
$numRows = mysql_num_rows($result);

echo "
var testNumbers;
var testAnswers;

function embed_test_data()
{
  testNumbers = new Array(" . $numRows . ");
  testAnswers = new Array(" . $numRows . ");
  for(var i = 0; i < " . $numRows . "; ++i)
  {
    testNumbers[i] = new Array(8);
  }";

for($i = 0; $i < $numRows; ++$i)
{
  $testRow = mysql_fetch_array($result);

  if($i < $startTest || $i >= $endTest) continue;

  $numbers = split(",", $testRow["Numbers"]);
  for($j = 0; $j < 8; ++$j)
  {
    echo "
  testNumbers[" . $i . "][" . $j . "] = " . $numbers[$j] . ";";
  }

  echo "
  testAnswers[" . $i . "] = " . $testRow["Answer"] . ";";
}

echo "
}

var startTest = " . $startTest . ";
var endTest = " . $endTest . ";";
?>

var curTest;

var curScore;
var showExplanation = false;
var ticks;
var timeout;

function init()
{
  embed_test_data();

  curTest = startTest - 1;
  curScore = 0;
  next_test();
}

function make_choice(buttonElt)
{
  if(curTest == endTest) return;

  var choice = buttonElt.value;

  if(choice == testAnswers[curTest])
  {
    ++curScore;
    var score = document.getElementById("score");
    score.value = curScore;
    var scorediv = document.getElementById("scorediv");
    if(scorediv != null) scorediv.innerHTML = "Score: " + curScore;
  }

  var choices = document.getElementById("choices");
  if(choices.value != "") choices.value += ", ";
  choices.value += curTest + ", " + choice + ", " + ticks;

  next_test();
}

function next_test()
{
  ++curTest;

  if(curTest == endTest)
  {
    choices.form.submit();
  }

  ticks = -100;
  if(timeout != null) clearTimeout(timeout);

  if(curTest != endTest)
  {
    if(showExplanation) toggle_explanation();
    update_numbers();
  }

  update_progress();
  update_time();
}

function toggle_explanation()
{
  var enumbers = document.getElementById("enumbers");
  var toggleexplanation = document.getElementById("toggleexplanation");
  if(showExplanation)
  {
    showExplanation = false;
    toggleexplanation.value = "Show Explanation";
    enumbers.style.display = 'none';
  }
  else
  {
    showExplanation = true;
    toggleexplanation.value = "Hide Explanation";
    enumbers.style.display = 'block';
  }
}

function update_numbers()
{
  for(var i = 0; i < 8; ++i)
  {
    var num = document.getElementById("n" + i);
    num.innerHTML = testNumbers[curTest][i];
  }

  var workingnumbers = document.getElementsByClassName("workingnumber");
  for(var i = 0; i < workingnumbers.length; ++i)
  {
    workingnumbers[i].value = '';
  }

<?php
// If these are the practice tests, update the explanation as well.
if($startTest == 0)
{
  echo "
  var result = testNumbers[curTest][0];
  for(var i = 1; i < 8; ++i)
  {
    if(testNumbers[curTest][i] != result)
    {
      switch(testNumbers[curTest][i] + result)
      {
        // 1, 4
        case 5: result = 9; break;

        // 1, 9
        case 10: result = 4; break;

        // 4, 9
        default: result = 1; break;
      }
    }
    var num = document.getElementById(\"e\" + (i-1));
    num.innerHTML = result;
  }
";
}
?>
}

function update_progress()
{
  var progress = document.getElementById("progress");
  progress.innerHTML = "Progress: " + (curTest - startTest) + " / " + (endTest - startTest);
}

function update_time()
{
  ticks += 100;
  timeout = setTimeout(update_time, 100);
  if(curTest == endTest) progress.innerHTML = "Done";
}

window.onload = init;
</script>

<body>

<?php
include('header.php');
?>

<div id="progress"></div>

<?php
// If these are the practice tests, show the score.
if($startTest == 0)
{
  echo "<div id=\"scorediv\">Score: 0</div>";
}
?>

<div class="numbers">
  <table class="numberstable">
    <tr>
<?php
for($i = 0; $i < 8; ++$i)
{
  echo "      <td id=\"n" . $i . "\" class=\"number\"></td>\n";
}
?>
    </tr>
    <tr>
      <td><input type="text" class="workingnumber" maxlength="1" disabled/></td>
<?php
for($i = 1; $i < 8; ++$i)
{
  echo "      <td><input type=\"text\" class=\"workingnumber\" maxlength=\"1\"/></td>\n";
}
?>
    </tr>
  </table>
</div>

<div id="choicediv">
  <p id="choicedivp">Please choose the correct response:</p>
  <table id="choicetable">
    <tr>
      <td class="choice"><input type="button" class="choice" value="1" onclick="make_choice(this);"/></td>
      <td class="choice"><input type="button" class="choice" value="4" onclick="make_choice(this);"/></td>
      <td class="choice"><input type="button" class="choice" value="9" onclick="make_choice(this);"/></td>
    </tr>
  </table>
</div>

<?php
echo "<form action=\"submit_test.php?uuid=" . $uuid . "\" method=\"post\">";
?>
  <input type="hidden" id="choices" name="choices"/>
  <input type="hidden" id="score" name="score" value="0"/>
</form>

<?php
// If these are the practice tests, make it possible to get a guided explanation of each test.
if($startTest == 0)
{
  echo "
<div id=\"explanationcontrol\">
  <input id=\"toggleexplanation\" type=\"button\" value=\"Show Explanation\" onclick=\"toggle_explanation();\"/>
</div>

<div id=\"enumbers\" class=\"numbers\">
  <table class=\"numberstable\">
    <tr>";

  for($i = 0; $i < 6; ++$i)
  {
    echo "
      <td id=\"e" . $i . "\" class=\"einter\"></td>";
  }
  echo "
      <td id=\"e6\" class=\"eresult\"></td>";

  echo "
    </tr>
  </table>
</div>
";
}
?>

</body>

</html>
