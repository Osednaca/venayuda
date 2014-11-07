<?
include_once("../includes/config.php");

//===> variables
$accion = $_REQUEST["accion"];

//===>Filtros

//var_dump($_REQUEST);

switch ($accion) {
	case 'busqueda_filtrada':
		// Filtros
		$idciudad		= $_REQUEST["idciudad"];
		$idmedicamento 	= $_REQUEST["idmedicamento"];

		$Filtros  	 = "";
		$str_prepare = "";
		if($idciudad!=""):
			if($Filtros!=""): $Filtros .= " and "; endif;
			$Filtros .= "idciudad = ?";
			if($str_prepare!=""): $str_prepare .= ",".$idciudad; else: $str_prepare .= $idciudad; endif;
		endif;
		if($idmedicamento!=""):
			if($Filtros!=""): $Filtros .= " and "; endif;
			$Filtros .= "idmedicamento = ?";
			if($str_prepare!=""): $str_prepare .= ",".$idmedicamento; else: $str_prepare .= $idmedicamento; endif;
		endif;
		if($Filtros!=""): $Filtros = "WHERE ".$Filtros; endif;
		break;
	case 'paginacion':
		$item_per_page = 5;
		
		//sanitize post value
		$page_number = filter_var($_REQUEST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		
		//validate page number is really numaric
		if(!is_numeric($page_number)){die('Invalid page number!');}
		
		//get current starting point of records
		$position = ($page_number * $item_per_page);
		
		//Limit our results within a specified range. 

		$sql = "SELECT publicacion.*,medicamento.nombremedicamento FROM publicacion INNER JOIN medicamento USING(idmedicamento) WHERE publicacion.estatus=1 ORDER BY idpublicacion DESC LIMIT $item_per_page OFFSET $position";
		//echo $sql; die;
		//output results from database
		foreach ($db->query($sql) as $medicamento) {
			echo '<div class="well" style="height:100px;" onclick="ver_publicacion('.$medicamento["idpublicacion"].')">';
			?>
			<div style="float:left; width:200px;">
			<?php
			if(!empty($medicamento["foto1"])):
				$src = $medicamento["foto1"];
			else:
				$src = "img/medical.png";
			endif;
			?>
			<img src="<?= $src ?>" height="80" width="80" />
			</div>
			<div style="float:left; width:200px;">
			<?php
				echo "<p>".$medicamento["nombremedicamento"]."</p>";
		    	echo "<p><a onclick='ver_publicacion(".$medicamento["idpublicacion"].")' style='cursor: pointer;'>".$medicamento["descripcion"]."</a></p>";
		    ?>
		    </div>
		    <?php
		    echo '</div>';
		}
		
		break;
}

?>