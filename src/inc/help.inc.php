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
        //MAIL=>mailing("MAIL"),
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
		 angelegt und mit Rechten versehen werden. Die linke Spalte	<b>Alle Rechte</b> zeigt alle verf&uuml;gbaren 
		Berechtigungen an, die vergeben werden k&ouml;nnen. Die rechte Spalte <b>Ausgew&auml;hlte Rechte</b> enth&auml;lt die
		 Berechtigungen, die der Gruppe zugewiesen sind. &Uuml;ber die Schaltfl&auml;chen <b>\"<<\"</b>  <b>\">>\"</b> k&ouml;nnen 
		der Gruppe Berechtigungen gegeben bzw. genommen werden. Neue Gruppen k&ouml;nnen nur von Usern erstellt werden, die
		 selber &uuml;ber die Berechtigung <b>Neue Gruppe einrichten</b> verf&uuml;gen. Mit <b>OK</b> werden die Eingaben
		 best&auml;tigt und die Gruppe erstellt. Mit <b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",


      	1=>"<div align=\"center\"><H3>Gruppenrechte bearbeiten</H3></div>In dieser Maske kann eine bestehende 
		Benutzergruppe ausgew&auml;hlt werden und neue Berechtigungen erhalten bzw. entfernt werden. Die linke Spalte <b>
		Alle Rechte</b> zeigt alle verf&uuml;gbaren Berechtigungen an, die vergeben werden k&ouml;nnen. Die rechte Spalte <b>
		Ausgew&auml;hlte Rechte</b> enth&auml;lt die Berechtigungen, die der Gruppe bereits zugewiesen sind. &Uuml;ber die Schaltfl&auml;chen 
		<b>\"<<\"</b> <b>\">>\"</b> k&ouml;nnen der Gruppe Berechtigungen gegeben bzw. genommen werden. Die Gruppenrechte k&ouml;nnen
	 	nur von Usern ver&auml;ndert werden, die selber &uuml;ber die Berechtigung <b>Gruppenrechte bearbeiten</b> verf&uuml;gen. Mit
	 	<b>OK</b> werden die Eingaben best&auml;tigt und die neuen Berechtigungen der Gruppe zugewiesen. Mit <b>Abbrechen</b> 
		gelangt man zur&uuml;ck auf die vorherige Seite.	",
        
		2=>"<div align=\"center\"><H3>L&ouml;schen einer Gruppe</H3></div>In dieser Maske kann eine bestehende 
		Benutzergruppe gel&ouml;scht werden. Die zu l&ouml;schende Gruppe wird in der ComboBox ausgew&auml;hlt. Mit <b>OK</b> wird die
	 	ausgew&auml;hlte Gruppe gel&ouml;scht. Mit <b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",
	    
        3=>"<div align=\"center\"><H3>Mitglieder einer Gruppe zuordnen</H3></div>In dieser Maske kann eine bestehende
	 	Benutzergruppe ausgew&auml;hlt werden und ihr neuer User zugef&uuml;gt bzw. entfernt werden. Die linke Spalte <b>Alle User</b>
 		zeigt alle verf&uuml;gbaren User an, die sich im System befinden. Die rechte Spalte <b>Ausgew&auml;hlte User</b> enth&auml;lt die 
		User, die der Gruppe bereits zugewiesen sind. &Uuml;ber die Schaltfl&auml;chen <b>\"<<\"</b> <b>\">>\"</b> k&ouml;nnen der Gruppe User 
		hinzugef&uuml;gt bzw. entfernt werden. Die Gruppenmitglieder k&ouml;nnen nur von Usern ver&auml;ndert werden, die selber &uuml;ber die 
		Berechtigung <b>Gruppenmitglieder bearbeiten</b> verf&uuml;gen. Mit <b>OK</b> werden die Eingaben best&auml;tigt und die neuen 
		User der Gruppe zugewiesen. Mit <b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",
     	
		4=>"<div align=\"center\"><H3>User einrichten</H3></div>&Uuml;ber diese Maske kann ein User eingerichtet werden. 
		Alle Felder sind Pflichtfelder. Mit Hilfe des User-Namen und des Passwortes, was zwei mal eingegeben werden muß, kann 
		der User sich an dem System anmelden. Der Name und Vorname wird benutzt, um den User eindeutig identifizieren zu 
		k&ouml;nnen. Durch Eingabe der E-Mail Adresse bekommt der User seine Registrierungs-Daten per E-Mail zugeschickt. Mit dem 
		Button <b>OK</b> best&auml;tigt man die Eingabe und der User wird in der Datenbank angelegt. Mit <b>Abbrechen</b> gelangt 
		man zur&uuml;ck auf die vorherige Seite.",

        5=>"<div align=\"center\"><H3>User Eigenschaften bearbeiten</H3></div>&Uuml;ber diese Maske kann der User seine 
		Eigenschaften &auml;ndern. M&ouml;chte der User sein Passwort &auml;ndern, kann man mit Hilfe der ersten drei Felder ein neues 
		Passwort setzen. Hat sich die E-Mail Adresse des Users ge&auml;ndert, kann diese in dem Feld E-Mail ge&auml;ndert werden. Mit 
		dem Button <b>OK</b> best&auml;tigt man die Eingabe und die Daten des Users werden in der Datenbank gespeichert. Mit 
		<b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",

        6=>"<div align=\"center\"><H3>User l&ouml;schen</H3></div>&Uuml;ber diese Maske kann ein oder mehrere User komplett
	 	aus dem System gel&ouml;scht werden. Hierf&uuml;r muss die Gruppe ausgew&auml;hlt werden, in der sich der User befindet. Die zu 
		l&ouml;schenden User werden unter <b>Alle User:</b> markiert und &uuml;ber <b>\">>\"</b> den <b>Ausgew&auml;hlten User:</b> zugef&uuml;gt. 
		Mit dem Button <b>OK</b> wird die L&ouml;schung der <b>Ausgew&auml;hlten User</b> veranlasst. Mit <b>Abbrechen</b> gelangt man 
		zur&uuml;ck auf die vorherige Seite.",

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

		if($acl->acl_id!=NULL){
			echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
			echo "<div aling=\"center\"><H2><u>Beschreibung der Admin Tools</u></H2></div><br/>";
		}
		for($a=0;$a<8;$a++){
			if($acl->delete_path==1){
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
		
		$hilfe_admin_text=array(0=>"<div align=\"center\"><H3>Benutzung des Kalendars</H3></div>");

		$hilfe_admin_screen=array(0=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);
        $recht[0]=$acl->delete_path;

		if($acl->acl_id!=NULL){
			echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
			echo "<div aling=\"center\"><H2><u>Bendienung des Kalendars</u></H2></div><br/>";
		}

		for($a=0;$a<8;$a++){
			if($acl->delete_path==1){
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
		
		$hilfe_admin_text=array(0=>"<div align=\"center\"><H3>MAIL</H3></div>");

		$hilfe_admin_screen=array(0=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);

		if($acl->acl_id!=NULL){
			echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
			echo "<div aling=\"center\"><H2><u>MAIL</u></H2></div><br/>";
		}
		for($a=0;$a<8;$a++){
			if($acl->delete_path==1){
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

		0=>"<div align=\"center\"><H3>Einf&uuml;gen einer neuen Datei</H3></div>In dieser Maske hat der Benutzer die 
		M&ouml;glichkeit eine neue Datei auf den Server hochzuladen. Den Pfad f&uuml;r die Datei kann unter <b>Lokale Datei</b>
		eingegeben werden oder die entsprechende Datei &uuml;ber den Button <b>Durchsuchen</b> ausgew&auml;hlt werden. <b>Lokale
	 	Datei</b>, <b>Dokumenten-Name</b>, <b>Beschreibung</b> sind Pflichtfelder. &Uuml;ber <b>OK</b> werden die Eingaben 
		best&auml;tigt und die Datei auf den Server hoch geladen. Mit <b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",

		1=>"<div align=\"center\"><H3>Bearbeiten einer Datei</H3></div>In dieser Maske hat der Benutzer die 
		M&ouml;glichkeit bei einer existierenden Datei, den Dokumenten-Namen und die Beschreibung abzu&auml;ndern. <b>Dokumenten-Name
		</b>und <b>Beschreibung</b> sind Pflichtfelder. &Uuml;ber <b>OK</b> werden die Änderungen best&auml;tigt und auf dem Server 
		gespeichert. Mit <b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",

		2=>"<div align=\"center\"><H3>L&ouml;schen einer Datei</H3></div>In dieser Maske hat der Benutzer die 
		M&ouml;glichkeit bei eine existierende Datei zu l&ouml;schen. Dazu muß man nur das Kontroll K&auml;stchen vor der Datei aktivieren 
		und auf l&ouml;schen klicken. &Uuml;ber <b>OK</b> werden die Änderungen best&auml;tigt und auf dem Server gespeichert. Mit <b>
		Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",
	
		3=>"<div align=\"center\"><H3>Einf&uuml;gen eines neuen Ordners</H3></div>In dieser Maske hat der Benutzer die 
		M&ouml;glichkeit, in dem aktuellen Ordner in dem er sich befindet, einen neuen Ordner zu erstellen. <b>Ordner-Name</b> 
		und die <b>Beschreibung</b> des Ordners sind Pflichtfelder. &Uuml;ber <b>OK</b> werden die Eingaben best&auml;tigt und der 
		Ordner auf dem Server erstellt. Mit <b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",

		4=>"<div align=\"center\"><H3>Umbenennen eines Ordners</H3></div>In dieser Maske hat der Benutzer die 
		M&ouml;glichkeit, bei einen bestehenden Ordner den <b>Ordner-Name</b> bzw. die <b>Beschreibung</b> zu &auml;ndern.<b>
		Ordner-Name</b> ist ein Pflichtfeld, <b>Beschreibung</b> ist optional. &Uuml;ber <b>OK</b> werden die Änderungen 
		&uuml;bernommen. Mit <b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.",
		
		5=>"<div align=\"center\"><H3>L&ouml;schen eines Ordners</H3></div>In dieser Maske hat der Benutzer die 
		M&ouml;glichkeit, bei einen bestehenden Ordner zu l&ouml;schen. Dazu muß man nur das Kontroll K&auml;stchen vor dem 
		Ordner aktivieren und auf l&ouml;schen klicken. &Uuml;ber <b>OK</b> werden die Änderungen &uuml;bernommen. Mit 
		<b>Abbrechen</b> gelangt man zur&uuml;ck auf die vorherige Seite.");

		$hilfe_admin_screen=array(0=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);

		if($acl->acl_id!=NULL){
			echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
			echo "<div aling=\"center\"><H2><u>Browser Bedienung</u></H2></div><br/>";
		}
		for($a=0;$a<8;$a++){
			if($acl->delete_path==1){
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
		
		$hilfe_admin_text=array(
		
		0=>"<div align=\"center\"><H3>Hilfe ueber die Hilfe</H3></div>Mit Hilfe dieses Moduls kann der User bei
		Schwierigkeiten die Bedienung der einzelnen Masken nachlesen.");

		$hilfe_admin_screen=array(0=>"");
		
	 	$acl=new ACL;
        $acl=@$_SESSION["user"]->getACLByPath($ModulName);

		if($acl->acl_id!=NULL){
			echo "<table border=\"0\" align=\"center\"><tr><td><div align=\"center\">";
			echo "<div aling=\"center\"><H2><u>Hilfe</u></H2></div><br/>";
		}
		for($a=0;$a<8;$a++){
			if($acl->delete_path==1){
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
