<?php
require_once("mysql_class.inc.php");
require_once("path.inc.php");
require_once("acl.inc.php");

function canEdit($pathname)
{
    $path = new Path;
    if (!$path->selectByName($pathname)) return false;

    if ($_SESSION["user"]->is_su == "1") return true;
    if ($path->loginname == $_SESSION["user"]->loginname) return true;

    return false;
}

function listACLsByPath($pathname)
{
    $me = $_SERVER["PHP_SELF"];

    if (!canEdit($pathname)) {
        echo("Ihnen fehlt leider die Berechtigung, das Verzeichnis $pathname zu bearbeiten");
        return false;
    }

    // Verzeichnisobjekt holen
    $path = new Path;
    if (!$path->selectByName($pathname)) {
        fehlerausgabe("Das Verzeichnis $pathname konnte nicht aus der DB gew&auml;hlt werden");
        return false;
    }

    // ACLs fuer das Verzeichnis holen
    $acllist = new ACLList;
    if (!$acllist->selectByPath($pathname)) {
        fehlerausgabe("Die zum Verzeichnis $pathname geh&ouml;rigen ACLs konnten nicht aus der DB gew&auml;hlt werden");
        return false;
    }

    echo("ACLs f&uuml;r Pfad $pathname:");
    echo <<<EOF
<form name="acleditor" method="post" action="$me">
<select name="cmd">
    <option value="edit">Eine ACL bearbeiten</option>
    <option value="del">L&ouml;schen</option>
</select>
<input type="hidden" name="pathname" value="$pathname" />
<input type="submit" value="Los" />
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
    <tr>
        <td>User</td>
        <td>L&ouml;schen</td>
        <td>Schreiben</td>
        <td>Lesen</td>
        <td>Umbenennen</td>
    </tr>
EOF;

    $user = new User;
    for ($i = 0; $i < count($acllist->list); $i++) {
        $acl = $acllist->list[$i];
        $user->selectByID($acl->user_id);

        echo <<<EOF
<tr>
    <td><input type="checkbox" name="aclid[]" value="$acl->acl_id" />$user->loginname</td>
    <td>$acl->delete_path</td>
    <td>$acl->write_path</td>
    <td>$acl->read_path</td>
    <td>$acl->rename_path</td>
</tr>
EOF;
    }

    echo <<<EOF
</table>
</form>
EOF;


    return true;
}

function editACL($aclid, $delete, $write, $read, $rename)
{
    $dbq = new DB;
    $dbq->db_connect();

    $query = "UPDATE sage_acl
              SET delete_path = '$delete', write_path = '$write', read_path = '$read', rename_path = '$rename'
              WHERE acl_id = $aclid";

    // db_insert gibt ein boolean zurück
    $result = $dbq->db_insert($query);
    if (!$result) {
        fehlerausgabe("Konnte die ACL nicht updaten.");
        die();
    }
}

function deleteACL($aclid)
{
    $dbq = new DB;
    $dbq->db_connect();

    $query = "DELETE FROM sage_acl
              WHERE acl_id = $aclid";

    // db_insert gibt ein boolean zurück
    $result = $dbq->db_insert($query);
    if (!$result) {
        fehlerausgabe("Konnte die ACL nicht l&ouml;schen.");
        die();
    }
}

?>
