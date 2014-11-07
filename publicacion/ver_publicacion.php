<?php
include_once("../includes/config.php");
$idpublicacion = $_REQUEST["idpublicacion"];

$sql 		 = "SELECT publicacion.*,medicamento.nombremedicamento FROM publicacion INNER JOIN medicamento USING(idmedicamento) WHERE idpublicacion=?";
//echo $sql;
$query 		 = $db->prepare($sql);
$prepare 	 = array($idpublicacion);
$result 	 = $query->execute($prepare);
$Publicacion = $query->fetch(PDO::FETCH_ASSOC);
if(!empty($Publicacion["foto1"])):
?>
<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">  
    <div class="rg-image-wrapper">
        {{if itemsCount > 1}}
            <div class="rg-image-nav">
                <a href="#" class="rg-image-nav-prev">Previous Image</a>
                <a href="#" class="rg-image-nav-next">Next Image</a>
            </div>
        {{/if}}
        <div class="rg-image"></div>
        <div class="rg-loading"></div>
        <div class="rg-caption-wrapper">
            <div class="rg-caption" style="display:none;">
                <p></p>
            </div>
        </div>
    </div>
</script>
<?php
endif;
?>
<div class="container" style="padding-top:80px;">		
		<div class="panel panel-default" style="box-shadow:2px 2px 5px;margin:0 auto;margin-bottom:35px;">
		<div class="panel-heading" style="text-align: center;">
        	<label><b>Publicaci&oacute;n</b></label>
       	</div>
		<div class="panel-body">
		<?php
			if(!empty($Publicacion["foto1"])):
		?>
			<div id="rg-gallery" class="rg-gallery">
   				<div class="rg-thumbs">
       				<!-- Elastislide Carousel Thumbnail Viewer -->
       				<div class="es-carousel-wrapper">
           				<div class="es-nav">
               				<span class="es-nav-prev">Previous</span>
               				<span class="es-nav-next">Next</span>
           				</div>
           				<div class="es-carousel">
                			<ul>
   	                			<li>
       	                			<a href="#">
           	                			<img src="images/thumbs/1.jpg" data-large="images/1.jpg" alt="image01" data-description="Some description" />
               	        			</a>
		        	            </li>
           				        <li>...</li>
                			</ul>
	            		</div>
       				</div>
       				<!-- End Elastislide Carousel Thumbnail Viewer -->
   				</div><!-- rg-thumbs -->
			</div><!-- rg-gallery -->
			<?php
			endif;
			echo "<p>".$Publicacion["nombremedicamento"]."</p>";
			echo "<p>".$Publicacion["descripcion"]."</p>";
			if(!empty($Publicacion["fechavencimiento"])): "<p>Fecha de Vencimiento: ".$Publicacion["fechavencimiento"]."</p>"; endif;
			?>
			<input type="button" class="btn btn-success" value="Contactar" data-toggle="modal" data-target="modal-publi<?=$Publicacion["idpublicacion"]?>">
										<!--Modal de descripcion de publicacion-->
								<div id="modal-publi<?=$Publicacion["idpublicacion"]?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
								    <div class="modal-dialog modal-lg">
									    <div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h4 class="modal-title 1">Mensaje</h4>
											</div> <!--Header-->
											<div class="modal-body">
												<div class="form-horizontal" style="width:;margin: 0 auto;">
													<div class="form-group">
										<div class="form-group" id="div_nm" style="display:;">
										<label style="align:left;" class="col-sm-3 control-label">Mensaje:</label>
										<div class="col-sm-6">
											<textarea id="mensaje" name="mensaje" class="form-control"></textarea>
										</div>
									</div>
													</div>
												</div>
											</div> <!--Body-->
									    	<div class="modal-footer" style="text-align:center;">
									        	<button type="button" class="btn btn-success ini" onclick="enviar_mensaje(<?=$Publicacion["idpublicacion"]?>)"><i id="spin_bt_log" style="display:none;" class="fa fa-spinner fa-spin"></i>Enviar</button>
									        	<button type="button" class="btn btn-default" onclick="limpia_pop();" data-dismiss="modal">Cancelar</button>
									      	</div> <!--Footer-->
									    </div> <!--Content-->
								    </div>
								</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function enviar_mensaje(idpublicacion)
{
	mensaje = $("#mensaje").val();
	$.get("publicacion/ver_publicacion_datos.php",{"idpublicacion":idpublicacion,"mensaje":mensaje},function(data){
		alert(data);
	});
}
</script>