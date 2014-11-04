<div class="container" style="padding-top:80px;">		
		<div class="panel panel-default" style="box-shadow:2px 2px 5px;margin:0 auto;margin-bottom:35px;">
		<div class="panel-heading" style="text-align: center;">
        	<label><b>Filtros de b&uacute;squeda:</b></label>
        </div>
			<div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label style="align:left;" class="col-sm-5 control-label">Tipo de publicaci&oacute;n:</label>
						<div class="col-sm-4">
							<select class="form-control" id="tipo_publicacion" name="tipo_publicacion" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione tipo de publicaci&oacute;n.">
								<option value="">Seleccione:</option>
								<option value="1">Requerimientos de medicamentos</option>
								<option value="2">Donaci&oacute;n de medicamentos</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12" style="text-align:center;">
							<input type="button" class="btn btn-success" value="Buscar" onclick="buscar();">
							<input type="button" class="btn btn-info" value="Ver todas">
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
<div id="divDatos"></div>
<script type="text/javascript">
function buscar()
{
	if($("#tipo_publicacion").val()=="")
	{
		$("#tipo_publicacion").popover("show");
		return false;
	}
	var tipo_publicacion=$("#tipo_publicacion").val();
	var accion = "busqueda_filtrada";

	$("#divDatos").load("admin/publi_pend_datos.php",{"tipo_publicacion":tipo_publicacion,"accion":accion});
}
</script>