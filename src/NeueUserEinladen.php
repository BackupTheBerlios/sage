<?php

      include_once("/inc/zwei_listen.inc.php");
      
echo <<<EOF
	<form method="POST" action="NeueUserEinladen.php">

		<h2>Neue User einladen</h2>
		<hr />
		<table border="0">
			<tr>
				<td>
				E-Mail-Adresse(n):
				</td>

				<td>
				<input type="text" name="EMail" />
				</td>
			</tr>
		</table>

		<table border="0">
			<tr>
				<td>
				Alle Gruppen:
				</td>

				<td>
				</td>

				<td>
				Ausgewählte Gruppen:
				</td>
			</tr>

			<tr>
				<td>
EOF;

				links();

echo <<<EOF
				</td>

				<td>
				<input type="submit" name="LinksRechts" value=">>" />
				<br>
				<input type="submit" name="RechtsLinks" value="<<" />
				</td>

				<td>
EOF;

				rechts($LinksRechts, $RechtsLinks);

echo <<<EOF
				</td>
		    </tr>

		</table>

		<hr />
		<br />

		<table>
		<tr>
			<td>
			<input type="submit" value="OK" name="OK" style="WIDTH:90" />

			</td>

			<td width="20">
			</td>

			<td>
			<input type="button" value="Abbrechen" name="Abbrechen" />
			</td>
		</tr>
	</form>
EOF;


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
    //Neuen User temporär einrichten und per E-Mail informieren
  }

?>
