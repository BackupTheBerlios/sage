<?php
ob_start();
require_once("inc/functions.inc.php");
if (!loggedIn()) setupSession();

require_once("inc/config.inc.php");
require_once("inc/mysql_class.inc.php");
require_once("inc/fehlerausgabe.inc.php");

$PageName = "ACL-Editor";
require("inc/header.inc.php");
require("inc/leftnav.inc.php");



$command = @$_POST["cmd"];
if ($command == "") $command = "list";

if ($command == "list") {
    $path = @$_POST["path"];
    if ($path == "") {
        fehlerausgabe("Kein Pfad angegeben");
        die();
    }
    listACLsByPath($path);
}/* else if ($command == "change") {
    if (!doChange()) printProfileForm();
    else redirectTo($_SERVER["PHP_SELF"]);
}*/
require("inc/footer.inc.php");
ob_end_flush();
?>
