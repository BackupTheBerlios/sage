<?php

echo <<<EOF
<h2>Ordner umbenennen</h2>
<form  method="POST" action="OrdnerUmbenennen.php">
<table>
	<tr>
		<td width="120">
		<b>Ordner-Name:</b>
		</td>
		
		<td width ="240">
		<input name="OrdnerName" size="47" value="$OrdnerName" />
		</td>
	</tr>
	
	<tr>
		<td width="120" valign="top">
		<b>Beschreibung:</b>
		</td>
		
		<td width ="240">
		<textarea cols="36" rows="10" name="OrdnerBeschreibung" value="$Beschreibung">
		</textarea> 
		</td>	
		
	</tr>
</table>
<table>
	<tr>
		<td width="120">
	        </td>
		
		<td width="120">
		<input type="submit"  value="OK" style="WIDTH:90" name="OK" />
		</td>
		
		<td width="120">
		<input type="submit"  value="Abbrechen" style="WIDTH:90" />
		</td>
	</tr>
       
</table>
</form>
EOF;

if($OK == TRUE)
{
  if ($OrdnerName == NULL | $OrdnerBeschreibung == NULL)
  {
    echo"Es wurden nicht alle Pflichtfelder ausgefuellt!";
    $OK = FALSE;
  }
  else
  {
    echo"Operation erfolgreich";
    $OK = FALSE;
    //Ordner tatsächlich umbenennen
  }
}
?>
