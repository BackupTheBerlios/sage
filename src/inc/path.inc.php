<?php
require_once("mysql_class.inc.php");


class Path
{
    var $path_id;
    var $loginname;
    var $pathname;
    var $description;
    var $insert_at;
    var $modified_at;
    var $path_id_parent;


    function selectByID($id)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT path_id, loginname, pathname, description, insert_at, modified_at, path_id_parent
                  FROM sage_path
                  WHERE path_id = $id";

        $result = $dbq->db_select($query);
        if (count($result) == 0) return false;

        $this->initializeFromRow($result[0]);

        return true;
    }

    function selectByName($name)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT path_id, loginname, pathname, description, insert_at, modified_at, path_id_parent
                  FROM sage_path
                  WHERE pathname = '$name'";

        $result = $dbq->db_select($query);
        if (count($result) == 0) return false;

        $this->initializeFromRow($result[0]);

        return true;
    }


    function initializeFromRow($row)
    {
        $this->path_id          = $row->path_id;
        $this->loginname        = $row->loginname;
        $this->pathname         = $row->pathname;
        $this->description      = $row->description;
        $this->insert_at        = $row->insert_at;
        $this->modified_at      = $row->modified_at;
        $this->path_id_parent   = $row->path_id_parent;
    }

}

class PathList {
    var $list = 0;

    function PathList()
    {
        $this->list = array();
    }

    function selectByParentId($id)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT path_id, loginname, pathname, description, insert_at, modified_at, path_id_parent
                  FROM sage_path
                  WHERE path_id_parent = $id";

        $paths = $dbq->db_select($query);

        for ($i = 0; $i < count($paths); $i++) {
            $path = new Path;
            $path->initializeFromRow($paths[$i]);
            $this->list[] = $path;
        }

        return true;
    }
}

?>
