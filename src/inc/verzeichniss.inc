require "mysql_class.inc";

$linkRechteListe=array(
    "<div align=\"center\"><a href=\"test.php\">Notiz erstellen</a></div><br>",
    "<div align=\"center\"><a href=\"test.php\">Neues Dokument</a></div><br>",
    "<div align=\"center\"><a href=\"test.php\">Neuer Ordner</a></div><br>",
    "<div align=\"center\"><a href=\"test.php\">Ordner umbenennen</a></div><br>",
    "<div align=\"center\"><a href=\"test.php\">Admin Tools</a></div><br>",
    "<div align=\"center\"><a href=\"test.php\">Datei Anlegen</a></div><br>",
    "<div align=\"center\"><a href=\"test.php\">Datei loeschen</a></div><br>",
    "<div align=\"center\"><a href=\"test.php\">Datei umbenennen</a></div><br>"
);

//Erzeuge ein neues Element von der DB ...
//Connecte ... 
$db= new DB;
$db->db_connect();

//User Name + Zugriff auf welchen Ordner
//Diese Daten muessen noch aus der DB geholt werden ...
$user_name="kf0fhomer";
$user_path="KF0F";

//Select Befehl um alle Rechte des Users herauszubekommen...
$querry="SELECT delete_path,  write_path,  read_path,  rename_path,  read_file,  write_file,  delete_file,  rename_file FROM sage_acl,sage_user WHERE sage_user.loginname=\"$user_name\" AND sage_acl.path=\"$user_path\" AND sage_acl.user_id=sage_user.user_id;";

$linkArray=$db->db_select_rechte($querry);

// Aktuelle Rechte werden mit den zugehoerigen Link-Namen in das
// Array geschrieben!

$zaeh=count($linkArray);	
for($b=0;$b<$zaeh;$b++){
    $zahl=$linkArray[$b];
    $linkArray[$b]=$linkRechteListe[$zahl];
}
