<?php
require_once("config.inc.php");
require_once("mysql_class.inc.php");
require_once("user.inc.php");

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
    Header( "WWW-authenticate: Basic realm=\"Bitte \"Abbrechen\" drücken\"");
    Header( "HTTP/1.0 401 Unauthorized");

    session_start();
    unset($_SESSION["user"]);
    //unset($_SESSION["pass"]);
    session_destroy();
    

}

function getFileExtension($filename)
{
    $parts = explode(".", $filename);
     // .tar.gz .tar.bz2
    if (count($parts) == 3) {
        return $parts[1].".".$parts[2];
    } else if (count($parts) == 2) {
        return $parts[1];
    } else {
        return "";
    }
}


function getFileType($fspath)
{
    $bname = basename($fspath);
    $ext = getFileExtension($bname);

    $filetypes["pdf"] = "application/pdf";
    $filetypes["rtf"] = "application/rtf";
    $filetypes["doc"] = "application/msword";
    $filetypes["xls"] = "application/msexcel";
    $filetypes["ppt"] = "application/ms-powerpoint";
    $filetypes["rm"]  = "audio/x-pn-realaudio";
    $filetypes["ram"] = "audio/x-pn-realaudio";
    $filetypes["txt"] = "text/plain";
    $filetypes["zip"] = "application/zip";

    $retval = $filetypes[$ext];
    if ($retval == "") $retval = "application/force-download";

    return $retval;
}

function getFileIcon($fspath)
{
    $bname = basename($fspath);
    $ext = getFileExtension($bname);

    $filetypes["pdf"] = "ps.gif";
    $filetypes["rtf"] = "text.gif";
    $filetypes["doc"] = "doc.gif";
    $filetypes["txt"] = "text.gif";
    $filetypes["tar"] = "tar.gif";
    $filetypes["zip"] = "binhex.gif";

    $retval = @$filetypes[$ext];
    if ($retval == "") $retval = "unknown.gif";

    return $retval;
}

?>
