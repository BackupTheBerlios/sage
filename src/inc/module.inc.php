<?php
require_once("mysql_class.inc.php");
require_once("path_impl.inc.php");


class ModuleList {
    var $list = 0;

    function ModuleList()
    {
        $this->list = array();
    }

    function selectAll()
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT path_id, loginname, pathname, description, insert_at, modified_at, path_id_parent
                  FROM sage_path
                  WHERE pathname NOT REGEXP '[/]'";

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
