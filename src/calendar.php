<?php
require_once("inc/functions.inc.php");

$PageName = "Kalender";
require_once("inc/header.inc.php");
require_once("inc/leftnav.inc.php");
?>

<?php
$id=1;
require_once("inc/calendar.inc.php");

// wenn noch nichts uebergeben wurde
if (empty($m)) $m = date("n");
if (empty($y)) $y = date("Y");
if (empty($d)) $d = date("d");
$cal = new Calendar;

if ($m>12) echo "Fehler!!! Kein g&uuml;ltiger Monat";
elseif($y>=(date("Y")+9)) echo "Zu hohes Datum";
elseif($y<=(date("Y")-9)) echo "Zu geringes Datum";
elseif($d>31 || $d<1) echo "kein g&uuml;ltiger Tag";

else
    switch ($action) {
        case addNew : $cal->addMeeting($d,$m,$y);
                      echo "$d - $m - $y";
                      break;
        case viewDay: $cal->viewDay($d,$m,$y,$id);
                      break;
        case getAll:  $cal->getAllMeetings($id);
                      break;
        case insertDB: echo $date;
                       $date = explode(".",$date);
                       $cal->insertDB($date[0],$date[1],$date[2],$begin,$duration,$place,$description,$persons,$id);
                       break;
        default : $cal->display($m,$y,$id);
    };

?>
<?php
require("inc/footer.inc.php");
?>