<div class="container" style="padding-top:80px;" id="publicacion-content">		
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
                        <select class="selectpicker" id="idmedicamento" name="idmedicamento" data-live-search="true" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione una ciudad.">
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
});

function buscar()
{
    var idmedicamento   =   $("#idmedicamento").val();
    var idciudad        =   $("#idciudad").val();
    var accion          = "busqueda_filtrada";
	//if(idciudad=="")
	//{
	//	$("#idciudad").popover("show");
	//	return false;
	//}
	//if(idmedicamento=="")
	//{
	//	$("#idmedicamento").popover("show");
	//	return false;
	//}

	$.get("publicacion/publicacion_datos.php",{"idciudad":idciudad,"idmedicamento":idmedicamento,"accion":accion}, function(data) {
        $("#publicacion_data").html(data)
        $("#1-page").addClass('active');
    });
    //initial page number to load
}

function ver_publicacion(idpublicacion){
	$("#publicacion-content").load("publicacion/ver_publicacion.php",{"idpublicacion":idpublicacion});
}
</script>