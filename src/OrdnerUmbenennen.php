<?PHP

echo"
<h2>Ordner umbenennen</h2>

<form name='OrdnerName' method='post' action=''>
<table border = 0> 
	<tr>
		<td width='120'>
		<b>Ordner-Name:</b>
		</td>
		
		<td width ='240'>
		<input name='OrdnerName' size='47'> 
		</td>
	</tr>
	
	<tr>
		<td width='120' valign='top'>
		<b>Beschreibung:*</b>
		</td>
		
		<td width ='240'>
		<textarea cols='36' rows='10' name='Beschreibung'>
		</textarea> 
		</td>	
		
	</tr>
</table>
</form>

<table border = 0> 
	<tr>
		<td width='120'>
		<small>* optionale Felder</small>
		</td>
		
		<td width='120'>
		<input type='submit'  value='OK' style='WIDTH:90' >
		
		</td>
		
		<td width='120'>
		<input type='submit'  value='Abbrechen' style='WIDTH:90' >
		</td>
	</tr>
</table>
";

?>