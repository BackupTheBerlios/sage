<?php

      include_once("zwei_listen.inc.php");
      
echo"
	<form method='POST' action='GruppenRechteBearbeiten.php'>

		<h2>Gruppenrechte bearbeiten</h2>
		<hr>
		<table border='0'>
			<tr>
				<td>
				Gruppe ausw�hlen:
				</td>

				<td>
				<select name='GruppenWaehlen'>
				</td>
			</tr>
		</table>

		<table border='0'>
			<tr>
				<td>
				Alle Rechte:
				</td>

				<td>
				</td>

				<td>
				Ausgew�hlte Rechte:
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


?>