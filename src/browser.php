<?php
ob_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/path.inc.php");
require_once("inc/file.inc.php");
require_once("inc/fehlerausgabe.inc.php");
require_once("inc/acledit.inc.php");


function printHeader($path)
{
    $me = $_SERVER["PHP_SELF"];
    echo ("Aktuelles Verzeichnis: ".$path->pathname."<br />\n");

    echo <<<EOF
<form name="Browser" action="$me" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
    <tr>
        <td colspan="4" nowrap="nowrap" valign="top">
            <select name="cmd">
                <option value="upload">Datei hochladen</option>
                <option value="mkdir">Verzeichnis erstellen</option>
                <option value="chacl">Verzeichnis-ACL bearbeiten</option>
                <option value="delete">L&ouml;schen</option>
            </select>
            <input type="submit" value="Los" />
        </td>
    </tr>
    <tr>
      <!---  <td bgcolor="#CAA778" nowrap="nowrap" valign="top">
            Auswahl
        </td> -->
        <td bgcolor="#CAA778" nowrap="nowrap" valign="top">
            Name
        </td>
        <td bgcolor="#CAA778" nowrap="nowrap" valign="top">
            Beschreibung
        </td>
        <td bgcolor="#CAA778" nowrap="nowrap" valign="top">
            Besitzer
        </td>
        <td bgcolor="#CAA778" nowrap="nowrap" valign="top">
            erstellt am
        </td>
    </tr>
EOF;

    $parname = "";

    $parent = new Path;
    if ($path->path_id_parent != NULL) {
        if ($parent->selectById($path->path_id_parent)) {
            $parname = $parent->pathname;
        }
    }
    if ($parname != "") {
        echo <<<EOF
<tr>
    <td>
        <img src="icons/back.gif" alt="[parent]" />
        <a href="$me?cmd=ls&amp;path=$parname">..</a></td>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
EOF;
    }

}

function printDirectoryEntry(&$path, $isFile)
{
    if ($isFile) {
        $icon = getFileIcon($path->filename);

        $me = $_SERVER["PHP_SELF"];
        echo("<tr>\n");
        echo("<td><input type=\"checkbox\" name=\"filename[]\" value=\"$path->filename\" />");
        echo("<img src=\"icons/$icon\" alt=\"[file]\" />");
        //echo("<a href=\"$me?cmd=open&filename=$path->filename\">$path->filename</a></td>\n");
        echo("<a href=\"$me?cmd=open&amp;filename=$path->filename\">$path->filename</a></td>\n");
        //echo("<a href=\"path=$path->filename\">$path->filename</a></td>\n");
        echo("<td>$path->description</td>\n");
        echo("<td>$path->loginname</td>\n");
        echo("<td>$path->insert_at</td>\n");
        echo("</tr>");


    } else {
        $me = $_SERVER["PHP_SELF"];

        $shortname = str_replace($_SESSION["path"]."/", "", $path->pathname);
        echo ("<tr>");
        echo("<td><input type=\"checkbox\" name=\"pathname[]\" value=\"$path->pathname\" />");
        echo("<img src=\"icons/dir.gif\" alt=\"[dir]\" />");
        echo("<a href=\"$me?cmd=ls&amp;path=$path->pathname\">$shortname</a></td>\n");
        //echo("<a href=\"$me?cmd=ls;path=$path->pathname\">$shortname</a></td>\n");
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
        return false;
    }

    // ACL f�r das Verzeichnis holen
    //$user = $_SESSION["user"];
    $acl = $_SESSION["user"]->getACLByPath($path->pathname);
    if ($acl->read_path != "1") {
        fehlerausgabe("Zugriff auf $path->pathname verweigert");
        return false;
    }

    printHeader($path);

    // Verzeichnisse listen
    $pathlist = new PathList;
    $pathlist->selectByParentId($path->path_id);
    for ($i = 0; $i < count($pathlist->list); $i++) {
        $acl = @$_SESSION["user"]->getACLByPath($pathlist->list[$i]->pathname);
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

<h2>Datei erstellen</h2>

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
		<b>Beschreibung/Textnotiz:*</b>
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

function printMkDir()
{
    $me = $_SERVER["PHP_SELF"];
    echo <<<EOF
<h2>Ordner erstellen</h2>
<form name="OrdnerName" method="post" action="$me">
<input type="hidden" name="cmd" value="domkdir" />
<table border = 0>
	<tr>
		<td width="120">
		<b>Ordner-Name:</b>
		</td>

		<td width ="240">
		<input type="text" name="OrdnerName" size="47" />
		</td>
	</tr>

	<tr>
		<td width="120" valign="top">
		<b>Beschreibung:*</b>
		</td>

		<td width ="240">
		<textarea cols="36" rows="10" name="Beschreibung"></textarea>
		</td>

	</tr>
	<tr>
		<td width="120"'>
		<small>* optionale Felder</small>
		</td>

		<td width="120">
		<input type="submit"  value="Anlegen" style="width:90" />
		</td>

		<td width="120" align="left">
		<input type="submit"  value="Abbrechen" style="WIDTH:90" />
		</td>
	</tr>
</table>
EOF;
}

function doUpload()
{
    global $sage_data_dir;

    $filename = "";

    //if ((!isset($_REQUEST["DateiName"])) || (@$_REQUEST["DateiName"] == "")) {
    if (@$_REQUEST["DateiName"] != "") {
        $filename = $_REQUEST["DateiName"];
    } else {
        $filename = $_FILES["userfile"]["name"];
    }

/*
    $filename = quotemeta($filename);

    if (strstr($filename, "/") || strstr($filename, "\\")) {
        fehlerausgabe("Kann $newname nicht anlegen: Ung&uuml;ltiger Name");
        return false;
    }
*/
    //  Verzeichniseintrag holen
    $path = new Path;
    if (!$path->selectByName($_SESSION["path"])) {
        fehlerausgabe("Kann nicht hochladen: Verzeichnis existiert nicht");
        return false;
    }

    // ACL f�r das Verzeichnis holen
    $acl = $_SESSION["user"]->getACLByPath($path->pathname);
    if ($acl->write_path != "1") {
        fehlerausgabe("Kann nicht hochladen: Zugriff verweigert");
        return false;
    }

    $file = new File;
    if ($file->selectByPathIDAndName($path->path_id, $filename)) {
        fehlerausgabe("Kann nicht hochladen: Datei existiert schon");
        return false;
    }

    $file->path_id = $path->path_id;
    $file->loginname = $_SESSION["user"]->loginname;
    $file->filename = $filename;
    $file->description = @$_REQUEST["Beschreibung"];
    $file->insert_at = "NOW()";
    $file->modified_at = "NOW()";
    if ($file->insert()) {
        move_uploaded_file($_FILES["userfile"]["tmp_name"], $sage_data_dir.$path->pathname."/".$filename);
        redirectTo($_SERVER["PHP_SELF"]."?cmd=ls");
    } else {
        fehlerausgabe("Kann nicht hochladen: Einf&uumlgen in Datenbank fehlgeschlagen");
        return false;
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
    $me = $_SERVER["PHP_SELF"];

    $pathname = @$_REQUEST["pathname"];
    $filename = @$_REQUEST["filename"];

    if (0 == count($pathname) && 0 == count($filename)) {
        redirectTo($me);
    }

    echo("Diese Dateien und Verzeichnisse wirklich l&ouml;schen?\n");


    echo("<form name=\"confirmDelete\" method=\"post\" action=\"$me\">");
    echo("<input type=\"hidden\" name=\"cmd\" value=\"dodelete\" />");

    echo("<ul>");

    for ($i = 0; $i < count($pathname); $i++) {
        $name = $pathname[$i];
        echo("<input type=\"hidden\" name=\"pathname[]\" value=\"$name\" />");
        echo("<li>$name</li>\n");
    }

    for ($i = 0; $i < count($filename); $i++) {
        $name = $filename[$i];
        echo("<input type=\"hidden\" name=\"filename[]\" value=\"$name\" />");
        echo("<li>$name</li>\n");
    }

    echo("</ul>");
    echo("<input type=\"submit\" value=\"Ja\"/>\n");
    echo("</form>");

    $me = $_SERVER["PHP_SELF"];

    //echo ("<a href=\"$me?cmd=dodelete\"
}

function doDelete()
{
    $pathname = @$_REQUEST["pathname"];
    $filename = @$_REQUEST["filename"];

    global $sage_data_dir;
    //  Verzeichniseintrag holen
    $path = new Path;
    if (!$path->selectByName($_SESSION["path"])) {
        fehlerausgabe("Kann nicht l�schen: Verzeichnis existiert nicht");
        return false;;
    }

    // ACL f�r das Verzeichnis holen
    $acl = $_SESSION["user"]->getACLByPath($path->pathname);
    if ($acl->delete_file != "1") {
        fehlerausgabe("Kann in $path->pathname nicht l�schen: Zugriff verweigert");
        return false;
    }

    $db = new DB;
    for ($i = 0; $i < count($filename); $i++) {
        $query= "DELETE FROM sage_files WHERE path_id = $path->path_id AND filename = '$filename[$i]'";
        if (!$db->db_delete($query)) {
            fehlerausgabe("Kann $filename[$i] nicht l�schen: Datenbankabfrage fehlgeschlagen");
            die();
        } else {
            //
            //if (!unlink($sage_data_dir.$path->pathname."/".$filename[$i])) {
            //    fehlerausgabe("Kann $filename[$i] nicht l�schen: Dateisystem weigert sich");
            //    die();
            //}
            unlink($sage_data_dir.$path->pathname."/".$filename[$i]);
        }
    }

    for ($i = 0; $i < count($pathname); $i++) {
        $acl = $_SESSION["user"]->getACLByPath($pathname[$i]);
        $path = new Path;
        $path->selectByName($pathname[$i]);

        if ($acl->delete_path != "1") {
            fehlerausgabe("Kann $pathname[$i] nicht l�schen: Zugriff verweigert");
            return false;
        }

        $query = "SELECT * FROM sage_path WHERE path_id_parent = $path->path_id";
        $childdir = $db->db_select($query);
        if (count($childdir) != 0)  {
            fehlerausgabe("Kann $pathname[$i] nicht l�schen: Verzeichnis nicht leer");
            return false;
        }
        $query = "SELECT * FROM sage_files WHERE path_id = $path->path_id";
        $childdir = $db->db_select($query);
        if (count($childdir) != 0)  {
            fehlerausgabe("Kann $pathname[$i] nicht l�schen: Verzeichnis nicht leer");
            return false;
        }

        $query = "DELETE FROM sage_path WHERE path_id = $path->path_id";
        if (!$db->db_delete($query)) {
            fehlerausgabe("Kann $pathname[$i] nicht l�schen: Datenbankabfrage fehlgeschlagen");
            return false;
        }

        if (!rmdir($sage_data_dir.$pathname[$i])) {
            fehlerausgabe("Kann $pathname[$i] nicht l�schen: Dateisystem weigert sich");
            return false;
        }
    }


    redirectTo($_SERVER["PHP_SELF"]."?cmd=ls");
}

function doMkDir()
{
    global $sage_data_dir;

    $cwd = $_SESSION["path"];
    $newname = quotemeta(@$_REQUEST["OrdnerName"]);

    if (strstr($newname, "/") || strstr($newname, "\\")) {
        fehlerausgabe("Kann $newname nicht anlegen: Ung&uuml;ltiger Name");
        return false;
    }


    $path = new Path;

    if ($path->selectByName($newname)) {
        fehlerausgabe("Kann Ordner $newname nicht anlegen: Ordner existiert schon");
        return false;
    }

    $path->loginname        = $_SESSION["user"]->loginname;
    $path->pathname         = $_SESSION["path"]."/".$newname;
    $path->description      = $_REQUEST["Beschreibung"];
    $path->insert_at        = "NOW()";
    $path->modified_at      = "NOW()";

    $curpath = new Path;
    if (!$curpath->selectByName($_SESSION["path"])) {
        fehlerausgabe("Kann Ordner $newname nicht anlegen: Kann Parent-Pfad nicht finden");
        return false;
    }

    $path->path_id_parent   = $curpath->path_id;
    if (!$path->insert()) {
        fehlerausgabe("Kann Ordner $newname nicht anlegen: Kann Pfad nicht in DB schreiben");
        return false;
    }

    $path->selectByName($_SESSION["path"]."/".$newname);

    // zur Zeit wird ein neuer Ordner standardm�ssig der Gruppe zur Verf�gung gestellt
    $acluserid = $_SESSION["user"]->user_id_parent;
    if ($acluserid == "") $acluserid = $_SESSION["user"]->user_id;

    // [kludge]: verwende Referenz auf die Parent-ACL mit ver�nderter Path-ID, um eine neue
    // ACL zu erzeugen
    $acllist = new ACLList;
    if (!$acllist->selectByUserIDAndPath($acluserid, $_SESSION["path"])) {
        fehlerausgabe("Kann Ordner $newname nicht anlegen: Fehler beim Selektieren der Parent-ACL");
        return false;
    }

    if (count($acllist) < 1) {
        fehlerausgabe("Kann Ordner $newname nicht anlegen: Kann Parent-ACL nicht finden");
        return false;
    }

    $acl = $acllist->list[0];
    $acl->user_id = $acluserid;
    $acl->path_id = $path->path_id;

    if (!$acl->insert()) {
        fehlerausgabe("Kann Ordner $newname nicht anlegen: Kann nicht einf�gen");
        return false;
    }

//fs
    $oldumask = umask();
    umask(077);
    if (!mkdir($sage_data_dir.$path->pathname, 0700)) {
        fehlerausgabe("Kann Ordner $newname nicht anlegen: Dateisystem weigert sich");
        return false;
    }
    umask($oldumask);

    redirectTo($_SERVER["PHP_SELF"]."?cmd=ls");

    return true;

}

function handleChacl($path, $subcmd)
{
    $cmd = $subcmd;
    if ("" == $cmd) $cmd = "list";

    if ("list" == $cmd) {
        return listACLsByPath($path);
    } else if ("del" == $cmd) {
        $aclids = @$_POST["aclid"];
        if ( (!is_array($aclids)) || (!isset($aclids[0])) || $aclids[0] == "" ) {
            echo("Bitte w&auml;hlen Sie eine ACL zum L&ouml;schen aus.");
            return listACLsByPath($path);
        } else {
            deleteACL($aclids[0]);
        }
    }

    return true;
}

$PageName = "Browser";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");

$command = @$_REQUEST["cmd"];
if ($command == "") $command = "ls";

if ($command == "ls") {
    if ( (!isset($_SESSION["path"])) || $_SESSION["path"] == "" ) {
        $_SESSION["path"] = "/";
    }
    if (isset($_REQUEST["path"])) {
        $_SESSION["path"] = @$_REQUEST["path"];
    }
    listCurrentPath();
} else if ($command == "upload") {
    printUploadFile();
} else if ($command == "doupload") {
    doUpload();
} else if ($command == "delete") {
    confirmDelete();
} else if ($command == "dodelete") {
    doDelete();
} else if ($command == "open") {
    openFile();
} else if ($command == "mkdir") {
    printMkDir();
} else if ($command == "domkdir") {
    doMkDir();
}  else if ($command == "chacl") {
    $path = @$_POST["pathname"];
    if ( (!is_array($path)) || (!isset($path[0])) || $path[0] == "" ) {
        echo("Bitte w&auml;hlen Sie ein Verzeichnis aus, dessen ACL Sie editieren wollen");
        listCurrentPath();
    } else {
        handleChacl(@$_POST["pathname"][0], @$_POST["subcmd"]);
    }
} else {
    listCurrentPath();
}

require("inc/footer.inc.php");
ob_end_flush();
?>
