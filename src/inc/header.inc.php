<?php
require_once("inc/functions.inc.php");
if (!loggedIn()) setupSession();
?>

<?php
echo "<?xml version=\"1.0\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
