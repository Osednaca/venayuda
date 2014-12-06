<?php
include("../includes/config.php");

$accion = $_REQUEST["accion"];

switch ($accion) {
	case 'existeusuario':
		$user = $_REQUEST["user"];
		$sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $query = $db->prepare($sql);
        $prepare = array($user);
        //var_dump($query);
        $result = $query->execute($prepare);
        $no_of_rows = $query->rowCount();
        if ($no_of_rows > 0) {
            // user existed 
            echo true;
        } else {
            // user not existed
            echo false;
        }
		break;
	
	case 'existecorreo':
		$mail = $_REQUEST["mail"];
		$sql = "SELECT * FROM usuarios WHERE email = ?";
        //echo $sql;
        $query = $db->prepare($sql);
        $prepare = array($mail);
        //var_dump($query);
        $result = $query->execute($prepare);
        $no_of_rows = $query->rowCount();
        if ($no_of_rows > 0) {
            // user existed 
            echo true;
        } else {
            // user not existed
            echo false;
        }
		break;
}

?>