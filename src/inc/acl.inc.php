<?php
require_once("mysql_class.inc.php");

class ACL {
    var $acl_id         = 0;
    var $user_id        = 0;
    var $path_id        = 0;
    var $delete_path    = 0;
    var $write_path     = 0;
    var $read_path      = 0;
    var $rename_path    = 0;
    var $delete_file    = 0;
    var $write_file     = 0;
    var $read_file      = 0;
    var $rename_file    = 0;

    function selectByID($id)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT acl_id, user_id, path_id, delete_path, write_path, read_path,
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
        $this->path_id      = $row->path_id;
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


class ACLList {
    var $list = 0;

    function ACLList()
    {
        $this->list = array();
    }

    function selectByUserID($id)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT acl_id, user_id, path_id, delete_path, write_path, read_path,
                  rename_path, delete_file, write_file, read_file, rename_file
                  FROM sage_acl
                  WHERE user_id = $id";

        $acls = $dbq->db_select($query);

        for ($i = 0; $i < count($acls); $i++) {
            $acl = new ACL;
            $acl->initializeFromRow($acls[i]);
            $this->list[] = $acl;
        }

        return true;
    }

    function selectByUserIDAndPath($id, $path)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT acl_id, user_id, sage_acl.path_id, delete_path, write_path, read_path,
                  rename_path, delete_file, write_file, read_file, rename_file, sage_path.pathname
                  FROM sage_acl, sage_path
                  WHERE sage_acl.path_id = sage_path.path_id
                  AND user_id = $id
                  AND sage_path.pathname = '$path'";

        $acls = $dbq->db_select($query);
        for ($i = 0; $i < count($acls); $i++) {
            $acl = new ACL;
            $acl->initializeFromRow($acls[$i]);
            $this->list[] = $acl;
        }

        return true;
    }
}
?>
