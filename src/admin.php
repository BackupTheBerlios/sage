<?php
ob_start();
/*Variablen Deklaration*/
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/fehlerausgabe.inc.php");

function printSelection()
{
    $me = $_SERVER["PHP_SELF"];
    echo <<<EOF

<form name="adminselect" method="post" action="$me">
    <select name="cmd">
        <option value="useradd">User einrichten</option>
        <option value="useredit">User bearbeiten</option>
        <option value="userdel">User l&ouml;schen</option>
        <option value="groupadd">Gruppe einrichten</option>
        <option value="groupedit">Gruppe bearbeiten</option>
        <option value="groupdel">Gruppe l&ouml;schen</option>
        <input type="submit" value="Los" />
    </select>
</form>
EOF;
}

function printNewUser()
{
    $me = $_SERVER["PHP_SELF"];
    echo <<<EOF

<form method="post" action="$me">
    <table>
		<tr>
			<td>User-Name:</td>	
			<td><input type="text" name="UserName" /></td>
		</tr>
		<tr>	
			<td>Passwort:</td>
			<td><input type="password" name="Passwort" /></td>
		</tr>
		<tr>	
			<td>Passwort (wdh):</td>	
			<td><input type="password" name="PasswortWdh" /></td>
		</tr>
		<tr>
		    <td>Nachname:</td>		
			<td><input type="text" name="Nachname" /></td>
		</tr>	
		<tr>	
			<td>Vorname:</td>
			<td><input type="text" name="Vorname" /></td>
		</tr>
		<tr>	
			<td>E-Mail:</td>
			<td><input type="text" name="EMail" /></td>
		</tr>
		<tr>
			<td><input type="submit" value="OK" /></td>
			<td width="20">&nbsp;</td>
			<td><input type="button" value="Abbrechen" name="Abbrechen" /></td>
		</tr>
	    <input type="hidden" name="cmd" value="donewuser" />
	</table>
</form>

EOF;
}

function doNewUser()
{
    $username = $_REQUEST["UserName"];

    $user = new User;
    if ($user->selectByName($username)) {
        fehlerausgabe("Fehler: User existiert schon");
        die();
    }

}


$PageName="Administration";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");

$command = $_REQUEST["cmd"];
if ($command == "") $command = "select";

if ($command == "select") {
    printSelection();
} else if ($command == "useradd") {
    redirectTo("useradd.php");
} else if ($command == "groupadd") {
    redirectTo("groupadd.php");
} else {
    echo("<font color=\"#ff0000\">Kommando unbekannt. Bitte neu w&auml;hlen.</font>");
    printSelection();
}

require("inc/footer.inc.php");
ob_end_flush();
?>