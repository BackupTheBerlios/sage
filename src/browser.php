<?php
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/path.inc.php");
require_once("inc/file.inc.php");
require_once("inc/fehlerausgabe.inc.php");


function printHeader()
{
    $me = $_SERVER["PHP_SELF"];

    echo <<<EOF
<form name="Browser" action="$me" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
    <tr>
        <td colspan="5" nowrap="nowrap" valign="top">
            <select name="cmd">
                <option value="upload">Datei hochladen</a>
                <option value="delete">Datei l&ouml;schen</a>
            </select>
            <input type="submit" value="Los" />
        </td>
    </tr>
    <tr>
        <td bgcolor="#CCCCCC" nowrap="nowrap" valign="top">
            Auswahl
        </td>
        <td bgcolor="#CCCCCC" nowrap="nowrap" valign="top">
            Name
        </td>
        <td bgcolor="#CCCCCC" nowrap="nowrap" valign="top">
            Beschreibung
        </td>
        <td bgcolor="#CCCCCC" nowrap="nowrap" valign="top">
            Besitzer
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
        $icon = getFileIcon($path->filename);

        $me = $_SERVER["PHP_SELF"];
        echo("<tr>");
        echo("<td><input type=\"checkbox\" name=\"filename[]\" value=\"$path->filename\" />");
        echo("<td><img src=\"icons/$icon\" alt=\"[file]\" />");
        echo("<a href=\"$me?cmd=open&filename=$path->filename\">$path->filename</a></td>\n");
        //echo("<a href=\"path=$path->filename\">$path->filename</a></td>\n");
        echo("<td>$path->description</td>");
        echo("<td>$path->loginname</td>");
        echo("<td>$path->insert_at</td>");
        echo("</tr>");


    } else {
        $me = $_SERVER["PHP_SELF"];
        echo ("<tr>");
        echo("<td><input type=\"checkbox\" name=\"pathname[]\" value=\"$path->pathname\" />");
        echo("<td><img src=\"icons/dir.gif\" alt=\"[dir]\" />");

        echo("<a href=\"$me?cmd=ls&path=$path->pathname\">$path->pathname</a></td>\n");
        echo("<td>$path->description</td>");
        echo("<td>$path->loginname</td>");
        echo("<td>$path->insert_at</td>");
        echo("</tr>");
    }
}

function printFooter()
{
    echo("</table>");
    echo("</form>");
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

    // ACL für das Verzeichnis holen
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

function printUploadFile()
{
    $me = $_SERVER["PHP_SELF"];
    echo <<<EOF

<h2>Datei hochladen</h2>

<form name="DateiSuchen" enctype="multipart/form-data" action="$me" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="4000000" />
<input type="hidden" name="cmd" value="doupload" />
<table border = 0>
	<tr>
		<td width="120">
		<b>Lokale Datei:</b>
		</td>

		<td colspan="2" width="120" align="right">
		<input type="file" name="userfile" />
		</td>
	</tr>
	<tr>
		<td width="120">
		<b>Name:*</b>
		</td>

		<td width ="240" colspan="2">
		<input name="DateiName" type="text" size="47">
		</td>
	</tr>

	<tr>
		<td width="120" valign="top">
		<b>Beschreibung:*</b>
		</td>

		<td width="240" colspan="2">
		<textarea cols="36" rows="10" name="Beschreibung"></textarea>
		</td>

	</tr>
	<tr>
		<td width="120">
		<small>* optionale Felder</small>
		</td>

		<td width="120">
		<input type="submit"  value="OK" style="width:90" />
		</td>

		<td width="120" align="left">
		<input type="submit"  value="Abbrechen" style="width:90" />
		</td>
	</tr>
</table>
</form>
EOF;
}

function doUpload()
{
    global $sage_data_dir;
    //  Verzeichniseintrag holen
    $path = new Path;
    if (!$path->selectByName($_SESSION["path"])) {
        fehlerausgabe("Kann nicht hochladen: Verzeichnis existiert nicht");
        die();
    }

    // ACL für das Verzeichnis holen
    $acl = $_SESSION["user"]->getACLByPath($path->pathname);
    if ($acl->write_path != "1") {
        fehlerausgabe("Kann nicht hochladen: Zugriff verweigert");
        die();
    }

    $file = new File;
    if ($file->selectByPathIDAndName($path->path_id, $_REQUEST["DateiName"])) {
        fehlerausgabe("Kann nicht hochladen: Datei existiert schon");
        die();
    }


    $file->path_id = $path->path_id;
    $file->loginname = $_SESSION["user"]->loginname;
    $file->filename = $_REQUEST["DateiName"];
    $file->description = $_REQUEST["Beschreibung"];
    $file->insert_at = "NOW()";
    $file->modified_at = "NOW()";
    if ($file->insert()) {
        move_uploaded_file($_FILES["userfile"]["tmp_name"], $sage_data_dir.$path->pathname."/".$_REQUEST["DateiName"]);
        listCurrentPath();
    } else {
        fehlerausgabe("Kann nicht hochladen: Einf&uumlgen in Datenbank fehlgeschlagen");
        die();
    }
}

function openFile()
{
    global $sage_data_dir;

    $filename = $_REQUEST["filename"];
    if ($path = "") return false;

    $fspath = $sage_data_dir.$_SESSION["path"]."/".$filename;
    if (!file_exists($fspath)) return false;

    $filesize = filesize($fspath);
    $mime = getFileType($fspath);

    header("Content-Type: $mime");
    header("Content-Disposition: attachment; filename=$filename");
    //header("Content-Length: $filesize ");
    readfile($fspath);
}

function confirmDelete()
{
    echo("Folgende Dateien und Verzeichnisse l&ouml;schen?\n");
    echo("<p />");

    $pathname = @$_REQUEST["pathname"];
    $filename = @$_REQUEST["filename"];

    for ($i = 0; $i < count($pathname); $i++) {
        $name = $pathname[$i];
        echo ("$name<br />\n");
    }

    for ($i = 0; $i < count($filename); $i++) {
        $name = $filename[$i];
        echo ("$name<br />\n");
    }

    echo ("<p />");

    $me = $_SERVER["PHP_SELF"];

    //echo ("<a href=\"$me?cmd=dodelete\"
}
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
} else if ($command == "upload") {
    printUploadFile();
} else if ($command == "doupload") {
    doUpload();
} else if ($command == "delete") {
    confirmDelete();
} else if ($command == "open") {
    openFile();
} else {
    listCurrentPath();
}

?>


<?php
require("inc/footer.inc.php");
?>
