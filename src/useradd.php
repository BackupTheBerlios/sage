<?php
require_once("inc/functions.inc.php");

$pagename = "Benutzer hinzuf&uuml;gen";
require("inc/header.inc.php");
?>

<?php
$fc_htgroup=file($htgroup);   // Inhalt der Gruppendatei einlesen
                              // (fc_ = FileContents)
$me = $_SERVER["PHP_SELF"];

if (sizeof($fc_htgroup)==0) { // Datei ist leer, also keine Gruppen vorhanden
    echo "<p>Noch keine Gruppe vorhanden!</p>\n";
}
else {                        // Gruppen gefunden
    echo "<form name=\"useradd\" action=\"$me\" method=\"post\">\n";
    echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" summary=\"Eingabemaske zum Anlegen eines neuen Benutzers\">\n";
    echo "<tr><td>Benutzer-Name:</td><td><input type=\"text\" name=\"username\" size=\"30\" maxlength=\"30\" /></td></tr>\n";
    echo "<tr><td>Passwort:</td><td><input type=\"password\" name=\"passwd1\" size=\"8\" maxlength=\"8\" /></td></tr>\n";
    echo "<tr><td>Passwort wdh.:</td><td><input type=\"password\" name=\"passwd2\" size=\"8\" maxlength=\"8\" /></td></tr>\n";
    echo "<tr><td>Gruppe:</td><td><select name=\"gruppe\" size=\"1\">";
    for ($i=0;$i<sizeof($fc_htgroup);$i++){   // Gruppen einlesen
	$fc_htgroup[$i] = ereg_replace("#.*","",trim($fc_htgroup[$i]));
        if ($fc_htgroup[$i] == "") continue;
        $gruppen=explode(" ",$fc_htgroup[$i]);
        echo "<option value=\"".str_replace(":","",trim($gruppen[0]))."\">".str_replace(":","",trim($gruppen[0]))."</option>";
    }
    echo "</select></td></tr>\n";
    echo "<tr><td>Vorname:</td><td><input type=\"text\" name=\"vorname\" size=\"30\" maxlength=\"30\" /></td></tr>\n";
    echo "<tr><td>Nachname:</td><td><input type=\"text\" name=\"nachname\" size=\"30\" maxlength=\"30\" /></td></tr>\n";
    echo "<tr><td>E-Mail:</td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"255\" /><input type=\"hidden\" name=\"check\" value=\"1\" /></td></tr>\n";  // TODO: was ist die maximale laenge (rfc)?
    echo "<tr><td><input type=\"submit\" value=\"Benutzer hinzuf&uuml;gen\"></td>\n";
    echo "<td style=\"text-align:right\"><input type=\"reset\" value=\"Abbrechen\" />\n";
    echo "</td></tr>\n";
    echo "<tr><td>Status:</td><td>\n";
    $err=255;
    if (isset($_POST[check])) {
        $err=0;
        if ($username == "") {          // wurde Benutzer-Name ausgefuellt?
            echo "Kein Benutzer-Name angegeben.<br />\n";           
            $err=1;
        }
        if ($passwd1 != $passwd2){      // stimmen die Passwoerter ueberein?
            echo "Passw&ouml;rter stimmen nicht &uuml;berein.<br />\n";
            $err=2;
        }
        if ($vorname == "") {           // Vorname ausgefuellt?
            echo "Kein Vorname angegeben.<br />\n";
            $err=3;
        }
        if ($nachname == "") {          // Nachname ausgefuellt?
            echo "Kein Nachname angegeben.<br />\n";
            $err=4;
        }
        if ( !ereg("^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-.]?[0-9a-zA-Z])*\\.[a-zA-Z]{2,3}$", $email)) {
            echo "Die EMail-Adresse ist fehlerhaft.<br />\n";
            $err=5;
        }
        if ($err == 0) {
            $fc_htpasswd=file($htpasswd);
            $merker=0;              // Benutzer-Name noch nicht vorhanden
            for ($i=0;$i<sizeof($fc_htpasswd);$i++){
                $entity=explode(":",$fc_htpasswd[$i]);
                if ($entity[0]==$username){
                    $merker=1;      // Benutzer-Name existiert bereits
                }
            }
            if ($merker!=1){        // Benutzer-Name existiert noch nicht
                $f_htpasswd=fopen($htpasswd,"a+");
                if ($passwd1!="")
                    $password=crypt($passwd1);  // Passwort crypten
                $eintragen="$username:$password";
                fwrite($f_htpasswd,"$eintragen\n");  // und speichern
                fclose($f_htpasswd);
                $fc_htgroup=file($htgroup);
                $f_htgroup=fopen($htgroup,"w+");
                for ($i=0;$i<sizeof($fc_htgroup);$i++){
                    $eintragen=explode(" ",$fc_htgroup[$i]);
                    if (trim($eintragen[0])=="$gruppe:"){  // Benutzer-Name zu Gruppe
                        $zeile=trim($fc_htgroup[$i])." ".$username; // hinzufuegen
                    } else {
                        $zeile=trim($fc_htgroup[$i]);
                    }
                    if ($zeile != "") fwrite($f_htgroup,"$zeile\n");
                }
                fclose($f_htgroup);

                // TODO: Hier Funktion um Benutzer in Datenbank einzutragen
                //       einfuegen.

                echo "Benutzer hinzugef&uuml;gt.\n";
            }
            else echo "Benutzer-Name existiert bereits.\n";
        }
    }
    echo "</td></tr>\n</table>\n</form>\n";
}
?>

<?php
require("inc/footer.inc.php");
?>
