<?php
require_once("inc/functions.inc.php");
if (!loggedIn()) setupSession();
require_once("inc/config.inc.php");
require_once("inc/mysql_class.inc.php");
require_once("inc/fehlerausgabe.inc.php");

$PageName = "Profil";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");


function printProfileForm()
{
    $me = $_SERVER["PHP_SELF"];
    $user = &$_SESSION["user"];
echo <<<EOF
<h2>Benutzerprofil bearbeiten</h2>
<form name="userprofile" method="post" action="$me">
    <input type="hidden" name="cmd" value="change" />
    Altes Passwort:<br /><input type="password" name="oldpw" value="" /><br/>
    Neues Passwort:<br /><input type="password" name="pw" value="" /><br/>
    Passwort wiederholen:<br /><input type="password" name="pwcfrm" value="" /><br />
    Vorname:<br /><input type="text" name="firstname" value="$user->firstname" /><br />
    Nachname:<br /><input type="text" name="surname" value="$user->surname" /><br />
    Homepage:<br /><input type="text" name="homepage" value="$user->homepage" /><br />
    E-Mail:<br /><input type="text" name="e_mail" value="$user->e_mail" /><br />
    Beschreibung:<br /><textarea cols="36" rows="10" name="description">$user->description</textarea><br />
    <input type="submit" value="Speichern" /><input type="reset" name="Zur&uuml;cksetzen" />
</form>
EOF;
}

function changePassword($oldpw, $newpw, $newpwcfrm)
{
    // hier muss ich leider ein wenig sql direkt in den code hacken...urks...
    if ($_SESSION["user"]->password != crypt($oldpw, $_SESSION["user"]->password)) {
        echo("<font color=\"#ff0000\">Fehler bei der Eingabe des alten Passwortes.</font>");
        return false;
    }

    if ($newpw != $newpwcfrm) {
        echo("<font color=\"#ff0000\">Die Passw&ouml;rter stimmen nicht &uuml;berein.</font>");
        return false;
    }


    $cpw = crypt($newpw);
    $uid = $_SESSION["user"]->user_id;

    $dbq = new DB;
    $dbq->db_connect();

    $query = "UPDATE sage_user
              SET password = '$cpw'
              WHERE user_id = $uid";

    // db_insert gibt ein boolean zurück
    $result = $dbq->db_insert($query);
    if (!$result) {
        fehlerausgabe("Konnte die Datenbank nicht updaten.");
        die();
    }

    $retarr = array();
    $retval = 0;

    // TODO: Kais Methode benutzen
    exec($tmp_htpasswd_exec." -b $htpasswd ".$_SESSION["user"]->loginname." ".$newpw, $retarr, $retval);
    if ($retval != 0) {
        fehlerausgabe("Konnte das HTTP-Passwort nicht updaten");
        die();
    }

    return true;
}

function doChange()
{
    /*
    if (!isset($_POST["password"]) || @$_POST["password"] == "") {
        echo("Bitte geben Sie ein Passwort ein!<p />");
        return false;
    }
    */
    if (isset($_POST["oldpw"]) || @$_POST["oldpw"] != "") {
        if (!changePassword(@$_POST["oldpw"], @$_POST["pw"], @$_POST["pwcfrm"])) return false;
    }


}


$command = @$_POST["cmd"];
if ($command == "") $command = "show";

if ($command == "show") {
    printProfileForm();
} else if ($command == "change") {
    if (!doChange()) printProfileForm();
}

?>


<?php
require("inc/footer.inc.php");
?>
