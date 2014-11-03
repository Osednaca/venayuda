<?php

$idusuario = $_REQUEST["idusuario"];


$sql_activate = "UPDATE usuario SET estatus=? WHERE idusuario=?";
$query = $db->prepare($sql);
$prepare = array(1,$idusuario);
$result = $query->execute($prepare);
if($result){
?>
<!-- Felicidades ha activado su cuenta satisfactoriamente -->
<?php
}else{
	echo json_encode(array('result' => false,'mensaje' => "Hubo un error en la consulta. ".$error[2]));
}
?>