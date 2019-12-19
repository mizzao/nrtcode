<?php
include('common.php');
?>

<div id="title">
<?php
echo "Number Reduction Task (Subject ID: " . $subjectRow["SubjectID"] . ")";
?>
</div>

<div id="navigation">
<?php
echo "<form action=\"index.php?uuid=" . $uuid . "\" method=\"post\"/>";
?>
  <input type="submit" class="home" value="Home"/>
</form>
</div>
