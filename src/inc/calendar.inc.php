<?php

class Calendar {
   var $calendar_id;
   var $user_id;
   var $initiator;

   var $firstDay;
   var $dayOfMonth;


    function selectByID($id,$datum)
    {
        //echo $id;
        $dbq = new DB;
        $dbq->db_connect();
        $query = "select initiator,begin,date,place,duration,sage_calendar.description
                  from sage_calendar,
                  sage_user,
                  sage_user_calendar_map
                  where sage_user_calendar_map.user_id = sage_user.user_id
                  and sage_calendar.calendar_id = sage_user_calendar_map.calendar_id
                  and sage_user.user_id = $id
                  and sage_calendar.date = '$datum'";

        $result = $dbq->db_select($query);

        return $result;

    }

    function getInitiator($init) {
        $dbq = new DB;
        $query = "select loginname
                  from sage_user
                  where user_id = $init";
        $result = $dbq->db_select($query);
        if (count($result) != 1) return false;
        $initiator[] = $result[0]->loginname;
        return true;
    }

    function initializeFromRow($row)
    {
        $this->initiator = $row->loginname;
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
      case 2: return 28;// Achtung!!! Noch keine Schaltjahrberücksichtigung;
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
   function display($m,$y) {
      $monate = ARRAY("","Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");
      $heute=mktime(0,0,0);
      $nextYear=$y+1;
      $prevYear=$y-1;
      $firstDay     = $this->getDayOfWeek($y,$m,"1");
      $nextMonth    = $this->getNextMonth($y,$m);
      $prevMonth    = $this->getPrevMonth($y,$m);
      $lastDayMonth = $this->getMaxDays($y,$m);

      echo "<table border=1>\n";
      echo "<tr><td colspan=7 style=\"text-align:center\">";
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
      echo "</td><td rowspan=9 style=\"text-align:center\">";
      if ($y<=(date("Y")+9)) echo "<a href=\"$PHP_SELF?y=$nextYear&m=$m\">&uarr;</a>";
      echo "<br>$y<br>";
      if ($y>=(date("Y")-9)) echo "<a href=\"$PHP_SELF?y=$prevYear&m=$m\">&darr;</a></td></tr>\n";
      echo "<tr><td>Sonntag</td><td>Montag</td><td>Dienstag</td><td>Mittwoch</td><td>Donnerstag</td><td>Freitag</td><td>Samstag</td></tr>\n";
      echo "<tr>";
      echo str_repeat("<td>&nbsp;</td>",$firstDay); // gibt ... mal <td> aus

      for ($i=1;$i<=$lastDayMonth;$i++) {
         $datum = "$y-$m-$i";
         $meet = $this->selectByID(1,$datum);
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

}
?>
