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
      �ber dieses wird im anschluss auch iterriert und die einzelnen Hilfe Seiten werden dann ausgegeben.
      Moechte man nur eine Hilfe Seite fuer ein Modul erstellen, so laesst man die 7 ueberfluessigen Felder einfach weg.
	  (siehe unten) ...
    */

    function admin($ModulName){
		
		$hilfe_admin_text=array(
		
		0=>"<div align=\"center\"><H3>Gruppe Einrichten</H3></div>In dieser Maske kann eine neue Benutzergruppe
		 angelegt und mit Rechten versehen werden. Die linke Spalte	<b>Alle Rechte</b> zeigt alle verf�gbaren 
		Berechtigungen an, die vergeben werden k�nnen. Die rechte Spalte <b>Ausgew�hlte Rechte</b> enth�lt die
		 Berechtigungen, die der Gruppe zugewiesen sind. �ber die Schaltfl�chen <b>\"<<\"</b>  <b>\">>\"</b> k�nnen 
		der Gruppe Berechtigungen gegeben bzw. genommen werden. Neue Gruppen k�nnen nur von Usern erstellt werden, die
		 selber �ber die Berechtigung <b>Neue Gruppe einrichten</b> verf�gen. Mit <b>OK</b> werden die Eingaben
		 best�tigt und die Gruppe erstellt. Mit <b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",


      	1=>"<div align=\"center\"><H3>Gruppenrechte bearbeiten</H3></div>In dieser Maske kann eine bestehende 
		Benutzergruppe ausgew�hlt werden und neue Berechtigungen erhalten bzw. entfernt werden. Die linke Spalte <b>
		Alle Rechte</b> zeigt alle verf�gbaren Berechtigungen an, die vergeben werden k�nnen. Die rechte Spalte <b>
		Ausgew�hlte Rechte</b> enth�lt die Berechtigungen, die der Gruppe bereits zugewiesen sind. �ber die Schaltfl�chen 
		<b>\"<<\"</b> <b>\">>\"</b> k�nnen der Gruppe Berechtigungen gegeben bzw. genommen werden. Die Gruppenrechte k�nnen
	 	nur von Usern ver�ndert werden, die selber �ber die Berechtigung <b>Gruppenrechte bearbeiten</b> verf�gen. Mit
	 	<b>OK</b> werden die Eingaben best�tigt und die neuen Berechtigungen der Gruppe zugewiesen. Mit <b>Abbrechen</b> 
		gelangt man zur�ck auf die vorherige Seite.	",
        
		2=>"<div align=\"center\"><H3>L�schen einer Gruppe</H3></div>In dieser Maske kann eine bestehende 
		Benutzergruppe gel�scht werden. Die zu l�schende Gruppe wird in der ComboBox ausgew�hlt. Mit <b>OK</b> wird die
	 	ausgew�hlte Gruppe gel�scht. Mit <b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",
	    
        3=>"<div align=\"center\"><H3>Mitglieder einer Gruppe zuordnen</H3></div>In dieser Maske kann eine bestehende
	 	Benutzergruppe ausgew�hlt werden und ihr neuer User zugef�gt bzw. entfernt werden. Die linke Spalte <b>Alle User</b>
 		zeigt alle verf�gbaren User an, die sich im System befinden. Die rechte Spalte <b>Ausgew�hlte User</b> enth�lt die 
		User, die der Gruppe bereits zugewiesen sind. �ber die Schaltfl�chen <b>\"<<\"</b> <b>\">>\"</b> k�nnen der Gruppe User 
		hinzugef�gt bzw. entfernt werden. Die Gruppenmitglieder k�nnen nur von Usern ver�ndert werden, die selber �ber die 
		Berechtigung <b>Gruppenmitglieder bearbeiten</b> verf�gen. Mit <b>OK</b> werden die Eingaben best�tigt und die neuen 
		User der Gruppe zugewiesen. Mit <b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",
     	
		4=>"<div align=\"center\"><H3>User einrichten</H3></div>�ber diese Maske kann ein User eingerichtet werden. 
		Alle Felder sind Pflichtfelder. Mit Hilfe des User-Namen und des Passwortes, was zwei mal eingegeben werden mu�, kann 
		der User sich an dem System anmelden. Der Name und Vorname wird benutzt, um den User eindeutig identifizieren zu 
		k�nnen. Durch Eingabe der E-Mail Adresse bekommt der User seine Registrierungs-Daten per E-Mail zugeschickt. Mit dem 
		Button <b>OK</b> best�tigt man die Eingabe und der User wird in der Datenbank angelegt. Mit <b>Abbrechen</b> gelangt 
		man zur�ck auf die vorherige Seite.",

        5=>"<div align=\"center\"><H3>User Eigenschaften bearbeiten</H3></div>�ber diese Maske kann der User seine 
		Eigenschaften �ndern. M�chte der User sein Passwort �ndern, kann man mit Hilfe der ersten drei Felder ein neues 
		Passwort setzen. Hat sich die E-Mail Adresse des Users ge�ndert, kann diese in dem Feld E-Mail ge�ndert werden. Mit 
		dem Button <b>OK</b> best�tigt man die Eingabe und die Daten des Users werden in der Datenbank gespeichert. Mit 
		<b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",

        6=>"<div align=\"center\"><H3>User l�schen</H3></div>�ber diese Maske kann ein oder mehrere User komplett
	 	aus dem System gel�scht werden. Hierf�r muss die Gruppe ausgew�hlt werden, in der sich der User befindet. Die zu 
		l�schenden User werden unter <b>Alle User:</b> markiert und �ber <b>\">>\"</b> den <b>Ausgew�hlten User:</b> zugef�gt. 
		Mit dem Button <b>OK</b> wird die L�schung der <b>Ausgew�hlten User</b> veranlasst. Mit <b>Abbrechen</b> gelangt man 
		zur�ck auf die vorherige Seite.",

        7=>"");

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
		if($acl->acl_id!=NULL){
			echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
			echo "<div aling=\"center\"><H2><u>Beschreibung der Admin Tools</u></H2></div><br/>";
		}
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
		
		$hilfe_admin_text=array(

		0=>"<div align=\"center\"><H3>Einf�gen einer neuen Datei</H3></div>In dieser Maske hat der Benutzer die 
		M�glichkeit eine neue Datei auf den Server hochzuladen. Den Pfad f�r die Datei kann unter <b>Lokale Datei</b>
		eingegeben werden oder die entsprechende Datei �ber den Button <b>Durchsuchen</b> ausgew�hlt werden. <b>Lokale
	 	Datei</b>, <b>Dokumenten-Name</b>, <b>Beschreibung</b> sind Pflichtfelder. �ber <b>OK</b> werden die Eingaben 
		best�tigt und die Datei auf den Server hoch geladen. Mit <b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",

		1=>"<div align=\"center\"><H3>Bearbeiten einer Datei</H3></div>In dieser Maske hat der Benutzer die 
		M�glichkeit bei einer existierenden Datei, den Dokumenten-Namen und die Beschreibung abzu�ndern. <b>Dokumenten-Name
		</b>und <b>Beschreibung</b> sind Pflichtfelder. �ber <b>OK</b> werden die �nderungen best�tigt und auf dem Server 
		gespeichert. Mit <b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",

		2=>"<div align=\"center\"><H3>L�schen einer Datei</H3></div>In dieser Maske hat der Benutzer die 
		M�glichkeit bei eine existierende Datei zu l�schen. Dazu mu� man nur das Kontroll K�stchen vor der Datei aktivieren 
		und auf l�schen klicken. �ber <b>OK</b> werden die �nderungen best�tigt und auf dem Server gespeichert. Mit <b>
		Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",
	
		3=>"<div align=\"center\"><H3>Einf�gen eines neuen Ordners</H3></div>In dieser Maske hat der Benutzer die 
		M�glichkeit, in dem aktuellen Ordner in dem er sich befindet, einen neuen Ordner zu erstellen. <b>Ordner-Name</b> 
		und die <b>Beschreibung</b> des Ordners sind Pflichtfelder. �ber <b>OK</b> werden die Eingaben best�tigt und der 
		Ordner auf dem Server erstellt. Mit <b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",

		4=>"<div align=\"center\"><H3>Umbenennen eines Ordners</H3></div>In dieser Maske hat der Benutzer die 
		M�glichkeit, bei einen bestehenden Ordner den <b>Ordner-Name</b> bzw. die <b>Beschreibung</b> zu �ndern.<b>
		Ordner-Name</b> ist ein Pflichtfeld, <b>Beschreibung</b> ist optional. �ber <b>OK</b> werden die �nderungen 
		�bernommen. Mit <b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.",
		
		5=>"<div align=\"center\"><H3>L�schen eines Ordners</H3></div>In dieser Maske hat der Benutzer die 
		M�glichkeit, bei einen bestehenden Ordner zu l�schen. Dazu mu� man nur das Kontroll K�stchen vor dem Ordner aktivieren 
		und auf l�schen klicken. �ber <b>OK</b> werden die �nderungen �bernommen. Mit 
		<b>Abbrechen</b> gelangt man zur�ck auf die vorherige Seite.");

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
		if($acl->acl_id!=NULL){
			echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
			echo "<div aling=\"center\"><H2><u>Browser Bedienung</u></H2></div><br/>";
		}
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
