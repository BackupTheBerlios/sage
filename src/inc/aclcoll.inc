<?php

class ACLList {
    var $list;
    
    function ACLList()
    {
        array($list);
    }
    
    function selectByUserID($id)
    {
        $dbq = new DB;
        $dbq->db_connect();
        
        $query = "SELECT acl_id, user_id, path, delete_path, write_path, read_path,
                  rename_path, delete_file, write_file, read_file, rename_file
                  FROM sage_acl
                  WHERE user_id = $id";
        
        $list = $dbq->db_select($query);
                      
        return true;
    }
    
    function selectByUserIDAndPath($id, $path)
    {
        $dbq = new DB;
        $dbq->db_connect();
        
        $query = "SELECT acl_id, user_id, path, delete_path, write_path, read_path,
                  rename_path, delete_file, write_file, read_file, rename_file
                  FROM sage_acl
                  WHERE user_id = $id
                  AND path = '$path'";
        
        $list = $dbq->db_select($query);
                      
        return true;
    }
}

?>