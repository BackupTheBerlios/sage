<?php
require_once("inc/functions.inc.php");
require_once("inc/path.inc.php");
require_once("inc/fehlerausgabe.inc.php");

function printHeader()
{
    echo <<<EOF

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
    <tr>
        <td bgcolor="#CCCCCC" nowrap="nowrap" valign="top">
            Name
        </td>
        <td bgcolor="#CCCCCC" nowrap="nowrap" valign="top">
            Besitzer
        </td>
        <td bgcolor="#CCCCCC" nowrap="nowrap" valign="top">
            Beschreibung
        </td>
        <td bgcolor="#CCCCCC" nowrap="nowrap" valign="top">
            erstellt am
        </td>
    </tr>
EOF;
}




function printDirectoryEntry(&$path, $isFile)
{
    if ($isFile) {




    } else {
        $me = $_SERVER["PHP_SELF"];
        echo ("<tr>");
        echo("<td><img src=\"icons/dir.gif\" alt=\"[dir]\" />");

        echo("<a href=\"$me?path=$path->pathname\">$path->pathname</a></td>\n");
        echo("<td>$path->loginname</td>");
        echo("<td>$path->description</td>");
        echo("<td>$path->insert_at</td>");
        echo("</tr>");
    }
}

function printFooter()
{
    echo ("</table>");
}

$PageName = "Browser";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");



$_SESSION["path"] = $_REQUEST["path"];

if (!isset($_SESSION["path"])) {
    $_SESSION["path"] = "/";
}

//  Verzeichniseintrag holen
$path = new Path;
if (!$path->selectByName($_SESSION["path"])) {
    fehlerausgabe("Verzeichnis existiert nicht!");
    die();
}

echo ("Verzeichnis: ".$path->pathname."<p />");

// ACL für das Verzeichnis holen
$user = $_SESSION["user"];
$acl = $user->getACLByPath($path->pathname);
if ($acl->read_path != "1") {
    fehlerausgabe("Zugriff auf $path->pathname verweigert");
    die();
}

printHeader();
// Verzeichnisse listen
$parent = new Path;
if ($path->path_id_parent != NULL) {
    if ($parent->selectById($path->path_id_parent)) {
        printDirectoryEntry($parent, false);
    }
}

$pathlist = new PathList;
$pathlist->selectByParentId($path->path_id);
for ($i = 0; $i < count($pathlist->list); $i++) {
    $acl = $_SESSION["user"]->getACLByPath($pathlist->list[$i]->pathname);
    if ($acl->read_path) {
        $currentPath = $pathlist->list[$i];
        printDirectoryEntry($currentPath, false);
    }
}
printFooter();
?>


<?php
require("inc/footer.inc.php");
?>
