<?php
require_once("inc/functions.inc.php");
require_once("inc/path.inc.php");
require_once("inc/file.inc.php");
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
        $me = $_SERVER["PHP_SELF"];
        echo ("<tr>");
        echo("<td><img src=\"icons/binary.gif\" alt=\"[file]\" />");

        echo("<a href=\"$me?cmd=open&path=$path->filename\">$path->filename</a></td>\n");
        echo("<td>$path->loginname</td>");
        echo("<td>$path->description</td>");
        echo("<td>$path->insert_at</td>");
        echo("</tr>");


    } else {
        $me = $_SERVER["PHP_SELF"];
        echo ("<tr>");
        echo("<td><img src=\"icons/dir.gif\" alt=\"[dir]\" />");

        echo("<a href=\"$me?cmd=ls&path=$path->pathname\">$path->pathname</a></td>\n");
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

function listCurrentPath()
{
    //  Verzeichniseintrag holen
    $path = new Path;
    if (!$path->selectByName($_SESSION["path"])) {
        fehlerausgabe("Verzeichnis existiert nicht!");
        die();
    }

    echo ("Verzeichnis: ".$path->pathname."<p />");

    // ACL f�r das Verzeichnis holen
    //$user = $_SESSION["user"];
    $acl = $_SESSION["user"]->getACLByPath($path->pathname);
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
            printDirectoryEntry($pathlist->list[$i], false);
        }
    }

    $filelist = new FileList;
    $filelist->selectByPathId($path->path_id);
    for ($i = 0; $i < count($filelist->list); $i++) {
        printDirectoryEntry($filelist->list[$i], true);
    }


    printFooter();
}

function uploadFile()
{
    echo <<<EOF

<h2>Datei hochladen</h2>

<form name="DateiSuchen" method='post' action="collect.php">
<table border = 0>
	<tr>
		<td width='120'>
		<b>Lokale Datei:</b>
		</td>

		<td width='120'>
		<input name='LokaleDatei' size='25'>
		</td>

		<td width='120' align='right'>
		<input type='button'  value='Durchsuchen' style='WIDTH:90' >
		</td>
	</tr>
</table>
</form>

<form name='DateiInfo' method='post' action=''>
<table border = 0>
	<tr>
		<td width='120'>
		<b>Name:*</b>
		</td>

		<td width ='240'>
		<input name='DateiName' size='47'>
		</td>
	</tr>

	<tr>
		<td width='120' valign='top'>
		<b>Beschreibung:*</b>
		</td>

		<td width ='240'>
		<textarea cols='36' rows='10' name='Beschreibung'>
		</textarea>
		</td>

	</tr>
</table>


<table border = 0>
	<tr>
		<td width='120'>
		<small>* optionale Felder</small>
		</td>

		<td width='120'>
		<input type='submit'  value='OK' style='WIDTH:90' >
		</td>

		<td width='120' align='left'>
		<input type='submit'  value='Abbrechen' style='WIDTH:90' >
		</td>
	</tr>
</table>
</form>

?>

<?php
$PageName = "Browser";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");

$command = $_REQUEST["cmd"];
if ($command == "") $command = "ls";

if ($command == "ls") {
    $_SESSION["path"] = $_REQUEST["path"];
    if (!isset($_SESSION["path"])) {
        $_SESSION["path"] = "/";
    }
    listCurrentPath();
} else {
}


?>


<?php
require("inc/footer.inc.php");
?>
