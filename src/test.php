<?PHP
/*Variablen Deklaration*/

//Page-Name
$PageName="SAGE";

/*Der Header wird mit eingebunden*/
require "header.inc";
?>

<?PHP
/*Ab hier der Hauptteil*/
?>

<html>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post" action="">
  <h1><u>Notiz erstellen</u></h1>
  <h1>&nbsp;</h1>
  <h1> 
    <textarea name="textfield" cols="100">Type in ... </textarea>
  </h1>
  <p>&nbsp;</p>
  <p> 
    <input type="submit" name="OK" value="Okay">
    <input type="submit" name="Abbrechen" value="Abbrechen">
  </p>
  </form>
<p>&nbsp;</p></body>
</body>
</html>

<?PHP
/*Der Rumpf wird mit eingebunden*/
require "futter.inc";
?>