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
		
		$hilfe_admin_text=array(
		
		0=>"<div align=\"center\"><H3>Gruppe Einrichten</H3></div>In dieser Maske kann eine neue Benutzergruppe
		 angelegt und mit Rechten versehen werden. Die linke Spalte	<b>Alle Rechte</b> zeigt alle verfügbaren 
		Berechtigungen an, die vergeben werden können. Die rechte Spalte <b>Ausgewählte Rechte</b> enthält die
		 Berechtigungen, die der Gruppe zugewiesen sind. Über die Schaltflächen <b>\"<<\"</b>  <b>\">>\"</b> können 
		der Gruppe Berechtigungen gegeben bzw. genommen werden. Neue Gruppen können nur von Usern erstellt werden, die
		 selber über die Berechtigung <b>Neue Gruppe einrichten</b> verfügen. Mit <b>OK</b> werden die Eingaben
		 bestätigt und die Gruppe erstellt. Mit <b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.",


      	1=>"<div align=\"center\"><H3>Gruppenrechte bearbeiten</H3></div>In dieser Maske kann eine bestehende 
		Benutzergruppe ausgewählt werden und neue Berechtigungen erhalten bzw. entfernt werden. Die linke Spalte <b>
		Alle Rechte</b> zeigt alle verfügbaren Berechtigungen an, die vergeben werden können. Die rechte Spalte <b>
		Ausgewählte Rechte</b> enthält die Berechtigungen, die der Gruppe bereits zugewiesen sind. Über die Schaltflächen 
		<b>\"<<\"</b> <b>\">>\"</b> können der Gruppe Berechtigungen gegeben bzw. genommen werden. Die Gruppenrechte können
	 	nur von Usern verändert werden, die selber über die Berechtigung <b>Gruppenrechte bearbeiten</b> verfügen. Mit
	 	<b>OK</b> werden die Eingaben bestätigt und die neuen Berechtigungen der Gruppe zugewiesen. Mit <b>Abbrechen</b> 
		gelangt man zurück auf die vorherige Seite.	",
        
		2=>"<div align=\"center\"><H3>Löschen einer Gruppe</H3></div>In dieser Maske kann eine bestehende 
		Benutzergruppe gelöscht werden. Die zu löschende Gruppe wird in der ComboBox ausgewählt. Mit <b>OK</b> wird die
	 	ausgewählte Gruppe gelöscht. Mit <b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.",
	    
        3=>"<div align=\"center\"><H3>Mitglieder einer Gruppe zuordnen</H3></div>In dieser Maske kann eine bestehende
	 	Benutzergruppe ausgewählt werden und ihr neuer User zugefügt bzw. entfernt werden. Die linke Spalte <b>Alle User</b>
 		zeigt alle verfügbaren User an, die sich im System befinden. Die rechte Spalte <b>Ausgewählte User</b> enthält die 
		User, die der Gruppe bereits zugewiesen sind. Über die Schaltflächen <b>\"<<\"</b> <b>\">>\"</b> können der Gruppe User 
		hinzugefügt bzw. entfernt werden. Die Gruppenmitglieder können nur von Usern verändert werden, die selber über die 
		Berechtigung <b>Gruppenmitglieder bearbeiten</b> verfügen. Mit <b>OK</b> werden die Eingaben bestätigt und die neuen 
		User der Gruppe zugewiesen. Mit <b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.",
     	
		4=>"<div align=\"center\"><H3>User einrichten</H3></div>Über diese Maske kann ein User eingerichtet werden. 
		Alle Felder sind Pflichtfelder. Mit Hilfe des User-Namen und des Passwortes, was zwei mal eingegeben werden muß, kann 
		der User sich an dem System anmelden. Der Name und Vorname wird benutzt, um den User eindeutig identifizieren zu 
		können. Durch Eingabe der E-Mail Adresse bekommt der User seine Registrierungs-Daten per E-Mail zugeschickt. Mit dem 
		Button <b>OK</b> bestätigt man die Eingabe und der User wird in der Datenbank angelegt. Mit <b>Abbrechen</b> gelangt 
		man zurück auf die vorherige Seite.",

        5=>"<div align=\"center\"><H3>User Eigenschaften bearbeiten</H3></div>Über diese Maske kann der User seine 
		Eigenschaften ändern. Möchte der User sein Passwort ändern, kann man mit Hilfe der ersten drei Felder ein neues 
		Passwort setzen. Hat sich die E-Mail Adresse des Users geändert, kann diese in dem Feld E-Mail geändert werden. Mit 
		dem Button <b>OK</b> bestätigt man die Eingabe und die Daten des Users werden in der Datenbank gespeichert. Mit 
		<b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.",

        6=>"<div align=\"center\"><H3>User löschen</H3></div>Über diese Maske kann ein oder mehrere User komplett
	 	aus dem System gelöscht werden. Hierfür muss die Gruppe ausgewählt werden, in der sich der User befindet. Die zu 
		löschenden User werden unter <b>Alle User:</b> markiert und über <b>\">>\"</b> den <b>Ausgewählten User:</b> zugefügt. 
		Mit dem Button <b>OK</b> wird die Löschung der <b>Ausgewählten User</b> veranlasst. Mit <b>Abbrechen</b> gelangt man 
		zurück auf die vorherige Seite.",

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

		0=>"<div align=\"center\"><H3>Einfügen einer neuen Datei</H3></div>In dieser Maske hat der Benutzer die 
		Möglichkeit eine neue Datei auf den Server hochzuladen. Den Pfad für die Datei kann unter <b>Lokale Datei</b>
		eingegeben werden oder die entsprechende Datei über den Button <b>Durchsuchen</b> ausgewählt werden. <b>Lokale
	 	Datei</b>, <b>Dokumenten-Name</b>, <b>Beschreibung</b> sind Pflichtfelder. Über <b>OK</b> werden die Eingaben 
		bestätigt und die Datei auf den Server hoch geladen. Mit <b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.",

		1=>"<div align=\"center\"><H3>Bearbeiten einer Datei</H3></div>In dieser Maske hat der Benutzer die 
		Möglichkeit bei einer existierenden Datei, den Dokumenten-Namen und die Beschreibung abzuändern. <b>Dokumenten-Name
		</b>und <b>Beschreibung</b> sind Pflichtfelder. Über <b>OK</b> werden die Änderungen bestätigt und auf dem Server 
		gespeichert. Mit <b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.",

		2=>"<div align=\"center\"><H3>Löschen einer Datei</H3></div>In dieser Maske hat der Benutzer die 
		Möglichkeit bei eine existierende Datei zu löschen. Dazu muß man nur das Kontroll Kästchen vor der Datei aktivieren 
		und auf löschen klicken. Über <b>OK</b> werden die Änderungen bestätigt und auf dem Server gespeichert. Mit <b>
		Abbrechen</b> gelangt man zurück auf die vorherige Seite.",
	
		3=>"<div align=\"center\"><H3>Einfügen eines neuen Ordners</H3></div>In dieser Maske hat der Benutzer die 
		Möglichkeit, in dem aktuellen Ordner in dem er sich befindet, einen neuen Ordner zu erstellen. <b>Ordner-Name</b> 
		und die <b>Beschreibung</b> des Ordners sind Pflichtfelder. Über <b>OK</b> werden die Eingaben bestätigt und der 
		Ordner auf dem Server erstellt. Mit <b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.",

		4=>"<div align=\"center\"><H3>Umbenennen eines Ordners</H3></div>In dieser Maske hat der Benutzer die 
		Möglichkeit, bei einen bestehenden Ordner den <b>Ordner-Name</b> bzw. die <b>Beschreibung</b> zu ändern.<b>
		Ordner-Name</b> ist ein Pflichtfeld, <b>Beschreibung</b> ist optional. Über <b>OK</b> werden die Änderungen 
		übernommen. Mit <b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.",
		
		5=>"<div align=\"center\"><H3>Löschen eines Ordners</H3></div>In dieser Maske hat der Benutzer die 
		Möglichkeit, bei einen bestehenden Ordner zu löschen. Dazu muß man nur das Kontroll Kästchen vor dem Ordner aktivieren 
		und auf löschen klicken. Über <b>OK</b> werden die Änderungen übernommen. Mit 
		<b>Abbrechen</b> gelangt man zurück auf die vorherige Seite.");

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
