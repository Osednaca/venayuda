<?
//session_start();
if(!empty($_SESSION["aut"]))
{
?>
<!--Registro de donacion-->
<input type="hidden" id="tipo_publicacion" name="tipo_publicacion" value="2"> <!--Tipo donacion-->
<div id="exito" class="alert alert-success" style="display:none;width:50%;margin:0 auto;margin-bottom:12px;" role="alert">¡Guardado exitosamente!</div>
<div class="container" id="cont_est" name="cont_est" style="display:none;padding-top:80px;">		
		<div class="panel panel-default" style="box-shadow:2px 2px 5px;margin:0 auto;margin-bottom:35px;">
		<div class="panel-heading" style="text-align: center;">
        	<label><b>Datos para la donaci&oacute;n</b></label>
        </div>
			<div class="panel-body">
			<div class="form-horizontal">
					<div class="form-group">
						<label style="align:left;" class="col-sm-3 control-label">Medicamento:</label>
						<div class="col-sm-9">
							<select class="control selectpicker" id="id_medicamento" name="id_medicamento" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione el medicamento.">
								<option value="">Seleccione:</option>
                                <?php
                                include_once("includes/config.php");
                                $sql = "SELECT * FROM medicamento";
                                foreach ($db->query($sql) as $row) {
                                ?>
                                    <option value="<?= $row["idmedicamento"] ?>"><?= $row["nombremedicamento"]; ?></option>
                                <?php
                                }
                                ?>
							</select>
							<label style="font-weight:normal;"><em>¿No est&aacute; en la lista? </em><input id="indica_med" type="checkbox" onclick="if(this.checked==true){this.value=1;}else{this.value=0;} muestra_div(this.value);" value="0"></label>
						</div>
					</div>

							<div class="panel panel-info" id="div_medicamento" style="box-shadow:2px 2px 5px;margin:0 auto;width:90%;margin-bottom:30px;display:none;">
							<div class="panel-heading" style="text-align: center;">
					        	<label><b>Datos del medicamento</b></label>
					        </div>
								<div class="panel-body">
									<div class="form-group" id="div_nm" style="display:;">
										<label style="align:left;" class="col-sm-3 control-label">Nombre:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="nom_medicamento" name="nom_medicamento" data-container="body" data-toggle="popover" data-placement="right" data-content="Indique el nombre del medicamento.">
										</div>
									</div>
									<div class="form-group" id="div_lm" style="display:;">
										<label style="align:left;" class="col-sm-3 control-label">Laboratorio:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="lab_medicamento" name="lab_medicamento" data-container="body" data-toggle="popover" data-placement="right" data-content="Indique laboratorio del medicamento.">
										</div>
									</div>
									<div class="form-group" id="div_pam" style="display:;">
										<label style="align:left;" class="col-sm-3 control-label">Principio activo:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="pa_medicamento" name="pa_medicamento" data-container="body" data-toggle="popover" data-placement="right" data-content="Indique principio activo del medicamento.">
										</div>
									</div>
								</div>
							</div>

					<div class="form-group" id="div_pm" style="display:;">
						<label style="align:left;" class="col-sm-3 control-label">Presentaci&oacute;n:</label>
						<div class="col-sm-9">
							<select class="control selectpicker" id="pres_medicamento" name="pres_medicamento" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione la presentaci&oacute;n del medicamento.">
								<option value="">Seleccione:</option>
							</select>
							<label style="font-weight:normal;"><em>¿No est&aacute; en la lista? </em><input id="indica_pres" type="checkbox" onclick="if(this.checked==true){this.value=1;}else{this.value=0;} muestra_div_pres(this.value);" value="0"></label>
						</div>
					</div>

							<div class="panel panel-info" id="div_presentacion" style="box-shadow:2px 2px 5px;margin:0 auto;width:90%;margin-bottom:30px;display:none;">
							<div class="panel-heading" style="text-align: center;">
					        	<label><b>Nueva Presentaci&oacute;n</b></label>
					        </div>
								<div class="panel-body">
									<div class="form-group" id="div_nm" style="display:;">
										<label style="align:left;" class="col-sm-3 control-label">Presentaci&oacute;n:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="new_present" name="new_present" data-container="body" data-toggle="popover" data-placement="right" data-content="Indique la presentaci&oacute;n del medicamento.">
										</div>
									</div>
								</div>
							</div>

					<div class="form-group" id="div_um" style="display:;">
						<label style="align:left;" class="col-sm-3 control-label">Unidad:</label>
						<div class="col-xs-2">
							<input type="text" class="form-control" id="cant_uni" name="cant_uni" value="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese la cantidad de unidad del medicamento.">
						</div>
						<div class="col-xs-2">
							<select class="form-control" id="uni_medicamento" name="uni_medicamento" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione la unidad.">
								<option value=""></option>
								<option value="1">MG</option>
								<option value="2">CC</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label style="align:left;" class="col-sm-3 control-label">¿Requiere r&eacute;cipe?:</label>
						<div class="col-sm-6">
							<label style="font-weight:normal;"><input id="SI" name="indica_rec" type="radio" value="1"> Si&nbsp;</label>
							<label style="font-weight:normal;"><input id="NO" name="indica_rec" type="radio" value="0"> No</label>
						</div>
					</div>	
					<div class="form-group">
						<label style="align:left;" class="col-sm-3 control-label">Fecha de vencimiento:</label>
						<div class="col-xs-3">
			   				<div class="input-group">
			   					<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
								<input type="text" maxlength="10" class="form-control" id="fecha_ven" name="fecha_ven" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese fecha." onkeyup="mascara(this,'/',patron,true);" value="<?=date('d/m/Y')?>">
							</div>
						</div>
					</div>				
					<div class="form-group">
						<label style="align:left;" class="col-sm-3 control-label">Descripci&oacute;n:</label>
						<div class="col-sm-6">
							<textarea class="form-control" id="desc" name="desc" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese descripci&oacute;n."></textarea>
						</div>
					</div>
					<div class="form-group" style="text-align:center;">
					      <button type="button" class="btn btn-success" onclick="guardar();">Guardar</button>
					      <button type="button" class="btn btn-default" onclick="Limpiar();">Limpiar campos</button>
					</div>
					</div>
			</div>
		</div>
</div>
<div id="msj_est"></div>
<script type="text/javascript">
$(document).ready(function() 
{
	$("#fecha_ven").datepicker();
	$("#cont_est").fadeIn(4000);
	$(".selectpicker").selectpicker();
	$("#push").css("height","10px");
});

function muestra_div(valor)
{
	if(valor==1)
	{
		$("#id_medicamento").attr("disabled","disabled");
		$("#div_medicamento").show("blind");
	}
	else
	{
		$("#id_medicamento").removeAttr("disabled");
		$("#div_medicamento").hide("blind");
	}
}

function muestra_div_pres(valor)
{
	if(valor==1)
	{
		$("#pres_medicamento").attr("disabled","disabled");
		$("#div_presentacion").show("blind");
	}
	else
	{
		$("#pres_medicamento").removeAttr("disabled");
		$("#div_presentacion").hide("blind");
	}
}

function guardar()
{

	if($("#indica_med").val()==0)
	{
		if($("#id_medicamento").val()=="")
		{
			$.growlUI('Seleccione el medicamento o ingrese uno nuevo.');
			//$("#id_medicamento").popover("show");
			return false;
		}
	}

	//===> Si esta ingresando un nuevo medicamento...
	if($("#indica_med").val()==1)
	{
		if($("#nom_medicamento").val()=="")
		{
			$("#nom_medicamento").popover("show");
			return false;			
		}
		if($("#pa_medicamento").val()=="")
		{
			$("#pa_medicamento").popover("show");
			return false;			
		}
	}

	//===> Si esta agregando una nueva presentacion...
	if($("#indica_pres").val()==1)
	{
		if($("#new_present").val()=="")
		{
			$("#new_present").popover("show");
			return false;
		}
	}
	else
	{
		if($("#pres_medicamento").val()=="")
		{
			$.growlUI('Seleccione la presentaci&oacute;n del medicamento.');
			return false;			
		}
	}
		if($("#cant_uni").val()=="")
		{
			$("#cant_uni").popover("show");
			return false;
		}

		if($("#uni_medicamento").val()=="")
		{
			$("#uni_medicamento").popover("show");
			return false;			
		}

	if(!$("#SI").is(":checked") && !$("#NO").is(":checked"))
	{
		crear_dialog("Informaci&oacute;n","¿Indica r&eacute;cipe?","","");
		return false;
	}
	if($("#fecha_ven").val()=="")
	{
		$("#fecha_ven").popover("show");
		return false;
	}
	if($("#desc").val()=="")
	{
		$("#desc").popover("show");
		return false;
	}

/*		$.blockUI({ css: { 
		     border: 'none', 
		     padding: '15px', 
		     backgroundColor: '#000', 
		     '-webkit-border-radius': '10px', 
		     '-moz-border-radius': '10px', 
		     opacity: .5, 
		     color: '#fff' 
		 } }); */

		$.post("donacion/donacion_datos.php",$("form").serialize(),function(resp){
/*			var json = eval("(" + resp + ")");
			setTimeout($.unblockUI); 
			if(json.result==true)
			{
				$("#form1")[0].reset();
				crear_dialog("Informaci&oacute;n",json.mensaje,"","rel");
			}
			else{
				crear_dialog("Informaci&oacute;n",json.mensaje);
			}*/
		});

}

</script>
<?}?>