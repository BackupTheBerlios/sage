<?php

echo <<<EOF
	<form method="POST" action="PasswortZurueck.php">

		<h2>User Passwort zurücksetzen</h2>
		<hr />
		<table>
						
			<tr>	
				<td>
				User-Name:
				</td>
				
				<td>
				<input type="text" name="UserName" />
				</td>
			</tr>
			
		</table>
		<hr />
		<br />
		<table>
		<tr>
			<td>
			<input type="submit"  value="OK" style="WIDTH:90" name="OK"/>
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
{
  if($UserName == NULL )
  {
    echo"Es wurde nicht alle Pflichtfelder ausgefuellt!";
    $OK = FALSE;
  }
}
?>
