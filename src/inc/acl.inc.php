<?php
require_once("mysql_class.inc.php");

class ACL {
    var $acl_id;
    var $user_id;
    var $path;
    var $delete_path;
    var $write_path;
    var $read_path;
    var $rename_path;
    var $delete_file;
    var $write_file;
    var $read_file;
    var $rename_file;

    function selectByID($id)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT acl_id, user_id, path, delete_path, write_path, read_path,
                  rename_path, delete_file, write_file, read_file, rename_file
                  FROM sage_acl
                  WHERE acl_id = $id";

        $result = $dbq->db_select($query);
        if (count($result) != 1) return false;

        initializeFromRow($result[0]);

        return true;
    }

    function initializeFromRow($row)
    {
        $this->acl_id       = $row->acl_id;
        $this->user_id      = $row->user_id;
        $this->path         = $row->path;
        $this->delete_path  = $row->delete_path;
        $this->write_path   = $row->write_path;
        $this->read_path    = $row->read_path;
        $this->rename_path  = $row->rename_path;
        $this->delete_file  = $row->delete_file;
        $this->write_file   = $row->write_file;
        $this->read_file    = $row->read_file;
        $this->rename_file  = $row->rename_file;
    }
}
?>
