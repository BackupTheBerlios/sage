<?php
/*Variablen Deklaration*/

//Page-Name
$PageName="Hilfe";

/*Der Header wird mit eingebunden*/
require "inc/header.inc.php";
require "inc/leftnav.inc.php";
?>

<?php    
	echo "<div align=\"center\"><H1>SAGE-HILFE</H1></div><br/>";
	require_once ("inc/module.inc.php");
    require_once("inc/help.inc.php");
	
    $modul=new ModuleList;
    $modul->selectAll();
    $anz=count($modul->list);
	for($a=0;$a<$anz;$a++){
        help($modul->list[$i]->pathname);
    }
?>

<?php
/*Der Rumpf wird mit eingebunden*/
require "inc/footer.inc.php";
?>
