<?PHP

	echo"	
	<form method='POST' action='UserEinrichtenCheck.php'>
		
		<h2>User Anmeldemaske</h2>
		<hr>
		<table>
						
			<tr>	
				<td>
				Altes Passwort:
				</td>
				
				<td>
				<input type='password' name='AltesPasswort'>
				</td>
			</tr>
			
			<tr>	
				<td>
				Neues Passwort:
				</td>
				
				<td>
				<input type='password' name='NeuesPasswort'>
				</td>
			</tr>
	
			<tr>	
				<td>
				Neues Passwort (wdh):
				</td>
				
				<td>
				<input type='password' name='NeuesPasswortWdh'>
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