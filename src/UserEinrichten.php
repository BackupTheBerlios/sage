<?php

	echo"
	<form method='POST' action='UserEinrichten.php'>

		<h2>User Einrichten</h2>
		<hr/>
		<table>
			<tr>
				<td>
				User-Name:
				</td>

				<td>
				<input type='text' name='UserName' value='$UserName'>
				</td>
			</tr>

			<tr>
				<td>
				Passwort:
				</td>

				<td>
				<input type='password' name='Passwort' value='$Passwort'>
				</td>
			</tr>

			<tr>
				<td>
				Passwort (wdh):
				</td>

				<td>
				<input type='password' name='PasswortWdh' value='$PasswortWdh'>
				</td>
			</tr>

			<tr>
				<td>
				Nachname:
				</td>

				<td>
				<input type='text' name='Nachname' value='$Nachname'>
				</td>
			</tr>

			<tr>
				<td>
				Vorname:
				</td>

				<td>
				<input type='text' name='Vorname' value='$Vorname'>
				</td>
			</tr>

			<tr>
				<td>
				E-Mail:
				</td>

				<td>
				<input type='text' name='EMail' value='$EMail'>
				</td>
			</tr>

		</table>
		<hr/>
		<br/>
		<table>
		<tr>
			<td>
			<input type='submit' style='WIDTH:90' value='OK' name='OK'>
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

if($OK == TRUE)
{ 
  if ($UserName == NULL | $Passwort == NULL | $PasswortWdh == NULL | $Nachname == NULL | $Vorname == NULL | $EMail == NULL)
  {
    echo"Es wurden nicht alle Pflichtfelder ausgefuellt!";
    $OK = FALSE;
  }
  else
  if ($Passwort != $PasswortWdh)
  {
    echo"Die neuen Passwoerter muessen identisch sein!";
    $OK = FALSE;
  }
  else
  {
    echo"Operation erfolgreich";
    $OK = FALSE;
    //User in der Datenbank anlegen
  }
}

?>
