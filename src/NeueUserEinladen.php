<?php

      include_once("/inc/zwei_listen.inc.php");
      
echo"
	<form method='POST' action='NeueUserEinladen.php'>

		<h2>Neue User einladen</h2>
		<hr>
		<table border='0'>
			<tr>
				<td>
				E-Mail-Adresse(n):
				</td>

				<td>
				<input type='text' name='EMail'>
				</td>
			</tr>
		</table>

		<table border='0'>
			<tr>
				<td>
				Alle Gruppen:
				</td>

				<td>
				</td>

				<td>
				Ausgew�hlte Gruppen:
				</td>
			</tr>

			<tr>
				<td>
";

				links();

echo"
				</td>

				<td>
				<input type='submit' name='LinksRechts' value='>>'>
				<br>
				<input type='submit' name='RechtsLinks' value='<<'>
				</td>

				<td>
";

				rechts($LinksRechts, $RechtsLinks);

echo"
				</td>
		    </tr>

		</table>

		<hr>
		<br>

		<table>
		<tr>
			<td>
			<input type='submit' value='OK' name='OK' style='WIDTH:90'>

			</td>

			<td width='20'>
			</td>

			<td>
			<input type='button' value='Abbrechen' name='Abbrechen' >
			</td>
		</tr>
	</form>
";


if ($OK == TRUE)
 
  if($EMail == NULL)
  {
    echo"Es wurde keine E-Mail-Adresse angegeben!";
    $OK = FALSE;
  }
  else
  {
    echo"Operation erfolgreich";
    $OK = FALSE;
    //Neuen User tempor�r einrichten und per E-Mail informieren
  }

?>
