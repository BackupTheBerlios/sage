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
        echo("Ihnen fehlt leider die Berechtigung, dieses Verzeichnis zu bearbeiten");
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
    <option value="edit">L&ouml;schen</option>
</select>
<input type="submit" value="Los!" />
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
?>
