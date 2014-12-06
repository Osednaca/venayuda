<?php

session_start();

/* Establecemos que las paginas no pueden ser cacheadas */
header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

 if (isset($_SESSION['agent']))  
 {  
   if ($_SESSION['agent'] != sha1($_SERVER['HTTP_USER_AGENT']))  
   {  
     exit;  
   }  
 } 

if (isset($_SESSION['IPaddress']))  
 {  
   if ($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR'])  
   {  
     exit;  
   }  
 } 

 if(!isset($_SESSION["idusuario"])){
 	header("Location: index.php?error=1");
 }

$idusuario = $_SESSION["idusuario"];

function logOut() {
	session_unset();
	session_destroy();
	session_start();
	session_regenerate_id(true);
}

?>