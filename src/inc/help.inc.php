<?php
	/*Ueber die Funktion help() braucht man sich keine Sorgen zu machen sie ruft lediglich eine Weitere Funktion auf,
    die sich in dem Array (hilfe_array) befindet.
	In dem hilfe_array befinden sich zu den einzelnen Modulen eine Funktion ! Diese muss den Modul Namen mit uebergeben.*/
	
	function help($ModulName){
		echo $hilfe_array[$ModulName];
    } 

	$hilfe_array=array(
        ADMIN=>admin("ADMIN"),
        CALENDAR=>calendar("CALENDAR"),
        MAIL=>mailing("MAIL"),
        BROWSER=>browser("BROWSER"),
        HILFE=>hilfe("HILFE")
    );

	/*Eine Funktion hier als Bsp. admin arbeitet wie folgt...
	  Zuerst kann man in die am anfang inizialisierten Arrays den HTML Code zu einem Menuepunkt einfuegen. Moechte man
      einen Screenshot dazufuegen, tragt man den link mit zugehoerigen Pfad in das screen array ein.
	  Nach der Initialisierung der Array werdnen alle Rechte zu den einzelnen Modulen in einem array (recht) abgespeichert.
      über dieses wird im anschluss auch iterriert und die einzelnen Hilfe Seiten werden dann ausgegeben.
      Moechte man nur eine Hilfe Seite fuer ein Modul erstellen, so laesst man die 7 ueberfluessigen Felder einfach weg.
	  (siehe unten) ...
    */

    function admin($ModulName){
		
		$hilfe_admin_text=array(0=>"<div align=\"center\"><u>Gruppe Einrichten 1</u></div>",
                                1=>"<div align=\"center\"><u>Gruppe Einrichten 2</u></div>",
                           		2=>"<div align=\"center\"><u>Gruppe Einrichten 3</u></div>",
	                            3=>"<div align=\"center\"><u>Gruppe Einrichten 4</u></div>",
     	                        4=>"<div align=\"center\"><u>Gruppe Einrichten 5</u></div>",
          	                    5=>"<div align=\"center\"><u>Gruppe Einrichten 6</u></div>",
               		            6=>"<div align=\"center\"><u>Gruppe Einrichten 7</u></div>",
                    	        7=>"<div align=\"center\"><u>Gruppe Einrichten 8</u></div>");

		$hilfe_admin_screen=array(0=>"",
                                  1=>"",
                                  2=>"",
                            	  3=>"",
                                  4=>"",
                                  5=>"",
                                  6=>"",
                                  7=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);
        $recht[0]=$acl->delete_path;
        $recht[1]=$acl->write_path;
        $recht[2]=$acl->read_path;
        $recht[3]=$acl->rename_path;
        $recht[4]=$acl->delete_file;
        $recht[5]=$acl->write_file;
        $recht[6]=$acl->read_file;
        $recht[7]=$acl->rename_file;

		for($a=0;$a<8;$a++){
			if($recht[$a]==1){
				if($hilfe_admin_text[$a]!=NULL){
					echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
    			    echo $hilfe_admin_text[$a]; 
	    		    echo "</td></div>";
					if($hilfe_admin_screen[$a]!=NULL){
		        	   echo "<td><div align=\"center\">";
			           echo $hilfe_admin_screen;
		    	       echo"</td></div>";
					}
		    	    echo "</tr></table><br/><br/>";
				}
			}
		}
    }

	function calendar($ModulName){
		
		$hilfe_admin_text=array(0=>"<div align=\"center\"><u>Benutzung des Kalendars</u></div>");

		$hilfe_admin_screen=array(0=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);
        $recht[0]=$acl->delete_path;
        $recht[1]=$acl->write_path;
        $recht[2]=$acl->read_path;
        $recht[3]=$acl->rename_path;
        $recht[4]=$acl->delete_file;
        $recht[5]=$acl->write_file;
        $recht[6]=$acl->read_file;
        $recht[7]=$acl->rename_file;

		for($a=0;$a<8;$a++){
			if($recht[$a]==1){
				if($hilfe_admin_text[$a]!=NULL){
					echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
    			    echo $hilfe_admin_text[$a]; 
	    		    echo "</td></div>";
					if($hilfe_admin_screen[$a]!=NULL){
		        	   echo "<td><div align=\"center\">";
			           echo $hilfe_admin_screen;
		    	       echo"</td></div>";
					}
		    	    echo "</tr></table><br/><br/>";
				}
			}
		}
    }

	function mailing($ModulName){
		
		$hilfe_admin_text=array(0=>"<div align=\"center\"><u>MAIL</u></div>");

		$hilfe_admin_screen=array(0=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);
        $recht[0]=$acl->delete_path;
        $recht[1]=$acl->write_path;
        $recht[2]=$acl->read_path;
        $recht[3]=$acl->rename_path;
        $recht[4]=$acl->delete_file;
        $recht[5]=$acl->write_file;
        $recht[6]=$acl->read_file;
        $recht[7]=$acl->rename_file;

		for($a=0;$a<8;$a++){
			if($recht[$a]==1){
				if($hilfe_admin_text[$a]!=NULL){
						echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
    				    echo $hilfe_admin_text[$a]; 
	    			    echo "</td></div>";
						if($hilfe_admin_screen[$a]!=NULL){
			    	       echo "<td><div align=\"center\">";
			        	   echo $hilfe_admin_screen;
		    		       echo"</td></div>";
						}
			        	echo "</tr></table><br/><br/>";
				}
			}
		}
    }

	function browser($ModulName){
		
		$hilfe_admin_text=array(0=>"<div align=\"center\"><u>Benutzung des Browsers</u></div>");

		$hilfe_admin_screen=array(0=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);
        $recht[0]=$acl->delete_path;
        $recht[1]=$acl->write_path;
        $recht[2]=$acl->read_path;
        $recht[3]=$acl->rename_path;
        $recht[4]=$acl->delete_file;
        $recht[5]=$acl->write_file;
        $recht[6]=$acl->read_file;
        $recht[7]=$acl->rename_file;

		for($a=0;$a<8;$a++){
			if($recht[$a]==1){
				if($hilfe_admin_text[$a]!=NULL){
					echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
    			    echo $hilfe_admin_text[$a]; 
	    		    echo "</td></div>";
					if($hilfe_admin_screen[$a]!=NULL){
			           echo "<td><div align=\"center\">";
			           echo $hilfe_admin_screen;
	    		       echo"</td></div>";
					}
			        echo "</tr></table><br/><br/>";
				}
			}
		}
    }

	function hilfe($ModulName){
		
		$hilfe_admin_text=array(0=>"<div align=\"center\"><u>Hilfe ueber die Hilfe</u></div>");

		$hilfe_admin_screen=array(0=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);
        $recht[0]=$acl->delete_path;
        $recht[1]=$acl->write_path;
        $recht[2]=$acl->read_path;
        $recht[3]=$acl->rename_path;
        $recht[4]=$acl->delete_file;
        $recht[5]=$acl->write_file;
        $recht[6]=$acl->read_file;
        $recht[7]=$acl->rename_file;

		for($a=0;$a<8;$a++){
			if($recht[$a]==1){
				if($hilfe_admin_text[$a]!=NULL){
					echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
    			    echo $hilfe_admin_text[$a]; 
	    		    echo "</td></div>";
					if($hilfe_admin_screen[$a]!=NULL){
		        	   echo "<td><div align=\"center\">";
			           echo $hilfe_admin_screen;
		    	       echo"</td></div>";
					}
		    	    echo "</tr></table><br/><br/>";
				}
			}
		}
    }      
?>
