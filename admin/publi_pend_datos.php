<?
error_reporting (E_ALL & ~E_NOTICE & ~E_DEPRECATED);
include_once("../includes/config.php");

//===> variables
$accion = $_REQUEST["accion"];

//===>Filtros
$tipo_publicacion=$_REQUEST["tipo_publicacion"];

switch ($accion)
{
	case "busca_publicacion";

		$busca_publi = "SELECT * 
						FROM publicacion 
						INNER JOIN usuarios ON publicacion.idusuario=usuarios.idusuario
						--INNER JOIN medicamento ON publicacion.idmedicamento=medicamento.idmedicamento
						WHERE tipo=$tipo_publicacion 
						AND publicacion.estatus=0
						ORDER BY publicacion.fecharegistro DESC";
						//echo $busca_publi;

				?><div class="container" style="padding-top:10px;">		
							<div class="panel panel-default" style="box-shadow:2px 2px 5px;margin:0 auto;margin-bottom:35px;">
							<div class="panel-heading" style="text-align: center;">
					        	<label><b>Publicaciones pendientes:</b></label>
					        </div>
								<div class="panel-body">
									<div class="form-horizontal">
									<table class="table table-striped">
									<tr>
										<td align="center" style="background-color: rgb(238, 237, 255);"><b>Descripci&oacute;n</b></td>
										<td align="center" style="background-color: rgb(238, 237, 255);"><b>Autor</b></td>
									</tr><?
								 		
							foreach ($db->query($busca_publi) as $row) 
							{
								?><tr>
									<td><a href="#" data-toggle="modal" data-target="#modal-publi<?=$row["idpublicacion"]?>"><?=substr(utf8_encode($row["descripcion"]),0,60);?></a></td>
									<td align="center"><?=utf8_encode($row["nombre"]);?></td>
								</tr>

								<!--Modal de descripcion de publicacion-->
								<div id="modal-publi<?=$row["idpublicacion"]?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
								    <div class="modal-dialog modal-lg">
									    <div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h4 class="modal-title 1">Detalles de publicaci&oacute;n</h4>
											</div> <!--Header-->
											<div class="modal-body">
												<div class="form-horizontal" style="width:;margin: 0 auto;">
													<div class="form-group">
														<label class="col-sm-3 control-label" id="lab-log-us">Descripci&oacute;n:</label>
														<label class="col-sm-6 control-label" style="text-align: justify;font-weight: normal;">
															<?=utf8_encode($row["descripcion"])?>
														</label>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label" id="lab-log-us">Medicamento:</label>
														<label class="col-sm-6 control-label" style="text-align: justify;font-weight: normal;">
															<?=utf8_encode($row["nombremedicamento"])?>
														</label>
													</div>
												</div>
											</div> <!--Body-->
									    	<div class="modal-footer" style="text-align:center;">
									        	<button type="button" class="btn btn-success ini" onclick="aprob_publi(<?=$row["idpublicacion"]?>)"><i id="spin_bt_log" style="display:none;" class="fa fa-spinner fa-spin"></i>Aprobar</button>
									        	<button type="button" class="btn btn-danger" onclick="rech_publi(); limpia_pop();" data-dismiss="modal">Rechazar</button>
									        	<button type="button" class="btn btn-default" onclick="limpia_pop();" data-dismiss="modal">Cancelar</button>
									      	</div> <!--Footer-->
									    </div> <!--Content-->
								    </div>
								</div><?
						}
							?></table>
						</div>
					</div>
			</div><?

	break;

	case "aprobar_publicacion":
	$idpublicacion=$_REQUEST["idpublicacion"];

		echo "Hola".$idpublicacion;
	break;
}
?>