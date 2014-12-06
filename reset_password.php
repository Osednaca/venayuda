<?php

$SKey  = uniqid(mt_rand(), true);
$email = $_REQUEST["mail_rec"];

$sql = "UPDATE usuarios SET accesstoken=? WHERE email=?";
$query = $db->prepare($sql);
$prepare = array(1,$idusuario);
$result = $query->execute($prepare);
if($result){
	$asunto = "Reseteo de Contrase&ntilde;a"; // Asunto (se puede cambiar)
	$mensaje = "Hola <b>$nom</b> has pedido el reseteo de tu contrase&ntilde;a, solo haz click en el siguiente enlace o copia y pega en tu navegador. <p>http://localhost/resetea.php?idusuario=$idusuario&accesstoken=$accesstoken<p>";
}else{
	echo json_encode(array('result' => false,'mensaje' => "Hubo un error en la consulta. ".$error[2]));
}

?>