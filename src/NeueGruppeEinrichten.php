<?php
      
      include_once("inc/zwei_listen.inc.php");
      
      
echo"
	<form method='POST' action='NeueGruppeEinrichten.php'>

		<h2>Neue Gruppe einrichten</h2>
		<hr>
		<table border='0'>
			<tr>
				<td>
				Gruppenname:
				</td>

				<td>
				<input type='text' name='GruppenName' size='30'>
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
				<input type='submit' name='LinksRechts' value='>>' \>
				<br>
				<input type='submit' name='RechtsLinks' value='<<' \>
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
