<table width="100%" border="0" cellspacing="5" cellpadding="10" style="table-layout:fixed">
  <tr>
    <!--- <td bgcolor="#CCCCCC"" nowrap="nowrap" valign="top" style="width:20%"> -->
    <td bgcolor="#274E9C" nowrap="nowrap" valign="top" style="width:20%">
	<div align="center"><h2><font color="#CAA778">Menü</font></h2></div>

      <?php
           	require_once ("module.inc.php");
		   	require_once ("link_array.inc.php");
			require_once("acl.inc.php");
			require_once("user.inc.php");

			function getaccess(&$test){
				if($test->acl_id!=0)
					return true;
				return false;
			}

            echo("<font color=\"#CAA778\">");
           	$modul=new ModuleList;
           	$modul->selectAll();
		   	$anz=count($modul->list);
		   	for($i=0;$i<$anz;$i++){
				$acl=new ACL;
		   		$acl=@$_SESSION["user"]->getACLByPath($modul->list[$i]->pathname);
				if(getaccess($acl))
					echo $linkRechteListe[$modul->list[$i]->pathname];
			}
      ?>


      <div align="center"><a href="index.php" style="color: #CAA778;">Home</a></div><br />
    </td>
    <td nowrap="nowrap" style="width:80%" valign="top">

    <?php
       /*
       require_once "inc/verzeichnis.inc.php";
       $obergrenze=count($linkArray);
       for($a=0;$a<$obergrenze;$a++)
           echo "$linkArray[$a]";
       */
    ?>
