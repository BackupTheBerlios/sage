<?php
require_once("inc/functions.inc.php");

$PageName = "Kalender";
require_once("inc/header.inc.php");
require_once("inc/leftnav.inc.php");
?>

<?php
$id=1;
require_once("inc/calendar.inc.php");

$m = "";
$y = "";
$d = "";
$action = "";

if (isset($_REQUEST["m"]) && @$_REQUEST["m"] != "") $m = $_REQUEST["m"];
if (isset($_REQUEST["y"]) && @$_REQUEST["y"] != "") $y = $_REQUEST["y"];
if (isset($_REQUEST["d"]) && @$_REQUEST["d"] != "") $d = $_REQUEST["d"];
if (isset($_REQUEST["action"]) && @$_REQUEST["action"] != "") $action = $_REQUEST["action"];

// wenn noch nichts uebergeben wurde
if ("" == $m) $m = date("n");
if ("" == $y) $y = date("Y");
if ("" == $d) $d = date("d");
$cal = new Calendar;

if ($m>12) echo "Fehler!!! Kein g&uuml;ltiger Monat";
elseif($y>=(date("Y")+9)) echo "Zu hohes Datum";
elseif($y<=(date("Y")-9)) echo "Zu geringes Datum";
elseif($d>31 || $d<1) echo "kein g&uuml;ltiger Tag";

else {
    if ($action == "addNew") {
       $cal->addMeeting($d,$m,$y);
       echo "$d - $m - $y";
    } else if ($action == "viewDay") {
       $cal->viewDay($d,$m,$y,$id);
    } else if ($action == "getAll") {
       $cal->getAllMeetings($id);
    } else if ($action == "insertDB") {
        echo $date;
        $date = explode(".",$date);
        $cal->insertDB($date[0],$date[1],$date[2],$begin,$duration,$place,$description,$persons,$id);
    } else {
        $cal->display($m,$y,$id);
    }
}

?>
<?php
require("inc/footer.inc.php");
?>