<?php
require_once("inc/functions.inc");

$pagename = "Inhalt";
require("inc/header.inc");
?>

<?php
require_once("inc/calendar.inc.php");

// wenn noch nichts uebergeben wurde
if (empty($m)) $m = date("n");
if (empty($y)) $y = date("Y");


$cal = new Calendar;

if ($m>12) echo "Fehler!!! Kein G&uuml;tiger Monat";
else
    switch ($action) {
        case addNew : addMeeting();
                      break;
        case viewDay: viewDay($d,$m,$y);
                      break;
        default : $cal->display($m,$y);
    };

function getMeetings($d,$m,$y) {
   global $cal;
   $datum = "$y-$m-$d";
   $meet = $cal->selectByID(1,$datum);
   for ($i=0;$i<sizeof($meet);$i++) {

    $date = explode("-",$meet[$i]->date);
    $begin = explode(":",$meet[$i]->begin);
    $begin = "$begin[0]:$begin[1]";

    $date = $date[year];
    $end   = $meet[$i]->duration;
    $place = $meet[$i]->place;
    $description = $meet[$i]->description;
    $anz=$i+1;
    echo "\n<table border=1>\n";
    echo "<tr><td colspan=2>$anz. Termin</td></tr>";
    echo "<tr><td>Beginn</td><td>$begin</td></tr>\n";
    echo "<tr><td>Dauer</td><td>$end min</td></tr>\n";
    echo "<tr><td>Ort</td><td>$place</td></tr>\n";
    echo "<tr><td>Thema</td><td>$description&nbsp;</td></tr>\n";
    echo "</table>\n\n";
   }
}

function addMeeting() {
   echo "<table border=1>";

   echo "<form mehtod=\"POST\" action=\"$PHP_SELF\">";
   echo "<tr><td>Beschreibung :</td><td>";
   echo "<input type=text></input></tr>";
   echo "<tr><td>Beginn :</td><td>";
   echo "<input type=text></input></tr>";
   echo "<tr><td>Dauer :</td><td>";
   echo "<input type=text></input></tr>";
   echo "</form>";
   echo "<a href=\"$HTTP_REFERER?d=$d&m=$m&y=$y\">zur&uuml;ck</a>";
}

function viewDay($d,$m,$y) {
   echo "Termine am $d.$m.$y<br>";
   echo "<a href=\"$PHP_SELF?action=addNew&d=$d&m=$m&y=$y\">neuer Termin</a><br>";

   getMeetings($d,$m,$y);
   echo "<a href=\"$HTTP_REFERER?d=$d&m=$m&y=$y\">zur&uuml;ck</a>";

}

?>
<?php
require("inc/footer.inc");
?>