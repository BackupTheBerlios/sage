<?php
          
      include_once("zwei_listen.inc.php");
      
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
				<input type='text' name='GruppenName'>
				</td>
			</tr>
		</table>

		<table border='0'>
			<tr>
				<td width='240'>
				Alle Rechte:
				</td>

				<td>
				</td>

				<td width='240'>
				Ausgewählte Rechte:
				</td>
			</tr>

			<tr>
				<td width='240'>
";

				links();

echo"
				</td>

				<td>
				<input type='submit' name='LinksRechts' value='>>'>
				<br>
				<input type='submit' name='RechtsLinks' value='<<'>
				</td>

				<td width='240'>
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
