<?php
	//Zur Fehler Ausgabe ... Diese wird dann durch die Funktion 
	//Ausgegeben.
    function fehlerausgabe($fehler){
    
	echo"
		<table border=\"0\" align=\"center\">
    		<tr> 
		    	<td><div align=\"center\"><u><b><H2>ERROR</H2></b></u></div>
				</td>
			</tr>
			<tr>
				<td>
				<div align=\"center\"><b>\" $fehler \"</b></div>
	      		</td>
	  		</tr>
		</table>";
    }
?>