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
							<input type="button" class="btn btn-success" value="Buscar" onclick="buscar(1);">
							<!-- <input type="button" class="btn btn-info" value="Ver todas" onclick="buscar(2);"> -->
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
<div id="divDatos" style="width:100%;">
	
</div>
<script type="text/javascript">
function buscar(tipo)
{
	if(tipo==1)
	{
		if($("#tipo_publicacion").val()=="")
		{
			$("#tipo_publicacion").popover("show");
			return false;
		}	
		var tipo_publicacion=$("#tipo_publicacion").val();	
	}
	else
	{
		var tipo_publicacion="";
		$("#tipo_publicacion").val("");	
	}

		$.blockUI({ css: { 
		    border: 'none', 
		    padding: '15px', 
		    backgroundColor: '#000', 
		    '-webkit-border-radius': '10px', 
		    '-moz-border-radius': '10px', 
		    opacity: .5, 
		    color: '#fff' 
		} }); 
	
	var accion = "busca_publicacion";

	$("#divDatos").load("admin/publi_pend_datos.php",{"tipo_publicacion":tipo_publicacion,"accion":accion},function(){
		setTimeout($.unblockUI);
	});
}

function aprob_publi(idpublicacion)
{
	var accion="aprobar_publicacion";

	$.post("admin/publi_pend_datos.php",{"idpublicacion":idpublicacion,"accion":accion},function(resp){
		alert(resp);
	})
}
</script>