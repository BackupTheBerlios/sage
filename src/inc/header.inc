<?PHP
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
<p><img src="icons/logo_large.png" alt="Logo" /></p>
<hr>
<table width="100%" border="0" cellspacing="5" cellpadding="10" style="table-layout:fixed">
  <tr>  
    <td bgcolor="#CCCCCC" nowrap valign="top" style="width:20%">
      <div align="center"><u>Menü</u></div><br>

	<?PHP
		require "verzeichniss.inc";
		$obergrenze=count($linkArray);
		for($a=0;$a<$obergrenze;$a++)
			echo "$linkArray[$a]";
	?>
    </td>
    <td nowrap style="width:80%">
