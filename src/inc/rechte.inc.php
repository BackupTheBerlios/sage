<?php
    function rechte()
    {
        require_once("inc/rechte_array.inc.php");
        require_once("inc/mysql_class.inc.php");

        //Erzeuge ein neues Element von der DB ...
        $db=new DB;

        //Connecte ...
        $db->db_connect();

        //Select Befehl um alle Rechte die es gibt herauszubekommen...
        $querry="SELECT * FROM sage_acl";

        $rechte=$db->db_rechte($querry);

        $anzahl=count($rechte);
        for($b=0;$b<$anzahl;$b++){
            $rechte[$b]=$rechteListe[$b];
        }
        return $rechte;
    }
?>