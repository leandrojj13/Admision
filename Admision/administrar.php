<?php
	include("plantillaAdministrador.php");
	if($_POST){
		if(isset($_POST['desarrolloMision']) && trim($_POST['desarrolloMision'])){
			file_put_contents("data/mision.dat", $_POST['desarrolloMision']);
		}
		else if(isset($_POST['desarrolloVision']) && trim($_POST['desarrolloVision'])){
			file_put_contents("data/vision.dat", $_POST['desarrolloVision']);
		}else if( isset($_POST['value1'])&& isset($_POST['value2']) && isset($_POST['value3']) && isset($_POST['value4'])&& isset($_POST['value5']) && trim($_POST['value1'])&& trim($_POST['value2']) && trim($_POST['value3'])){
			file_put_contents("data/valores.dat", json_encode($_POST));
		}
	}
?>
	<div class="row">
		<div class="page-header" >
			<h2 class="text-center text-info">Administrar p&aacute;gina principal del estudiante</h2>
		</div>
	</div>
	<div class="container-fluid" style="margin-bottom:150">
		<div class="col-xs-10 col-xs-offset-1">
			
			<div class="col-xs-12">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">Misi&oacute;n</h3>
						<div style="float:right; position: relative; top:-20px">
							<a href="#formularioMision" class= "btn btn-warning btn-xs"  data-toggle = "modal" data-target="#formularioMision"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						</div>
					</div>
					<div class="panel-body">
						<?php 
							if(is_file("data/mision.dat")){
								echo file_get_contents("data/mision.dat");
							}else{
								echo "A&uacute;n no ha configurado su misi&oacute;n";
							}
						?>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Visi&oacute;n</h3>
						<div style="float:right; position: relative; top:-20px">
							<a href="#formularioVision" class= "btn btn-warning btn-xs"  data-toggle = "modal" data-target="#formularioVision"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						</div>
					</div>
					<div class="panel-body">
						<?php 
							if(is_file("data/vision.dat")){
								echo file_get_contents("data/vision.dat");
							}else{
								echo "A&uacute;n no ha configurado su visi&oacute;n";
							}
						?>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Valores</h3>
						<div style="float:right; position: relative; top:-20px">
							<a href="#formularioValores" class= "btn btn-warning btn-xs"  data-toggle = "modal" data-target="#formularioValores"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						</div>
					</div>
					<div class="panel-body">
						<?php
							$verificador = true;
							if(is_file("data/valores.dat")){
								$datos = file_get_contents("data/valores.dat");
								$datos = json_decode($datos);
								$verificador = false;
							}
						?>
		
						<ul class="lead">
						<li><?php if ($verificador){echo "Valor #1";}else{echo $datos->value1;}?>.   </li>
						<li><?php if ($verificador){echo "Valor #2";}else{echo $datos->value2;}?>.    </li>
						<li><?php if ($verificador){echo "Valor #3";}else{echo $datos->value3;}?>. </li>
					<?php if ($verificador || !trim($datos->value4)){}else{ echo "<li>{$datos->value4}.</li>"; } ?>
					<?php if ($verificador || !trim($datos->value5)){}else{ echo "<li>{$datos->value5}.</li>"; } ?>
					</ul>
			
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>


<div class ="modal fade" id="formularioMision">
	<div class= "modal-dialog">
		<div class="modal-content">
			<div class = "modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidde="true">&times;</button>
				<h3 class = "modal-title text-center">Misi&oacute;n</h3>
			</div>
			<div class="modal-body">
				<form action=""  method="post" class="form-vertical" enctype="multipart/form-data">

					<div class="form-group">
						<label class="control-label" >Desarrollo: </label>
							<textarea style="resize:none" rows="5" class="form-control" name="desarrolloMision" placeholder="Campo obligatorio" required ><?php if(is_file("data/mision.dat")){echo file_get_contents("data/mision.dat"); }?></textarea>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary btn-md"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
						<button class="btn btn-default btn-md" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-sign"></span> Cerrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class ="modal fade" id="formularioVision">
	<div class= "modal-dialog">
		<div class="modal-content">
			<div class = "modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidde="true">&times;</button>
				<h3 class = "modal-title text-center">Visi&oacute;n</h3>
			</div>
			<div class="modal-body">
				<form action=""  method="post" class="form-vertical" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label" >Desarrollo: </label>
							<textarea style="resize:none" rows="5" class="form-control" name="desarrolloVision" placeholder="Campo obligatorio" required ><?php if(is_file("data/vision.dat")){echo file_get_contents("data/vision.dat"); }?></textarea>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary btn-md"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
						<button class="btn btn-default btn-md" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-sign"></span> Cerrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class ="modal fade" id="formularioValores">
	<div class= "modal-dialog">
		<div class="modal-content">
			<div class = "modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidde="true">&times;</button>
				<h3 class = "modal-title text-center">Valores</h3>
			</div>
			<div class="modal-body">
				<form action=""  method="post" class="form-vertical" id="formValores">
						<?php 
											for($i = 1; $i  < 6; $i++){
											$valor = "value{$i}";
									?>
									<div class="form-group" id="alerta<?php echo $i;?>">
										<label class="control-label">Valor <?php echo $i?>: </label>
											<select class="form-control" name="value<?php echo $i;?>" id="valor<?php echo $i;?>"  <?php if ($i<4){echo "required";}?>>
												<option value="">--Elegir--</option>
												<option <?php if($datos->$valor == "Servicio"){echo "selected";} ?>  value="Servicio">Servicio</option>
												<option <?php if($datos->$valor == "Calidad"){echo "selected";} ?>  value="Calidad">Calidad</option>
												<option <?php if($datos->$valor == "Respeto"){echo "selected";} ?>  value="Respeto">Respeto</option>
												<option <?php if($datos->$valor == "Disciplina"){echo "selected";} ?>  value="Disciplina">Disciplina</option>
												<option <?php if($datos->$valor == "Creatividad"){echo "selected";} ?>  value="Creatividad">Creatividad</option>
												<option <?php if($datos->$valor == "Honestidad"){echo "selected";} ?>  value="Honestidad">Honestidad</option>
												<option <?php if($datos->$valor == "Puntualidad"){echo "selected";} ?>  value="Puntualidad">Puntualidad</option>
												<option <?php if($datos->$valor == "Originalidad"){echo "selected";} ?>  value="Originalidad">Originalidad</option>
												<option <?php if($datos->$valor == "Perseverancia"){echo "selected";} ?>  value="Perseverancia">Perseverancia</option>
												<option <?php if($datos->$valor == "Responsabilidad"){echo "selected";} ?>  value="Responsabilidad">Responsabilidad</option>
												<option <?php if($datos->$valor == "Libertad"){echo "selected";} ?>  value="Libertad">Libertad</option>
												<option <?php if($datos->$valor == "Competitividad"){echo "selected";} ?>  value="Competitividad">Competitividad</option>
											</select>
									</div>
						
									<?php	
										}
									?>
					<div id="loaderValores" style="text-align:center"></div>
					<div class="modal-footer">
						<button id="btnValores" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
						<button class="btn btn-default btn-md" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-sign"></span> Cerrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>