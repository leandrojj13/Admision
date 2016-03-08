<?php
	include("plantillaAdministrador.php");
	$estudiantes = new Estudiantes();			
	$usuarios = new Usuarios();
	$tutores = new Tutores();
	$mensajesEstudiantes = new MensajesEstudiantes();
	$mensaje = "";
	$conf = "form-group";
	$conf2 = "form-group";
	if(isset($_GET['id']) && isset($_GET['idEs'])){
	
		echo <<<CODE
				<script>
					window.onload = function (){
						$('#formularioRazon').modal({show: 'true'}); 
					}
				</script>
CODE;
	
	
		if(isset($_POST['desarrolloRechazo']) && $_POST['desarrolloRechazo'] ){
			
			$documentos = scandir("Documentos");
			
			foreach($documentos as $docCarpetas){	
				if($docCarpetas != "." && $docCarpetas != ".."){
					$carpetas = scandir("Documentos/{$docCarpetas}");
					foreach($carpetas as $carpetitas){
						if($carpetitas != "." && $carpetitas != ".."){
							$cantidad =	strlen($carpetitas);
							for($i=1; $i<=$cantidad; $i++){
								if($carpetitas{$cantidad - $i} == "."){
									if (substr($carpetitas, 0, $cantidad - $i) == "{$_GET['id']}"){
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
			$mensajesEstudiantes->id_usuario = $_GET['id'];
			$mensajesEstudiantes->guardar();

			$usuarios->id =  $_GET['id'];
			$usuarios->estado = "\"No aprobado!\"";
			$usuarios->actualizar();
				echo <<<CODE
			<script>
				window.location = 'solicitudesEsperando.php'
			</script>
CODE;
		$estudiantes->id = $_GET['idEs'];
		$estudiantes->traerEstudiante();
		$tutores->id= $estudiantes->id_Tutor;
		$tutores->borrarRegistro();
		$estudiantes->borrarEstudiante();
		
		
		
		}else if (isset($_POST['desarrolloRechazo']) && !trim($_POST['desarrolloRechazo'])){
			$conf2 = "form-group has-error";
		}
	}	
	if(isset($_GET['idSuccess']) && isset($_GET['idEs'])){	
		
		echo <<<CODE
				<script>
					window.onload = function (){
						$('#calificacion').modal({show: 'true'}); 
					}
				</script>
CODE;

	if(isset($_POST['calificacion']) && trim($_POST['calificacion'])){
		if($_POST['calificacion'] >= 70 && $_POST['calificacion'] <= 100){
			$usuarios->id =  $_GET['idSuccess'];
			$usuarios->estado = "\"Aprobado!\"";
			$usuarios->actualizar();
			
				echo <<<CODE
					<script>
						window.location = 'solicitudesEsperando.php'
					</script>
CODE;
			
				$estudiantes->id = $_GET['idEs'];
				$estudiantes->traerEstudiante();
				
				$aprobados = new Aprobados();
				$aprobados->nombres = $estudiantes->nombres;
				$aprobados->apellidos = $estudiantes->apellidos;
				$aprobados->fecha_nacimiento = $estudiantes->fecha_nacimiento;
				$aprobados->nacionalidad = $estudiantes->nacionalidad;
				$aprobados->telefono = $estudiantes->telefono; 
				$aprobados->celular = $estudiantes->celular; 
				$aprobados->direccion = $estudiantes->direccion;
				$aprobados->estado_Civil = $estudiantes->estado_Civil;
				$aprobados->sexo = $estudiantes->sexo;
				$aprobados->id_Tutor = $estudiantes->id_Tutor;
				$aprobados->id_Usuario = $estudiantes->id_Usuario;
				$aprobados->id_EstudianteViejo = $estudiantes->id;
				
				$aprobados->guardarEditar();
				
				$mensajesEstudiantes->asunto = "Has sido aprobado!";
				$mensajesEstudiantes->cuerpo = "Felicidades usted ha sido aceptado, para ingresar a esta instituci&oacute;n.";
				$mensajesEstudiantes->id_usuario =  $_GET['idSuccess'];
				$mensajesEstudiantes->guardar();
				
				$estudiantes->borrarEstudiante();
			}else{
				$mensaje = "<p style= 'color: red' align = 'center'>Con esta calificaci&oacute;n no se puede aprobar al estudiante!</p>";
				$conf = "form-group has-error";
			}
		}
	}
	$estudiante = Estudiantes::extraerEstudiantes();
?>

<div class="row">
	<div class="page-header" style="margin-top:50px;">
		<h2 class="text-center text-info">Solicitudes de Inscripciones<small> En espera</small></h2>
	</div>
	<?php
		//for($i =0; $i<10; $i++){
	if($estudiante){
		foreach($estudiante as $student){
	?>
	<div class="col-sm-4 col-lg-4 col-md-4">
		<div class="thumbnail">
			<a href = "verFormulario.php?vorm=aansoeker&id=<?php echo $student['id'];?>" style= "text-decoration:none;">
			<img style="height:200px; width:200px"  src="imagen.php?id=<?php echo $student['id_Usuario']; ?>" alt=""></a><hr>
			<div class="caption">
				<a href = "verFormulario.php"  style= "text-decoration:none;">	
					<h3><?php echo $student['nombres']." ". $student['apellidos']?></h3>
				</a>
				<p>Fecha de solicitud: <?php echo $student['fecha']; ?></p>

				<center>
					<p>
						<a href="solicitudesEsperando.php?idSuccess=<?php echo $student['id_Usuario'];?>&idEs=<?php echo $student['id'];?>" class="btn btn-primary">Aceptar</a>
						<!-- <button onClick="get()" href="#formularioRazon" data-toggle = "modal" data-target="#formularioRazon"  class="btn btn-default">Rechazar</button> -->
						<a href="solicitudesEsperando.php?id=<?php echo $student['id_Usuario'];?>&idEs=<?php echo $student['id'] ?>" class="btn btn-default">Rechazar</a>
					</p>
				</center>
			</div>
		</div>
	</div>
	<?php
		}
	}else{
		echo "<p class='text-center text-muted' style='margin-top:180px; font-size: 65px; font-family: Courier New;'>Esperando por solicitudes para mostrar !</strong></p>";
	}
	?>
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
								<input  class="form-control" value="<?php //if($_POST){ echo $_POST['año'];}else{ echo $carro->ano;} ?>" type="number" name="calificacion" placeholder="Ingrese Calificaci&oacute;n"/>
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
</div>	


