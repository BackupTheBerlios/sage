<?PHP

	echo"	
	<form method='POST' action='UserEinrichtenCheck.php'>
		
		<h2>User Anmeldemaske</h2>
		<hr>
		<table>
			<tr>
				<td>
				User-Name:
				</td>
				
				<td>
				<input type='text' name='UserName'>
				</td>
			</tr>
			
			<tr>	
				<td>
				Passwort:
				</td>
				
				<td>
				<input type='password' name='Passwort'>
				</td>
			</tr>
			
			<tr>	
				<td>
				Passwort (wdh):
				</td>
				
				<td>
				<input type='password' name='PasswortWdh'>
				</td>
			</tr>
	
			<tr>	
				<td>
				Nachname:
				</td>
				
				<td>
				<input type='text' name='Nachname'>
				</td>
			</tr>
			
			<tr>	
				<td>
				Vorname:
				</td>
				
				<td>
				<input type='text' name='Vorname'>
				</td>
			</tr>
			
			<tr>	
				<td>
				E-Mail:
				</td>
				
				<td>
				<input type='text' name='EMail'>
				</td>
			</tr>
		
		</table>
		<hr>
		<br>
		<table>
		<tr>
			<td>		
			<input type='submit'  value='OK' style='WIDTH:90' >
			
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