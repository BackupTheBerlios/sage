<?php
require_once("db/mysql_class.php");


class User
{
    var $user_id = "";
    var $loginname = "";
    var $password = "";
    var $firstname = "";
    var $surname = "";
    var $description = "";
    var $homepage = "";
    var $e_mail = "";
    var $user_id_parent = "";
 
    function User()
    {
        
    }
 /*
    function User($row)
    {
        initializeFromRow($row);   
    }
   */ 
    function selectByID($id)
    {
        $dbq = new DB;
        $dbq->db_connect();
        
        $query = "SELECT user_id, loginname, password, firstname, surname, description, homepage, e_mail, user_id_parent
                  FROM sage_user
                  WHERE user_id = $id";
        
        $result = $dbq->db_select($query);
        if (count($result) != 1) return false;
     
        initializeFromRow($result);   
                
        return true;
    }
    
    function selectByName($name)
    {
        $dbq = new DB;
        $dbq->db_connect();
        
        // loginname ist unique, hoffe ich
        $query = "SELECT user_id, loginname, password, firstname, surname, description, homepage, e_mail, user_id_parent
                  FROM sage_user
                  WHERE loginname = '$name'";
        
        $result = $dbq->db_select($query);
        if (count($result) != 1) return false;
     
        $this->initializeFromRow($result[0]);   
                
        return true;
    }
    
    function initializeFromRow($row)
    {
        $this->user_id = $row->user_id;
        $this->loginname = $row->loginname;
        $this->password = $row->password;
        $this->firstname = $row->firstname;
        $this->surname = $row->surname;
        $this->description = $row->description;
        $this->homepage = $row->homepage;
        $this->email = $row->email;
        $this->user_id_parent = $row->user_id_parent;
    }
}
?>
