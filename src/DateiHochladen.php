<?PHP
echo"
<h2>Datei hochladen</h2>

<form name='DateiSuchen' method='post' action='collect.php'>
<table border = 0> 
	<tr>
		<td width='120'>
		<b>Lokale Datei:</b>
		</td>
		
		<td width='120'>
		<input name='LokaleDatei' size='25'> 
		</td>
		
		<td width='120' align='right'>
		<input type='button'  value='Durchsuchen' style='WIDTH:90' >
		</td>
	</tr>
</table>
</form>	

<form name='DateiInfo' method='post' action=''>
<table border = 0> 
	<tr>
		<td width='120'>
		<b>Name:*</b>
		</td>
		
		<td width ='240'>
		<input name='DateiName' size='47'> 
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


<table border = 0> 
	<tr>
		<td width='120'>
		<small>* optionale Felder</small>
		</td>
		
		<td width='120'>
		<input type='submit'  value='OK' style='WIDTH:90' >
		</td>
		
		<td width='120' align='left'>
		<input type='submit'  value='Abbrechen' style='WIDTH:90' >
		</td>
	</tr>
</table>
</form>
";

?>