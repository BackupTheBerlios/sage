<?PHP

	echo"	
	<form method='POST' action='UserEinrichtenCheck.php'>
		
		<h2>Neue Gruppe einrichten</h2>
		<hr>
		<table border='0'>
			<tr>
				<td>
				Gruppenname:
				</td>
				
				<td>
				<input type='text' name='GruppenName'>
				</td>
			</tr>
		</table>
		
		<table border='0'>
			<tr>
				<td width='240'>
				Alle Rechte:
				</td>
				
				<td>
				</td>
				
				<td width='240'>
				Ausgewählte Rechte:
				</td>
			</tr>
			
			<tr>
				<td width='240'>
				<select name='AlleRechte' size='10' >
				<option>User einrichten</option>
				<option>User löschen</option>
				<option>Neue Gruppe einrichten</option>
				</select>
				</td>

				<td>
				<input type='button' name='LinksRechts' value='>>'>
				<br>
				<input type='button' name='RechtsLinks' value='<<'>
				</td>
		   
				<td width='240'>
				<select name='AlleRechte' size='10'>
				<option>User einrichten</option>
				</select>
				</td>
		    </tr>
			
		</table>
		
		<hr>
		<br>
		
		<table>
		<tr>
			<td>		
			<input type='submit' value='     OK     ' name='OK' >
			
			</td>
			
			<td width='20'>
			</td>
			
			<td>
			<input type='button' value='Abbrechen' name='Abbrechen' >
			</td>
		</tr>
	<input type='hidden' name='gesendet' value='1'>
	</form>
	";



?>