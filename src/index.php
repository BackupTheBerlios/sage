<?php
require_once("functions.php");
if (!loggedIn()) setupSession();

require_once("config.inc");

$PageName = "Index";
require("header.inc");

echo "<p>Dies ist Sage, Version $sage_version.</p>";
?>


<?php
require("footer.inc");
?>
