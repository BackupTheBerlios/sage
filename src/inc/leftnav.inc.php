<table width="100%" border="0" cellspacing="5" cellpadding="10" style="table-layout:fixed">
  <tr>  
    <td bgcolor="#CCCCCC" nowrap valign="top" style="width:20%">
      <div align="center"><u>Menü</u></div><br>

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


      <div align="center"><a href="index.php">Home</a></div><br />
    </td>
    <td nowrap style="width:80%">

    <?php
       /*
       require_once "inc/verzeichnis.inc.php";
       $obergrenze=count($linkArray);
       for($a=0;$a<$obergrenze;$a++)
           echo "$linkArray[$a]";
       */
    ?>
