<?php
require_once("inc/functions.inc");
if (!loggedIn()) setupSession();

require_once("inc/config.inc");

$PageName = "Index";
require("inc/header.inc");

echo "<p>Dies ist Sage, Version $sage_version.</p>";
?>


<?php
require("inc/footer.inc");
?>
