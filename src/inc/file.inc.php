<?php
require_once("mysql_class.inc.php");


class File
{
    var $file_id;
    var $path_id;
    var $loginname;
    var $filename;
    var $description;
    var $insert_at;
    var $modified_at;


    function selectByID($id)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT file_id, path_id, loginname, filename, description, insert_at, modified_at
                  FROM sage_files
                  WHERE file_id = $id";

        $result = $dbq->db_select($query);
        if (count($result) == 0) return false;

        $this->initializeFromRow($result[0]);

        return true;
    }

    function selectByPathIDAndName($path_id, $name)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT file_id, path_id, loginname, filename, description, insert_at, modified_at
                  FROM sage_files
                  WHERE path_id = $path_id
                  AND filename = '$name'";

        $result = $dbq->db_select($query);
        if (count($result) == 0) return false;

        $this->initializeFromRow($result[0]);

        return true;
    }

    function insert()
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "INSERT INTO sage_files(path_id, loginname, filename, description, insert_at, modified_at)
                  VALUES($this->path_id, '$this->loginname', '$this->filename',
                         '$this->description', $this->insert_at, $this->modified_at)";

        if (!$dbq->db_insert($query)) return false;
        return true;
    }

    function initializeFromRow($row)
    {
        $this->file_id          = $row->file_id;
        $this->path_id          = $row->path_id;
        $this->loginname        = $row->loginname;
        $this->filename         = $row->filename;
        $this->description      = $row->description;
        $this->insert_at        = $row->insert_at;
        $this->modified_at      = $row->modified_at;
    }

}

class FileList {
    var $list = 0;

    function FileList()
    {
        $this->list = array();
    }

    function selectByPathId($id)
    {
        $dbq = new DB;
        $dbq->db_connect();

        $query = "SELECT file_id, path_id, loginname, filename, description, insert_at, modified_at
                  FROM sage_files
                  WHERE path_id = $id";

        $files = $dbq->db_select($query);

        for ($i = 0; $i < count($files); $i++) {
            $file = new File;
            $file->initializeFromRow($files[$i]);
            $this->list[] = $file;
        }

        return true;
    }
}

?>
