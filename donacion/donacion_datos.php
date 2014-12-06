<?php
session_start();
include_once("../includes/config.php");
//==================> Variables
$idfarmacia = 0;

if(empty($_REQUEST["id_medicamento"]))
    $id_medicamento         = "";
else
    $id_medicamento 		= $_REQUEST["id_medicamento"]; //==> En caso de que el medicamento este en el select

/*---Si el medicamento no esta en el select estos campos deberian contener datos----*/
$nombre_medicamento 		= utf8_decode($_REQUEST["nom_medicamento"]);
//$descripcion_medicamento    = utf8_decode($_REQUEST["descripcion_medicamento"]);
$laboratorio_medicamento 	= utf8_decode($_REQUEST["lab_medicamento"]);
$principio_a_medicamento 	= utf8_decode($_REQUEST["pa_medicamento"]);
/*---------------------------------------------------------*/
if(empty($_REQUEST["pres_medicamento"]))
    $presentacion_medicamento="";
else
    $presentacion_medicamento= $_REQUEST["pres_medicamento"];           //==> Presentacion existente

$new_presentacion           = utf8_decode($_REQUEST["new_present"]);   //==> Nueva presentacion

$unidad_medicamento         = $_REQUEST["uni_medicamento"];
$cant_uni                   = $_REQUEST["cant_uni"];
$indica_recipe				= $_REQUEST["indica_rec"]; //===> "0" No indica, "1" Si indica
$fecha_ven 					= $_REQUEST["fecha_ven"];
$descripcion 				= utf8_decode($_REQUEST["desc"]);
$tipo_publicacion 			= $_REQUEST["tipo_publicacion"];
$fecharegistro              = date("Y-m-d H:m:i");
$idusuario                  = $_SESSION["idusuario"];
$foto1                      = ""; //$_REQUEST["foto1"];
$foto2                      = ""; //$_REQUEST["foto2"];
$foto3                      = ""; //$_REQUEST["foto3"];
$foto4                      = ""; //$_REQUEST["foto4"];

//var_dump($_REQUEST);

//=====================================================
    if($presentacion_medicamento==""):
        $sql_presentacion = "INSERT INTO presentacion(presentacion) VALUES (?);";
        $query = $db->prepare($sql_presentacion);
        $prepare = array($new_presentacion);
        //var_dump($prepare); exit();
        $result = $query->execute($prepare);
        $idpresentacion = $db->lastInsertId('public.presentacion_idpresentacion_seq');
    else:
        $idpresentacion = $presentacion_medicamento;
    endif;
	if($id_medicamento==""):
		$sql_medicamento = "INSERT INTO medicamento(
            nombremedicamento, 
            laboratorio, principio_activo, requiere_recipe, 
            idusuario, fecharegistro, estatus,cant_unidad)
    		VALUES (?, ?, 
            ?, ?, ?, ?, ?,?);";
        //echo $sql_medicamento; exit();
		$query = $db->prepare($sql_medicamento);
        $prepare = array($nombre_medicamento,$laboratorio_medicamento,$principio_a_medicamento,(int)$indica_recipe,$idusuario,$fecharegistro,0,$cant_uni);
        $result = $query->execute($prepare);

        if(!$result)
        {
        	$error = $db->errorInfo();
        	echo json_encode(array('result' => false,'mensaje' => "Hubo un error en la consulta. ".$error[2]));
        }
        else
        {
           // echo "No Error"; exit();
            $id_medicamento = $db->lastInsertId('public.medicamento_idmedicamento_seq');
        }
	endif;

		$sql_publicacion = "INSERT INTO publicacion(
            idusuario, idmedicamento, tipo, descripcion, foto1, 
            foto2, foto3, foto4, estatus, fecharegistro, idfarmacia,fechavencimiento,idpresentacion,unidad)
    VALUES (?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?,?,?,?);";
		//echo $sql_publicacion; exit();
		$query1 = $db->prepare($sql_publicacion);
        $prepare1 = array($idusuario,(int)$id_medicamento,(int)$tipo_publicacion,$descripcion,$foto1,$foto2,$foto3,$foto4,0,$fecharegistro,$idfarmacia,$fecha_ven,(int)$idpresentacion,(int)$unidad_medicamento);
        //var_dump($prepare); exit();
        $result1 = $query1->execute($prepare1);
        //var_dump(!$db->query($sql_publicacion)); exit();
        if(!$result1){
        	$error = $db->errorInfo();
            echo "Error: ".$error[2]; exit();
        	echo json_encode(array('result' => false,'mensaje' => "Hubo un error en la consulta. ".$error[2]));
           // echo "Error: ".$error[2]; exit();
        }else{
        	echo json_encode(array('result' => true,'mensaje' => "Se ha registrado la publicacion, esta en espera de aprobacion."));
        }

?>