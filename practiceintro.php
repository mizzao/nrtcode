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
?>

<div class="explanation">

<p>
Dear participant,
</p>

<p>
You are about to start with a cognitive task - please ensure that you will NOT be disturbed or distracted during the task as we rely heavily on your REACTION TIME for the study.
</p>

<p>
You will be asked to work through a sequence of 8 numbers to find a solution. The sequences consist only of the numbers 1, 4, and 9. There are two important rules to come to the final solution:
</p>

<ol>
  <li>The 'same rule' states that the result of two identical digits is just this digit (e.g. 1 and 1 results in 1).</li>
  <li>The 'different rule' states that the result of two non-identical digits is the remaining third digit (e.g. 1 and 4 results in 9).</li>
</ol>

<p>
First you will compare number one and two in the sequence; after that, comparisons are made between the preceding response and the next number (i.e. between the circled digits; the arrow points to the correct result). See the figure below. The seventh response indicates the final solution. You should try to do this as correctly and quickly as possible. It is important that you understand the rules of the task in order to get the best result you can. Therefore, if you find that you are confused, please refer to the worked example below.
</p>

<img id="practiceintroimg" src="practiceintro.png"/>

<p>
We will start with a test trial so you can practise applying the two rules. After you have practised, we will start the real trial.
</p>

</div>

<?php
echo "
<div class=\"rundiv\">
  <input type=\"button\" class=\"run\" value=\"Start\" onclick=\"run_tests(0, 15);\"/>
</div>";
?>

<div class="explanation">

<h1>Worked Example</h1>

<p>Imagine you are presented with the following sequence on screen:-</p>

<table class="numberstable">
<tr>
  <td class="number">9</td>
  <td class="number">1</td>
  <td class="number">4</td>
  <td class="number">1</td>
  <td class="number">9</td>
  <td class="number">4</td>
  <td class="number">9</td>
  <td class="number">1</td>
</tr>
</table>

<p>NB: THERE ARE ONLY THREE POSSIBLE NUMBERS IN THE SEQUENCE: 1, 4 and 9.</p>
<p>STEP 1: Take the first TWO numbers.</p>

<table class="numberstable">
<tr>
  <td class="number">9</td>
  <td class="number">1</td>
</tr>
</table>

<p>Are they the same or are they different?</p>
<p>Answer: Different.</p>
<p>Therefore the different rule applies and your response is the MISSING NUMBER of the three (1, 4, 9).</p>
<p><u>In this case: 4. THEREFORE YOUR RESPONSE IS 4.</u></p>
<p>This uses up the first two numbers:</p>

<table class="numberstable">
<tr>
  <td class="usednumber">9</td>
  <td class="usednumber">1</td>
  <td class="number">4</td>
  <td class="number">1</td>
  <td class="number">9</td>
  <td class="number">4</td>
  <td class="number">9</td>
  <td class="number">1</td>
</tr>
</table>

<p>STEP 2: Take YOUR RESPONSE and the third Number from the sequence.</p>

<table class="numberstable" cellpadding="10">
<tr>
  <td>RESPONSE:</td>
  <td class="number">4</td>
  <td>SEQUENCE:</td>
  <td class="number">4</td>
</tr>
</table>

<p>Are they the same or are they different?</p>
<p>Answer: The Same.</p>
<p>Therefore the same rule applies and your response is the SAME NUMBER.</p>
<p><u>In this case: 4. THEREFORE YOUR RESPONSE IS 4.</u></p>
<p>This uses up the first three numbers:</p>

<table class="numberstable">
<tr>
  <td class="usednumber">9</td>
  <td class="usednumber">1</td>
  <td class="usednumber">4</td>
  <td class="number">1</td>
  <td class="number">9</td>
  <td class="number">4</td>
  <td class="number">9</td>
  <td class="number">1</td>
</tr>
</table>

<p>STEP 3: TAKE THE FOURTH NUMBER IN THE SEQUENCE AND COMPARE IT TO YOUR RESPONSE FROM STEP 2.</p>

<table class="numberstable" cellpadding="10">
<tr>
  <td>RESPONSE:</td>
  <td class="number">4</td>
  <td>SEQUENCE:</td>
  <td class="number">1</td>
</tr>
</table>

<p>Are they the same or are they different?</p>
<p>Answer: Different.</p>
<p>Therefore the different rule applies and your response is the MISSING NUMBER of the three.</p>
<p><u>In this case: 9. THEREFORE YOUR RESPONSE IS 9.</u></p>
<p>This uses up the first four numbers:</p>

<table class="numberstable">
<tr>
  <td class="usednumber">9</td>
  <td class="usednumber">1</td>
  <td class="usednumber">4</td>
  <td class="usednumber">1</td>
  <td class="number">9</td>
  <td class="number">4</td>
  <td class="number">9</td>
  <td class="number">1</td>
</tr>
</table>

<p>So we continue in the same manner...</p>
<p>STEP 4: TAKE THE FIFTH NUMBER IN THE SEQUENCE AND COMPARE IT TO YOUR RESPONSE FROM STEP 3.</p>

<table class="numberstable" cellpadding="10">
<tr>
  <td>RESPONSE:</td>
  <td class="number">9</td>
  <td>SEQUENCE:</td>
  <td class="number">9</td>
</tr>
</table>

<p>Are they the same or are they different?</p>
<p>Answer: The Same.</p>
<p>Therefore the same rule applies and your response is the same number.</p>
<p><u>In this case: 9. THEREFORE YOUR RESPONSE IS 9.</u></p>
<p>This uses up the first five numbers:</p>

<table class="numberstable">
<tr>
  <td class="usednumber">9</td>
  <td class="usednumber">1</td>
  <td class="usednumber">4</td>
  <td class="usednumber">1</td>
  <td class="usednumber">9</td>
  <td class="number">4</td>
  <td class="number">9</td>
  <td class="number">1</td>
</tr>
</table>

<p>STEP 5: TAKE THE SIXTH NUMBER IN THE SEQUENCE AND COMPARE IT TO YOUR RESPONSE FROM STEP 4.</p>

<table class="numberstable" cellpadding="10">
<tr>
  <td>RESPONSE:</td>
  <td class="number">9</td>
  <td>SEQUENCE:</td>
  <td class="number">4</td>
</tr>
</table>

<p>Are they the same or are they different?</p>
<p>Answer: Different.</p>
<p>Therefore the different rule applies and your response is the MISSING NUMBER of the three in the sequence.</p>
<p><u>In this case: 1. THEREFORE YOUR RESPONSE IS 1.</u></p>
<p>This uses up the first six numbers:</p>

<table class="numberstable">
<tr>
  <td class="usednumber">9</td>
  <td class="usednumber">1</td>
  <td class="usednumber">4</td>
  <td class="usednumber">1</td>
  <td class="usednumber">9</td>
  <td class="usednumber">4</td>
  <td class="number">9</td>
  <td class="number">1</td>
</tr>
</table>

<p>STEP 6: TAKE THE SEVENTH NUMBER IN THE SEQUENCE AND COMPARE IT TO YOUR RESPONSE FROM STEP 5.</p>

<table class="numberstable" cellpadding="10">
<tr>
  <td>RESPONSE:</td>
  <td class="number">1</td>
  <td>SEQUENCE:</td>
  <td class="number">9</td>
</tr>
</table>

<p>Are they the same or are they different?</p>
<p>Answer: Different.</p>
<p>Therefore the different rule applies and your response is the MISSING NUMBER of the three in the sequence.</p>
<p><u>In this case: 4. THEREFORE YOUR RESPONSE IS 4.</u></p>
<p>This uses up the first seven numbers:</p>

<table class="numberstable">
<tr>
  <td class="usednumber">9</td>
  <td class="usednumber">1</td>
  <td class="usednumber">4</td>
  <td class="usednumber">1</td>
  <td class="usednumber">9</td>
  <td class="usednumber">4</td>
  <td class="usednumber">9</td>
  <td class="number">1</td>
</tr>
</table>

<p>STEP 7 (FINAL STEP): TAKE THE EIGHTH NUMBER IN THE SEQUENCE AND COMPARE IT TO YOUR RESPONSE FROM STEP 6.</p>

<table class="numberstable" cellpadding="10">
<tr>
  <td>RESPONSE:</td>
  <td class="number">4</td>
  <td>SEQUENCE:</td>
  <td class="number">1</td>
</tr>
</table>

<p>Are they the same or are they different?</p>
<p>Answer: Different.</p>
<p>Therefore the different rule applies and your response is the MISSING NUMBER of the three in the sequence.</p>
<p><u>In this case: 9. THEREFORE YOUR RESPONSE IS 9.</u></p>
<p>This uses up ALL eight numbers:</p>

<table class="numberstable">
<tr>
  <td class="usednumber">9</td>
  <td class="usednumber">1</td>
  <td class="usednumber">4</td>
  <td class="usednumber">1</td>
  <td class="usednumber">9</td>
  <td class="usednumber">4</td>
  <td class="usednumber">9</td>
  <td class="usednumber">1</td>
</tr>
</table>

<p>AND IS THEREFORE YOUR FINAL RESPONSE!</p>
<p>HENCE THE ANSWER TO THIS SEQUENCE IS</p>

<table class="numberstable" cellpadding="10">
<tr>
  <td class="number">9</td>
</tr>
</table>

</div>

<?php
echo "
<div class=\"rundiv\">
  <input type=\"button\" class=\"run\" value=\"Start\" onclick=\"run_tests(0, 15);\"/>
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
