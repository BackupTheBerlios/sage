<?php
require_once("config.inc");

// ------------------------------- //
// thx to chamele0n.1@email.com    //
// ------------------------------- //
function redirectTo($newUrl)
{

  $newUrl = trim($newUrl);
  if (!(strpos($newUrl, "http://")
=== 0 || strpos($newUrl, "https://") === 0))
  {
      $newUrl = "http" 
              . ($_SERVER['HTTPS'] == "on" ? "s" :
"") 
              . "://" 
              . $_SERVER['HTTP_HOST']
              . (strpos($newUrl, "/") === 0? $newUrl :
dirname($_SERVER['PHP_SELF']) . "/" . $newUrl);
  } 

  header("Location: " . $newUrl);
  exit();
}

function handleMySQLError()
{
    $error = mysql_error();
    echo "MySQL error: $error()";
}

function setupSession()
{
    session_start();
    if (!isset($_SERVER["PHP_AUTH_USER"]) )
    	die("not authorized");
    $_SESSION["user"] = $_SERVER["PHP_AUTH_USER"];
    $_SESSION["pass"] = $_SERVER["PHP_AUTH_PW"];
}

function loggedIn()
{
    session_start();
    if (isset($_SESSION["user"])) return 1;
    
    return 0;
}

function destroySession()
{
    session_start();
    unset($_SESSION["user"]);
    unset($_SESSION["pass"]);
}

function printInhalt()
{
    global $db_hostname, $db_user, $db_password, $db_db;
    
    $link = mysql_pconnect($db_hostname, $db_user, $db_password)
    	    or die("keine db da");
    
    mysql_select_db($db_db) or die("der db-name stimmt nicht!");
    
    $query = "SELECT entry.name as name, poster as pname, category.name as cname, added"
    	     ." FROM entry, category"
	     ." WHERE category_id=category.id";
    
    $result = mysql_query($query) 
    	      or die("fehler in der abfrage!");
    
    echo '<table width="100%" border="0">';
    echo '<tr height="2" bgcolor="#000000"><td colspan="4"></td></tr>';
    echo '<tr><td>name...</td><td>poster...</td><td>kategorie...</td><td>added</td>';
    echo '<tr height="2" bgcolor="#000000"><td colspan="4"></td></tr>';
    
    while ($tupel = mysql_fetch_assoc($result)) {
    	$name = $tupel["name"];
	$pname = $tupel["pname"];
	$cname = $tupel["cname"];
	$added = $tupel["added"];
	
    	echo "<tr>";
	echo "<td>$name</td>";
	echo "<td>$pname</td>";
	echo "<td>$cname</td>";
	echo "<td>$added</td>";	
	echo "</tr>";
    }
    
    echo "</table>";
}

?>
