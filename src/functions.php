<?php
require_once("config.inc");
require_once("db/mysql_class.php");
require_once("user.inc");

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

function doLogin($username)
{
    $usr = new User;
    if ($usr->selectByName($username) == false) die("No such user in DB");
    if ($usr->password != crypt($_SERVER["PHP_AUTH_PW"], $usr->password)) die ("Wrong password");
    
    $_SESSION["user"] = $usr;
}
function setupSession()
{
    session_start();
    if (!isset($_SERVER["PHP_AUTH_USER"]) )
    	die("Not authorized by HTTP server");
    	
    doLogin($_SERVER["PHP_AUTH_USER"]);
}

function loggedIn()
{
    session_start();
    if (isset($_SESSION["user"])) return 1;
    
    return 0;
}

function doLogout()
{
    session_start();
    unset($_SESSION["user"]);
    unset($_SESSION["pass"]);
}

?>
