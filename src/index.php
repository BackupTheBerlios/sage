<?php
require_once("inc/functions.inc.php");
if (!loggedIn()) setupSession();

require_once("inc/config.inc.php");

$PageName = "Index";
require("inc/header.inc.php");

echo "<p>Dies ist Sage, Version $sage_version.</p>";
?>


<?php
require("inc/footer.inc.php");
?>
