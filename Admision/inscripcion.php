<?php
	include("plantilla.php");
	
	$estudiantes = new Estudiantes();
	$tutores = new Tutores();
	$mensajes = new Mensajes();
	$usuarios = new Usuarios();
	$usuarios->usuario = $_SESSION['logeado'];
	$usuarios->traerUsuario();
	//echo "<br><br><br><br><br><br><br>";
	if($_POST){
		// foreach($_POST as $k => $v){
			// echo "\$estudiantes->{$k} = \$_POST['{$k}'];<br>";
		// }
		//if(trim($tutores->sexo) && trim($tutores->estado_Civil) && trim($tutores->profesion) ||$tutores->nombres) || trim($tutores->apellidos) || trim($tutores->nacionalidad) ||trim($tutores->telefono) || trim($tutores->direccion) ){		
			$tutores->nombres = $_POST['nombreTutor'];
			$tutores->apellidos = $_POST['apellidoTutor'];
			$tutores->nacionalidad = $_POST['nacionalidadTutor'];
			$tutores->telefono = $_POST['telefonoTutor'];
			$tutores->celular = $_POST['celularTutor'];
			$tutores->direccion = $_POST['direccionTutor'];
			$tutores->profesion = $_POST['profesionTutor'];
			$tutores->estado_Civil = $_POST['estadoCivilTutor'];
			$tutores->sexo = $_POST['sexoTutor'];

			$tutores->guardar();
			
			$estudiantes->nombres = $_POST['nombres'];
			$estudiantes->apellidos = $_POST['apellidos'];
			$estudiantes->fecha_nacimiento = $_POST['fecha_nacimiento'];
			$estudiantes->nacionalidad = $_POST['nacionalidad'];
			$estudiantes->telefono = $_POST['telefono'];
			$estudiantes->celular = $_POST['celular'];
			$estudiantes->direccion = $_POST['direccion'];
			$estudiantes->estado_Civil = $_POST['estado_Civil'];
			$estudiantes->sexo = $_POST['sexo'];
			$estudiantes->id_Tutor = $tutores->id;
			$estudiantes->id_Usuario = $usuarios->id;
			
			$estudiantes->guardarEditar();
			
			$mensajes->asunto = "Inscripci&oacute;n";
			$mensajes->usuario = $_POST['nombres'];
			$mensajes->cuerpo = "<font size= \"4\" style=\"font-family: Courrier New;  text-align: justify;\"><p>El solicitante \"{$estudiantes->nombres}\" ha completado su formulario de  inscrito y traido todos los papeles correspondientes, esta listo para el examen de admisi&oacute;n, notifique si todos sus papeles estan correctos.</p></font>
			<font size= \"4\" style=\"font-family: Courrier New;  text-align: justify;\"><p>Click en <a href= \"verFormulario.php?vorm=aansoeker&id={$estudiantes->id}\" style = \"text-decoration:none\">link</a> para ver formulario de inscripci&oacute;n de este solicitante.</p></font>";
			
			$mensajes->guardarAdmin();
			
			$usuarios->estado = "\"Solicitud en espera!\"";
			
			$usuarios->actualizar();
			
			//$foto = $_FILES['foto'];
			move_uploaded_file($_FILES['foto']['tmp_name'], "Documentos/imagen2x2/{$usuarios->id}.png");
			move_uploaded_file($_FILES['actaNacimiento']['tmp_name'], "Documentos/actaNacimiento/{$usuarios->id}.png");
			
			if(isset($_FILES['cedula'])){
				move_uploaded_file($_FILES['cedula']['tmp_name'], "Documentos/cedula/{$usuarios->id}.png");
			}
			move_uploaded_file($_FILES['certificadoMedico']['tmp_name'], "Documentos/certificadoM/{$usuarios->id}.png");
			move_uploaded_file($_FILES['certificadoCurso']['tmp_name'], "Documentos/certificado8/{$usuarios->id}.png");
			move_uploaded_file($_FILES['recordNota']['tmp_name'], "Documentos/record/{$usuarios->id}.png");
			move_uploaded_file($_FILES['ensayoDeVida']['tmp_name'], "Documentos/ensayoV/{$usuarios->id}.docx");
			move_uploaded_file($_FILES['ensayoPregunta']['tmp_name'], "Documentos/ensayoP/{$usuarios->id}.docx");
			move_uploaded_file($_FILES['cedulaTutor']['tmp_name'], "Documentos/cedulaTutor/{$usuarios->id}.png");
			
			$mensajesEstudiantes = new MensajesEstudiantes();
			$mensajesEstudiantes->asunto = "Inscripci&oacute;n!";
			$mensajesEstudiantes->cuerpo = "Su formulario de inscripci&oacute;n ha llegado exitosamente, se le notificara si se encuentra alg&uacute;n error en sus datos.";
			$mensajesEstudiantes->id_usuario = $usuarios->id;
			$mensajesEstudiantes->guardar();
			
		//}
	}
?>
<div class ="container-fluid">
	<div id = "requisitos">
		<br>
		<center>
			<h1>
				<font  face= "Agency FB" size="30">Inscripci&oacute;n</font>
			</h1>
		</center>
		<br>
		<font align = "left" style = "font-weight: normal;"face  = "Verdana" size="4">
			<p>Requisitos para inscripci&oacute;n: <p>
			<li>Acta de nacimiento legalizada.</li>
			<li>R&eacute;cord de notas de 8vo.</li>
			<li>Certificado de 8vo.</li>
			<li>Certificaci&oacute;n m&eacute;dica oficial debidamente firmada y sellada.</li>
			<li>Tres (3) fotograf&iacute;as 2x2  (Por este medio solo subir una).</li>
			<li>Fotocopia de la c&eacute;dula de identidad y electoral (Si es mayor de edad).</li>
			<li>Un ensayo de vida (M&iacute;nimo 2 hojas).</li>
			<li>Un ensayo respodiendo a la pregunta: &iquest;Por qu&eacute; eleg&iacute; este centro educativo? (M&iacute;nimo 2 hojas).</li>
			<li>Fotocopia de la c&eacute;dula de identidad del tutor.</li>
		</font>
	<br><br><br>
	</div>
	<?php	
	
	$botton = '<center>
		<a id = "botonInscribirse" href="#formularioEstudiante" onclick = "ocultar()" class= "btn btn-success btn-lg" data-target="#formulario"><span class="glyphicon glyphicon-plus"></span> Inscribirse</a>
	</center>';
		switch($usuarios->estado){
		case  "\"No hay solicitud!\"":
			echo $botton;
			break;
		case "\"Aprobado!\"":
			echo "<p class='text-center text-muted' style='margin-top: 1px; font-size: 60px; font-family: Courier New;'>Ya usted ha sido aceptado!</strong></p>";
			break;
			
		case "\"Solicitud en espera!\"":
			echo "<p class='text-center text-muted' style='margin-top: 1px; font-size: 60px; font-family: Courier New;'>Ya se ha enviado su solicitud de inscripci&oacute;n!</strong></p>";
			break;
		case ("\"No aprobado!\""):
			echo $botton;
			break;
		}
	?>
<form form action=""  method="post" class="form-horizontal" enctype="multipart/form-data">
	<div id = "formularioEstudiante" class= "container" style= "margin-top: 5px; margin-bottom: 20px; display:none;">
		<div class= "page-header">	
			<br>
			<h1 id = "titulo">Formulario  de inscripci&oacute;n <small>Informaci&oacute;n estudiante</small></h1>
		</div>	
		<div class = "page-body">


				<div class="form-group" id = "alert1">
					<label class="control-label col-md-2" for="Usuario">Nombre(s): </label>
					<div class="col-md-10">
						<input  id = "campo1" title = "Favor escribir su nombre!" class="form-control" value="" type="text" name="nombres" placeholder="Campo Obligatorio" required />
					</div>
				</div>
				<div class="form-group" id = "alert2">
					<label class="control-label col-md-2" for="Clave">Apellido(s): </label>
					<div class="col-md-10">
						<input id = "campo2" title = "Favor escribir su apellido!"  class="form-control" value="" type="text" name="apellidos" placeholder="Campo Obligatorio" required />
					</div>
				</div>
				<div class="form-group" id = "alert3">
					<label class="control-label col-md-2" for="Clave">Fecha Nacimiento:</label>
					<div class="col-md-10">
						<input  id = "campo3" class="form-control"value="" type="date" name="fecha_nacimiento" placeholder="Campo obligatorio" required />
					</div>
				</div>
				<div class="form-group" id = "alert4">
					<label class="control-label col-md-2" for="Clave">Nacionalidad:</label>
					<div class="col-md-10">
						<input  id = "campo4" class="form-control"value="" type="text" name="nacionalidad" placeholder="Campo obligatorio" required />
					</div>
				</div>

				<div class="form-group" id = "alert5">
					<label class="control-label col-md-2">Tel&eacute;fono: </label>
					<div class="col-md-10">
						<input id = "campo5" class="form-control" value="" type="number" name="telefono" placeholder="Campo obligatorio" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-2">Celular: </label>
					<div class="col-md-10">
						<input  class="form-control" value="" type="number" name="celular" placeholder = "Opcional"/>
					</div>
				</div>

				<div class="form-group" id = "alert6">
					<label class="control-label col-md-2">Direcci&oacute;n: </label>
					<div class="col-md-10">
						<input id = "campo6" class="form-control" value="" type="text" name="direccion" placeholder="Campo Obligatorio"  required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-2 ">Estado Civil: </label>
					<div class="col-md-10">
						<Select class="form-control" name="estado_Civil"> 
							<OPTION value = "No Especificado">--Elegir--</OPTION>
							<OPTION value = "Soltero(a)">Soltero(a)</OPTION>
							<OPTION value = "Casado(a)">Casado(a)</OPTION>
							<OPTION value = "Comprometido(a)">Comprometido(a)</OPTION>
							<OPTION value = "Divorciado(a)">Divorciado(a)</OPTION>
							<OPTION value = "Viudo(a)">Viudo(a)</OPTION>
						</Select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Sexo: </label>
					<div class="col-md-10">	
						<div class="col-xs-2">
							<label class="radio-inline">
								<input type="radio" name="sexo" value="Maculino" checked /> Maculino
							</label>
						</div>
						<div class="col-xs-2">
							<label class="radio-inline">
								<input type="radio" name="sexo" value="Femenino" /> Femenino
							</label>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-2">Imagen 2x2: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir imagen&hellip;<input id = "imagen2x2"  class="form-control-static" type="file" name="foto" required />
						</span>
					</div>
				</div>
				
				<div class="form-group" >
					<label class="control-label col-md-2">Acta de nacimiento: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir fotocopia&hellip;<input id = "actaNacimiento" class="form-control-static" type="file" name="actaNacimiento" required />
						</span>
					</div>
				</div>	
				<div class="form-group">
					<label class="control-label col-md-2">C&eacute;dula: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir fotocopia&hellip;<input id= "cedula" class="form-control-static" type="file" name="cedula" />
						</span>
					</div>
				</div>	
				<div class="form-group">
					<label class="control-label col-md-2">Certificado m&eacute;dico: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir fotocopia&hellip;<input id = "CertificadoM" class="form-control-static" type="file" name="certificadoMedico" required />
						</span>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="control-label col-md-2">Certificado 8vo: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir fotocopia&hellip;<input id = "Certificado8" class="form-control-static" type="file" name="certificadoCurso" required />
						</span>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="control-label col-md-2">Record de notas de 8vo: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir fotocopia&hellip;<input id = "Record" class="form-control-static" type="file" name="recordNota" required />
						</span>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="control-label col-md-2">Ensayo de vida: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir archivo&hellip;<input id = "Vida" class="form-control-static" type="file" name="ensayoDeVida" required />
						</span>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="control-label col-md-2">Ensayo pregunta: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir archivo&hellip;<input id = "Pregunta" class="form-control-static" type="file" name="ensayoPregunta" required />
						</span>
					</div>
				</div>

				<br>
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-9">
						<ul class="pager">
						   <li class="previous">
								<a type="button" href = "principal.php" onclick = ""><span class = "glyphicon glyphicon-remove-circle"></span> Cancelar</a>
							</li>
							<li class="next">
								<a type="button" href = "#" onclick = "continuar()">Continuar &rarr;</a>
							</li>    						
						</ul>
					</div>
				</div>
			
		</div>
	</div>

	<div id = "formularioTutor" class= "container" style= "margin-top: 10px; margin-bottom: 20px; display: none;" >
		<div class= "page-header">	
			<h1 id = "titulo">Formulario  de inscripci&oacute;n <small>Informaci&oacute;n tutor</small></h1>
		</div>	
		<div class = "page-body">
		

				<div class="form-group">
					<label class="control-label col-md-2" for="Usuario">Nombre(s): </label>
					<div class="col-md-10">
						<input class="form-control" value="" type="text" name="nombreTutor" placeholder="Campo Obligatorio" required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2" for="Clave">Apellido(s): </label>
					<div class="col-md-10">
						<input class="form-control" value="" type="text" name="apellidoTutor" placeholder="Campo Obligatorio" required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2" for="Clave">Nacionalidad:</label>
					<div class="col-md-10">
						<input  class="form-control"value="" type="text" name="nacionalidadTutor" placeholder="Campo obligatorio" required />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">Tel&eacute;fono: </label>
					<div class="col-md-10">
						<input class="form-control" value="" type="number" name="telefonoTutor" placeholder="Campo obligatorio" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-2">Celular: </label>
					<div class="col-md-10">
						<input class="form-control" value="" type="number" name="celularTutor" placeholder = "Opcional" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">Direcci&oacute;n: </label>
					<div class="col-md-10">
						<input class="form-control" value="" type="text" name="direccionTutor" placeholder="Campo Obligatorio" required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2" for="Clave">Profesi&oacute;n</label>
					<div class="col-md-10">
						<input  class="form-control"value="" type="text" name="profesionTutor" placeholder="Campo obligatorio" required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 ">Estado Civil: </label>
					<div class="col-md-10">
						<Select class="form-control" name="estadoCivilTutor"> 
							<OPTION value = "No Especificado">--Elegir--</OPTION>
							<OPTION value = "Soltero(a)">Soltero(a)</OPTION>
							<OPTION value = "Casado(a)">Casado(a)</OPTION>
							<OPTION value = "Comprometido(a)">Comprometido(a)</OPTION>
							<OPTION value = "Divorciado(a)">Divorciado(a)</OPTION>
							<OPTION value = "Viudo(a)">Viudo(a)</OPTION>
						</Select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Sexo: </label>
					<div class="col-md-10">	
						<div class="col-xs-2">
							<label class="radio-inline">
								<input type="radio" name="sexoTutor" value="Maculino" checked /> Maculino
							</label>
						</div>
						<div class="col-xs-2">
							<label class="radio-inline">
								<input type="radio" name="sexoTutor" value="Femenino" /> Femenino
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">C&eacute;dula: </label>
					<div class="col-md-10">
						<span class="btn btn-default">
							Subir fotocopia&hellip;<input class="form-control-static" type="file" name="cedulaTutor" required />
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2">Pol&iacute;tica: </label>
					<div class="col-md-10">
						<label class="checkbox-inline">
							<input type="checkbox" value="agree" required>  Acepto <a type = "button"href="#condicionesEstudiante" data-toggle = "modal" data-target="#condiciones">T&eacute;rminos y condiciones</a>.
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-3 col-xs-9">
						<ul class="pager">
							<li class="pull-left">
								<a type="button" href = "#" onclick = "continuar()">&larr; Atras</a>
								<input type="submit" class="btn btn-primary" value="Enviar">
							</li>
						</ul>
					</div>
				</div>
			
		</div>
	</div>
</form>
	<div class ="modal fade" id="condiciones">
		<div class= "modal-dialog">
			<div class="modal-content">
				<div style = " margin-top: 20px;">
					<h3 class = "modal-title text-center">T&eacute;rminos y Condiciones</h3>
				</div>
				<div class="modal-body" >
					<div class="col-md-12" >
						<font align = "justify">
							<br>
							<p>1. Normativa: todos los arreglos y trámites para los estudiantes están dispuestos de acuerdo a las reglas y normas del país donde se ubique la escuela.</p>
							<p>2. Llegadas y salidas: los estudiantes deben llegar a sus programas el día domingo, donde la parte académica del programa comienza el lunes, a menos que se haya establecido de otra manera previamente. El alojamiento está reservado desde el domingo (siendo la fecha de inicio del programa) hasta el sábado después de que la parte académica del programa ha terminado. Fuera de las horas indicadas, los traslados individuales tendrán que ser organizados a un costo adicional por el estudiante.</p>
							<p>3. Retrasos, vacaciones y ausencias: si un estudiante llega tarde o está ausente en cualquier momento durante el programa, no será realizado ningún reembolso por el tiempo perdido. El estudiante deberá notificar a su asesor educativo Kaplan por adelantado, si él / ella va a llegar después de la fecha de inicio del programa. La falta de notificación al asesor educativo Kaplan con antelación, puede resultar en la cancelación de la inscripción al estudiante. Los periodos de ausencia no pueden ser compensados con una extensión gratuita del programa. Kaplan se reserva el derecho de cobrar por las semanas enteras, inclusive donde haya habido asistencia parcial.</p>
							<p>4. Comidas y clases perdidas: no se otorgan devoluciones o sustituciones por las comidas o las clases perdidas, incluyendo excursiones, primer día de orientación o cualquier obligación que quedan fuera del horario normal.</p>
							<p>5. Instalaciones del campus: los estudiantes que asisten a un centro de aprendizaje para jóvenes en campus universitarios o colleges, deben tener en cuenta que algunas instalaciones del campus pueden no estar disponibles durante las vacaciones. También se debe tomar en cuenta que algunas instalaciones no se encuentran disponibles para los estudiantes menores de 18 años. Para mayor información, por favor consulte a su asesor educativo Kaplan</p>
							<p>6. Honorarios de cambios: si un estudiante solicita cambios de ubicación de escuela, fechas del programa, alojamiento o programa con menos de 4 semanas antes de la fecha de inicio del programa o después de haber iniciado el mismo, se le cobrará un costo adicional de GBP 60, USD 100, AUD 75 en el momento de realizar la solicitud. Cuando el cambio es a un centro más económico, no habrá reembolsos por la diferencia. Si el cambio es a un centro o programa más costoso, la diferencia en costos será cobrado. Todos los cambios están sujetos al criterio de Kaplan y requerirán la aprobación del administrador de la escuela, y en el caso de que el estudiante sea menor de 18 años, será requerido el consentimiento por escrito de sus padres o tutor/apoderado. No se les cobrará a los estudiantes una tarifa de cambio si éste/ta extiende un programa. Es la responsabilidad del estudiante el pago de las prórrogas de sus programas. Cualquier cambio en el programa que resulte en una reducción de las lecciones será tratado como una terminación de la reserva existente y se requerirá una nueva reserva, estos trámites están sujetos a la política de terminación.</p>
							<p>7. Duración de las clases: todas las clases de inglés tienen un tiempo de duración de 45 minutos (60 minutos en el programa para jóvenes en Australia). Las clases son de lunes a viernes (excepto días públicos o festivos) y las lecciones pueden ser programadas tanto en la mañana como en la tarde.</p>
							<p>8. Días festivos: normalmente no se llevan a cabo clases durante días públicos o feriados, la mayoría de las instalaciones Kaplan están cerradas los días festivos. No habrá compensación de las clases que no se ofrecen en días festivos</p>
							<p>9. Modificaciones de programas: Kaplan tiene el derecho de cambiar las fechas de los programas, el plan de estudio del curso, ubicaciones, alojamiento y programa, en cualquier momento a su discreción. Sin embargo, en los casos en que el programa es reprogramado antes del inicio de la fecha de inicio del programa y la nueva fecha es inaceptable por parte del estudiante, el dinero pagado por el estudiante será reembolsado. Los cambios realizados en el programa, incluidas actividades sociales y el programa cultural por el estudiante o el asesor educativo del estudiante resultarán en costos adicionales.</p>
							<p>10. Precios: Kaplan tiene el derecho de cambiar los precios en cualquier momento. Los precios indicados en el catálogo son válidos para los programas que empiezan en el 2014.</p>
						</font>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default btn-md" data-dismiss="modal" ><span class="glyphicon glyphicon glyphicon-check"></span> Aceptar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function ocultar(){
			var botonInscribirse = document.getElementById("botonInscribirse")
			var formularioEstudiante = document.getElementById("formularioEstudiante")
			var requisitos = document.getElementById("requisitos")
			
			if(formularioEstudiante.style.display=='none'){
				formularioEstudiante.style.display = 'block';
				botonInscribirse.style.display = 'none';
				requisitos.style.display = 'none';
			}
		}
		function continuar(){
			if (!document.getElementById('campo1').value.trim()){
				$('#alert1').addClass("has-error");		
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
			}else if (!document.getElementById('campo2').value.trim()){
				$('#alert2').addClass("has-error");	
				$('#alert1').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
			}else if (!document.getElementById('campo3').value.trim()){
				$('#alert3').addClass("has-error");	
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");		
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
			}else if (!document.getElementById('campo4').value.trim()){
				$('#alert4').addClass("has-error");	
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
			}else if (!document.getElementById('campo5').value.trim()){
				$('#alert5').addClass("has-error");	
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
			}else if (!document.getElementById('campo6').value.trim()){
				$('#alert6').addClass("has-error");	
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
			}else if(document.getElementById('imagen2x2').value == ""){		
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
				
				alert("Favor agregar su Imagen 2x2!");
				//document.getElementById('c').style.color: "red";
				console.log("no tengo nada");
			}else if(document.getElementById('actaNacimiento').value == ""){		
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
				
				alert("Favor agregar su acta de nacimiento!");
				//document.getElementById('c').style.color: "red";
				console.log("no tengo nada");
			}else if(document.getElementById('CertificadoM').value == ""){		
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
				
				alert("Favor agregar su certificado médico!");
				//document.getElementById('c').style.color: "red";
				console.log("no tengo nada");
			}else if(document.getElementById('cedula').value == ""){		
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
				
				alert("Favor agregar su certificado médico!");
				//document.getElementById('c').style.color: "red";
				console.log("no tengo nada");
			}else if(document.getElementById('Certificado8').value == ""){		
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
				
				alert("Favor agregar su certificado de 8vo!");
				//document.getElementById('c').style.color: "red";
				console.log("no tengo nada");
			}else if(document.getElementById('Record').value == ""){		
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
				
				alert("Favor agregar su record de notas!");
				console.log("no tengo nada");
			}else if(document.getElementById('Vida').value == ""){		
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
				
				alert("Favor agregar su ensayo de vida");
				console.log("no tengo nada");
			}else if(document.getElementById('Pregunta').value == ""){		
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
				
				alert("Favor agregar su ensayo de pregunta");
				console.log("no tengo nada");
			}
			
			else{
				aprobado();
				$('#alert1').removeClass("has-error");	
				$('#alert2').removeClass("has-error");	
				$('#alert3').removeClass("has-error");	
				$('#alert4').removeClass("has-error");	
				$('#alert5').removeClass("has-error");	
				$('#alert6').removeClass("has-error");	
			}
		
		}
		function aprobado(){
			var formularioTutor = document.getElementById('formularioTutor')
			var formularioEstudiante = document.getElementById('formularioEstudiante')
			
			if(formularioTutor.style.display=='none'){
				formularioTutor.style.display = 'block';
				formularioEstudiante.style.display = 'none';
			}else{
				formularioTutor.style.display = 'none';
				formularioEstudiante.style.display = 'block';
			}
		}

	</script>
</div>