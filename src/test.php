<?php
     /*Variablen Deklaration*/
     $PageName="Notiz erstellen";
     require_once "inc/header.inc.php";
     require_once "inc/leftnav.inc.php";
?>

<!-- Hauptteil -->

<html>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post" action="">
  <h1><u>Notiz erstellen</u></h1>
  <h1>&nbsp;</h1>
  <h1>
    <textarea name="textfield" cols="50">Type in ... </textarea>
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

<?php
     /*Der Rumpf wird mit eingebunden*/
     require_once "inc/footer.inc.php";
?>
