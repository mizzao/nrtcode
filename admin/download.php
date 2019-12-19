<?php
$table = $_GET["table"];

if($table == null)
{
  die("Error: Navigating directly to this page is prohibited.");
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $table . '.csv');

$output = fopen('php://output', 'w');

include('../connect.php');

$result = mysql_query("SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.COLUMNS WHERE TABLE_SCHEMA='database' AND TABLE_NAME='" . $table . "'");
$i = 0;
while($row = mysql_fetch_array($result))
{
  $columns[$i++] = $row[0];
}
fputcsv($output, $columns);

$result = mysql_query("SELECT * FROM " . $table);
while($row = mysql_fetch_assoc($result))
{
  fputcsv($output, $row);
}
?>
