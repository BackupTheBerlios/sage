<?php
require_once("inc/functions.inc.php");
if (!loggedIn()) setupSession();

require_once("inc/config.inc.php");

$PageName = "Index";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");

echo <<<EOF
<p />Hallo, dies ist Sage, Version $sage_version.
<p />Sage ist eine internetgest&uuml;tzte Groupware, die - im Rahmen eines Schulprojekts der <a href="http://www.gso-koeln.de" target="_blank">Georg-Simon-Ohm-Schule K&ouml;ln</a> - von f&uuml;nf Sch&uuml;lern der Klasse KF0F entwickelt wird.
Das Projektteam besteht aus:
<ul>
    <li>Daniel Dietze</li>
    <li>Patrick Haas</li>
    <li>Oliver Hendrich</li>
    <li>Andreas Moser</li>
    <li>Kai Ruschenburg</li>
</ul>
<p />Sollten sich Bugs eingeschlichen haben, bitten wir um einen Eintrag in unsere <a href="http://developer.berlios.de/bugs/?func=addbug&group_id=316">Bugdatenbank</a>.
Bei schweren Fehlern besteht auch die M&ouml;glichkeit, sich &uuml;ber eine Nachricht an <a href="mailto:sage-dev@lists.berlios.de">sage-dev@lists.berlios.de</a>
direkt an das Entwicklungsteam zu wenden. Nat&uuml;rlich gilt das auch f&uuml;r Kritik, Anregungen oder Lob. :-)
<p />Die aktuellste Version von Sage ist jederzeit per anonymem CVS oder als .tar.gz unter <a href="http://developer.berlios.de/projects/sage/">http://developer.berlios.de/projects/sage/</a>
verf&uuml;gbar. Dort besteht auch die M&ouml;glichkeit, sich in die sage-users - Mailingliste einzutragen, &uuml;ber die neue Releases, Bugfixes usw.
kommuniziert werden oder Probleme gekl&auml;rt werden k&ouml;nnen.
<p />Viel Spass bei der Arbeit mit Sage w&uuml;nscht
<p />das Sage-Team
EOF;
require("inc/footer.inc.php");
?>
