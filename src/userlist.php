<?php
require_once("inc/functions.inc.php");

$pagename = "Benutzerliste";
require("inc/header.inc.php");
?>

<?php
  $fc_htpasswd=file($htpasswd);
  if (sizeof($fc_htpasswd)==0) {
   echo "<p>Noch keine Benutzer vorhanden!</p>";
  }
  else {
      echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" summary=\"\">\n";
      echo "<tr><td>\n";
      $fc_htgroup=file($htgroup);
      echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" summary=\"Benutzer je Gruppe\">\n";
      echo "<tr><th colspan=\"2\">Benutzer je Gruppe</th></tr>";
      for ($i=0;$i<sizeof($fc_htgroup);$i++){
          $user=explode(" ",trim($fc_htgroup[$i]));
          $group=str_replace(":","",$user[0]);
          $NrUser[$group]=sizeof($user) - 1;
          echo "<tr class=\"a\"><td>$group:</td><td>$NrUser[$group]</td></tr>\n";
      }
      echo "</table>\n";
      echo "</td><td>";
      echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" summary=\"Benutzerliste\">";
      echo "<tr><th>Name</th><th>Passwort gesetzt</th><th>Gruppe</th></tr>";
      for ($i=0;$i<sizeof($fc_htpasswd);$i++){
          $namen=explode(":",$fc_htpasswd[$i]);
          echo "<tr class=\"a\"><td>$namen[0]</td><td>";
          if (trim($namen[1]) == "") {
              echo "nein";
          } else {
              echo "ja";
          }
          $group="<em>Fehler</em>"; /* Falls User nicht in $htgroup gefunden wird. */
          for ($j=0;$j<sizeof($fc_htgroup);$j++){
              $fc_htgroup[$j] = ereg_replace("#.*","",trim($fc_htgroup[$j]));
	      if ($fc_htgroup[$j] == "") continue;
              $user=explode(" ",trim($fc_htgroup[$j]));
              if (in_array($namen[0],$user)) {
                  $group=str_replace(":","",$user[0]);
              }
          }
          echo "</td><td>$group</td></tr>";
      }
      echo "</table>";
      echo "</td></tr>\n</table>\n";
  }
?>


<?php
require("inc/footer.inc.php");
?>
