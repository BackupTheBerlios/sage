<?php

echo <<<EOF
<h2>Gruppe löschen</h2>

<form name="GruppeLoeschen" method="post" >
<table border = 0>
	<tr>
		<td width="120">
		<b>Gruppe wählen:</b>
		</td>
		
		<td width ="240">
		<select name="GruppeWaehlen" size="1"> 
                //Dummydaten
		<option>KF0F
		<option>KF05
		<option>KF04
		</select>
		</td>
	</tr>
</table>
</form>

<table border = 0>
	<tr>
		<td width="120">
		<input type="submit"  value="OK" style="WIDTH:90" >
                </td>
		
		<td width="120">
		<input type="submit"  value="Abbrechen" style="WIDTH:90" >
		</td>
	</tr>
</table>
EOF;

?>
