<?php

      include_once("/inc/zwei_listen.inc.php");
      
echo"
	<form method='POST' action='UserLoeschen.php'>

		<h2>User loeschen</h2>
		<hr/>
		<table>
			<tr>
				<td>
				Gruppe ausw�hlen:
				</td>

				<td>
				<select name='GruppenWaehlen' />
				</td>
			</tr>
		</table>

		<table>
			<tr>
				<td>
				Alle User:
				</td>

				<td>
				</td>

				<td>
				Ausgew�hlte User:
				</td>
			</tr>

			<tr>
				<td>
";

				links();

echo"
				</td>

				<td>
				<input type='submit' name='LinksRechts' value='>>' />
				<br>
				<input type='submit' name='RechtsLinks' value='<<' />
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
