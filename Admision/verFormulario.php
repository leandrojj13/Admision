<?php
	include("plantillaAdministrador.php");
	$estudiantes = new Estudiantes();
	$tutores = new Tutores();
	$mensajesEstudiantes = new MensajesEstudiantes();
	$mensaje = "";
	$conf = "form-group";
	$conf2 = "form-group";
?>
<div class="container-fluid">
	<?php

		if(isset($_GET['vorm']) && $_GET['vorm'] == "aansoeker"){
			if(isset($_GET['id'])){	
				$estudiantes->id = $_GET['id'];
				$estudiantes->traerEstudiante();
				$tutores->id = $estudiantes->id_Tutor;	
				$tutores->traerTutor();
				if(isset($_GET['id_user']) && isset($_GET['type']) ){
					$noticaciones = new Notificaciones();
					
					$noticaciones->notificacion = "Llamar para verificar su ". $_GET['type'];
					
					$noticaciones->id_Usuario = $estudiantes->id_Usuario;
					$noticaciones->guardar();
					header("Location: verFormulario.php?vorm=aansoeker&id="+ $_GET['id']);
				}
				$usuarios = new Usuarios();
				$usuarios->id = $estudiantes->id_Usuario;
				
				if(isset($_POST['desarrolloRechazo']) && $_POST['desarrolloRechazo']){

					$documentos = scandir("Documentos");
					
					foreach($documentos as $docCarpetas){	
						if($docCarpetas != "." && $docCarpetas != ".."){
							$carpetas = scandir("Documentos/{$docCarpetas}");
							foreach($carpetas as $carpetitas){
								if($carpetitas != "." && $carpetitas != ".."){
									$cantidad =	strlen($carpetitas);
									for($i=1; $i<=$cantidad; $i++){
										if($carpetitas{$cantidad - $i} == "."){
											if (substr($carpetitas, 0, $cantidad - $i) == "{$usuarios->id}"){
												unlink ("Documentos/{$docCarpetas}/{$carpetitas}");
											}
										}
									}
								}
							}
						}
					}
					
					$mensajesEstudiantes->asunto = "Has sido rechazado!";
					$mensajesEstudiantes->cuerpo = $_POST['desarrolloRechazo'];
					$mensajesEstudiantes->id_usuario = $estudiantes->id_Usuario;
					$mensajesEstudiantes->guardar();

					
					$usuarios->estado = "\"No aprobado!\"";
					$usuarios->actualizar();
					
					echo <<<CODE
			<script>
				window.location = 'solicitudesEsperando.php'
			</script>
CODE;
				$tutores->borrarRegistro();
				$estudiantes->borrarEstudiante();
					
				}else if (isset($_POST['desarrolloRechazo']) && !trim($_POST['desarrolloRechazo'])){			
					echo <<<CODE
							<script>
								window.onload = function (){
									$('#formularioRazon').modal({show: 'true'}); 
								}
							</script>
CODE;
					$conf2 = "form-group has-error";
					
				}
				if(isset($_POST['calificacion']) && $_POST['calificacion']){
					if($_POST['calificacion'] >= 70 && $_POST['calificacion'] <= 100){
						$usuarios->estado = "\"Aprobado!\"";
						$usuarios->actualizar();
				}else{	
						echo <<<CODE
							<script>
								window.onload = function (){
									$('#calificacion').modal({show: 'true'}); 
								}
							</script>
CODE;
						$mensaje = "<p style= 'color: red' align = 'center'>Con esta calificaci&oacute;n no se puede aprobar al estudiante!</p>";
						$conf = "form-group has-error";
					}
				}
	?>
	<div class="page-header" style="margin-top:50px;">
		<h2 class="text-center text-info">Datos del solicitante </h2>
	</div>
	<div class="page-body">
		<div class ="modal fade" id="formulario">
			<div class= "modal-dialog">
				<div class="modal-content">
					<div class = "modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidde="true">&times;</button>
						<h3 class = "modal-title text-center">Datos tutor</h3>
					</div>
					<div class="modal-body form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-2">Nombre(s): </label>
							<div class="col-md-10">
								<input disabled class="form-control" value="<?php echo $tutores->nombres; ?>" type="text"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2" >Apellido(s): </label>
							<div class="col-md-10">
								<input  class="form-control" value="<?php echo $tutores->apellidos; ?>" type="text"  disabled />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2" >Nacionalidad:  </label>
							<div class="col-md-10">
								<input  class="form-control" value="<?php echo $tutores->nacionalidad; ?>" type="text"disabled />
							</div>
						</div>		
						
						<div class="form-group">
							<label class="control-label col-md-2" >Tel&eacute;fono: </label>
							<div class="col-md-10">
								<input  class="form-control" value="<?php echo $tutores->telefono; ?>" type="text"disabled />
							</div>
						</div>		

						<div class="form-group">
							<label class="control-label col-md-2" >Celular: </label>
							<div class="col-md-10">
								<input  class="form-control" value="<?php echo $tutores->celular; ?>" type="text"disabled />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2" >Profesi&oacute;n: </label>
							<div class="col-md-10">
								<input  class="form-control" value="<?php echo $tutores->profesion; ?>" type="text"disabled />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2" >Direcci&oacute;n: </label>
							<div class="col-md-10">
								<input  class="form-control" value="<?php echo $tutores->direccion; ?>" type="text"disabled />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2" >Estado Civil: </label>
							<div class="col-md-10">
								<input  class="form-control" value="<?php echo $tutores->estado_Civil; ?>" type="text"disabled />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2" >C&eacute;dula: </label>
							<div class="col-md-10">
								<a href="documentos/cedulaTutor/<?php echo $estudiantes->id_Usuario;?>.png"> Ver aqu&iacute;</a>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<center><button class="btn btn-default btn-md" data-dismiss="modal" ><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button></center>
					</div>
				</div>
			</div>
		</div>
		<div class ="modal fade" id="formularioRazon">
			<div class= "modal-dialog">
				<div class="modal-content">
					<div class = "modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidde="true">&times;</button>
						<h3 class = "modal-title text-center">Raz&oacute;n del rechazo</h3>
					</div>
					<div class="modal-body">
						<form action=""  method="post" class="form-vertical" enctype="multipart/form-data">
							<div class="<?php echo $conf2; ?>">
								<label class="control-label" >Desarrollo: </label>
									<textarea style="resize:none" rows="5" class="form-control" name="desarrolloRechazo" placeholder="Campo obligatorio">Lo sentimos, usted no ha sido aceptado para ingresar a esta escuela.<?php //if($_POST){ echo $_POST['año'];}else{ echo $carro->ano;} ?></textarea>
							</div>
							<div class="modal-footer">
								<button class="btn btn-primary btn-md"><span class="glyphicon glyphicon-ok-sign"></span> Enviar</button>
								<button class="btn btn-default btn-md" data-dismiss="modal" ><span class="glyphicon glyphicon-remove-sign"></span> Cerrar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<center>
				<font style="font-size: 20px;"><p><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")'  href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=imagen 2x2" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Imagen 2x2</b></p></font>
				<img width = "200px" height= "200px" src = "documentos/imagen2x2/<?php echo $estudiantes->id_Usuario;?>.png" class="thumbnail"/>
			</center>
			<br>		 

			<div class="col-xs-4 col-xs-offset-3">
				<font style="font-size: 20px;">
					<p> <a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=nombre" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Nombre(s): </b><?php echo $estudiantes->nombres; ?></p>
					<p><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=Fec.Nac." title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Fec. Nac.: </b><?php echo $estudiantes->fecha_nacimiento; ?></p>
					<p><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=nacionalidad" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Nacionalidad: </b><?php echo $estudiantes->nacionalidad; ?></p>
					<p><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=telefono" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Tel&eacute;fono: </b><?php echo $estudiantes->telefono; ?></p>
				</font>
			</div>
			
			<div class="col-xs-5 col-xs-offset-0">
				<font style="font-size: 20px;">
					<p><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=apellido" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Apellido(s): </b><?php echo $estudiantes->apellidos; ?></p>
					<p><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=sexo" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Sexo: </b><?php echo $estudiantes->sexo; ?></p>
					<p><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=info. tutor" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> ID Tutor: </b><?php echo $estudiantes->id_Tutor; ?><a href="#formulario" style="text-decoration:none" data-toggle = "modal" data-target="#formulario"> - ver</a></p>
					<p><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=celular" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Celular: </b><?php echo $estudiantes->celular; ?></p>
				</font>
			</div>
		</div>
		<div class ="row col-xs-11 col-xs-offset-1">
			<font style="font-size: 20px;"><p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=direcci&oacute;n" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a>&nbsp;Direcci&oacute;n: </b><?php echo $estudiantes->direccion; ?></p></font>
		</div>
		<br>
		<div class ="row col-xs-11 col-xs-offset-1">
			<h2 class="text-center text-info">Documentos</h2>
			<hr width= "600px">
			<div class="col-xs-10 col-xs-offset-2">
				<ul>
					<font style="font-size: 20px; list-style:none;">
						<li><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=acta nacimiento" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Acta de Nacimiento: <a style= "text-decoration:none;" href = "documentos/actaNacimiento/<?php echo $estudiantes->id_Usuario;?>.png">Ver aqui!</a></b> </li>
						<li><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=cedula" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> C&eacute;dula: <a href = "documentos/cedula/<?php echo $estudiantes->id_Usuario;?>.png" style= "text-decoration:none;" >Ver aqui!</a></li>
						<li><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=certificado m&eacute;dico" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Certificado m&eacute;dico: <a href = "documentos/certificadoM/<?php echo $estudiantes->id_Usuario;?>.png" style= "text-decoration:none;" >Ver aqui!</a></b>  </li>
						<li><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=certificado de 8vo" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Certificado 8vo: <a style= "text-decoration:none;"  href = "documentos/certificado8/<?php echo $estudiantes->id_Usuario;?>.png">Ver aqui!</a></b>  </li>
						<li><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=Ensayo vida" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Record de notas: <a  style= "text-decoration:none;" href = "documentos/record/<?php echo $estudiantes->id_Usuario;?>.png">Descargar aqui!</a></b>  </li>
						<li><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=Ensayo vida" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Ensayo de vida: <a  style= "text-decoration:none;" href = "documentos/ensayoV/<?php echo $estudiantes->id_Usuario;?>.png">Descargar aqui!</a></b>  </li>
						<li><a onclick = 'confirm("&iquest;Esta seguro que quiero notificar un problema en ese atributo?")' href = "verFormulario.php?vorm=aansoeker&id=<?php echo $estudiantes->id;?>&id_user=<?php echo $estudiantes->id_Usuario;?>&type=Ensayo pregunta" title="Notificar Observaci&oacute;n"><span class= "glyphicon glyphicon-exclamation-sign"></span></a><b> Ensayo pregunta:<a  style= "text-decoration:none;" href = "documentos/ensayoP/<?php echo $estudiantes->id_Usuario;?>.png">Descargar aqui!</a> </b>  </li>
					</font>
				</ul><br><br>
			</div>
		</div>
		
		<center>
			<a href="#calificacion" data-toggle = "modal" data-target="#calificacion" class="btn btn-primary">Aceptar</a>
			<a data-toggle = "modal" data-target="#formularioRazon" href="#formularioRazon" class="btn btn-default">Rechazar</a>
		</center>
		<div class ="modal fade" id="calificacion">
			<div class= "modal-dialog">
				<div class="modal-content">
					<div class = "modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidde="true">&times;</button>
						<h3 class = "modal-title text-center">Calificaci&oacute;n</h3>
						<?php echo $mensaje;?>
					</div>
					<div class="modal-body">
						<form action=""  method="post" class="form-horizontal" enctype="multipart/form-data">
							<div class="<?php echo $conf; ?>">
								<label class="control-label col-md-2" >Calificaci&oacute;n: </label>
								<div class="col-md-10">
									<input  id= "calificacionInput" class="form-control" onKeyUp="validacionNumero()" onclick="validacionNumero()" value="<?php //if($_POST){ echo $_POST['año'];}else{ echo $carro->ano;} ?>" type="number" name="calificacion" placeholder="Ingrese Calificaci&oacute;n"/>
								</div>
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
	</div>
	<?php
		}
	}else if(isset($_GET['vorm']) && $_GET['vorm'] == "erzieher" && isset($_GET['id'])){
		$tutores->id = $_GET['id'];
		$tutores->traerTutor();
	?>
	<div class="page-header" style="margin-top:50px;">
		<h2 class="text-center text-info">Datos del tutor </h2>
	</div>
	<div class="page-body">
		<div class="row">
			<center>
				<font style="font-size: 20px;"><p><b> C&eacute;dula</b></p></font>
				<img width = "300px" height= "200px" src = "Documentos/cedulaTutor/<?php echo $_GET['id'];?>.png" class="thumbnail"/>
			</center>
			<br>		 

			<div class="col-xs-4 col-xs-offset-3">
				<font style="font-size: 20px;">
					<p><b> Nombre(s): </b><?php echo $tutores->nombres;?></p>
					<p><b> Profesi&oacute;n: </b><?php echo $tutores->profesion;?></p>
					<p><b> Nacionalidad: </b><?php echo $tutores->nacionalidad;?></p>
					<p><b> Tel&eacute;fono: </b><?php echo $tutores->telefono;?></p>
				</font>
			</div>
			
			<div class="col-xs-5 col-xs-offset-0">
				<font style="font-size: 20px;">
					<p><b> Apellido(s): </b><?php echo $tutores->apellidos;?></p>
					<p><b> Sexo: </b><?php echo $tutores->sexo;?></p>
					<p><b> Estado Civil: </b><?php echo $tutores->estado_Civil;?></p>
					<p><b> Celular: </b><?php echo $tutores->celular;?></p>
				</font>
			</div>
		</div>
		<div class ="row col-xs-11 col-xs-offset-1">
			<font style="font-size: 20px;"><p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direcci&oacute;n: </b>Calle Dajab&oacute;n, #157, Ensanche Espaillat.</p></font>
		</div>
		<br>

	</div>
	<?php
		}
	?>
</div><br><br>
<script>
	//function validacionNumero(){
		// if ($("#calificacionInput").val() > 100){
			// alert("weyyyyy asi no es");
			// evt.stopPropagation();
		// }
//	}

</script>