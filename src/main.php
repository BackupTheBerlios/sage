<?php
     //Page-Name
     $PageName="SAGE-Home";

     /*Der Header wird mit eingebunden*/
     require_once "inc/header.inc.php";

     /*Die Navigationsleiste wird mit eingebunden*/
     require_once "inc/leftnav.inc.php";
     
     /*Ab hier der Hauptteil*/
     require_once "inc/fehlerausgabe.inc.php";
     fehlerausgabe("Fehler Bei der Eingabe");

     /*Der Rumpf wird mit eingebunden*/
     require_once "inc/footer.inc.php";
?>
