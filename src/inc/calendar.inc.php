<?php

class Calendar {

   var $calendar_id;
   var $user_id;
   var $initiator;
   var $firstDay;
   var $dayOfMonth;

   // Funktion zum holen der Meetings eines Users
   // entweder Meetings an einem bestimmten Datum, oder alle die in der
   // Zukunft liegen
   function selectByID($id,$datum)
   {
       // TODO wenn alles läuft echo rausnehmen
       //echo $id;
       $dbq = new DB;
       //$dbq->db_connect();
       $query = "select sage_calendar.calendar_id,initiator,begin,date,place,duration,sage_calendar.description
                 from sage_calendar,
                 sage_user,
                 sage_user_calendar_map
                 where sage_user_calendar_map.user_id = sage_user.user_id
                 and sage_calendar.calendar_id = sage_user_calendar_map.calendar_id
                 and sage_user.user_id = $id";
        // sollen alle an einem bestimmten datum, oder allle zukuenftigen geholt werden?
        if ($datum!="0-0-0") $query.= " and sage_calendar.date = '$datum'";
        else $query.= " and sage_calendar.date >= date";

        $result = $dbq->db_select($query);

        return $result;
   }


   // anhand der Calendar_id werden alle Teilnehmer eines Meetings ausgelesen
   function getPersons($cal_id)
   {
       $dbq = new DB;
       $query = "select loginname
                 from sage_user,
                      sage_calendar,
                      sage_user_calendar_map
                 where sage_calendar.calendar_id=sage_user_calendar_map.calendar_id
                 and sage_user.user_id=sage_user_calendar_map.user_id
                 and sage_calendar.calendar_id= $cal_id";
       $result = $dbq->db_select($query);

       // formatierung des rueckgabewerte.
       // nach 7 namen wird ein <br> eingefuegt
       // TODO nochmal drueber schauen
       for ($i=0;$i<sizeof($result);$i++) {
            $rueck = "$rueck".$result[$i]->loginname;
            if ($i<sizeof($result)-1) $rueck.= ", ";
            if ($i==7) $rueck.="<br>";
       }
        return $rueck;
    }

    // Gibt bei erfolg TRUE zurück und schreibt in die
    // Variable initiator den Loginnamen des Initiators
    function getInitiator($init) {
        $dbq = new DB;
        $query = "select loginname
                  from sage_user
                  where user_id = $init";
        $result = $dbq->db_select($query);
        if (count($result) != 1) return false;
        $this->initiator = $result[0]->loginname;
        return true;
    }


   function getDayOfWeek($year,$month,$day) {
      $stamp = getdate(mkTime(0,0,0,$month,$day,$year)); // macht ein Timestamp am 1. des jeweiligen Monats im jeweiligen Jahr
      $this->firstDay = $stamp['wday'];
      return $this->firstDay; // Rueckgabe ist der erste Tag des Monats
   }
   function getDayOfMonth($year,$month,$day) {
      $stamp = getdate(mkTime(0,0,0,$month,$day,$year)); // macht ein Timestamp am 1. des jeweiligen Monats im jeweiligen Jahr
      $this->dayOfMonth = $stamp['mday'];
      return $this->dayOfMonth; // Rueckgabe ist der jeweilige Tag des Monats
   }
   function getNextMonth($year,$month) {
      $nextMonth = getdate(mktime(0,0,0,$month+1,1,$year));
      $nextMonth = $nextMonth['mon'];
      return $nextMonth;
   }
   function getPrevMonth($year,$month) {
      $prevMonth = getdate(mktime(0,0,0,$month-1,1,$year));
      $prevMonth = $prevMonth['mon'];
      return $prevMonth;
   }

   function getMaxDays($year, $month) {
      switch($month) {
      case 1: return 31;
      case 2: return 28;// TODO Achtung!!! Noch keine Schaltjahrberücksichtigung;
      case 3: return 31;
      case 4: return 30;
      case 5: return 31;
      case 6: return 30;
      case 7: return 31;
      case 8: return 31;
      case 9: return 30;
      case 10: return 31;
      case 11: return 30;
      case 12: return 31;
      default: return -1;}
   }
   // Hauptfunktion zum anzeigen des Kalenders
   function display($m,$y,$id) {
      // fuellt ein Array, damit ein Mapping von Englischen auf Deutsche Namen erfolgt
      $monate = ARRAY("","Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");
      $heute=mktime(0,0,0);
      $nextYear=$y+1;
      $prevYear=$y-1;
      $firstDay     = $this->getDayOfWeek($y,$m,"1");
      $nextMonth    = $this->getNextMonth($y,$m);
      $prevMonth    = $this->getPrevMonth($y,$m);
      $lastDayMonth = $this->getMaxDays($y,$m);

      echo "<table border=1>\n";
      echo "<tr><td>&nbsp;</td></td><td colspan=5 style=\"text-align:center\">";
      if ($y>=(date("Y")-9) || $m!=1) {
         echo "<a href=\"$PHP_SELF?m=$prevMonth";
         if ($y!=date("Y") && $m!=1) echo "&y=$y";
         if ($m==1) echo "&y=$prevYear";
         echo "\">&laquo;</a>";
      }
      echo " $monate[$m] ";
      if ($y<=(date("Y")+9) || $m!=12) {
         echo "<a href=\"$PHP_SELF?m=$nextMonth";
         if ($y!=date("Y") && $m!=12) echo "&y=$y";
         if ($m==12) echo "&y=$nextYear";
         echo "\">&raquo;</a>";
      }
      echo "</td><td><a href=\"$PHP_SELF?action=getAll\">&Uuml;bersicht</a></td><td rowspan=9 style=\"text-align:center\">";
      if ($y<=(date("Y")+9)) echo "<a href=\"$PHP_SELF?y=$nextYear&m=$m\">&uarr;</a>";
      echo "<br>$y<br>";
      if ($y>=(date("Y")-9)) echo "<a href=\"$PHP_SELF?y=$prevYear&m=$m\">&darr;</a></td></tr>\n";
      echo "<tr><td>Sonntag</td><td>Montag</td><td>Dienstag</td><td>Mittwoch</td><td>Donnerstag</td><td>Freitag</td><td>Samstag</td></tr>\n";
      echo "<tr>";
      echo str_repeat("<td>&nbsp;</td>",$firstDay); // gibt ... mal <td> aus

      for ($i=1;$i<=$lastDayMonth;$i++) {
         $datum = "$y-$m-$i";
         $meet = $this->selectByID($id,$datum);
         $meet = explode("-",$meet[0]->date);
         $termin = mktime(0,0,0,$meet[1],$meet[2],$meet[0]);

         $dayOfWeek = $this->getDayOfWeek($y,$m,$i);
         echo "<td style=\"width:90px;height:50px;vertical-align:top;";
         if (mktime(0,0,0,$m,$i,$y)==$heute) echo "background-color:#DDCCCC;";
         if ($termin==mktime(0,0,0,$m,$i,$y)) echo "background-color:#CCCCCC;";
         echo "\"><a style=\"width:90px;height:50px;\" href=\"$PHP_SELF?action=viewDay&m=$m&y=$y&d=$i\" >$i</a></td>";
         if ($dayOfWeek == 6)  echo "</tr>\n<tr>";
      }
      $lastDayOfWeek = $this->getDayOfWeek($y,$m,$lastDayMonth);
      $span = 6-$lastDayOfWeek;

      echo str_repeat("<td>&nbsp;</td>",6-$lastDayOfWeek); // gibt ... mal <td> aus
      echo "</tr>\n";
      echo "<tr><td colspan=7 style=\"text-align:center\"><a href=\"$PHP_SELF?\">heute</a></td></tr>";
      echo "</table>\n\n";
   }


function addMeeting($d,$m,$y,$begin="",$duration="",$place="",$description="",$persons="") {
   global $PHP_SELF,$id;
   if ($duration == "") $duration = 60;
   if ($persons=="") {
       $query = "select loginname from sage_user where user_id = $id";
       $dbq = new DB;
       $result = $dbq->db_select($query);
       $persons = $result[0]->loginname.",";
   }
   echo "<table border=1>";
   echo "<form name=\"addMeet\" mehtod=\"post\" action=\"$PHP_SELF?\">";
   echo "<tr><td>Datum :</td><td>";
   // ueber ein hidden feld wird die auszufuehrende aktion mitgeteilt
   echo "<input name=\"date\" type=text readonly value=\"$d.$m.$y\" ></input><input type=\"hidden\" name=\"action\" value=\"insertDB\"></input></td></tr>";
   echo "<tr><td>Beginn :</td><td>";
   echo "<input type=text name=\"begin\" value=\"$begin\"></input></td></tr>";
   echo "<tr><td>Dauer :</td><td>";
   echo "<input type=text name=\"duration\" value=\"$duration\"></input>min</td></tr>";
   echo "<tr><td>Ort :</td><td>";
   echo "<input type=text name=\"place\" value=\"$place\"></input></tr>";
   echo "<tr><td>Beschreibung :</td><td>";
   echo "<textarea name=\"description\" cols=45 rows=5>$description</textarea></tr>";
   echo "<tr><td>Teilnehmer :</td><td>";
   echo "<textarea name=\"persons\" cols=45 rows=5>$persons</textarea></tr>";
   echo "<tr><td><input type=\"submit\" value=\"Eintragen\"><input type=\"reset\" value=\"Abbrechen\"></td></tr>";
   echo "</form>";
   echo "</table>";
   echo "<a href=\"$HTTP_REFERER?action=viewDay&d=$d&m=$m&y=$y\">zur&uuml;ck</a>";
}

// Funktion zum pruefen ob die eingegeben teilnehmer dem system bekannt sind
function inviteUsers($loginname)
{

    $dbq = new DB;
    $query = "select user_id
              from sage.sage_user
              where upper(sage.sage_user.loginname) = '$loginname'";

    $result = $dbq->db_select($query);

    if (count($result) != 1) return false;
    return true;
}

function checkInput($d,$m,$y,$begin,$duration,$place,$description,$persons,$id)
{
    $check = 0;
    // checken der parameter
    if ($d!="" && $m!="" && $y!="") {
        if(checkdate($m,$d,$m)) $check++;
    }
    if ($begin!="" && substr_count($begin,":")==1) {
        $begin = explode(":",$begin);
        // gueltige uhrzeit?
        // TODO vielleicht durch ne schoenere loesung zu ersetzen
        if ($begin[0]<=24 && $begin[0]>=0 && $begin[1]>=0 && $begin[1]<60) $check++;
    }
    //TODO Wenn dauer über den Tag geht, keine beachtung bei anzeige der termine im Kalender
    if ($duration!="" && $duration<=2400) $check++;
    if ($description!="") $check++;
    if ($place!="") $check++;
    if ($persons!="") {
        // TODO muß noch was hin, was schaut ob am Ende oder am Anfang ein , steht und dies ersetzt
        $person_arr = explode(",",$persons);
        if ($person_arr[0]=="") unset($person_arr[0]);
        $persons = "";
        // schleife ersetzt die leerzeichen zwischen den namen
        for ($i=0;$i<=sizeof($person_arr);$i++){
            if ($person_arr[$i]!="") {
                $persons.= trim($person_arr[$i]);
                $log = trim($person_arr[$i]);
                if (!$this->inviteUsers($log)) {
                    // TODO Fehlerausgabe sollte schöner formatiert sein
                    echo "<br>Fehlerhafter Loginname $log";
                    $check--;
                }

                if ($i<sizeof($person_arr)-1) $persons.= ",";
             }
        }
        $check++;
    }
    if ($check==6) return true;
    else $this->addMeeting($d,$m,$y,"$begin[0]:$begin[1]",$duration,$place,$description,$persons,$id);
}

function insertDB($d,$m,$y,$begin,$duration,$place,$description,$persons,$id)
{

    if ($this->checkInput($d,$m,$y,$begin,$duration,$place,$description,$persons,$id)){
        $date = "$y-$m-$d";
        $dbq = new DB;
        // TODO führt insert aus,
        // mysql_class.inc muss nur so geändert werden das sie auch inserts unterstützt
        // insert fuer alle teilnehmer in sage_calendar

        $query = "INSERT INTO sage_calendar (initiator, date, begin, duration, description, place)
                  VALUES  ($id,'$date','$begin','$duration','$description','$place')";
        $result = $dbq->db_select($query);
        $new_id = mysql_insert_id();

        $person_arr = explode(",",$persons);
        for ($i=0;$i<=sizeof($person_arr);$i++){
            if ($person_arr[$i]!="") {
                $query = "SELECT user_id from sage_user where loginname = '$person_arr[$i]'";
                $result = $dbq->db_select($query);
                $idx = $result[0]->user_id;
                $query = "INSERT INTO sage_user_calendar_map (user_id,calendar_id)
                                  values ('$idx','$new_id')";
                $result = $dbq->db_select($query);
            }
        }
        $query = "INSERT INTO sage_user_calendar_map (user_id,calendar_id)
                  values ('$initiator','$new_id')";
        $result = $dbq->db_select($query);
        $this->display($m,$y,$id);
    }

}

function getMeetings($d,$m,$y,$id) {
   $datum = "$y-$m-$d";
   $meet = $this->selectByID($id,$datum);
   if ($meet=="" && $datum!="0-0-0") echo "keine Termine am $d.$m.$y<br>";
   elseif ($datum=="0-0-0") echo "Termin&uuml;bersicht<br>";
   else echo "Termine am $d.$m.$y<br>";
   for ($i=0;$i<sizeof($meet);$i++) {

    $date = explode("-",$meet[$i]->date);
    $begin = explode(":",$meet[$i]->begin);
    $begin = "$begin[0]:$begin[1]";
    $calendar_id =$meet[$i]->calendar_id;

    //$date = $date[year];
    $end   = $meet[$i]->duration;
    $place = $meet[$i]->place;
    $description = $meet[$i]->description;
    $persons=$this->getPersons($calendar_id);

    $anz=$i+1;

    $this->getInitiator($meet[$i]->initiator);

    // TODO wenn USER = INITIATOR ist, soll bearbeiten möglich sein
    if ($meet[$i]->initiator==$id) $this->editMeeting($meet[$i]->calendar_id);
    else {
        echo "\n<table border=1>\n";
        echo "<tr><td colspan=2>$anz. Termin</td></tr>";
        echo "<tr><td>Datum</td><td>$date[2].$date[1].$date[0]</td></tr>\n";
        echo "<tr><td>Beginn</td><td>$begin</td></tr>\n";
        echo "<tr><td>Initiator</td><td>$this->initiator</td></tr>\n";
        echo "<tr><td>Dauer</td><td>$end min</td></tr>\n";
        echo "<tr><td>Ort</td><td>$place</td></tr>\n";
        echo "<tr><td>Thema</td><td>$description&nbsp;</td></tr>\n";
        echo "<tr><td>Teilnehmer</td><td>$persons&nbsp;</td></tr>\n";
        echo "</table>\n\n";
    }
   }
}

    // liefert zu einem USER alle vorhandenen Meetings
    // TODO liefert auch vergangene Meetings
    function getAllMeetings($id) {
      $this->getMeetings(0,0,0,$id);
    }

    // liefert alle Termine an einem bestimmten Tag
    function viewDay($d,$m,$y,$id) {
       $this->getMeetings($d,$m,$y,$id);
       $me = $_SERVER["PHP_SELF"];

      echo "<a href=\"$me?action=addNew&d=$d&m=$m&y=$y\">neuer Termin</a><br>";
      echo "<a href=\"$HTTP_REFERER?d=$d&m=$m&y=$y\">zur&uuml;ck</a>";

   }
function editMeeting($c_id)
{
   $query = "select *
             from sage_calendar
             where calendar_id = $c_id";
   $dbq = new DB;
   $result = $dbq->db_select($query);

   $date        = explode("-",$result[0]->date);
   $date        = "$date[2].$date[1].$date[0]";
   $begin       = explode(":",$result[0]->begin);
   $begin       = "$begin[0]:$begin[1]";
   $duration    = $result[0]->duration;
   $place       = $result[0]->place;
   $description = $result[0]->description;
   $persons     = $this->getPersons($c_id);

   echo "<table border=1>";
   echo "<form name=\"addMeet\" mehtod=\"post\" action=\"$PHP_SELF?\">";
   echo "<tr><td>Datum :</td><td>";
   echo "<input name=\"date\" type=text readonly value=\"$date\" ></input><input type=\"hidden\" name=\"action\" value=\"insertDB\"></input></td></tr>";
   echo "<tr><td>Beginn :</td><td>";
   echo "<input type=text name=\"begin\" value=\"$begin\"></input></td></tr>";
   echo "<tr><td>Dauer :</td><td>";
   echo "<input type=text name=\"duration\" value=\"$duration\"></input>min</td></tr>";
   echo "<tr><td>Ort :</td><td>";
   echo "<input type=text name=\"place\" value=\"$place\"></input></tr>";
   echo "<tr><td>Beschreibung :</td><td>";
   echo "<textarea name=\"description\" cols=45 rows=5>$description</textarea></tr>";
   echo "<tr><td>Teilnehmer :</td><td>";
   echo "<textarea name=\"persons\" cols=45 rows=5>$persons</textarea></tr>";
   echo "<tr><td><input type=\"submit\" value=\"&Auml;ndern\"><input type=\"reset\" value=\"Abbrechen\"></td></tr>";
   echo "</form>";
   echo "</table>";
   echo "<a href=\"$HTTP_REFERER?action=viewDay&d=$d&m=$m&y=$y\">zur&uuml;ck</a><br>";

}


}
?>
