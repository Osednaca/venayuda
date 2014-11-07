<?php

$idpublicacion = $_REQUEST["idpublicacion"];
$idusuario 	   = $_SESSION["idusuario"];
$mensaje 	   = $_REQUEST["mensaje"];
$fecharegistro = date("Y-m-d H:i:s");

$sql 		 = "SELECT idusuario FROM publicacion WHERE idpublicacion=?";
//echo $sql;
$query 		 = $db->prepare($sql);
$prepare 	 = array($idpublicacion);
$result 	 = $query->execute($prepare);
$Publicacion = $query->fetch(PDO::FETCH_ASSOC);

$sql = "INSERT INTO mensaje(idpublicacion, idusuarioremitente, idusuariodestinatario, 
            mensaje, estatus, fecharegistro)
    VALUES (?, ?, ?, ?, 
            ?, ?, ?);";
$query = $db->prepare($sql);
$prepare = array($idpublicacion,$idusuario,$Publicacion["idusuario"],$mensaje,0,$fecharegistro);
$result = $query->execute($prepare);

if($result){
	echo json_encode(array('result' => true,'mensaje' => "Se ha enviado el mensaje de forma satisfactoria."));
//reg_eventos("Registro un nuevo Paciente con nombre: $nombre");
}
else{
	//var_dump($prepare);
	$error = $db->errorInfo();
	echo json_encode(array('result' => false,'mensaje' => "Hubo un error en la consulta. ".$error[2]));
}

?>