<?php
include("../funcionesphp/utils.php");
include("../includes/config.php");

//=====> Variables
$cedularif	=	$_REQUEST["cedularif"];
$nom 		=	$_REQUEST["nom"];
$tlf 		=	$_REQUEST["tlf"];
$mail 		=	$_REQUEST["mail"];
$idciudad 	=	$_REQUEST["idciudad"];
$user		=	$_REQUEST["user"];
$pass 		=	$_REQUEST["pass"];
$hash 				= hashSSHA($pass);
$encrypted_password = $hash["encrypted"]; // encrypted password
$salt 				= $hash["salt"]; // salt
$fecha_registro = date("Y-m-d H:m:i");


		$sql = "INSERT INTO usuarios(usuario, password, nombre, email, telefono, identificador, 
            ubicacion, fecharegistro, tipousuario, estatus, salt)
    VALUES (?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, 
            ?);";
		//echo $sql; exit();
		$query = $db->prepare($sql);
        $prepare = array($user,$encrypted_password,$nom,$mail,str_replace("-", "", $tlf),$cedularif,$idciudad,$fecha_registro,1,0,$salt);
        //var_dump($prepare); exit();
        $result = $query->execute($prepare);
        if(!$result){
        	$error = $db->errorInfo();
        	echo json_encode(array('result' => false,'mensaje' => "Hubo un error en la consulta. ".$error[2]));
        }else{
        $idusuario = $db->lastInsertId('public.usuarios_idusuario_seq');

 		$remite_nombre = ""; // Tu nombre o el de tu página
        $remite_email = ""; // tu correo
        $asunto = "Activacion de tu usuario"; // Asunto (se puede cambiar)
        $mensaje = "Hola <b>$nom</b> te has registrado en Venayuda, ahora necesitas activar tu cuenta, solo haz click en el siguiente enlace o copia y pega en tu navegador. <p>http://localhost/activate.php?idusuario=$idusuario<p>";
        $cabeceras = "From: ".$remite_nombre." <".$remite_email.">\r\n";
        $cabeceras = $cabeceras."Mime-Version: 1.0\n";
        $cabeceras = $cabeceras."Content-Type: text/html";
        $enviar_email = mail($mail,$asunto,$mensaje,$cabeceras);
        if($enviar_email) {
            $result = true;
        }else {
            $result = false;
        }

        }

        if($result){
        	echo json_encode(array('result' => true,'mensaje' => "Se ha enviado un correo electr&oacute;nico para la activaci&oacute;n de tu cuenta."));
		//reg_eventos("Registro un nuevo Paciente con nombre: $nombre");
        }
?>