<?php
require("mysql_class.php");
$db_test = new DB;

$select = "SELECT * FROM sage_user aa, sage_acl bb where aa.user_id = bb.user_id;";

// open DB
$db_test->db_connect();

// select
$query = $db_test->db_select($select); 


for($i=0;$i<sizeof($query);$i++) {
   $ergebnis = $query[$i]; 
   echo $ergebnis->loginname." ".$ergebnis->surname." ".$ergebnis->read_path."<br>";
}

// close db
$db_test->db_close();
?>