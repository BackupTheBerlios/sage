<?php
echo"
<h2>Neuen Ordner erstellen</h2>

<form method='POST' action='NeuerOrdner.php'>
<table>
	<tr>
		<td width='120'>
		<b>Ordner-Name:</b>
		</td>
		
		<td width ='240'>
		<input name='OrdnerName' size='47' value='$OrdnerName'>
		</td>
	</tr>
	
	<tr>
		<td width='120' valign='top'>
		<b>Beschreibung:</b>
		</td>
		
		<td width ='240'>
		<textarea cols='36' rows='10' name='Beschreibung' value='$Beschreibung'>
		</textarea> 
		</td>	
		
	</tr>
</table>
 
<table>
	<tr>
		<td width='120'>
	        </td>
		
		<td width='120'>
		<input type='submit'  value='OK' style='WIDTH:90' name='OK'>
		</td>
		
		<td width='120' align='left'>
		<input type='submit'  value='Abbrechen' style='WIDTH:90' >
		</td>
	</tr>
</table>
</form>
";

if($OK == TRUE)
{
  if ($OrdnerName == NULL | $Beschreibung == NULL)
  {
    echo"Es wurden nicht alle Pflichtfelder ausgefuellt!";
    $OK = FALSE;
  }
  else
  {
    echo"Operation erfolgreich";
    $OK = FALSE;
    //Ordner tatsächlich erstellen
  }
}?>
