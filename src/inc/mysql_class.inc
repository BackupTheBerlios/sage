<?php

class DB
{
   var $host = "localhost";
   var $db_name = "sage";
   var $db_user = "root";
   var $db_passwd = "";
   
   var $conn_id;
        
   //stellt Verbindung zur DB her
   function db_connect()
   {
      $this->conn_id = @mysql_connect($this->host,$this->db_user,$this->db_passwd) or die ("Could not connect to ".$this->host."!");
      $connect_to = mysql_select_db($this->db_name,$this->conn_id);
      return $this->conn_id;
   }

   //schliesst die Verbindung zur DB   
   function db_close()
   {
      $close = mysql_close($this->conn_id);
      return true;
   }
   
   // fuehr die Abfragen aus
   // rueckgabewert ist ein Array von Objekten
   function db_select($select){
      if(!$this->conn_id) 
		$this->conn_id = $this->db_connect();
      $result = mysql_query("$select", $this->conn_id); 
      while ($row = mysql_fetch_object($result)){ 
         $rueck[]=$row; 
      }
      return $rueck; 
   } 

   function db_select_rechte($select){        
       $query=mysql_query($select);
       if(mysql_errno())
           die("<br>" . mysql_errno().": ".mysql_error()."<br>");
       $row=mysql_fetch_assoc($query);
	   if(mysql_errno()){
           die("<br>" . mysql_errno().": ".mysql_error()."<br>");
       }
       $zaehler=0;
       foreach ($row as $name=>$column){
           if($column!=0)
			   $result[]=$zaehler;
           $zaehler++;
       }
	   return $result;
   }
}
?>
