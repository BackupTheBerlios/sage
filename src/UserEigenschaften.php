<?php

echo <<<EOF
	<form method="POST" action="UserEigenschaften.php">
		
		<h2>User Eigenschaften ändern</h2>
		<hr />
		<table>

			<tr>	
				<td>
				Altes Passwort:
				</td>
				
				<td>
				<input type="password" name="AltesPasswort" value="$AltesPasswort" />
				</td>
			</tr>
			
			<tr>	
				<td>
				Neues Passwort:
				</td>
				
				<td>
				<input type="password" name="NeuesPasswort" value="$NeuesPasswort" />
				</td>
			</tr>

			<tr>
				<td>
				Neues Passwort (wdh):
				</td>

				<td>
				<input type="password" name="NeuesPasswortWdh" value="$NeuesPasswortWdh" />
				</td>
			</tr>

			<tr>
				<td>
				E-Mail:
				</td>
				
				<td>
				<input type="text" name="EMail" value="$EMail" />
				</td>
			</tr>
		
		</table>
		<hr />
		<br />
		<table>
		<tr>
			<td>		
			<input type="submit"  value="OK" style="WIDTH:90" name="OK" />
			
			</td>
			
			<td width="20">
			</td>
			
			<td>
			<input type="button" value="Abbrechen" name="Abbrechen" />
			</td>
		</tr>
	<input type="hidden" name="gesendet" value="1" />
	</form>
EOF;


if($OK == TRUE)
{
  if ($AltesPasswort == NULL | $NeuesPasswort == NULL | $NeuesPasswortWdh == NULL | $EMail == NULL)
  {
    echo"Es wurden nicht alle Pflichtfelder ausgefuellt!";
    $OK = FALSE;
  }
  else
  if ($NeuesPasswort != $NeuesPasswortWdh)
  {
    echo"Die neuen Passwoerter muessen identisch sein!";
    $OK = FALSE;
  }
  else
  {
    echo"Operation erfolgreich";
    $OK = FALSE;
    
    //Daten in die Datenbank schreiben
  }
}

?>
