<?//session_start();?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <label class="navbar-brand" style="cursor:pointer;" onclick="window.location.href='index.php';"><img src="img/LogoVenAyuda_SM.png" width="90px" height="50px" style="margin-top: -11px;margin-left: 10px;"></label>
	    </div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">
		    <?if(empty($_SESSION["aut"])){?>
		    	<li><a href="#" data-toggle="modal" data-target="#modal-sesion">Hacer donaci&oacute;n</a></li>
		    <?}else{?>
		    	<li><a href="index.php?va=1">Hacer donaci&oacute;n</a></li>
		    <?}?>
				<li class="dropdown">
				  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Buscar<span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="#" role="button">Donaciones publicadas</a></li>
				    <li><a href="#" role="button">Abastecimiento de farmacias</a></li>
				  </ul>
				</li>
			</ul>
			 <ul class="nav navbar-nav navbar-right">
			 	<?if(!empty($_SESSION["aut"])){?>
			 	<li><a style="cursor:context-menu;"><b><?=$_SESSION["nombre"]?></b></a></li>
			 	<li><a href="#" onClick="window.open('cerrar.php','_parent')"><i class="fa fa-sign-out"></i> Cerrar sesi&oacute;n</a></li>
			 	<?}else{?>
			 	<li><a href="#" data-toggle="modal" data-target="#modal-sesion"><i class="fa fa-sign-in"></i> Iniciar sesi&oacute;n</a></li>
			 	<li><a href="#" data-toggle="modal" data-target="#modal-registro"><i class="fa fa-pencil"></i> Registro</a></li><?}?>
			 </ul>
		</div>
  </div>
</nav>

		<!--Modal de registro-->
		<div id="modal-registro" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Informaci&oacute;n de registro</h4>
				</div> <!--Header-->
				<div class="modal-body" style="background-color:rgb(239, 247, 255);">
				<div class="form-horizontal" style="width:;margin: 0 auto;">
										<div class="form-group">
						<label style="align:right;" id="lab-nom" class="col-sm-4 control-label">Cedula/RIF:</label>
						<div class="col-sm-4">
							<input type="text" maxlength="8" class="form-control" id="cedularif" name="cedularif" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese nombre." onkeypress="return soloNumeros();">
						</div>
					</div>
					<div class="form-group">
						<label style="align:right;" id="lab-nom" class="col-sm-4 control-label">Nombre:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="nom" name="nom" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese nombre." onkeypress="return soloLetras(event);" onblur="mayusculas(this);">
						</div>
					</div>
					<div class="form-group">
						<label style="align:right;" id="lab-tlf" class="col-sm-4 control-label">N&ordm; Tlf.:</label>
						<div class="col-sm-3">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-mobile-phone fa-lg"></i></span>
								<input type="text" class="form-control" id="tlf" name="tlf" maxlength="12" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese N&ordm; Tlf." onkeyup="mascara(this,'-',patron4,true);" onkeypress="return soloNumeros();">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label style="align:right;" id="lab-mail" class="col-sm-4 control-label">E-mail:</label>
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
								<input type="text" class="form-control" id="mail" name="mail" placeholder="ejemplo@gmail.com" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese e-mail." onblur="validaCorreo(this.id); existeCorreo(this.value)">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label style="align:right;" id="lab-est" class="col-sm-4 control-label">Ciudad:</label>
						<div class="col-sm-5">
                        <select class="selectpicker" id="idciudad" name="idciudad" data-live-search="true" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione una ciudad.">
                                <option value=""></option>
                                <?php
                                include_once("includes/config.php");
                                $sql = "SELECT * FROM ciudades";
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
						<label style="align:right;" id="lab-us" class="col-sm-4 control-label">Usuario:</label>
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
								<input type="text" class="form-control" id="user" name="user" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese usuario." onblur="existeUsuario(this.value)">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label style="align:right;" id="lab-cont" class="col-sm-4 control-label">Contrase&ntilde;a:</label>
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input type="password" class="form-control" id="pass" name="pass" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese contrase&ntilde;a.">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label style="align:right;" id="lab-rep-cont" class="col-sm-4 control-label">Repita contrase&ntilde;a:</label>
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input type="password" class="form-control" id="rep_pass" name="rep_pass" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Repita contrase&ntilde;a.">
							</div>
						</div>
					</div>
				</div>
				</div> <!--Body-->
		    	<div class="modal-footer" style="text-align:center;">
		        	<button type="button" class="btn btn-success" onclick="validar_reg();"><i id="spin_bt_reg" style="display:none;" class="fa fa-spinner fa-spin"></i>Finalizar registro</button>
		        	<button type="button" class="btn btn-default" onclick="limpia_pop(); limpiar();" data-dismiss="modal">Cancelar</button>
		      	</div> <!--Footer-->
		    </div> <!--Content-->
		  </div>
		</div>

		<!--Modal de inisio sesion-->
		<div id="modal-sesion" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title 1">Iniciar sesi&oacute;n</h4>
					<h4 class="modal-title 2" style="display:none;">Recuperar contrase&ntilde;a</h4>
				</div> <!--Header-->
				<div class="modal-body" style="background-color:rgb(239, 247, 255);">
				<div class="form-horizontal" style="width:;margin: 0 auto;">
					<div class="form-group" id="frm-us">
					<label class="col-sm-4 control-label" id="lab-log-us">Usuario</label>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
								<input type="text" class="form-control" id="user_login" name="user_login" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese usuario.">
							</div>
						</div>
					</div>

					<div class="form-group" id="frm-con">
					<label class="col-sm-4 control-label" id="lab-log-cont">Contrase&ntilde;a</label>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
								<input type="password" class="form-control" id="pass_login" name="pass_login" placeholder="" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese contrase&ntilde;a." onkeypress="return enter(event);">
							</div>
						</div>
					</div>
					<div style="text-align:center;" id="lab-ol"><label style="cursor:pointer;color:blue;font-weight:normal;" onclick="ol_cn()">¿Olvid&oacute; su contrase&ntilde;a?</label></div>

					<div class="form-group" style="display:none;" id="frm-rec">
					<label class="col-sm-4 control-label" id="lab-log-mail">E-mail</label>
						<div class="col-sm-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
								<input type="text" class="form-control" id="mail_rec" name="mail_rec" placeholder="ejemplo@gmail.com" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese e-mail." onblur="validaCorreo(this.id);">							</div>
						</div>
					</div>		
				<div id="msj_alert" name="msj_alert" style="text-align:center;display:none;width:40%;margin:0 auto;"></div>
				</div>
				</div> <!--Body-->
		    	<div class="modal-footer" style="text-align:center;">
		        	<button type="button" class="btn btn-success ini" onclick="validar_log()"><i id="spin_bt_log" style="display:none;" class="fa fa-spinner fa-spin"></i>Iniciar sesi&oacute;n</button>
		        	<button type="button" class="btn btn-default" onclick="rest_ses(); limpia_pop();" data-dismiss="modal">Cancelar</button>
		      	</div> <!--Footer-->
		    </div> <!--Content-->
		  </div>
		</div>
<script type="text/javascript">
$(".selectpicker").selectpicker();
$(".dropdown-menu").css("z-index","5000");
	function validar_reg()
	{
		if($("#nom").val()==""){
			$("#nom").popover("show");
			return false;
		}
		if($("#tlf").val()==""){
			$("#tlf").popover("show");
			return false;
		}
		if($("#mail").val()==""){
			$("#mail").popover("show");
			return false;
		}
		if($("#estado").val()==""){
			$("#estado").popover("show");
			return false;
		}
		if($("#user").val()==""){
			$("#user").popover("show");
			return false;
		}
		if($("#pass").val()==""){
			$("#pass").popover("show");
			return false;
		}
		if($("#rep_pass").val()==""){
			$("#rep_pass").popover("show");
			return false;
		}

		if($("#pass").val()!=$("#rep_pass").val())
		{
			crear_dialog("Informaci&oacute;n","¡Las contrase&ntilde;as no coinciden!","rep_pass");
			return false;
		}
			$("#spin_bt_reg").show("fast");

		        $.blockUI({ css: { 
		            border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#000', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5, 
		            color: '#fff' 
		        } }); 

		$.post("registro/registro_datos.php",$("#form1").serialize(),function(resp,status){
			$("#spin_bt_reg").hide("fast");
			var json = eval("(" + resp + ")");
			setTimeout($.unblockUI); 
			if(json.result==true)
			{
				$("#form1")[0].reset();
				crear_dialog("Informaci&oacute;n",json.mensaje,"","rel");
			}
			else{
				crear_dialog("Informaci&oacute;n",json.mensaje);
			}
		});
	}

	function validar_log()
	{
		if($("#user_login").val()==""){
			$("#user_login").popover("show");
			return false;
		}
		if($("#pass_login").val()==""){
			$("#pass_login").popover("show");
			return false;
		}

		var user_login=$("#user_login").val();
		var pass_login=$("#pass_login").val();

		$("#spin_bt_log").show("fast");

		        $.blockUI({ css: { 
		            border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#000', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5, 
		            color: '#fff' 
		        } }); 

		$.post("login.php",{data : JSON.stringify({"user_login": user_login,"pass_login": pass_login})},function(resp,status){
			$("#spin_bt_log").hide("fast");
			var json = eval("(" + resp + ")");
			setTimeout($.unblockUI); 
			//console.log(json);
			if(json.respuesta==true){
				$("#msj_alert").addClass("alert alert-success");
				$("#msj_alert").html(" "+json.mensaje+" ");
				$("#msj_alert").show("fast");
				setTimeout(function(){$("#msj_alert").hide("fast"); $("#msj_alert").html(""); window.location.reload();},3000);
			}
			else
			{
				$("#msj_alert").addClass("alert alert-danger");
				$("#msj_alert").html("<strong>Alerta:</strong> "+json.mensaje+" ");
				$("#msj_alert").show("fast");
				setTimeout(function(){$("#msj_alert").hide("fast"); $("#msj_alert").html(""); $("#msj_alert").removeClass("alert alert-danger")},5000);
			}
		});
	}

	function limpia_pop()
	{
		$("#nom,#tlf,#mail,#estado,#user,#pass,#user_login,#pass_login").popover("hide");
	}

	function enter(e)
	{
		if(e.keyCode==13)
		{
			validar_log();
		}
	}

	function limpiar()
	{
		$("#form1")[0].reset();
	}

	function ol_cn(){
		$("#frm-us,#frm-con,#lab-cont,#lab-ol,.1").hide("fast","",function(){
			$(".ini").html("Recuperar contrase&ntilde;a");
			$(".ini").attr("onclick","env_conf()");
			$("#frm-rec,.2").show("fast");
		});
	}

	function rest_ses()
	{
		$("#frm-rec,.2").hide("fast",function(){
			$(".ini").html("Iniciar sesi&oacute;n");
			$(".ini").attr("onclick","validar_log()");
			$("#frm-us,#frm-con,#lab-cont,#lab-ol,.1").show("fast");
		});	
	}

	function existeUsuario(user){
		$.post("funcionesphp/servicio_usuario.php",{"user": user,"accion": "existeusuario"},function(resp){
			if(resp){
				alert("Este usuario ya fue registrado");
			}
		});
	}

	function existeCorreo(mail){
		$.post("funcionesphp/servicio_usuario.php",{"mail": mail,"accion": "existecorreo"},function(resp,status){
			if(resp){
				crear_dialog("Informaci&oacute;n","Este correo ya fue registrado","mail");
				return false;
			}
		});
	}
</script>