<?php

echo<<<EOF
<h2>Datei bearbeiten</h2>

<form name="DateiBearbeiten" method="post" action="DateiBearbeiten.php">
<table>
	<tr>
		<td width="120">
		<b>Datei bearbeiten:</b>
		</td>

		<td width ="240">
		<input name="DateiBearbeiten" size="47" value="$DateiBearbeiten" />
		</td>
	</tr>

	<tr>
		<td width="120" valign="top">
		<b>Beschreibung:</b>
		</td>
		
		<td width ="240">
		<textarea cols="36" rows="10" name="Beschreibung">
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

if ($OK == TRUE)
{
  if($DateiBearbeiten == NULL | $Beschreibung == NULL )
  {
    echo"Es wurden nicht alle Pflichtfelder ausgefuellt!";
    $OK = FALSE;
  }
  else
  {
    echo"Operation erfolgreich";
    $OK = FALSE;
    //Datei hochladen
  }
}
?>
