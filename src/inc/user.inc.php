<?php
require_once("mysql_class.inc.php");


class User
{
    var $user_id        = "";
    var $loginname      = "";
    var $password       = "";
    var $firstname      = "";
    var $surname        = "";
    var $description    = "";
    var $homepage       = "";
    var $e_mail         = "";
    var $user_id_parent = "";
    var $acls           = 0;

    function User()
    {
    }

    function selectByID($id)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT user_id, loginname, password, firstname, surname, description, homepage, e_mail, user_id_parent
                  FROM sage_user
                  WHERE user_id = $id";

        $result = $dbq->db_select($query);
        if (count($result) == 0) return false;

        initializeFromRow($result[0]);

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
        $this->user_id          = $row->user_id;
        $this->loginname        = $row->loginname;
        $this->password         = $row->password;
        $this->firstname        = $row->firstname;
        $this->surname          = $row->surname;
        $this->description      = $row->description;
        $this->homepage         = $row->homepage;
        $this->e_mail           = $row->e_mail;
        $this->user_id_parent   = $row->user_id_parent;
    }

    function getACLByPath($path)
    {
        $done       = false;
        $acllist    = new aclcoll;
        $curacls    = array();
        $retacl     = 0;

        $currentUserId = $this->user_id;

        while (!$done) {

            $currentUser = new User;
            if (!$currentUser->selectById($currentUserId)) {
                $done = true;
            } else {
                $curacls = $acllist->selectByUserIdAndPath($currentUser->user_id, $path);

                if (count($curacls) == 0) {
                    $currentUserId = $currentUser->user_id_parent;
                } else {
                    $done = true;
                    $retacl = $curacls[0];
                }
            }
        }

        return $retacl;
    }

    function getACLs()
    {
        $acllist = new aclcoll;
        $acllist->selectByUserId($this->user_id);

        return $acllist;
    }

}
?>
