<?php
require_once("inc/functions.inc.php");
if (!loggedIn()) setupSession();

require_once("inc/config.inc.php");

$PageName = "Index";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");

echo <<<EOF
<p>Hallo, dies ist Sage, Version $sage_version.</p>
Sage ist eine internetgest&uuml;tzte Groupware, die - im Rahmen eines Schulprojekts der <a href="http://www.gso-koeln.de" target="_blank">Georg-Simon-Ohm-Schule K&ouml;ln</a> - von f&uuml;nf Sch&uuml;lern der Klasse KF0F erstellt wurde.
Das Projektteam besteht aus:
<ul>
    <li>Daniel Dietze</li>
    <li>Patrick Haas</li>
    <li>Oliver Hendrich</li>
    <li>Andreas Moser</li>
    <li>Kai Ruschenburg</li>
</ul>
Sollten sich Bugs eingeschlichen haben, bitten wir um eine kurze Nachricht an <a href="mailto:sage-users@lists.berlios.de">sage-users@lists.berlios.de</a>.
Nat&uuml;rlich gilt das auch f&uuml;r Kritik, Anregungen oder Lob. :-)<br />
<p>Viel Spass bei der Arbeit mit Sage w&uuml;nscht</p>
das Sage-Team


EOF;

?>


<?php
require("inc/footer.inc.php");
?>
