<?php

session_start();
include("includes/config.php");
include("funcionesphp/utils.php");

$db = Conn::get_conn();

if ($db == true){
	if(!empty($_POST))
	{
		$data = json_decode($_POST["data"]);
		$apodo = trim($data->user_login);
		$clave = trim($data->pass_login);
		$sql = "SELECT * FROM usuarios WHERE usuario=?";
        $query = $db->prepare($sql);
        $prepare = array($apodo);
        $result = $query->execute($prepare);
		if($result){
			$row = $query->fetch();
	   		$salt = $row['salt'];
            $encrypted_password = $row['password'];
            $hash = checkhashSSHA($salt, $clave);
			if($encrypted_password == $hash){
				// Validar que el usuario no tenga una sesion activa
				$valida_sesion = "SELECT idusuario FROM usuario_sesion WHERE idusuario=? AND fecha_salida IS NULL";
        		$query1 = $db->prepare($valida_sesion);
        		$prepare1 = array($row["idusuario"]);
        		$resultado = $query1->execute($prepare1);
        		$valida = $query1->fetch();
        		//var_dump($valida);
				if($valida["idusuario"]=="")
				{
					$SKey = uniqid(mt_rand(), true);
					$timestamp = date("Y-m-d H:m:i");
					$sql  = "INSERT INTO usuario_sesion(idusuario,security_token,fecha_ingreso) VALUES(".$row["idusuario"].",'".$SKey."','".$timestamp."')";
        			$query = $db->query($sql);
        			$_SESSION["aut"]  = 1;
        			$_SESSION["idusuario"]  = $row["idusuario"];
					$_SESSION["apodo"] 		= $row['usuario'];
            		$_SESSION["nombre"] 	= $row['nombre'];
            		$_SESSION['userAgent'] 	= sha1($_SERVER['HTTP_USER_AGENT']);
					$_SESSION['SKey'] 		= $SKey;
					$_SESSION['IPaddress'] 	= $_SERVER["REMOTE_ADDR"];
					$_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];
            		$_SESSION["tipo"] 		= $row['tipousuario'];
					echo json_encode(array('respuesta' => true,'mensaje' => "¡Correcto! <i class='fa fa-check fa-fw'></i>"));
				}
				else
				{
					echo json_encode(array('respuesta' => false,'mensaje' => "El usuario ".$apodo." ya inicio sesion en el sistema."));
				}
			}
			else
			{
				echo json_encode(array('respuesta' => false,'mensaje' => "Error: Usuario o Clave incorrecta"));
			}
		}
		else
		{
			echo json_encode(array('respuesta' => false,'mensaje' => "Usuario o Clave incorrecta o hay un error con el query: ".$db->errorInfo()));
		}
	}
}
?>