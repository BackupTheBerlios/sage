<?php
//Dies Stellt den Header dar !!
?>


<html>
<head>
<title><?php echo $PageName; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p>

</p>
<p>&nbsp;</p>
<hr>
<table width="100%" border="0" cellspacing="5" cellpadding="10" style="table-layout:fixed">
  <tr>
    <td bgcolor="#CCCCCC" nowrap valign="top" style="width:20%">
      <div align="center"><u>Admin Tools</u></div><br>
      <div align="center"><a href="tools.php">Gruppe anlegen</a></div><br>
      <div align="center"><a href="tools.php">Gruppen-R bearbeiten</a></div><br>
      <div align="center"><a href="tools.php">Gruppen-M bearbeiten</a></div><br>
      <div align="center"><a href="tools.php">User einrichten</a></div><br>
      <div align="center"><a href="main.php">Haupt-Menü</a></div><br>
    </td>
    <td nowrap style="width:80%">
    </td>
  </tr>
</table>
<hr>
<table width="100%" border="0" bordercolor="#CCCCCC">
  <tr bordercolor="0">
    <td height="21" align="center">
      <?php
	    echo date("d M Y h:i:s a");
	  ?>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
