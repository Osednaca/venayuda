<?php
include_once("../includes/config.php");
//==================> Variables
$id_medicamento 			= $_REQUEST["id_medicamento"]; //==> En caso de que el medicamento este en el select
/*---Si el medicamento no esta en el select estos campos deberian contener datos----*/
$nombre_medicamento 		= $_REQUEST["nom_medicamento"];
$descripcion_medicamento    = $_REQUEST["descripcion_medicamento"];
$laboratorio_medicamento 	= $_REQUEST["lab_medicamento"];
$principio_a_medicamento 	= $_REQUEST["pa_medicamento"];
/*---------------------------------------------------------*/
$presentacion_medicamento   = $_REQUEST["pres_medicamento"];
$unidad_medicamento         = $_REQUEST["uni_medicamento"];
$indica_recipe				= $_REQUEST["indica_rec"]; //===> "0" No indica, "1" Si indica
$fecha_ven 					= $_REQUEST["fecha_ven"];
$descripcion 				= $_REQUEST["desc"];
$tipo_publicacion 			= $_REQUEST["tipo_publicacion"];
$fecharegistro              = date("Y-m-d");

//var_dump($_REQUEST);

//=====================================================
    if($presentacion_medicamento==""):
        $sql_presentacion = "INSERT INTO presentacion(presentacion) VALUES (?);";
        $query = $db->prepare($sql_presentacion);
        $prepare = array($presentacion);
        //var_dump($prepare); exit();
        $result = $query->execute($prepare);
        $idpresentacion = $db->lastInsertId('public.presentacion_idpresentacion_seq');
    else:
        $idpresentacion = $presentacion_medicamento;
    endif;
	if($idmedicamento==""):
		$sql_medicamento = "INSERT INTO medicamento(
            nombremedicamento, descripcion, 
            laboratorio, principio_activo, requiere_recipe, 
            idusuario, fecharegistro, estatus)
    		VALUES (?, ?, ?, 
            ?, ?, ?, ?, ?, 
            ?);";
        //echo $sql; exit();
		$query = $db->prepare($sql_medicamento);
        $prepare = array($nombremedicamento,$descripcion_medicamento,$laboratorio_medicamento,$principio_a_medicamento,$indica_recipe,$idusuario,$fecha_registro,1);
        //var_dump($prepare); exit();
        $result = $query->execute($prepare);
        if(!$result){
        	$error = $db->errorInfo();
        	echo json_encode(array('result' => false,'mensaje' => "Hubo un error en la consulta. ".$error[2]));
        }else{
            $idmedicamento = $db->lastInsertId('public.medicamento_idmedicamento_seq');
        }
	endif;

		$sql_publicacion = "INSERT INTO publicacion(
            idusuario, idmedicamento, tipo, descripcion, foto1, 
            foto2, foto3, foto4, estatus, fecharegistro, idfarmacia,idpresentacion,unidad,fechavencimiento)
    VALUES (?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?);";
		//echo $sql; exit();
		$query = $db->prepare($sql_publicacion);
        $prepare = array($idusuario,$idmedicamento,$tipo_publicacion,$descripcion,$foto1,$foto2,$foto3,$foto4,1,$fecha_registro,$idfarmacia,$idpresentacion,$unidad,$fechavencimiento);
        //var_dump($prepare); exit();
        $result = $query->execute($prepare);
        if(!$result){
        	$error = $db->errorInfo();
        	echo json_encode(array('result' => false,'mensaje' => "Hubo un error en la consulta. ".$error[2]));
        }else{
        	echo json_encode(array('result' => true,'mensaje' => "Se ha registrado la publicacion, esta en espera de aprobacion."));
		//reg_eventos("Registro un nuevo Paciente con nombre: $nombre");
        }

?>