<?php
require_once("inc/functions.inc.php");
if (!loggedIn()) setupSession();

require_once("inc/config.inc.php");

$PageName = "Index";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");

echo <<<EOF
<p>Hallo, dies ist Sage, Version $sage_version.</p>

EOF;

?>


<?php
require("inc/footer.inc.php");
?>
