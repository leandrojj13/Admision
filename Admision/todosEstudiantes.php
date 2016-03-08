<?php
	include("plantillaAdministrador.php");
?>

<div class="row">
<?php
if(isset($_GET['alle'])){
	if($_GET['alle'] == "genehmigt"){
	
	 $todosEstudiantes = Aprobados::extraerEstudiantes(); 
	if($todosEstudiantes){
?>
	<div class="page-header" style="margin-top:50px;">
		<h2 class="text-center text-info">Estudiantes aprobados</h2>
		<div class="form-group">
			<div class="col-md-2 ">
				<Select class=" form-control" name="anoBusqueda"> 
					<OPTION value = "2015">2015</OPTION>
				</Select>
			</div>
			<button type="submit" class="btn btn-default">Ir</button>
			<font style= "color: gray; font-size: 20px"><small class ="pull-right">Cantidad: <?php echo count($todosEstudiantes);?>&nbsp;&nbsp;&nbsp;</small></font>
		</div>
	</div>
	<div class="row col-xs-10 col-sm-offset-1" style= " border-style: solid; border-width: 1px;">
		<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<font size = "30px">
							<th>Matr&iacute;cula</th>
							<th>Nombre Completo</th>
							<th>Edad</th>
							<th>ID Tutor</th>
							<th>Ver</th>
						</font>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach( $todosEstudiantes  as $estudiantesAprobados){
					$nacimientoEstudiante = new DateTime($estudiantesAprobados['fecha_nacimiento']);
					$fechaActual = new DateTime(date('Y/m/d'));
					$edad = $nacimientoEstudiante->diff($fechaActual);
					
					$estudiantesAprobados['fecha_nacimiento'] = $edad->format("%y a&ntilde;os");
				?>
					<tr>
						<td><?php echo $estudiantesAprobados['id'];?></td>
						<td><?php echo $estudiantesAprobados['nombres']." ".$estudiantesAprobados['apellidos'];?></td>
						<td><?php echo $estudiantesAprobados['fecha_nacimiento'];?></td>
						<td><?php echo $estudiantesAprobados['id_Tutor'];?></td>
						<td><a href="verAprobado.php?id=<?php echo $estudiantesAprobados['id'];?>"><span class="glyphicon glyphicon-eye-open" ></span></a></td>
					</tr>
				<?php
					}
				?>	
				</tbody>
			</table>
			<br>
		</div>
	</div>
	<div class="row col-xs-10  col-sm-offset-1"><br><br></div>
<?php
	}else{
		echo "<p class='text-center text-muted' style='margin-top:180px; font-size: 65px; font-family: Courier New;'>No hay estudiantes!</strong></p>";
	} 
	
}else if($_GET['alle'] == "einzelnachhilfe"){
		$tutores = Tutores::extraerRegistros();
		if($tutores){
?>
	<div class="page-header" style="margin-top:50px;">
		<h2 class="text-center text-info">Tutores</h2>
		<div class="form-group">
			<div class="col-md-2 ">
				<Select class=" form-control" name="anoBusqueda"> 
					<OPTION value = "2015">2015</OPTION>
				</Select>
			</div>
				<button type="submit" class="btn btn-default">Ir</button>
			<font style= "color: gray; font-size: 20px"><small class ="pull-right">Cantidad: <?php echo count($tutores);?>&nbsp;&nbsp;&nbsp;</small></font>
		</div>
		<br>
	</div>
	
	<div class="row col-xs-10  col-sm-offset-1" style= " border-style: solid; border-width: 1px;">
		<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre Completo</th>
						<th>Direcci&oacute;n</th>
						<th>Ver</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($tutores as $tutor){
				?>
					<tr>
						<td><?php echo $tutor['id'];?></td>
						<td><?php echo $tutor['nombres']." ".$tutor['apellidos'];?></td>
						<td><?php echo $tutor['direccion'];?></td>
						<td><a href="verFormulario.php?vorm=erzieher&id=<?php echo $tutor['id'];?>"><span class="glyphicon glyphicon-eye-open" ></span></a></td>
					</tr>
				<?php
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
<?php
		}else {
			echo "<p class='text-center text-muted' style='margin-top:180px; font-size: 65px; font-family: Courier New;'>No hay tutores!</strong></p>";
		}
	}
}
?>
</div><br>