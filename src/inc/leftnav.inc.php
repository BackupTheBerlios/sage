<table width="100%" border="0" cellspacing="5" cellpadding="10" style="table-layout:fixed">
  <tr>  
    <td bgcolor="#CCCCCC" nowrap valign="top" style="width:20%">
      <div align="center"><u>Menü</u></div><br>

      <?php
           require_once "inc/verzeichniss.inc.php";
           $obergrenze=count($linkArray);
           for($a=0;$a<$obergrenze;$a++)
               echo "$linkArray[$a]";
      ?>
      <div align="center"><a href="main.php">Home</a></div><br />
    </td>
    <td nowrap style="width:80%">
