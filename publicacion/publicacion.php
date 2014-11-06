<div class="container" style="padding-top:80px;">		
		<div class="panel panel-default" style="box-shadow:2px 2px 5px;margin:0 auto;margin-bottom:35px;">
		<div class="panel-heading" style="text-align: center;">
        	<label><b>Filtros de b&uacute;squeda:</b></label>
        </div>
			<div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label style="align:left;" class="col-sm-5 control-label">Ciudad</label>
						<div class="col-sm-4">
                        <select class="selectpicker" id="idciudad" name="idciudad" data-live-search="true" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione una ciudad.">
                                <option value=""></option>
                                <?php
                                include("includes/config.php");
                                $sql = "SELECT * FROM ciudades ORDER BY ciudad";
                                foreach ($db->query($sql) as $row) {
                                ?>
                                    <option value="<?= $row["id_ciudad"] ?>"><?= $row["ciudad"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
						</div>
					</div>
					<div class="form-group">
						<label style="align:left;" class="col-sm-5 control-label">Medicamento</label>
						<div class="col-sm-4">
                        <select class="selectpicker" id="idciudad" name="idciudad" data-live-search="true" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione una ciudad.">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM medicamento WHERE estatus=1";
                                foreach ($db->query($sql) as $medicamento) {
                                ?>
                                    <option value="<?= $medicamento["idmedicamento"] ?>"><?php echo $medicamento["nombremedicamento"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12" style="text-align:center;">
							<input type="button" class="btn btn-success" value="Buscar" onclick="buscar();">
							<input type="button" class="btn btn-info" value="Ver todas">
						</div>
					</div>
					<?php

		$sql = "SELECT * FROM publicacion WHERE estatus=1";
		//echo $sql;
		$query = $db->query($sql);
        $cuenta = $query->rowCount();
        //echo $cuenta;


//break total records into pages
$pages = ceil($cuenta/1);   

//create pagination
$pagination = '';
if($pages > 1)
{	
	$pagination .= '<nav>';
    $pagination .= '<ul class="pagination">';
    for($i = 1; $i<$pages; $i++)
    {
        $pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';
    }
    $pagination .= '</ul>';
    $pagination .= '</nav>';
}
echo $pagination;
                        ?>					
					<div id="publicacion_data">
					</div>

				</div>
			</div>
		</div>
</div>
<div id="divDatos"></div>
<script type="text/javascript">
$(document).ready(function() {
    $.get("publicacion/publicacion_datos.php", {'accion':'paginacion','page':0}, function(data) {
    	$("#publicacion_data").html(data)
    	$("#1-page").addClass('active');
    });  //initial page number to load

    $(".paginate_click").click(function (e) {
        
        $("#results").prepend('<div class="loading-indication"><img src="ajax-loader.gif" /> Loading...</div>');
        
        var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
        var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 
        
        $('.paginate_click').removeClass('active'); //remove any active class
        
        //post page number and load returned data into result element
        //notice (page_num-1), subtract 1 to get actual starting point
        $("#publicacion_data").load("publicacion_datos.php", {'accion':'paginacion','page': (page_num-1)}, function(){

        });

        $(this).addClass('active'); //add active class to currently clicked element
        
        return false; //prevent going to herf link
    }); 
    d
});

function buscar()
{
	if($("#tipo_publicacion").val()=="")
	{
		$("#tipo_publicacion").popover("show");
		return false;
	}
	var tipo_publicacion=$("#tipo_publicacion").val();
	var accion = "busqueda_filtrada";

	$("#divDatos").load("publicacion/publicacion_datos.php",{"idciudad":idciudad,"accion":accion});
}
</script>