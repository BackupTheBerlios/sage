<?php

echo <<<EOF
<h2>Datei hochladen</h2>

<form name="DateiSuchen" method="post" action="DateiHochladen.php">
<table border = 0>
	<tr>
		<td width="100">
		<b>Lokale Datei:</b>
		</td>
		
		<td width="280">
		<input type="file" name="FileUpload" size="30" accept="Mime-Type" value="$file"/>
		</td>
	</tr>
</table>


<table border = 0>
	<tr>
		<td width="100">
		<b>Name:</b>
		</td>

		<td width ="280">
		<input name="FileName" size="52" value="$FileName"/>
		</td>
	</tr>

	<tr>
		<td width="100" valign="top">
		<b>Beschreibung:</b>
		</td>

		<td width ="280">
		<textarea cols="39" rows="10" name="FileDescription">
		</textarea>
		</td>

	</tr>
</table>

<table border = 0>
	<tr>
		<td width="100">
                </td>

		<td width="140">
		<input type="submit"  name="FileOK" value="OK" style="WIDTH:90" />
		</td>

		<td width="140" align="left">
		<input type="button" name="FileCancle" value="Abbrechen" style="WIDTH:90" />
		</td>
	</tr>
</table>
</form>
EOF;

if ($FileOK == TRUE)
{
  if($FileUpload == NULL | $FileName == NULL | $FileDescription == NULL )
  {
    echo"Es wurde nicht alle Pflichtfelder ausgefuellt!";
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
