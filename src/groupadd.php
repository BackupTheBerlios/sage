<?php
require_once("inc/functions.inc.php");

$pagename = "Gruppe hinzuf&uuml;gen";
require("inc/header.inc.php");
?>

<?php
$fc_htgroup=file($htgroup);   // Inhalt der Gruppendatei einlesen
                              // (fc_ = FileContents)
$me = $_SERVER["PHP_SELF"];

echo "<form name=\"groupadd\" action=\"$me\" method=\"post\">\n";
echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" summary=\"Eingabemaske zum Anlegen einer neuen Gruppe\">\n";
echo "<tr><td>Gruppen-Name:</td><td><input type=\"text\" name=\"groupname\" size=\"30\" maxlength=\"30\" /><input type=\"hidden\" name=\"check\" value=\"1\" /></td></tr>\n";
echo "<tr><td><input type=\"submit\" value=\"Grupppe anlegen\" /></td>\n";
echo "<td style=\"text-align:right\"><input type=\"reset\" value=\"Abbrechen\">";
echo "</td></tr>\n";
echo "<tr><td>Status:</td><td>\n";
$err=255;
if (isset($_POST[check])) {
    $err=0;
    if ($_POST["groupname"] == "") {          // wurde Gruppen-Name ausgefuellt?
        echo "Kein Gruppen-Name angegeben.<br />\n";
        $err=1;
    }
}
if ($err == 0) {
    for ($i=0;$i<sizeof($fc_htgroup);$i++){   // Gruppen durchlaufen
        $gruppen=explode(" ",$fc_htgroup[$i]);
        $fc_htgroup[$i] = ereg_replace("#.*","",trim($fc_htgroup[$i]));
        if ($fc_htgroup[$i] == "") continue;
        if (str_replace(":","",trim($gruppen[0])) == $groupname) {
            echo "Gruppe existiert bereits.";
            break;
        } else {
            $f_htgroup=fopen($htgroup,"a+");
            fwrite($f_htgroup,$groupname.": ");
            fclose($f_htgroup);
            if (mkdir($sage_data_dir."/".$groupname,0700)) {
                $htaccess=$sage_data_dir."/".$groupname."/.htaccess";
                $f_htaccess=fopen($htaccess,"w+");
                fwrite($f_htaccess,"AuthType Basic\n");
                fwrite($f_htaccess,"AuthName \"SAGE\"\n");
                fwrite($f_htaccess,"AuthUserFile ".$htpasswd."\n");
                fwrite($f_htaccess,"AuthGroupFile ".$htgroup."\n");
                fwrite($f_htaccess,"require group ".$groupname."\n");
                fclose($f_htaccess);                
                $group = new User;
                $group->loginname="@".$groupname;
                $group->user_id_parent="";
                if ($group->insert()) {
                    $rootpath = new Path;
                    $rootpath->selectByName("/");
                    $path = new Path;
                    $path->pathname=$groupname;
                    $path->loginname="@".$groupname;
                    $path->path_id_parent=$rootpath->path_id;
                    if ($path->insert()) {
                        $acl = new ACL;
                        $acl->user_id=$group->user_id;
                        $acl->path_id=$path->path_id;
                        $acl->$delete_path = 1;  // ACL fuer Gruppenordner
                        $acl->$write_path  = 1;  //  => alles auf 1
                        $acl->$read_path   = 1;
                        $acl->$rename_path = 1;
                        $acl->$delete_file = 1;
                        $acl->$write_file  = 1;
                        $acl->$read_file   = 1;
                        $acl->$rename_file = 1;
                        $modpath = new Path;
                        $modacl = new ACL;
                        $modacl->user_id=$group->user_id;
                        foreach (array("BROWSER", "CALENDAR", "HILFE", "MAIL") as $modulename) {
                            $modpath->selectByName($modulename);
                            $modacl->path_id=$modpath->path_id;
                            $modacl->delete_path=1;
                            if ($modacl->insert()) {
                                echo "Gruppe angelegt.";
                            } else {
                                echo "Fehler bei Modul ".$modulename.".";
                            }
                        } // end foreach
                    } else {
                        echo "Fehler bei INSERT.";
                    }
                } else {
                    echo "Fehler bei INSERT.";
                }
            } else {
                echo "Fehler beim Erstellen des Verzeichniss.";
            }
        }
    } // end for
}
echo "</td></tr>\n</table>\n</form>\n";
?>

<?php
require("inc/footer.inc.php");
?>
