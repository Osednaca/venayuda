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
			$Filtros .= "usuarios.idciudad = ?";
			if($str_prepare!=""): $str_prepare .= ",".$idciudad; else: $str_prepare .= $idciudad; endif;
		endif;
		if($idmedicamento!=""):
			if($Filtros!=""): $Filtros .= " and "; endif;
			$Filtros .= "idmedicamento = ?";
			if($str_prepare!=""): $str_prepare .= ",".$idmedicamento; else: $str_prepare .= $idmedicamento; endif;
		endif;
		if($Filtros!=""): 
			$Filtros = "WHERE publicacion.estatus=1 AND ".$Filtros;
		else:
			$Filtros = "WHERE ".$Filtros;
		endif;
		//Paginacion
		$sql = "SELECT * FROM publicacion INNER JOIN usuarios USING(idusuario) $Filtros";
		//echo $sql;
		$query = $db->prepare($sql);
        $prepare = explode(",", $str_prepare);
        //var_dump($prepare);
        if($Filtros!=""){
        	if($idciudad==""){
        		$query->bindParam(1, $idmedicamento);
        	}elseif($idmedicamento==""){
        		$query->bindParam(1, $idciudad);
        	}else{
        		$query->bindParam(1, $idciudad);
        		$query->bindParam(2, $idmedicamento);
        	}

        }
        $query->execute();
        $cuenta = $query->rowCount();
        //echo "Cuenta: ".$cuenta;


		//break total records into pages
		$pages = ceil((int)$cuenta/5);   
		//echo "Paginas:".$pages;
		//create pagination
		$pagination = '';
		if($pages > 1)
		{	
			$pagination .= '<nav>';
		    $pagination .= '<ul class="pagination">';
		    for($i = 1; $i<=$pages; $i++)
		    {
		
		        $pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';
		    }
		    $pagination .= '</ul>';
		    $pagination .= '</nav>';
		}
		echo "<div style='text-align: center;'>".$pagination."</div>";

		$item_per_page = 5;
		
		//sanitize post value
		$page_number = 0;
		
		//get current starting point of records
		$position = ($page_number * $item_per_page);
		
		//Limit our results within a specified range. 

		$sql = "SELECT publicacion.*,medicamento.nombremedicamento FROM publicacion INNER JOIN medicamento USING(idmedicamento) INNER JOIN usuarios ON publicacion.idusuario = usuarios.idusuario $Filtros ORDER BY idpublicacion DESC LIMIT $item_per_page OFFSET $position";
		//echo $sql; die;
		$query = $db->prepare($sql);
        $prepare = explode(",", $str_prepare);
        //var_dump($prepare);
        if($Filtros!=""){
        	if($idciudad==""){
        		$query->bindParam(1, $idmedicamento);
        	}elseif($idmedicamento==""){
        		$query->bindParam(1, $idciudad);
        	}else{
        		$query->bindParam(1, $idciudad);
        		$query->bindParam(2, $idmedicamento);
        	}

        }
        $query->execute();
		//output results from database
        	if($cuenta>0){
				while($medicamento = $query->fetch()){		
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
		}else{
			echo "<p>No se encontraron publicaciones <b>:(</b></p>";
		}
		break;
	case 'paginacion':
		$item_per_page = 5;

		$sql = "SELECT * FROM publicacion WHERE estatus=1";
		//echo $sql;
		$query = $db->query($sql);
        $cuenta = $query->rowCount();
        //echo "Cuenta: ".$cuenta;


		//break total records into pages
		$pages = ceil((int)$cuenta/$item_per_page);   
		//echo "Paginas:".$pages;
		//create pagination
		$pagination = '';
		if($pages > 1)
		{	
			$pagination .= '<nav>';
		    $pagination .= '<ul class="pagination">';
		    for($i = 1; $i<=$pages; $i++)
		    {
		
		        $pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';
		    }
		    $pagination .= '</ul>';
		    $pagination .= '</nav>';
		}
		echo "<div style='text-align: center;'>".$pagination."</div>";
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
		echo "<div style='text-align: center;'>".$pagination."</div>";	
		break;
}

?>
<script>
	    $(".paginate_click").click(function (e) {
        
        $("#results").prepend('<div class="loading-indication"><img src="ajax-loader.gif" /> Loading...</div>');
        
        var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
        var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 
        
        $('.paginate_click').removeClass('active'); //remove any active class
        
        //post page number and load returned data into result element
        //notice (page_num-1), subtract 1 to get actual starting point
        $("#publicacion_data").load("publicacion/publicacion_datos.php", {'accion':'paginacion','page': (page_num-1)}, function(){

        });

        $(this).addClass('active'); //add active class to currently clicked element
        
        return false; //prevent going to herf link
    }); 
</script>