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
        
        $acls = $dbq->db_select($query);
        
        for ($i = 0; $i < count($acls); $i++) {
            $acl = new ACL;
            $acl->initializeFromRow($acls[i]);
            $list[] = $acl;
        }
                      
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
        
        $acls = $dbq->db_select($query);
        for ($i = 0; $i < count($acls); $i++) {
            $acl = new ACL;
            $acl->initializeFromRow($acls[i]);
            $list[] = $acl;
        }
                      
        return true;
    }
}

?>