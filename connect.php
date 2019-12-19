<?php
$agent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($agent, 'iPad') != false || strpos($agent, 'iPhone') != false)
{
  die("Please do not attempt the number reduction task on mobile devices: use a desktop or a laptop instead.");
}

$connection = mysql_connect("localhost", "username", "password") or die("FAILED: mysql_connect()");
$db = mysql_select_db("database", $connection) or die("FAILED: mysql_select_db()");
?>
