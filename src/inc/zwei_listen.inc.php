<?php
      include_once("rechte.inc.php");

      session_start();
      session_register(RechtesArray);
      session_register(LinkesArray);

      //CSS zur Formatierung der Breite der Listen
      echo("<style type='text/css'> select {width='150';}</style>");

//Beschreibt den Aufbau der rechten Liste, bekommt als Parameter die beiden Ereignisse die
//sich aus den beiden Buttons ergeben.
function rechts($LinksRechts, $RechtsLinks)
{
     global $RechtesArray;
     global $LinkesArray;
     global $AlleRechte;
     global $GewRechte;

         echo("<select name='GewRechte' size='10'>");

         if ($LinksRechts)
         {
              if ($AlleRechte != NULL)
              {
                //Prüft ob der Wert schon im rechten Array steht
                if(in_Array($AlleRechte, $RechtesArray) == FALSE)
                {
                  //Weisst dem rechten Array den Selektierten Wert zu
                  $RechtesArray[] = $AlleRechte;
                }
              }

              $Anzahl = count($RechtesArray);

              for ($i=0; $i < $Anzahl; $i++)
              {
               echo("<option>$RechtesArray[$i]</option>");
              }
         echo("</select>");
         }


       if ($RechtsLinks)
       {

          if ($GewRechte != NULL)
          {
           //Sucht nach dem gewählten Wert im rechten Array und löscht diesen aus dem Array
           $key = array_search($GewRechte, $RechtesArray);
           array_splice($RechtesArray, $key, 1);
          }

           $Anzahl = count($RechtesArray);

              for ($i=0; $i < $Anzahl; $i++)
              {
               echo("<option>$RechtesArray[$i]</option>");
              }

       echo("</select>");
       }

}

function links()
{
        global $LinkesArray;
	echo("<select name='AlleRechte' size='10'>");
   	$LinkesArray=rechte();

	$zaehler=count($LinkesArray);

	for($i=0;$i<$zaehler;$i++)
	{
          echo("<option>$LinkesArray[$i]</option>");
        }
	echo("</select>");

}

?>
