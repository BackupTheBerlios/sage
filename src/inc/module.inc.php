<?php
require_once("mysql_class.inc.php");
require_once("mysql_class.inc.php");


class ModuleList {
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
                  WHERE path_id_parent = $id
                  AND pathname NOT LIKE '/*'";

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
