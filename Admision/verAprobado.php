<?php
	include("plantillaAdministrador.php");
	$estudiantes = new Aprobados();
	$tutores = new Tutores();
	$mensaje = "";
	$conf = "form-group";
	$conf2 = "form-group";
?>
<div class="container-fluid">
	<?php
			if(isset($_GET['id'])){	
				$estudiantes->id = $_GET['id'];
				$estudiantes->traerAprobado();
				$tutores->id = $estudiantes->id_Tutor;	
				$tutores->traerTutor();

				// $usuarios = new Usuarios();
				// $usuarios->id = $estudiantes->id_Usuario;
				
				
	?>
	<div class="page-header" style="margin-top:50px;">
		<h2 class="text-center text-info">Datos del estudiante </h2>
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
		<div class="row">
			<center>
				<font style="font-size: 20px;"><p><b> Imagen 2x2</b></p></font>
				<img width = "200px" height= "200px" src = "documentos/imagen2x2/<?php echo $estudiantes->id_Usuario;?>.png" class="thumbnail"/>
			</center>
			<br>		 

			<div class="col-xs-4 col-xs-offset-3">
				<font style="font-size: 20px;">
					<p><b> Nombre(s): </b><?php echo $estudiantes->nombres; ?></p>
					<p><b> Fec. Nac.: </b><?php echo $estudiantes->fecha_nacimiento; ?></p>
					<p><b> Nacionalidad: </b><?php echo $estudiantes->nacionalidad; ?></p>
					<p><b> Tel&eacute;fono: </b><?php echo $estudiantes->telefono; ?></p>
				</font>
			</div>
			
			<div class="col-xs-5 col-xs-offset-0">
				<font style="font-size: 20px;">
					<p><b> Apellido(s): </b><?php echo $estudiantes->apellidos; ?></p>
					<p><b> Sexo: </b><?php echo $estudiantes->sexo; ?></p>
					<p><b> ID Tutor: </b><?php echo $estudiantes->id_Tutor; ?><a href="#formulario" style="text-decoration:none" data-toggle = "modal" data-target="#formulario"> - ver</a></p>
					<p><b> Celular: </b><?php echo $estudiantes->celular; ?></p>
				</font>
			</div>
		</div>
		<div class ="row col-xs-11 col-xs-offset-1">
			<font style="font-size: 20px;"><p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direcci&oacute;n: </b><?php echo $estudiantes->direccion; ?></p></font>
		</div>
		<br>
		<div class ="row col-xs-11 col-xs-offset-1">
			<h2 class="text-center text-info">Documentos</h2>
			<hr width= "600px">
			<div class="col-xs-10 col-xs-offset-2">
				<ul>
					<font style="font-size: 20px; list-style:none;">
						<li><b> Acta de Nacimiento: <a style= "text-decoration:none;" href = "documentos/actaNacimiento/<?php echo $estudiantes->id_EstudianteViejo;?>.png">Ver aqui!</a></b> </li>
						<li><b> C&eacute;dula: <a href = "documentos/cedula/<?php echo $estudiantes->id_EstudianteViejo;?>.png" style= "text-decoration:none;" >Ver aqui!</a></li>
						<li><b> Certificado m&eacute;dico: <a href = "documentos/certificadoM/<?php echo $estudiantes->id_EstudianteViejo;?>.png" style= "text-decoration:none;" >Ver aqui!</a></b>  </li>
						<li><b> Certificado 8vo: <a style= "text-decoration:none;"  href = "documentos/certificado8/<?php echo $estudiantes->id_EstudianteViejo;?>.png">Ver aqui!</a></b>  </li>
						<li><b> Record de notas: <a  style= "text-decoration:none;" href = "documentos/record/<?php echo $estudiantes->id_EstudianteViejo;?>.png">Descargar aqui!</a></b>  </li>
						<li><b> Ensayo de vida: <a  style= "text-decoration:none;" href = "documentos/ensayoV/<?php echo $estudiantes->id_EstudianteViejo;?>.docx">Descargar aqui!</a></b>  </li>
						<li><b> Ensayo pregunta:<a  style= "text-decoration:none;" href = "documentos/ensayoP/<?php echo $estudiantes->id_EstudianteViejo;?>.docx">Descargar aqui!</a> </b>  </li>
					</font>
				</ul><br><br>
			</div>
		</div>
	</div>
	</div><br><br>
<?php
	}
?>