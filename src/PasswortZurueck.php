<?PHP

	echo"	
	<form method='POST' action='UserEinrichtenCheck.php'>
		
		<h2>User Passwort zurücksetzen</h2>
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
			
		</table>
		<hr>
		<br>
		<table>
		<tr>
			<td>		
			<input type='submit'  value='OK' style='WIDTH:90'>
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