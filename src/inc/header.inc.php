<?php
require_once("inc/functions.inc.php");
if (!loggedIn()) setupSession();
?>

<html>
<head>
<title><?php echo $PageName; ?></title>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed">
    <tr>
        <td nowrap="nowrap" valign="top" align="left">
            <img src="icons/logo_large.png" alt="Logo" />            
        </td>
        <td  nowrap="nowrap" valign="bottom" align="right">
            <?php
                echo($_SESSION["user"]->loginname."<br />");
                echo("<a href=\"logout.php\">Abmelden</a>");
            ?>
        </td>
    </tr>
</table>

<hr />
